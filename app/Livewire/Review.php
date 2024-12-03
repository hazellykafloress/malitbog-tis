<?php

namespace App\Livewire;

use App\Models\Review as ModelsReview;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
class Review extends Component
{
  public $establishmentId;
  public $reviews;
  public $name;
  public $rate;
  public $description;
  public $ipAddress; 

  public function saveReview()
  {
    $this->validate([
      'name' => 'required',
      'description' => 'required',
      'rate' => 'required|numeric|integer|min:1|max:5',
    ]);
    // Get the IP address of the user
    $this->ipAddress = Request::ip(); 
    // Check if the same IP has already reviewed this establishment
    $existingReview = ModelsReview::leftJoin('establishments', 'establishments.id', '=', 'reviews.establishment_id')
    ->select('reviews.*', 'establishments.business_type_id')
    ->where('ip_address', $this->ipAddress) // Compare IP address
    ->where('establishment_id', $this->establishmentId) // Compare IP address
    ->first();

    $business_type = ModelsReview::leftJoin('establishments', 'establishments.id', '=', 'reviews.establishment_id')
    ->select('establishments.business_type_id')
    ->where('establishment_id', $this->establishmentId) // Compare IP address
    ->first();
    

    if ($existingReview) {
      return redirect('/destinations'.'/'.$business_type->business_type_id.'/'.$this->establishmentId)->with('error', 'You have already reviewed this establishment from this IP address.');
    }

    ModelsReview::create([
      'establishment_id' => $this->establishmentId,
      'name' => $this->name,
      'ip_address' => $this->ipAddress,
      'description' => $this->description,
      'rate' => $this->rate,
    ]);

    $this->setReviews();

    $this->name = '';
    $this->rate = '';
    $this->description = '';
    $this->ipAddress = '';
  }

  public function setReviews()
  {
    $this->reviews = ModelsReview::where('establishment_id', $this->establishmentId)->get();
  }

  public function mount()
  {
    $this->setReviews();
  }

  public function render()
  {
    return view('livewire.review');
  }
}
