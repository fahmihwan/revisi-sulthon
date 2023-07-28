<?php

namespace App\Repositories;

use App\Models\Kategori;

class KategoriRepository
{
    protected $kategori;

    public function __construct(Kategori $kategori)
    {
        $this->kategori = $kategori;
    }

    public function getKategoriLatest()
    {
        return  $this->kategori->latest()->get();
    }

    // public function save()
    // {
    //     $kategori = new $this->kategori;

    //     $kategori->create([]);
    // }
}
