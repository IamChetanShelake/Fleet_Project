<?php

namespace App\Http\Controllers;

use App\Models\Geography;
use App\Models\City;
use App\Models\Hub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GeographyController extends Controller
{
    /**
     * Display a listing of geographies (countries).
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $geographies = Geography::with(['createdBy', 'updatedBy'])->paginate($perPage);
        return view('admin.geography.index', compact('geographies'));
    }

    /**
     * Display cities page.
     */
    public function cities(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $cities = City::with(['country', 'hub', 'createdBy', 'updatedBy']);

        // Filter by country if provided
        if ($request->has('country_id') && $request->country_id) {
            $cities->where('country_id', $request->country_id);
        }

        $cities = $cities->paginate($perPage);
        $countries = Geography::where('status', true)->get();
        $hubs = Hub::where('status', true)->get();

        return view('admin.geography.cities', compact('cities', 'countries', 'hubs'));
    }

    /**
     * Display hubs page.
     */
    public function hubs(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $hubs = Hub::with(['country', 'city', 'createdBy', 'updatedBy']);

        // Filter by country if provided
        if ($request->has('country_id') && $request->country_id) {
            $hubs->where('country_id', $request->country_id);
        }

        $hubs = $hubs->paginate($perPage);
        $countries = Geography::where('status', true)->get();

        return view('admin.geography.hubs', compact('hubs', 'countries'));
    }

    /**
     * Show the form for creating a new geography.
     */
    public function create()
    {
        return view('admin.geography.create');
    }

    /**
     * Store a newly created geography, city, or hub.
     */
    public function store(Request $request)
    {
        Log::info('Geography store request', $request->all());

        try {
            // Determine the type based on submitted fields
            if ($request->has('country_name')) {
                Log::info('Creating country');

                // Creating a country
                $request->validate([
                    'country_name' => 'required|string|max:255|unique:geographies,name',
                    'country_code' => 'required|string|max:10|unique:geographies,code',
                    'currency' => 'nullable|string|max:10',
                    'region' => 'nullable|string|max:255',
                    'description' => 'nullable|string',
                    'status' => 'boolean'
                ]);

                $geography = Geography::create([
                    'name' => $request->country_name,
                    'code' => $request->country_code,
                    'currency' => $request->currency,
                    'region' => $request->region,
                    'description' => $request->description,
                    'status' => $request->status ?? true,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);

                Log::info('Country created', ['id' => $geography->id]);

                return redirect()->route('admin.geography.index')->with('success', 'Country created successfully.');
            }
            elseif ($request->has('city_name')) {
                Log::info('Creating city');

                // Creating a city
                $request->validate([
                    'city_name' => 'required|string|max:255',
                    'city_country_id' => 'required|exists:geographies,id',
                    'city_hub_id' => 'nullable|exists:hubs,id',
                    'postal_code' => 'nullable|string|max:20',
                    'latitude' => 'nullable|numeric|between:-90,90',
                    'longitude' => 'nullable|numeric|between:-180,180',
                    'timezone' => 'nullable|string|max:50',
                    'city_status' => 'boolean'
                ]);

                $city = City::create([
                    'name' => $request->city_name,
                    'country_id' => $request->city_country_id,
                    'hub_id' => $request->city_hub_id,
                    'postal_code' => $request->postal_code,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'timezone' => $request->timezone,
                    'status' => $request->city_status ?? true,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);

                Log::info('City created', ['id' => $city->id]);

                return redirect()->route('admin.geography.cities')->with('success', 'City created successfully.');
            }
            elseif ($request->has('hub_name')) {
                Log::info('Creating hub');

                // Creating a hub
                $request->validate([
                    'hub_name' => 'required|string|max:255',
                    'hub_country_id' => 'required|exists:geographies,id',
                    'hub_code' => 'required|string|max:10|unique:hubs,code',
                    'hub_address' => 'nullable|string',
                    'hub_contact_person' => 'nullable|string|max:255',
                    'hub_contact_number' => 'nullable|string|max:20',
                    'hub_status' => 'boolean'
                ]);

                $hub = Hub::create([
                    'name' => $request->hub_name,
                    'country_id' => $request->hub_country_id,
                    'code' => $request->hub_code,
                    'address' => $request->hub_address,
                    'contact_person' => $request->hub_contact_person,
                    'contact_number' => $request->hub_contact_number,
                    'status' => $request->hub_status ?? true,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);

                Log::info('Hub created', ['id' => $hub->id]);

                return redirect()->route('admin.geography.hubs')->with('success', 'Hub created successfully.');
            }

            Log::warning('Invalid form submission - no recognized fields');
            return redirect()->back()->with('error', 'Invalid form submission.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error in geography store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified geography.
     */
    public function edit(string $id)
    {
        $geography = Geography::findOrFail($id);
        return view('admin.geography.edit', compact('geography'));
    }

    /**
     * Update the specified geography.
     */
    public function update(Request $request, string $id)
    {
        $geography = Geography::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:geographies,name,' . $id,
            'code' => 'required|string|max:10|unique:geographies,code,' . $id,
            'currency' => 'nullable|string|max:10',
            'region' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $geography->update([
            'name' => $request->name,
            'code' => $request->code,
            'currency' => $request->currency,
            'region' => $request->region,
            'description' => $request->description,
            'status' => $request->status ?? true,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.geography.index')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified geography.
     */
    public function destroy(string $id)
    {
        $geography = Geography::findOrFail($id);

        // Check if geography has cities
        if ($geography->cities()->count() > 0) {
            return redirect()->route('admin.geography.index')->with('error', 'Cannot delete geography as it has associated cities.');
        }

        $geography->delete();

        return redirect()->route('admin.geography.index')->with('success', 'Geography deleted successfully.');
    }

    /**
     * Toggle geography status.
     */
    public function toggleStatus(string $id)
    {
        $geography = Geography::findOrFail($id);
        $geography->update([
            'status' => !$geography->status,
            'updated_by' => Auth::id()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle city status.
     */
    public function toggleCityStatus(string $id)
    {
        $city = City::findOrFail($id);
        $city->update([
            'status' => !$city->status,
            'updated_by' => Auth::id()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle hub status.
     */
    public function toggleHubStatus(string $id)
    {
        $hub = Hub::findOrFail($id);
        $hub->update([
            'status' => !$hub->status,
            'updated_by' => Auth::id()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new country.
     */
    public function createCountry()
    {
        return view('admin.geography.country-create');
    }

    /**
     * Display the specified country.
     */
    public function showCountry(string $id)
    {
        $country = Geography::with(['cities', 'hubs', 'createdBy', 'updatedBy'])->findOrFail($id);
        return view('admin.geography.country-show', compact('country'));
    }

    /**
     * Store a newly created country.
     */
    public function storeCountry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:geographies,name',
            'code' => 'required|string|max:10|unique:geographies,code',
            'currency' => 'nullable|string|max:10',
            'region' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        Geography::create([
            'name' => $request->name,
            'code' => $request->code,
            'currency' => $request->currency,
            'region' => $request->region,
            'description' => $request->description,
            'status' => $request->status ?? true,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
    }

    /**
     * Show the form for editing the specified country.
     */
    public function editCountry(string $id)
    {
        $country = Geography::findOrFail($id);
        return view('admin.geography.country-edit', compact('country'));
    }

    /**
     * Update the specified country.
     */
    public function updateCountry(Request $request, string $id)
    {
        $country = Geography::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:geographies,name,' . $id,
            'code' => 'required|string|max:10|unique:geographies,code,' . $id,
            'currency' => 'nullable|string|max:10',
            'region' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $country->update([
            'name' => $request->name,
            'code' => $request->code,
            'currency' => $request->currency,
            'region' => $request->region,
            'description' => $request->description,
            'status' => $request->status ?? true,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified country.
     */
    public function destroyCountry(string $id)
    {
        $country = Geography::findOrFail($id);

        // Check if country has cities
        if ($country->cities()->count() > 0) {
            return redirect()->route('admin.countries.index')->with('error', 'Cannot delete country as it has associated cities.');
        }

        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }

    /**
     * Show the form for creating a new city.
     */
    public function createCity()
    {
        $countries = Geography::where('status', true)->get();
        return view('admin.geography.city-create', compact('countries'));
    }

    /**
     * Display the specified city.
     */
    public function showCity(string $id)
    {
        $city = City::with(['country', 'hub', 'createdBy', 'updatedBy'])->findOrFail($id);
        return view('admin.geography.city-show', compact('city'));
    }

    /**
     * Store a newly created city.
     */
    public function storeCity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:geographies,id',
            'hub_id' => 'nullable|exists:hubs,id',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'timezone' => 'nullable|string|max:50',
            'status' => 'boolean'
        ]);

        City::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'hub_id' => $request->hub_id,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'timezone' => $request->timezone,
            'status' => $request->status ?? true,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.geography.cities')->with('success', 'City created successfully.');
    }

    /**
     * Show the form for editing the specified city.
     */
    public function editCity(string $id)
    {
        $city = City::findOrFail($id);
        $countries = Geography::where('status', true)->get();
        $hubs = Hub::where('status', true)->get();
        return view('admin.geography.city-edit', compact('city', 'countries', 'hubs'));
    }

    /**
     * Update the specified city.
     */
    public function updateCity(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:geographies,id',
            'hub_id' => 'nullable|exists:hubs,id',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'timezone' => 'nullable|string|max:50',
            'status' => 'boolean'
        ]);

        $city->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'hub_id' => $request->hub_id,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'timezone' => $request->timezone,
            'status' => $request->status ?? true,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.geography.cities')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified city.
     */
    public function destroyCity(string $id)
    {
        $city = City::findOrFail($id);

        // Check if city has hubs
        if ($city->hubs()->count() > 0) {
            return redirect()->route('admin.geography.cities')->with('error', 'Cannot delete city as it has associated hubs.');
        }

        $city->delete();

        return redirect()->route('admin.geography.cities')->with('success', 'City deleted successfully.');
    }

    /**
     * Show the form for creating a new hub.
     */
    public function createHub()
    {
        $countries = Geography::where('status', true)->get();
        $cities = City::where('status', true)->get();
        return view('admin.geography.hub-create', compact('countries', 'cities'));
    }

    /**
     * Display the specified hub.
     */
    public function showHub(string $id)
    {
        $hub = Hub::with(['country', 'city', 'createdBy', 'updatedBy'])->findOrFail($id);
        return view('admin.geography.hub-show', compact('hub'));
    }

    /**
     * Store a newly created hub.
     */
    public function storeHub(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:geographies,id',
            'city_id' => 'required|exists:cities,id',
            'code' => 'required|string|max:10|unique:hubs,code',
            'address' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'status' => 'boolean'
        ]);

        Hub::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'code' => $request->code,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'contact_number' => $request->contact_number,
            'status' => $request->status ?? true,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.geography.hubs')->with('success', 'Hub created successfully.');
    }

    /**
     * Show the form for editing the specified hub.
     */
    public function editHub(string $id)
    {
        $hub = Hub::findOrFail($id);
        $countries = Geography::where('status', true)->get();
        $cities = City::where('status', true)->get();
        return view('admin.geography.hub-edit', compact('hub', 'countries', 'cities'));
    }

    /**
     * Update the specified hub.
     */
    public function updateHub(Request $request, string $id)
    {
        $hub = Hub::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:geographies,id',
            'city_id' => 'required|exists:cities,id',
            'code' => 'required|string|max:10|unique:hubs,code,' . $id,
            'address' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'status' => 'boolean'
        ]);

        $hub->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'code' => $request->code,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'contact_number' => $request->contact_number,
            'status' => $request->status ?? true,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('admin.geography.hubs')->with('success', 'Hub updated successfully.');
    }

    /**
     * Remove the specified hub.
     */
    public function destroyHub(string $id)
    {
        $hub = Hub::findOrFail($id);
        $hub->delete();

        return redirect()->route('admin.geography.hubs')->with('success', 'Hub deleted successfully.');
    }

    /**
     * Get hubs by country for AJAX requests.
     */
    public function getHubsByCountry(string $countryId)
    {
        $hubs = Hub::where('country_id', $countryId)->where('status', true)->get(['id', 'name']);
        return response()->json($hubs);
    }

    /**
     * Get cities by country for AJAX requests.
     */
    public function getCitiesByCountry(string $countryId)
    {
        $cities = City::where('country_id', $countryId)->where('status', true)->get(['id', 'name']);
        return response()->json($cities);
    }
}
