<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Models\Establishment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OwnerEstablishmentController extends Controller
{
  public function index()
  {
    $establishment = Auth::user()->establishment;
    $businessTypes = BusinessType::all();
    return view('owners.establishments.index', compact('businessTypes', 'establishment'));
  }

  public function update(Request $request)
  {
    $request->validate([
      'establishment_name' => 'required',
      'establishment_description' => 'required',
      'establishment_address' => 'required',
      'establishment_contact_number' => 'required',
      'establishment_mode_of_access' => 'required',
    ]);

    try {
      // Create establishment
      $establishment = Establishment::create([
        'user_id' => Auth::user()->id,
        'name' => $request->establishment_name,
        'description' => $request->establishment_description,
        'address' => $request->establishment_address,
        'mode_of_access' => implode(', ', $request->establishment_mode_of_access),
        'geolocation_longitude' => $request->establishment_geolocation_latitude,
        'geolocation_latitude' => $request->establishment_geolocation_longitude,
        'contact_number' => $request->establishment_contact_number,
        'status' => 'inactive',
        'business_type_id' => $request->establishment_type_of_business,
      ]);
      if ($request->has('image')) {
        $path = Storage::put('/public/establishments', $request->image);
        $establishment->update(['path' => $path]);
      }

      return redirect(route('owners.establishment-index'))->with('success', 'Establishment owner and establishment created successfully.');
    } catch (\Exception $e) {
      return back()->with('error', 'Error creating establishment: ' . $e->getMessage());
    }
  }
}
