<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Comment;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    public function category()
    {
    	return $this->belongsTo(Category::class);
	}

	public function comments()
    {
    	return $this->hasMany(Comment::class)->orderBy('updated_at');
	}
}
