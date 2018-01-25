<?php

namespace LaravelQRCode\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class QRCode
 *
 * Laravel QR Code Generator is distributed under MIT
 * Copyright (C) 2018 Bruno Vaula Werneck <brunovaulawerneck at gmail dot com>
 *
 * @package LaravelQRCode\Facades
 */
class QRCode extends Facade
{
    protected static function getFacadeAccessor() {
        return 'qr-code';
    }
}