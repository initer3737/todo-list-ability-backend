<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
     public function __construct(
        \App\Http\helpers\TokenReset $token
     )
     {
        $this->token=$token;
     }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
        'name'=>'admin',
        'username'=>'admin',
        'foto_profile'=>'admin.jpg',
        'alamat'=>'jakarta',
        'no_telp'=>'0847834****',
        'gender'=>1,
        'email'=>'admin@yahoo.com',
        'password'=>\Illuminate\Support\facades\Hash::make('admin'),
        'gold'=>12000
        ];
        $created=\App\Models\User::create($data);
            $token=[
                'token'=>$this->token->generate(6),
                'user_id'=>$created->id
            ];
        \App\Models\Token::create($token); 
            //create 10 data
        for ($i=1; $i <= 100; $i++) { 
            $todo=['list'=>'get dolar!'];
            $createdTodo=\App\Models\Todo::create($todo);
            $title=['title'=>'plans'];
            $createdTitle=\App\Models\Title::create($title); //title
            $tr_todo=['user_id'=>1,'title_id'=>$createdTitle->id,'todo_id'=>$createdTodo->id];
            $createdTr_todo=\App\Models\Tr_Todo::create($tr_todo); //tr todo 
        }
    }
}
