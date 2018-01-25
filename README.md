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
  
## Usage
    
  ```php
  <?php
  
  Route::get('qr-code', function () 
  {
    return QRCode::text('QR Code Generator for Laravel!')->png();    
  });
  
  ```
  The above route should print a PNG image for a text QR Code.
  
  Make sure you check the [Documentation](https://werneckbh.github.io/laravel-qr-code/) for further instructions.
   
## [Contributing](CONTRIBUTING.md)
 
 To contribute to this project, please do the following:
 
  - Fork it
  - Create a new branch for your contribution
  - Test it! Make sure it works and it won't break the master code
  - Send pull request
  
  Contributors will be added to package descriptor. Make sure you abide to the [Contributor Covenant Code of Conduct](CODE_OF_CONDUCT.md)
  
## [License](LICENSE.md)
  
  **(MIT)**
  
  Copyright 2018 Bruno Vaula Werneck
  
  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
  
  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
  
  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.