<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoanService
{
    /**
     * Create a new loan and reduce book stock.
     */
    public function createLoan(Book $book, array $data): Loan
    {
        return DB::transaction(function () use ($book, $data) {
            // Ensure stock is available
            if ($book->stock <= 0) {
                throw new \Exception('Stok buku tidak tersedia.');
            }

            // Reduce stock
            $book->decrement('stock');

            // Calculate due date
            $loanDate = Carbon::parse($data['loan_date'] ?? now());
            $duration = (int) ($data['loan_duration'] ?? 7);
            $dueDate = $loanDate->copy()->addDays($duration);

            // Create loan record
            return Loan::create([
                'book_id' => $book->id,
                'borrower_name' => $data['borrower_name'],
                'borrower_phone' => $data['borrower_phone'],
                'borrower_email' => $data['borrower_email'] ?? null,
                'identity_number' => $data['identity_number'] ?? null,
                'loan_date' => $loanDate,
                'due_date' => $dueDate,
                'status' => 'borrowed',
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }

    /**
     * Mark a loan as returned and restore book stock.
     */
    public function returnLoan(Loan $loan): Loan
    {
        return DB::transaction(function () use ($loan) {
            $loan->update([
                'return_date' => now(),
                'status' => 'returned',
            ]);

            // Restore stock
            $loan->book->increment('stock');

            return $loan->fresh();
        });
    }

    /**
     * Update overdue loans to 'late' status.
     */
    public function updateOverdueLoans(): int
    {
        return Loan::where('status', 'borrowed')
            ->where('due_date', '<', now()->toDateString())
            ->update(['status' => 'late']);
    }
}
