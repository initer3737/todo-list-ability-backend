<?php 
namespace App\Http\ApiPatern\repositories;
use Illuminate\Support\Arr;
//flows controller->repository->services->model()
class AuthRepository{
    public function __construct(
        \App\Http\ApiPatern\services\AuthService $service
        )
    {
        $this->service=$service;
    }

    public function Register($data)
    { 
        return $this->service->Register($data);
    }

    public function Reset($data)
    { 
        
        return $this->service->Reset($data);
    }
    
    public function Login($kredensial)
    {
        return $this->service->Login($kredensial);
    }

    public function Logout()
    {
        return $this->service->Logout();
    }
        //get user data
    public function Profile()
    {
        return $this->service->Profile();
    }
            //global
    public function Users()
    {
        return $this->service->Users();
    }
    public function Tokens(){
        return $this->service->Tokens();
    }
} //end of class