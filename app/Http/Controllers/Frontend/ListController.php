<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Sidebar;

class ListController extends Controller
{
    use Sidebar;

    /**
     * Show article on homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $artikel = \App\Model\Artikel\Artikel::whereHas('user', function($q) {
            $q->whereRoleIs('super-admin');
            $q->orWhereRoleIs('admin-berita');
        })
        ->where('status', '=', 'publish')
        ->orderBy('created_at', 'desc')->paginate(5);
        
        $kategori = $this->getKategori();
        $populer = $this->getPopulerPost();

        return view('frontend.artikel.list', with(['artikel' => $artikel, 'kategori'=>$kategori, 'populer'=>$populer, 'cat'=>'Kemahasiswaan']));
    }

    /**
     * Search article
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchArticle(Request $request)
    {
        $artikel = \App\Model\Artikel\Artikel::whereHas('user', function($q) {
                $q->whereRoleIs('super-admin');
                $q->orWhereRoleIs('admin-berita');
            })
            ->where('status', '=', 'publish')
            ->when($request->keyword, function($query) use ($request) {
                $query->where('title', 'like', "%{$request->keyword}%")
                ->orWhere('content', 'like', "%{$request->keyword}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        
        $kategori = $this->getKategori();
        $populer = $this->getPopulerPost();

        return view('frontend.artikel.list', with(['artikel' => $artikel, 'kategori'=>$kategori, 'populer'=>$populer, 'cat'=>'search']));
    }

    /**
     * Show article on homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pengumuman()
    {
        $data = \App\Model\Pengumuman\Pengumuman::where('status', '=', 'publish')
        ->orderBy('created_at', 'desc')->paginate(6);

        return view('frontend.pengumuman.list', with(['data' => $data]));
    }
}
