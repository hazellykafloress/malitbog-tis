<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
  public function index()
  {
    $establishments = Establishment::where('status', 'active')->where('user_id', Auth::user()->id)->get();
    return view('owners.offers.index', compact('establishments'));

  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'price' => 'required',
    ]);

    $offer = Offering::create([
      'establishment_id' => $request->establishment_owner,
      'name' => $request->name,
      'description' => $request->description,
      'price' => $request->price
    ]);

    if ($request->has('image')) {
      $path = Storage::put('/public/offers', $request->image);
      $offer->update(['path' => $path]);
    }

    return redirect(route('owners.establishment-offers'));
  }
}
