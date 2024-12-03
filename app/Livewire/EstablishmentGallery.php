<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EstablishmentGallery extends Component
{
  use WithFileUploads;

  public $name;
  public $image;
  public $establishment;

  protected $rules = [
    'name' => 'required',
    'image' => 'required'
  ];

  public function save()
  {
    $this->validate();

    $path = Storage::put('/public/galleries', $this->image);
    Gallery::create([
      'establishment_id' => $this->establishment->id,
      'name' => $this->name,
      'path' => $path
    ]);

    $this->image = '';
    $this->name = '';
    $this->dispatch("pg:eventRefresh-OwnerGalleryTable");
  }

  public function render()
  {
    return view('livewire.establishment-gallery');
  }
}
