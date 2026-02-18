# 🚛 Fleet Project — Complete Codebase & API Analysis

---

## 📁 Project Overview

**Framework:** Laravel (PHP)  
**Authentication:** Laravel Sanctum (API), Laravel Session (Web/Admin)  
**Database:** SQLite (dev) / MySQL-compatible  
**Real-time:** Laravel Reverb (WebSockets via Broadcasting)  
**PDF Generation:** Barryvdh DomPDF  
**Multi-Tenant:** Franchise-based multi-tenancy (max 3 franchises)

---

## 🏗️ High-Level Architecture

```
FLEET_PROJECT/
├── routes/
│   ├── api.php          ← Mobile API endpoints (Sanctum Token Auth)
│   └── web.php          ← Admin Panel routes (Session Auth)
├── app/Http/Controllers/
│   ├── api/             ← 4 API controllers (Customer + Driver)
│   └── *.php            ← 25+ Web/Admin controllers
├── app/Models/          ← 20+ Eloquent models
├── app/Notifications/   ← sendNotification (DB channel)
├── app/Http/Middleware/ ← AuthCustomer, AuthDriver
└── config/auth.php      ← 3 guards: web, customer, driver
```

---

## 🔐 Authentication System (3 Guards)

| Guard       | Driver    | Provider  | Model        | Used For           |
|-------------|-----------|-----------|--------------|-------------------|
| `web`       | session   | users     | `User`       | Admin panel login  |
| `customer`  | sanctum   | customers | `Customer`   | Mobile API (customer) |
| `driver`    | sanctum   | drivers   | `Driver`     | Mobile API (driver)|

### Login Flow (Admin)
1. User visits `/` → Franchise selection page
2. Select franchise → stored in session (`selected_franchise_id`, `selected_franchise_name`)
3. Visit `/login` → Enter email + password
4. `LoginController::attemptLogin()` checks user belongs to selected franchise
5. On success → `franchise_id` stored in session → redirect `/admin/dashboard`

### Super Admin
- `User` with `franchise_id = null` or `role_id = 1` → can access all franchises

---

## 🗂️ Database Models & Relationships

### Core Models

#### 1. `User` (Admin Team Members)
- **Table:** `users`
- **Fields:** `name`, `email`, `password`, `mobile`, `role_id`, `franchise_id`, `department`, `position`, `date_of_joining`, `status`, `profile_image`
- **Relations:** `belongsTo(Role)`, `belongsTo(Franchise)`
- **Uses:** `HasApiTokens`, `Notifiable`

#### 2. `Driver` (Driving Team / Field Drivers)
- **Table:** `drivers`
- **Fields:** `driver_id` (auto: DRV001), `name`, `blood_group`, `phone`, `emergency_phone`, `address`, `license_number`, `license_expiry`, `license_type`, `total_trips`, `experience_years`, `status`, `avatar_path`, `kyc_status`
- **Auto-generates:** `driver_id` (DRV001, DRV002...)
- **Statuses:** `on_duty` / `off_duty`
- **KYC Statuses:** `under_review`, `approved`, `rejected`
- **Relations:** `hasMany(Vehicle)`
- **Uses:** `HasApiTokens` (for driver mobile login)

#### 3. `DrivingTeam` (Legacy/Separate Table)
- **Table:** `driving_teams`
- **Fields:** `name`, `driver_id`, `phone_number`, `emergency_number`, `address`, `blood_group`, `license_number`, `license_expiry`, `license_type`, `experience`, `driver_photo`, `license_photo`, `status`, `kyc_status`
- **Note:** This is a separate/older model. `Driver` model is the active one used for API auth.

#### 4. `Customer`
- **Table:** `customers`
- **Fields:** `name`, `address`, `mobile_no`, `email`, `password`, `photo`
- **Uses:** `HasApiTokens` (for customer mobile login), `HasFactory`
- **Appends:** `profile` (URL to photo)
- **Hidden:** `password`

