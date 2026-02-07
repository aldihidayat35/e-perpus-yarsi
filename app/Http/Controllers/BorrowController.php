<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Services\LoanService;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function __construct(
        private LoanService $loanService,
    ) {}

    public function create(Book $book)
    {
        if (!$book->isPhysical()) {
            abort(404);
        }

        $book->load('category');

        return view('public.borrow.form', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        if (!$book->isPhysical()) {
            abort(404);
        }

        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrower_phone' => 'required|string|max:20',
            'borrower_email' => 'nullable|email|max:255',
            'identity_number' => 'nullable|string|max:50',
            'loan_duration' => 'required|integer|min:1|max:30',
            'confirmation' => 'required|accepted',
        ], [
            'borrower_name.required' => 'Nama peminjam wajib diisi.',
            'borrower_phone.required' => 'Nomor telepon wajib diisi.',
            'loan_duration.required' => 'Durasi pinjam wajib diisi.',
            'loan_duration.min' => 'Durasi pinjam minimal 1 hari.',
            'loan_duration.max' => 'Durasi pinjam maksimal 30 hari.',
            'confirmation.required' => 'Anda harus menyetujui ketentuan peminjaman.',
            'confirmation.accepted' => 'Anda harus menyetujui ketentuan peminjaman.',
        ]);

        if ($book->stock <= 0) {
            return back()->with('error', 'Maaf, stok buku sedang habis.');
        }

        try {
            $loan = $this->loanService->createLoan($book, [
                'borrower_name' => $validated['borrower_name'],
                'borrower_phone' => $validated['borrower_phone'],
                'borrower_email' => $validated['borrower_email'] ?? null,
                'identity_number' => $validated['identity_number'] ?? null,
                'loan_date' => now(),
                'loan_duration' => $validated['loan_duration'],
            ]);

            return redirect()->route('borrow.success', $loan->id)
                ->with('success', 'Peminjaman berhasil!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses peminjaman: ' . $e->getMessage());
        }
    }

    public function success(Loan $loan)
    {
        $loan->load('book.category');

        return view('public.borrow.success', compact('loan'));
    }
}
