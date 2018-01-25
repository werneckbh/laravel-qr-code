> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> Wi-fi Network Settings

---
# Wi-fi Network Settings

```php
<?php
Route::get('qr-code/examples/wifi', function () 
{
    $authenticationType = "WPA2";
    $ssId = "MySuperSSID";
    $ssIdisHidden = false;
    $password = "Y0uC4n7f1nd7h3p4ssw0rd";
  
    return QRCode::wifi($authenticationType, $ssId, $password, $ssIdisHidden)
              ->setOutfile('images/my-wifi.png')
              ->png();
});    
```