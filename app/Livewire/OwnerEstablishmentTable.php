<?php

namespace App\Livewire;

use App\Models\Establishment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Offering;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

final class OwnerEstablishmentTable extends PowerGridComponent
{
  use WithExport;

  public string $tableName = 'OwnerEstablishmentTable';

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
        return Establishment::query()
            ->leftJoin('users', 'establishments.user_id', '=', 'users.id') // Join the users table
            ->where('establishments.user_id', Auth::id())
            ->select(
                'establishments.*',
                'users.name as owner_name',
                DB::raw("DATE_FORMAT(establishments.created_at, '%M %d, %Y') as formatted_date")
            );
    }


  
  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
{
    return PowerGrid::fields()
        ->add('owner_name')
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
      Column::make('Status', 'status')
        ->sortable()
        ->searchable(),

      Column::action('Action')
    ];
  }

  public function confirmDeleteEstablishment($rowId)
  {
      $this->emit('showDeleteConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
  }

  #[\Livewire\Attributes\On('deleteEstablishment')]
  public function deleteEstablishment($rowId): void
  {
    $countestablishment = Establishment::where('user_id', Auth::user()->id)->count();

    if($countestablishment > 1) {
        $establishment = Establishment::where('id', $rowId)->delete();
        // $establishment = Establishment::where('id', $rowId)->update([ 'status' => 'inactive']);
        if ($establishment) {
          Gallery::where('establishment_id', $rowId)->delete();
          Event::where('establishment_id', $rowId)->delete();
          Offering::where('establishment_id', $rowId)->delete();
        //   $getUser = Establishment::where('id', $rowId)->first();
        //   User::where('id', $getUser->user_id)->update([ 'status' => 'inactive']);
        $this->dispatch('establishmentDeleted');  // Notify frontend that deletion was successful
        }
        else {
        $this->dispatch('establishmentNotDeleted'); 
        }
    } else {
        $this->dispatch('establishmentNotAllowedDeleted'); 
    }
    
    
  }

  public function actions(Establishment $row): array
  {
    return [

      Button::add('delete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteEstablishment', ['rowId' => $row->id])
        
    ];
  }
}
