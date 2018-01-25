> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> URL

---
# URL

```php
<?php
Route::get('qr-code/examples/url', function () 
{
    return  QRCode::url('werneckbh.github.io/qr-code/')
                  ->setSize(8)
                  ->setMargin(2)
                  ->png();
});    
```