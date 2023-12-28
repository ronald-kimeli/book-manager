<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name', 'publisher', 'isbn', 'category', 'sub_category',
        'description', 'pages', 'image', 'added_by'
    ];

    public function bookLoans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }
    
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
