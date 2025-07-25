<?php

declare(strict_types=1);

Route::delete('/{user}', 'destroy')->name('delete');

Route::patch('/{user}/status', 'updateUserStatus')->name('updateStatus');
