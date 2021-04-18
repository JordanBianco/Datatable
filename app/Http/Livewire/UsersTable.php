<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $active = true;
    public $sortBy;
    public $sortAsc = true;
    public $perPage = 5;

    protected $queryString = [
        'search' => ['except' => ''],
        'active' => ['except' => 1],
        'sortBy', 
        'sortAsc'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($value)
    {
        if ($this->sortBy == $value) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortBy = $value;
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::where(function($query) {
                                $query->where('name', 'like', '%' . $this->search . '%')
                                    ->orWhere('email', 'like', '%' . $this->search . '%');
                            })
                            ->when($this->sortBy, function($query) {
                                $query->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc');
                            })
                            ->when($this->active !== 'all', function($query) {
                                $query->where('active', $this->active);
                            })
                            ->paginate($this->perPage)
        ]);
    }
}