<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'item_id',
        'user_id',
        'room_id',
    ];

    public function items(){
        return $this->belongsTo(Item::class);
    }

    public function rooms(){
        return $this->belongsTo(Room::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

}
