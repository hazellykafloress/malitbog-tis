<?php

namespace App\Livewire;

use App\Models\Establishment;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class DestinationTable extends PowerGridComponent
{
  public $businessTypeId;

  public function setUp(): array
  {
    return [
      Header::make()->showSearchInput(),
      Footer::make()
        ->showPerPage()
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
    return Establishment::query()->where('business_type_id', $this->businessTypeId);
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('name')
      ->add('address');
  }

  public function columns(): array
  {
    return [
      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('Address', 'address')
        ->sortable()
        ->searchable(),

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

  public function actions(Establishment $row): array
  {
    return [
      Button::add('view')
        ->slot('See more')
        ->class('btn btn-info')
        ->route('guests.destinations.show', ['type' => $row->business_type_id, 'id' => $row->id], '_blank'),
    ];
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
