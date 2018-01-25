> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> Email Message

---
# Email Message

```php
<?php

Route::get('qr-code/examples/email', function () 
{
      
    $to = 'john.doe@example.com';
    $subject = 'QR Code Message';
    $body = 'This email was created from a QR Code!';
  
    return QRCode::email($to, $body, $subject)->png();
      
});    
```