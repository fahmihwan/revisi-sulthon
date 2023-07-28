<?php

namespace App\Services;

use App\Repositories\UkuranRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;


class UkuranService
{
    private $ukuranRepository;

    public function __construct(UkuranRepository $ukuranRepository)
    {
        $this->ukuranRepository = $ukuranRepository;
    }


    public function getUkuranLatest()
    {
        return $this->ukuranRepository->get();
    }

    public function storeUkuran($request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $this->ukuranRepository->save($request->all());
    }

    public function find_ukuran_and_kategori($id)
    {
        return   $this->ukuranRepository->find_ukuran_with_kategori($id);
    }
}
