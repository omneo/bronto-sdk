<?php

namespace Omneo\Bronto\Modules;

use Omneo\Bronto\SoapClient;
use Omneo\Bronto\Entities\Contact;
use Omneo\Bronto\Parsers\ContactUnsubscribeParser;
use Omneo\Bronto\Serializers\ContactSerializer;
use Omneo\Bronto\Parsers\ContactParser;
use Omneo\Bronto\Exceptions;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ContactService extends AbstractSoapModule
{
    /**
     * @var Collection
     */
    protected $mappings;

    /**
     * constructor.
     *
     * @param SoapClient|null $client
     * @param Collection $mappings
     */
    public function __construct(SoapClient $client, Collection $mappings)
    {
        $this->mappings = $mappings;

        parent::__construct($client);
    }

    /**
     * Create a contact in Bronto
     *
     * @param Contact $contact
     * @return Contact
     * @throws Exceptions\BrontoException
     */
    public function create(Contact $contact)
    {
        $contactRow = $this->buildContactRow($contact);

        // Save
        try {
            return (new ContactParser)->parse($contactRow->save(), $this->mappings);
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
        $contactRow->id = $contact->getId();
        $contactRow->email = $contact->getEmail();
        $contactRow->status = $contact->getStatus();
        $contactRow->mobileNumber = $contact->getMobileNumber();

        // Add Contact to List
        $contactRow->addToList($this->client->getListId());

        // Transform the Contact entity to a flattened array
        $contactArray = array_filter(json_decode((new ContactSerializer())->serialize($contact),true));

        // Map the fields to Bronto field ID's and set the fields on the contact row
        foreach ($contactArray as $key => $value){
            if($key === 'email' || $key === 'id' || $key === 'status' || $key === 'mobileNumber') continue;
            $this->mappings->each(function($mapping) use($key, $value, &$contactRow){
                if($key === $mapping['bronto_name']){
                    $contactRow->setField($mapping['bronto_id'], (string)$value);
                }
            });
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
        //$contactsFilter['listId'] = [$this->client->getListId()];

        $fields = [];
        $this->mappings->each(function($mapping) use(&$fields){
            $fields[] = $mapping['bronto_id'];
        });

        try {
            $contacts = $contactObject->readAll($contactsFilter, $fields, false);

            if (!$contacts->count()) return null;

            return (new ContactParser)->parse($contacts[0], $this->mappings);
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

        $fields = [];
        $this->mappings->each(function($mapping) use(&$fields){
            $fields[] = $mapping['bronto_id'];
        });

        $contacts = $contactObject->readAll($contactsFilter, $fields, false);

        if (!$contacts->count()) return null;

        return (new ContactParser)->parse($contacts[0], $this->mappings);
    }

    /**
     * Get contacts updated since
     *
     * @param Carbon $date
     * @param int $page
     * @return Collection
     */
    public function getContactsUpdatedSince($date, $page = 1)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $value = $date->format('Y-m-d\Th:m:s.BP');

        $contactsFilter['modified'] = ['value' => $value, 'operator' => 'After'];
        $contactsFilter['listId'] = [$this->client->getListId()];

        $fields = [];
        $this->mappings->each(function($mapping) use(&$fields){
            $fields[] = $mapping['bronto_id'];
        });

        $contacts = $contactObject->readAll($contactsFilter, $fields, false, $page);

        $parseContacts = collect([]);

        foreach($contacts as $contact) {
            $parseContacts->push(
                (new ContactParser)->parse($contact, $this->mappings)
            );
        }

        return $parseContacts;

    }

    /**
     * Get contacts by status
     *
     * @param string $status
     * @param Carbon $date
     * @param int $page
     * @return Collection
     */
    public function getContactsByStatus($status, $date, $page = 1)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $value = $date->format('Y-m-d\Th:m:s.BP');

        $contactsFilter['status'] = [$status];
        $contactsFilter['created'] = ['value' => $value, 'operator' => 'After'];
        $contactsFilter['listId'] = [$this->client->getListId()];

        $fields = [];
        $this->mappings->each(function($mapping) use(&$fields){
            $fields[] = $mapping['bronto_id'];
        });

        $contacts = $contactObject->readAll($contactsFilter, $fields, false, $page);

        $parseContacts = collect([]);

        foreach($contacts as $contact) {
            $parseContacts->push(
                (new ContactParser)->parse($contact, $this->mappings)
            );
        }

        return $parseContacts;

    }

    /**
     * Get unsubscribes
     *
     * @param Carbon $date
     * @param int $page
     * @return Collection
     */
    public function getUnsubscribes($date, $page = 1)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $value = $date->format('Y-m-d\Th:m:s.BP');

        $contactsFilter['status'] = ['unsub'];
        $contactsFilter['modified'] = ['value' => $value, 'operator' => 'After'];
        $contactsFilter['listId'] = [$this->client->getListId()];

        $fields = [];

        $contacts = $contactObject->readAll($contactsFilter, $fields, false, $page);

        return (new ContactUnsubscribeParser())->parse($contacts);

    }

    /**
     * Get bounces
     *
     * @param Carbon $date
     * @param int $page
     * @return Collection
     */
    public function getBounces($date, $page = 1)
    {
        $contactObject = $this->client->getClient()->getContactObject();

        $value = $date->format('Y-m-d\Th:m:s.BP');

        $contactsFilter['status'] = ['bounce'];
        $contactsFilter['modified'] = ['value' => $value, 'operator' => 'After'];
        $contactsFilter['listId'] = [$this->client->getListId()];

        $fields = [];

        $contacts = $contactObject->readAll($contactsFilter, $fields, false, $page);

        return (new ContactUnsubscribeParser())->parse($contacts);

    }

    /**
     * Get fields
     *
     * @return Collection
     * @throws Exceptions\BrontoException
     */
    public function getFields()
    {
        $fieldObject = $this->client->getClient()->getFieldObject();

        try {

            $fields = $fieldObject->readAll();
            $result = collect([]);

            foreach($fields as $field){
                $field = $field->toArray();
                $result->push($field);
            }

            return $result;

        } catch (\Exception $e) {
            throw new Exceptions\BrontoException((string)$e->getResponse()->getBody(),
                $e->getResponse()->getStatusCode());
        }
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
