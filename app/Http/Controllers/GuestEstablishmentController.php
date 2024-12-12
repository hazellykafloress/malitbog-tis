<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Models\Establishment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuestEstablishmentController extends Controller
{
    public function index(string $type)
    {
      $businessType = BusinessType::findOrFail($type);
      $establishments = Establishment::leftJoin('users', 'establishments.user_id', '=', 'users.id')
        ->select('establishments.*', 'users.name as owner')
        ->where('establishments.status', 'active')
        ->where('business_type_id', $businessType->id)->get();
        $myname = "Joyce";
      return view('destinations', compact('businessType', 'establishments', 'myname'));
    }

    public function welcome()
    {
      $establishments = Establishment::leftJoin('users', 'establishments.user_id', '=', 'users.id')
        ->select('establishments.*', 'users.name as owner')
        ->where('establishments.status', 'active')
        ->get();
        
      return view('welcome', compact('establishments'));
    }

    public function view(string $type, $id)
    {
      $establishment = Establishment::where('business_type_id', $type)->findOrFail($id);

      return view('desintations-info', compact('establishment'));
    }

    public function apply()
    {
      $businessTypes = BusinessType::all();
      return view('auth.apply', compact('businessTypes'));
    }

    public function store(Request $request)
    {
      $request->validate([
        'establishment_name' => 'required|string|max:255',
        'establishment_description' => 'required|string',
        'establishment_address' => 'required|string|max:255',
        'establishment_contact_number' => 'required|string|max:20',
        'establishment_mode_of_access' => 'required',
        'establishment_type_of_business' => 'required|exists:business_types,id'
      ]);
      
      $role = Role::whereNot('name', 'admin')->first();
      // Create a new user
      $user = User::create([
        'role_id' => $role->id,
        'name' => $request->name,
        'email' => $request->email,
        'status' => 'inactive',
        'password' => Hash::make($request->password),
      ]);

      
      try {
         // Create establishment
        $establishment = Establishment::create([
          'user_id' => $user->id,
          'name' => $request->establishment_name,
          'description' => $request->establishment_description,
          'address' => $request->establishment_address,
          'mode_of_access' => implode(', ', $request->establishment_mode_of_access),
          'geolocation_longitude' => $request->establishment_geolocation_latitude,
          'geolocation_latitude' => $request->establishment_geolocation_longitude,
          'contact_number' => $request->establishment_contact_number,
          'business_type_id' => $request->establishment_type_of_business,
          'status' => 'inactive',
        ]);
        
        if ($request->has('image')) {
          $path = Storage::put('/public/establishments', $request->image);
          $establishment->update(['path' => $path]);
        }

        session(['success' => 'Establishment owner and establishment created successfully.']);
        return redirect(route('login'));
      } catch (\Exception $e) {
        session(['error' => 'Establishment owner and establishment created successfully.']);
        return redirect(route('login'));


      }
    }
}