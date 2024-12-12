<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpportunity extends Model
{
    /** @use HasFactory<\Database\Factories\JobOpportunityFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'salary',
        'country',
        'skills',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
        ];
    }
}
