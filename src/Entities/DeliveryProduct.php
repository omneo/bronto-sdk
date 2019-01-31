<?php

namespace Omneo\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DeliveryProduct extends AbstractEntity
{
    /**
     * @var string
     */
    protected $placeholder;

    /**
     * @var string
     */
    protected $productId;

    /**
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Placeholder text used in a product tag. Maximum of 50 characters.
     * @param string $placeholder
     * @return DeliveryProduct
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * A valid Product ID that will replace the placeholder on message send. Maximum of 50 characters.
     * @param string $productId
     * @return DeliveryProduct
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return Array
     */
    public function jsonSerialize()
    {
        $result = get_object_vars($this);

        return $result;
    }

}
