<?php

namespace App\Livewire;

use App\Models\Establishment;
use App\Models\Gallery;
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

final class OwnerGalleryTable extends PowerGridComponent
{
  use WithExport;


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
    return Gallery::leftJoin('establishments', 'galleries.establishment_id', '=', 'establishments.id')
        ->leftJoin('users', 'establishments.user_id', '=', 'users.id')
        ->where('establishments.user_id', '=', Auth::user()->id) // Fetch only galleries of the logged-in user
        ->select(
            'galleries.*',
            'establishments.name as establishment_name', // Alias for establishment name
            'users.name as owner_name', // Alias for user (owner) name
            DB::raw("DATE_FORMAT(galleries.created_at, '%M %d, %Y %h:%i %p') as formatted_date")
        );
  }

  public function relationSearch(): array
  {
    return [];
  }

public function fields(): PowerGridFields
{
    return PowerGrid::fields()
        ->add('establishment_name', fn($item) => e($item->establishment_name ?? 'N/A')) // Establishment Name
        ->add('name')
        ->add('owner_name', fn($item) => e($item->owner_name ?? 'N/A')) // Owner Name
        ->add('image', function ($item) {
            $path = $item->path ? str_replace('public', '/storage', $item->path) : 'https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg';
            return '<img class="" height="100px" width="180px" src="' . asset("{$path}") . '">';
        })
        ->add('formatted_date');
}
  public function columns(): array
  {
    return [
      Column::make('Establishment', 'establishment_name'),

      Column::make('Name', 'name')
        ->sortable()
        ->searchable(),

      Column::make('Image', 'image'),

      Column::make('Published Date', 'formatted_date')
        ->sortable()
        ->searchable(),

      Column::action('Action')
    ];
  }

  public function filters(): array
  {
    return [];
  }

  #[\Livewire\Attributes\On('deleteOwnerGallery')]
  public function deleteOwnerGallery($rowId): void
  {
    $gallery = Gallery::where('id', $rowId)->delete();
    if ($gallery) {
        $this->dispatch('galleryDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('galleryNotDeleted'); 
    }
  }

    public function confirmDeleteGallery($rowId)
    {
        $this->emit('showDeleteConfirmation', $rowId);  // Emit the event to Blade to trigger SweetAlert
    }

  public function actions(Gallery $row): array
  {
    return [
      Button::add('delete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteGallery', ['rowId' => $row->id])
    ];
  }

}
