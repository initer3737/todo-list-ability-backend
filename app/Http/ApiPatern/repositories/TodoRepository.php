<?php 
namespace App\Http\ApiPatern\repositories;
use Illuminate\Support\Arr;
//flows controller->repository->services->model()
class TodoRepository{
    public function __construct(
        \App\Http\ApiPatern\services\TodoService $service
        )
    {
        $this->service=$service;
    }
                //title's functions
    public function TitleCreate($title)
    {
        return $this->service->TitleCreate( $title );
    }
    public function TitleUpdate($id,$data)
    { 
        return $this->service->TitleUpdate($id,$data);
    }

    public function TitleDelete($id)
    {
        return $this->service->TitleDelete($id);
    }
            //lists functions
    public function ListCreate($list)
    { 
        return $this->service->ListCreate( $list );
    }

    public function ListUpdate($id,$data)
    { 
        return $this->service->ListUpdate($id,$data);
    }

    public function ListDelete($id)
    {  
        return $this->service->ListDelete($id);
    }

} //end of class