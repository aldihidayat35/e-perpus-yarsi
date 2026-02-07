<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'book_id',
        'borrower_name',
        'borrower_phone',
        'borrower_email',
        'identity_number',
        'loan_date',
        'due_date',
        'return_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function isBorrowed(): bool
    {
        return $this->status === 'borrowed';
    }

    public function isReturned(): bool
    {
        return $this->status === 'returned';
    }

    public function isLate(): bool
    {
        return $this->status === 'late';
    }

    public function isOverdue(): bool
    {
        return $this->status === 'borrowed' && $this->due_date->isPast();
    }

    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    public function scopeLate($query)
    {
        return $query->where('status', 'late');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'borrowed')
                     ->where('due_date', '<', now()->toDateString());
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'borrowed' => '<span class="badge badge-light-primary">Dipinjam</span>',
            'returned' => '<span class="badge badge-light-success">Dikembalikan</span>',
            'late' => '<span class="badge badge-light-danger">Terlambat</span>',
            default => '<span class="badge badge-light-secondary">Unknown</span>',
        };
    }
}
