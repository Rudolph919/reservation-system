<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'resource_type_id',
        'capacity',
        'price',
        'location',
        'image',
    ];

    public function resourceType()
    {
        return $this->belongsTo(ResourceType::class);
    }
}