#### 5. `Transport` (Core — Consignments/Trips)
- **Table:** `transports`
- **Fields:** 50+ fields covering the full consignment lifecycle
- **Key Field Groups:**
  - **Route:** `pickup_location`, `delivery_location`, `source_*`, `dest_*`, `pickup_datetime`, `delivery_date`
  - **Cargo:** `weight`, `packages`, `cargoType`, `fragile`, `perishable`, `width`, `height`, `length`
  - **Assignment:** `assigned_vehicle_no`, `assigned_driver`, `assigned_driver_id`, `trip_type` (FTL/LTL/Express)
  - **Costing:** `freight_weight`, `rate_per_unit`, `rate_per_package`, `fixed_cost`, `total_cost`
  - **Expenses:** `expense_types[]`, `expense_amounts[]`, `expense_remarks[]` (JSON arrays)
  - **Docs:** `invoice`, `packageSlip`, `deliveryChallan`, `CargoDocs` (file paths, hidden from JSON)
  - **GPS:** `pickupLatitude`, `pickupLongitude`, `deliveryLatitude`, `deliveryLongitude`
  - **Status:** `draft` → `assigned` → `confirmed` → `in_transit` → `delivered` / `cancelled`
- **Auto-generates:** `order_no` (e.g., `UAE-TR001`, `QTR-TR001`)
- **Relations:** `belongsTo(Customer)`, `belongsTo(Franchise)`, `belongsTo(Driver)`
- **Appends:** `documents` (returns public URLs for all doc files)

#### 6. `Vehicle`
- **Table:** `vehicles`
- **Fields:** `brand`, `model`, `vehicle_number`, `purchase_date`, `registration_year`, `color`, `fuel_type`, `average`, `max_weight`, `current_odometer`, `insurance_valid_till`, `puc_expiry`, `vehicle_type`, `status`, `driver_id`, `image_path`, `documents_path`
- **Statuses:** `available`, `not_available`, `assigned`
- **Relations:** `belongsTo(DrivingTeam)` via `driver_id`

#### 7. `Franchise`
- **Table:** `franchises`
- **Fields:** `country_name`, `currency`, `has_tax`, `tax_percentage`, `is_active`
- **Max:** 3 franchises allowed (hardcoded in FranchiseController)
- **Examples:** Qatar (QR), Saudi Arabia (SAR), UAE (AED)

#### 8. `Brand`
- **Table:** `brands`
- **Fields:** `name`, `slug`, `is_active`, `logo`
- **Relations:** `hasMany(Vehicle)`

#### 9. `Role`
- **Table:** `roles`
- **Fields:** `name`, `slug`, `description`, `is_active`
- **Relations:** `hasMany(User)`

#### 10. `Geography` (Countries)
- **Table:** `geographies`
- **Fields:** `name`, `code`, `currency`, `region`, `description`, `status`, `created_by`, `updated_by`
- **Relations:** `hasMany(City)`, `hasMany(Hub)`, `belongsTo(User)` (creator/updater)

#### 11. `City`
- **Table:** `cities`
- **Relations:** `belongsTo(Geography)`, `belongsTo(Hub)`, `belongsTo(User)`

#### 12. `Hub`
- **Table:** `hubs`
- **Fields:** `name`, `country_id`, `city_id`, `code`, `address`, `contact_person`, `contact_number`, `status`

#### 13. `Pod` (Proof of Delivery)
- **Table:** `pods`
- **Fields:** `transport_id`, `file_name`, `original_name`, `file_path`
- **Appends:** `proof_of_delivery` (public URL)
- **Relations:** `belongsTo(Transport)`

#### 14. `CargoType`
- **Table:** `cargo_types`
- **Fields:** `title`, `description`, `image`

#### 15. Supporting Models (Mostly Stub/Placeholder)
| Model | Table | Notes |
|-------|-------|-------|
| `BillingEntity` | `billing_entities` | Not yet implemented |
| `Fleet` | `fleets` | Not yet implemented |
| `Expense` | `expenses` | Not yet implemented |
| `Tyre` | `tyres` | Not yet implemented |
| `PeakAccount` | `peak_accounts` | Not yet implemented |
| `PerformanceReport` | `performance_reports` | Not yet implemented |
| `AdminPanel` | `admin_panels` | Not yet implemented |
| `UtilityTool` | `utility_tools` | Not yet implemented |
| `HelpCenter` | `help_centers` | Not yet implemented |
| `MyAssistance` | `my_assistances` | Not yet implemented |
| `TeamMember` | `team_members` | Older/legacy, replaced by `User` |

---

## 🌐 API Routes (`/api`) — Full Reference

**Base URL:** `http://yourserver/api`  
**Auth:** Bearer Token (Sanctum) — passed in `Authorization: Bearer {token}` header

---

### 🧪 Test Endpoint
| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| GET | `/api/test` | None | Health check — returns "API is working" |

---

### 👤 Customer API (`/api/customer/...`)

