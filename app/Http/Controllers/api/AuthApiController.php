<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Driver; 

class AuthApiController extends Controller
{        //customer signup, login and logout functions
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
            'customer' =>$customer->name,
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
    //update profile
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
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
             $photo->move('customer_photos', $fileName);
            //  $oldpath = "assets/".$customer->photo;
             
                 if ($customer->photo) {
                    $oldpath = $customer->photo;
                    if(is_file($oldpath)){
                        unlink($oldpath);
                    }
                 }
                 $customer->photo = $photoPath;
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
            'countryLevel'=>'required|in:local,international',
            'fullName' => 'nullable|string',
            'email' => 'required|email|unique:drivers',
            'nationality' => 'nullable|string',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'emergencyMobile' => 'nullable|string',
            'emergencyRelation' => 'nullable|string',
            'alternateMobile' => 'nullable|array',
            'alternateMobile.*' => 'string'
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
        $driver->countryLevel = $credentials['countryLevel'];
        $driver->name = $credentials['fullName'] ?? null;
        $driver->email = $credentials['email'];
        $driver->phone = $credentials['phone'] ?? null;
        $driver->address = $credentials['address'] ?? null;
        $driver->nationality = $credentials['nationality'] ?? null;
        $driver->dob = $credentials['dob'] ?? null;
        $driver->alternateMobile = isset($credentials['alternateMobile']) ? json_encode($credentials['alternateMobile']) : null;// array
        $driver->emergency_phone = $credentials['emergencyMobile'] ?? null;
        $driver->emergencyRelation = $credentials['emergencyRelation'] ?? null;
        $driver->kyc_status = "pending";
        $driver->createdBy = "self";

        $driver->save();
        
