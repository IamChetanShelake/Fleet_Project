<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;    

class AuthApiController extends Controller
{
     public function signup(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(),[
            'name' => 'nullable|string',
            'address' => 'nullable|array',
            'address.*' => 'string',
            'mobile' => 'nullable|array',
            'mobile.*' => 'string',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string|min:6',
            'billingName' => 'nullable|string',
            'billingAddress' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $validator->validated();

       
        $cust = new Customer();
        $cust->name = $credentials['name'] ?? null;
        $cust->email = $credentials['email'];
        $cust->password = bcrypt($credentials['password']);
        $cust->mobile_no = isset($credentials['mobile']) ? json_encode($credentials['mobile']) : null;
        $cust->address = isset($credentials['address']) ? json_encode($credentials['address']) : null;
        $cust->billing_name = $credentials['billingName'] ?? null;
        $cust->billing_address = $credentials['billingAddress'] ?? null;
        $cust->save();


        return response()->json([
            'status'=>true,
            "message" => "Customer registered successfully",
            'customer'=>$cust,
        ],200);
    }

    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(),[
            'email' => 'nullable|email|required_without:mobile',
            'mobile' => 'nullable|numeric|required_without:email',
            'password' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        $masterOtp = 1234;
        $credentials = $validator->validated();
        
        $customer = Customer::where('email',$credentials['email'] ?? null)->orWhere('mobile_no',$credentials['mobile'] ?? null)->first();
            if(!$customer){
                return response()->json([
                    'status'=>false,
                    'message'=>'Customer not found',
                ],404);
            }

        if(!\Hash::check($credentials['password'], $customer->password ?? null)){
            return response()->json([
                'status'=>false,
                'message'=>'Invalid password',
            ],401);
        }

        // Generate a token for the authenticated user
        $token = $customer->createToken('customer_token')->plainTextToken;


        // Return the token in the response
        return response()->json([
            'status'=>true,
            'otp' => $masterOtp,
            'customer'=>$customer,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],200);
    }

    public function logout(Request $request)
{
    $user = $request->user(); // Customer

    if ($user->currentAccessToken()) {
        $user->currentAccessToken()->delete();
    }

    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully',
    ], 200);
}

   
}
