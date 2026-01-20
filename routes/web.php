<?php

use App\Http\Controllers\EmailPreviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailSendController;

Route::get('api/v1/email/preview', EmailPreviewController::class);