<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * #json resource digunakkan saat kamu mau melemparkan model tunggal
     * #collection digunakkan saat kamu hendak melemparkan model jamak / kumpulan model / collection model
     *          #artikel 
     * https://imansugirman.com/laravel-api-resources-mempercepat-manipulasi-response-json
     * https://stackoverflow.com/questions/58315376/what-is-the-difference-between-a-json-resource-resource-collection-in-laravel
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   //request return array key value
        return [$this->username => '$this->username'];
       
    }
}
