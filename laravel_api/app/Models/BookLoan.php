<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookLoan extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'user_id', 'book_id', 'loan_date', 'due_date', 'return_date',
        'extended', 'extension_date', 'penalty_amount', 'penalty_status', 'status'
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
