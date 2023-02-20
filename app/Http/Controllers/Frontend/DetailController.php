<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Sidebar;

class DetailController extends Controller
{
    use Sidebar;

    /**
     * Show article on homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug)
    {
        $item = \App\Model\Artikel\Artikel::findBySlugOrFail($slug);
        $item->hit += 1;
        $item->save();

        $kategori = $this->getKategori();
        $populer = $this->getPopulerPost();

        return view('frontend.artikel.detail', with(['item'=>$item, 'kategori'=>$kategori, 'populer'=>$populer]));
    }

    /**
     * Show article on homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexAnnoun($slug)
    {
        $item = \App\Model\Pengumuman\Pengumuman::findBySlugOrFail($slug);

        return view('frontend.pengumuman.detail', with(['item'=>$item]));
    }
}
