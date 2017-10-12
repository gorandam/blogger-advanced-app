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

    public function scopeFilter($query, $filters)// Here is our scopeQuery function where we refactor our code 
    {
      if ($month = $filters['month']) {
       $query->whereMonth('created_at', Carbon::parse($month)->month);

      }

      if ($year = $filters['year']) {
        $query->whereYear('created_at', $year);
      }

    }

    public static function archives() //Here we create static archives function to put our Eloquent query here and to do code refactoring
    {
      return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')// this is our complex query to get all our posts by year and month by descending order
          ->groupBy('year', 'month')
          ->orderByRaw('min(created_at)desc')
          ->get();
    }
}