#### Authentication

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/customer/signup` | None | Register new customer |
| POST | `/api/customer/login` | None | Login with email/mobile + password |
| POST | `/api/customer/logout` | `auth:customer` | Logout (delete current token) |
| GET | `/api/customer/profile` | `auth:customer` | Get profile + menu links |
| GET | `/api/customer/profileInfo` | `auth:customer` | Get raw customer data |
| POST | `/api/customer/updateProfile` | `auth:customer` | Update name, mobile, address, photo |

#### Consignment (Order) Management

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/customer/storeConsignment` | `auth:customer` | Create new consignment/order |
| POST | `/api/customer/updateConsignment/{id}` | `auth:customer` | Update existing consignment |
| POST | `/api/customer/deleteConsignment` | `auth:customer` | Delete consignment |
| POST | `/api/customer/showConsignment` | `auth:customer` | View single consignment details |
| POST | `/api/customer/OrderSummary` | `auth:customer` | Get order summary for a consignment |
| POST | `/api/customer/shipmentTracking` | `auth:customer` | Track shipment status |
| POST | `/api/customer/AssignedDriver` | `auth:customer` | Get assigned driver + location data |

#### Driver Location

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/customer/getDriversLocation` | `auth:customer` | Get real-time driver GPS coordinates |

#### Proof of Delivery

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/customer/pod` | `auth:customer` | Get POD for a delivered order |

#### Invoice

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/customer/invoice` | `auth:customer` | Get invoice details for an order |
| POST | `/api/customer/share-invoice` | `auth:customer` | Share invoice via email/WhatsApp |
| POST | `/api/customer/download-invoice` | `auth:customer` | Download invoice file |
| GET | `/api/invoice-download` | None | Download invoice by URL (GET) |

#### Notifications

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| GET | `/api/customer/notifications` | `auth:customer` | List all notifications (paginated) |
| POST | `/api/customer/showNotification` | `auth:customer` | Get a single notification |
| POST | `/api/customer/readNotification` | `auth:customer` | Mark notification as read |
| GET | `/api/customer/unreadNotifications` | `auth:customer` | Get unread notifications only |
| POST | `/api/customer/deleteNotification` | `auth:customer` | Delete one notification |
| GET | `/api/customer/deleteAllNotification` | `auth:customer` | Delete all notifications |

#### Cargo Types (Public)

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/CargoTypeList` | None | List all available cargo types |

---

### 🚗 Driver API (`/api/driver/...`)

All driver routes use `auth:driver` middleware.

| Method | URL | Auth | Description |
|--------|-----|------|-------------|
| POST | `/api/driver/signup` | `auth:driver` | Register new driver (note: requires auth — likely a bug) |
| POST | `/api/driver/login` | `auth:driver` | Driver login (note: requires auth — likely a bug) |
| POST | `/api/driver/logout` | `auth:driver` | Driver logout |
| POST | `/api/driver/updateLocation` | `auth:driver` | Update driver GPS coordinates |

> ⚠️ **Bug Note:** `signup` and `login` are inside the `auth:driver` middleware group, which means they require authentication to access. This is a logical error — signup/login should be public.

---

## 🔍 API Controllers — Deep Dive

---

### 1. `AuthApiController` (`app/Http/Controllers/api/AuthApiController.php`)

**Handles:** Customer signup/login/logout/profile + Driver signup/login/logout

#### `signup(Request $request)` — Customer Registration
- **Validates:** `email` (required, unique), `password` (min 6), `franchise` (required int), optional `name`, `address[]`, `mobile[]`, `billingName`, `billingAddress`
- **Creates:** New `Customer` with bcrypt password
- **Returns:** `{status: true, customer: {...}}`
- **No token issued** on signup (customer must then login)

#### `login(Request $request)` — Customer Login
- **Validates:** Either `email` OR `mobile` required, optional `password`
- **Finds:** Customer by email OR mobile_no
- **Checks:** `Hash::check()` for password
- **Returns:** `access_token` (Bearer), customer data, `otp: 1234` (hardcoded master OTP — dev only)
- **Creates Sanctum token:** `customer_token`

#### `logout(Request $request)` — Customer Logout
- **Deletes** current Sanctum access token
- **Returns:** `{status: true, message: "Logged out successfully"}`

#### `profile(Request $request)` — Customer Profile
- **Returns:** Authenticated customer + menu links (Contact Us, Notifications, Security, Logout) + Privacy Policy, T&C links

#### `profileInfo(Request $request)` — Raw Profile Data
- **Returns:** Just the customer object

