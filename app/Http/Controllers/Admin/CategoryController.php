<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Gate;
// use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $module_name = 'Category'; //usually Model Name
        $page_title = 'Categories'; //this will be the page title for browser
        $page_heading = 'Categories List'; //this will be the page heading.
        $heading_class = 'fal fa-rss'; //this will be the leading icon for the page heading

        $categories = Category::all();
        $category = Category::with('post')->get();

        return view('admin.categories.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_name = 'Module Name'; //usually Model Name
        $page_title = 'Page Title'; //this will be the page title for browser
        $page_heading = 'Artikel/Berita'; //this will be the page heading.
        $heading_class = 'fal fa-rss'; //this will be the leading icon for the page heading

        return view('admin.categories.create', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('category_name');
        $category->hexcolor = $request->input('hexcolor');
        $category->textcolor = $request->input('textcolor');

        // dd($request->all());
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $posts = Post::where('category_id', $category->id)->get();

        // dd($categoryName->name);
        $module_name = 'Module Name'; //usually Model Name
        $page_title = 'Categories'; //this will be the page title for browser
        $page_heading = 'All Posts in Category'; //this will be the page heading.
        $heading_class = 'fal fa-rss'; //this will be the leading icon for the page heading

        return view('admin.categories.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'categories', 'category', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_name = 'Module Name'; //usually Model Name
        $page_title = 'Page Title'; //this will be the page title for browser
        $page_heading = 'Artikel/Berita'; //this will be the page heading.
        $heading_class = 'fal fa-rss'; //this will be the leading icon for the page heading
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('category_name');
        $category->hexcolor = $request->input('hexcolor');
        $category->textcolor = $request->input('textcolor');

        // dd($request->all());
        $category->update();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
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