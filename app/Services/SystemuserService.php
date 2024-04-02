<?php

namespace App\Services;

use App\Models\User;

class SystemuserService {

    public function list($page, $search){
        return User::search($search)->orderby('created_at','DESC')->paginate($page);
    }

    public function listState(){
        return User::get();
    }

    public function create($data){
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password'])]
        );
    }

    public function getById($id){
        return User::find($id);
    }

    public function update($id,$data,$value){
        $user = User::find($id);

        if($value == 'name'){
            $user->username = $data['username'];
        }
        else {
            $user->password = $data['password'];
        }
        
        return $user->save();
    }

    public function delete($id){
        return User::where('id',$id)->delete();
    }

}
