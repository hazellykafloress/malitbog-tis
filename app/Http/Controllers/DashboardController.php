<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Offering;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $owners = User::where('role_id', '!=', 1)->count();
    $establishments = Establishment::where('status', 'active')->count();
    $galleries = Gallery::leftJoin('establishments', 'galleries.establishment_id', '=', 'establishments.id')
      ->where('establishments.status', 'active')->count();

    $offerings = Offering::leftJoin('establishments', 'offerings.establishment_id', '=', 'establishments.id')
      ->where('establishments.status', 'active')->count();

    $news = News::count();
    $events = Event::count();

    $growth = [
      1,
      1,
      1,
      1,
      5,
      5,
      6,
  ];

    return view('dashboard.index', compact('user', 'owners', 'establishments', 'galleries', 'offerings', 'news', 'events', 'growth'));
  }
}
