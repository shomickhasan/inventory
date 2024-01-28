<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use App\Models\User;

class UserController extends Controller
{
    public function userRegistration(Request $request){
        try {
            /*$add_data = User::create([
                 "f_name"=> $request->input('f_name',''),
                 "l_name"=> $request->input('l_name',''),
                 "email"=>  $request->input('email'),
                 "password"=> Hash::make($request->input('password'))
            ]);*/
            $user = New User();
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $add_data = $user->save();

            if($add_data){
                return response()->json([
                    "status"=>"success",
                    'message'=>"User Created Successfully"
                ]);
            }
            else{
                return response()->json([
                    "status"=>"failed",
                    'message'=>"opps something happend",
                ]);
            }

        }catch (\Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }
    }

    public function login(Request $request){
       try {
            $user  = User::where('email',$request->input('email'))->first();

            if(!$user || !Hash::check($request->input('password'),$user->password)){
                return response()->json([
                    "status"=>"fail",
                    "message"=>"credentials mismatch",
                ] );
            }
            $token = $user->createToken('auth_token')->accessToken;
            return response()->json([
                "status"=>"success",
                "token"=> $token,
            ],200 );

        }catch (\Exception $e){
            return response()->json([
                "status"=> "failed",
                "error"=> $e->getMessage(),
            ],204 );
        }


    }
    public function profile(Request $request){
        try{
            $id= auth()->id();
            $user = User::find($id);
            if($user){
                return response()->json([
                    "status"=>"success",
                    "data"=> $user,

                ]);
            }
            else{
                return response()->json([
                    "status"=>"failed",
                    "message" => "user not found"
                ]);
            }
        }
        catch (\Exception){
            return response()->json([
                "status"=>"failed",
                "message" => "user not found"
            ]);
        }

    }
}
