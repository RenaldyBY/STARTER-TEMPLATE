<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class trashController extends Controller
{
    public function index (){
        $books = Book::onlyTrashed()->get();
        return view('trash', compact('books'));
    }
}
