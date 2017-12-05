<?php

namespace Arkade\Bronto\Entities;

use Carbon\Carbon;

/*
 * @see https://helpdocs.bronto.com/bmp/reference/r_bmp_product_fields_descriptions.html
 */

class Product extends AbstractEntity
{
    /**
     * @var string
     */
    protected $ageGroup;

    /**
     * @var string
     */
    protected $availability;

    /**
     * @var Carbon
     */
    protected $availabilityDate;

    /**
     * @var float
     */
    protected $averageRating;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $condition;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $gtin;

    /**
     * @var string
     */
    protected $imageUrl;

    /**
     * @var int
     */
    protected $inventoryThreshold;

    /**
     * @var string
     */
    protected $isbn;

    /**
     * @var string
     */
    protected $mpn;

    /**
     * @var float
     */
    protected $margin;

    /**
     * @var string
     */
    protected $mobileUrl;

    /**
     * @var string
     */
    protected $parentProductId;

    /**
     * @var string
     */
    protected $price;

    /**
     * @var string
     */
    protected $productCategory;

    /**
     * @var string
     */
    protected $productId;

    /**
     * @var string
     */
    protected $productTypeMulti;

    /**
     * @var string
     */
    protected $productUrl;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $reviewCount;

    /**
     * @var string
     */
    protected $salePrice;

    /**
     * @var Carbon
     */
    protected $salePriceEffectiveStartDate;

    /**
     * @var Carbon
     */
    protected $salePriceEffectiveEndDate;

    /**
     * @var string
     */
    protected $size;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $upc;

    /**
     * @var Carbon
     */
    protected $createdDate;

    /**
     * @var Carbon
     */
    protected $updatedDate;

    /**
     * @return string
     */
    public function getAgeGroup()
    {
        return $this->ageGroup;
    }

    /**
     * @param string $ageGroup
     * @return Product
     */
    public function setAgeGroup($ageGroup)
    {
        $this->ageGroup = $ageGroup;
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
        return $this->availabilityDate;
    }

    /**
     * @param Carbon $availabilityDate
     * @return Product
     */
    public function setAvailabilityDate(Carbon $availabilityDate)
    {
        $this->availabilityDate = $availabilityDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getAverageRating()
    {
        return $this->averageRating;
    }

    /**
     * @param float $averageRating
     * @return Product
     */
    public function setAverageRating($averageRating)
    {
        $this->averageRating = $averageRating;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
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
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     * @return Product
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
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
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     * @param string $gtin
     * @return Product
     */
    public function setGtin($gtin)
    {
        $this->gtin = $gtin;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return Product
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
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
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return Product
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return string
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * @param string $mpn
     * @return Product
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;
        return $this;
    }

    /**
     * @return float
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * @param float $margin
     * @return Product
     */
    public function setMargin($margin)
    {
        $this->margin = $margin;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobileUrl()
    {
        return $this->mobileUrl;
    }

    /**
     * @param string $mobileUrl
     * @return Product
     */
    public function setMobileUrl($mobileUrl)
    {
        $this->mobileUrl = $mobileUrl;
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
    public function getProductTypeMulti()
    {
        return $this->productTypeMulti;
    }

    /**
     * @param string $productTypeMulti
     * @return Product
     */
    public function setProductTypeMulti($productTypeMulti)
    {
        $this->productTypeMulti = $productTypeMulti;
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
     * @return int
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    /**
     * @param int $reviewCount
     * @return Product
     */
    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * @param string $salePrice
     * @return Product
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getSalePriceEffectiveStartDate()
    {
        return $this->salePriceEffectiveStartDate;
    }

    /**
     * @param Carbon $salePriceEffectiveStartDate
     * @return Product
     */
    public function setSalePriceEffectiveStartDate(Carbon $salePriceEffectiveStartDate)
    {
        $this->salePriceEffectiveStartDate = $salePriceEffectiveStartDate;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getSalePriceEffectiveEndDate()
    {
        return $this->salePriceEffectiveEndDate;
    }

    /**
     * @param Carbon $salePriceEffectiveEndDate
     * @return Product
     */
    public function setSalePriceEffectiveEndDate(Carbon $salePriceEffectiveEndDate)
    {
        $this->salePriceEffectiveEndDate = $salePriceEffectiveEndDate;
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
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * @param string $upc
     * @return Product
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param Carbon $createdDate
     * @return Order
     */
    public function setCreatedDate(Carbon $createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param Carbon $updatedDate
     * @return Order
     */
    public function setUpdatedDate(Carbon $updatedDate)
    {
        $this->updatedDate = $updatedDate;
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
        if(!is_null($result['availabilityDate'])) $result['availabilityDate'] = $result['availabilityDate']->toDateString();
        return $result;
    }

}
