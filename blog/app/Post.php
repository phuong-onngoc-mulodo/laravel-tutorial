<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    //protected $fillable = ['title', 'body'];
    //protected $guarded = [];
    public function comments()
    {
      return $this->hasMany(Comment::class);    //'App\Comment'
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function addComment($body)
    {
      // Comment::create([
      //   'body' => $body,
      //   'post_id' => $this->id
      // ]);

      $this->comments()->create(compact('body'));
    }

    public function scopeFilter($query, $filters)
    {
      if(isset($filters['month']))
      {
        if ($month = $filters['month'])
        {
          $query->whereMonth('created_at', Carbon::parse($month)->month);
        }
      }

      if(isset($filters['year']))
      {
        if ($year = $filters['year'])
        {
          $query->whereYear('created_at', $year);
        }
      }
    }

    public static function archives()
    {
      return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
      ->groupBy('year', 'month')
      ->orderByRaw('min(created_at) desc')
      ->get()
      ->toArray();
    }
}
