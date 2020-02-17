<?php

use Illuminate\Support\Facades\Route;
use RyanChandler\Shortlinks\Http\Controllers\ShortlinkController;

Route::get('/'.config('shortlinks.url_prefix').'/{shortlink}', ShortlinkController::class)->name('shortlink');