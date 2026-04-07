<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BookUser;
use App\Book;
use Illuminate\Support\Facades\DB;

class JsonResponseController extends Controller
{
    public function store(Request $request)
    {
        $book = Book::find($request->book_id);
        
        if ($book->stock > 0) {
            DB::table('book_users')->insert([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'notes' => $request->notes,
                'status' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $book->where('id', $request->book_id)->update(['stock' => $book->stock - 1]);

            return response()->json(['message' => 'True']);
        }

        return response()->json(['message' => 'False', 'error' => 'Stok buku habis']);
    }
}
