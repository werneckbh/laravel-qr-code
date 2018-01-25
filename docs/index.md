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
  - Email Message
  - Phone
  - SMS
  - Text
  - URL
  - meCard
  - vCard v3
  - Wi-fi Network Settings
  
  
  
 ### Common Options
  
 Option | Return value | Expected Values
 -------|:-------------|:---------------
 `->setErrorCorrectionLevel($level)`|$this|'L','M','Q' or 'H'
 `->setSize(4)`|$this| Pixel size. 1 to 10
 `->setMargin(3)`|$this| 1 to 10
 `->setOutfile($file)`|$this|file path (public) and name to save QR Code
 `->png()`| |stream (or save if outfile is set) QR Code as a PNG image
 `->svg()`| |stream (or save if outfile is set) QR Code as an SVG image
  
 ## Note
 
 If you set an outfile, you **MUST make sure the path exists**.  
 Don't forget to set filename extension according to your output (.png or .svg).