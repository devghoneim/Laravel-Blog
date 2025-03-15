<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class post extends Model
{
  use HasFactory;
    public function user(){
      return $this->belongsTo(User::class,'userID');

    }
    public function image()
    {
      if ($this->image)
      {
        return asset($this->image);
      }
      return asset("public/default.png");
    }
    //shar7
    public function tags()
    {
      return $this->BelongsToMany(Tag::class);
    }
}
