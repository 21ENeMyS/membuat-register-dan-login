<?php 

class User{
  private $tabel = 'users';
  private $db;

  public function __construct()
  {
    $this -> db = new Database;
  }

  public function GetUser()
  {
    $query = "SELECT * FROM ". $this -> tabel; 
    $this -> db -> query($query);
    $result = $this -> db -> Resulset();
    return $result;
  }

  public function Register($data) {
    $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

    //Bind values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    //Execute function
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function login($username,$password)
{
  $query = ('SELECT * FROM '. $this -> tabel.' WHERE username = :username');

  $this -> db ->query($query);
  $this -> db -> bind(':username',$username);

  $row = $this -> db -> single();

  $hash = $row -> password;

  // verifikasi password jika sama 
  if (password_verify($password, $hash)) {
    return $row;
  }else {
    // dan jika tidak sama dengan password di database kirimkan pesan error di Controller users
    return false;
  }
}

  public function findUserByEmail($email)
  {
    $query = "SELECT * FROM ". $this -> tabel ." WHERE email = :email";
    // bind-ing email
    $this -> db -> query($query);
    $this -> db -> bind(':email',$email);

    if ($this ->  db -> Rowcount() > 0) {
      return true;
    }else{
      return false;
    }
  }

}
?>
