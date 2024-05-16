<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body_md_filepath',
        'category_id',
        'description',
        'thumbnail'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }  
}
