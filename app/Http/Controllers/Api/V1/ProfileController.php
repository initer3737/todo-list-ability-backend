<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
class ProfileController extends Controller
{
    public function __construct(
        \App\Http\ApiPatern\repositories\ProfileRepository $repository,
        \Illuminate\Support\Facades\Auth $Auth
    )
    {
        $this->repository=$repository;
        $this->dir='imgs/';
        // $this->session=$Auth::user();
        // kesimpulan jika session di letakkan di dalam constructor maka
        //dia (Auth::user()) tidak akan tahu siapa user yang login jadi dia akan melemparkan null array
    }
    public function __invoke(\App\Http\Requests\ProfileRequest $request)
    { $session=Auth::user();
        $data=$request->validated();
        if( $request->Hasfile('foto_profile') ){
        if( File::exists( $current_foto=$this->dir.$session->foto_profile) )File::delete($current_foto); //problem found!! cant move file
            $file=$request->file('foto_profile'); //file tidak ada ? jangan didelete : delete
            // return dd($data['foto_profile']);
              $path=$file->move('gambar/',now().$file->getClientOriginalName() );
            //   return dd($path);
              $data['foto_profile']=$data['foto_profile']=$path;
          }
          return dd($request->all());
        //return $this->repository->Update($data,$id);
    }
} //end of class
