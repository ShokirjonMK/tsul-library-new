<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use LivewireAlert;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "", $perPage=20, $rfid_tag;

    public function mount($rfid_tag){
        $this->rfid_tag = $rfid_tag;
    }

    public function render()
    {
        $q = User::query();

        if ($this->search != '') {
            $keyword = trim($this->search);
            $q->where(function ($query) use ($keyword) {
                $query->where('inventar_number', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('id', '=', "$keyword")
                    ->orWhere('student_id_number', 'LIKE', "%$keyword%")
                    ->orWhere('name', 'LIKE', "%$keyword%");
            });

        }

        $users = $q->with('roles')->orderBy('id', 'desc')->paginate(20);
        $data = [
            'users' => $users,
        ];

        return view('livewire.admin.users.user-list', $data);
    }

    public function giveRfid($rfid_tag, $userId)
    {
        // RFID berish logikasi
        \Log::info("RFID $rfid_tag given to user $userId");

        $bookInventar = User::find($userId);
        $bookInventar->rfid_tag_id = $rfid_tag;
        $bookInventar->save();
        // Yoki agar DB o'zgartirish bo'lsa, shu joyda qilasiz
        $this->alert('success',  __('Successfully saved'));

        // Sahifani yangilash
        return redirect(request()->header('Referer'));
    }

}
