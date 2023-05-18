<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    // function to go to index page of user
    public function index(){
        $users = !empty(Session::get('users')) ? Session::get('users') : [];
        return view('users.index',compact('users'));
    }

    // function to store user
    public function add(Request $request){
        $users = !empty(Session::get('users')) ? Session::get('users') : [];
        if (count($users) == 0) {
            $new_id = 1;
        } else {
            $new_id = $users[count($users) - 1]['id'] + 1;
        }
        $validator = Validator::make($request->all(), array(
			'name' => 'required',
			'image' => 'required',
			'address' => 'required',
			'gender' => 'required',
        ));

        if ($validator->fails()) {
			Session::flash('errorFails', "Something went wrong");
            return redirect()->back();
        }
        $image = $request->file('image');
        $input['media_url'] = time() . rand(). '.' . $image->getClientOriginalExtension();

        $path = env('IMAGE_PATH');
        $destinationPath = public_path($path);

        $image->move($destinationPath, $input['media_url']);

        $source_url = $destinationPath . '/' . $input['media_url'];

        // thumbnail
        $thumb_name = 'thumb_'.$input['media_url'];
        $thumb_name = str_replace(".gif",".png",$thumb_name);
        $source_url_thumb = $destinationPath.'/'.$thumb_name;
        Storage::disk('public')->copy($input['media_url'], $thumb_name);

        //create thumbnail
        $originalImage = Image::make($source_url);
        $originalImage->resize(65, 50)->save($source_url_thumb,85);
 
        $new_user = [
            'id'=>$new_id,
            'name'=>$request->name,
            'image'=>$input['media_url'],
            'thumb_image'=>$thumb_name,
            'address'=>$request->address,
            'gender'=>$request->gender
        ];
        array_push($users, $new_user);
        Session::put('users', $users);
        return redirect()->route('users.index');
    }

    // function to edit user data
    public function edit(Request $request){
        $users = !empty(Session::get('users')) ? Session::get('users') : [];
        $data = $this->find($request->id);
        $user = $data['user'];
        $key = $data['key'];
        if (empty($user) && $key == -1) {
            Session::flash('error', 'No user found');
            return redirect()->back();
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'edit_name' => 'required',
                'edit_address' => 'required',
                'edit_gender' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->messages())->withInput();
            }
            $image_path = $user['image'];
            $thumb_image_path = $user['thumb_image'];
            $image = $request->file('edit_image');
            if (!empty($image)) {
                $input['media_url'] = time() . rand(). '.' . $image->getClientOriginalExtension();
    
                $path = env('IMAGE_PATH');
                $destinationPath = public_path($path);
                if (!empty($user['image'])) {
                    $existing_image = $destinationPath . '/' . $user['image'];
                    $existing_thumb_image = $destinationPath . '/' . $user['thumb_image'];
                    unlink($existing_image);
                    unlink($existing_thumb_image);
                }
    
                $image->move($destinationPath, $input['media_url']);
    
                $source_url = $destinationPath . '/' . $input['media_url'];
    
                // thumbnail
                $thumb_name = 'thumb_'.$input['media_url'];
                $thumb_name = str_replace(".gif",".png",$thumb_name);
                $source_url_thumb = $destinationPath.'/'.$thumb_name;
                Storage::disk('public')->copy($input['media_url'], $thumb_name);
    
                //create thumbnail
                $originalImage = Image::make($source_url);
                $originalImage->resize(65, 50)->save($source_url_thumb,85);

                $image_path = $input['media_url'];
                $thumb_image_path = $thumb_name;
            }
            $updated_user = [
                'id'=>$user['id'],
                'name'=>$request->edit_name,
                'image'=>$image_path,
                'thumb_image'=>$thumb_image_path,
                'address'=>$request->edit_address,
                'gender'=>$request->edit_gender
            ];
    
            $users[$key] = $updated_user;
            Session::put('users', $users);

            Session::flash('success', 'User updated successfully');
            return redirect()->route('users.index');
        }

        $edit_modal_view = view('users.edit',compact('user'))->render();
        return response()->json(['status' => 200, 'edit_modal_view' => $edit_modal_view]);
    }

    // function to delete user data
    public function delete($id){
        $users = !empty(Session::get('users')) ? Session::get('users') : [];
        $data = $this->find($id);
        $user = $data['user'];
        $key = $data['key'];
        if (empty($user) && $key == -1) {
            Session::flash('error', 'No user found');
            return redirect()->back();
        }
        if (!empty($user['image'])) {
            $path = env('IMAGE_PATH');
            $destinationPath = public_path($path);
            $existing_image = $destinationPath . '/' . $user['image'];
            $existing_thumb_image = $destinationPath . '/' . $user['thumb_image'];
            unlink($existing_image);
            unlink($existing_thumb_image);
        }
        array_splice($users, $key, 1);
        Session::put('users', $users);

        Session::flash('success', 'User deleted successfully');
        return redirect()->route('users.index');
    }

    // function to view user data
    public function view(Request $request){
        $users = !empty(Session::get('users')) ? Session::get('users') : [];
        $data = $this->find($request->id);
        $user = $data['user'];
        $key = $data['key'];
        if (empty($user) && $key == -1) {
            Session::flash('error', 'No user found');
            return redirect()->back();
        }
        $view_modal_view = view('users.view',compact('user'))->render();
        return response()->json(['status' => 200, 'view_modal_view' => $view_modal_view]);
    }

    // function to find user data
    private function find($id){
        $users = !empty(Session::get('users')) ? Session::get('users') : [];
        foreach ($users as $key => $item) {
            if ($item['id'] == $id) {
                return ['user' => $item, 'key' => $key ];
            }
        }
        return ['user' => null, 'key' => -1 ];
    }
}
