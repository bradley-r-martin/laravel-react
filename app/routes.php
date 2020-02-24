<?php

Route::get('{slug}','\BRM\React\app\Controllers\Routing@index')->where('slug', '(?!api|uploads).*(?<!js|css|json|html|txt|xml|webmanifest|jpg|gif|png|svg)$([A-z\d-\/_.]+)?');