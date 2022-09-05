<?php 
namespace App\Http\ApiPatern\Services;
use Illuminate\Support\facades\Hash;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Arr;
//repository->services->model()
//:::::::::::::::::::::important:::message:::::::
//if this message appear "Personal access client not found. Please create one.", 
//its because u refreshing the database like run command php artisan migrate:refresh
// so u need to run php artisan passport:install
//:;:::::::::::::::::::::::::::::::::::::::::::::::::::::::::
class AuthService{
    public function __construct(
        \App\Models\User $model , 
        \App\Models\Token $modelToken,
        \App\Http\helpers\TokenReset $token
        )
    {   //token use in register and reset pass
        $this->token =$token; //token to reset user password
        $this->model=$model;
        $this->modelToken=$modelToken;
    }

    public function Reset($data)
    {
        //find email ,password, reset_token 
        //if the data not found??
           // email
           $userData=$this->model::where('email',$data['email'])->first();
       if( !$userData)
        {
                return response()->json(['errors'=>'data tidak ditemukan']);
        }
            //token
       if( !$this->modelToken::where('token',$data['reset_token'])->first())
       {
               return response()->json(['errors'=>'token tidak cocok']);
       }            
           $data['password']=hash::make($data['password']);
           $data['reset_token']=$this->token->generate(6);
                //store token to model token where user_id = ?
            $this->modelToken::where('user_id',$userData->id)->update(['token'=>$data['reset_token']] );
                    //update in table user
            $this->model::where('email',$data['email'])->update(Arr::only($data,['password'])) ;
        return 'update successfully';
    }

    public function Register($data)
    {
            $data['password']=Hash::make($data['password']);
            $created=$this->model->create($data);
                $token=[];
                $token['token']=$this->token->generate(6); //6 digit token that easy to remember by user
                $token['user_id']=$created->id;
            $this->modelToken->create($token);  
        return 'registered successfully';
    }

    public function Login($kredensial)
    {
        //jika gagal maka?
        if(!Auth::attempt($kredensial)){
            $failed=[
                'success'=>'403!',
                'message'=>'login failed!'
              ]; 
               return response()->json($failed, 403);
            }
                $user=Auth::user();
                $success=[
                    'success'=>'200!',
                    'message'=>'login successfully',
                    'token'=>$user->createToken('login')->accessToken,
                    'type'=>'Bearer'
                ];
                return response()->json($success,200); 
    }

    public function Logout()
    {
        Auth::user()->token()->revoke();
        $data=[
            'success'=>'200!',
            'message'=>'logout successfully'
        ];
        return response()->json($data, 200);
    }
        //session user
    public function  Profile()
    {   //it return login session user 
        return Auth::user();
    }
        //get global data from the model
    public function  Users()
    { 
        return $this->model::all();
    }
    public function  Tokens()
    { 
        return $this->modelToken::all();
    }

} //end of class