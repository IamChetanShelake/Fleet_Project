<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Region - Fleet Management System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004271;
            --secondary-color: #353535;
            --accent-color: #00a8e8;
        }

        body {
            background: linear-gradient(135deg, #090909 0%, #000000 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            width: 100%;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .form-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .form-header h2 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--accent-color);
            transform: translateX(-5px);
        }

        .back-link i {
            margin-right: 8px;
        }

        .form-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .input-group-text {
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            border: none;
            color: white;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .tax-percentage-group {
            display: none;
            margin-top: 15px;
        }

        .tax-percentage-group.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 25px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(33, 254, 162, 0.4);
            color:yellow
            margin-bottom: 20px;
        }

        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .form-icon {
            width: 60px;;
        }

        .alert {
            border-radius: 10px;
            border: none;
            height: 60px;
            background: linear-gradient(135deg, #000000 0%, #000000 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
            color: white;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="{{ route('franchises.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Regions
        </a>

        <div class="form-header">
            <div class="form-icon">
                <i class="fas fa-edit"></i>
            </div>
            <h2>Edit Region</h2>
            <p>Update franchise region details</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('franchises.update', $franchise->id) }}" method="POST" id="franchiseForm">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="country_name" class="form-label">
                    <i class="fas fa-globe me-2"></i>Country Name
                </label>
                <select class="form-select @error('country_name') is-invalid @enderror"
                        id="country_name"
                        name="country_name"
                        required>
                    <option value="">Select a country</option>
                    <!-- A -->
                    <option value="Afghanistan" data-currency="AFN" {{ $franchise->country_name == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                    <option value="Albania" data-currency="ALL" {{ $franchise->country_name == 'Albania' ? 'selected' : '' }}>Albania</option>
                    <option value="Algeria" data-currency="DZD" {{ $franchise->country_name == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                    <option value="Andorra" data-currency="EUR" {{ $franchise->country_name == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                    <option value="Angola" data-currency="AOA" {{ $franchise->country_name == 'Angola' ? 'selected' : '' }}>Angola</option>
                    <option value="Antigua and Barbuda" data-currency="XCD" {{ $franchise->country_name == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
                    <option value="Argentina" data-currency="ARS" {{ $franchise->country_name == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                    <option value="Armenia" data-currency="AMD" {{ $franchise->country_name == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                    <option value="Australia" data-currency="AUD" {{ $franchise->country_name == 'Australia' ? 'selected' : '' }}>Australia</option>
                    <option value="Austria" data-currency="EUR" {{ $franchise->country_name == 'Austria' ? 'selected' : '' }}>Austria</option>
                    <option value="Azerbaijan" data-currency="AZN" {{ $franchise->country_name == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                    <!-- B -->
                    <option value="Bahamas" data-currency="BSD" {{ $franchise->country_name == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                    <option value="Bahrain" data-currency="BHD" {{ $franchise->country_name == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                    <option value="Bangladesh" data-currency="BDT" {{ $franchise->country_name == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                    <option value="Barbados" data-currency="BBD" {{ $franchise->country_name == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                    <option value="Belarus" data-currency="BYN" {{ $franchise->country_name == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                    <option value="Belgium" data-currency="EUR" {{ $franchise->country_name == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                    <option value="Belize" data-currency="BZD" {{ $franchise->country_name == 'Belize' ? 'selected' : '' }}>Belize</option>
                    <option value="Benin" data-currency="XOF" {{ $franchise->country_name == 'Benin' ? 'selected' : '' }}>Benin</option>
                    <option value="Bhutan" data-currency="BTN" {{ $franchise->country_name == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                    <option value="Bolivia" data-currency="BOB" {{ $franchise->country_name == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                    <option value="Bosnia and Herzegovina" data-currency="BAM" {{ $franchise->country_name == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                    <option value="Botswana" data-currency="BWP" {{ $franchise->country_name == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                    <option value="Brazil" data-currency="BRL" {{ $franchise->country_name == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                    <option value="Brunei" data-currency="BND" {{ $franchise->country_name == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                    <option value="Bulgaria" data-currency="BGN" {{ $franchise->country_name == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                    <option value="Burkina Faso" data-currency="XOF" {{ $franchise->country_name == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                    <option value="Burundi" data-currency="BIF" {{ $franchise->country_name == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                    <!-- C -->
                    <option value="Cambodia" data-currency="KHR" {{ $franchise->country_name == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                    <option value="Cameroon" data-currency="XAF" {{ $franchise->country_name == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                    <option value="Canada" data-currency="CAD" {{ $franchise->country_name == 'Canada' ? 'selected' : '' }}>Canada</option>
                    <option value="Cape Verde" data-currency="CVE" {{ $franchise->country_name == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                    <option value="Central African Republic" data-currency="XAF" {{ $franchise->country_name == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                    <option value="Chad" data-currency="XAF" {{ $franchise->country_name == 'Chad' ? 'selected' : '' }}>Chad</option>
                    <option value="Chile" data-currency="CLP" {{ $franchise->country_name == 'Chile' ? 'selected' : '' }}>Chile</option>
                    <option value="China" data-currency="CNY" {{ $franchise->country_name == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Colombia" data-currency="COP" {{ $franchise->country_name == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                    <option value="Comoros" data-currency="KMF" {{ $franchise->country_name == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                    <option value="Congo" data-currency="XAF" {{ $franchise->country_name == 'Congo' ? 'selected' : '' }}>Congo</option>
                    <option value="Costa Rica" data-currency="CRC" {{ $franchise->country_name == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                    <option value="Croatia" data-currency="EUR" {{ $franchise->country_name == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                    <option value="Cuba" data-currency="CUP" {{ $franchise->country_name == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                    <option value="Cyprus" data-currency="EUR" {{ $franchise->country_name == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                    <option value="Czech Republic" data-currency="CZK" {{ $franchise->country_name == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                    <!-- D -->
                    <option value="Denmark" data-currency="DKK" {{ $franchise->country_name == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                    <option value="Djibouti" data-currency="DJF" {{ $franchise->country_name == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                    <option value="Dominica" data-currency="XCD" {{ $franchise->country_name == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                    <option value="Dominican Republic" data-currency="DOP" {{ $franchise->country_name == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                    <!-- E -->
                    <option value="Ecuador" data-currency="USD" {{ $franchise->country_name == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                    <option value="Egypt" data-currency="EGP" {{ $franchise->country_name == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                    <option value="El Salvador" data-currency="USD" {{ $franchise->country_name == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                    <option value="Equatorial Guinea" data-currency="XAF" {{ $franchise->country_name == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                    <option value="Eritrea" data-currency="ERN" {{ $franchise->country_name == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                    <option value="Estonia" data-currency="EUR" {{ $franchise->country_name == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                    <option value="Eswatini" data-currency="SZL" {{ $franchise->country_name == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                    <option value="Ethiopia" data-currency="ETB" {{ $franchise->country_name == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                    <!-- F -->
                    <option value="Fiji" data-currency="FJD" {{ $franchise->country_name == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                    <option value="Finland" data-currency="EUR" {{ $franchise->country_name == 'Finland' ? 'selected' : '' }}>Finland</option>
                    <option value="France" data-currency="EUR" {{ $franchise->country_name == 'France' ? 'selected' : '' }}>France</option>
                    <!-- G -->
                    <option value="Gabon" data-currency="XAF" {{ $franchise->country_name == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                    <option value="Gambia" data-currency="GMD" {{ $franchise->country_name == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                    <option value="Georgia" data-currency="GEL" {{ $franchise->country_name == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                    <option value="Germany" data-currency="EUR" {{ $franchise->country_name == 'Germany' ? 'selected' : '' }}>Germany</option>
                    <option value="Ghana" data-currency="GHS" {{ $franchise->country_name == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                    <option value="Greece" data-currency="EUR" {{ $franchise->country_name == 'Greece' ? 'selected' : '' }}>Greece</option>
                    <option value="Grenada" data-currency="XCD" {{ $franchise->country_name == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                    <option value="Guatemala" data-currency="GTQ" {{ $franchise->country_name == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                    <option value="Guinea" data-currency="GNF" {{ $franchise->country_name == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                    <option value="Guinea-Bissau" data-currency="XOF" {{ $franchise->country_name == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                    <option value="Guyana" data-currency="GYD" {{ $franchise->country_name == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                    <!-- H -->
                    <option value="Haiti" data-currency="HTG" {{ $franchise->country_name == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                    <option value="Honduras" data-currency="HNL" {{ $franchise->country_name == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                    <option value="Hungary" data-currency="HUF" {{ $franchise->country_name == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                    <!-- I -->
                    <option value="Iceland" data-currency="ISK" {{ $franchise->country_name == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                    <option value="India" data-currency="INR" {{ $franchise->country_name == 'India' ? 'selected' : '' }}>India</option>
                    <option value="Indonesia" data-currency="IDR" {{ $franchise->country_name == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                    <option value="Iran" data-currency="IRR" {{ $franchise->country_name == 'Iran' ? 'selected' : '' }}>Iran</option>
                    <option value="Iraq" data-currency="IQD" {{ $franchise->country_name == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                    <option value="Ireland" data-currency="EUR" {{ $franchise->country_name == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                    <option value="Israel" data-currency="ILS" {{ $franchise->country_name == 'Israel' ? 'selected' : '' }}>Israel</option>
                    <option value="Italy" data-currency="EUR" {{ $franchise->country_name == 'Italy' ? 'selected' : '' }}>Italy</option>
                    <option value="Ivory Coast" data-currency="XOF" {{ $franchise->country_name == 'Ivory Coast' ? 'selected' : '' }}>Ivory Coast</option>
                    <!-- J -->
                    <option value="Jamaica" data-currency="JMD" {{ $franchise->country_name == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                    <option value="Japan" data-currency="JPY" {{ $franchise->country_name == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="Jordan" data-currency="JOD" {{ $franchise->country_name == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                    <!-- K -->
                    <option value="Kazakhstan" data-currency="KZT" {{ $franchise->country_name == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                    <option value="Kenya" data-currency="KES" {{ $franchise->country_name == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                    <option value="Kiribati" data-currency="AUD" {{ $franchise->country_name == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                    <option value="Kosovo" data-currency="EUR" {{ $franchise->country_name == 'Kosovo' ? 'selected' : '' }}>Kosovo</option>
                    <option value="Kuwait" data-currency="KWD" {{ $franchise->country_name == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                    <option value="Kyrgyzstan" data-currency="KGS" {{ $franchise->country_name == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                    <!-- L -->
                    <option value="Laos" data-currency="LAK" {{ $franchise->country_name == 'Laos' ? 'selected' : '' }}>Laos</option>
                    <option value="Latvia" data-currency="EUR" {{ $franchise->country_name == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                    <option value="Lebanon" data-currency="LBP" {{ $franchise->country_name == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                    <option value="Lesotho" data-currency="LSL" {{ $franchise->country_name == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                    <option value="Liberia" data-currency="LRD" {{ $franchise->country_name == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                    <option value="Libya" data-currency="LYD" {{ $franchise->country_name == 'Libya' ? 'selected' : '' }}>Libya</option>
                    <option value="Liechtenstein" data-currency="CHF" {{ $franchise->country_name == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                    <option value="Lithuania" data-currency="EUR" {{ $franchise->country_name == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                    <option value="Luxembourg" data-currency="EUR" {{ $franchise->country_name == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                    <!-- M -->
                    <option value="Madagascar" data-currency="MGA" {{ $franchise->country_name == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                    <option value="Malawi" data-currency="MWK" {{ $franchise->country_name == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                    <option value="Malaysia" data-currency="MYR" {{ $franchise->country_name == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                    <option value="Maldives" data-currency="MVR" {{ $franchise->country_name == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                    <option value="Mali" data-currency="XOF" {{ $franchise->country_name == 'Mali' ? 'selected' : '' }}>Mali</option>
                    <option value="Malta" data-currency="EUR" {{ $franchise->country_name == 'Malta' ? 'selected' : '' }}>Malta</option>
                    <option value="Marshall Islands" data-currency="USD" {{ $franchise->country_name == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                    <option value="Mauritania" data-currency="MRU" {{ $franchise->country_name == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                    <option value="Mauritius" data-currency="MUR" {{ $franchise->country_name == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                    <option value="Mexico" data-currency="MXN" {{ $franchise->country_name == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                    <option value="Micronesia" data-currency="USD" {{ $franchise->country_name == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                    <option value="Moldova" data-currency="MDL" {{ $franchise->country_name == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                    <option value="Monaco" data-currency="EUR" {{ $franchise->country_name == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                    <option value="Mongolia" data-currency="MNT" {{ $franchise->country_name == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                    <option value="Montenegro" data-currency="EUR" {{ $franchise->country_name == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                    <option value="Morocco" data-currency="MAD" {{ $franchise->country_name == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                    <option value="Mozambique" data-currency="MZN" {{ $franchise->country_name == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                    <option value="Myanmar" data-currency="MMK" {{ $franchise->country_name == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                    <!-- N -->
                    <option value="Namibia" data-currency="NAD" {{ $franchise->country_name == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                    <option value="Nauru" data-currency="AUD" {{ $franchise->country_name == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                    <option value="Nepal" data-currency="NPR" {{ $franchise->country_name == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                    <option value="Netherlands" data-currency="EUR" {{ $franchise->country_name == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                    <option value="New Zealand" data-currency="NZD" {{ $franchise->country_name == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                    <option value="Nicaragua" data-currency="NIO" {{ $franchise->country_name == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                    <option value="Niger" data-currency="XOF" {{ $franchise->country_name == 'Niger' ? 'selected' : '' }}>Niger</option>
                    <option value="Nigeria" data-currency="NGN" {{ $franchise->country_name == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                    <option value="North Korea" data-currency="KPW" {{ $franchise->country_name == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                    <option value="North Macedonia" data-currency="MKD" {{ $franchise->country_name == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                    <option value="Norway" data-currency="NOK" {{ $franchise->country_name == 'Norway' ? 'selected' : '' }}>Norway</option>
                    <!-- O -->
                    <option value="Oman" data-currency="OMR" {{ $franchise->country_name == 'Oman' ? 'selected' : '' }}>Oman</option>
                    <!-- P -->
                    <option value="Pakistan" data-currency="PKR" {{ $franchise->country_name == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                    <option value="Palau" data-currency="USD" {{ $franchise->country_name == 'Palau' ? 'selected' : '' }}>Palau</option>
                    <option value="Palestine" data-currency="ILS" {{ $franchise->country_name == 'Palestine' ? 'selected' : '' }}>Palestine</option>
                    <option value="Panama" data-currency="PAB" {{ $franchise->country_name == 'Panama' ? 'selected' : '' }}>Panama</option>
                    <option value="Papua New Guinea" data-currency="PGK" {{ $franchise->country_name == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                    <option value="Paraguay" data-currency="PYG" {{ $franchise->country_name == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                    <option value="Peru" data-currency="PEN" {{ $franchise->country_name == 'Peru' ? 'selected' : '' }}>Peru</option>
                    <option value="Philippines" data-currency="PHP" {{ $franchise->country_name == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                    <option value="Poland" data-currency="PLN" {{ $franchise->country_name == 'Poland' ? 'selected' : '' }}>Poland</option>
                    <option value="Portugal" data-currency="EUR" {{ $franchise->country_name == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                    <!-- Q -->
                    <option value="Qatar" data-currency="QAR" {{ $franchise->country_name == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                    <!-- R -->
                    <option value="Romania" data-currency="RON" {{ $franchise->country_name == 'Romania' ? 'selected' : '' }}>Romania</option>
                    <option value="Russia" data-currency="RUB" {{ $franchise->country_name == 'Russia' ? 'selected' : '' }}>Russia</option>
                    <option value="Rwanda" data-currency="RWF" {{ $franchise->country_name == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                    <!-- S -->
                    <option value="Saint Kitts and Nevis" data-currency="XCD" {{ $franchise->country_name == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" data-currency="XCD" {{ $franchise->country_name == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" data-currency="XCD" {{ $franchise->country_name == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                    <option value="Samoa" data-currency="WST" {{ $franchise->country_name == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                    <option value="San Marino" data-currency="EUR" {{ $franchise->country_name == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                    <option value="Sao Tome and Principe" data-currency="STN" {{ $franchise->country_name == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                    <option value="Saudi Arabia" data-currency="SAR" {{ $franchise->country_name == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                    <option value="Senegal" data-currency="XOF" {{ $franchise->country_name == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                    <option value="Serbia" data-currency="RSD" {{ $franchise->country_name == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                    <option value="Seychelles" data-currency="SCR" {{ $franchise->country_name == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                    <option value="Sierra Leone" data-currency="SLL" {{ $franchise->country_name == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                    <option value="Singapore" data-currency="SGD" {{ $franchise->country_name == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                    <option value="Slovakia" data-currency="EUR" {{ $franchise->country_name == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                    <option value="Slovenia" data-currency="EUR" {{ $franchise->country_name == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                    <option value="Solomon Islands" data-currency="SBD" {{ $franchise->country_name == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                    <option value="Somalia" data-currency="SOS" {{ $franchise->country_name == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                    <option value="South Africa" data-currency="ZAR" {{ $franchise->country_name == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                    <option value="South Korea" data-currency="KRW" {{ $franchise->country_name == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                    <option value="South Sudan" data-currency="SSP" {{ $franchise->country_name == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                    <option value="Spain" data-currency="EUR" {{ $franchise->country_name == 'Spain' ? 'selected' : '' }}>Spain</option>
                    <option value="Sri Lanka" data-currency="LKR" {{ $franchise->country_name == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                    <option value="Sudan" data-currency="SDG" {{ $franchise->country_name == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                    <option value="Suriname" data-currency="SRD" {{ $franchise->country_name == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                    <option value="Sweden" data-currency="SEK" {{ $franchise->country_name == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                    <option value="Switzerland" data-currency="CHF" {{ $franchise->country_name == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                    <option value="Syria" data-currency="SYP" {{ $franchise->country_name == 'Syria' ? 'selected' : '' }}>Syria</option>
                    <!-- T -->
                    <option value="Taiwan" data-currency="TWD" {{ $franchise->country_name == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                    <option value="Tajikistan" data-currency="TJS" {{ $franchise->country_name == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                    <option value="Tanzania" data-currency="TZS" {{ $franchise->country_name == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                    <option value="Thailand" data-currency="THB" {{ $franchise->country_name == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                    <option value="Timor-Leste" data-currency="USD" {{ $franchise->country_name == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
                    <option value="Togo" data-currency="XOF" {{ $franchise->country_name == 'Togo' ? 'selected' : '' }}>Togo</option>
                    <option value="Tonga" data-currency="TOP" {{ $franchise->country_name == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                    <option value="Trinidad and Tobago" data-currency="TTD" {{ $franchise->country_name == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                    <option value="Tunisia" data-currency="TND" {{ $franchise->country_name == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                    <option value="Turkey" data-currency="TRY" {{ $franchise->country_name == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                    <option value="Turkmenistan" data-currency="TMT" {{ $franchise->country_name == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                    <option value="Tuvalu" data-currency="AUD" {{ $franchise->country_name == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                    <!-- U -->
                    <option value="Uganda" data-currency="UGX" {{ $franchise->country_name == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                    <option value="Ukraine" data-currency="UAH" {{ $franchise->country_name == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                    <option value="United Arab Emirates" data-currency="AED" {{ $franchise->country_name == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                    <option value="United Kingdom" data-currency="GBP" {{ $franchise->country_name == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="United States" data-currency="USD" {{ $franchise->country_name == 'United States' ? 'selected' : '' }}>United States</option>
                    <option value="Uruguay" data-currency="UYU" {{ $franchise->country_name == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                    <option value="Uzbekistan" data-currency="UZS" {{ $franchise->country_name == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                    <!-- V -->
                    <option value="Vanuatu" data-currency="VUV" {{ $franchise->country_name == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                    <option value="Vatican City" data-currency="EUR" {{ $franchise->country_name == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
                    <option value="Venezuela" data-currency="VES" {{ $franchise->country_name == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                    <option value="Vietnam" data-currency="VND" {{ $franchise->country_name == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                    <!-- Y -->
                    <option value="Yemen" data-currency="YER" {{ $franchise->country_name == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                    <!-- Z -->
                    <option value="Zambia" data-currency="ZMW" {{ $franchise->country_name == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                    <option value="Zimbabwe" data-currency="ZWL" {{ $franchise->country_name == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                </select>
                @error('country_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="currency" class="form-label">
                    <i class="fas fa-money-bill-wave me-2"></i>Currency
                </label>
                <input type="text"
                       class="form-control @error('currency') is-invalid @enderror"
                       id="currency"
                       name="currency"
                       value="{{ old('currency', $franchise->currency) }}"
                       placeholder="Currency will be auto-filled"
                       maxlength="10"
                       readonly
                       required>
                @error('currency')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="has_tax" class="form-label">
                    <i class="fas fa-percentage me-2"></i>Tax Configuration
                </label>
                <select class="form-select @error('has_tax') is-invalid @enderror"
                        id="has_tax"
                        name="has_tax"
                        required>
                    <option value="">Select tax option</option>
                    <option value="yes" {{ old('has_tax', $franchise->has_tax ? 'yes' : 'no') == 'yes' ? 'selected' : '' }}>Yes, apply tax</option>
                    <option value="no" {{ old('has_tax', $franchise->has_tax ? 'yes' : 'no') == 'no' ? 'selected' : '' }}>No tax</option>
                </select>
                @error('has_tax')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="tax-percentage-group {{ old('has_tax', $franchise->has_tax ? 'yes' : 'no') == 'yes' ? 'show' : '' }}" id="taxPercentageGroup">
                <label for="tax_percentage" class="form-label">
                    <i class="fas fa-calculator me-2"></i>Tax Percentage
                </label>
                <div class="input-group">
                    <input type="number"
                           class="form-control @error('tax_percentage') is-invalid @enderror"
                           id="tax_percentage"
                           name="tax_percentage"
                           value="{{ old('tax_percentage', $franchise->tax_percentage) }}"
                           placeholder="Enter tax percentage"
                           min="0"
                           max="100"
                           step="0.01">
                    <span class="input-group-text">%</span>
                </div>
                @error('tax_percentage')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="fas fa-save me-2"></i> Update Region
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-fill currency when country is selected
        document.getElementById('country_name').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const currency = selectedOption.getAttribute('data-currency');
            const currencyInput = document.getElementById('currency');

            if (currency) {
                currencyInput.value = currency;
                // Add a subtle animation
                currencyInput.style.transition = 'all 0.3s ease';
                currencyInput.style.backgroundColor = '#e8f5e9';
                setTimeout(() => {
                    currencyInput.style.backgroundColor = '';
                }, 1000);
            } else {
                currencyInput.value = '';
            }
        });

        // Tax configuration toggle
        document.getElementById('has_tax').addEventListener('change', function() {
            const taxPercentageGroup = document.getElementById('taxPercentageGroup');
            const taxPercentageInput = document.getElementById('tax_percentage');

            if (this.value === 'yes') {
                taxPercentageGroup.classList.add('show');
                taxPercentageInput.required = true;
            } else {
                taxPercentageGroup.classList.remove('show');
                taxPercentageInput.required = false;
                taxPercentageInput.value = '0';
            }
        });

        // Trigger on page load if old value exists
        document.addEventListener('DOMContentLoaded', function() {
            const hasTaxSelect = document.getElementById('has_tax');
            if (hasTaxSelect.value === 'yes') {
                document.getElementById('tax_percentage').required = true;
            }

            // Auto-fill currency on page load if country is already selected
            const countrySelect = document.getElementById('country_name');
            if (countrySelect.value) {
                const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                const currency = selectedOption.getAttribute('data-currency');
                if (currency) {
                    document.getElementById('currency').value = currency;
                }
            }
        });
    </script>
</body>
</html>