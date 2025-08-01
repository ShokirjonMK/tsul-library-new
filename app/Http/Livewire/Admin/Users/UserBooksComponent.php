<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Book;
use Livewire\Component;

class UserBooksComponent extends Component
{
    public $user_id, $perPage = 20;
    public $fromDate, $toDate;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function resetFilters()
    {
        $this->fromDate = null;
        $this->toDate = null;
    }

    public function render()
    {
        $query = Book::where('created_by', $this->user_id);
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
        }
        $books = $query->orderBy('created_at', 'DESC')->paginate($this->perPage);

        return view('livewire.admin.users.user-books-component', ['books' => $books]);
    }
}
