<?php

namespace App\Services;

use App\Repositories\KategoriRepository;

class KategoriService
{
    private $kategoriRepositroy;

    public function __construct(KategoriRepository $kategoriRepositroy)
    {
        $this->kategoriRepositroy = $kategoriRepositroy;
    }


    public function getKategoriLatest()
    {
        return $this->kategoriRepositroy->getKategoriLatest();
    }

    public function storeKategori()
    {
        // $validator = Validator::make($request->all(), [
        //     'nama' => 'required',
        //     'kategori_id' => 'required|numeric'
        // ]);

        // if ($validator->fails()) {
        //     throw new InvalidArgumentException($validator->errors()->first());
        // }
        // $this->ukuranRepository->save($request->all());
    }
}
