<?php

namespace Arkade\Bronto\Entities;

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
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var Carbon
     */
    protected $birthday;

    /**
     * @var string
     */
    protected $companyName;

    /**
     * @var string
     */
    protected $jobTitle;

    /**
     * @var string
     */
    protected $phoneHome;

    /**
     * @var string
     */
    protected $phoneMobile;

    /**
     * @var string
     */
    protected $salutation;

    /**
     * @var string
     */
    protected $address1;

    /**
     * @var string
     */
    protected $address2;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $suburb;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $postCode;

    /**
     * @var Carbon
     */
    protected $creationDate;

    /**
     * @var Collection
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $dimension_recency;

    /**
     * @var string
     */
    protected $dimension_frequency;

    /**
     * @var string
     */
    protected $dimension_join;

    /**
     * @var string
     */

    protected $pref_email_promo;

    /**
     * @var string
     */
    protected $pref_email_benefits;

    /**
     * @var string
     */
    protected $pref_email_reminders;

    /**
     * @var string
     */
    protected $pref_email_account;

    /**
     * @var string
     */
    protected $pref_email_feedback;

    /**
     * @var string
     */
    protected $spend_12m;

    /**
     * @var string
     */
    protected $spend_all;

    /**
     * @var string
     */
    protected $spend_atv_12m;

    /**
     * @var string
     */
    protected $spend_atv_all;

    /**
     * @var string
     */
    protected $spend_last_date;

    /**
     * @var string
     */
    protected $spend_first_date;

    /**
     * @var string
     */
    protected $store_favorite;

    /**
     * @var string
     */
    protected $shop_days;

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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Contact
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param Carbon $birthday
     * @return Contact
     */
    public function setBirthday(Carbon $birthday = null)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return Contact
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     * @return Contact
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneHome()
    {
        return $this->phoneHome;
    }

    /**
     * @param string $phoneHome
     * @return Contact
     */
    public function setPhoneHome($phoneHome)
    {
        $this->phoneHome = $phoneHome;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * @param string $phoneMobile
     * @return Contact
     */
    public function setPhoneMobile($phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param string $salutation
     * @return Contact
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     * @return Contact
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     * @return Contact
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Contact
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * @param string $suburb
     * @return Contact
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Contact
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     * @return Contact
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param Carbon $creationDate
     * @return Contact
     */
    public function setCreationDate(Carbon $creationDate = null)
    {
        $this->creationDate = $creationDate;
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
     * @return string
     */
    public function getDimensionRecency()
    {
        return $this->dimension_recency;
    }

    /**
     * @param string $dimension_recency
     * @return Contact
     */
    public function setDimensionRecency($dimension_recency)
    {
        $this->dimension_recency = $dimension_recency;
        return $this;
    }

    /**
     * @return string
     */
    public function getDimensionFrequency()
    {
        return $this->dimension_frequency;
    }

    /**
     * @param string $dimension_frequency
     * @return Contact
     */
    public function setDimensionFrequency($dimension_frequency)
    {
        $this->dimension_frequency = $dimension_frequency;
        return $this;
    }

    /**
     * @return string
     */
    public function getDimensionJoin()
    {
        return $this->dimension_join;
    }

    /**
     * @param string $dimension_join
     * @return Contact
     */
    public function setDimensionJoin($dimension_join)
    {
        $this->dimension_join = $dimension_join;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefEmailPromo()
    {
        return $this->pref_email_promo;
    }

    /**
     * @param string $pref_email_promo
     * @return Contact
     */
    public function setPrefEmailPromo($pref_email_promo)
    {
        $this->pref_email_promo = $pref_email_promo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefEmailBenefits()
    {
        return $this->pref_email_benefits;
    }

    /**
     * @param string $pref_email_benefits
     * @return Contact
     */
    public function setPrefEmailBenefits($pref_email_benefits)
    {
        $this->pref_email_benefits = $pref_email_benefits;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefEmailReminders()
    {
        return $this->pref_email_reminders;
    }

    /**
     * @param string $pref_email_reminders
     * @return Contact
     */
    public function setPrefEmailReminders($pref_email_reminders)
    {
        $this->pref_email_reminders = $pref_email_reminders;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefEmailAccount()
    {
        return $this->pref_email_account;
    }

    /**
     * @param string $pref_email_account
     * @return Contact
     */
    public function setPrefEmailAccount($pref_email_account)
    {
        $this->pref_email_account = $pref_email_account;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefEmailFeedback()
    {
        return $this->pref_email_feedback;
    }

    /**
     * @param string $pref_email_feedback
     * @return Contact
     */
    public function setPrefEmailFeedback($pref_email_feedback)
    {
        $this->pref_email_feedback = $pref_email_feedback;
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