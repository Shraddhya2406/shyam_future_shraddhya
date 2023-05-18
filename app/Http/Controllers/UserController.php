<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $all_users;
    public function __construct(){
        $this->all_users = [
            [
                'id'=>1,
                'name'=>'Tester',
                'image'=>'',
                'address'=>'Test address',
                'gender'=>'Male'
            ],
            [
                'id'=>2,
                'name'=>'Developer',
                'image'=>'',
                'address'=>'Developer address',
                'gender'=>'Female'
            ],
        ];
    }
    public function index(){
        $users = $this->all_users;
        return view('users.index',compact('users'));
    }

    public function add(Request $request){
        
    }
    public function edit(Request $request){
        
    }

    public function delete($id){
        
    }
}
