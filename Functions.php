<?php
  /**
   *
   */
  class ClassName extends AnotherClass
  {

    function __construct(argument)
    {
      include_once("dbConnect.php");

    }

    function signIn($username,$password,$hash = 'sha256'){
    try{
      $hash_password = hash($hash, $password);
      $stmt = $this->$db->prepare("SELECT * FROM user WHERE username=:username AND password=:password");
      $stmt->bindParam("username", $username, PDO::PARAM_STR);
      $stmt->bindParam("password", $hash_password, PDO::PARAM_STR);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $data_session = array("login" => true);
        $this-> createSession($data_session);

        return array("success" => true, "error" => '');
      }else {
        return array("success" => false, "error" => 'Kombinasi Username dan Password');
        }
      }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
        return false;
      }
    }

    function signOut(){
      $this->deleteSession()
      
    }
  }

 ?>
