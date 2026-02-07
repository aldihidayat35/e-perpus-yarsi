<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $books = Book::with(['category', 'ebook'])
            ->search($request->search)
            ->when($request->category, fn($q, $c) => $q->whereHas('category', fn($cq) => $cq->where('slug', $c)))
            ->latest()
            ->paginate(12);

        return view('public.catalog.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $book->load(['category', 'ebook']);

        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('public.catalog.show', compact('book', 'relatedBooks'));
    }
}
