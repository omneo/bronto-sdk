<?php

namespace Omneo\Bronto\Parsers;

use Carbon\Carbon;
use Omneo\Bronto\Entities;

class ProductParser
{
    /**
     * Parse the given array to a Product entity.
     *
     * @param mixed $payload
     * @return Entities\Product
     */
    public function parse($payload)
    {
        $product = new Entities\Product();

        if (!empty($payload->fields)) {
            foreach ($payload->fields as $field) {
                $value      = (null !== $field->value && $field->type === 'date') ? Carbon::parse((string)$field->value) : $field->value;
                $setterName = camel_case('set_' . $field->name);
                if (method_exists($product, $setterName)) {
                    $product->{$setterName}($value);
                }
            }
        }

        return $product;
    }
}