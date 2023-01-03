<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    use HasFactory;
    protected $table = 'itemimages';
    protected $fillable = [
        'url', 'item_id'
        ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
