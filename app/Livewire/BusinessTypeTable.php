<?php

namespace App\Livewire;

use App\Models\BusinessType;
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

final class BusinessTypeTable extends PowerGridComponent
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
    return BusinessType::query();
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('name');
  }

  public function columns(): array
  {
    return [
      Column::make('Name', 'name')
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

  #[\Livewire\Attributes\On('deleteBusinessType')]
  public function deleteBusinessType($rowId): void
  {
    $businessType = BusinessType::where('id', $rowId)->delete();
    if ($businessType) {
        $this->dispatch('businesstypeDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('businesstypeNotDeleted'); 
    }
    
  }

  public function confirmDeleteBusinessType($rowId)
  {
      $this->emit('showDeleteConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
  }

  public function actions(BusinessType $row): array
  {
    return [

      Button::add('edit')
        ->slot('Edit')
        ->class('btn btn-success btn-sm')
        ->route('business-types.edit', ['business_type' => $row->id], '_blank'),

      Button::add('delete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteBusinessType', ['rowId' => $row->id])

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
