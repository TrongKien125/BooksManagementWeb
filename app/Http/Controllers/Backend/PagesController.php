<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Publisher;

class PagesController extends Controller
{
   
    public function index() {
        $total_publishers = count(Publisher::all());
        $total_authors = count(Author::all());
        $total_categories = count(Category::all());
        $total_books = count(Book::all());

        return view('backend.pages.index',[
            'total_books'=>$total_books,
            'total_authors'=>$total_authors,
            'total_publishers'=>$total_publishers,
            'total_categories'=>$total_categories,
        ]);
    }
}
