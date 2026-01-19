<?php

use App\Providers\FortifyServiceProvider;
use Laravel\Sanctum\SanctumServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\PaymentServiceProvider::class,
    FortifyServiceProvider::class,
    SanctumServiceProvider::class,
];
