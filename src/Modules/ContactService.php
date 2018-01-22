<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Contact;

class ContactService extends AbstractSoapModule
{
    /**
     * Create a contact in Bronto
     *
     * @param Contact
     * @return Contact
     */
    public function create(Contact $contact)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactRow = $contactObject->createRow();
        $contactRow->email = $contact->getEmail();
        $contactRow->status = \Bronto_Api_Contact::STATUS_ONBOARDING;

        // Add Contact to List
        $contactRow->addToList($this->client->getListId());

        // Set a custom Field value
        // $field can be the (string) ID or a Bronto_Api_Field instance
        $contactRow->setField('FirstName', $contact->getFirstName());
        $contactRow->setField('LastName', $contact->getLastName());

        // Save
        try {
            return $contactRow->save();
        } catch (Exception $e) {
            // Handle error
        }
    }

    /**
     * Find contact by ID
     *
     * @param Contact
     * @return Contact
     */
    public function findById(Contact $contact)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactsFilter['id'] = [$contact->getId()];
        $contactsFilter['listId'] = [$this->client->getListId()];
        $fields = ['0bce03e9000000000000000000000001cb4a'];

        // Save
        try {

            $contacts = $contactObject->readAll($contactsFilter, $fields, false);

            if (!$contacts->count()) return null;

            return $contacts[0];

        } catch (Exception $e) {
            // Handle error
        }
    }

    /**
     * Find contact by Email
     *
     * @param Contact
     * @return Contact
     */
    public function findByEmail(Contact $contact)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactsFilter['email'] = ['value' => $contact->getEmail(), 'operator' => 'EqualTo'];
        $contactsFilter['listId'] = [$this->client->getListId()];
        $fields = ['0bce03e9000000000000000000000001cb4a'];

        // Save
        try {

            $contacts = $contactObject->readAll($contactsFilter, $fields, false);

            if (!$contacts->count()) return null;

            return $contacts[0];

        } catch (Exception $e) {
            // Handle error
        }
    }

    /**
     * Output fields for bronto config file
     *
     * @return void
     */
    public function outputFields()
    {
        $fieldObject = $this->client->getClient()->getFieldObject();

        // Save
        try {

            $fields = $fieldObject->readAll();

            foreach($fields as $field){
                $field = $field->toArray();
                echo "'" . $field['name'] . "' => " . "'" . $field['id'] . "',\r\n";
            }

        } catch (Exception $e) {
            // Handle error
        }
    }

}