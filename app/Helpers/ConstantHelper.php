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

    const INSTITUTION_CREATE = 'Institution record has been created successfully';
    const INSTITUTION_CREATE_FAIL = 'Something went wrong. Institution record creation failed';
    const INSTITUTION_UPDATE = 'Institution record has been updated successfully';
    const INSTITUTION_UPDATE_FAIL = 'Something went wrong. Institution record updation failed';
    const INSTITUTION_DELETE = 'Institution record has been deleted successfully';
    const INSTITUTION_DELETE_FAIL = 'Something went wrong. Institution record deletion failed';

    const DISEASE_CREATE = 'Disease record has been created successfully';
    const DISEASE_CREATE_FAIL = 'Something went wrong. Disease record creation failed';
    const DISEASE_UPDATE = 'Disease record has been updated successfully';
    const DISEASE_UPDATE_FAIL = 'Something went wrong. Disease record updation failed';
    const DISEASE_DELETE = 'Disease record has been deleted successfully';
    const DISEASE_DELETE_FAIL = 'Something went wrong. Disease record deletion failed';
}