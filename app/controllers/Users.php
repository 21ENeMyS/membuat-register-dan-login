<?php 

class Users extends Controller{

  public function __construct()
  {
    $this -> Usermodel = $this -> model('User');
  }

  public function login()
  {
    $data = [
      'title' => "Login",
      'username' => '',
      'password' => '',
      'usernameError' => '',
      'passwordError' => ''
    ];
// cek post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize data post
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
      $data = [
        'title' => "Login",
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'usernameError' => '',
        'passwordError' => '',
      ];
      
      // validasi username
      if (empty($data['username'])) {
        $data['usernameError'] = "Masukan username anda";
      }

      // validasi password
      if (empty($data['password'])) {
        $data['passwordError'] = "Masukan password anda";
      }

      // cek jika error karena kosong 
      if (empty($data['usernameError']) && empty($data['passwordError'])) {
        $loginUser = $this -> Usermodel -> login($data['username'],$data['password']);
      if ($loginUser) {
        $this -> CreateSession($loginUser);
      }else {
        $data['passwordError'] = 'password atau username tidak valid';
        $this -> view('users/login',$data);
        }
      }
    }else {
      $data = [
        'title' => 'Login',
        'username' => '',
        'password' => '',
        'usernameError' => '',
        'passwordError' => ''
  
      ];
    }


    $this -> view('templates/header',$data);
    $this -> view('users/login',$data);
    $this -> view('templates/footer');
  }

  public function register() {
    $data = [
        'title' => 'Register',
        'username' => '',
        'email' => '',
        'password' => '',
        'confirmPassword' => '',
        'usernameError' => '',
        'emailError' => '',
        'passwordError' => '',
        'confirmPasswordError' => ''
    ];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Process form
    // Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
            'title' => 'Register',
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirmPassword' => trim($_POST['confirmPassword']),
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        $nameValidation = "/^[a-zA-Z0-9]*$/";
        $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

        //Validate username on letters/numbers
        if (empty($data['username'])) {
            $data['usernameError'] = 'Please enter username.';
        } elseif (!preg_match($nameValidation, $data['username'])) {
            $data['usernameError'] = 'Name can only contain letters and numbers.';
        }

        //Validate email
        if (empty($data['email'])) {
            $data['emailError'] = 'Please enter email address.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Please enter the correct format.';
        } else {
            //Check jika email sudah ada
            if ($this->Usermodel->findUserByEmail($data['email'])) {
            $data['emailError'] = 'Email is already taken.';
            }
        }

       // validasi passoword dan panjang password, password tidak boleh ada angka/ numeric values,
        if(empty($data['password'])){
          $data['passwordError'] = 'Please enter password.';
        } elseif(strlen($data['password']) < 6){
          $data['passwordError'] = 'Password must be at least 8 characters';
        } elseif (!preg_match($passwordValidation, $data['password'])) {
          $data['passwordError'] = 'Password must be have at least one numeric value.';
        }

        //validasi confirm password 
         if (empty($data['confirmPassword'])) {
            $data['confirmPasswordError'] = 'Please enter password.';
        } else {
            if ($data['password'] != $data['confirmPassword']) {
            $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
            }
        }

        // pastikan error itu karena kosong
        if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //method Register berada di class user 
            if ($this->Usermodel->Register($data)) {
                //jika benar pindahkan ke user/login atau Redirect to the login page
                header('location: ' . BASEURL . '/users/login');
            } else {
              // jika ada kesalahan kirimkan pesan berikut
                die('Something went wrong.');
            }
        }
    }
    $this->view('users/register', $data);
}

  public function CreateSession($user)
  {
    $_SESSION['id'] = $user -> id;
    $_SESSION['username'] = $user -> username;
    $_SESSION['email'] = $user -> email;
    header('Location: ' . BASEURL .'/page/index');
  }

  public function logout()
  {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    header('Location: '. BASEURL .'/users/login');
  }
}
?>