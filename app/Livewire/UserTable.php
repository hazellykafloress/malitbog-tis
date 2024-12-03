<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use App\Models\User;
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
use Illuminate\Support\Str;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Table;

final class UserTable extends PowerGridComponent
{
  use WithExport;

  public string $tableName = 'UserTable';

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
    return User::leftJoin('roles', 'users.role_id', 'roles.id')
      ->select('users.*', 'roles.name as role_name')
      ->where('role_id', 2)
      // ->whereHas('role', fn($query) => $query->whereNot('name', 'admin'))
    ;
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('name', fn($user) => e(Str::title($user->name)))
      ->add('email')
      ->add('status', fn($user) => e(Str::title($user->status)));
  }

  public function columns(): array
  {
    return [
      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('Email', 'email')
        ->sortable()
        ->searchable(),

      Column::make('Status', 'status')
        ->sortable()
        ->searchable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [
      // Filter::inputText('name'),
      // Filter::inputText('email'),
      // Filter::inputText('status'),
    ];
  }

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  #[\Livewire\Attributes\On('deleteUser')]
  public function deleteUser($rowId): void
  {
    $user = User::where('id', $rowId)->delete();
    if ($user) {
        $this->dispatch('userDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('userNotDeleted'); 
    }
  }


  public function confirmDeleteUser($rowId)
  {
      $this->emit('showDeleteConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
  }


  public function actions(User $row): array
  {
    return [

      Button::add('edit')
        ->slot('Edit')
        ->class('btn btn-success btn-sm')
        ->route('accounts.edit', ['account' => $row->id], '_blank'),

       // Trigger confirmation in Livewire
       Button::add('confirmDelete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteUser', ['rowId' => $row->id])
    ];
  }


  public function actionRules($row): array
  {
    return [
      // Hide button edit for ID 1
      Rule::button('edit')
        ->when(fn($row) => $row->status === StatusEnum::INACTIVE->value)
        ->hide(),

      Rule::button('delete')
        ->when(fn($row) => $row->status === StatusEnum::INACTIVE->value)
        ->hide(),
    ];
  }
}
