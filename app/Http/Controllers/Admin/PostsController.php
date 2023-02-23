<?php

namespace App\Http\Controllers\Admin;;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Gate;
// use Yajra\DataTables\Facades\DataTables;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('feeds_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
        if (\Auth::user()->roleaccess != '1')
            
                $posts = Post::whereNotNull('published_at')->get();
            else
                $posts = Post::all();
            
            
            
        $categories = Category::all();
        $users = User::all();
        $user = User::with('post')->get();
        $user = Category::with('post')->get();
        
        $module_name = 'Post' ;
        $page_title = 'Artikel/Berita';
        $page_heading = 'Artikel/Berita' ;
        $heading_class = 'fal fa-rss';

        
        $delposts = Post::onlyTrashed()->get();
        
        return view('admin.posts.index', compact('module_name','page_title','users', 'page_heading', 'heading_class', 'categories','user', 'posts', 'delposts'));
    }

    public function show(Post $id)
    {
        // dd($id);
        // $post = Post::find($id->id);
        // dd($id);
        $post = $id;
        $module_name = 'Post' ;
        $page_title = 'Artikel/Berita';
        $page_heading = 'Lihat Artikel/Berita' ;
        $heading_class = 'fal fa-rss';
        
        $user = User::all();
        return view('admin.posts.show', compact('module_name','user','page_title','page_heading','heading_class','post'));
    }

    
    public function create()
    {
        // dd($request->all());
        $users = user::all();
        $categories = Category::all();

        $module_name = 'Post' ;
        $page_title = 'Artikel/Berita';
        $page_heading = 'Tambah Artikel/Berita' ;
        $heading_class = 'fal fa-rss';
        
        return view('admin.posts.create', compact('module_name','page_title','page_heading','heading_class','users','categories'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        $module_name = 'Post' ;
        $page_title = 'Artikel/Berita';
        $page_heading = 'Ubah Artikel/Berita' ;
        $heading_class = 'fal fa-rss';

        return view('admin.posts.edit', compact('module_name','page_title','page_heading','heading_class','categories', 'post'));
    }

    public function update(Request $request, Post $post)
    {
        
        //dd($request->all());
        $detail = $request->summernoteInput;
        $dom = new \DomDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        @$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $bs64='base64';//variable to check the image is base64 or not
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            
            if (strpos($data,$bs64) == true)
            {
                $data = base64_decode($data);
                $image_name= time().$k.'.png';

                $path = Storage::disk('public')->putFileAs('posts/img', $img->getattribute('src'), $image_name);
                $img->removeattribute('src');
                $img->setattribute('src', '/'.$path);
            }
            else
            {
                $image_name="/".$data;
                $img->setAttribute('src', $image_name);
            }
            
        }
        $detail = $dom->savehtml();
        $active = $request->input('is_active');

        //$attribute = [];
        $attribute = array(
            'title' => $request->input('title'), 
            'body' => $detail ,
            'category_id' => $request->input('category_id') , 
            'tags' => $request->input('tags'),
            'user_id' => auth()->id(),
            'published_at' => (($active == 'on') ? Carbon::now() : null) );
        
        //dd($attribute);
        $post->update($attribute);
        
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
    }

    public function delete(Request $request, Post $post)
    {
        $post->delete($request->all());
        $post->deleted_at = now();
        $post->is_deleted = '1';
        $post->save();
        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $detail = $request->summernoteInput;
        $dom = new \domdocument();
        @$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';

            $path = Storage::disk('public')->putFileAs('posts/img', $img->getattribute('src'), $image_name);
            $img->removeattribute('src');
            $img->setattribute('src', '/'.$path);
        }
        $detail = $dom->savehtml();
        

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $detail;
        $post->category_id = $request->input('category_id');
        $post->tags = $request->input('tags');
        $post->user_id = auth()->id();
        $active = $request->input('is_active');
        if ($active == 'on') {
            $post->published_at = Carbon::now();
        }
        
        
        $post->save();
        
        return redirect()->route('admin.posts.index')
                        ->with('success', 'Post created');
        
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')
                         ->with('success','Post deleted successfully');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.index')->with('success', 'Post restored successfully');
    }

}