<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OwnerGalleryController extends Controller
{
  public function index()
  {
    $establishmentselect = Establishment::leftJoin('users', 'establishments.user_id', '=', 'users.id')
        ->where('establishments.user_id', '=', Auth::user()->id)
        ->where('establishments.status', 'active')
        ->select(
            'establishments.*', // All columns from the galleries table
            'establishments.name as establishment_name', // Alias establishment's name
            'users.name as owner_name' // Alias user's name (owner of the establishment)
        )->get();

    $establishments = Gallery::leftJoin('establishments', 'galleries.establishment_id', '=', 'establishments.id')
        ->leftJoin('users', 'establishments.user_id', '=', 'users.id')
        ->where('establishments.user_id', '=', Auth::user()->id)
        ->where('establishments.status', 'active')
        ->select(
            'establishments.*', // All columns from the galleries table
            'establishments.name as establishment_name', // Alias establishment's name
            'users.name as owner_name' // Alias user's name (owner of the establishment)
        )->get();
    return view('livewire.owner-gallery', compact('establishments', 'establishmentselect'));
  }

  public function store(Request $request)
  {
    // Validate the input data
    $request->validate([
        'name' => 'required',
        'image' => 'required', // Max 2MB image
    ]);

    try {
      $path = Storage::put('/public/galleries', $request->image);
      Gallery::create([
        'establishment_id' => $request->establishment_name,
        'name' =>  $request->name,
        'path' => $path
      ]);

      return redirect(route('owners.establishment-galleries'))->with('success', 'Gallery added!');
    } catch (\Exception $e) {
      return redirect(route('owners.establishment-galleries'))->with('error', 'Error creating gallery: ' . $e->getMessage());
    }
  }
}