        return response()->json([
            'status' => true,
            'message' => 'Driver registered successfully',
            'data' => $driver
        ], 200);

    }
    public function driverlogin(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(),[
            'phone' => 'nullable|numeric',
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
        
        $customer = Driver::where('phone',$credentials['phone'] ?? null)->first();
            if(!$customer){
                return response()->json([
                    'status'=>false,
                    'message'=>'Driver not found',
                ],404);
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

    //update driver profile
     public function updateDriverProfile(Request $request){
         // Validate the request
        $validator = Validator::make($request->all(),[
            'driverId'=>'required|integer',
            'fullName' => 'nullable|string',
            'email' => 'required|email|unique:drivers,email,' . $request->driverId,
            'nationality' => 'nullable|string',
            'dob' => 'nullable|date',
            'bloodGroup' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'phone' => 'nullable|string',
            'alternateMobile' => 'nullable|array',
            'alternateMobile.*' => 'string',
            'emergencyMobile' => 'nullable|string',
            'emergencyRelation' => 'nullable|string',
            'drivingLicenseNo' => 'nullable|string',
            'LicenseExpiryDate' => 'nullable|date',
            'address' => 'nullable|string',
            'residencePermitStatus'=>'nullable|in:valid,expired',
            'passportExpiryDate' => 'nullable|date',
            'LicenseValidity' => 'nullable|date',
            'LicenseCategory' => 'nullable|string',
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
            'qatarId' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'residenceId' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'driverPhoto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'digitalSignature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'passport' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'drivingLicense' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'vehicleInsurance' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            //total 35 inputs

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $validator->validated();

       
        $driver = Driver::find($credentials['driverId']);

        if(!$driver){
             return response()->json([
                'status' => false,
                'message' => 'driver not found',
            ], 400);
        }

        $driver->name = $credentials['fullName'] ?? null;
        $driver->email = $credentials['email'];
        $driver->phone = $credentials['phone'] ?? null;

        // Set other driver details from $credentials as needed
        $driver->drivingLicenseNo = $credentials['drivingLicenseNo'] ?? null;
        $driver->LicenseExpiryDate = $credentials['LicenseExpiryDate'] ?? null;
        $driver->address = $credentials['address'] ?? null;

        $driver->nationality = $credentials['nationality'] ?? null;
        $driver->dob = $credentials['dob'] ?? null;
        $driver->blood_group = $credentials['bloodGroup'] ?? null;
        $driver->alternateMobile = $credentials['alternateMobile'] ?? null; // array
        $driver->emergency_phone = $credentials['emergencyMobile'] ?? null;
        $driver->emergencyRelation = $credentials['emergencyRelation'] ?? null;

        $driver->residencePermitStatus = $credentials['residencePermitStatus'] ?? null;
        $driver->passportExpiryDate = $credentials['passportExpiryDate'] ?? null;
        $driver->LicenseValidity = $credentials['LicenseValidity'] ?? null;
        $driver->LicenseCategory = $credentials['LicenseCategory'] ?? null;
        $driver->driverType = "self";

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
        
        $uploaded = $driver->qatarId = $this->uploadFile($request, 'qatarId', $driver->id);
        if ($uploaded) {
            $driver->qatarId = $uploaded;
        }
        $uploaded = $driver->residenceId = $this->uploadFile($request, 'residenceId', $driver->id);
        if ($uploaded) {
            $driver->residenceId = $uploaded;
        }
        $uploaded = $driver->driverPhoto = $this->uploadFile($request, 'driverPhoto', $driver->id);
        if ($uploaded) {
            $driver->driverPhoto = $uploaded;
        }
        $uploaded = $driver->signature = $this->uploadFile($request, 'digitalSignature', $driver->id);
         if ($uploaded) {
            $driver->signature = $uploaded;
        }
        $uploaded = $driver->passport = $this->uploadFile($request, 'passport', $driver->id);
        if ($uploaded) {
            $driver->passport = $uploaded;
        }
        $uploaded = $driver->drivingLicense = $this->uploadFile($request, 'drivingLicense', $driver->id);
        if ($uploaded) {
            $driver->drivingLicense = $uploaded;
        }
        $uploaded = $driver->vehicleInsurance = $this->uploadFile($request, 'vehicleInsurance', $driver->id);
        if ($uploaded) {
            $driver->vehicleInsurance = $uploaded;
        }
        
        $driver->save();
        
        
        
        return response()->json([
            'status' => true,
            'message' => 'Driver updated successfully',
            'data' => $driver
        ], 200);
    }
    
    //driver profile
    public function driverProfile(Request $request){
        $driver = $request->user(); // Get the authenticated customer
        if(!$driver){
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized: please login',
            ], 401);
         }
        
         $driver = Driver::find($request->user()->id);
         
          if(!$driver){
             return response()->json([
                'status' => false,
                'message' => 'driver not found',
            ], 404);
            }
        
        return response()->json([
                'status' => true,
                'message' => 'driver information fetched successfully !',
                'data'=>$driver
            ], 200);
    }

    //driver docs
    private function uploadFile($request, $field, $driverId)
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        $fileName = $field . '_' . $driverId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move("assets/driverDocs", $fileName);

        return 'assets/driverDocs/' . $fileName;
    }
    
     //driver documents check
    public function checkDriverDocuments(Request $request){
         $validator = Validator::make($request->all(),[
            'driverId' => 'required|alpha_num|exists:drivers,driver_id',
         ]);

          if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

         $validatedData = $validator->validated();
   

        $driverInfo = Driver::select(['qatarId',
         'residenceId',
         'driverPhoto',
         'signature',
         'passport',
         'drivingLicense',
         'vehicleInsurance'])
         ->where('driver_id',$validatedData['driverId'])->first();

         if(!$driverInfo){
             return response()->json([
                    'status' => false,
                    'message' => 'driver dont exist with this id',
                ], 400);
        }
        
        if(empty($driverInfo['residenceId']) || 
        empty($driverInfo['driverPhoto']) || 
        empty($driverInfo['signature']) || 
        empty($driverInfo['passport']) || 
        empty($driverInfo['drivingLicense']) || 
        empty($driverInfo['vehicleInsurance']) || 
        empty($driverInfo['qatarId'])){
            return response()->json([
                       'documentsUploaded'=>false,
                       'message' => 'driver Documents are not uploaded',
                   ], 400);
        }
                
                return response()->json([
                       'documentsUploaded'=>true,
                       'message' => 'driver Documents are uploaded',
                       'data'=>$driverInfo,
                   ], 200);
         
    }

   
}
