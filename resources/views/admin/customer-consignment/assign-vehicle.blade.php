@extends('admin.layout.master')

@section('title', 'Assign Vehicle')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-container" style="padding: 24px; width: 100%;">
        
        {{-- Page Header --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:14px;">
                <a href="{{ route('admin.customer-consignment.show', $consignment->id) }}"
                   style="width:38px;height:38px;border-radius:50%;background:#fff;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;box-shadow:0 1px 3px rgba(0,0,0,.07);">
                    <i class="fa fa-arrow-left" style="font-size:14px;"></i>
                </a>
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:#1e293b;margin:0;">Assign Vehicle</h1>
                    <p style="font-size:13px;color:#64748b;margin:2px 0 0;">
                        Order #{{ $consignment->order_no ?? $consignment->id }} &nbsp;·&nbsp;
                        {{ $consignment->customer?->name ?? 'N/A' }}
                    </p>
                </div>
            </div>
            <span style="
                padding:6px 16px;border-radius:20px;font-size:12px;font-weight:600;letter-spacing:.5px;
                background:{{ $consignment->status === 'pending' ? '#fef9c3' : ($consignment->status === 'assigned' ? '#dcfce7' : '#dbeafe') }};
                color:{{ $consignment->status === 'pending' ? '#92400e' : ($consignment->status === 'assigned' ? '#166534' : '#1e40af') }};
                text-transform:uppercase;">
                {{ ucfirst($consignment->status ?? 'pending') }}
            </span>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:12px 18px;border-radius:10px;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;"><i class="fa fa-exclamation-circle"></i> <strong>Please fix the errors below:</strong></div>
                <ul style="margin:0;padding-left:20px;">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.customer-consignment.store-vehicle', $consignment->id) }}" method="POST" id="assignVehicleForm">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

                {{-- LEFT COLUMN --}}
                <div style="display:flex;flex-direction:column;gap:20px;">

                    {{-- Consignment Details Card --}}
                    <div class="section-card">
                        <div class="card-header" style="background:linear-gradient(135deg,#1e40af,#3b82f6);padding:16px 20px;display:flex;align-items:center;gap:10px;">
                            <i class="fa fa-file-text-o" style="color:#fff;font-size:16px;"></i>
                            <h2 style="margin:0;font-size:15px;font-weight:700;color:#fff;">Consignment Details</h2>
                        </div>
                        <div class="card-body" style="padding:20px;">

                            {{-- Route Visual --}}
                            <div style="background:#f8fafc;border-radius:10px;padding:16px;margin-bottom:16px;position:relative;">
                                <div style="display:flex;align-items:flex-start;gap:12px;">
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:3px;">
                                        <div style="width:12px;height:12px;border-radius:50%;background:#22c55e;border:2px solid #fff;box-shadow:0 0 0 2px #22c55e;"></div>
                                        <div style="width:2px;height:36px;background:repeating-linear-gradient(to bottom,#94a3b8 0,#94a3b8 4px,transparent 4px,transparent 8px);margin:4px 0;"></div>
                                        <div style="width:12px;height:12px;border-radius:50%;background:#ef4444;border:2px solid #fff;box-shadow:0 0 0 2px #ef4444;"></div>
                                    </div>
                                    <div style="flex:1;display:flex;flex-direction:column;gap:18px;">
                                        <div>
                                            <div style="font-size:11px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;">Pickup</div>
                                            <div style="font-size:14px;font-weight:600;color:#1e293b;line-height:1.4;">{{ $consignment->pickup_location ?? 'N/A' }}</div>
                                            @if($consignment->source_city || $consignment->source_state)
                                            <div style="font-size:12px;color:#64748b;">{{ implode(', ', array_filter([$consignment->source_city, $consignment->source_state])) }}</div>
                                            @endif
                                        </div>
                                        <div>
                                            <div style="font-size:11px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;">Delivery</div>
                                            <div style="font-size:14px;font-weight:600;color:#1e293b;line-height:1.4;">{{ $consignment->delivery_location ?? 'N/A' }}</div>
                                            @if($consignment->dest_city || $consignment->dest_state)
                                            <div style="font-size:12px;color:#64748b;">{{ implode(', ', array_filter([$consignment->dest_city, $consignment->dest_state])) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Info Grid --}}
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                                <div style="background:#f8fafc;border-radius:8px;padding:12px;">
                                    <div style="font-size:11px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Customer</div>
                                    <div style="font-size:13px;font-weight:600;color:#1e293b;">{{ $consignment->customer?->name ?? 'N/A' }}</div>
                                    @if($consignment->customer?->email)
                                    <div style="font-size:11px;color:#64748b;margin-top:2px;"><i class="fa fa-envelope-o" style="margin-right:4px;"></i>{{ $consignment->customer->email }}</div>
                                    @endif
                                </div>
                                <div style="background:#f8fafc;border-radius:8px;padding:12px;">
                                    <div style="font-size:11px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Trip Type</div>
                                    <div style="font-size:13px;font-weight:600;color:#1e293b;">{{ $consignment->trip_type ?? 'N/A' }}</div>
                                </div>
                                <div style="background:#f8fafc;border-radius:8px;padding:12px;">
                                    <div style="font-size:11px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Pickup Date</div>
                                    <div style="font-size:13px;font-weight:600;color:#1e293b;">
                                        {{ $consignment->pickup_datetime ? \Carbon\Carbon::parse($consignment->pickup_datetime)->format('d M Y, h:i A') : 'N/A' }}
                                    </div>
                                </div>
                                <div style="background:#f8fafc;border-radius:8px;padding:12px;">
                                    <div style="font-size:11px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Delivery Date</div>
                                    <div style="font-size:13px;font-weight:600;color:#1e293b;">
                                        {{ $consignment->delivery_date ? \Carbon\Carbon::parse($consignment->delivery_date)->format('d M Y') : 'N/A' }}
                                    </div>
                                </div>
                                @if($consignment->total_distance)
                                <div style="background:#eff6ff;border-radius:8px;padding:12px;">
                                    <div style="font-size:11px;color:#1d4ed8;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Distance</div>
                                    <div style="font-size:13px;font-weight:600;color:#1e40af;">{{ $consignment->total_distance }} km</div>
                                </div>
                                @endif
                                @if($consignment->total_travel_time)
                                <div style="background:#eff6ff;border-radius:8px;padding:12px;">
                                    <div style="font-size:11px;color:#1d4ed8;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Est. Travel Time</div>
                                    <div style="font-size:13px;font-weight:600;color:#1e40af;">{{ $consignment->total_travel_time }}</div>
                                </div>
                                @endif
                            </div>

                            {{-- Receiver Info --}}
                            @if($consignment->receiver_name || $consignment->receiver_mobile)
                            <div style="margin-top:12px;background:#fefce8;border:1px solid #fef08a;border-radius:8px;padding:12px;">
                                <div style="font-size:11px;color:#92400e;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;"><i class="fa fa-user-o" style="margin-right:4px;"></i>Receiver</div>
                                <div style="font-size:13px;font-weight:600;color:#1e293b;">{{ $consignment->receiver_name }}</div>
                                @if($consignment->receiver_mobile)
                                <div style="font-size:12px;color:#64748b;margin-top:2px;"><i class="fa fa-phone" style="margin-right:4px;"></i>{{ $consignment->receiver_mobile }}</div>
                                @endif
                            </div>
                            @endif

                            {{-- Currently Assigned (if any) --}}
                            @if($consignment->assigned_vehicle_no)
                            <div style="margin-top:12px;background:#dcfce7;border:1px solid #86efac;border-radius:8px;padding:12px;">
                                <div style="font-size:11px;color:#166534;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;"><i class="fa fa-truck" style="margin-right:4px;"></i>Currently Assigned</div>
                                <div style="font-size:13px;font-weight:600;color:#166534;">Vehicle: {{ $consignment->assigned_vehicle_no }}</div>
                                @if($consignment->assigned_driver)
                                <div style="font-size:12px;color:#166534;margin-top:2px;">Driver: {{ $consignment->assigned_driver }}</div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Driver Selection --}}
                    <div class="section-card">
                        <div class="card-header" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);padding:16px 20px;display:flex;align-items:center;gap:10px;">
                            <i class="fa fa-id-card-o" style="color:#fff;font-size:16px;"></i>
                            <h2 style="margin:0;font-size:15px;font-weight:700;color:#fff;">Select Driver <span style="font-weight:400;opacity:.8;font-size:13px;">(Optional)</span></h2>
                        </div>
                        <div class="card-body" style="padding:20px;">
                            <select name="driver_id" id="driverSelect" class="form-select"
                                style="width:100%;padding:12px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;color:#1e293b;background:#f8fafc;">
                                <option value="">— No Driver Assigned —</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ $consignment->assigned_driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                    @if($driver->phone) · {{ $driver->phone }}@endif
                                    @if($driver->status) ({{ ucfirst($driver->status) }})@endif
                                </option>
                                @endforeach
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin-top:8px;"><i class="fa fa-info-circle" style="margin-right:4px;"></i>Driver selection is optional. You can assign a driver later.</p>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" id="submitBtn" disabled
                        style="width:100%;padding:16px;background:#94a3b8;color:#fff;border:none;border-radius:12px;font-size:16px;font-weight:700;font-family:'Segoe UI',sans-serif;cursor:not-allowed;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .2s;">
                        <i class="fa fa-truck"></i>
                        <span>Select a Vehicle to Continue</span>
                    </button>
                </div>

                {{-- RIGHT COLUMN --}}
                <div style="display:flex;flex-direction:column;gap:20px;">

                    {{-- Google Map --}}
                    <div class="section-card">
                        <div class="card-header" style="background:linear-gradient(135deg,#0f766e,#14b8a6);padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <i class="fa fa-map-marker" style="color:#fff;font-size:16px;"></i>
                                <h2 style="margin:0;font-size:15px;font-weight:700;color:#fff;">Route Map</h2>
                            </div>
                            <div id="mapDistance" style="font-size:12px;color:rgba(255,255,255,.85);display:none;">
                                <i class="fa fa-road" style="margin-right:4px;"></i><span id="mapDistanceText"></span>
                                &nbsp;·&nbsp;<i class="fa fa-clock-o" style="margin-right:4px;"></i><span id="mapDurationText"></span>
                            </div>
                        </div>
                        <div id="map" style="width:100%;height:380px;background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
                            <div style="text-align:center;color:#94a3b8;">
                                <i class="fa fa-map" style="font-size:36px;margin-bottom:10px;"></i>
                                <p style="font-size:14px;">Loading map...</p>
                            </div>
                        </div>
                        <div style="padding:12px 16px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                            <div style="display:flex;align-items:center;gap:16px;font-size:12px;color:#64748b;">
                                <span style="display:flex;align-items:center;gap:6px;"><span style="width:10px;height:10px;border-radius:50%;background:#22c55e;display:inline-block;"></span>{{ Str::limit($consignment->pickup_location ?? 'Origin', 30) }}</span>
                                <i class="fa fa-arrow-right" style="color:#94a3b8;"></i>
                                <span style="display:flex;align-items:center;gap:6px;"><span style="width:10px;height:10px;border-radius:50%;background:#ef4444;display:inline-block;"></span>{{ Str::limit($consignment->delivery_location ?? 'Destination', 30) }}</span>
                            </div>
                            <a id="openMapsLink" href="#" target="_blank" style="font-size:12px;color:#0f766e;text-decoration:none;font-weight:600;display:none;">
                                <i class="fa fa-external-link" style="margin-right:4px;"></i>Open in Google Maps
                            </a>
                        </div>
                    </div>

                    {{-- Vehicle Selection --}}
                    <div class="section-card">
                        <div class="card-header" style="background:linear-gradient(135deg,#b45309,#f59e0b);padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <i class="fa fa-truck" style="color:#fff;font-size:16px;"></i>
                                <h2 style="margin:0;font-size:15px;font-weight:700;color:#fff;">Select Vehicle</h2>
                            </div>
                            <span style="background:rgba(255,255,255,.25);color:#fff;font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;">
                                {{ $vehicles->count() }} Available
                            </span>
                        </div>

                        {{-- Vehicle Search --}}
                        <div style="padding:14px 16px;border-bottom:1px solid #f1f5f9;">
                            <div style="position:relative;">
                                <i class="fa fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:13px;"></i>
                                <input type="text" id="vehicleSearch" placeholder="Search by vehicle number, brand or type..." class="form-control"
                                    style="width:100%;padding:10px 12px 10px 36px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;color:#1e293b;background:#f8fafc;">
                            </div>
                        </div>

                        {{-- Hidden input for selected vehicle --}}
                        <input type="hidden" name="vehicle_id" id="selectedVehicleId" value="{{ old('vehicle_id') }}">

                        {{-- Vehicle Cards --}}
                        <div id="vehicleList" style="padding:14px 16px;max-height:420px;overflow-y:auto;display:flex;flex-direction:column;gap:10px;">
                            @forelse($vehicles as $vehicle)
                            <div class="vehicle-card" data-id="{{ $vehicle->id }}"
                                data-number="{{ strtolower($vehicle->vehicle_number ?? '') }}"
                                data-brand="{{ strtolower($vehicle->brand ?? '') }}"
                                data-type="{{ strtolower($vehicle->vehicle_type ?? '') }}"
                                onclick="selectVehicle({{ $vehicle->id }}, '{{ $vehicle->vehicle_number }}', '{{ $vehicle->brand }}', '{{ $vehicle->vehicle_type }}')"
                                style="border:2px solid #e2e8f0;border-radius:12px;padding:14px;cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:14px;background:#fafafa;
                                    {{ old('vehicle_id') == $vehicle->id ? 'border-color:#f59e0b;background:#fffbeb;box-shadow:0 0 0 3px rgba(245,158,11,.15);' : '' }}">

                                {{-- Vehicle Icon/Photo --}}
                                <div style="width:52px;height:52px;border-radius:10px;background:{{ in_array($vehicle->vehicle_type, ['Truck','truck']) ? '#eff6ff' : '#f0fdf4' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;">
                                    @if($vehicle->image_path && file_exists(public_path($vehicle->image_path)))
                                        <img src="{{ asset($vehicle->image_path) }}" alt="Vehicle" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                                    @else
                                        <i class="fa fa-truck" style="font-size:22px;color:{{ in_array($vehicle->vehicle_type, ['Truck','truck']) ? '#3b82f6' : '#22c55e' }};"></i>
                                    @endif
                                </div>

                                {{-- Vehicle Info --}}
                                <div style="flex:1;min-width:0;">
                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap;">
                                        <div style="font-size:15px;font-weight:700;color:#1e293b;">{{ $vehicle->vehicle_number ?? 'N/A' }}</div>
                                        <span style="font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:.4px;
                                            background:{{ $vehicle->status === 'active' ? '#dcfce7' : '#fef9c3' }};
                                            color:{{ $vehicle->status === 'active' ? '#166534' : '#92400e' }};">
                                            {{ ucfirst($vehicle->status ?? 'N/A') }}
                                        </span>
                                    </div>
                                    <div style="font-size:12px;color:#64748b;margin-top:3px;">
                                        {{ ucfirst($vehicle->brand ?? '') }}
                                        @if($vehicle->model) · {{ $vehicle->model }}@endif
                                    </div>
                                    <div style="margin-top:6px;">
                                        <span style="font-size:11px;background:#eff6ff;color:#1d4ed8;padding:3px 8px;border-radius:6px;font-weight:600;">
                                            <i class="fa fa-tag" style="margin-right:3px;"></i>{{ $vehicle->vehicle_type ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Selection Indicator --}}
                                <div class="check-icon" style="width:24px;height:24px;border-radius:50%;border:2px solid #e2e8f0;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s;
                                    {{ old('vehicle_id') == $vehicle->id ? 'background:#f59e0b;border-color:#f59e0b;' : '' }}">
                                    <i class="fa fa-check" style="font-size:11px;color:{{ old('vehicle_id') == $vehicle->id ? '#fff' : 'transparent' }};"></i>
                                </div>
                            </div>
                            @empty
                            <div style="text-align:center;padding:40px 20px;color:#94a3b8;">
                                <i class="fa fa-truck" style="font-size:36px;margin-bottom:10px;display:block;"></i>
                                <p style="font-size:14px;margin:0;">No vehicles found.</p>
                            </div>
                            @endforelse
                        </div>

                        {{-- No results message --}}
                        <div id="noVehicleResults" style="display:none;text-align:center;padding:30px;color:#94a3b8;">
                            <i class="fa fa-search" style="font-size:28px;margin-bottom:8px;display:block;"></i>
                            <p style="font-size:13px;">No vehicles match your search.</p>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

