<?php

namespace Arkade\Bronto\Parsers;

use Carbon\Carbon;
use Arkade\Bronto\Entities\Product;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;

class ProductParserTest extends TestCase
{
    /**
     * @test
     */
    public function returns_populated_product()
    {
        $product = (new ProductParser)->parse(
            json_decode(file_get_contents(__DIR__.'/../Stubs/Products/product.json'))
        );

        $this->assertInstanceOf(Product::class, $product);

        $this->assertEquals(null, $product->getAgeGroup());
        $this->assertEquals(null, $product->getAvailability());
        $this->assertEquals(null, $product->getAvailabilityDate());
        $this->assertEquals(null, $product->getAverageRating());
        $this->assertEquals('TEST', $product->getBrand());
        $this->assertEquals('REBLK001', $product->getColor());
        $this->assertEquals(null, $product->getCondition());
        $this->assertEquals(null, $product->getDescription());
        $this->assertEquals(null, $product->getGender());
        $this->assertEquals(null, $product->getGtin());
        $this->assertEquals(null, $product->getImageUrl());
        $this->assertEquals(null, $product->getInventoryThreshold());
        $this->assertEquals(null, $product->getIsbn());
        $this->assertEquals(null, $product->getMpn());
        $this->assertEquals(null, $product->getMargin());
        $this->assertEquals(null, $product->getMobileUrl());
        $this->assertEquals(null, $product->getParentProductId());
        $this->assertEquals(null, $product->getPrice());
        $this->assertEquals(null, $product->getPrice());
        $this->assertEquals(null, $product->getProductCategory());
        $this->assertEquals('9330947716452', $product->getProductId());
        $this->assertEquals(null, $product->getProductTypeMulti());
        $this->assertEquals(null, $product->getProductUrl());
        $this->assertEquals(null, $product->getQuantity());
        $this->assertEquals(null, $product->getReviewCount());
        $this->assertEquals(null, $product->getSalePrice());
        $this->assertEquals(null, $product->getSalePriceEffectiveStartDate());
        $this->assertEquals(null, $product->getSalePriceEffectiveEndDate());
        $this->assertEquals(null, $product->getSize());
        $this->assertEquals('SPARKLE CARDI CHEESE', $product->getTitle());
        $this->assertEquals('9330947716452', $product->getUpc());
        $this->assertEquals(Carbon::parse('2017-12-05T22:00:42.236Z'), $product->getUpdatedDate());
        $this->assertEquals(Carbon::parse('2017-12-05T00:39:47.618Z'), $product->getCreatedDate());
    }

}
