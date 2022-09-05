<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\DB;

class TodoController extends Controller
{   //flows $this->repo->service->model();
    //catatan penting untuk method delete tidak memerlukan request
    //jadi tak perlu membuat request || request hanya berlaku jika mau create data 
    //seperti membuat end point dengan method post dan put [Route::post('bla bla bla') ];
    public function __construct(
        \App\Http\ApiPatern\repositories\TodoRepository $repository
        )
    {
        $this->repository=$repository;
        $this->id=new \App\Http\helpers\api;
    }
                    //title's functions 
    public function TitleCreate(\App\Http\Requests\TitleCreateRequest $request)
    {
        return $this->repository->TitleCreate($request->validated());
    }

    public function TitleUpdate($id,\App\Http\Requests\TitleCreateRequest $request)
     { return
        !is_numeric($id)? $this->id->CheckResponse($id):
         $this->repository->TitleUpdate($id,$request->validated());
    }

    public function TitleDelete($id)
    { return
        !is_numeric($id)? $this->id->CheckResponse($id):
         $this->repository->TitleDelete($id);
    }
                //get method function goes here

//[delete || update ] list require todo_id and [delete ||update] the constraint of todo_id in tr_todo
                //lists functions
    public function ListCreate(\App\Http\Requests\ListCreateRequest $request)
    {   return
        !is_numeric($id)? $this->id->CheckResponse($id): $this->repository->ListCreate($request->validated());
    }

    public function ListUpdate(int $id,\App\Http\Requests\ListUpdateRequest $request)
    {  return
        !is_numeric($id)? $this->id->CheckResponse($id):$this->repository->ListUpdate($id,$request->validated());
    }

    public function ListDelete($id)
    {  return
        !is_numeric($id)? $this->id->CheckResponse($id): $this->repository->ListDelete($id);
    }
            //get method global function goes here
    public function Lists()
    { 
        return
        DB::table('tr__todos')
            ->rightjoin('todos','todos.id','tr__todos.todo_id')
            ->rightjoin('users','users.id','tr__todos.user_id')
        ->select('todos.id as list_id','todos.list')
        ->where('users.id',Auth::user()->id)
        ->get();
    }

    public function ListsGlob()
    { 
        return
        DB::table('tr__todos')
            ->leftjoin('todos','todos.id','tr__todos.todo_id')
            ->leftjoin('titles','titles.id','tr__todos.title_id')
            ->leftjoin('users','users.id','tr__todos.user_id')
        ->select('todos.id as list_id','todos.list','titles.id as title_id','titles.title','users.id as user_id','users.name')
        ->get();
    }
    public function TitlesGlob()
    { 
        return
        \App\Models\Title::all();
    }
            //belajar right join dan left join
            //left join return all data from left tabel
} //end of class
