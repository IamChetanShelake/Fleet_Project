<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Region - Fleet Management System</title>
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
            background: linear-gradient(135deg, #000000 0%, #090909 100%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .form-icon {
            width: 60px;
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
                <i class="fas fa-plus"></i>
            </div>
            <h2>Add New Region</h2>
            <p>Configure a new franchise region</p>
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

        <form action="{{ route('franchises.store') }}" method="POST" id="franchiseForm">
            @csrf

            <div class="mb-4">
                <label for="country_name" class="form-label">
                    <i class="fas fa-globe me-2"></i>Country Name
                </label>
                <select class="form-select @error('country_name') is-invalid @enderror"
                        id="country_name"
                        name="country_name"
                        required
                        onchange="updateCurrencyAndTax(this)">
                    <option value="">Select a country</option>
                    <!-- A -->
                    <option value="Afghanistan" data-currency="AFN" data-tax-name="Afghanistan Tax" data-tax-rate="10">Afghanistan</option>
                    <option value="Albania" data-currency="ALL" data-tax-name="Albanian VAT" data-tax-rate="20">Albania</option>
                    <option value="Algeria" data-currency="DZD" data-tax-name="Algerian VAT" data-tax-rate="19">Algeria</option>
                    <option value="Andorra" data-currency="EUR" data-tax-name="Andorra VAT" data-tax-rate="4.5">Andorra</option>
                    <option value="Angola" data-currency="AOA" data-tax-name="Angola VAT" data-tax-rate="14">Angola</option>
                    <option value="Antigua and Barbuda" data-currency="XCD" data-tax-name="Antigua VAT" data-tax-rate="15">Antigua and Barbuda</option>
                    <option value="Argentina" data-currency="ARS" data-tax-name="Argentina VAT (IVA)" data-tax-rate="21">Argentina</option>
                    <option value="Armenia" data-currency="AMD" data-tax-name="Armenian VAT" data-tax-rate="20">Armenia</option>
                    <option value="Australia" data-currency="AUD" data-tax-name="Australian GST" data-tax-rate="10">Australia</option>
                    <option value="Austria" data-currency="EUR" data-tax-name="Austrian VAT" data-tax-rate="20">Austria</option>
                    <option value="Azerbaijan" data-currency="AZN" data-tax-name="Azerbaijan VAT" data-tax-rate="18">Azerbaijan</option>
                    <!-- B -->
                    <option value="Bahamas" data-currency="BSD" data-tax-name="Bahamas VAT" data-tax-rate="12">Bahamas</option>
                    <option value="Bahrain" data-currency="BHD" data-tax-name="Bahrain VAT" data-tax-rate="10">Bahrain</option>
                    <option value="Bangladesh" data-currency="BDT" data-tax-name="Bangladesh VAT" data-tax-rate="15">Bangladesh</option>
                    <option value="Barbados" data-currency="BBD" data-tax-name="Barbados VAT" data-tax-rate="17.5">Barbados</option>
                    <option value="Belarus" data-currency="BYN" data-tax-name="Belarusian VAT" data-tax-rate="20">Belarus</option>
                    <option value="Belgium" data-currency="EUR" data-tax-name="Belgian VAT" data-tax-rate="21">Belgium</option>
                    <option value="Belize" data-currency="BZD" data-tax-name="Belize GST" data-tax-rate="12.5">Belize</option>
                    <option value="Benin" data-currency="XOF" data-tax-name="Benin VAT" data-tax-rate="18">Benin</option>
                    <option value="Bhutan" data-currency="BTN" data-tax-name="Bhutan GST" data-tax-rate="7">Bhutan</option>
                    <option value="Bolivia" data-currency="BOB" data-tax-name="Bolivia VAT (ITE)" data-tax-rate="13">Bolivia</option>
                    <option value="Bosnia and Herzegovina" data-currency="BAM" data-tax-name="Bosnia VAT" data-tax-rate="17">Bosnia and Herzegovina</option>
                    <option value="Botswana" data-currency="BWP" data-tax-name="Botswana VAT" data-tax-rate="12">Botswana</option>
                    <option value="Brazil" data-currency="BRL" data-tax-name="Brazilian VAT (ICMS)" data-tax-rate="17">Brazil</option>
                    <option value="Brunei" data-currency="BND" data-tax-name="Brunei GST" data-tax-rate="6">Brunei</option>
                    <option value="Bulgaria" data-currency="BGN" data-tax-name="Bulgarian VAT" data-tax-rate="20">Bulgaria</option>
                    <option value="Burkina Faso" data-currency="XOF" data-tax-name="Burkina Faso VAT" data-tax-rate="18">Burkina Faso</option>
                    <option value="Burundi" data-currency="BIF" data-tax-name="Burundi VAT" data-tax-rate="18">Burundi</option>
                    <!-- C -->
                    <option value="Cambodia" data-currency="KHR" data-currency-alt="USD" data-tax-name="Cambodian VAT" data-tax-rate="10">Cambodia</option>
                    <option value="Cameroon" data-currency="XAF" data-tax-name="Cameroon VAT" data-tax-rate="19.25">Cameroon</option>
                    <option value="Canada" data-currency="CAD" data-tax-name="Canadian GST/HST" data-tax-rate="5">Canada</option>
                    <option value="Cape Verde" data-currency="CVE" data-tax-name="Cape Verde VAT" data-tax-rate="15">Cape Verde</option>
                    <option value="Central African Republic" data-currency="XAF" data-tax-name="CAR VAT" data-tax-rate="19">Central African Republic</option>
                    <option value="Chad" data-currency="XAF" data-tax-name="Chad VAT" data-tax-rate="18">Chad</option>
                    <option value="Chile" data-currency="CLP" data-tax-name="Chilean VAT (IVA)" data-tax-rate="19">Chile</option>
                    <option value="China" data-currency="CNY" data-tax-name="Chinese VAT" data-tax-rate="13">China</option>
                    <option value="Colombia" data-currency="COP" data-tax-name="Colombian VAT" data-tax-rate="19">Colombia</option>
                    <option value="Comoros" data-currency="KMF" data-tax-name="Comoros VAT" data-tax-rate="10">Comoros</option>
                    <option value="Congo" data-currency="XAF" data-tax-name="Congo VAT" data-tax-rate="18">Congo</option>
                    <option value="Costa Rica" data-currency="CRC" data-tax-name="Costa Rica VAT (IVA)" data-tax-rate="13">Costa Rica</option>
                    <option value="Croatia" data-currency="EUR" data-tax-name="Croatian VAT" data-tax-rate="25">Croatia</option>
                    <option value="Cuba" data-currency="CUP" data-tax-name="Cuban VAT" data-tax-rate="10">Cuba</option>
                    <option value="Cyprus" data-currency="EUR" data-tax-name="Cyprus VAT" data-tax-rate="19">Cyprus</option>
                    <option value="Czech Republic" data-currency="CZK" data-tax-name="Czech VAT" data-tax-rate="21">Czech Republic</option>
                    <!-- D -->
                    <option value="Denmark" data-currency="DKK" data-tax-name="Danish VAT" data-tax-rate="25">Denmark</option>
                    <option value="Djibouti" data-currency="DJF" data-tax-name="Djibouti VAT" data-tax-rate="10">Djibouti</option>
                    <option value="Dominica" data-currency="XCD" data-tax-name="Dominica VAT" data-tax-rate="15">Dominica</option>
                    <option value="Dominican Republic" data-currency="DOP" data-tax-name="Dominican ITBIS" data-tax-rate="18">Dominican Republic</option>
                    <!-- E -->
                    <option value="Ecuador" data-currency="USD" data-tax-name="Ecuador VAT" data-tax-rate="12">Ecuador</option>
                    <option value="Egypt" data-currency="EGP" data-tax-name="Egyptian VAT" data-tax-rate="14">Egypt</option>
                    <option value="El Salvador" data-currency="USD" data-tax-name="El Salvador VAT" data-tax-rate="13">El Salvador</option>
                    <option value="Equatorial Guinea" data-currency="XAF" data-tax-name="Equatorial Guinea VAT" data-tax-rate="15">Equatorial Guinea</option>
                    <option value="Eritrea" data-currency="ERN" data-tax-name="Eritrea VAT" data-tax-rate="5">Eritrea</option>
                    <option value="Estonia" data-currency="EUR" data-tax-name="Estonian VAT" data-tax-rate="22">Estonia</option>
                    <option value="Eswatini" data-currency="SZL" data-tax-name="Eswatini VAT" data-tax-rate="15">Eswatini</option>
                    <option value="Ethiopia" data-currency="ETB" data-tax-name="Ethiopian VAT" data-tax-rate="15">Ethiopia</option>
                    <!-- F -->
                    <option value="Fiji" data-currency="FJD" data-tax-name="Fiji VAT" data-tax-rate="15">Fiji</option>
                    <option value="Finland" data-currency="EUR" data-tax-name="Finnish VAT" data-tax-rate="24">Finland</option>
                    <option value="France" data-currency="EUR" data-tax-name="French VAT (TVA)" data-tax-rate="20">France</option>
                    <!-- G -->
                    <option value="Gabon" data-currency="XAF" data-tax-name="Gabon VAT" data-tax-rate="18">Gabon</option>
                    <option value="Gambia" data-currency="GMD" data-tax-name="Gambia VAT" data-tax-rate="15">Gambia</option>
                    <option value="Georgia" data-currency="GEL" data-tax-name="Georgian VAT" data-tax-rate="18">Georgia</option>
                    <option value="Germany" data-currency="EUR" data-tax-name="German VAT (MwSt)" data-tax-rate="19">Germany</option>
                    <option value="Ghana" data-currency="GHS" data-tax-name="Ghana VAT" data-tax-rate="15">Ghana</option>
                    <option value="Greece" data-currency="EUR" data-tax-name="Greek VAT" data-tax-rate="24">Greece</option>
                    <option value="Grenada" data-currency="XCD" data-tax-name="Grenada VAT" data-tax-rate="15">Grenada</option>
                    <option value="Guatemala" data-currency="GTQ" data-tax-name="Guatemala VAT" data-tax-rate="12">Guatemala</option>
                    <option value="Guinea" data-currency="GNF" data-tax-name="Guinea VAT" data-tax-rate="18">Guinea</option>
                    <option value="Guinea-Bissau" data-currency="XOF" data-tax-name="Guinea-Bissau VAT" data-tax-rate="17">Guinea-Bissau</option>
                    <option value="Guyana" data-currency="GYD" data-tax-name="Guyana VAT" data-tax-rate="16">Guyana</option>
                    <!-- H -->
                    <option value="Haiti" data-currency="HTG" data-tax-name="Haiti VAT" data-tax-rate="10">Haiti</option>
                    <option value="Honduras" data-currency="HNL" data-tax-name="Honduras VAT (ISV)" data-tax-rate="15">Honduras</option>
                    <option value="Hungary" data-currency="HUF" data-tax-name="Hungarian VAT" data-tax-rate="27">Hungary</option>
                    <!-- I -->
                    <option value="Iceland" data-currency="ISK" data-tax-name="Icelandic VAT" data-tax-rate="24">Iceland</option>
                    <option value="India" data-currency="INR" data-tax-name="Indian GST" data-tax-rate="18">India</option>
                    <option value="Indonesia" data-currency="IDR" data-tax-name="Indonesian VAT (PPN)" data-tax-rate="11">Indonesia</option>
                    <option value="Iran" data-currency="IRR" data-tax-name="Iranian VAT" data-tax-rate="9">Iran</option>
                    <option value="Iraq" data-currency="IQD" data-tax-name="Iraqi VAT" data-tax-rate="7">Iraq</option>
                    <option value="Ireland" data-currency="EUR" data-tax-name="Irish VAT" data-tax-rate="23">Ireland</option>
                    <option value="Israel" data-currency="ILS" data-tax-name="Israeli VAT (Ma'am)" data-tax-rate="17">Israel</option>
                    <option value="Italy" data-currency="EUR" data-tax-name="Italian VAT (IVA)" data-tax-rate="22">Italy</option>
                    <option value="Ivory Coast" data-currency="XOF" data-tax-name="Ivory Coast VAT" data-tax-rate="18">Ivory Coast</option>
                    <!-- J -->
                    <option value="Jamaica" data-currency="JMD" data-tax-name="Jamaica SCT" data-tax-rate="15">Jamaica</option>
                    <option value="Japan" data-currency="JPY" data-tax-name="Japanese CT (JCT)" data-tax-rate="10">Japan</option>
                    <option value="Jordan" data-currency="JOD" data-tax-name="Jordanian GST" data-tax-rate="16">Jordan</option>
                    <!-- K -->
                    <option value="Kazakhstan" data-currency="KZT" data-tax-name="Kazakhstani VAT" data-tax-rate="12">Kazakhstan</option>
                    <option value="Kenya" data-currency="KES" data-tax-name="Kenyan VAT" data-tax-rate="16">Kenya</option>
                    <option value="Kiribati" data-currency="AUD" data-tax-name="Kiribati GST" data-tax-rate="15">Kiribati</option>
                    <option value="Kosovo" data-currency="EUR" data-tax-name="Kosovo VAT" data-tax-rate="18">Kosovo</option>
                    <option value="Kuwait" data-currency="KWD" data-tax-name="Kuwait VAT" data-tax-rate="5">Kuwait</option>
                    <option value="Kyrgyzstan" data-currency="KGS" data-tax-name="Kyrgyzstan VAT" data-tax-rate="12">Kyrgyzstan</option>
                    <!-- L -->
                    <option value="Laos" data-currency="LAK" data-tax-name="Laos VAT" data-tax-rate="10">Laos</option>
                    <option value="Latvia" data-currency="EUR" data-tax-name="Latvian VAT" data-tax-rate="21">Latvia</option>
                    <option value="Lebanon" data-currency="LBP" data-tax-name="Lebanese VAT" data-tax-rate="11">Lebanon</option>
                    <option value="Lesotho" data-currency="LSL" data-tax-name="Lesotho VAT" data-tax-rate="15">Lesotho</option>
                    <option value="Liberia" data-currency="LRD" data-tax-name="Liberia GST" data-tax-rate="7">Liberia</option>
                    <option value="Libya" data-currency="LYD" data-tax-name="Libyan VAT" data-tax-rate="10">Libya</option>
                    <option value="Liechtenstein" data-currency="CHF" data-tax-name="Liechtenstein VAT" data-tax-rate="8.1">Liechtenstein</option>
                    <option value="Lithuania" data-currency="EUR" data-tax-name="Lithuanian VAT" data-tax-rate="21">Lithuania</option>
                    <option value="Luxembourg" data-currency="EUR" data-tax-name="Luxembourg VAT" data-tax-rate="17">Luxembourg</option>
                    <!-- M -->
                    <option value="Madagascar" data-currency="MGA" data-tax-name="Madagascar VAT" data-tax-rate="20">Madagascar</option>
                    <option value="Malawi" data-currency="MWK" data-tax-name="Malawi VAT" data-tax-rate="16.5">Malawi</option>
                    <option value="Malaysia" data-currency="MYR" data-tax-name="Malaysian SST" data-tax-rate="6">Malaysia</option>
                    <option value="Maldives" data-currency="MVR" data-tax-name="Maldives GST" data-tax-rate="16">Maldives</option>
                    <option value="Mali" data-currency="XOF" data-tax-name="Mali VAT" data-tax-rate="18">Mali</option>
                    <option value="Malta" data-currency="EUR" data-tax-name="Malta VAT" data-tax-rate="18">Malta</option>
                    <option value="Marshall Islands" data-currency="USD" data-tax-name="Marshall Islands VAT" data-tax-rate="0">Marshall Islands</option>
                    <option value="Mauritania" data-currency="MRU" data-tax-name="Mauritania VAT" data-tax-rate="18">Mauritania</option>
                    <option value="Mauritius" data-currency="MUR" data-tax-name="Mauritius VAT" data-tax-rate="15">Mauritius</option>
                    <option value="Mexico" data-currency="MXN" data-tax-name="Mexican VAT (IVA)" data-tax-rate="16">Mexico</option>
                    <option value="Micronesia" data-currency="USD" data-tax-name="Micronesia VAT" data-tax-rate="0">Micronesia</option>
                    <option value="Moldova" data-currency="MDL" data-tax-name="Moldovan VAT" data-tax-rate="20">Moldova</option>
                    <option value="Monaco" data-currency="EUR" data-tax-name="Monaco VAT" data-tax-rate="20">Monaco</option>
                    <option value="Mongolia" data-currency="MNT" data-tax-name="Mongolian VAT" data-tax-rate="10">Mongolia</option>
                    <option value="Montenegro" data-currency="EUR" data-tax-name="Montenegro VAT" data-tax-rate="21">Montenegro</option>
                    <option value="Morocco" data-currency="MAD" data-tax-name="Moroccan VAT" data-tax-rate="20">Morocco</option>
                    <option value="Mozambique" data-currency="MZN" data-tax-name="Mozambique VAT" data-tax-rate="17">Mozambique</option>
                    <option value="Myanmar" data-currency="MMK" data-tax-name="Myanmar Commercial Tax" data-tax-rate="5">Myanmar</option>
                    <!-- N -->
                    <option value="Namibia" data-currency="NAD" data-tax-name="Namibia VAT" data-tax-rate="15">Namibia</option>
                    <option value="Nauru" data-currency="AUD" data-tax-name="Nauru VAT" data-tax-rate="10">Nauru</option>
                    <option value="Nepal" data-currency="NPR" data-tax-name="Nepalese VAT" data-tax-rate="13">Nepal</option>
                    <option value="Netherlands" data-currency="EUR" data-tax-name="Dutch VAT (BTW)" data-tax-rate="21">Netherlands</option>
                    <option value="New Zealand" data-currency="NZD" data-tax-name="New Zealand GST" data-tax-rate="15">New Zealand</option>
                    <option value="Nicaragua" data-currency="NIO" data-tax-name="Nicaragua VAT" data-tax-rate="15">Nicaragua</option>
                    <option value="Niger" data-currency="XOF" data-tax-name="Niger VAT" data-tax-rate="19">Niger</option>
                    <option value="Nigeria" data-currency="NGN" data-tax-name="Nigerian VAT" data-tax-rate="7.5">Nigeria</option>
                    <option value="North Korea" data-currency="KPW" data-tax-name="North Korea VAT" data-tax-rate="10">North Korea</option>
                    <option value="North Macedonia" data-currency="MKD" data-tax-name="Macedonian VAT" data-tax-rate="18">North Macedonia</option>
                    <option value="Norway" data-currency="NOK" data-tax-name="Norwegian VAT (MVA)" data-tax-rate="25">Norway</option>
                    <!-- O -->
                    <option value="Oman" data-currency="OMR" data-tax-name="Oman VAT" data-tax-rate="5">Oman</option>
                    <!-- P -->
                    <option value="Pakistan" data-currency="PKR" data-tax-name="Pakistani GST" data-tax-rate="18">Pakistan</option>
                    <option value="Palau" data-currency="USD" data-tax-name="Palau VAT" data-tax-rate="0">Palau</option>
                    <option value="Palestine" data-currency="ILS" data-tax-name="Palestine VAT" data-tax-rate="16">Palestine</option>
                    <option value="Panama" data-currency="PAB" data-tax-name="Panama ITBMS" data-tax-rate="7">Panama</option>
                    <option value="Papua New Guinea" data-currency="PGK" data-tax-name="PNG GST" data-tax-rate="10">Papua New Guinea</option>
                    <option value="Paraguay" data-currency="PYG" data-tax-name="Paraguay VAT (IVA)" data-tax-rate="10">Paraguay</option>
                    <option value="Peru" data-currency="PEN" data-tax-name="Peruvian IGV" data-tax-rate="18">Peru</option>
                    <option value="Philippines" data-currency="PHP" data-tax-name="Philippine VAT" data-tax-rate="12">Philippines</option>
                    <option value="Poland" data-currency="PLN" data-tax-name="Polish VAT" data-tax-rate="23">Poland</option>
                    <option value="Portugal" data-currency="EUR" data-tax-name="Portuguese VAT" data-tax-rate="23">Portugal</option>
                    <!-- Q -->
                    <option value="Qatar" data-currency="QAR" data-tax-name="Qatar VAT" data-tax-rate="0">Qatar</option>
                    <!-- R -->
                    <option value="Romania" data-currency="RON" data-tax-name="Romanian VAT" data-tax-rate="19">Romania</option>
                    <option value="Russia" data-currency="RUB" data-tax-name="Russian VAT" data-tax-rate="20">Russia</option>
                    <option value="Rwanda" data-currency="RWF" data-tax-name="Rwandan VAT" data-tax-rate="18">Rwanda</option>
                    <!-- S -->
                    <option value="Saint Kitts and Nevis" data-currency="XCD" data-tax-name="St Kitts VAT" data-tax-rate="17">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" data-currency="XCD" data-tax-name="St Lucia VAT" data-tax-rate="15">Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" data-currency="XCD" data-tax-name="St Vincent VAT" data-tax-rate="15">Saint Vincent and the Grenadines</option>
                    <option value="Samoa" data-currency="WST" data-tax-name="Samoan GST" data-tax-rate="15">Samoa</option>
                    <option value="San Marino" data-currency="EUR" data-tax-name="San Marino VAT" data-tax-rate="17">San Marino</option>
                    <option value="Sao Tome and Principe" data-currency="STN" data-tax-name="Sao Tome VAT" data-tax-rate="15">Sao Tome and Principe</option>
                    <option value="Saudi Arabia" data-currency="SAR" data-tax-name="Saudi Arabian VAT" data-tax-rate="15">Saudi Arabia</option>
                    <option value="Senegal" data-currency="XOF" data-tax-name="Senegal VAT" data-tax-rate="18">Senegal</option>
                    <option value="Serbia" data-currency="RSD" data-tax-name="Serbian VAT" data-tax-rate="20">Serbia</option>
                    <option value="Seychelles" data-currency="SCR" data-tax-name="Seychelles VAT" data-tax-rate="15">Seychelles</option>
                    <option value="Sierra Leone" data-currency="SLL" data-tax-name="Sierra Leone VAT" data-tax-rate="15">Sierra Leone</option>
                    <option value="Singapore" data-currency="SGD" data-tax-name="Singapore GST" data-tax-rate="9">Singapore</option>
                    <option value="Slovakia" data-currency="EUR" data-tax-name="Slovak VAT" data-tax-rate="20">Slovakia</option>
                    <option value="Slovenia" data-currency="EUR" data-tax-name="Slovenian VAT" data-tax-rate="22">Slovenia</option>
                    <option value="Solomon Islands" data-currency="SBD" data-tax-name="Solomon Islands VAT" data-tax-rate="15">Solomon Islands</option>
                    <option value="Somalia" data-currency="SOS" data-tax-name="Somalia VAT" data-tax-rate="10">Somalia</option>
                    <option value="South Africa" data-currency="ZAR" data-tax-name="South African VAT" data-tax-rate="15">South Africa</option>
                    <option value="South Korea" data-currency="KRW" data-tax-name="South Korean VAT" data-tax-rate="10">South Korea</option>
                    <option value="South Sudan" data-currency="SSP" data-tax-name="South Sudan VAT" data-tax-rate="18">South Sudan</option>
                    <option value="Spain" data-currency="EUR" data-tax-name="Spanish VAT (IVA)" data-tax-rate="21">Spain</option>
                    <option value="Sri Lanka" data-currency="LKR" data-tax-name="Sri Lankan VAT" data-tax-rate="18">Sri Lanka</option>
                    <option value="Sudan" data-currency="SDG" data-tax-name="Sudanese VAT" data-tax-rate="17">Sudan</option>
                    <option value="Suriname" data-currency="SRD" data-tax-name="Suriname VAT" data-tax-rate="10">Suriname</option>
                    <option value="Sweden" data-currency="SEK" data-tax-name="Swedish VAT" data-tax-rate="25">Sweden</option>
                    <option value="Switzerland" data-currency="CHF" data-tax-name="Swiss VAT" data-tax-rate="8.1">Switzerland</option>
                    <option value="Syria" data-currency="SYP" data-tax-name="Syrian VAT" data-tax-rate="10">Syria</option>
                    <!-- T -->
                    <option value="Taiwan" data-currency="TWD" data-tax-name="Taiwanese VAT" data-tax-rate="5">Taiwan</option>
                    <option value="Tajikistan" data-currency="TJS" data-tax-name="Tajikistan VAT" data-tax-rate="18">Tajikistan</option>
                    <option value="Tanzania" data-currency="TZS" data-tax-name="Tanzanian VAT" data-tax-rate="18">Tanzania</option>
                    <option value="Thailand" data-currency="THB" data-tax-name="Thai VAT" data-tax-rate="7">Thailand</option>
                    <option value="Timor-Leste" data-currency="USD" data-tax-name="Timor-Leste VAT" data-tax-rate="10">Timor-Leste</option>
                    <option value="Togo" data-currency="XOF" data-tax-name="Togo VAT" data-tax-rate="18">Togo</option>
                    <option value="Tonga" data-currency="TOP" data-tax-name="Tonga VAT" data-tax-rate="15">Tonga</option>
                    <option value="Trinidad and Tobago" data-currency="TTD" data-tax-name="Trinidad VAT" data-tax-rate="12">Trinidad and Tobago</option>
                    <option value="Tunisia" data-currency="TND" data-tax-name="Tunisian VAT" data-tax-rate="19">Tunisia</option>
                    <option value="Turkey" data-currency="TRY" data-tax-name="Turkish VAT (KDV)" data-tax-rate="20">Turkey</option>
                    <option value="Turkmenistan" data-currency="TMT" data-tax-name="Turkmenistan VAT" data-tax-rate="15">Turkmenistan</option>
                    <option value="Tuvalu" data-currency="AUD" data-tax-name="Tuvalu VAT" data-tax-rate="10">Tuvalu</option>
                    <!-- U -->
                    <option value="Uganda" data-currency="UGX" data-tax-name="Ugandan VAT" data-tax-rate="18">Uganda</option>
                    <option value="Ukraine" data-currency="UAH" data-tax-name="Ukrainian VAT" data-tax-rate="20">Ukraine</option>
                    <option value="United Arab Emirates" data-currency="AED" data-tax-name="UAE VAT" data-tax-rate="5">United Arab Emirates</option>
                    <option value="United Kingdom" data-currency="GBP" data-tax-name="UK VAT" data-tax-rate="20">United Kingdom</option>
                    <option value="United States" data-currency="USD" data-tax-name="US Sales Tax" data-tax-rate="0">United States</option>
                    <option value="Uruguay" data-currency="UYU" data-tax-name="Uruguayan VAT" data-tax-rate="22">Uruguay</option>
                    <option value="Uzbekistan" data-currency="UZS" data-tax-name="Uzbekistan VAT" data-tax-rate="12">Uzbekistan</option>
                    <!-- V -->
                    <option value="Vanuatu" data-currency="VUV" data-tax-name="Vanuatu VAT" data-tax-rate="15">Vanuatu</option>
                    <option value="Vatican City" data-currency="EUR" data-tax-name="Vatican VAT" data-tax-rate="22">Vatican City</option>
                    <option value="Venezuela" data-currency="VES" data-tax-name="Venezuelan VAT" data-tax-rate="16">Venezuela</option>
                    <option value="Vietnam" data-currency="VND" data-tax-name="Vietnamese VAT" data-tax-rate="10">Vietnam</option>
                    <!-- Y -->
                    <option value="Yemen" data-currency="YER" data-tax-name="Yemeni VAT" data-tax-rate="5">Yemen</option>
                    <!-- Z -->
                    <option value="Zambia" data-currency="ZMW" data-tax-name="Zambian VAT" data-tax-rate="16">Zambia</option>
                    <option value="Zimbabwe" data-currency="ZWL" data-tax-name="Zimbabwe VAT" data-tax-rate="15">Zimbabwe</option>
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
                       value="{{ old('currency') }}"
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
                    <option value="yes" {{ old('has_tax') == 'yes' ? 'selected' : '' }}>Yes, apply tax</option>
                    <option value="no" {{ old('has_tax') == 'no' ? 'selected' : '' }}>No tax</option>
                </select>
                @error('has_tax')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="tax-percentage-group {{ old('has_tax') == 'yes' ? 'show' : '' }}" id="taxPercentageGroup">
                <label for="tax_percentage" class="form-label">
                    <i class="fas fa-calculator me-2"></i><span id="taxLabel">Tax Percentage</span>
                </label>
                <div class="input-group">
                    <input type="number" 
                           class="form-control @error('tax_percentage') is-invalid @enderror" 
                           id="tax_percentage" 
                           name="tax_percentage" 
                           value="{{ old('tax_percentage') }}"
                           placeholder="Enter tax percentage"
                           min="0" 
                           max="100" 
                           step="0.01">
                    <span class="input-group-text">%</span>
                </div>
                <small class="text-muted" id="taxSuggestion"></small>
                @error('tax_percentage')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="fas fa-save me-2"></i> Create Region
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to update currency and tax when country is selected
        function updateCurrencyAndTax(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const currency = selectedOption.getAttribute('data-currency');
            const currencyAlt = selectedOption.getAttribute('data-currency-alt');
            const taxName = selectedOption.getAttribute('data-tax-name');
            const taxRate = selectedOption.getAttribute('data-tax-rate');
            
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
            
            // Update tax label and suggestion
            const taxLabel = document.getElementById('taxLabel');
            const taxSuggestion = document.getElementById('taxSuggestion');
            const taxPercentageInput = document.getElementById('tax_percentage');
            
            if (taxName && taxRate) {
                taxLabel.textContent = taxName + ' (' + taxRate + '%)';
                taxSuggestion.textContent = 'Suggested rate for ' + selectElement.options[selectElement.selectedIndex].text + ': ' + taxRate + '%';
                // Auto-fill the tax percentage if not already set
                if (!taxPercentageInput.value && document.getElementById('has_tax').value === 'yes') {
                    taxPercentageInput.value = taxRate;
                }
            } else {
                taxLabel.textContent = 'Tax Percentage';
                taxSuggestion.textContent = '';
            }
        }

        // Tax configuration toggle
        document.getElementById('has_tax').addEventListener('change', function() {
            const taxPercentageGroup = document.getElementById('taxPercentageGroup');
            const taxPercentageInput = document.getElementById('tax_percentage');
            
            if (this.value === 'yes') {
                taxPercentageGroup.classList.add('show');
                taxPercentageInput.required = true;
                // Trigger tax update if country is already selected
                const countrySelect = document.getElementById('country_name');
                if (countrySelect.value) {
                    updateCurrencyAndTax(countrySelect);
                }
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
            
            // Auto-fill currency and tax on page load if country is already selected
            const countrySelect = document.getElementById('country_name');
            if (countrySelect.value) {
                const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                const currency = selectedOption.getAttribute('data-currency');
                if (currency) {
                    document.getElementById('currency').value = currency;
                }
                
                // Update tax info if tax is enabled
                if (hasTaxSelect.value === 'yes') {
                    updateCurrencyAndTax(countrySelect);
                }
            }
        });
    </script>
</body>
</html>