<?php

namespace App\Livewire;

use Livewire\Component;

class TableRefresher extends Component
{
  public $tableName;

  public function refreshTable()
  {
    $tableName = $this->tableName;
    $this->dispatch("pg:eventRefresh-$tableName");
  }

  public function render()
  {
    return view('livewire.table-refresher');
  }
}
