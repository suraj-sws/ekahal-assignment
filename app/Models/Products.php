<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'date_available',
        'created_by',
        'status',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
