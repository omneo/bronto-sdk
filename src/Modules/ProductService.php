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
    public function feedImport($products)
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(array_keys(json_decode(json_encode($products[0]),true)));

        foreach($products as $product){
            $csv->insertOne(array_values(json_decode((new ProductSerializer())->serialize($product),true)));
        }

        echo $csv->__toString();

        return $this->client->post('products/public/feed_import/',['debug' => true, 'multipart' => [
            [
                'name' => 'catalogId',
                'contents' => $this->client->getProductsApiId()
            ],
            [
                'name' => 'feed',
                'contents' => $csv->__toString()
            ]
        ]
        ]);
    }

}