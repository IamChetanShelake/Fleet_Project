<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Driver;   

class AuthApiController extends Controller
{
    //customer signup, login and logout functions
     public function signup(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(),[
            'name' => 'nullable|string',
            'address' => 'nullable|array',
            'address.*' => 'string',
            'franchise' => 'required|integer',
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
        $cust->franchise = $credentials['franchise'];
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
    public function profile(Request $request)
    {
        $customer = $request->user(); // Get the authenticated customer
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }
        
        return response()->json([
            'status' => true,
            'customer' => $customer,
            'links' => [
                'ContactUs' => 'Support Available 24/7',
                'Notification' => 'Change Your Notification Settings',
                'SecutryAndPRivacy' => 'Change Your Account Privacy',
                'Logout' => 'Logout from this device',
                ], 
            'Privacy Policy' => 'Privacy Policy',
            'Terms and Conditions' => 'Terms and Conditions',
        ],200);
    }

    //getProfileInfo
     public function profileInfo(Request $request)
    {
        $customer = $request->user(); // Get the authenticated customer
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }
        
        return response()->json([
            'status' => true,
            'customer' =>$customer,
        ],200);
    }

    public function updateProfile(Request $request)
    {
        $customer = $request->user(); // Get the authenticated customer
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }
        
        $validator = $request->validate([
            'name' => 'nullable|string',
            'address' => 'nullable|array',
            'address.*' => 'string',
            'mobile' => 'nullable|array',
            'mobile.*' => 'string',
            'billingName' => 'nullable|string',
            'billingAddress' => 'nullable|string',
             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$validator) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $validator;
        $customer->name = $credentials['name'] ?? $customer->name;
        $customer->mobile_no = isset($credentials['mobile']) ? json_encode($credentials['mobile']) : $customer->mobile_no;
        $customer->address = isset($credentials['address']) ? json_encode($credentials['address']) : $customer->address;
        $customer->billing_name = $credentials['billingName'] ?? $customer->billing_name;
        $customer->billing_address = $credentials['billingAddress'] ?? $customer->billing_address;
         if($request->hasFile('photo')){
             $photo = $request->file('photo');
             $fileName = 'customer_'.$customer->id.'_'.uniqid().'.'. $photo->getClientOriginalExtension();
             $photoPath = $photo->move('assets/customer_photos', $fileName);
             if ($photoPath) {
                 if ($customer->photo) {
                    $oldpath = $customer->photo;
                    if(is_file($oldpath)){
                        unlink($oldpath);
                    }
                 }
                 $customer->photo = $photoPath;
             }
         }
                 $customer->save();
         return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'customer' => $customer,
        ],200);
    }

    // driver signup, login and logout functions
    public function driversignup(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(),[
            'fullName' => 'nullable|string',
            'phone' => 'nullable|string',
            'drivingLicenseNo' => 'nullable|string',
            'LicenseExpiryDate' => 'nullable|date',
            'address' => 'nullable|string',
            'nationality' => 'nullable|string',
            'dob' => 'nullable|date',
            'alternateMobile' => 'nullable|array',
            'alternateMobile.*' => 'string',
            'email' => 'required|email|unique:drivers',
            'emergencyMobile' => 'nullable|string',
            'emergencyRelation' => 'nullable|string',
            'residencePermitStatus'=>'nullable|in:valid,expired',
            'passportExpiryDate' => 'nullable|date',
            'LicenseValidity' => 'nullable|date',
            'LicenseCategory' => 'nullable|string',
            'driverType' => 'nullable|string', //later will be enum truck,pickup,etc
            'LicenseExpiryAlert' => 'nullable|boolean',
            'MicGatepass' => 'nullable|string|in:yes,no',
            'RlcGatepass' => 'nullable|string|in:yes,no',
            //vehicle details
            'vehicleBrandAndModel' => 'nullable|string',
            'vehicleManufactureYear' => 'nullable|string',
            'vehicleRegstrationNo' => 'nullable|string',
            'vehicleFuelType' => 'nullable|string',
            'heavyVehiclePermit' => 'nullable|in:valid,expired',
            'InsuranceExpiryDate' => 'nullable|date',
            'consent'=>'nullable|boolean',
            'TermsConditions'=>'nullable|boolean',
            //docs
            'qatarId' => 'nullable|string',
            'residenceId' => 'nullable|string',
            'driverPhoto' => 'nullable|string',
            'digitalSignature' => 'nullable|string',
            'passport' => 'nullable|string',
            'drivingLicense' => 'nullable|string',
            'vehicleInsurance' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $validator->validated();

       
        $driver = new Driver();
        $driver->name = $credentials['fullName'] ?? null;
        $driver->email = $credentials['email'];
        $driver->phone = $credentials['phone'] ?? null;

        // Set other driver details from $credentials as needed
        $driver->drivingLicenseNo = $credentials['drivingLicenseNo'] ?? null;
        $driver->LicenseExpiryDate = $credentials['LicenseExpiryDate'] ?? null;
        $driver->address = $credentials['address'] ?? null;

        $driver->nationality = $credentials['nationality'] ?? null;
        $driver->dob = $credentials['dob'] ?? null;
        $driver->alternateMobile = $credentials['alternateMobile'] ?? null; // array
        $driver->emergencyMobile = $credentials['emergencyMobile'] ?? null;
        $driver->emergencyRelation = $credentials['emergencyRelation'] ?? null;

        $driver->residencePermitStatus = $credentials['residencePermitStatus'] ?? null;
        $driver->passportExpiryDate = $credentials['passportExpiryDate'] ?? null;
        $driver->LicenseValidity = $credentials['LicenseValidity'] ?? null;
        $driver->LicenseCategory = $credentials['LicenseCategory'] ?? null;
        $driver->driverType = $credentials['driverType'] ?? null;

        $driver->LicenseExpiryAlert = $credentials['LicenseExpiryAlert'] ?? null;
        $driver->MicGatepass = $credentials['MicGatepass'] ?? null;
        $driver->RlcGatepass = $credentials['RlcGatepass'] ?? null;

        // vehicle details
        $driver->vehicleBrandAndModel = $credentials['vehicleBrandAndModel'] ?? null;
        $driver->vehicleManufactureYear = $credentials['vehicleManufactureYear'] ?? null;
        $driver->vehicleRegstrationNo = $credentials['vehicleRegstrationNo'] ?? null;
        $driver->vehicleFuelType = $credentials['vehicleFuelType'] ?? null;
        $driver->heavyVehiclePermit = $credentials['heavyVehiclePermit'] ?? null;
        $driver->InsuranceExpiryDate = $credentials['InsuranceExpiryDate'] ?? null;

        $driver->consent = $credentials['consent'] ?? null;
        $driver->TermsConditions = $credentials['TermsConditions'] ?? null;

        $driver->save();
    }
    public function driverlogin(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(),[
            'mobile' => 'nullable|numeric',
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
        
        $customer = Driver::where('mobile_no',$credentials['mobile'] ?? null)->first();
            if(!$customer){
                return response()->json([
                    'status'=>false,
                    'message'=>'Driver not found',
                ],404);
            }

        if(!\Hash::check($credentials['password'], $customer->password ?? null)){
            return response()->json([
                'status'=>false,
                'message'=>'Invalid password',
            ],401);
        }

        // Generate a token for the authenticated user
        $token = $customer->createToken('driver_token')->plainTextToken;


        // Return the token in the response
        return response()->json([
            'status'=>true,
            'otp' => $masterOtp,
            'customer'=>$customer,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],200);
    }

    public function driverlogout(Request $request)
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
