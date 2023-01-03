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
        return view('frontend.pages.books.show');
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
        ], [
            'title.required' => 'Bạn chưa nhập tên sách',
            'category_id.required' => 'Bạn chưa chọn thể loại sách',
            'publisher_id.required' => 'Bạn chưa chọn nhà xuất bản',
            'public_year.required' => 'Bạn chưa chọn năm phát hành',
            'author_ids.required' => 'Bạn chưa nhập tên tác giả',
            'image.required' => 'Bạn chưa thêm hình ảnh',
            'title.unique' => 'Sách này đã tồn tại',
        ]);

        if($request->file('image')) {
            //dd($request->file('image'));
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $new_file = time().'-'.$name;
            $file->move('images/books', $new_file);
        }

        $book = Book::create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'category_id'=>$request->category_id,
            'publisher_id'=>$request->publisher_id,
            'public_year'=>$request->public_year,
            'description' => $request->input('description'),
            'image'=>$new_file,
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
        return back();
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
