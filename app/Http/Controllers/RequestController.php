<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Models\Establishment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RequestController extends Controller
{
  public function index()
  {
    return view('requests.index');
  }
  
}
