<?php

use Illuminate\Support\Facades\Route;
use RyanChandler\Shortlinks\Http\Controllers\ShortlinkController;
use RyanChandler\Shortlinks\Http\Middleware\TrackShortlink;

Route::middleware('web', TrackShortlink::class)->group(function () {
    Route::get('/'.config('shortlinks.url_prefix').'/{shortlink}', ShortlinkController::class)->name('shortlink');
});