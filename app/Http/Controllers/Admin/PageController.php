<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;


class PageController extends Controller
{

    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index', compact('pages'));
    }


    public function create()
    {
        return view('admin.page.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();


        $pageData = [

            'title' => $request->title,
            'heading' => $request->heading,
            'url_key' => $request->url_key,
            'description' => $request->description,

        ];


        $pages = Page::create($pageData);
        return redirect()->route('admin.page.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $pages = Page::find($id);
        return view('admin.page.edit', compact('pages'));
    }


    public function update(Request $request, string $id)
    {

        $data = $request->all();


        $pageData = [

            'title' => $request->title,
            'heading' => $request->heading,
            'url_key' => $request->url_key,
            'description' => $request->description,

        ];


        $pages = Page::where('id', $id)->update($pageData);
        return redirect()->route('admin.page.index');
    }


    public function destroy(string $id)
    {
        $pages = Page::destroy($id);
        return redirect()->route('admin.page.index');
    }
}
