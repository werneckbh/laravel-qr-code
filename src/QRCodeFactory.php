<?php

namespace LaravelQRCode;

use LaravelQRCode\Exceptions\EmptyTextException;
use LaravelQRCode\Exceptions\MalformedUrlException;
use QR_Code\Exceptions\InvalidVCardAddressEntryException;
use QR_Code\Exceptions\InvalidVCardPhoneEntryException;
use QR_Code\Types\QR_CalendarEvent;
use QR_Code\Types\QR_EmailMessage;
use QR_Code\Types\QR_meCard;
use QR_Code\Types\QR_Phone;
use QR_Code\Types\QR_Sms;
use QR_Code\Types\QR_Text;
use QR_Code\Types\QR_Url;
use QR_Code\Types\QR_VCard;
use QR_Code\Types\QR_WiFi;
use QR_Code\Types\vCard\Address;
use QR_Code\Types\vCard\Person;
use QR_Code\Types\vCard\Phone;

/**
 * Class QRCodeFactory
 *
 * Laravel QR Code Generator is distributed under MIT
 * Copyright (C) 2018 Bruno Vaula Werneck <brunovaulawerneck at gmail dot com>
 *
 * @package Werneckbh\QRCodeFactory
 */
class QRCodeFactory
{
    /**
     * Returns as QR_CalendarEvent object
     *
     * @param \DateTime $start
     * @param \DateTime $end
     * @param string    $summary
     * @param string    $description
     * @param string    $location
     *
     * @return \QR_Code\Types\QR_CalendarEvent
     * @throws \QR_Code\Exceptions\EmptyEventSummaryException
     * @throws \QR_Code\Exceptions\InvalidEventDateException
     */
    public function calendar (\DateTime $start, \DateTime $end, string $summary, string $description, string $location): QR_CalendarEvent
    {
        return new QR_CalendarEvent($start, $end, $summary, $description, $location);
    }

    /**
     * Returns a QR_EmailMessage object
     *
     * @param string $toEmail
     * @param string $body
     * @param string $subject
     *
     * @return \QR_Code\Types\QR_EmailMessage
     * @throws \LaravelQRCode\Exceptions\EmptyTextException
     */
    public function email (string $toEmail, string $body, string $subject): QR_EmailMessage
    {
        if (trim($toEmail) === '') {
            throw new EmptyTextException('Recipient email cannot be empty');
        }

        return new QR_EmailMessage($toEmail, $body, $subject);
    }

    /**
     * Returns a QR_meCard object
     *
     * @param string $name
     * @param string $address
     * @param string $phone
     * @param string $email
     *
     * @return \QR_Code\Types\QR_meCard
     */
    public function meCard (string $name, string $address, string $phone, string $email): QR_meCard
    {
        return new QR_meCard($name, $address, $phone, $email);
    }

    /**
     * Returns a QR_Phone object
     *
     * @param string $number
     *
     * @return \QR_Code\Types\QR_Phone
     */
    public function phone (string $number): QR_Phone
    {
        return new QR_Phone($number);
    }

    /**
     * Return a QR_Sms object
     *
     * @param string $number
     * @param string $text
     *
     * @return \QR_Code\Types\QR_Sms
     */
    public function sms (string $number, string $text): QR_Sms
    {
        return new QR_Sms($number, $text);
    }

    /**
     * Returns a QR_Text object
     *
     * @param string $data
     *
     * @return \QR_Code\Types\QR_Text
     * @throws \LaravelQRCode\Exceptions\EmptyTextException
     */
    public function text (string $data): QR_Text
    {
        if (trim($data) === '') {
            throw new EmptyTextException('Text cannot be empty');
        }

        return new QR_Text($data);
    }

    /**
     * Returns a QR_Url object
     *
     * @param string $url
     *
     * @return \QR_Code\Types\QR_Url
     * @throws \LaravelQRCode\Exceptions\EmptyTextException
     * @throws \LaravelQRCode\Exceptions\MalformedUrlException
     */
    public function url (string $url): QR_Url
    {
        if (trim($url) === '') {
            throw new EmptyTextException('Url cannot be empty');
        }

        if (startsWith($url, 'http://')) {
            throw new MalformedUrlException('Url cannot start with http://');
        }

        if (startswith($url, 'https://')) {
            throw new MalformedUrlException('Url cannot start with https://');
        }

        return new QR_Url($url);
    }

