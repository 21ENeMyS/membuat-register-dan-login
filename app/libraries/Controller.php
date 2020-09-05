<?php 

// Load Model dan View
class Controller{

  public function view($view,$data =[])
  {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($model)
  { 
    // menyambungkan folder model ke file Controller
    require_once '../app/models/' . $model . '.php';
    // instalisasi model
    return new $model;
  }
}

?>