#### `updateProfile(Request $request)` — Update Profile
- **Updates:** `name`, `mobile[]`, `address[]`, `billingName`, `billingAddress`, `photo`
- **File upload:** Saves photo to `assets/customer_photos/`
- **Deletes old photo** if exists

#### `driversignup()` — Driver Registration
- **Validates:** Extensive driver fields (license, vehicle details, docs, etc.)
- **Creates** new `Driver` record
- ⚠️ **Bug:** No return statement / response — function ends without returning anything

#### `driverlogin(Request $request)` — Driver Login
- **Finds:** Driver by `mobile_no`
- **Checks:** Password
- **Returns:** Token + driver data + `otp: 1234`

#### `driverlogout(Request $request)` — Driver Logout
- Deletes current Sanctum token

---

### 2. `ConsignmentApiController` (`app/Http/Controllers/api/ConsignmentApiController.php`)

**Handles:** Creating, reading, updating, deleting consignments + tracking + driver assignment + cargo types

#### `store(Request $request)` — Create Consignment
- **Validates:** 60+ fields (type, tripType, pickup/delivery location + coords, cargo details, docs, costs, etc.)
- **Required fields:** `type` (local/international), `tripType` (LTL/FTL), `pickupLocation`, `pickupDate`, `pickupTime`, GPS coords
- **Handles file uploads:** `invoice`, `packageSlip`, `deliveryChallan`, `CargoDocs` → saved to `assets/consignmentDocs/`
- **Sets:** `customer_id` from authenticated user, `consignment_type = "customer"`, `status = "draft"`
- **Sends notification** to customer on success
- ⚠️ **Bug:** References `sendNotification` class without importing it

#### `update(Request $request)` — Update Consignment
- Takes `consignmentId` in request body
- Updates all non-file fields via loop
- Handles boolean casting for `fragile`, `perishable`
- Updates document files if provided

#### `show(Request $request)` — View Single Consignment
- Takes `consignmentId` in request body
- Returns full `Transport` record

#### `destroy(Request $request)` — Delete Consignment
- ⚠️ **Critical Bug:** The authentication check and actual delete logic is inside the `if(!$request->user())` block — meaning delete only executes when user is NOT authenticated. This is broken code.

#### `orderSummary(Request $request)` — Order Summary
- Requires `consignmentId`
- Returns formatted summary: pickup/delivery, dates, weight, distance, travel time, instructions

#### `shipmentTracking(Request $request)` — Shipment Tracking
- Requires `consignmentId`
- Returns `$consignment->shipmentTracking` — but no such relationship is defined on Transport model. Will return `null`.

#### `assignedDriver(Request $request)` — Get Assigned Driver
- Requires `consignmentId`
- Returns: driver info (name, mobile, emergency mobile, license, vehicle type) + pickup/drop GPS coordinates

#### `cargoTypeList(Request $request)` — Cargo Types
- Returns all `CargoType` records

---

### 3. `customerApiController` (`app/Http/Controllers/api/customerApiController.php`)

**Handles:** Driver location, POD, invoice operations

#### `getDriversLocation(Request $request)` — Driver Location
- Validates `driverId` (alpha_num, exists in `drivers.driver_id`)
- Returns: `latitude`, `longitude`, `recorded_at` from Driver record

#### `proofOfDelivery(Transport $consignmentId, Request $request)` — POD
- Validates `consignmentId`
- Fetches `Pod` + `Transport` (with driver) + `Customer` email
- Only returns POD if `status == 'delivered'`
- Returns: POD URL, order details, driver details, receiver details

#### `invoice(Request $request)` — Invoice Data
- Returns detailed invoice JSON with hardcoded sender details ("Logistics 9 FZCO")
- Returns: order, shipment, package, payment details
- ⚠️ **Bug:** `'status' => paid` — `paid` is unquoted (undefined constant), will cause error in PHP 8+

#### `downloadInvoice(Request $request)` — Download Invoice (POST)
- Downloads the invoice file from server path

#### `invoiceDownload(Request $request)` — Download Invoice (GET)
- Fetches invoice from `documents['invoice']` accessor on Transport model
- Strips domain from URL if stored as full URL
- Returns file download response

#### `shareInvoice(Request $request)` — Share Invoice
- Validates: `consignmentId`, `share_via` (email/whatsapp), `receipent`, `email`, `format` (pdf/link)
- ⚠️ **Note:** Does NOT actually send — just returns validation confirmation

---

### 4. `driverApiController` (`app/Http/Controllers/api/driverApiController.php`)

