<?php

namespace Arkade\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Product extends AbstractEntity
{
    /**
     * @var string
     */
    protected $productId;

    /**
     * @var string
     */
    protected $parentProductId;

    /**
     * @var string
     */
    protected $productUrl;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $price;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $additional_images;

    /**
     * @var float
     */
    protected $rating;

    /**
     * @var int
     */
    protected $inventoryThreshold;

    /**
     * @var string
     */
    protected $availability;

    /**
     * @var Carbon
     */
    protected $availability_date;

    /**
     * @var string
     */
    protected $productCategory;

    /**
     * @var Carbon
     */
    protected $salePriceEffectiveDateStart;

    /**
     * @var Carbon
     */
    protected $salePriceEffectiveDateEnd;

    /**
     * @var string
     */
    protected $tax;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $size;

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     * @return Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getParentProductId()
    {
        return $this->parentProductId;
    }

    /**
     * @param string $parentProductId
     * @return Product
     */
    public function setParentProductId($parentProductId)
    {
        $this->parentProductId = $parentProductId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * @param string $productUrl
     * @return Product
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalImages()
    {
        return $this->additional_images;
    }

    /**
     * @param string $additional_images
     * @return Product
     */
    public function setAdditionalImages($additional_images)
    {
        $this->additional_images = $additional_images;
        return $this;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     * @return Product
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return int
     */
    public function getInventoryThreshold()
    {
        return $this->inventoryThreshold;
    }

    /**
     * @param int $inventoryThreshold
     * @return Product
     */
    public function setInventoryThreshold($inventoryThreshold)
    {
        $this->inventoryThreshold = $inventoryThreshold;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param string $availability
     * @return Product
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getAvailabilityDate()
    {
        return $this->availability_date;
    }

    /**
     * @param Carbon $availability_date
     * @return Product
     */
    public function setAvailabilityDate($availability_date)
    {
        $this->availability_date = $availability_date;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * @param string $productCategory
     * @return Product
     */
    public function setProductCategory($productCategory)
    {
        $this->productCategory = $productCategory;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getSalePriceEffectiveDateStart()
    {
        return $this->salePriceEffectiveDateStart;
    }

    /**
     * @param Carbon $salePriceEffectiveDateStart
     * @return Product
     */
    public function setSalePriceEffectiveDateStart($salePriceEffectiveDateStart)
    {
        $this->salePriceEffectiveDateStart = $salePriceEffectiveDateStart;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getSalePriceEffectiveDateEnd()
    {
        return $this->salePriceEffectiveDateEnd;
    }

    /**
     * @param Carbon $salePriceEffectiveDateEnd
     * @return Product
     */
    public function setSalePriceEffectiveDateEnd($salePriceEffectiveDateEnd)
    {
        $this->salePriceEffectiveDateEnd = $salePriceEffectiveDateEnd;
        return $this;
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     * @return Product
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Product
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Product
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return Product
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return Array
     */
    public function jsonSerialize()
    {
        $result = get_object_vars($this);
        if(!is_null($result['salePriceEffectiveDateStart'])) $result['salePriceEffectiveDateStart'] = $result['salePriceEffectiveDateStart']->toDateString();
        if(!is_null($result['salePriceEffectiveDateEnd'])) $result['salePriceEffectiveDateEnd'] = $result['salePriceEffectiveDateEnd']->toDateString();
        return $result;
    }

}
