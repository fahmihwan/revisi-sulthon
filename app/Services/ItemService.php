<?php

namespace App\Services;

use App\Repositories\ItemRepository;

class ItemService
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function item_with_kategori()
    {
        return $this->itemRepository->getItemLatet();
    }
}
