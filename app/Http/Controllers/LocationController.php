<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('name')->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:locations,name',
            'description' => 'nullable|string|max:500',
        ]);

        Location::create($request->only(['name', 'description']));

        return redirect()->back()->with('success', 'Location created successfully.');
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:locations,name,' . $location->id,
            'description' => 'nullable|string|max:500',
        ]);

        $location->update($request->only(['name', 'description']));

        return redirect()->back()->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        if ($location->barangs()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete location because it is used by existing items.');
        }

        $location->delete();
        return redirect()->back()->with('success', 'Location deleted successfully.');
    }
}
