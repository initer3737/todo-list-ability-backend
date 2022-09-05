<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr_Todo extends Model
{
    use HasFactory;
        protected $fillable=['user_id','title_id','todo_id'];
}
