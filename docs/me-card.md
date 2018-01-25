> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> meCard

---
# meCard

```php
<?php
Route::get('qr-code/examples/me-card', function () 
{
    return QRCode::meCard('John Doe', '1234 Main st.', '+1 001 555-1234', 'john.doe@example.com')->svg();
});    
```