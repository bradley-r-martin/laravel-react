<?php

Route::get('site.webmanifest', function () {
    return Response::make('', 200)->header('Content-Type', 'application/manifest+json');
});

Route::get('theme.css', function () {
    return Response::make('', 200)->header('Content-Type', 'text/css');
});

Route::get('config.js', function () {
    return Response::make('', 200)->header('Content-Type', 'text/css');
});

Route::get('{slug}', function () {
    $path = public_path('default.html');
    if (file_exists($path)) {
        $html = file_get_contents($path);
        $variables = array(
          'title' => 'TITLE',
          'theme' => 'theme.css',
          'script' => ''
        );
        if (class_exists('\BRM\Tenants\FrameworkServiceProvider')) {
            if ($tenant = app(\Hyn\Tenancy\Environment::class)->hostname()) {
                $variables['title'] = $tenant->name;
            }
        }
        foreach ($variables as $key => $value) {
            $html = str_replace('[{'.$key.'}]', $value, $html);
        }
    } else {
        return view('react::unbuilt');
    }
    return view('react::application', ['html'=> $html]);
})->where('slug', '(?!api)(?!uploads)(?!js)(?!json)(?!css)(?!html)(?!xml)(?!webmanifest)(?!txt)(?:[^img]*)([A-z\d-\/_.]+)?');
