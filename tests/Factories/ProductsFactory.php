<?php

namespace Arkade\Bronto\Factories;

use Arkade\Bronto\Entities\Product;
use Carbon\Carbon;

class ProductsFactory
{
    /**
     * Make an array of product entities.
     *
     * @return array
     */
    public function make()
    {
        $products = [];

        $product = new Product();
        $product->setProductId('9330947716452');
        $product->setTitle('SPARKLE CARDI CHEESE');
        $product->setColor('REBLK001');
        $product->setUpc('9330947716452');
        $product->setBrand('TEST');
        $product->setAvailabilityDate(Carbon::parse('2017-05-12'));

        $products[] = $product;

        $product = new Product();
        $product->setProductId('9330947716315');
        $product->setTitle('AMITY LACE DRESS');
        $product->setColor('REBLK001');
        $product->setUpc('9330947716315');
        $product->setBrand('TEST');
        $product->setAvailabilityDate(Carbon::parse('2017-06-12'));

        $products[] = $product;

        $product = new Product();
        $product->setProductId('9330947716179');
        $product->setTitle('PEARLY QUEEN JUMPER');
        $product->setColor('REBLK001');
        $product->setUpc('9330947716179');
        $product->setBrand('TEST');
        $product->setAvailabilityDate(Carbon::parse('2017-07-12'));

        $products[] = $product;

        return $products;
    }
}