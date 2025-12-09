<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::paginate(10); // <--- wajib paginate
        return view('Admin_page.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')->with('success', 'Lokasi ditambahkan!');
    }

    public function tracking($id)
    {
        $location = Location::findOrFail($id);

        return view('Admin_page.locations.tracking', compact('location'));
    }
}
