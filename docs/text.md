> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> Text

---
# Text

```php
<?php
Route::get('qr-code/examples/text', function () 
{
    return  QRCode::text('Laravel QR Code Generator!')->png();   
});    
```