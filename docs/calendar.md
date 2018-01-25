> [Laravel QR Code Generator](index.md) >> [QR Code Types](index.md#code-types) >> Calendar Event

---
# Calendar Event

```php
  <?php

    Route::get('qr-code/examples/calendar', function () 
    {
        // Required params
        $start = new \DateTime('next saturday 7pm');
        $end = new \DateTime('next saturday 11pm');        
        $summary = 'Interview with Neil DeGrasse Tyson';
        
        // Optional params
        $description = 'Meet Mr. Tyson at Per Se and interview him about the asteroid Apophis';
        $location = 'Time Warner Center, 10 Columbus Cir, New York, NY 10023, USA';
        
        return QRCode::calendar($start, $end, $summary, $description, $location)->svg();
    });    
  ```
  
  