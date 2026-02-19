<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrivingTeamController extends Controller
{
    /** List all drivers with filters + pagination */
    public function index(Request $request)
    {
        $query = Driver::orderBy('created_at', 'desc');

        // Search: name, email, phone, driver_id, drivingLicenseNo, license_number
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('driver_id', 'like', "%{$s}%")
                  ->orWhere('drivingLicenseNo', 'like', "%{$s}%")
                  ->orWhere('license_number', 'like', "%{$s}%")
                  ->orWhere('qatarId', 'like', "%{$s}%");
            });
        }

        // Duty status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Active status filter
        if ($request->filled('activeStatus')) {
            $query->where('activeStatus', $request->activeStatus);
        }

        // KYC status filter
        if ($request->filled('kyc_status')) {
            $query->where('kyc_status', $request->kyc_status);
        }

        // Country level filter
        if ($request->filled('countryLevel')) {
            $query->where('countryLevel', $request->countryLevel);
        }

        $drivingTeams = $query->paginate(20)->withQueryString();

        return view('admin.driving-team.index', compact('drivingTeams'));
    }

    /** Show create form */
    public function create()
    {
        return view('admin.driving-team.create');
    }

    /** Store new driver */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Personal
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:drivers,email',
            'nationality'           => 'nullable|string|max:255',
            'countryLevel'          => 'nullable|in:local,international',
            'dob'                   => 'nullable|date',
            'blood_group'           => 'nullable|string|max:10',
            'phone'                 => 'required|string|max:30',
            'alternateMobile'       => 'nullable|array',
            'alternateMobile.*'     => 'string|max:30',
            'emergency_phone'       => 'required|string|max:30',
            'emergencyRelation'     => 'nullable|string|max:255',
            'address'               => 'required|string',
            // Identity
            'qatarId'               => 'nullable|string|max:255',
            'residenceId'           => 'nullable|string|max:255',
            'residencePermitStatus' => 'nullable|in:valid,expired',
            'passport'              => 'nullable|string|max:255',
            'passportExpiryDate'    => 'nullable|date',
            'driverType'            => 'nullable|string|max:255',
            // License
            'drivingLicenseNo'      => 'nullable|string|max:255',
            'LicenseCategory'       => 'nullable|string|max:255',
            'LicenseValidity'       => 'nullable|date',
            'LicenseExpiryDate'     => 'nullable|date',
            'LicenseExpiryAlert'    => 'nullable|boolean',
            'license_number'        => 'nullable|string|max:255|unique:drivers,license_number',
            'license_expiry'        => 'nullable|date',
            'license_type'          => 'nullable|string|max:255',
            'experience_years'      => 'nullable|integer|min:0|max:60',
            // Vehicle
            'vehicleBrandAndModel'  => 'nullable|string|max:255',
            'vehicleManufactureYear'=> 'nullable|string|max:10',
            'vehicleRegstrationNo'  => 'nullable|string|max:255',
            'vehicleFuelType'       => 'nullable|string|max:100',
            'heavyVehiclePermit'    => 'nullable|in:valid,expired',
            'InsuranceExpiryDate'   => 'nullable|date',
            // Gatepasses
            'MicGatepass'           => 'nullable|in:yes,no',
            'RlcGatepass'           => 'nullable|in:yes,no',
            // Files
            'driverPhoto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'drivingLicense'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'vehicleInsurance'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'signature'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Status
            'status'                => 'nullable|in:on_duty,off_duty,on_leave',
            'activeStatus'          => 'nullable|in:active,inactive',
            'kyc_status'            => 'nullable|in:pending,under_review,reverification_needed,approved,rejected',
            // Consent
            'consent'               => 'nullable|boolean',
            'TermsConditions'       => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'name', 'email', 'nationality', 'countryLevel', 'dob', 'blood_group',
            'phone', 'emergency_phone', 'emergencyRelation', 'address',
            'qatarId', 'residenceId', 'residencePermitStatus', 'passport', 'passportExpiryDate',
            'driverType', 'drivingLicenseNo', 'LicenseCategory', 'LicenseValidity',
            'LicenseExpiryDate', 'license_number', 'license_expiry', 'license_type', 'experience_years',
            'vehicleBrandAndModel', 'vehicleManufactureYear', 'vehicleRegstrationNo',
            'vehicleFuelType', 'heavyVehiclePermit', 'InsuranceExpiryDate',
            'MicGatepass', 'RlcGatepass',
        ]);

        // Checkboxes / booleans
        $data['LicenseExpiryAlert'] = $request->boolean('LicenseExpiryAlert');
        $data['consent']            = $request->boolean('consent');
        $data['TermsConditions']    = $request->boolean('TermsConditions');

        // JSON array: alternateMobile
        $data['alternateMobile'] = $request->alternateMobile ?? [];

        // Defaults
        $data['status']      = $request->input('status', 'off_duty');
        $data['activeStatus']= $request->input('activeStatus', 'active');
        $data['kyc_status']  = $request->input('kyc_status', 'approved'); // Admin-created drivers are auto-approved
        $data['createdBy']   = 'admin';

        // File uploads
        if ($request->hasFile('driverPhoto') && $request->file('driverPhoto')->isValid()) {
            $file = $request->file('driverPhoto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('driver_photos'), $filename);
            $data['driverPhoto']  = 'driver_photos/' . $filename;
            $data['avatar_path']  = 'driver_photos/' . $filename;
        }

        if ($request->hasFile('drivingLicense') && $request->file('drivingLicense')->isValid()) {
            $file = $request->file('drivingLicense');
            $filename = time() . '_dl_' . $file->getClientOriginalName();
            $file->move(public_path('license_photos'), $filename);
            $data['drivingLicense'] = 'license_photos/' . $filename;
        }

        if ($request->hasFile('vehicleInsurance') && $request->file('vehicleInsurance')->isValid()) {
            $file = $request->file('vehicleInsurance');
            $filename = time() . '_ins_' . $file->getClientOriginalName();
            $file->move(public_path('vehicle_documents'), $filename);
            $data['vehicleInsurance'] = 'vehicle_documents/' . $filename;
        }

        if ($request->hasFile('signature') && $request->file('signature')->isValid()) {
            $file = $request->file('signature');
            $filename = time() . '_sig_' . $file->getClientOriginalName();
            $file->move(public_path('driver_photos'), $filename);
            $data['signature'] = 'driver_photos/' . $filename;
        }

        Driver::create($data);

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver created successfully.');
    }

    /** Show driver details */
    public function show(string $id)
    {
        $drivingTeam = Driver::findOrFail($id);
        return view('admin.driving-team.show', compact('drivingTeam'));
    }

    /** Show edit form */
    public function edit(string $id)
    {
        $drivingTeam = Driver::findOrFail($id);
        return view('admin.driving-team.edit', compact('drivingTeam'));
    }

    /** Update driver */
    public function update(Request $request, string $id)
    {
        $drivingTeam = Driver::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // Personal
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:drivers,email,' . $id,
            'nationality'           => 'nullable|string|max:255',
            'countryLevel'          => 'nullable|in:local,international',
            'dob'                   => 'nullable|date',
            'blood_group'           => 'nullable|string|max:10',
            'phone'                 => 'required|string|max:30',
            'alternateMobile'       => 'nullable|array',
            'alternateMobile.*'     => 'string|max:30',
            'emergency_phone'       => 'required|string|max:30',
            'emergencyRelation'     => 'nullable|string|max:255',
            'address'               => 'required|string',
            // Identity
            'qatarId'               => 'nullable|string|max:255',
            'residenceId'           => 'nullable|string|max:255',
            'residencePermitStatus' => 'nullable|in:valid,expired',
            'passport'              => 'nullable|string|max:255',
            'passportExpiryDate'    => 'nullable|date',
            'driverType'            => 'nullable|string|max:255',
            // License
            'drivingLicenseNo'      => 'nullable|string|max:255',
            'LicenseCategory'       => 'nullable|string|max:255',
            'LicenseValidity'       => 'nullable|date',
            'LicenseExpiryDate'     => 'nullable|date',
            'LicenseExpiryAlert'    => 'nullable|boolean',
            'license_number'        => 'nullable|string|max:255|unique:drivers,license_number,' . $id,
            'license_expiry'        => 'nullable|date',
            'license_type'          => 'nullable|string|max:255',
            'experience_years'      => 'nullable|integer|min:0|max:60',
            // Vehicle
            'vehicleBrandAndModel'  => 'nullable|string|max:255',
            'vehicleManufactureYear'=> 'nullable|string|max:10',
            'vehicleRegstrationNo'  => 'nullable|string|max:255',
            'vehicleFuelType'       => 'nullable|string|max:100',
            'heavyVehiclePermit'    => 'nullable|in:valid,expired',
            'InsuranceExpiryDate'   => 'nullable|date',
            // Gatepasses
            'MicGatepass'           => 'nullable|in:yes,no',
            'RlcGatepass'           => 'nullable|in:yes,no',
            // Files
            'driverPhoto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'drivingLicense'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'vehicleInsurance'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'signature'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Status
            'status'                => 'nullable|in:on_duty,off_duty,on_leave',
            'activeStatus'          => 'nullable|in:active,inactive',
            'kyc_status'            => 'nullable|in:pending,under_review,reverification_needed,approved,rejected',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'name', 'email', 'nationality', 'countryLevel', 'dob', 'blood_group',
            'phone', 'emergency_phone', 'emergencyRelation', 'address',
            'qatarId', 'residenceId', 'residencePermitStatus', 'passport', 'passportExpiryDate',
            'driverType', 'drivingLicenseNo', 'LicenseCategory', 'LicenseValidity',
            'LicenseExpiryDate', 'license_number', 'license_expiry', 'license_type', 'experience_years',
            'vehicleBrandAndModel', 'vehicleManufactureYear', 'vehicleRegstrationNo',
            'vehicleFuelType', 'heavyVehiclePermit', 'InsuranceExpiryDate',
            'MicGatepass', 'RlcGatepass', 'status', 'activeStatus', 'kyc_status',
        ]);

        // Checkboxes / booleans
        $data['LicenseExpiryAlert'] = $request->boolean('LicenseExpiryAlert');
        $data['consent']            = $request->boolean('consent');
        $data['TermsConditions']    = $request->boolean('TermsConditions');

        // JSON array: alternateMobile
        $data['alternateMobile'] = $request->alternateMobile ?? [];

        // Driver photo
        if ($request->hasFile('driverPhoto') && $request->file('driverPhoto')->isValid()) {
            // Delete old photo
            if ($drivingTeam->avatar_path && file_exists(public_path($drivingTeam->avatar_path))) {
                unlink(public_path($drivingTeam->avatar_path));
            }
            $file = $request->file('driverPhoto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('driver_photos'), $filename);
            $data['driverPhoto'] = 'driver_photos/' . $filename;
            $data['avatar_path'] = 'driver_photos/' . $filename;
        }

        // Driving license file
        if ($request->hasFile('drivingLicense') && $request->file('drivingLicense')->isValid()) {
            if ($drivingTeam->drivingLicense && file_exists(public_path($drivingTeam->drivingLicense))) {
                unlink(public_path($drivingTeam->drivingLicense));
            }
            $file = $request->file('drivingLicense');
            $filename = time() . '_dl_' . $file->getClientOriginalName();
            $file->move(public_path('license_photos'), $filename);
            $data['drivingLicense'] = 'license_photos/' . $filename;
        }

        // Vehicle insurance file
        if ($request->hasFile('vehicleInsurance') && $request->file('vehicleInsurance')->isValid()) {
            if ($drivingTeam->vehicleInsurance && file_exists(public_path($drivingTeam->vehicleInsurance))) {
                unlink(public_path($drivingTeam->vehicleInsurance));
            }
            $file = $request->file('vehicleInsurance');
            $filename = time() . '_ins_' . $file->getClientOriginalName();
            $file->move(public_path('vehicle_documents'), $filename);
            $data['vehicleInsurance'] = 'vehicle_documents/' . $filename;
        }

        // Signature file
        if ($request->hasFile('signature') && $request->file('signature')->isValid()) {
            if ($drivingTeam->signature && file_exists(public_path($drivingTeam->signature))) {
                unlink(public_path($drivingTeam->signature));
            }
            $file = $request->file('signature');
            $filename = time() . '_sig_' . $file->getClientOriginalName();
            $file->move(public_path('driver_photos'), $filename);
            $data['signature'] = 'driver_photos/' . $filename;
        }

        $drivingTeam->update($data);

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver updated successfully.');
    }

    /** Delete driver */
    public function destroy(string $id)
    {
        $drivingTeam = Driver::findOrFail($id);

        foreach (['avatar_path', 'drivingLicense', 'vehicleInsurance', 'signature'] as $fileField) {
            if ($drivingTeam->$fileField && file_exists(public_path($drivingTeam->$fileField))) {
                unlink(public_path($drivingTeam->$fileField));
            }
        }

        $drivingTeam->delete();

        return redirect()->route('admin.driving-team.index')->with('success', 'Driver deleted successfully.');
    }

    /** Approve KYC */
    public function approveKyc(string $id)
    {
        Driver::findOrFail($id)->update(['kyc_status' => 'approved']);
        return redirect()->route('admin.driving-team.index')->with('success', 'Driver KYC approved successfully.');
    }

    /** Reject KYC */
    public function rejectKyc(string $id)
    {
        Driver::findOrFail($id)->update(['kyc_status' => 'rejected']);
        return redirect()->route('admin.driving-team.index')->with('success', 'Driver KYC rejected.');
    }

    /** Toggle on_duty / off_duty */
    public function toggleStatus(string $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->update(['status' => $driver->status === 'on_duty' ? 'off_duty' : 'on_duty']);
        return redirect()->route('admin.driving-team.index')->with('success', 'Driver status updated.');
    }
}
