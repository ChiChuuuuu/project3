<?php

namespace App\Http\Livewire;

use App\Models\BookModel;
use Livewire\Component;

class BookSearch extends Component
{
    public $query = '';
    public $results;
    protected $queryString = ['query'];

    public function render()
    {
        $this->results = BookModel::where('bookTitle', 'LIKE', "%{$this->query}%")->get();
        return view('livewire.book-search');
    }
}
