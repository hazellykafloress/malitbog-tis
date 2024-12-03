<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\BusinessType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
  public function index()
  {
    return view('accounts.index');
  }

  public function create()
  {
    $businessTypes = BusinessType::all();
    return view('accounts.create', compact('businessTypes'));
  }

  public function store(AccountStoreRequest $request)
  {
    $role = Role::whereNot('name', 'admin')->first();
    // Create a new user
    $user = User::create([
      'role_id' => $role->id,
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    // Create the establishment
    Establishment::create([
      'user_id' => $user->id,
      'name' => $request->establishment_name,
      'description' => $request->establishment_description,
      'description' => $request->establishment_description,
      'geolocation_longitude' => $request->establishment_geolocation_latitude,
      'geolocation_latitude' => $request->establishment_geolocation_longitude,
      'address' => $request->establishment_address,
      'mode_of_access' => implode(', ', $request->establishment_mode_of_access),
      'contact_number' => $request->establishment_contact_number,
      'business_type_id' => $request->establishment_type_of_business,
    ]);

    // Redirect back to /accounts
    return redirect('/accounts')->with('success', 'Establishment owner and establishment created successfully!');
  }

  public function edit($id)
  {
    $businessTypes = BusinessType::all();
    $user = User::findOrFail($id);
    return view('accounts.edit', compact('user', 'businessTypes'));
  }

  public function update(AccountUpdateRequest $request, $id)
  {
    // Find the user by ID
    $user = User::findOrFail($id);

    // Update user details
    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      // Only update the password if a new password is provided
      'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
    ]);


    $user->establishment->update([
      'name' => $request->establishment_name,
      'description' => $request->establishment_description,
      'address' => $request->establishment_address,
      'mode_of_access' => implode(', ', $request->establishment_mode_of_access),
      'geolocation_longitude' => $request->establishment_geolocation_latitude,
      'geolocation_latitude' => $request->establishment_geolocation_longitude,
      'contact_number' => $request->establishment_contact_number,
      'business_type_id' => $request->establishment_type_of_business,
    ]);

    return redirect('/accounts')->with('update', 'Account updated successfully.');
  }
}
