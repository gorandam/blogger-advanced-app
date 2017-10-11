<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $guarded = ['id'];

    public function categories()
    {
       return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function comments()
    {
      return $this->morphMany('App\Comment', 'post'); //Here we define that our Post has many comments, this will return all post comments
    }

    public function scopeFilter($query, $filters)
    {
      if ($month = $filters['month']) {
       $query->whereMonth('created_at', Carbon::parse($month)->month);

      }

      if ($year = $filters['year']) {
        $query->whereYear('created_at', $year);
      }

    }
}
