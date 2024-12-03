<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'user_id',
    'name',
    'description',
    'path',
    'address',
    'geolocation_longitude',
    'geolocation_latitude',
    'mode_of_access',
    'contact_number',
    'business_type_id',
    'status',
  ];

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function businessType()
  {
    return $this->belongsTo(BusinessType::class, 'business_type_id');
  }

  public function events()
  {
    return $this->hasMany(Event::class, 'establishment_id');
  }

  public function offerings()
  {
    return $this->hasMany(Offering::class, 'establishment_id');
  }

  public function galleries()
  {
    return $this->hasMany(Gallery::class, 'establishment_id');
  }

  public function reviews()
  {
    return $this->hasMany(Review::class, 'establishment_id');
  }
}
