<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['logout', 'me']]);
    }

    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'validate_error',
                'errors' => $validator->errors()
            ], 422);
        }

        try{
            if (!auth()->attempt($validator->validated())) {
                return response([
                    'status' => 'error',
                    'message' => "Credentials doesn't matched..."
                ], 401);
            }

            $accessToken = auth()->user()->createToken('authToken');
            $user = User::with('profile')->where('id', auth()->id())->first();
            return response([
                'status' => 'done',
                'message' => 'Successfully logged in...',
                'token' => 'Bearer ' . $accessToken->plainTextToken,
                'user' => $user
            ], 200);
        }catch(Exception $ex){
            return dd($ex);
        }
    }

    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'alternate_phone' => 'required',
            'blood_group' => 'required',
            'weight' => 'required',
            'gender' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'post_code' => 'required|numeric',
            'dob' => 'required',
            'age' => 'required|numeric',
            'avatar' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'validate_error',
                'errors' => $validator->errors()
            ], 422);
        }

        try{
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);
    
            if($user){
                $data = [
                    'user_id' => $user->id,
                    'phone' => request('phone'),
                    'alternate_phone' => request('alternate_phone'),
                    'social_link' => request('social_link'),
                    'blood_group' => request('blood_group'),
                    'weight' => request('weight'),
                    'gender' => request('gender'),
                    'street_address' => request('street_address'),
                    'city' => request('city'),
                    'post_code' => request('post_code'),
                    'dob' => request('dob'),
                    'age' => request('age'),
                ];
    
                if (request()->has('avatar')) {
                    $file = request()->file('avatar');
        
                    $upload_url = cloudinary()->upload($file->getRealPath(), [
                        'folder' => 'donate-blood/images/users/',
                        'public_id' => strtolower($user->name) . '-' . uniqid(),
                        'overwrite' => true,
                        'resource_type' => 'image'
                    ])->getSecurePath();
    
                    $data['avatar'] = $upload_url;
                }
    
                Profile::create($data);
    
                return response([
                    'status' => 'done',
                    'message' => 'Successfully registered...'
                ], 201);
            }
        }catch(Exception $ex){
            return dd($ex);
        }
    }

    public function logout()
    {
        try{
            auth()->user()->tokens()->delete();
            return response([
                'status' => 'done',
                'message' => 'Successfully logout...',
            ], 200);
        }catch(Exception $ex){
            return dd($ex);
        }
    }

    public function me()
    {
        try{
            $user = User::with('profile')->where('id', auth()->id())->first();
            return response(['status' => 'done','user' => $user], 200);
        }catch(Exception $ex){
            return dd($ex);
        }
    }
}
