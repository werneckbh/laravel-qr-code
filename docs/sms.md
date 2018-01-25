> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> SMS

---
# SMS

```php
<?php
Route::get('qr-code/examples/sms', function () 
{
    return QRCode::sms('+55 (31) 1234-5678', 'Text to send!')
                         ->setSize(4)
                         ->setMargin(2)
                         ->png();     
});    
```