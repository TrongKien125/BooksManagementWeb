<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publisher;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'chim';
        $publishers = Publisher::all();
        return view('backend.pages.publishers.index',
        [
            'publishers'=>$publishers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required|unique:publishers|max:255',
            'link'=>'url|nullable'
        ], [
            'name.required' => 'Bạn chưa nhập tên nhà xuất bản',
            'name.unique' => 'Nhà xuất bản đã tồn tại',
            'link.url'=>'Trang chủ phải là đường link',
        ]);
        $publisher = Publisher::create([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
            'address'=>$request->address,
            'outlet'=>$request->outlet,
            'description' => $request->input('description'),
        ]);
        $publisher->save();
        return back()->with('success','Thêm nhà xuất bản thành công.');
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
            'name.required' => 'Bạn chưa nhập tên nhà xuất bản',
        ]);
        $publisher = Publisher::find($id);
        $publisher->update([
            'name' => $request->input('name'),
            'slug' => $request->input('link'),
            'address'=>$request->address,
            'outlet'=>$request->outlet,
            'description' => $request->input('description'),
        ]);
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
        $publisher = Publisher::find($id)->delete();
        return back()->with('success','Xoá thành công.');
    }
}
