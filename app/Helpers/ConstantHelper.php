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

    const DOCTOR_CREATE = 'Doctor record has been created successfully';
    const DOCTOR_CREATE_FAIL = 'Something went wrong. Doctor record creation failed';
    const DOCTOR_UPDATE = 'Doctor record has been updated successfully';
    const DOCTOR_UPDATE_FAIL = 'Something went wrong. Doctor record updation failed';
    const DOCTOR_DELETE = 'Doctor record has been deleted successfully';
    const DOCTOR_DELETE_FAIL = 'Something went wrong. Doctor record deletion failed';

    const MESSAGE_CREATE = 'Message has been created successfully';
    const MESSAGE_CREATE_FAIL = 'Something went wrong. Message creation failed';
    const MESSAGE_UPDATE = 'Message has been updated successfully';
    const MESSAGE_UPDATE_FAIL = 'Something went wrong. Message updation failed';
    const MESSAGE_DELETE = 'Message has been deleted successfully';
    const MESSAGE_DELETE_FAIL = 'Something went wrong. Message deletion failed';
    // const MESSAGE_PUSH = 'Message has been sent to user devices successfully';
    // const MESSAGE_PUSH_FAIL = 'Something went wrong. Message sending failed';

    const DISEASE_CREATE = 'Disease record has been created successfully';
    const DISEASE_CREATE_FAIL = 'Something went wrong. Disease record creation failed';
    const DISEASE_UPDATE = 'Disease record has been updated successfully';
    const DISEASE_UPDATE_FAIL = 'Something went wrong. Disease record updation failed';
    const DISEASE_DELETE = 'Disease record has been deleted successfully';
    const DISEASE_DELETE_FAIL = 'Something went wrong. Disease record deletion failed';
}