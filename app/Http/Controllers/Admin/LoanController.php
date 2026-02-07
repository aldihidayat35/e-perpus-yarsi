<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(
        private LoanService $loanService,
    ) {}

    public function index(Request $request)
    {
        // Auto-update overdue loans
        $this->loanService->updateOverdueLoans();

        $loans = Loan::with('book')
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->when($request->search, function ($q, $s) {
                $q->where(function ($query) use ($s) {
                    $query->where('borrower_name', 'like', "%{$s}%")
                          ->orWhere('borrower_phone', 'like', "%{$s}%")
                          ->orWhere('borrower_email', 'like', "%{$s}%");
                });
            })
            ->when($request->date_from, fn($q, $d) => $q->where('loan_date', '>=', $d))
            ->when($request->date_to, fn($q, $d) => $q->where('loan_date', '<=', $d))
            ->latest()
            ->paginate(15);

        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load('book.category');

        return view('admin.loans.show', compact('loan'));
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('admin.loans.index')
                ->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }

        $this->loanService->returnLoan($loan);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Buku berhasil dikembalikan. Stok telah dipulihkan.');
    }

    public function destroy(Loan $loan)
    {
        if ($loan->status === 'borrowed') {
            return redirect()->route('admin.loans.index')
                ->with('error', 'Peminjaman aktif tidak dapat dihapus. Kembalikan buku terlebih dahulu.');
        }

        $loan->delete();

        return redirect()->route('admin.loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
