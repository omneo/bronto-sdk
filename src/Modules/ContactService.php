<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Contact;
use Arkade\Bronto\Serializers\ContactSerializer;
use Carbon\Carbon;

class ContactService extends AbstractSoapModule
{
    /**
     * Create a contact in Bronto
     *
     * @param Contact $contact
     * @return \Bronto_Api_Contact_Row
     */
    public function create(Contact $contact)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactRow = $contactObject->createRow();
        $contactRow->email = $contact->getEmail();
        $contactRow->status = \Bronto_Api_Contact::STATUS_ONBOARDING;

        // Add Contact to List
        $contactRow->addToList($this->client->getListId());

        // The mappings for this implementation
        $fieldMappings = config('bronto.field_mappings');
        $contactMappings = config('bronto.contact_mappings');

        // Transform the Contact entity to a flattened array
        $contactArray = array_filter(json_decode((new ContactSerializer())->serialize($contact),true));

        // Map the fields to Bronto field ID's and set the fields on the contact row
        foreach ($contactArray as $key => $value){
            if($key === 'email' || $key === 'id') continue;

            $value = isset($value['date']) ? Carbon::parse($value['date'])->toDateString() : $value;

            $contactRow->setField($fieldMappings[$contactMappings[$key]], (string)$value);
        }

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

        } catch (\Exception $e) {
            // Handle error
        }
    }

}