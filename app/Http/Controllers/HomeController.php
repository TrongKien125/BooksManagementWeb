<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\BookAuthor;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::all();
        $categories = Category::all(); 
        return view('frontend.pages.index',[
            'books'=>$books,
            'categories'=>$categories,
        ]);
    }

    public function bookClassification($category_id) {
        $categories = Category::all();
        $books = Book::where('category_id', $category_id)->get();
        return view('frontend.pages.index',[
            'books'=>$books,
            'categories'=>$categories
        ]);
    }
}
