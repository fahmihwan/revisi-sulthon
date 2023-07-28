<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getItemLatet()
    {
        $this->item = new $this->item;
        return $this->item->with(['kategori'])->latest()->get();
        // Item::with(['kategori:id,nama'])->latest()->get()
    }
}
