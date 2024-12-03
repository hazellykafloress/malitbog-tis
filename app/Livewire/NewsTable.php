<?php

namespace App\Livewire;

use App\Models\News;
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

final class NewsTable extends PowerGridComponent
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
    return News::query()
      ->select( '*', DB::raw("DATE_FORMAT(created_at, '%M %d, %Y %h:%i %p') as formatted_date"));
  }

  public function relationSearch(): array
  {
    return [];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()
      ->add('title')
      ->add('created_at');
  }

  public function columns(): array
  {
    return [
      Column::make('Title', 'title')
        ->sortable()
        ->searchable(),

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

  #[\Livewire\Attributes\On('edit')]
  public function edit($rowId): void
  {
    $this->js('alert(' . $rowId . ')');
  }

  #[\Livewire\Attributes\On('deleteNews')]
  public function deleteNews($rowId): void
  {
    $news = News::where('id', $rowId)->delete();
    if ($news) {
        $this->dispatch('newsDeleted');  // Notify frontend that deletion was successful
    }
    else {
      $this->dispatch('newsNotDeleted'); 
    }
  }

  public function actions(News $row): array
  {
    return [
      Button::add('edit')
        ->slot('Edit')
        ->class('btn btn-success btn-sm')
        ->route('news.edit', ['news' => $row->id], '_blank'),

      Button::add('delete')
        ->slot('Delete')
        ->class('btn btn-danger btn-sm')
        ->dispatch('confirmDeleteNews', ['rowId' => $row->id])

    ];
  }
  public function confirmDeleteNews($rowId)
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
