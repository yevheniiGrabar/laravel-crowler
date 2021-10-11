<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = "links";

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
    public function itemSchema()
    {
        return $this->belongsTo('App\Models\ItemSchema', 'item_schema_id');
    }
}
