<?php

namespace Omneo\Bronto\Entities;

use Carbon\Carbon;

class Order
{
    /**
     * @var float
     */
    protected $discountAmount;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var float
     */
    protected $grandTotal;

    /**
     * @var Collection
     */
    protected $lineItems;

    /**
     * @var string
     */
    protected $originIp;

    /**
     * @var string
     */
    protected $originUserAgent;

    /**
     * @var float
     */
    protected $shippingAmount;

    /**
     * @var Carbon
     */
    protected $shippingDate;

    /**
     * @var string
     */
    protected $shippingDetails;

    /**
     * @var string
     */
    protected $shippingTrackingUrl;

    /**
     * @var float
     */
    protected $subtotal;

    /**
     * @var float
     */
    protected $taxAmount;

    /**
     * @var string
     */
    protected $trackingCookieName;

    /**
     * @var string
     */
    protected $trackingCookieValue;

    /**
     * @var string
     */
    protected $tid;

    /**
     * @var string
     */
    protected $cartId;

    /**
     * @var string
     */
    protected $customerOrderId;

    /**
     * @var string
     */
    protected $orderDate;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var OrderState
     */
    protected $states;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var Carbon
     */
    protected $createdDate;

    /**
     * @var Carbon
     */
    protected $updatedDate;

    /**
     * @return float
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @param float $discountAmount
     * @return Order
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return Order
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    /**
     * @param float $grandTotal
     * @return Order
     */
    public function setGrandTotal($grandTotal)
    {
        $this->grandTotal = $grandTotal;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLineItems()
    {
        return $this->lineItems;
    }

    /**
     * @param Collection $lineItems
     * @return Order
     */
    public function setLineItems($lineItems)
    {
        $this->lineItems = $lineItems;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginIp()
    {
        return $this->originIp;
    }

    /**
     * @param string $originIp
     * @return Order
     */
    public function setOriginIp($originIp)
    {
        $this->originIp = $originIp;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginUserAgent()
    {
        return $this->originUserAgent;
    }

    /**
     * @param string $originUserAgent
     * @return Order
     */
    public function setOriginUserAgent($originUserAgent)
    {
        $this->originUserAgent = $originUserAgent;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingAmount()
    {
        return $this->shippingAmount;
    }

    /**
     * @param float $shippingAmount
     * @return Order
     */
    public function setShippingAmount($shippingAmount)
    {
        $this->shippingAmount = $shippingAmount;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getShippingDate()
    {
        return $this->shippingDate;
    }

    /**
     * @param Carbon $shippingDate
     * @return Order
     */
    public function setShippingDate($shippingDate)
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
    }

    /**
     * @param string $shippingDetails
     * @return Order
     */
    public function setShippingDetails($shippingDetails)
    {
        $this->shippingDetails = $shippingDetails;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingTrackingUrl()
    {
        return $this->shippingTrackingUrl;
    }

    /**
     * @param string $shippingTrackingUrl
     * @return Order
     */
    public function setShippingTrackingUrl($shippingTrackingUrl)
    {
        $this->shippingTrackingUrl = $shippingTrackingUrl;
        return $this;
    }

    /**
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param float $subtotal
     * @return Order
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param float $taxAmount
     * @return Order
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingCookieName()
    {
        return $this->trackingCookieName;
    }

    /**
     * @param string $trackingCookieName
     * @return Order
     */
    public function setTrackingCookieName($trackingCookieName)
    {
        $this->trackingCookieName = $trackingCookieName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingCookieValue()
    {
        return $this->trackingCookieValue;
    }

    /**
     * @param string $trackingCookieValue
     * @return Order
     */
    public function setTrackingCookieValue($trackingCookieValue)
    {
        $this->trackingCookieValue = $trackingCookieValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * @param string $tid
     * @return Order
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCartId()
    {
        return $this->cartId;
    }

    /**
     * @param string $cartId
     * @return Order
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerOrderId()
    {
        return $this->customerOrderId;
    }

    /**
     * @param string $customerOrderId
     * @return Order
     */
    public function setCustomerOrderId($customerOrderId)
    {
        $this->customerOrderId = $customerOrderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param string $orderDate
     * @return Order
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Order
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return OrderState
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * @param OrderState $states
     * @return Order
     */
    public function setStates(Bronto\OrderState $states)
    {
        $this->states = $states;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
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
    public function setCreatedDate($createdDate)
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
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
        return $this;
    }

}
