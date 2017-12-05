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
     * @return Product
     */
    public function parse($payload)
    {
        $product = new Entities\Product();

        foreach($payload->fields as $field){
            $value = (!is_null($field->value) && $field->type === 'date') ? Carbon::parse((string) $field->value) : $field->value;
            $setterName = camel_case('set_' . $field->name);
            if(method_exists($product, $setterName)) $product->{$setterName}($value);
        }

        return $product;
    }
}