**Handles:** Driver GPS location update

#### `updateLocation(Request $request)` — Update Driver Location
- Validates: `latitude`, `longitude` (decimal with up to 10 decimal places)
- Gets authenticated driver via `auth()->user()`
- Saves `latitude` + `longitude` to drivers table
- Returns updated coordinates

---

## 🖥️ Web (Admin) Controllers — Deep Dive

---

### 1. `DashboardController`
- **Route:** `GET /admin/dashboard`
- **Shows:** Ongoing trips (not completed/cancelled/delivered), total vehicles, total drivers, active duties count
- **Filters** by `franchise_id` from session

---

### 2. `FranchiseController`
- **Routes:** `/` (index) + full CRUD on `/franchises/`
- **Max 3 franchises** enforced
- **`login(id)`:** Stores `selected_franchise_id`, `selected_franchise_name`, `selected_franchise_currency` in session → redirects to login page
- Key: This is the ENTRY POINT of the entire admin system

---

### 3. `TeamMemberController`
- **Model:** `User`
- **Routes:** `/admin/team-members` (full resource)
- **Extra:** `POST team-members/{id}/toggle-status` — toggle Active/Inactive
- **Features:** Manages admin users with roles, profile image upload to `profile_images/`
- **Excludes** `adminqwikhom@gmail.com` (hardcoded system admin) from listing

---

### 4. `DrivingTeamController`
- **Model:** `Driver`
- **Routes:** `/admin/driving-team` (full resource)
- **Features:**
  - Create/edit drivers with photo upload to `driver_photos/`
  - `approveKyc(id)` → sets `kyc_status = 'approved'`
  - `rejectKyc(id)` → sets `kyc_status = 'rejected'` (method exists but no route defined)
  - `toggleStatus(id)` → switches `on_duty` ↔ `off_duty` (method exists but no route defined)
- **Default values on create:** `status = 'off_duty'`, `kyc_status = 'under_review'`

---

### 5. `VehicleMonitoringController`
- **Model:** `Vehicle` + `Brand` + `Driver`
- **Routes:** `/admin/vehicle-monitoring` (full resource) + extra routes
- **Features:**
  - Lists vehicles grouped by brand
  - `showVehicle(id)` → individual vehicle detail page
  - `updateStatus(id)` → AJAX JSON response — change vehicle status
  - `updateDriverStatus(id)` → AJAX JSON response — change driver status
  - File uploads: `vehicle_photos/`, `vehicle_documents/`
- **Note:** Uses `DrivingTeam` model for driver dropdown but stores in `Driver` model for status updates

---

### 6. `NewConsignmentController`
- **Model:** `Transport` + `Vehicle` + `Franchise`
- **Purpose:** 3-Step Multi-Step Consignment Creation Flow (Admin-created trips)
- **Flow:**
  1. **Step 1 - Route & Parties** (`/admin/new-consignment/create`) → stores `transport_id` in session
  2. **Step 2 - Freight Assignment** (`/admin/freight-assignment`) → assigns vehicle, driver, trip type, sets status to `assigned`
  3. **Step 3 - Charges & Advance** (`/admin/charges-advance`) → calculates costs, sets status to `confirmed`
  4. **Booking Confirmed** (`/admin/booking-confirmed`) → success page, clears session
- **Edit Flow:** Each step has dedicated edit routes that restart the session flow
- **Vehicle Management:** Marks vehicle as `assigned` on freight assignment, frees it if vehicle changed
- **Freight Calculation:**
  - By Weight: `freight_weight × rate_per_unit`
  - By Package: `total_packages × rate_per_package`
  - Fixed: `fixed_cost`
  - Total = freight cost + sum of all expenses

---

### 7. `ConsignmentController`
- **Model:** `Transport` + `Vehicle` + `DrivingTeam`
- **Purpose:** View/manage all consignments (listing + details)
- **Features:**
  - Filters by `franchise_id` from session
  - `edit(id)` → smart redirect based on consignment status (draft→step1, assigned→step2/3, confirmed→step3)
  - `generateInvoicePDF(id)` → generates DomPDF invoice with franchise-specific invoice number (`INV/UAE/00001`)

---

### 8. `CustomerController`
- **Model:** `Customer`
- **Routes:** `/admin/customer` (full resource)
- **Features:** CRUD for customers, photo upload to `customer_photos/`, search by name/email/mobile

---

