<?php

namespace App\Traits;

trait Sidebar
{
    /**
     * Get category post with count
     * @return data
     */
    public function getKategori()
    {
        $kategori = \App\Model\Artikel\Kategori::has('posts')
            ->withCount('posts')
            ->orderBy('name', 'asc')
            ->get();

        return $kategori;
    }

    /**
     * Get 5th popular post
     * @return data
     */
    public function getPopulerPost()
    {
        $post = \App\Model\Artikel\Artikel::select('id', 'title', 'slug', 'image', 'created_at')
            ->orderBy('hit', 'desc')
            ->limit(4)
            ->get();

        return $post;
    }
}