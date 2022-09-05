<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
//flows controller->repository->services->model()
class AuthController extends Controller
{
    public function __construct(
        \App\Http\ApiPatern\repositories\AuthRepository $repository
        )
    {
        $this->repository=$repository;
    }

    public function Reset(\App\Http\Requests\ResetRequest $request)
    { 
        return $this->repository->Reset($request->validated());
    }

    public function Register(\App\Http\Requests\RegisterRequest $request)
    { 
        return $this->repository->Register($request->validated());
    }

    public function Login(\App\Http\Requests\LoginRequest $request)
    { 
        return $this->repository->Login($request->validated());
    }

    public function Logout()
    {
        return $this->repository->Logout();
    }
            //get session user
    public function Profile()
    {
        return $this->repository->Profile();
    }

            //global
    public function Users()
    {
        return $this->repository->Users();
    }

    public function Tokens()
    {
        return $this->repository->Tokens();
    }
} //end of class