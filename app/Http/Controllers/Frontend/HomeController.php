<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show article on homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $artikel = \App\Model\Artikel\Artikel::whereHas('user', function($q) {
        //         $q->whereRoleIs('super-admin');
        //         $q->orWhereRoleIs('admin-berita');
        //     })
        //     ->where('status', '=', 'publish')
        //     ->orderBy('created_at', 'desc')
        //     ->limit(5)->get();
            
        // $pengumuman = \App\Model\Pengumuman\Pengumuman::where('status', '=', 'publish')
        // ->orderBy('created_at', 'desc')->limit(5)->get();

        // $mahasiswa = \App\Model\Artikel\Artikel::whereHas('user', function($q) {
        //     $q->whereRoleIs('bem');
        // })
        // ->where('status', '=', 'publish')
        // ->orderBy('created_at', 'desc')
        // ->limit(5)->get();

        $artikel = \App\Model\Artikel\Artikel::whereHas('user', function($q) {
                $q->whereRoleIs('super-admin');
                $q->orWhereRoleIs('admin-berita');
            })
            ->where('status', '=', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();

        return view('frontend.home', with(compact(['artikel'])));
    }
}