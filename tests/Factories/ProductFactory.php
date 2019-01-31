<?php

namespace Arkade\Bronto\Factories;

use Arkade\Bronto\Entities\Product;
use Carbon\Carbon;

class ProductFactory
{
    /**
     * Make an product entity.
     *
     * @return Entities\Product
     */
    public function make()
    {
        $product = new Product();
        $product->setProductId('9330947716452');
        $product->setTitle('SPARKLE CARDI CHEESE');
        $product->setColor('REBLK001');
        $product->setUpc('9330947716452');
        $product->setBrand('TEST');
        $product->setAvailabilityDate(Carbon::parse('2017-05-12'));

        return $product;
    }
}