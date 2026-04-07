<?php

namespace App\Http\Controllers\Anggota;

use App\Book;
use App\BookType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $book_types = BookType::all();
        
        $books = Book::where('stock', '>', 0);

        if ($request->has('search') && $request->search != '') {
            $books->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('publisher', 'like', '%' . $request->search . '%')
                      ->orWhere('book_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('book_type_id') && $request->book_type_id != '') {
            $books->where('book_type_id', $request->book_type_id);
        }

        $books = $books->get();

        return view('anggota.books.index', compact('books', 'book_types'));
    }

    public function show($id)
    {
        $book = Book::find($id);

        return view('anggota.books.show', compact('book'));
    }
}