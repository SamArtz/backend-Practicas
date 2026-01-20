<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailSendController;

Route::post('v1/email/send', EmailSendController::class);
