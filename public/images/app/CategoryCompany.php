<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryCompany extends Model
{
    protected $table = 'category_company';
    protected $fillable = [
       'category_id','company_id'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function Company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

}
