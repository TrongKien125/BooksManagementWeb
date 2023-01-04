<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\BookAuthor;


class booksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'chim';
        $books = Book::all();
        return view('backend.pages.books.index',
        [
            'books'=>$books
        ]);
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
        return view('backend.pages.books.create', [
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
    
        return back()->with('success','Thêm sách mới thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::all();
        $publishers= Publisher::all();
        $categories = Category::all();
        //dd($book);
        return view('backend.pages.books.edit', [
            'book'=>$book,
            'authors'=>$authors,
            'publishers'=>$publishers,
            'categories'=>$categories,
        ]);
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
        //dd($request);
        $request->validate([
            'title'=>'required|max:255',
            'category_id'=>'required',
            'publisher_id'=>'required',
            'public_year'=>'required',
            'description'=>'nullable',
            'author_ids'=>'required',
            'image'=>'image',
            'file'=>'mimes:pdf|max:10000'
        ], [
            'title.required' => 'Bạn chưa nhập tên sách',
            'category_id.required' => 'Bạn chưa chọn thể loại sách',
            'publisher_id.required' => 'Bạn chưa chọn nhà xuất bản',
            'public_year.required' => 'Bạn chưa chọn năm phát hành',
            'author_ids.required' => 'Bạn chưa nhập tên tác giả',
            'title.unique' => 'Sách này đã tồn tại',
        ]);
        
        $book = Book::find($id);
        if($request->file('image')) {
            //dd($request->file('image'));
            $old_image = 'images/books/'.$book->image;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $new_file = time().'-'.$name;
            $file->move('images/books', $new_file);
            $book->update([
                'image'=>$new_file
            ]);
        }

        if($request->file('file')) {
            //dd($request->file('image'));
            $old_file = 'file_upload/'.$book->file;
            if(file_exists($old_file)){
                unlink($old_file);
            }
            $file_book = $request->file('file');
            $name_file = $file_book->getClientOriginalName();
            $new_file_book = time().'-'.$name_file;
            $file_book->move('file_upload/',$new_file_book);
            $book->update([
                'file'=>$new_file_book
            ]);
        }

        $book->update([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'category_id'=>$request->category_id,
            'publisher_id'=>$request->publisher_id,
            'public_year'=>$request->public_year,
            'description' => $request->input('description'),
            'status'=>1,
        ]);

        $old_book_authors = BookAuthor::where('book_id',$book->id)->get();
        foreach($old_book_authors as $item) {
            $item->delete();
        }
        foreach($request->author_ids as $author_id){
            $bookAuthor = BookAuthor::create([
                'book_id'=> $book->id,
                'author_id'=> $author_id
            ]); 
            $bookAuthor->save();
        }
        return back()->with('success','Sửa thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $image = 'images/books/'.$book->image;
        if(file_exists($image)){
            unlink($image);
        }
        $file = 'file_upload/'.$book->file;
        if(file_exists($file)){
            unlink($file);
        }
        $old_book_authors = BookAuthor::where('book_id',$book->id)->get();
        foreach($old_book_authors as $item) {
            $item->delete();
        }
        $book->delete();
        return back()->with('success','Xoá thành công.');
    }
}
