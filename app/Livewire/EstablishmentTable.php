<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use App\Enums\RoleEnum;
use App\Models\Establishment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Offering;
use App\Models\User;
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
use Illuminate\Support\Str;
use PowerComponents\LivewirePowerGrid\Facades\Rule;

final class EstablishmentTable extends PowerGridComponent
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
      ->where('status', 'active')
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

      Column::make('Business Type', 'business_type_id'),
      // Column::make('Status', 'status')
      //   ->sortable()
      //   ->searchable(),

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

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  #[\Livewire\Attributes\On('deleteEstablishment')]
  public function deleteEstablishment($rowId): void
  {
    // $establishment = Establishment::where('id', $rowId)->delete();
    $establishment = Establishment::where('id', $rowId)->update([ 'status' => 'inactive']);
    if ($establishment) {
      $getUser = Establishment::where('id', $rowId)->first();
      User::where('id', $getUser->user_id)->update([ 'status' => 'inactive']);
      $this->dispatch('establishmentDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('establishmentNotDeleted'); 
    }
  }

  public function actions(Establishment $row): array
  {
    return [
      Button::add('view')
        ->slot('View')
        ->class('btn btn-info btn-sm')
        ->route('establishments.show', ['establishment' => $row]),

      Button::add('edit')
        ->slot('Edit')
        ->class('btn btn-success btn-sm')
        ->route('establishments.edit', ['establishment' => $row->id], '_blank'),

      Button::add('delete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteEstablishment', ['rowId' => $row->id])
        
    ];
  }
  


  public function actionRules($row): array
  {
    return [
      // Hide button edit for ID 1
      // Rule::button('edit')
      //   ->when(fn($row) => $row?->owner?->name  !== RoleEnum::ADMINS->value)
      //   ->hide(),

      Rule::button('delete')
        ->when(fn($row) => $row->status === StatusEnum::INACTIVE->value)
        ->hide(),
    ];
  }
}
