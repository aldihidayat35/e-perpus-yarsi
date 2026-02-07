<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use App\Models\AppSetting;
use App\Services\LoanService;

class DashboardController extends Controller
{
    public function index(LoanService $loanService)
    {
        // Auto-update overdue loans
        $loanService->updateOverdueLoans();

        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $adminUsers = User::where('role', 'admin')->count();
        $recentUsers = User::latest()->take(5)->get();

        // Library stats
        $totalBooks = Book::count();
        $totalPhysical = Book::physical()->count();
        $totalEbooks = Book::ebook()->count();
        $booksBorrowed = Loan::where('status', 'borrowed')->count();
        $lateReturns = Loan::where('status', 'late')->count();

        // Recent loans
        $recentLoans = Loan::with('book')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'adminUsers',
            'recentUsers',
            'totalBooks',
            'totalPhysical',
            'totalEbooks',
            'booksBorrowed',
            'lateReturns',
            'recentLoans'
        ));
    }
}
