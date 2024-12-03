<?php

namespace App\Livewire;

use App\Models\Offering;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

final class OwnerOfferTable extends PowerGridComponent
{
  use WithExport;

  public string $tableName = 'OwnerOfferingTable';

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
    return Offering::query()
        ->leftJoin('establishments', 'offerings.establishment_id', '=', 'establishments.id')
        ->leftJoin('users', 'establishments.user_id', '=', 'users.id')
        ->where('establishments.user_id', '=', Auth::user()->id)
        ->select(
            'offerings.*', // All columns from the offerings table
            'establishments.name as establishment_name', // Alias establishment's name
            'users.name as owner_name' // Alias user's name (owner of the establishment)
        );
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('image', function ($item) {
        $path = $item->path ? str_replace('public', '/storage', $item->path) : 'https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg';
        return '<img class="" height="100px" width="180px" src="' . asset("{$path}") . '">';
      })
      ->add('name')
      ->add('path')
      ->add('price');
  }

  public function columns(): array
  {
    return [
      Column::make('Etablishment', 'establishment_name'),

      Column::make('Image', 'image'),

      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('Price', 'price')
        ->sortable()
        ->searchable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [];
  }

  #[\Livewire\Attributes\On('deleteOwnerOffer')]
  public function deleteOwnerOffer($rowId): void
  {
    $offer = Offering::find($rowId);
    $offer->delete();
  }

  public function actions(Offering $row): array
  {
    return [
      Button::add('delete')
        ->slot('Delete')
        ->id()
        ->class('btn btn-danger')
        ->confirm('Do you wish to delete this record?')
        ->dispatch('deleteOwnerOffer', ['rowId' => $row->id])
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
