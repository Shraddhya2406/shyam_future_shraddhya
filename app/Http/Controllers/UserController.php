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
        $originalImage->resize(180, 100)->save($source_url_thumb,85);
 
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
    public function edit(Request $request){
        
    }

    public function delete($id){
        
    }
}
