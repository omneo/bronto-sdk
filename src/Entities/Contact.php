<?php

namespace Omneo\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Contact extends AbstractEntity
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $mobileNumber;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var Collection
     */
    protected $attributes;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Contact
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @param string $mobile
     * @return Contact
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status ?: \Bronto_Api_Contact::STATUS_ONBOARDING;
    }

    /**
     * @param string $status
     * @return Contact
     */
    public function setStatus( $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Return collection of attributes.
     *
     * @return Collection
     */
    public function getAttributes()
    {
        return $this->attributes ?: $this->attributes = new Collection;
    }

    /**
     * Set collection of attributes.
     *
     * @param  Collection $attributes
     * @return Contact
     */
    public function setAttributes(Collection $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}