### 9. `CustomerConsignmentController`
- **Model:** `Transport` + `Customer` + `Vehicle`
- **Purpose:** Manage consignments created by customers (via mobile app) from admin side
- **Flow:** Similar 3-step flow as NewConsignmentController but for customer-type consignments
  1. Create → assign customer + route
  2. Freight Assignment → party LR, packages, weight, trip type, distance
  3. Charges & Advance → notes, confirms order
  4. Booking Confirm page
  5. Vehicle Assignment (admin) → assign vehicle + driver IDs
- **Listing:** Shows only `consignment_type = 'customer'` transports with search + status filter

---

### 10. `TripStatusController`
- **Model:** `Transport` + `Vehicle` + `DrivingTeam`
- **Routes:** `/admin/trip-status`
- **Features:**
  - Lists all trips with status
  - `view(id)` → detailed trip page with **timeline** (auto-built from transport status)
  - `updateStatus(id)` → AJAX JSON endpoint — changes trip status
  - Status values: `draft`, `assigned`, `confirmed`, `in_transit`, `delivered`, `cancelled`
  - Auto-sets `delivery_date = now()` when status changed to `delivered`
  - **Timeline builder** (`buildTimeline()`) creates step-by-step journey events

---

### 11. `PodController`
- **Model:** `Pod` + `Transport`
- **Routes:** `/admin/pod/{transportId}`
- **Features:**
  - Upload multiple POD files per consignment
  - Files stored in `public/pod/{transportId}/`
  - Download + view files
  - Delete individual POD files

---

### 12. `InvoiceController`
- **Model:** `Transport`
- **Routes:** `/admin/invoice`
- **Features:**
  - Lists all transports as invoices (paginated, 10/page)
  - View invoice details
  - Download PDF (DomPDF) with franchise-specific number

---

### 13. `GeographyController`
- **Models:** `Geography` (Countries), `City`, `Hub`
- **Features:** Full CRUD for Countries, Cities, Hubs in one controller
  - Toggle status (active/inactive) for each entity via AJAX
  - `getHubsByCountry(countryId)` → AJAX JSON for dropdown
  - `getCitiesByCountry(countryId)` → AJAX JSON for dropdown
  - Prevents deletion of country if it has cities
  - Prevents deletion of city if it has hubs

---

### 14. `BrandController`
- **Model:** `Brand`
- **Features:** CRUD for vehicle brands, logo upload to `logos/`
- **Prevents deletion** if brand has associated vehicles
- Auto-generates `slug` from name

---

### 15. `RoleController`
- **Model:** `Role`
- **Returns JSON** (not views) — acts like a mini-API for roles
- **Prevents deletion** if role is assigned to users
- Auto-generates `slug` from name (Str::slug)

---

### 16. `cargoController`
- **Model:** `CargoType`
- **Features:** CRUD for cargo types, image upload to `assets/cargoImages/`
- ⚠️ **Bug:** `show()` redirects to route that doesn't exist properly

---

### 17. `sendNotificationController`
- **Model:** Uses Laravel's built-in `notifications` table
- **Used via:** API routes only (customer notifications)
- **Features:**
  - `index()` — paginated notifications list (limit 1-50)
  - `unread()` — unread notifications only
  - `markAsRead()` — mark single notification as read
  - `markAllAsRead()` — mark all as read
  - `destroy()` — delete single notification
  - `destroyAll()` — delete all notifications
  - `sendNotification()` — manually send test notification

---

### 18. Stub Controllers (Views Only — No Business Logic)

| Controller | Routes | Status |
|-----------|--------|--------|
| `BillingEntityController` | `/admin/billing-entities` | Stub — no DB operations |
| `FleetManagementController` | `/admin/fleet-management` | Stub — no DB operations |
| `TransportManagementController` | `/admin/transport-management` | Stub — no DB operations |
| `VehicleMaintenanceController` | `/admin/vehicle-maintenance` | Stub — no DB operations |
| `ExpenseTrackingController` | `/admin/expense-tracking` | Stub — no DB operations |
| `PeakAccountController` | `/admin/peak-accounts` | Stub — no DB operations |
| `TyreMaintenanceController` | `/admin/tyre-maintenance` | Stub — no DB operations |
| `TyreStockController` | `/admin/tyre-stock` | Stub — no DB operations |
| `PerformanceReportController` | `/admin/performance-reports` | Stub — no DB operations |
| `AdminPanelController` | `/admin/admin-panel` | Stub — no DB operations |
| `UtilitiesToolsController` | `/admin/utilities-tools` | Stub — no DB operations |
| `HelpCenterController` | `/admin/help-center` | Stub — no DB operations |
| `MyAssistanceController` | `/admin/my-assistance` | Stub — no DB operations |

