<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsEventController extends Controller
{
    public function index()
    {
        $events = Event::select('*',DB::raw("DATE_FORMAT(date, '%M %d, %Y') as formatted_date"))->get();
        $newses = News::select('*',DB::raw("DATE_FORMAT(created_at, '%M %d, %Y') as formatted_date"))->get();
        return view('news-and-events', compact('events', 'newses'));
    }

    public function view(string $type, int $id)
    {
      $toBeDisplay = $type == 'news' ? 
        News::select('*',DB::raw("DATE_FORMAT(created_at, '%M %d, %Y') as formatted_date"))->findOrFail($id) 
        : 
        Event::select('*',DB::raw("DATE_FORMAT(date, '%M %d, %Y') as formatted_date"))->findOrFail($id);

      return view('display', compact('toBeDisplay'));
    }
}
