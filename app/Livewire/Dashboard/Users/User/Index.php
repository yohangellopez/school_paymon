<?php

namespace App\Livewire\Dashboard\Users\User;

use App\Exports\AdminsExport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    public $search = "";

    public $user_id;
    public $name;
    public $last_name;
    public $phone;
    public $document;
    public $birth_date;
    public $address;
    public $email;
    public $password;
    public $status;

    protected $listeners = [
        'delete-user' => 'deleteUser',
    ];

    protected $rules = [
        'name'              => 'required|string',
        'last_name'         => 'required|string',
        'phone'             => 'required|string',
        'document'          => 'required|unique:users,document',
        'birth_date'        => 'required|date',
        'address'           => 'required|string',
        'email'             => 'nullable|email',
        'password'          => 'required|min:8',
        'status'            => 'required|in:active,inactive',
    ];

    public function openModal($userId = null)
    {
        $this->reset([
            'user_id',
            'name',
            'last_name',
            'phone',
            'document',
            'birth_date',
            'address',
            'email',
            'password',
            'status'
        ]);
        
        if ($userId) {
            $user = User::findOrFail($userId);
            $this->user_id    = $user->id;
            $this->name                 = $user->name;
            $this->last_name            = $user->last_name;
            $this->document             = $user->document;
            $this->phone                = $user->phone;
            $this->email                = $user->email;
            $this->birth_date           = $user->birth_date;
            $this->address              = $user->address;
            $this->status               = $user->status;
        }
        $this->dispatch('open-modal'); // Dispara el evento personalizado
    }
    
    public function save() {

        $this->rules['document'] = $this->user_id ? 
            "required|unique:users,document,{$this->user_id}" : 
            "required|unique:users,document";

        $this->rules['password'] = $this->user_id ? 
            "nullable" : 
            "required|min:8";

        $this->validate();

        $data = [
            'name'              => $this->name,
            'last_name'         => $this->last_name,
            'phone'             => $this->phone,
            'document'          => $this->document,
            'birth_date'        => $this->birth_date,
            'address'           => $this->address,
            'email'             => $this->email,
            'password'          => $this->password,
            'code'              => "ADM-" . $this->document,
            'status'            => $this->status
        ];

        if($this->password) {
            $data['password'] = bcrypt($this->password);
        } else {
            unset($data['password']);
        }

        if($this->email == 'director@director.com') {
            $this->dispatch('close-modal'); // documenterra el modal
            $this->dispatch('showToast', message : 'No puedes editar este administrador', type : 'error');
            return;
        }

        if($this->user_id) {
            User::find($this->user_id)->update($data);
            $message = 'Administrador actualizado!';
        } else {
            $user = User::create($data);
            $user->assignRole('admin');
            $message = 'Administrador creado!';
        }

        $this->reset([
            'user_id',
            'name',
            'last_name',
            'phone',
            'document',
            'birth_date',
            'address',
            'email',
            'password',
            'status'
        ]);
        $this->dispatch('close-modal'); // documenterra el modal
        $this->dispatch('showToast', message : $message, type : 'success');
    }


    public function generatePDF()
    {
        $users = User::query()
                            ->when($this->search, function ($query) {
                                $query->where('name', 'like', '%'.$this->search.'%')
                                        ->orWhere('last_name', 'like', '%'.$this->search.'%')
                                        ->orWhere('document', 'like', '%'.$this->search.'%');
                            })
                            ->whereHas('roles', function ($query) {
                                $query->where('name', 'admin'); 
                            })
                            ->get();

        $pdf = Pdf::loadView('pdf.users', compact('users'));
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'administradores-'.now()->format('Y-m-d').'.pdf');
    }

    public function generateExcel()
    {
        return Excel::download(
            new AdminsExport($this->search), 
            'administradores-'.now()->format('Y-m-d').'.xlsx'
        );
    }

    public function showModal($userId)
    {
        $user = User::findOrFail($userId);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->document = $user->document;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->birth_date = $user->birth_date;
        $this->address = $user->address;
        $this->status = $user->status;

        $this->dispatch('show-modal-open'); // Nombre actualizado
    }

    public function confirmDelete($userId)
    {
        $this->dispatch('show-delete-confirmation', userId: $userId);
    }

    public function deleteUser($userId){
        $user = User::findOrFail($userId);

        if($user->email == 'director@director.com') {
            $this->dispatch('showToast', message : 'No puedes eliminar este administrador', type : 'error');
            return;
        }

        $user->delete();
        $this->dispatch('showToast', message : 'Administrador eliminado!', type : 'success');
    }

    public function render() {
        

        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%');
            })
            ->paginate(10);


        return view('livewire.dashboard.users.user.index', [
            'users' => $users
        ]);
    }
}