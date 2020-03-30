<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class ConstantHelper {

    // Define Global Constants
    const STATUS_OK = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_UNPROCESSABLE_ENTITY = 422;
}