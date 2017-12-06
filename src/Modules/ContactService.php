<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Contact;

class ContactService extends AbstractSoapModule
{
    /**
     * Product find.
     * Uses product ID
     *
     * @param $id
     * @return Contact
     */
    public function create(Contact $contact)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactRow = $contactObject->createRow();
        $contactRow->email = $contact->getEmail();
        $contactRow->status = \Bronto_Api_Contact::STATUS_ONBOARDING;

        // Add Contact to List
        $contactRow->addToList($this->client->getListId()); // $list can be the (string) ID or a Bronto_Api_List instance

        // Set a custom Field value
        //$contactRow->setField($field, $value); // $field can be the (string) ID or a Bronto_Api_Field instance

        // Save
        try {
            $contactRow->save();
        } catch (Exception $e) {
            // Handle error
        }
    }

}