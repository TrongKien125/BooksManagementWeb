<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\BookAuthor;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('frontend.pages.books.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $publishers= Publisher::all();
        $categories = Category::all();
        return view('frontend.pages.books.create', [
            'authors'=>$authors,
            'publishers'=>$publishers,
            'categories'=>$categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|unique:books|max:255',
            'category_id'=>'required',
            'publisher_id'=>'required',
            'public_year'=>'required',
            'description'=>'nullable',
            'author_ids'=>'required',
            'image'=>'required|image',
            'file'=>'required|mimes:pdf|max:10000',
        ], [
            'title.required' => 'Bạn chưa nhập tên sách',
            'category_id.required' => 'Bạn chưa chọn thể loại sách',
            'publisher_id.required' => 'Bạn chưa chọn nhà xuất bản',
            'public_year.required' => 'Bạn chưa chọn năm phát hành',
            'author_ids.required' => 'Bạn chưa nhập tên tác giả',
            'image.required' => 'Bạn chưa thêm hình ảnh',
            'file.required' => 'Bạn chưa thêm file',
            'title.unique' => 'Sách này đã tồn tại',
        ]);

        if($request->file('image')) {
            //dd($request->file('image'));
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $new_file = time().'-'.$name;
            $file->move('images/books', $new_file);
        }

        if($request->file('file')) {
            //dd($request->file('image'));
            $file_book = $request->file('file');
            $name_file = $file_book->getClientOriginalName();
            $new_file_book = time().'-'.$name_file;
            $file_book->move('file_upload', $new_file_book);
        }

        $book = Book::create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'category_id'=>$request->category_id,
            'publisher_id'=>$request->publisher_id,
            'public_year'=>$request->public_year,
            'description' => $request->input('description'),
            'image'=>$new_file,
            'file'=>$new_file_book,
            'user_id'=>Auth::user()->id,
            'status'=>1,
        ]);
        $book->save();

        foreach($request->author_ids as $author_id){
            $bookAuthor = BookAuthor::create([
                'book_id'=> $book->id,
                'author_id'=> $author_id
            ]); 
            $bookAuthor->save();
        }
    
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('category','publisher', 'user')->find($id);
        $authors = BookAuthor::where('book_id',$book->id)->with('author')->get();
        return view('frontend.pages.books.show',
            [
                'book'=>$book,
                'authors'=>$authors,
            ]
        );
    }

    public function like($id) {
        $book = Book::find($id);
        $book->update(['total_like'=>$book->total_like + 1]);
        return back();
    }

    public function read($id) {
        $book = Book::find($id);
        $book->update(['total_view'=>$book->total_view + 1]);
        return view('frontend.pages.books.read',[
            'book'=>$book
        ]);
    }


    public function search(Request $request){
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $bookauthors = BookAuthor::all(); 
        $search = $request->string_search;
        $books = Book::orderBy('id','desc')
        ->where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->paginate(10);
        return view('frontend.pages.books.index',[
            'search'=>$search,
            'books'=>$books,
            'categories'=>$categories,
            'publishers'=>$publishers,
            'authors'=>$authors,
        ]);
    }

    public function searchAdvance(Request $request){
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $bookauthors = BookAuthor::all(); 
        $search = $request->content;
        $publisher = $request->publisher_id;
        $category = $request->category_id;
        if(empty($search) && empty($publisher) && empty($categories)){
            return $this->index();
        }
        $books = Book::orderBy('id','desc')
        ->where('title', 'like', '%'.$search.'%')
        ->orwhere('category_id', $category)
        ->orwhere('publisher_id',$publisher)
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orpaginate(10);
        return view('frontend.pages.books.index',[
            'search'=>$search,
            'books'=>$books,
            'categories'=>$categories,
            'publishers'=>$publishers,
            'authors'=>$authors,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
