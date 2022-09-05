<?php 
namespace App\Http\ApiPatern\Services;
use Illuminate\Support\facades\Hash;
use Illuminate\Support\Arr;
use Illuminte\Http\Request;

class ProfileService{
    public function __construct(
        \App\Models\User $model 
        )
    {   
        $this->model=$model;
        //$this->session=$Auth::user();
    }

 public function Update($data,$id)
 {
        $data['password']=$data['password']=Hash::make($data['password']);
    //$this->model::where('id',$id)->update($data);
        return 'update success!';
 }

} //end of class