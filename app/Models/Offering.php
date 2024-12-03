<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offering extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'establishment_id',
    'name',
    'path',
    'description',
    'price',
  ];

  public function establishment()
  {
    return $this->belongsTo(Establishment::class, 'establishment_id');
  }
}
