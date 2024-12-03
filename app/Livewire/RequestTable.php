<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use App\Models\Establishment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Offering;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Support\Str;
use PowerComponents\LivewirePowerGrid\Facades\Rule;

final class RequestTable extends PowerGridComponent
{
  use WithExport;

  public function setUp(): array
  {
    // $this->showCheckBox();

    return [
      Header::make()->showSearchInput(),
      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
    return Establishment::query()
        ->with('owner')
        ->where('status', 'inactive')
        ->select('*', DB::raw("DATE_FORMAT(created_at, '%M %d, %Y') as formatted_date"));
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
{
    return PowerGrid::fields()
        ->add('owner_name', fn($establishment) => e($establishment?->owner?->name ?? 'N/A'))
        ->add('name')
        ->add('address')
        ->add('mode_of_access')
        ->add('contact_number')
        ->add('business_type_id', fn($establishment) => e($establishment->businessType->name ?? 'N/A'))
        ->add('status', fn($establishment) => e(Str::title($establishment->status ?? 'N/A')));
}


  public function columns(): array
  {
    return [
      Column::make('Owner', 'owner_name'),
      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('Address', 'address')
        ->sortable()
        ->searchable(),

      Column::make('Contact', 'contact_number'),

      Column::make('Business Type', 'business_type_id'),

      Column::make('Date Requested', 'formatted_date'),

      Column::make('Status', 'status')
        ->sortable()
        ->searchable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [
      // Filter::select('status', 'status')
      //   ->dataSource(collect([
      //     ['name' => 'Active'],
      //     ['name' => 'Inactive']
      //   ]))
      //   ->optionLabel('name')
      //   ->optionValue('name')
    ];
  }
  public function confirmDeleteEstablishment($rowId)
  {
      $this->emit('showDeleteConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
  }

  public function confirmApproveEstablishment($rowId)
  {
      $this->emit('showApproveConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  #[\Livewire\Attributes\On('deleteEstablishment')]
  public function deleteEstablishment($rowId): void
  {
    $getUser = Establishment::where('id', $rowId)->first();
    $getOwner = User::where('id', $getUser->user_id)->first();
    $owner = $getOwner->name ?? "dear client";
    $number = $getUser->contact_number ?? "";
    $message = "Hello $owner, your $getUser->name establishment application has been rejected!";

    $establishment = Establishment::where('id', $rowId)->delete();
    // $establishment = DB::table('establishments')->where('id', $rowId)->delete();
    if ($establishment) {
        User::where('id', $getUser->user_id)->update([ 'status' => 'active']);
        
        Http::asForm()->post('https://semaphore.co/api/v4/messages', [
          'apikey' => '191998cd60101ec1f81b319a063fb06a',
          'number' => $number,
          'message' => $message,
          'sender_name' => 'SNHS',
      ]);
        Gallery::where('establishment_id', $rowId)->delete();
        Event::where('establishment_id', $rowId)->delete();
        Offering::where('establishment_id', $rowId)->delete();
        $this->dispatch('establishmentDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('establishmentNotDeleted'); 
    }
  }

  #[\Livewire\Attributes\On('approveEstablishment')]
  public function approveEstablishment($rowId): void
  {
    $update = Establishment::where('id', $rowId)->update([ 'status' => 'active']);
    if ($update) {
        $getUser = Establishment::where('id', $rowId)->first();
        $getOwner = User::where('id', $getUser->user_id)->first();
        User::where('id', $getUser->user_id)->update([ 'status' => 'active']);

        $owner = $getOwner->name ?? "";
        $number = $getUser->contact_number ?? "";

        $message = "Hello $owner, your $getUser->name establishment application has been approved!";
        
        Http::asForm()->post('https://semaphore.co/api/v4/messages', [
          'apikey' => '191998cd60101ec1f81b319a063fb06a',
          'number' => $number,
          'message' => $message,
          'sender_name' => 'SNHS',
      ]);

        $this->dispatch('establishmentApproved');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('establishmentNotApproved'); 
    }
  }

  public function actions(Establishment $row): array
  {
    return [
    //   Button::add('view')
    //     ->slot('View')
    //     ->class('btn btn-info btn-sm')
    //     ->route('establishments.show', ['establishment' => $row]),

      Button::add('edit')
        ->slot('Approve')
        ->class('btn btn-info btn-sm')
        ->dispatch('confirmApproveEstablishment', ['rowId' => $row->id]),


      Button::add('delete')
        ->slot('Reject')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteEstablishment', ['rowId' => $row->id])
        
    ];
  }
}
