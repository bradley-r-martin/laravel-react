<?php

namespace BRM\React;

use Illuminate\Support\ServiceProvider;

class FrameworkServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if (!class_exists('\BRM\Tenants\FrameworkServiceProvider')) {
            $this->loadMigrationsFrom(__DIR__.'/app/Database/Migrations');
        }
  
        $this->loadRoutesFrom(__DIR__.'/app/routes.php');
        $this->loadViewsFrom(__DIR__.'/app/Views', 'react');

      //   $this->publishes([
      //   __DIR__.'/frontend/' => base_path('frontend'),
      //   __DIR__.'/.babelrc' => base_path('.babelrc'),
      //   __DIR__.'/.editorconfig' => base_path('.editorconfig'),
      //   __DIR__.'/.eslintrc.json' => base_path('.eslintrc.json'),
      //   __DIR__.'/.prettierrc' => base_path('.prettierrc'),
      //   __DIR__.'/package.json' => base_path('package.json'),
      //   __DIR__.'/postcss.config.js' => base_path('postcss.config.js'),
      //   __DIR__.'/webpack.config.js' => base_path('webpack.config.js'),
      //   __DIR__.'/.htaccess' => base_path('.htaccess'),
      //   __DIR__.'/frontend/index.html' => public_path('index.html'),
      // ], 'app');


    }
}
