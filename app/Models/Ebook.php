<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ebook extends Model
{
    protected $fillable = [
        'book_id',
        'file_path',
        'total_pages',
    ];

    protected function casts(): array
    {
        return [
            'total_pages' => 'integer',
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
