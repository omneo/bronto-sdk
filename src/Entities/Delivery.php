<?php

namespace Omneo\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Delivery extends AbstractEntity
{
    /**
     * @var Carbon
     */
    protected $start;

    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $fromEmail;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $replyEmail;

    /**
     * @var bool
     */
    protected $authentication;

    /**
     * @var string
     */
    protected $messageRuleId;

    /**
     * @var bool
     */
    protected $optin;

    /**
     * @var int
     */
    protected $throttle;

    /**
     * @var int
     */
    protected $fatigueOverride;

    /**
     * @var DeliveryRemail
     */
    protected $remail;

    /**
     * @var DeliveryRecipient
     */
    protected $recipients;

    /**
     * @var DeliveryField
     */
    protected $fields;

    /**
     * @var DeliveryProduct
     */
    protected $products;

    /**
     * @var string
     */
    protected $cartId;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @return Carbon
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * The date the delivery was scheduled to be sent.
     * You can (and should) specify a timezone offset if you do not want the system to assume you are providing a time in
     * UTC (Universal Coordinated Time / Greenwich Mean Time). For the Eastern Time Zone on Daylight Savings Time,
     * this would be YYYY-MM-DDTHH:MM:SS-04:00.
     * @param Carbon $start
     * @return Delivery
     */
    public function setStart(Carbon $start = null)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param string $messageId
     * @return Delivery
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The type of delivery. Valid values are: triggered, test, or transactional.
     * triggered is the default. Only use transactional when adding a delivery which uses a message that has
     * been approved for transactional sending.
     * Note: If you attempt to send a triggered or test delivery to a contact with a status of transactional,
     * the delivery will be set to skipped and the delivery will not be sent.
     * @param string $type
     * @return Delivery
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * @param string $fromEmail
     * @return Delivery
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     * @return Delivery
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
        return $this;
    }

    /**
     * @return string
     */
    public function getReplyEmail()
    {
        return $this->replyEmail;
    }

    /**
     * @param string $replyEmail
     * @return Delivery
     */
    public function setReplyEmail($replyEmail)
    {
        $this->replyEmail = $replyEmail;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * Enables sender authentication for the delivery if set to true.
     * Sender authentication will sign your message with DomainKeys/DKIM
     * (an authentication method that can optimize your message delivery to Hotmail, MSN, and Yahoo! email addresses).
     * If you are associating this delivery with an automated message rule,
     * these parameters will only be accepted if you clicked the Allow API to select sending options
     * checkbox via the application UI on step 2 of creating an API triggered automated message rule.
     * @param bool $authentication
     * @return Delivery
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageRuleId()
    {
        return $this->messageRuleId;
    }

    /**
     * The ID of an automated message rule to associate with this delivery.
     * Used to include this delivery in the reporting for the automator you specify.
     * @param string $messageRuleId
     * @return Delivery
     */
    public function setMessageRuleId($messageRuleId)
    {
        $this->messageRuleId = $messageRuleId;
        return $this;
    }

    /**
     * @return bool
     */
    public function getOptin()
    {
        return $this->optin;
    }

    /**
     * Whether or not this delivery is an opt-in confirmation email. If set to true, contacts who have not yet confirmed
     * their opt-in status with the account will still receive the message.
     * @param bool $optin
     * @return Delivery
     */
    public function setOptin($optin)
    {
        $this->optin = $optin;
        return $this;
    }

    /**
     * @return int
     */
    public function getThrottle()
    {
        return $this->throttle;
    }

    /**
     * Allows you to specify a throttle rate for the delivery.
     * Throttle rate must be in range [0, 720] (minutes).
     * For example you could specify 60 for the throttle range.
     * @param int $throttle
     * @return Delivery
     */
    public function setThrottle($throttle)
    {
        $this->throttle = $throttle;
        return $this;
    }

    /**
     * @return int
     */
    public function getFatigueOverride()
    {
        return $this->fatigueOverride;
    }

    /**
     * If set to true, the delivery can be sent even if it exceeds frequency cap settings for a contact.
     * @param int $fatigueOverride
     * @return Delivery
     */
    public function setFatigueOverride($fatigueOverride)
    {
        $this->fatigueOverride = $fatigueOverride;
        return $this;
    }

    /**
     * @return DeliveryRemail
     */
    public function getRemail()
    {
        return $this->remail;
    }

    /**
     * A remail object. Remails allow you to send another email to contacts based on actions they did not take.
     * The goal is to persuade them to continue along the conversion process.
     * @param DeliveryRemail $remail
     * @return Delivery
     */
    public function setRemail($remail)
    {
        $this->remail = $remail;
        return $this;
    }

    /**
     * @return DeliveryRecipient[]|Collection
     */
    public function getRecipients()
    {
        return $this->recipients ?: $this->recipients = new Collection;
    }

    /**
     * A collection of the recipients who were or are scheduled to receive the delivery.
     * Recipients can include lists, segments, or individual contacts.
     * @param DeliveryRecipient[]|Collection $recipients
     * @return Delivery
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return DeliveryField[]|Collection
     */
    public function getFields()
    {
        return $this->fields ?: $this->fields = new Collection;
    }

    /**
     * An array of the API fields and data to substitute into the message being sent by this delivery.
     * @param DeliveryField[]|Collection $fields
     * @return Delivery
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return Product[]|Collection
     */
    public function getProducts()
    {
        return $this->products ?: $this->products = new Collection;
    }

    /**
     * Specifies Product IDs to substitute for placeholders in product tags upon message send. Limit: 100 products
     * @param Product[]|Collection $products
     * @return Delivery
     */
    public function setProducts($products)
    {
        $this->products = $products;
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
     * @return Delivery
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;
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
     * @return Delivery
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
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
