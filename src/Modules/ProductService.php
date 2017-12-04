<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Product;
use Arkade\Bronto\Parsers\ProductParser;
use Arkade\Bronto\Serializers\ProductSerializer;
use Illuminate\Support\Collection;
use League\Csv\Writer;

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
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(array_keys($products[0]));

        foreach($products as $product){
            $csv->insertOne(array_values($product));
        }

        echo $csv->__toString();

        return $this->client->post('products/public/feed_import/',['debug' => true, 'multipart' =>
            [
                'name' => 'file',
                'contents' => $csv->__toString()
            ]
        ]);
    }

}