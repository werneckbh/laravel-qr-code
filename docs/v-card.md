## vCard v3

A vCard is a more complex meCard and deserves a detailed instructions page.

A vCard is composed of basically 3 items:

 - Personal Information
 - Address (1 or more)
 - Phone (1 or more)
 
To generate a vCard QR Code, do this:

```php
<?php

// Personal Information
$firstName = 'John';
$lastName = 'Doe';
$title = 'Mr.';
$email = 'john.doe@example.com';

// Addresses
$homeAddress = [
    'type' => 'home',
    'pref' => true,
    'street' => '123 my street st',
    'city' => 'My Beautiful Town',
    'state' => 'LV',
    'country' => 'Neverland'
];
$wordAddress = [
   'type' => 'work',
   'pref' => false,
   'street' => '123 my work street st',
   'city' => 'My Dreadful Town',
   'state' => 'LV',
   'country' => 'Hell'
];

$addresses = [$homeAddress, $wordAddress];

// Phones
$workPhone = [
    'type' => 'work',
    'number' => '001 555-1234',
    'cellPhone' => false
];
$homePhone = [
    'type' => 'home',
    'number' => '001 555-4321',
    'cellPhone' => false
];
$cellPhone = [
    'type' => 'work',
    'number' => '001 9999-8888',
    'cellPhone' => true
];

$phones = [$workPhone, $homePhone, $cellPhone];

QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
            ->setErrorCorrectionLevel('H')
            ->setSize(4)
            ->setMargin(2)
            ->svg();
```

### Notes

 - You can have only one preferential address
 - Error Correction Level is set to H(igh) because there is a lot of information
 - Try using SVG when encoding complex information, since you can re-scale the image file at will without loss of quality