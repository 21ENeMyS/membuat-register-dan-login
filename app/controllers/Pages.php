<?php 

class Pages extends Controller{
  public function __construct()
  {
    $this -> Usermodel = $this -> model('User');
  }

  public function index()
  {
    $users = $this -> model('User') -> GetUser();
    $data = [
      'users' => $users
    ];
    $this -> view('templates/header');
    $this -> view('pages/index',$data);
    $this -> view('templates/footer');
  }

  public function about()
  {
    $this -> view('templates/header');
    $this -> view('pages/about');
    $this -> view('templates/footer');
  }
}
?>