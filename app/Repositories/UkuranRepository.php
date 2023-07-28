<?php

namespace App\Repositories;

use App\Models\Ukuran;

class UkuranRepository
{

    protected $ukuran;

    public function __construct(Ukuran $ukuran)
    {
        $this->ukuran = $ukuran;
    }

    public function get()
    {
        $items = Ukuran::with('kategori:id,nama')->paginate(5);
        return $items;
    }


    public function save($data)
    {
        $ukuran = new $this->ukuran;
        return $ukuran->create([
            'nama' => $data['nama'],
            'kategori_id' => $data['kategori_id']
        ]);
    }

    public function find_ukuran_with_kategori($id)
    {
        $ukuran = new $this->ukuran;
        return $ukuran->with('kategori')->where('id', $id)->first();
    }
}
