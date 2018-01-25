> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> Phone

---
# Phone

```php
<?php
Route::get('qr-code/examples/phone', function () 
{
    return QRCode::phone('+55 31 1234-5678')
                         ->setSize(4)
                         ->setMargin(2)
                         ->png();     
});    
```