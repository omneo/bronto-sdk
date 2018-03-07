<?php

namespace Arkade\Bronto\Modules;

use Arkade\Bronto\Entities\Contact;
use Arkade\Bronto\Serializers\ContactSerializer;
use Arkade\Bronto\Parsers\ContactParser;
use Arkade\Bronto\Exceptions;
use Carbon\Carbon;

class ContactService extends AbstractSoapModule
{
    /**
     * Create a contact in Bronto
     *
     * @param Contact $contact
     * @return Contact
     * @throws Exceptions\BrontoException
     */
    public function create(Contact $contact)
    {
        // The mappings for this implementation
        $fieldMappings = config('bronto.field_mappings');
        $contactMappings = config('bronto.contact_mappings');
        $contactRow = $this->buildContactRow($contact);

        // Save
        try {
            return (new ContactParser)->parse($contactRow->save(), $fieldMappings, $contactMappings);
        } catch (\Exception $e) {
            throw new Exceptions\BrontoException((string)$e->getMessage(),
                $e->getCode());
        }
    }

    /**
     * @param Contact $contact
     * @return \Bronto_Api_Rowset
     * @throws Exceptions\BrontoException
     */
    public function update(Contact $contact) {
        $contactRow = $this->buildContactRow($contact);

        // Update
        try {
            return $contactRow->getApiObject()->update($contactRow->getData());
        } catch (\Exception $e) {
            throw new Exceptions\BrontoException((string)$e->getMessage(),
                $e->getCode());
        }

    }


    /**
     * @param Contact $contact
     * @return \Bronto_Api_Contact_Row
     */
    public function buildContactRow(Contact $contact){
        $contactObject = $this->client->getClient()->getContactObject();

        $contactRow = $contactObject->createRow();
        $contactRow->email = $contact->getEmail();
        $contactRow->status = $contact->getStatus();

        // Add Contact to List
        $contactRow->addToList($this->client->getListId());

        // The mappings for this implementation
        $fieldMappings = config('bronto.field_mappings');
        $contactMappings = config('bronto.contact_mappings');

        // Transform the Contact entity to a flattened array
        $contactArray = array_filter(json_decode((new ContactSerializer())->serialize($contact),true));

        // Map the fields to Bronto field ID's and set the fields on the contact row
        foreach ($contactArray as $key => $value){
            if($key === 'email' || $key === 'id' || $key === 'status') continue;
            $value = isset($value['date']) ? Carbon::parse($value['date'])->toDateString() : $value;
            $contactRow->setField($fieldMappings[$contactMappings[$key]], (string)$value);
        }

        return $contactRow;
    }


    /**
     * Find contact by ID
     *
     * @param string ID
     * @return Contact
     * @throws Exceptions\BrontoException
     */
    public function findById($id)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactsFilter['id'] = [$id];
        $contactsFilter['listId'] = [$this->client->getListId()];

        // The mappings for this implementation
        $fieldMappings = config('bronto.field_mappings');
        $contactMappings = config('bronto.contact_mappings');

        $fields = [];
        foreach($contactMappings as $mapping){
            if(array_key_exists($mapping, $fieldMappings)){
                $fields[] = $fieldMappings[$mapping];
            }
        }

        // Save
        try {
            $contacts = $contactObject->readAll($contactsFilter, $fields, false);

            if (!$contacts->count()) return null;

            return (new ContactParser)->parse($contacts[0], $fieldMappings, $contactMappings);
        } catch (\Exception $e) {
            throw new Exceptions\BrontoException((string)$e->getResponse()->getBody(),
                $e->getResponse()->getStatusCode());
        }
    }

    /**
     * Find contact by Email
     *
     * @param string $email
     * @return Contact
     */
    public function findByEmail($email)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $contactsFilter['email'] = ['value' => $email, 'operator' => 'EqualTo'];
        $contactsFilter['listId'] = [$this->client->getListId()];

        // The mappings for this implementation
        $fieldMappings = config('bronto.field_mappings');
        $contactMappings = config('bronto.contact_mappings');

        $fields = [];
        foreach($contactMappings as $mapping){
            if(array_key_exists($mapping, $fieldMappings)){
                $fields[] = $fieldMappings[$mapping];
            }
        }

        // Save
        $contacts = $contactObject->readAll($contactsFilter, $fields, false);

        if (!$contacts->count()) return null;

        return (new ContactParser)->parse($contacts[0], $fieldMappings, $contactMappings);
    }

    /**
     * Output fields for bronto config file
     *
     * @return void
     * @throws Exceptions\BrontoException
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
            throw new Exceptions\BrontoException((string)$e->getResponse()->getBody(),
                $e->getResponse()->getStatusCode());
        }
    }

}