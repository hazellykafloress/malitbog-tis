<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function index()
  {
    return view('events.index');
  }

  public function create()
  {
    $establishments = Establishment::where('status', 'active')->get();
    return view('events.create', compact('establishments'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'establishment' => 'required',
      'title' => 'required',
      'date' => 'required',
      'description' => 'required'
    ]);

    Event::create([
      'establishment_id' => $request->establishment,
      ...$request->only([
        'title',
        'date',
        'description'
      ])
    ]);

    return redirect('/events')->with('success', 'Events added successfully.');
  }

  public function edit(Event $event)
  {
    $establishments = Establishment::where('status', 'active')->get();
    return view('events.edit', compact('event', 'establishments'));
  }

  public function update(Request $request, Event $event)
  {
    $request->validate([
      'establishment' => 'required',
      'title' => 'required',
      'date' => 'required',
      'description' => 'required'
    ]);

    $event->update([
      'establishment_id' => $request->establishment,
      ...$request->only([
        'title',
        'date',
        'description'
      ])
    ]);

    return redirect('/events')->with('update', 'Events updated successfully.');

  }
}