---

## 🔔 Notifications System

**Class:** `App\Notifications\sendNotification`  
**Channel:** `database` only (stored in `notifications` table)  
**Constructor:** `($title, $message, $type)`  
**Usage:** `$user->notify(new sendNotification('Title', 'Message', 'type'))`  
**Currently triggered:** When customer creates a consignment (via `storeConsignment`)  
**Managed via:** `sendNotificationController` (API)

---

## 📡 Real-Time (Reverb/WebSockets)

- **Event:** `App\Events\TestBroadcast`
- **Route:** `GET /test-broadcast` → triggers test broadcast
- **Config:** `config/reverb.php`, `config/broadcasting.php`
- **Status:** Currently only test broadcast exists — no real-time consignment updates implemented yet

---

## 🗺️ Franchise-Based Multi-Tenancy

All data filtering is done via `session('franchise_id')`:

```php
// Pattern used everywhere in controllers:
$franchiseId = session('franchise_id');
if ($franchiseId) {
    $query->where('franchise_id', $franchiseId);
}
```

- Supported franchises: Qatar (QTR), Saudi Arabia (SAU), UAE (UAE)
- Invoice numbers: `INV/UAE/00001`, `INV/QTR/00001`, etc.
- Order numbers: `UAE-TR001`, `QTR-TR001`, etc.
- Max 3 franchises enforced in `FranchiseController::MAX_FRANCHISES = 3`

---

## ⚠️ Known Bugs & Issues

| # | Location | Bug Description |
|---|----------|----------------|
| 1 | `api/ConsignmentApiController::destroy()` | Entire delete logic is inside the `if(!$request->user())` block — code executes when user is NOT logged in (completely broken) |
| 2 | `api/AuthApiController::driversignup()` | No return statement — function doesn't return any response |
| 3 | `api/customerApiController::invoice()` | `'status' => paid` — unquoted constant, will throw PHP error |
| 4 | `api/ConsignmentApiController::store()` | References `sendNotification` without use import — will throw class not found error |
| 5 | `api/ConsignmentApiController::shipmentTracking()` | Returns `$consignment->shipmentTracking` — relationship not defined on Transport model, always null |
| 6 | `routes/api.php` | Driver `signup` and `login` inside `auth:driver` middleware — impossible to call without already being logged in |
| 7 | `cargoController::show()` | Redirects to non-existent route instead of returning a view |
| 8 | `customerApiController::shareInvoice()` | Does not actually send anything — just returns validation data |
| 9 | `api/AuthApiController::updateProfile()` | Uses `$request->validate()` instead of `Validator::make()`, then checks `if (!$validator)` which is always false (validate throws exception, not returns false) |
| 10 | `VehicleMonitoringController` | Uses `DrivingTeam` model for driver dropdown (create/edit) but `Driver` model for status update — inconsistency |

---

## 📋 File Upload Summary

| Feature | Upload Path | Field Names |
|---------|------------|-------------|
| Customer photo | `public/customer_photos/` | `photo` |
| Driver photo | `public/driver_photos/` | `driverPhoto` (web), `avatar_path` (stored) |
| Vehicle photo | `public/vehicle_photos/` | `vehicle_photo` |
| Vehicle documents | `public/vehicle_documents/` | `vehicle_documents` |
| Team member photo | `public/profile_images/` | `profile_image` |
| Brand logo | `public/logos/` | `logo` |
| Cargo type image | `public/assets/cargoImages/` | `image` |
| Consignment docs | `public/assets/consignmentDocs/` | `invoice`, `packageSlip`, `deliveryChallan`, `CargoDocs` |
| POD files | `public/pod/{transportId}/` | `files[]` |

---

## 🔑 Key Request Payload Examples

### Customer Signup
```json
POST /api/customer/signup
{
  "email": "customer@example.com",
  "password": "password123",
  "franchise": 1,
  "name": "John Doe",
  "mobile": ["9876543210"],
  "address": ["123 Main St"],
  "billingName": "John Billing",
  "billingAddress": "456 Office Rd"
}
```

### Customer Login
```json
POST /api/customer/login
{
  "email": "customer@example.com",
  "password": "password123"
}
// OR
{
  "mobile": "9876543210",
  "password": "password123"
}
```

