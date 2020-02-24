<?php
namespace BRM\React\app\Controllers;

use Illuminate\Routing\Controller;

class Routing extends Controller{
 
    public function __construct(){
        $this->parameters = [
          'title' => '',
          'css' => '',
          'js' => ''
        ];
    }

    public function index(){
      $path = public_path('default.html');
      if (file_exists($path)) {
          $html = file_get_contents($path);
          if (class_exists('\BRM\Tenants\FrameworkServiceProvider')) {
              if ($tenant = app(\Hyn\Tenancy\Environment::class)->hostname()) {
                $this->parameters['title'] = $tenant->name;
              }
              $this->parameters['js'] = "<script type='text/javascript' src='/tenant.js'></script>";
          }
          foreach ($this->parameters as $key => $value) {
              $html = str_replace('[{'.$key.'}]', $value, $html);
          }
      } else {
          return view('react::unbuilt.unbuilt');
      }
      return view('react::application', ['html'=> $html]);
    }
}
