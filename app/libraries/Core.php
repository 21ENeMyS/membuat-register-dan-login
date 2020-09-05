<?php 

class Core  
{
  protected $controller = 'Pages';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this -> ParseURL();

    // lihat nilai pertama dalam controllers, ucword adalah syntax php yang awalan hurufnya kapital

    if (isset($url[0])) {
      if (file_exists('../app/controllers/' . ucwords($url[0]) .'.php')) {
        
        // timpa controller dengan controller baru

        $this -> controller = ucwords($url[0]);
        unset($url[0]);
      }
    }

    // sambungkan controller
    require_once '../app/controllers/'. $this -> controller . '.php';
    $this -> controller = new $this -> controller;

    // method url ke 1
    if (isset($url[1])) {
      if (method_exists($this -> controller, $url[1])) {
        $this -> method = $url[1];
        unset($url[1]);
      }
    }

    // mengambil params /parameter
    $this -> params = $url ? array_values($url) : [];

    // panggil balik
    call_user_func_array([$this -> controller,$this -> method], $this-> params);
  }

  public function ParseURL()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'],'/');
      $url = filter_var($url,FILTER_SANITIZE_URL);
      $url = explode('/',$url);
      return $url;
    }
  }
}


?>