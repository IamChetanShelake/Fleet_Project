@extends('admin.layout.master')
@section('title', 'Add Driver')
@section('content')
<style>
    body { font-family: 'IBM Plex Sans', sans-serif; background: #E5EAF2; }
    .dashboard-wrapper { display:flex; min-height:100vh; margin-left:70px; background:#E5EAF2; }
    .form-container-wrapper { width:100%; }
    .form-container { padding:30px 40px; width:100%; }
    .page-header { background:#fff; border:1px solid #003B67; border-radius:10px; padding:18px 30px; margin-bottom:30px; display:flex; align-items:center; justify-content:space-between; }
    .header-left { display:flex; align-items:center; gap:15px; }
    .back-btn { background:transparent; border:none; cursor:pointer; font-size:24px; color:#003B67; display:flex; align-items:center; text-decoration:none; }
    .page-header h1 { font-size:24px; font-weight:500; color:#003B67; margin:0; }
    .driver-form { background:#fff; border:1px solid #003B67; border-radius:20px; padding:40px; }
    .form-section { margin-bottom:35px; }
    .section-header { display:flex; align-items:center; gap:10px; margin-bottom:20px; padding-bottom:10px; border-bottom:2px solid #E5EAF2; }
    .section-header i { font-size:18px; color:#003B67; }
    .section-header h2 { font-size:17px; font-weight:600; color:#003B67; margin:0; }
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px 28px; }
    .form-grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:18px 28px; }
    .form-group { display:flex; flex-direction:column; }
    .form-group.full-width { grid-column:1/-1; }
    .form-group label { font-size:13px; font-weight:500; color:#333; margin-bottom:6px; }
    .required { color:#ED5A68; }
    .form-group input, .form-group select, .form-group textarea {
        height:42px; border:1px solid #ccc; border-radius:8px; padding:0 14px;
        font-size:14px; color:#333; background:#fff; transition:border-color .3s;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline:none; border-color:#317FF1; }
    .form-group textarea { height:auto; padding:10px 14px; resize:vertical; min-height:80px; }
    .file-upload-area { border:2px dashed #ccc; border-radius:10px; padding:18px; text-align:center; cursor:pointer; background:#f8f9fa; position:relative; transition:all .3s; }
    .file-upload-area:hover { border-color:#317FF1; background:#f0f7ff; }
    .file-upload-area input[type="file"] { position:absolute; top:0; left:0; width:100%; height:100%; opacity:0; cursor:pointer; }
    .file-upload-icon { font-size:32px; color:#ccc; margin-bottom:8px; }
    .file-upload-text { color:#666; font-size:13px; }
    .file-preview { margin-top:10px; text-align:center; }
    .file-preview img { max-width:120px; max-height:120px; border-radius:8px; border:1px solid #ddd; }
    .checkbox-group { display:flex; align-items:center; gap:10px; height:42px; }
    .checkbox-group input[type="checkbox"] { width:18px; height:18px; cursor:pointer; }
    .submit-section { display:flex; justify-content:flex-end; gap:15px; margin-top:30px; padding-top:20px; border-top:1px solid #E5EAF2; }
    .btn-cancel { height:45px; padding:0 30px; border-radius:8px; border:1px solid #6C6C6C; background:#fff; color:#000; font-size:15px; cursor:pointer; text-decoration:none; display:flex; align-items:center; }
    .btn-submit { height:45px; padding:0 40px; border-radius:8px; border:none; background:#317FF1; color:#fff; font-size:15px; font-weight:500; cursor:pointer; }
    .btn-submit:hover { background:#2669cc; }
    .alternate-mobile-list { display:flex; flex-direction:column; gap:8px; }
    .alternate-mobile-item { display:flex; gap:8px; align-items:center; }
    .alternate-mobile-item input { flex:1; }
    .btn-add-alt { background:#317FF1; color:#fff; border:none; border-radius:6px; padding:6px 14px; cursor:pointer; font-size:13px; }
    .btn-remove-alt { background:#ED5A68; color:#fff; border:none; border-radius:6px; padding:6px 10px; cursor:pointer; }
</style>

<div class="dashboard-wrapper">
<div class="form-container-wrapper">
<div class="form-container">

    <div class="page-header">
        <div class="header-left">
            <a href="{{ route('admin.driving-team.index') }}" class="back-btn"><i class="fas fa-chevron-left"></i></a>
            <h1>Add New Driver</h1>
        </div>
    </div>

    @if($errors->any())
    <div style="background:#f8d7da;border:1px solid #f5c6cb;border-radius:8px;padding:15px;margin-bottom:20px;">
        <ul style="margin:0;padding-left:20px;color:#721c24;">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form class="driver-form" method="POST" action="{{ route('admin.driving-team.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- ═══════════════════════════════════════════
             SECTION 1 — Personal Information
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-user"></i><h2>Personal Information</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label>Email Address <span class="required">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" placeholder="e.g. Indian, Nepali">
                </div>
                <div class="form-group">
                    <label>Country Level</label>
                    <select name="countryLevel">
                        <option value="local" {{ old('countryLevel','local')=='local'?'selected':'' }}>Local</option>
                        <option value="international" {{ old('countryLevel')=='international'?'selected':'' }}>International</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob') }}">
                </div>
                <div class="form-group">
                    <label>Blood Group</label>
                    <select name="blood_group">
                        <option value="">Select Blood Group</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                        <option value="{{ $bg }}" {{ old('blood_group')==$bg?'selected':'' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Phone Number <span class="required">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+974 12345678" required>
                </div>
                <div class="form-group">
                    <label>Emergency Contact <span class="required">*</span></label>
                    <input type="tel" name="emergency_phone" value="{{ old('emergency_phone') }}" placeholder="Emergency number" required>
                </div>
                <div class="form-group">
                    <label>Emergency Contact Relation</label>
                    <input type="text" name="emergencyRelation" value="{{ old('emergencyRelation') }}" placeholder="e.g. Father, Spouse">
                </div>
                <div class="form-group">
                    <label>Driver Type</label>
                    <select name="driverType">
                        <option value="">Select Driver Type</option>
                        @foreach(['Truck','Pickup','Van','Car','Heavy Vehicle'] as $dt)
                        <option value="{{ $dt }}" {{ old('driverType')==$dt?'selected':'' }}>{{ $dt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group full-width">
                    <label>Address <span class="required">*</span></label>
                    <textarea name="address" placeholder="Enter full address" required>{{ old('address') }}</textarea>
                </div>
                <div class="form-group full-width">
                    <label>Alternate Mobile Numbers</label>
                    <div class="alternate-mobile-list" id="altMobileList">
                        <div class="alternate-mobile-item">
                            <input type="text" name="alternateMobile[]" placeholder="Alternate mobile number">
                            <button type="button" class="btn-add-alt" onclick="addAltMobile()"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 2 — Identity & Documents
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-id-card"></i><h2>Identity & Documents</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Qatar ID</label>
                    <input type="text" name="qatarId" value="{{ old('qatarId') }}" placeholder="Qatar ID number">
                </div>
                <div class="form-group">
                    <label>Residence ID</label>
                    <input type="text" name="residenceId" value="{{ old('residenceId') }}" placeholder="Residence ID number">
                </div>
                <div class="form-group">
                    <label>Residence Permit Status</label>
                    <select name="residencePermitStatus">
                        <option value="">Select Status</option>
                        <option value="valid" {{ old('residencePermitStatus')=='valid'?'selected':'' }}>Valid</option>
                        <option value="expired" {{ old('residencePermitStatus')=='expired'?'selected':'' }}>Expired</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Passport Number</label>
                    <input type="text" name="passport" value="{{ old('passport') }}" placeholder="Passport number">
                </div>
                <div class="form-group">
                    <label>Passport Expiry Date</label>
                    <input type="date" name="passportExpiryDate" value="{{ old('passportExpiryDate') }}">
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 3 — License Information
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-certificate"></i><h2>License Information</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Driving License No.</label>
                    <input type="text" name="drivingLicenseNo" value="{{ old('drivingLicenseNo') }}" placeholder="Driving license number">
                </div>
                <div class="form-group">
                    <label>License Category</label>
                    <input type="text" name="LicenseCategory" value="{{ old('LicenseCategory') }}" placeholder="e.g. A, B, C, D">
                </div>
                <div class="form-group">
                    <label>License Validity Date</label>
                    <input type="date" name="LicenseValidity" value="{{ old('LicenseValidity') }}">
                </div>
                <div class="form-group">
                    <label>License Expiry Date</label>
                    <input type="date" name="LicenseExpiryDate" value="{{ old('LicenseExpiryDate') }}">
                </div>
                <div class="form-group">
                    <label>License Number (Admin)</label>
                    <input type="text" name="license_number" value="{{ old('license_number') }}" placeholder="Admin license reference">
                </div>
                <div class="form-group">
                    <label>License Expiry (Admin)</label>
                    <input type="date" name="license_expiry" value="{{ old('license_expiry') }}">
                </div>
                <div class="form-group">
                    <label>License Type</label>
                    <select name="license_type">
                        <option value="">Select Type</option>
                        <option value="Light Motor Vehicle" {{ old('license_type')=='Light Motor Vehicle'?'selected':'' }}>Light Motor Vehicle</option>
                        <option value="Heavy Motor Vehicle" {{ old('license_type')=='Heavy Motor Vehicle'?'selected':'' }}>Heavy Motor Vehicle</option>
                        <option value="Transport Vehicle" {{ old('license_type')=='Transport Vehicle'?'selected':'' }}>Transport Vehicle</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Experience (Years)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years') }}" placeholder="e.g. 5" min="0" max="60">
                </div>
                <div class="form-group">
                    <label>License Expiry Alert</label>
                    <div class="checkbox-group">
                        <input type="checkbox" name="LicenseExpiryAlert" value="1" {{ old('LicenseExpiryAlert')?'checked':'' }}>
                        <span style="font-size:13px;color:#555;">Enable license expiry reminder alert</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 4 — Vehicle Information
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-truck"></i><h2>Vehicle Information</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Vehicle Brand & Model</label>
                    <input type="text" name="vehicleBrandAndModel" value="{{ old('vehicleBrandAndModel') }}" placeholder="e.g. Toyota Hilux">
                </div>
                <div class="form-group">
                    <label>Manufacture Year</label>
                    <input type="text" name="vehicleManufactureYear" value="{{ old('vehicleManufactureYear') }}" placeholder="e.g. 2020">
                </div>
                <div class="form-group">
                    <label>Registration No.</label>
                    <input type="text" name="vehicleRegstrationNo" value="{{ old('vehicleRegstrationNo') }}" placeholder="Vehicle registration number">
                </div>
                <div class="form-group">
                    <label>Fuel Type</label>
                    <select name="vehicleFuelType">
                        <option value="">Select Fuel Type</option>
                        @foreach(['Petrol','Diesel','CNG','Electric','Hybrid'] as $ft)
                        <option value="{{ $ft }}" {{ old('vehicleFuelType')==$ft?'selected':'' }}>{{ $ft }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Heavy Vehicle Permit</label>
                    <select name="heavyVehiclePermit">
                        <option value="">Select Status</option>
                        <option value="valid" {{ old('heavyVehiclePermit')=='valid'?'selected':'' }}>Valid</option>
                        <option value="expired" {{ old('heavyVehiclePermit')=='expired'?'selected':'' }}>Expired</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Insurance Expiry Date</label>
                    <input type="date" name="InsuranceExpiryDate" value="{{ old('InsuranceExpiryDate') }}">
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 5 — Gatepasses
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-key"></i><h2>Gatepasses</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>MIC Gatepass</label>
                    <select name="MicGatepass">
                        <option value="">Select</option>
                        <option value="yes" {{ old('MicGatepass')=='yes'?'selected':'' }}>Yes</option>
                        <option value="no" {{ old('MicGatepass','no')=='no'?'selected':'' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>RLC Gatepass</label>
                    <select name="RlcGatepass">
                        <option value="">Select</option>
                        <option value="yes" {{ old('RlcGatepass')=='yes'?'selected':'' }}>Yes</option>
                        <option value="no" {{ old('RlcGatepass','no')=='no'?'selected':'' }}>No</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 6 — Status & KYC
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-shield-alt"></i><h2>Status & KYC</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Duty Status</label>
                    <select name="status">
                        <option value="off_duty" {{ old('status','off_duty')=='off_duty'?'selected':'' }}>Off Duty</option>
                        <option value="on_duty" {{ old('status')=='on_duty'?'selected':'' }}>On Duty</option>
                        <option value="on_leave" {{ old('status')=='on_leave'?'selected':'' }}>On Leave</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Active Status</label>
                    <select name="activeStatus">
                        <option value="active" {{ old('activeStatus','active')=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ old('activeStatus')=='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>KYC Status</label>
                    <select name="kyc_status">
                        <option value="pending" {{ old('kyc_status','pending')=='pending'?'selected':'' }}>Pending</option>
                        <option value="under_review" {{ old('kyc_status')=='under_review'?'selected':'' }}>Under Review</option>
                        <option value="reverification_needed" {{ old('kyc_status')=='reverification_needed'?'selected':'' }}>Reverification Needed</option>
                        <option value="approved" {{ old('kyc_status')=='approved'?'selected':'' }}>Approved</option>
                        <option value="rejected" {{ old('kyc_status')=='rejected'?'selected':'' }}>Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 7 — Document Uploads
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-file-upload"></i><h2>Document Uploads</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Driver Photo</label>
                    <div class="file-upload-area">
                        <i class="fas fa-camera file-upload-icon"></i>
                        <p class="file-upload-text"><strong>Click to upload</strong> driver photo</p>
                        <p class="file-upload-text">JPG, PNG, GIF — max 5MB</p>
                        <input type="file" name="driverPhoto" accept="image/*" onchange="previewFile(this,'preview-photo')">
                    </div>
                    <div class="file-preview" id="preview-photo"></div>
                </div>
                <div class="form-group">
                    <label>Driving License (Document)</label>
                    <div class="file-upload-area">
                        <i class="fas fa-id-card file-upload-icon"></i>
                        <p class="file-upload-text"><strong>Click to upload</strong> license document</p>
                        <p class="file-upload-text">PDF, JPG, PNG — max 5MB</p>
                        <input type="file" name="drivingLicense" accept=".pdf,image/*" onchange="previewFile(this,'preview-license')">
                    </div>
                    <div class="file-preview" id="preview-license"></div>
                </div>
                <div class="form-group">
                    <label>Vehicle Insurance Document</label>
                    <div class="file-upload-area">
                        <i class="fas fa-file-contract file-upload-icon"></i>
                        <p class="file-upload-text"><strong>Click to upload</strong> insurance doc</p>
                        <p class="file-upload-text">PDF, JPG, PNG — max 5MB</p>
                        <input type="file" name="vehicleInsurance" accept=".pdf,image/*" onchange="previewFile(this,'preview-insurance')">
                    </div>
                    <div class="file-preview" id="preview-insurance"></div>
                </div>
                <div class="form-group">
                    <label>Digital Signature</label>
                    <div class="file-upload-area">
                        <i class="fas fa-signature file-upload-icon"></i>
                        <p class="file-upload-text"><strong>Click to upload</strong> signature image</p>
                        <p class="file-upload-text">JPG, PNG — max 2MB</p>
                        <input type="file" name="signature" accept="image/*" onchange="previewFile(this,'preview-signature')">
                    </div>
                    <div class="file-preview" id="preview-signature"></div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             SECTION 8 — Consent
        ═══════════════════════════════════════════ --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-check-square"></i><h2>Consent & Agreement</h2>
            </div>
            <div style="display:flex;flex-direction:column;gap:12px;">
                <div class="checkbox-group">
                    <input type="checkbox" name="consent" value="1" {{ old('consent')?'checked':'' }}>
                    <span style="font-size:14px;color:#333;">I give consent for data processing and background verification</span>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="TermsConditions" value="1" {{ old('TermsConditions')?'checked':'' }}>
                    <span style="font-size:14px;color:#333;">I agree to the Terms & Conditions</span>
                </div>
            </div>
        </div>

        <div class="submit-section">
            <a href="{{ route('admin.driving-team.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit"><i class="fas fa-save" style="margin-right:8px;"></i>Save Driver</button>
        </div>
    </form>

</div>
</div>
</div>

<script>
function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<p style="font-size:13px;color:#333;margin-top:5px;"><i class="fas fa-file-pdf" style="color:#ED5A68;"></i> ' + file.name + '</p>';
        }
    }
}

function addAltMobile() {
    const list = document.getElementById('altMobileList');
    const item = document.createElement('div');
    item.className = 'alternate-mobile-item';
    item.innerHTML = `<input type="text" name="alternateMobile[]" placeholder="Alternate mobile number">
                      <button type="button" class="btn-remove-alt" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>`;
    list.appendChild(item);
}
</script>
@endsection
