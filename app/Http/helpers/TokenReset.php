<?php 
namespace App\Http\helpers;
class TokenReset{
    public static function generate(int $digit){
        return substr(uniqid(),-$digit);
    }
}