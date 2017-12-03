<?php

namespace Arkade\Bronto\Parsers;

use Carbon\Carbon;
use Arkade\Bronto\Entities;

class ProductParser
{
    /**
     * Parse the given array to a Product entity.
     *
     * @param array $payload
     * @return Order
     */
    public function parse($payload)
    {
        $order = (new Entities\Product)
            ->setProductId($payload->productId)
            ->setParentProductId($payload->parentProductId)
            ->setProductUrl($payload->productUrl)
            ->setTitle($payload->title)
            ->setDescription($payload->description)
            ->setPrice($payload->price)
            ->setQuantity($payload->quantity)
            ->setAdditionalImages($payload->additionalImages)
            ->setRating($payload->rating)
            ->setInventoryThreshold($payload->inventoryThreshhold)
            ->setAvailability($payload->availability)
            ->setAvailabilityDate(Carbon::parse((string) $payload->availabilityDate))
            ->setProductCategory($payload->category)
            ->setTax($payload->tax)
            ->setGender($payload->gender)
            ->setColor($payload->color)
            ->setSize($payload->size);

        return $order;
    }
}