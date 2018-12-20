<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularQuestions extends Model
{
    protected $table = 'popular_questions';
    protected $fillable = [
        'body', 'answer' ,'status'
    ];
}
