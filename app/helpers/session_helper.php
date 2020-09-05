<?php 

function IsLoggin()
{
  if (isset($_SESSION['id'])) {
    return true;
  }else {
    return false;
  }
}

?>