> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> vCard v3

---
# vCard v3

```php
<?php

Route::get('qr-code/examples/v-card', function () 
{
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
        'country' => 'Neverland',
        'zip' => '12345-678'
    ];
    $wordAddress = [
       'type' => 'work',
       'pref' => false,
       'street' => '123 my work street st',
       'city' => 'My Dreadful Town',
       'state' => 'LV',
       'country' => 'Hell',
       'zip' => '12345-678'
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
    
    return QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
                ->setErrorCorrectionLevel('H')
                ->setSize(4)
                ->setMargin(2)
                ->svg();
});
```

### Notes

 - You can have only one preferential address
 - Error Correction Level is set to H(igh) because there is a lot of information
 - Try using SVG when encoding complex information, since you can re-scale the image file at will without loss of quality
