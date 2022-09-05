<?php 
namespace App\Http\ApiPatern\repositories;
use Illuminate\Support\Arr;
//flows controller->repository->services->model()
class ProfileRepository{
    public function __construct(
        \App\Http\ApiPatern\services\ProfileService $service
        )
    {
        $this->service=$service;
    }

    public function Update($data,$id)
    { 
       return $this->service->update($data,$id);
    }

} //end of class

