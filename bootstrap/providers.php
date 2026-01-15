<?php

use App\Providers\FortifyServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\PaymentServiceProvider::class,
    FortifyServiceProvider::class,
];
