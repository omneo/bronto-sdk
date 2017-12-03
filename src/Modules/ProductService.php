<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Product;
use Arkade\Bronto\Parsers\ProductParser;
use Arkade\Bronto\Serializers\ProductSerializer;
use Illuminate\Support\Collection;

class ProductService extends AbstractRestModule
{
    /**
     * Product feed import.
     *
     * @param array $products
     * @return string transaction UUID
     */
    public function feed_import($products)
    {

        /*
        return (new OrderParser)->parse(
            $this->client->get('orders/'.$id,['debug' => true])
        );
        */
    }

}