{{-- Selected Vehicle Toast --}}
<div id="selectedToast" style="display:none;position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:#1e293b;color:#fff;padding:14px 24px;border-radius:50px;font-size:14px;font-weight:600;box-shadow:0 8px 32px rgba(0,0,0,.25);z-index:9999;display:flex;align-items:center;gap:10px;transition:all .3s;">
    <i class="fa fa-check-circle" style="color:#22c55e;font-size:16px;"></i>
    <span id="toastText">Vehicle selected</span>
</div>

{{-- Responsive Styles for Grid --}}
<style>
    @media (max-width: 1200px) {
        #assignVehicleForm > div {
            grid-template-columns: 1fr !important;
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 16px !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // ─── Vehicle Selection ───────────────────────────────────────────────────
    let selectedId = {{ old('vehicle_id') ?? 'null' }};

    function selectVehicle(id, number, brand, type) {
        // Deselect all
        document.querySelectorAll('.vehicle-card').forEach(card => {
            card.style.borderColor = '#e2e8f0';
            card.style.background = '#fafafa';
            card.style.boxShadow = 'none';
            const icon = card.querySelector('.check-icon');
            icon.style.background = '#fff';
            icon.style.borderColor = '#e2e8f0';
            icon.querySelector('i').style.color = 'transparent';
        });

        // Select clicked
        const clicked = document.querySelector(`.vehicle-card[data-id="${id}"]`);
        if (clicked) {
            clicked.style.borderColor = '#f59e0b';
            clicked.style.background = '#fffbeb';
            clicked.style.boxShadow = '0 0 0 3px rgba(245,158,11,.15)';
            const icon = clicked.querySelector('.check-icon');
            icon.style.background = '#f59e0b';
            icon.style.borderColor = '#f59e0b';
            icon.querySelector('i').style.color = '#fff';
        }

        // Update hidden input
        document.getElementById('selectedVehicleId').value = id;
        selectedId = id;

        // Enable submit button
        const btn = document.getElementById('submitBtn');
        btn.disabled = false;
        btn.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
        btn.style.cursor = 'pointer';
        btn.style.boxShadow = '0 4px 14px rgba(245,158,11,.35)';
        btn.querySelector('span').textContent = `Assign ${number} (${brand} ${type})`;

        // Show toast
        showToast(`${number} selected`);
    }

    function showToast(msg) {
        const toast = document.getElementById('selectedToast');
        document.getElementById('toastText').textContent = msg;
        toast.style.display = 'flex';
        toast.style.opacity = '1';
        clearTimeout(window._toastTimer);
        window._toastTimer = setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.style.display = 'none', 300); }, 2500);
    }

    // Re-select if old value exists
    @if(old('vehicle_id'))
    document.addEventListener('DOMContentLoaded', () => {
        const card = document.querySelector('.vehicle-card[data-id="{{ old("vehicle_id") }}"]');
        if (card) {
            const id = card.dataset.id;
            const number = card.dataset.number;
            const brand = card.dataset.brand;
            const type = card.dataset.type;
            selectVehicle(id, number, brand, type);
        }
    });
    @endif

    // ─── Vehicle Search ──────────────────────────────────────────────────────
    document.getElementById('vehicleSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.vehicle-card');
        let visible = 0;
        cards.forEach(card => {
            const match = card.dataset.number.includes(q) || card.dataset.brand.includes(q) || card.dataset.type.includes(q);
            card.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('noVehicleResults').style.display = visible === 0 ? '' : 'none';
    });

    // ─── Google Maps ─────────────────────────────────────────────────────────
    function initMap() {
        const origin = @json($consignment->pickup_location ?? '');
        const destination = @json($consignment->delivery_location ?? '');

        if (!origin || !destination) {
            document.getElementById('map').innerHTML = '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:#94a3b8;"><i class="fa fa-map" style="font-size:36px;margin-bottom:10px;"></i><p>No route data available.</p></div>';
            return;
        }

        const mapEl = document.getElementById('map');
        mapEl.innerHTML = '';

        const map = new google.maps.Map(mapEl, {
            zoom: 6,
            center: { lat: 20.5937, lng: 78.9629 },
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: true,
            styles: [
                { featureType: 'poi', stylers: [{ visibility: 'off' }] },
                { featureType: 'transit', stylers: [{ visibility: 'off' }] }
            ]
        });

        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map,
            suppressMarkers: false,
            polylineOptions: { strokeColor: '#3b82f6', strokeWeight: 5, strokeOpacity: 0.85 }
        });

        directionsService.route({
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING,
        }, function (result, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(result);
                const leg = result.routes[0].legs[0];
                document.getElementById('mapDistanceText').textContent = leg.distance.text;
                document.getElementById('mapDurationText').textContent = leg.duration.text;
                document.getElementById('mapDistance').style.display = 'flex';
                document.getElementById('openMapsLink').href =
                    `https://www.google.com/maps/dir/?api=1&origin=${encodeURIComponent(origin)}&destination=${encodeURIComponent(destination)}&travelmode=driving`;
                document.getElementById('openMapsLink').style.display = 'inline';
            } else {
                // Fallback: geocode and show markers
                const geocoder = new google.maps.Geocoder();
                Promise.all([
                    new Promise(resolve => geocoder.geocode({ address: origin }, (r, s) => resolve(s === 'OK' ? r[0].geometry.location : null))),
                    new Promise(resolve => geocoder.geocode({ address: destination }, (r, s) => resolve(s === 'OK' ? r[0].geometry.location : null)))
                ]).then(([originPt, destPt]) => {
                    if (originPt) new google.maps.Marker({ position: originPt, map, label: { text: 'A', color: '#fff' }, icon: { path: google.maps.SymbolPath.CIRCLE, scale: 10, fillColor: '#22c55e', fillOpacity: 1, strokeColor: '#fff', strokeWeight: 2 } });
                    if (destPt) new google.maps.Marker({ position: destPt, map, label: { text: 'B', color: '#fff' }, icon: { path: google.maps.SymbolPath.CIRCLE, scale: 10, fillColor: '#ef4444', fillOpacity: 1, strokeColor: '#fff', strokeWeight: 2 } });
                    if (originPt && destPt) {

                    const bounds = new google.maps.LatLngBounds();
                        bounds.extend(originPt);
                        bounds.extend(destPt);
                        map.fitBounds(bounds);
                    } else if (originPt) { map.setCenter(originPt); map.setZoom(12); }
                });
            }
        });
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
    async defer>
</script>
@endsection
