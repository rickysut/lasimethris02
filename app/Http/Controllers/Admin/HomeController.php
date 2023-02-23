<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{   
    public function index() // should be landing page
    {
        // $roleaccess = Auth::user()->roleaccess;
        // if ($roleaccess==1)
        // {
        //     $module_name = 'Beranda' ;
        //     $page_title = 'Beranda';
        //     $page_heading = 'Daftar Pengajuan';
        //     $heading_class = 'fal fa-ballot-check';
        //     return view('admin.landing.indexdirjen', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
            
        // } 
        // if (($roleaccess==2)||($roleaccess==3))
        // {
        $posts = Post::all();
        $users = User::all();
        $user = User::with('post')->get();
            $module_name = 'Beranda' ;
            $page_title = 'Beranda';
            $page_heading = 'Welcome';
            $heading_class = 'fal fa-ballot-check';
            $quote = Inspiring::quote();
            if (\Auth::user()->roleaccess != '1')
            $posts = Post::
                latest()
                ->limit(5)
                ->whereNotNull('published_at')
                ->get();
        else
            $posts = Post::orderBy('created_at','desc')->limit(5)->get();
            return view('admin.landing.indexuser', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'quote','posts','user','users'));
        // }
    }
        

    
}