### Create Consignment
```json
POST /api/customer/storeConsignment
Headers: Authorization: Bearer {token}
{
  "type": "local",
  "tripType": "LTL",
  "pickupLocation": "Dubai, UAE",
  "pickupDate": "2026-03-01",
  "pickupTime": "09:00",
  "pickup_latitude": "25.2048",
  "pickup_longitude": "55.2708",
  "delivery_latitude": "24.4539",
  "delivery_longitude": "54.3773",
  "delivery_location": "Abu Dhabi, UAE",
  "receiver_name": "Ahmed Ali",
  "receiver_mobile": "0501234567",
  "cargoType": 1,
  "weight": 500,
  "weight_unit": "KG",
  "total_packages": 10
}
```

### Update Driver Location
```json
POST /api/driver/updateLocation
Headers: Authorization: Bearer {token}
{
  "latitude": "25.2048000000",
  "longitude": "55.2708000000"
}
```

### Get Order Summary
```json
POST /api/customer/OrderSummary
Headers: Authorization: Bearer {token}
{
  "consignmentId": 5
}
```

---

## 🌳 Complete Route Tree (Admin Web)

```
/                              → Franchise Selection
/franchises/create             → Create Franchise
/franchises/{id}/login         → Select Franchise & Go to Login
/login                         → Admin Login Form

/admin/dashboard               → Dashboard

/admin/team-members            → Users/Staff CRUD
/admin/driving-team            → Driver CRUD + KYC Approval
/admin/billing-entities        → Billing (stub)

/admin/vehicle-monitoring      → Vehicle CRUD
/admin/vehicle-monitoring/vehicle/{id} → Individual Vehicle

/admin/brands                  → Vehicle Brands CRUD
/admin/roles                   → Role Management (JSON API)

/admin/new-consignment         → Step 1: Route & Parties
/admin/freight-assignment      → Step 2: Vehicle Assignment
/admin/charges-advance         → Step 3: Costing
/admin/booking-confirmed       → Success Page

/admin/consignment             → All Consignments Listing
/admin/consignment/{id}/invoice/pdf → PDF Download

/admin/customer                → Customer CRUD
/admin/customer-consignment    → Customer Consignments (admin view)

/admin/trip-status             → Trip Status Management
/admin/pod/{transportId}       → Proof of Delivery
/admin/invoice                 → Invoice Listing + PDF

/admin/geography               → Countries CRUD
/admin/countries               → Countries (duplicate routes)
/admin/cities                  → Cities CRUD
/admin/hubs                    → Hubs CRUD

/admin/cargoTypes              → Cargo Types CRUD

/admin/fleet-management        → Fleet (stub)
/admin/vehicle-maintenance     → Vehicle Maintenance (stub)
/admin/expense-tracking        → Expense Tracking (stub)
/admin/peak-accounts           → Peak Accounts (stub)
/admin/tyre-maintenance        → Tyre Maintenance (stub)
/admin/tyre-stock              → Tyre Stock (stub)
/admin/performance-reports     → Performance Reports (stub)
/admin/admin-panel             → Admin Panel Settings (stub)
/admin/utilities-tools         → Utilities (stub)
/admin/help-center             → Help Center (stub)
/admin/my-assistance           → My Assistance (stub)
```

---

## 🔄 Consignment Lifecycle

```
[Customer App]              [Admin Panel]
     |                           |
  storeConsignment()         new-consignment/create
     |                           |
  status: draft              status: draft
     |                           |
     |                    freight-assignment
     |                           |
     |                      status: assigned
     |                           |
     |                    charges-advance
     |                           |
     |                      status: confirmed
     |                           |
                            trip-status (in_transit)
                                 |
                            trip-status (delivered)
                                 |
                            POD Upload
                            Invoice Generated
```

---

## 🏁 Summary

This is a **multi-franchise logistics/fleet management system** with:

1. **Admin Panel** (Web/Session) — Full fleet + consignment management with franchise isolation
2. **Mobile API** (REST/Sanctum) — Customer app (book shipments, track, POD, invoice) + Driver app (location updates)
3. **Core Entities:** Transports (consignments), Drivers, Vehicles, Customers, Franchises
4. **3 Auth Guards:** `web` (admin), `customer` (Sanctum), `driver` (Sanctum)
5. **Multi-step workflow** for consignment creation (admin) and booking (customer)
6. **PDF invoice generation** with franchise-specific numbering
7. **Real-time infrastructure** in place (Reverb) but not yet used productively
8. **~13 stub controllers** waiting for backend logic to be implemented

---
*Analysis generated: February 2026*
