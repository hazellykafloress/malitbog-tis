<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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

final class EstablishmentEventTable extends PowerGridComponent
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
    return Event::query()
    ->leftJoin('establishments', 'events.establishment_id', '=', 'establishments.id')
    ->select(
        'events.*',
        'establishments.name as establishment_name',
        DB::raw("DATE_FORMAT(events.created_at, '%M %d, %Y %h:%i %p') as formatted_publish_date"),
        DB::raw("DATE_FORMAT(events.date, '%M %d, %Y') as formatted_date")
    );
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('establishment_name')
      ->add('title')
      ->add('date')
      ->add('created_at');
  }

  public function columns(): array
  {
    return [
      Column::make('Establishment Name', 'establishment_name'),
      Column::make('Title', 'title'),
      Column::make('Date', 'formatted_date'),
      Column::make('Published Date', 'formatted_publish_date'),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  #[\Livewire\Attributes\On('deleteEvent')]
  public function deleteEvent($rowId): void
  {
    $event = Event::where('id', $rowId)->delete();
    if ($event) {
        $this->dispatch('eventDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('eventNotDeleted'); 
    }
  }

  public function actions(Event $row): array
  {
    return [
      // Button::add('edit')
      //   ->slot('Edit')
      //   ->class('btn btn-success btn-sm')
      //   ->route('events.edit', ['event' => $row->id]),

      Button::add('delete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('deleteEvent', ['rowId' => $row->id])
        ->dispatch('confirmDeleteEvent', ['rowId' => $row->id])

    ];
  }

  public function confirmDeleteEvent($rowId)
  {
      $this->emit('showDeleteConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
  }

  /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
