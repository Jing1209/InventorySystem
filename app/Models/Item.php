<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $fillable = ['category_id','title','price','status','description','sponsored'];

    public function categories(){
        return $this->belongsTo(Category::class);
    }

    public function transactions(){
        return $this->hasOne(Transaction::class);
    }
    public function statuses(){
        return $this->hasMany(Status::class);
    }
    public function sponsors(){
        return $this->hasMany(Sponsor::class);
    }

}
