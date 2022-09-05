<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TodoController;
use App\Http\Controllers\Api\V1\ProfileController;

    //testing purpose 
    Route::get('testing route',function(){
       
    });
        //group api v1
Route::prefix('V1')->group(function () {
            //globals
            Route::get('users',[AuthController::class,'Users']);
            Route::get('tokens',[AuthController::class,'Tokens']);
            Route::get('tr_list',[TodoController::class,'ListsGlob']);
            Route::get('titles',[TodoController::class,'TitlesGlob']);
            //group api
Route::prefix('auth')->group(function(){
    //here is your main program's do your best brother!
                    //auth is here
    Route::post('register',[AuthController::class,'Register'] );
    Route::post('login',[AuthController::class,'Login'] );
    Route::post('reset',[AuthController::class,'Reset'] );
            //autenticate by laravel passport
        Route::group(['middleware'=>'auth:api'],function () {
                //get methods is here
            Route::get('profile',[AuthController::class,'Profile'] );
            Route::get('logout',[AuthController::class,'Logout'] );
            Route::get('lists',[TodoController::class,'Lists'] );
                //post methods is here
                Route::post('title',[TodoController::class,'TitleCreate'] );
                Route::post('list',[TodoController::class,'ListCreate'] );
                //put || patch methods is here
                Route::put('user/{id}/update',[ProfileController::class,'__invoke'] );
                Route::put('list/{id}/update',[TodoController::class,'ListUpdate'] );
                Route::put('title/{id}/update',[TodoController::class,'TitleUpdate'] );
                            //delete methods is here
                Route::delete('list/{id}/delete',[TodoController::class,'ListDelete'] );
                Route::delete('title/{id}/delete',[TodoController::class,'TitleDelete'] );
        });
    }); //end of group api
}); //end of group api v1