<?php

namespace App\Livewire;

use App\Services\SystemuserService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class SystemUser extends Component
{
    use WithPagination;

    public $name; 
    public $id;
    public $user;
    public $title = "Add User";
    public $edittitle = "Edit User";
    public $addevent= "add-user";
    public $editevent = "edit-user";
    public $password;
    public $password_confirmed;
    public $edit = false;
    public $search = '';
    public $perpage = 5;

    #[On('add-user')]
    public function add(){
        $this->edit = false;
        $this->title = "Add User";
        $this->reset(['name','password','password_confirmed']);
    }

    public function save(SystemuserService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3',
            'password' =>'required|min:6|confirmed',
        ]);

        $response = $service->create($validated);

        $this->reset(['name','password','password_confirmed']);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function update(SystemuserService $service){

        $validated = $this->validate([ 
            'name' => 'required|min:3'
        ]);

        $response = $service->update($this->id,$validated,'name');

        if($response){
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    #[On('edit-user')]
    public function edit($id, SystemuserService $service){
      
        $this->title = "edit user";
        $this->edit = true;
        $this->user = $service->getById($id);
        $this->name = $this->user->name;
        $this->id = $this->user->id;
    }

    public function delete($id,SystemuserService $service){
        $service->delete($id);
    }


    public function render(SystemuserService $service)
    {
        $users = $service->list($this->perpage, $this->search);
        return view('livewire.settings.system-user', compact('users'))->layout('layouts.app');
    }
}
