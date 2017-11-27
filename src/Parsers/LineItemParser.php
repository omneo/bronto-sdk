<?php

namespace Arkade\Bronto\Parsers;

use Carbon\Carbon;
use Arkade\Bronto\Entities;
use Illuminate\Support\Collection;

class LineItemParser
{
    /**
     * Parse the given array to a LineItem entity.
     *
     * @param  array $payload
     * @return Entities\LineItem
     */
    public function parse($payload)
    {
        $lineItem = (new Entities\LineItem())
            ->setCategory($payload->category)
            ->setDescription($payload->description)
            ->setImageUrl($payload->imageUrl)
            ->setName($payload->name)
            ->setOther($payload->other)
            ->setProductUrl($payload->productUrl)
            ->setQuantity($payload->quantity)
            ->setSalePrice($payload->salePrice)
            ->setSku($payload->sku)
            ->setTotalPrice($payload->totalPrice)
            ->setUnitPrice($payload->unitPrice);

        return $lineItem;
    }
}