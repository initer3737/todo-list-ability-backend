<?php 
namespace App\Http\helpers;
class api{
  public static function success(array $data)
  {
     foreach($data as $key => $value)
     {
         return ['data'=>[$key => $value]];
     }
  }

  function CheckResponse($id)
  {
    $err=['error'=>'id harus bertipe integer'];
    return response()->json($err);
   }
  
} //end of class

