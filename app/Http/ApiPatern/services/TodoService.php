<?php 
namespace App\Http\ApiPatern\Services;
use Illuminate\Support\facades\Hash;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Arr;
/*
  1. 1 title banyak todo
  2.model {
    1:Todo{id,list} ,
    2:Title{id,title},
    3:tr_todo{id , user_id , todo_id , title_id}
 }   
  3.agar bisa dikonsum oleh front end 
  sekaligus banyak {banyak end point yang dikonsum oleh front end dev}
            ;;;;;;;;;;;;;;;flows;;;;;;;;;;;;;;;
  4.saat user mengisikan title maka akan di isikan ke dalam title model lalu id 
  akan dimasukkan ke dalam tr todo berupa {title_id : user_id }
   user_id diambil dari session user id
    5.saat user mengisi todo maka akan dimasukkan data berupa {list } ke dalam 
   model todo dan data berupa {todo_id} ke dalam tr_todo 
*/
class TodoService{
    public function __construct(
        \App\Models\Todo $modelTodo , 
        \App\Models\Title $modelTitle , 
        \App\Models\Tr_Todo $modelTr_Todo,
        \App\Models\User $modelUser
        )
    {
        $this->modelTodo=$modelTodo;
        $this->modelTitle=$modelTitle;
        $this->modelTr_Todo=$modelTr_Todo;
        $this->modelUser=$modelUser;
    }  
                  //title's functions
        //@param $title return array key value
    public function TitleCreate($title)
    {  $session=Auth::user(); //store the title  to title model and tr model {title_id , user->id}
        $created=$this->modelTitle->create($title);
            //add 1 gold
            $gold=$session->gold = $session->gold+1;
        $this->modelUser::where('users.id',$session->id)->update(['gold'=>$gold ]);
        $store_foreign=['user_id'=>$session->id,'title_id'=>$created->id]; 
        $this->modelTr_Todo->create($store_foreign); //accept array key value
        return 'created successfully';
    }

    public function TitleUpdate($id,$data)
    {  $session=Auth::user();
         //add 1 gold
         $gold=$session->gold = $session->gold+1;
         $this->modelUser::where('users.id',$session->id)->update(['gold'=>$gold ]);
        $this->modelTitle::where('titles.id',$id)->update($data);
        return 'Updated successfully';
    }

    public function TitleDelete($id)
    {//semua todo id yang berkaitan dengan title id di tr todo harus di hapus semua
        $session=Auth::user();
         //add 1 gold
         $gold=$session->gold = $session->gold+1;
         $this->modelUser::where('users.id',$session->id)->update(['gold'=>$gold ]);
        $this->modelTr_Todo::where('todo_id',null)->delete();
        $this->modelTitle::where('titles.id',$id)->delete();
    }
                 //lists functions
    public function ListCreate($list)
    {
        $session=Auth::user();
        $created=$this->modelTodo->create( Arr::only($list,['list']) );
            //add 1 gold
        $gold=$session->gold = $session->gold+1;
                $this->modelUser::where('users.id',$session->id)->update(['gold'=>$gold ]);
            $update_foreign=['user_id'=>$session->id,'todo_id'=>$created->id]; 
            $store_foreign=['user_id'=>$session->id,'title_id'=>$list['title_id'],'todo_id'=>$created->id]; 
            //check if todo_id is null then do update else create new one
        $validateTrTodoId= $this->modelTr_Todo->where('user_id',$session->id); //for validate purpose
        (
            $validateTrTodoId->whereNull('todo_id')->first() // is todo_id null in tabel tr_todo?
                                        ? //yes it is || update in order to fill null value in column todo_id
                $validateTrTodoId->where( 'title_id',$list['title_id'] )->update( $update_foreign )
                                        : //no its not null value || create new data
                $this->modelTr_Todo->create( $store_foreign ) 
                                        //accept array key value  
        );
        return 'created successfully';
    }

    public function ListUpdate($id,$data)
    {
        $update=$this->modelTodo::where('todos.id',$id);
        if(is_null($update->first()))return ['error'=>'data not found!','status'=>404];
         $update->update($data);
         return 'updated successfully';
    }

    public function ListDelete($id)
    {
        $delete=$this->modelTodo::where('todos.id',$id);
        if(is_null($delete->first()))return ['error'=>'data not found!','status'=>404];
         $delete->first()->delete($id);
         return 'deleted successfully';
    }
    
} //end of class