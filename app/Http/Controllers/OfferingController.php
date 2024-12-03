<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferingController extends Controller
{
  public function index()
  {
    return view('offerings.index');
  }

  public function create()
  {
    $establishments = Establishment::where('status', 'active')->get();
    return view('offerings.create', compact('establishments'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'establishment' => 'required',
      'name' => 'required',
      'description' => 'required',
      'price' => 'required',
    ]);

    $offer = Offering::create([
      'establishment_id' => $request->establishment,
      'name' => $request->name,
      'description' => $request->description,
      'price' => $request->price
    ]);

    if ($request->has('image')) {
      $path = Storage::put('/public/offers', $request->image);
      $offer->update(['path' => $path]);
    }

    return redirect('/offerings')->with('success', 'Offering added successfully.');

  }

  public function edit(Offering $offering)
  {
    $establishments = Establishment::where('status', 'active')->get();
    return view('offerings.edit', compact('establishments', 'offering'));
  }

  public function update(Request $request, Offering $offering)
  {
    $request->validate([
      'establishment' => 'required',
      'name' => 'required',
      'description' => 'required',
      'price' => 'required',
    ]);

    $offering->update([
      'establishment_id' => $request->establishment,
      'name' => $request->name,
      'description' => $request->description,
      'price' => $request->price
    ]);

    if ($request->has('image')) {
      if ($offering->path) Storage::delete($offering->path);
      $path = Storage::put('/public/offers', $request->image);
      $offering->update(['path' => $path]);
    }

    return redirect('/offerings')->with('update', 'Offering updated successfully.');
  }
}
