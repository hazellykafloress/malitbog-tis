<?php

namespace App\Livewire;

use App\Models\Establishment;
use App\Models\Gallery;
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

final class EstablishmentGalleryTable extends PowerGridComponent
{
  use WithExport;

  public Establishment $establishment;

  public string $tableName = 'EstablishmentGalleryTable';

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
    return Gallery::query()
        ->select(
            'galleries.*',
            DB::raw("DATE_FORMAT(created_at, '%M %d, %Y %h:%i %p') as formatted_date")
        )
        ->when($this->establishment, function ($query) {
            return $query->where('establishment_id', $this->establishment->id);
        });
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('establishment', fn($item) => e($item->establishment->name))
      ->add('name')
      ->add('image', function ($item) {
        $path = $item->path ? str_replace('public', '/storage', $item->path) : 'https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg';
        return '<img class="" height="100px" width="180px" src="' . asset("{$path}") . '">';
      })
      ->add('created_at');
  }

  public function columns(): array
  {
    return [
      Column::make('Establishment', 'establishment'),
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

  #[\Livewire\Attributes\On('deleteGallery')]
  public function deleteGallery($rowId): void
  {
    $gallery = Gallery::where('id', $rowId)->delete();
    if ($gallery) {
        $this->dispatch('galleryDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('galleryNotDeleted'); 
    }
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
