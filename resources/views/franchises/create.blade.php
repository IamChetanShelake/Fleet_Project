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
                        required>
                    <option value="">Select a country</option>
                    <!-- A -->
                    <option value="Afghanistan" data-currency="AFN">Afghanistan</option>
                    <option value="Albania" data-currency="ALL">Albania</option>
                    <option value="Algeria" data-currency="DZD">Algeria</option>
                    <option value="Andorra" data-currency="EUR">Andorra</option>
                    <option value="Angola" data-currency="AOA">Angola</option>
                    <option value="Antigua and Barbuda" data-currency="XCD">Antigua and Barbuda</option>
                    <option value="Argentina" data-currency="ARS">Argentina</option>
                    <option value="Armenia" data-currency="AMD">Armenia</option>
                    <option value="Australia" data-currency="AUD">Australia</option>
                    <option value="Austria" data-currency="EUR">Austria</option>
                    <option value="Azerbaijan" data-currency="AZN">Azerbaijan</option>
                    <!-- B -->
                    <option value="Bahamas" data-currency="BSD">Bahamas</option>
                    <option value="Bahrain" data-currency="BHD">Bahrain</option>
                    <option value="Bangladesh" data-currency="BDT">Bangladesh</option>
                    <option value="Barbados" data-currency="BBD">Barbados</option>
                    <option value="Belarus" data-currency="BYN">Belarus</option>
                    <option value="Belgium" data-currency="EUR">Belgium</option>
                    <option value="Belize" data-currency="BZD">Belize</option>
                    <option value="Benin" data-currency="XOF">Benin</option>
                    <option value="Bhutan" data-currency="BTN">Bhutan</option>
                    <option value="Bolivia" data-currency="BOB">Bolivia</option>
                    <option value="Bosnia and Herzegovina" data-currency="BAM">Bosnia and Herzegovina</option>
                    <option value="Botswana" data-currency="BWP">Botswana</option>
                    <option value="Brazil" data-currency="BRL">Brazil</option>
                    <option value="Brunei" data-currency="BND">Brunei</option>
                    <option value="Bulgaria" data-currency="BGN">Bulgaria</option>
                    <option value="Burkina Faso" data-currency="XOF">Burkina Faso</option>
                    <option value="Burundi" data-currency="BIF">Burundi</option>
                    <!-- C -->
                    <option value="Cambodia" data-currency="KHR">Cambodia</option>
                    <option value="Cameroon" data-currency="XAF">Cameroon</option>
                    <option value="Canada" data-currency="CAD">Canada</option>
                    <option value="Cape Verde" data-currency="CVE">Cape Verde</option>
                    <option value="Central African Republic" data-currency="XAF">Central African Republic</option>
                    <option value="Chad" data-currency="XAF">Chad</option>
                    <option value="Chile" data-currency="CLP">Chile</option>
                    <option value="China" data-currency="CNY">China</option>
                    <option value="Colombia" data-currency="COP">Colombia</option>
                    <option value="Comoros" data-currency="KMF">Comoros</option>
                    <option value="Congo" data-currency="XAF">Congo</option>
                    <option value="Costa Rica" data-currency="CRC">Costa Rica</option>
                    <option value="Croatia" data-currency="EUR">Croatia</option>
                    <option value="Cuba" data-currency="CUP">Cuba</option>
                    <option value="Cyprus" data-currency="EUR">Cyprus</option>
                    <option value="Czech Republic" data-currency="CZK">Czech Republic</option>
                    <!-- D -->
                    <option value="Denmark" data-currency="DKK">Denmark</option>
                    <option value="Djibouti" data-currency="DJF">Djibouti</option>
                    <option value="Dominica" data-currency="XCD">Dominica</option>
                    <option value="Dominican Republic" data-currency="DOP">Dominican Republic</option>
                    <!-- E -->
                    <option value="Ecuador" data-currency="USD">Ecuador</option>
                    <option value="Egypt" data-currency="EGP">Egypt</option>
                    <option value="El Salvador" data-currency="USD">El Salvador</option>
                    <option value="Equatorial Guinea" data-currency="XAF">Equatorial Guinea</option>
                    <option value="Eritrea" data-currency="ERN">Eritrea</option>
                    <option value="Estonia" data-currency="EUR">Estonia</option>
                    <option value="Eswatini" data-currency="SZL">Eswatini</option>
                    <option value="Ethiopia" data-currency="ETB">Ethiopia</option>
                    <!-- F -->
                    <option value="Fiji" data-currency="FJD">Fiji</option>
                    <option value="Finland" data-currency="EUR">Finland</option>
                    <option value="France" data-currency="EUR">France</option>
                    <!-- G -->
                    <option value="Gabon" data-currency="XAF">Gabon</option>
                    <option value="Gambia" data-currency="GMD">Gambia</option>
                    <option value="Georgia" data-currency="GEL">Georgia</option>
                    <option value="Germany" data-currency="EUR">Germany</option>
                    <option value="Ghana" data-currency="GHS">Ghana</option>
                    <option value="Greece" data-currency="EUR">Greece</option>
                    <option value="Grenada" data-currency="XCD">Grenada</option>
                    <option value="Guatemala" data-currency="GTQ">Guatemala</option>
                    <option value="Guinea" data-currency="GNF">Guinea</option>
                    <option value="Guinea-Bissau" data-currency="XOF">Guinea-Bissau</option>
                    <option value="Guyana" data-currency="GYD">Guyana</option>
                    <!-- H -->
                    <option value="Haiti" data-currency="HTG">Haiti</option>
                    <option value="Honduras" data-currency="HNL">Honduras</option>
                    <option value="Hungary" data-currency="HUF">Hungary</option>
                    <!-- I -->
                    <option value="Iceland" data-currency="ISK">Iceland</option>
                    <option value="India" data-currency="INR">India</option>
                    <option value="Indonesia" data-currency="IDR">Indonesia</option>
                    <option value="Iran" data-currency="IRR">Iran</option>
                    <option value="Iraq" data-currency="IQD">Iraq</option>
                    <option value="Ireland" data-currency="EUR">Ireland</option>
                    <option value="Israel" data-currency="ILS">Israel</option>
                    <option value="Italy" data-currency="EUR">Italy</option>
                    <option value="Ivory Coast" data-currency="XOF">Ivory Coast</option>
                    <!-- J -->
                    <option value="Jamaica" data-currency="JMD">Jamaica</option>
                    <option value="Japan" data-currency="JPY">Japan</option>
                    <option value="Jordan" data-currency="JOD">Jordan</option>
                    <!-- K -->
                    <option value="Kazakhstan" data-currency="KZT">Kazakhstan</option>
                    <option value="Kenya" data-currency="KES">Kenya</option>
                    <option value="Kiribati" data-currency="AUD">Kiribati</option>
                    <option value="Kosovo" data-currency="EUR">Kosovo</option>
                    <option value="Kuwait" data-currency="KWD">Kuwait</option>
                    <option value="Kyrgyzstan" data-currency="KGS">Kyrgyzstan</option>
                    <!-- L -->
                    <option value="Laos" data-currency="LAK">Laos</option>
                    <option value="Latvia" data-currency="EUR">Latvia</option>
                    <option value="Lebanon" data-currency="LBP">Lebanon</option>
                    <option value="Lesotho" data-currency="LSL">Lesotho</option>
                    <option value="Liberia" data-currency="LRD">Liberia</option>
                    <option value="Libya" data-currency="LYD">Libya</option>
                    <option value="Liechtenstein" data-currency="CHF">Liechtenstein</option>
                    <option value="Lithuania" data-currency="EUR">Lithuania</option>
                    <option value="Luxembourg" data-currency="EUR">Luxembourg</option>
                    <!-- M -->
                    <option value="Madagascar" data-currency="MGA">Madagascar</option>
                    <option value="Malawi" data-currency="MWK">Malawi</option>
                    <option value="Malaysia" data-currency="MYR">Malaysia</option>
                    <option value="Maldives" data-currency="MVR">Maldives</option>
                    <option value="Mali" data-currency="XOF">Mali</option>
                    <option value="Malta" data-currency="EUR">Malta</option>
                    <option value="Marshall Islands" data-currency="USD">Marshall Islands</option>
                    <option value="Mauritania" data-currency="MRU">Mauritania</option>
                    <option value="Mauritius" data-currency="MUR">Mauritius</option>
                    <option value="Mexico" data-currency="MXN">Mexico</option>
                    <option value="Micronesia" data-currency="USD">Micronesia</option>
                    <option value="Moldova" data-currency="MDL">Moldova</option>
                    <option value="Monaco" data-currency="EUR">Monaco</option>
                    <option value="Mongolia" data-currency="MNT">Mongolia</option>
                    <option value="Montenegro" data-currency="EUR">Montenegro</option>
                    <option value="Morocco" data-currency="MAD">Morocco</option>
                    <option value="Mozambique" data-currency="MZN">Mozambique</option>
                    <option value="Myanmar" data-currency="MMK">Myanmar</option>
                    <!-- N -->
                    <option value="Namibia" data-currency="NAD">Namibia</option>
                    <option value="Nauru" data-currency="AUD">Nauru</option>
                    <option value="Nepal" data-currency="NPR">Nepal</option>
                    <option value="Netherlands" data-currency="EUR">Netherlands</option>
                    <option value="New Zealand" data-currency="NZD">New Zealand</option>
                    <option value="Nicaragua" data-currency="NIO">Nicaragua</option>
                    <option value="Niger" data-currency="XOF">Niger</option>
                    <option value="Nigeria" data-currency="NGN">Nigeria</option>
                    <option value="North Korea" data-currency="KPW">North Korea</option>
                    <option value="North Macedonia" data-currency="MKD">North Macedonia</option>
                    <option value="Norway" data-currency="NOK">Norway</option>
                    <!-- O -->
                    <option value="Oman" data-currency="OMR">Oman</option>
                    <!-- P -->
                    <option value="Pakistan" data-currency="PKR">Pakistan</option>
                    <option value="Palau" data-currency="USD">Palau</option>
                    <option value="Palestine" data-currency="ILS">Palestine</option>
                    <option value="Panama" data-currency="PAB">Panama</option>
                    <option value="Papua New Guinea" data-currency="PGK">Papua New Guinea</option>
                    <option value="Paraguay" data-currency="PYG">Paraguay</option>
                    <option value="Peru" data-currency="PEN">Peru</option>
                    <option value="Philippines" data-currency="PHP">Philippines</option>
                    <option value="Poland" data-currency="PLN">Poland</option>
                    <option value="Portugal" data-currency="EUR">Portugal</option>
                    <!-- Q -->
                    <option value="Qatar" data-currency="QAR">Qatar</option>
                    <!-- R -->
                    <option value="Romania" data-currency="RON">Romania</option>
                    <option value="Russia" data-currency="RUB">Russia</option>
                    <option value="Rwanda" data-currency="RWF">Rwanda</option>
                    <!-- S -->
                    <option value="Saint Kitts and Nevis" data-currency="XCD">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" data-currency="XCD">Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" data-currency="XCD">Saint Vincent and the Grenadines</option>
                    <option value="Samoa" data-currency="WST">Samoa</option>
                    <option value="San Marino" data-currency="EUR">San Marino</option>
                    <option value="Sao Tome and Principe" data-currency="STN">Sao Tome and Principe</option>
                    <option value="Saudi Arabia" data-currency="SAR">Saudi Arabia</option>
                    <option value="Senegal" data-currency="XOF">Senegal</option>
                    <option value="Serbia" data-currency="RSD">Serbia</option>
                    <option value="Seychelles" data-currency="SCR">Seychelles</option>
                    <option value="Sierra Leone" data-currency="SLL">Sierra Leone</option>
                    <option value="Singapore" data-currency="SGD">Singapore</option>
                    <option value="Slovakia" data-currency="EUR">Slovakia</option>
                    <option value="Slovenia" data-currency="EUR">Slovenia</option>
                    <option value="Solomon Islands" data-currency="SBD">Solomon Islands</option>
                    <option value="Somalia" data-currency="SOS">Somalia</option>
                    <option value="South Africa" data-currency="ZAR">South Africa</option>
                    <option value="South Korea" data-currency="KRW">South Korea</option>
                    <option value="South Sudan" data-currency="SSP">South Sudan</option>
                    <option value="Spain" data-currency="EUR">Spain</option>
                    <option value="Sri Lanka" data-currency="LKR">Sri Lanka</option>
                    <option value="Sudan" data-currency="SDG">Sudan</option>
                    <option value="Suriname" data-currency="SRD">Suriname</option>
                    <option value="Sweden" data-currency="SEK">Sweden</option>
                    <option value="Switzerland" data-currency="CHF">Switzerland</option>
                    <option value="Syria" data-currency="SYP">Syria</option>
                    <!-- T -->
                    <option value="Taiwan" data-currency="TWD">Taiwan</option>
                    <option value="Tajikistan" data-currency="TJS">Tajikistan</option>
                    <option value="Tanzania" data-currency="TZS">Tanzania</option>
                    <option value="Thailand" data-currency="THB">Thailand</option>
                    <option value="Timor-Leste" data-currency="USD">Timor-Leste</option>
                    <option value="Togo" data-currency="XOF">Togo</option>
                    <option value="Tonga" data-currency="TOP">Tonga</option>
                    <option value="Trinidad and Tobago" data-currency="TTD">Trinidad and Tobago</option>
                    <option value="Tunisia" data-currency="TND">Tunisia</option>
                    <option value="Turkey" data-currency="TRY">Turkey</option>
                    <option value="Turkmenistan" data-currency="TMT">Turkmenistan</option>
                    <option value="Tuvalu" data-currency="AUD">Tuvalu</option>
                    <!-- U -->
                    <option value="Uganda" data-currency="UGX">Uganda</option>
                    <option value="Ukraine" data-currency="UAH">Ukraine</option>
                    <option value="United Arab Emirates" data-currency="AED">United Arab Emirates</option>
                    <option value="United Kingdom" data-currency="GBP">United Kingdom</option>
                    <option value="United States" data-currency="USD">United States</option>
                    <option value="Uruguay" data-currency="UYU">Uruguay</option>
                    <option value="Uzbekistan" data-currency="UZS">Uzbekistan</option>
                    <!-- V -->
                    <option value="Vanuatu" data-currency="VUV">Vanuatu</option>
                    <option value="Vatican City" data-currency="EUR">Vatican City</option>
                    <option value="Venezuela" data-currency="VES">Venezuela</option>
                    <option value="Vietnam" data-currency="VND">Vietnam</option>
                    <!-- Y -->
                    <option value="Yemen" data-currency="YER">Yemen</option>
                    <!-- Z -->
                    <option value="Zambia" data-currency="ZMW">Zambia</option>
                    <option value="Zimbabwe" data-currency="ZWL">Zimbabwe</option>
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
                    <i class="fas fa-calculator me-2"></i>Tax Percentage
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