    /**
     * Returns a QR_VCard object
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $title Miss, Mrs., Mr., Doctor, etc
     * @param string $email
     * @param array  $addresses
     * @param array  $phones
     *
     * @return \QR_Code\Types\QR_VCard
     * @throws \QR_Code\Exceptions\InvalidVCardAddressEntryException
     * @throws \QR_Code\Exceptions\InvalidVCardPhoneEntryException
     */
    public function vCard (string $firstName, string $lastName, string $title, string $email, array $addresses, array $phones): QR_VCard
    {
        $this->validateVCardAddresses($addresses);
        $this->validatePrefAddresses($addresses);
        $this->validateVCardPhones($phones);

        $person = new Person($firstName, $lastName, $title, $email);

        $addressesArray = [];
        foreach ($addresses as $address) {
            $addressesArray[] = new Address(
                strtoupper($address['type']), $address['pref'] === true, $address['street'], $address['city'],
                $address['state'], $address['zip'], $address['country']
            );
        }

        $phonesArray = [];
        foreach ($phones as $phone) {
            $phonesArray[] = new Phone(strtoupper($phone['type']), $phone['number'], $phone['cellPhone']);
        }

        return new QR_VCard($person, $phonesArray, $addressesArray);
    }

    /**
     * Returns a QR_WiFi object
     *
     * @param string $authType
     * @param string $ssId
     * @param string $password
     * @param bool   $ssdIDisHidden
     *
     * @return \QR_Code\Types\QR_WiFi
     */
    public function wifi (string $authType, string $ssId, string $password, bool $ssdIDisHidden) : QR_WiFi
    {
        return new QR_WiFi($authType, $ssId, $password, $ssdIDisHidden);
    }

    /**
     * Validates vCard Addresses
     *
     * @param array $addresses
     *
     * @throws \QR_Code\Exceptions\InvalidVCardAddressEntryException
     */
    protected function validateVCardAddresses (array $addresses) : void
    {
        $requiredKeys = ['type', 'pref', 'street', 'city', 'state', 'zip', 'country'];

        foreach ($addresses as $address) {
            $keys = array_keys($address);
            foreach ($keys as $key) {
                if (!in_array($key, $requiredKeys)) {
                    throw new InvalidVCardAddressEntryException('Address requires ' . $key . ' key');
                }
            }
        }
    }

    /**
     * Validates preferential addresses
     *
     * @param array $addresses
     *
     * @throws \QR_Code\Exceptions\InvalidVCardAddressEntryException
     */
    protected function validatePrefAddresses (array $addresses) : void
    {
        $preferentialAddressCount = 0;

        foreach ($addresses as $address) {
            if ($address['pref'] === true) {
                $preferentialAddressCount ++;
            }
        }

        if ($preferentialAddressCount > 1) {
            throw new InvalidVCardAddressEntryException(
                "You can only have one preferential address.\nPreferential Addresses found: {$preferentialAddressCount}"
            );
        }
    }

    /**
     * Validates vCard Phones
     *
     * @param array $phones
     *
     * @throws \QR_Code\Exceptions\InvalidVCardPhoneEntryException
     */
    protected function validateVCardPhones (array $phones) : void
    {
        $requiredKeys = ['type', 'number', 'cellPhone'];
        foreach ($phones as $phone) {
            $keys = array_keys($phone);
            foreach ($keys as $key) {

                if (!in_array($key, $requiredKeys)) {
                    throw new InvalidVCardPhoneEntryException('Phone requires ' . $key . ' key');
                }

                if ($key === 'cellPhone' && !is_bool($phone['cellPhone'])) {
                    throw new InvalidVCardPhoneEntryException('Cellphone key must be boolean');
                }
            }
        }
    }
}
