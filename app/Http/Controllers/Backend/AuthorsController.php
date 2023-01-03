<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return view('backend.pages.authors.index',
        [
            'authors'=>$authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name'=>'required|unique:authors|max:255',
        ], [
            'name.required' => 'Bạn chưa nhập tên tác giả',
            'name.unique' => 'Tác giả đã tồn tại'
        ]);
        $author = Author::create([
            'name' => $request->input('name'),
            'link' => str_slug($request->input('name')),
            'description' => $request->input('description'),
        ]);
        $author->save();
        return back()->with('success','Thêm tác giả thành công.');
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
        $request->validate([
            'name'=>'required|max:255',
        ], [
            'name.required' => 'Bạn chưa nhập tên tác giả',
        ]);
        $author = Author::find($id);
        $author->update([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
        ]);
        return back()->with('success','Sửa tác giả thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id)->delete();
        return back()->with('success','Xoá tác giả thành công.');
    }
}
