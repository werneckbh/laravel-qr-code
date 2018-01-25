# Laravel QR Code Generator

Create QR Codes with Laravel

This is a wrapper for [QR Code Generator for PHP](https://werneckbh.github.io/qr-code), a standalone library to generate QR Codes in PNG and SVG.

## Installation

Install using **composer**:

```bash
$ composer require werneckbh/laravel-qr-code
```
##### Laravel 5.4 (5.5+ can skip this step)

You need to add provider and alias to your `config/app.php` file:
 
```php
<?php

'providers' => [     
   
 LaravelQRCode\Providers\QRCodeServiceProvider::class,     

],


'aliases' => [

'QRCode' => LaravelQRCode\Facades\QRCode::class,     
   
] 
```
## QR Code Types

Laravel QR Code Generator supports the following QR Codes:

- Calendar Event
  ```php
  <?php

    $start = new \DateTime('next saturday 7pm');
    $end = new \DateTime('next saturday 11pm');
    
    $summary = 'Interview with Neil DeGrasse Tyson';
    $description = 'Meet Mr. Tyson at Per Se and interview him about the asteroid Apophis';
    $location = 'Time Warner Center, 10 Columbus Cir, New York, NY 10023, USA';
  
    QRCode::calendar($start, $end, $summary, $description, $location)->svg();
  ```
- Email Message
  ```php
  <?php
    
    $to = 'john.doe@example.com';
    $subject = 'QR Code Message';
    $body = 'This email was created from a QR Code!';
  
    QRCode::email($to, $body, $subject)->png();
  ```
- Phone
  ```php
  <?php
    
    QRCode::phone('+55 31 1234-5678')
              ->setSize(4)
              ->setMargin(2)
              ->png();
  ```
- SMS
  ```php
    <?php
      
      QRCode::sms('+55 (31) 1234-5678', 'Text to send!')
                ->setSize(4)
                ->setMargin(2)
                ->png();
  ```
- Text
  ```php
  <?php

    QRCode::text('QR Code Generator for Laravel!')->png();
  ```
- URL
  ```php
  <?php
    
    QRCode::url('werneckbh.github.io/qr-code/')
              ->setSize(8)
              ->setMargin(2)
              ->png();
  ```
- meCard
  ```php
  <?php

    QRCode::meCard('John Doe', '1234 Main st.', '+1 001 555-1234', 'john.doe@example.com')->svg();
  ```
- [vCard v3 - (Detailed Instructions)](v-card.md)
- Wi-fi Network Settings
  ```php
  <?php

    $authenticationType = "WPA2";
    $ssId = "MySuperSSID";
    $ssIdisHidden = false;
    $password = "Y0uC4n7f1nd7h3p4ssw0rd";
  
    QRCode::wifi($authenticationType, $ssId, $password, $ssIdisHidden)
              ->setOutfile('images/my-wifi.png')
              ->png();
  ```
### Common Options

These options are available to any of the QR Code types above.

Option | Return value | Expected Values
-------|:-------------|:---------------
`setErrorCorrectionLevel($level)`|$this|'L','M','Q' or 'H'
`setSize(4)`|$this| Pixel size. 1 to 10
`setMargin(3)`|$this| 1 to 10
`setOutfile($file)`|$this|file path (public) and name.ext to save QR Code
`png()`| |stream (or save if outfile is set) QR Code as a PNG image
`svg()`| |stream (or save if outfile is set) QR Code as an SVG image

## Notes

 - If you set an outfile, you **MUST make sure the path exists**.  
Don't forget to **set filename extension** according to your output (.png or .svg).

 - Since SVGs are scalable, use them to make complex QR Codes such as Calendar Events, meCards and vCards