<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Storage;
class trashController extends Controller
{
    public function index (){
        $books = Book::onlyTrashed()->get();
        return view('trash', compact('books'));
    }
    public function destroy($id)
    {
            $books = Book::onlyTrashed()->find($id);
            Storage::delete('public/cover_buku/'.$books->nama_file);
            $books->forceDelete();
            $notification = array(
                'message' => 'Data buku berhasil diubah',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }
    public function restore($id)
    {
            $books = Book::onlyTrashed()->find($id);
            $books->restore();

            $notification = array(
                'message' => 'Data buku berhasil diubah',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    public function restore_all()
    {
        $books = Book::onlyTrashed()->get();
        foreach($books as $book){
            $book->restore(); 
        }
        $notification = array(
            'message' => 'Data buku berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function empty()
    {
        $books = Book::onlyTrashed()->get();
        foreach($books as $book){
            Storage::delete('public/gambar_buku/'.$book->cover);
            $book->forceDelete();
        }
        $notification = array(
            'message' => 'Data buku berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
