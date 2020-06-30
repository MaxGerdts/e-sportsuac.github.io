<?php
/*function validate_login($email, $password){
  $resultado = $mysqli->query("SELECT * FROM `esportsuac_usuarios`  WHERE `usuarios_email` = '".$email."' AND `usuarios_password` = '".$password."' ");
  $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
  $cantidad = count($usuarios);
  return $cantidad;
}*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../riot.php';
class userClass
{
  public function randomPassword(){
    $chars = 'bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ23456789';
    $count = mb_strlen($chars);
    for ($i = 0, $result = ''; $i < 9; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }
    return $result;
  }
  public function changeToRandomPassword($random, $email){
    try {
      $db = getDB();
      $password = sha1($random);
      $stmt = $db->prepare("UPDATE esportsuac_usuarios SET usuarios_password=:password WHERE usuarios_email='".$email."'");
      $stmt->bindParam("password", $password, PDO::PARAM_STR);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }

  }
  public function reportAll(){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga IS NOT NULL");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }

  }
  public function getLigaUser($email){
    try {
        $db = getDB();
        $sql = $db->query("SELECT usuarios_liga FROM esportsuac_usuarios WHERE usuarios_email = '".$email."'");
        $liga = $sql->fetch(PDO::FETCH_ASSOC);
        return $liga['usuarios_liga'];
    }  catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportLiga($liga){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga = '".$liga."' ");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportPrograma($programa){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga IS NOT NULL AND usuarios_programa = '".$programa."' ");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }

  }
  public function reportProgramaSecond($programa){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga IS NOT NULL AND usuarios_programa = '".$programa."' ");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result['usuarios_liga'] =="League of legends") {
          $hold = $result['usuarios_tag'];
          $holder = getLOL($hold);
        }else{
          $holder = $result['usuarios_rango'];
        }
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$holder."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }

  }
  public function reportLigaSecond($liga){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga = '".$liga."' ");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($liga == "League of legends") {
          $hold = $result['usuarios_tag'];
          $holder = getLOL($hold);
        }else{
          $holder = $result['usuarios_rango'];
        }
        $varReturn.=  "
        <tr>
        <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
        <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
        <td align='left' valign='top'>".$result['usuarios_liga']."</td>
        <td align='left' valign='top'>".$result['usuarios_tag']."</td>
        <td align='left' valign='top'>".$holder."</td>
        <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportLigaProgramaSecond($liga,$programa){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga = '".$liga."' AND usuarios_programa = '".$programa."'");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($liga == "League of legends") {
          $hold = $result['usuarios_tag'];
          $holder = getLOL($hold);
        }else{
          $holder = $result['usuarios_rango'];
        }
        $varReturn.=  "
        <tr>
        <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
        <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
        <td align='left' valign='top'>".$result['usuarios_liga']."</td>
        <td align='left' valign='top'>".$result['usuarios_tag']."</td>
        <td align='left' valign='top'>".$holder."</td>
        <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportCodigo($codigo){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga IS NOT NULL AND usuarios_codigo = '".$codigo."' ");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportLigaPrograma($liga,$programa){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga = '".$liga."' AND usuarios_programa = '".$programa."'");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportLigaCodigo($liga,$codigo){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga = '".$liga."' AND usuarios_codigo = '".$codigo."'");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportProgramaCodigo($programa,$codigo){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_programa = '".$programa."' AND usuarios_codigo = '".$codigo."'");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function reportLigaProgramaCodigo($liga,$programa,$codigo){
    try {
      $varReturn = "";
      $db = getDB();
      $sql = $db->query("SELECT * FROM esportsuac_usuarios WHERE usuarios_verificado <> 0 AND usuarios_liga = '".$liga."' AND usuarios_programa = '".$programa."' AND usuarios_codigo = '".$codigo."' ");
      while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $varReturn.=  "
        <tr>
          <td align='left' valign='top'>".$result['usuarios_nombre']."</td>
          <td align='left' valign='top'>".$result['usuarios_apellidos']."</td>
          <td align='left' valign='top'>".$result['usuarios_tipo_id']."</td>
          <td align='left' valign='top'>".$result['usuarios_identificacion']."</td>
          <td align='left' valign='top'>".$result['usuarios_codigo']."</td>
          <td align='left' valign='top'>".$result['usuarios_email']."</td>
          <td align='left' valign='top'>".$result['usuarios_liga']."</td>
          <td align='left' valign='top'>".$result['usuarios_tag']."</td>
          <td align='left' valign='top'>".$result['usuarios_programa']."</td>
        ";
      }
      return $varReturn;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function userType($email){
    try {
      $db = getDB();
      $sql = $db->query("SELECT usuarios_tipo FROM esportsuac_usuarios WHERE usuarios_email='".$email."'");
      $toCheck = $sql->fetch(PDO::FETCH_ASSOC);
      $tipoCheck = $toCheck['usuarios_tipo'];
      if ($tipoCheck == 'su') {
        return true;
      }else{
        return false;
      }
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function checkEmail($email){
    try {
      $db = getDB();
      $sql = $db->query("SELECT usuarios_nombre FROM esportsuac_usuarios WHERE usuarios_email='".$email."'");
      $toCheck = $sql->fetch(PDO::FETCH_ASSOC);
      return true;
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }

  public function getLigas(){
    try {

      $db = getDB();
      $sql = $db->prepare("SELECT liga_nombre FROM esportsuac_ligas ORDER BY liga_nombre");
      $sql->execute();
      $data = $sql->fetchAll();
      return $data;
    }  catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }
  public function getCorreos($liga){
    try {
      $db = getDB();
      $sql = $db->prepare("SELECT usuarios_email FROM esportsuac_usuarios WHERE usuarios_liga = '".$liga."'");
      $sql->execute();
      $data = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }  catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
  }

    public function inscripcionLiga($email, $liga, $tag, $programa){
      try {
        $db = getDB();
        $sql = $db->query("SELECT usuarios_liga FROM esportsuac_usuarios WHERE usuarios_email='".$email."'");
        $toCheck = $sql->fetch(PDO::FETCH_ASSOC);
        if ($toCheck['usuarios_liga'] != NULL || $toCheck['usuarios_liga'] != "") {
          $return = false;
        }else{
          $stmt = $db->prepare("UPDATE esportsuac_usuarios SET usuarios_liga=:liga, usuarios_tag=:tag, usuarios_programa=:programa WHERE usuarios_email='".$email."'");
          $stmt->bindParam("liga", $liga, PDO::PARAM_STR);
          $stmt->bindParam("tag", $tag, PDO::PARAM_STR);
          $stmt->bindParam("programa", $programa, PDO::PARAM_STR);
          $stmt->execute();
          return true;
        }
      }  catch (PDOException $e) {
          echo '{"error":{"text":' . $e->getMessage() . '}}';
      }
    }
    public function userLogin($email, $password)
    {
        try {
            $db = getDB();
            $stmt = $db->prepare("SELECT usuarios_id FROM esportsuac_usuarios WHERE (usuarios_email=:email AND usuarios_password=:password)");
            $password= sha1($password); //Password encryption
            $stmt->bindParam("email", $email, PDO::PARAM_STR);
            $stmt->bindParam("password", $password, PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            $data=$stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            if ($count == 1) {
                @$_SESSION['uid']=$data->uid; // Storing user session value
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function checkUser($email){
      try {
        $db = getDB();
        $stmt = $db->query("SELECT usuarios_verificado FROM esportsuac_usuarios WHERE usuarios_email='".$email."'");
        $toCheck = $stmt->fetch(PDO::FETCH_ASSOC);
        $var_check = $toCheck['usuarios_verificado'];
        if ($var_check == true || $var_check == 1 || $var_check == "1") {
          return true;
        }else{
          return false;
        }
      } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
      }

    }
    public function checkPassword($email, $password){
      try{
        $db = getDB();
        $password = sha1($password);
        $toCheck = $db->query("SELECT usuarios_password FROM esportsuac_usuarios WHERE usuarios_email = '".$email."'");
        $vartoCheck = $toCheck->fetch(PDO::FETCH_ASSOC);
        $actual_password = $vartoCheck['usuarios_password'];
        if (strcmp($password, $actual_password) ==0) {
          return true;
        }else{
          return false;
          }
        }catch (PDOException $e) {
          echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function sendEmail($email){
      try {
        $randon  = rand(100000,999999);
        //Server settings
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'testesportsuac@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'pentakill123';

        //Set who the message is to be sent from
        $mail->setFrom('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set an alternative reply-to address
        $mail->addReplyTo('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set who the message is to be sent to
        $mail->addAddress($email, 'John Doe');

        //Set the subject line
        $mail->Subject = 'Codigo de verificacion';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //Replace the plain text body with one created manually
        $mail->Body    = " Gracias por inscribirte a E-Sports UAC <br>
        Tu cuenta ha sido creada y solo falta que uses el siguiente codigo de verificacion. <br>
        Tu c&oacutedigo de seguridad es: ".$randon;
        $mail->AltBody = " Gracias por inscribirte a E-Sports UAC <br>
        Tu cuenta ha sido creada y solo falta que uses el siguiente codigo de verificacion. <br>
        Tu c&oacutedigo de seguridad es: ".$randon;
        $mail->send();


        //Attach an image file

        $db = getDB();
        $stmt = $db->prepare("UPDATE esportsuac_usuarios SET usuarios_code=:randon WHERE usuarios_email=:email ");
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt->bindParam("randon", $randon, PDO::PARAM_STR);
        $stmt->execute();
        return true;
        }catch (PDOException $e) {
          echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function sendEmailAttach($email,$topic,$body,$path){
      try {
        //Server settings
        $mail = new PHPMailer;
        $mail->addAttachment($path);
        $body = trim($body);

   $body = str_replace(
       array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
       array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
       $body
   );

   $body = str_replace(
       array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
       array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
       $body
   );

   $body = str_replace(
       array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
       array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
       $body
   );

   $body = str_replace(
       array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
       array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
       $body
   );

   $body = str_replace(
       array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
       array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
       $body
   );

   $body = str_replace(
       array('ñ', 'Ñ', 'ç', 'Ç'),
       array('n', 'N', 'c', 'C',),
       $body
   );
   $topic = trim($topic);

   $topic = str_replace(
       array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
       array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
       $topic
   );

   $topic = str_replace(
       array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
       array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
       $topic
   );

   $topic = str_replace(
       array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
       array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
       $topic
   );

   $topic = str_replace(
       array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
       array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
       $topic
   );

   $topic = str_replace(
       array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
       array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
       $topic
   );

   $topic = str_replace(
       array('ñ', 'Ñ', 'ç', 'Ç'),
       array('n', 'N', 'c', 'C',),
       $topic
   );

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'testesportsuac@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'pentakill123';

        //Set who the message is to be sent from
        $mail->setFrom('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set an alternative reply-to address
        $mail->addReplyTo('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set who the message is to be sent to
        $mail->addAddress($email, 'John Doe');

        //Set the subject line
        $mail->Subject = $topic;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //Replace the plain text body with one created manually
        $mail->Body    = $body;
        $mail->AltBody = $body;
        $mail->send();
        return true;
        }catch (PDOException $e) {
          echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function sendEmailNone($email,$topic,$body){
      try {
        //Server settings
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        $body = trim($body);

   $body = str_replace(
       array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
       array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
       $body
   );

   $body = str_replace(
       array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
       array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
       $body
   );

   $body = str_replace(
       array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
       array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
       $body
   );

   $body = str_replace(
       array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
       array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
       $body
   );

   $body = str_replace(
       array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
       array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
       $body
   );

   $body = str_replace(
       array('ñ', 'Ñ', 'ç', 'Ç'),
       array('n', 'N', 'c', 'C',),
       $body
   );
   $topic = trim($topic);

   $topic = str_replace(
       array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
       array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
       $topic
   );

   $topic = str_replace(
       array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
       array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
       $topic
   );

   $topic = str_replace(
       array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
       array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
       $topic
   );

   $topic = str_replace(
       array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
       array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
       $topic
   );

   $topic = str_replace(
       array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
       array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
       $topic
   );

   $topic = str_replace(
       array('ñ', 'Ñ', 'ç', 'Ç'),
       array('n', 'N', 'c', 'C',),
       $topic
   );

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'testesportsuac@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'pentakill123';

        //Set who the message is to be sent from
        $mail->setFrom('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set an alternative reply-to address
        $mail->addReplyTo('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set who the message is to be sent to
        $mail->addAddress($email, 'John Doe');

        //Set the subject line
        $mail->Subject = $topic;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //Replace the plain text body with one created manually
        $mail->Body    = $body;
        $mail->AltBody = $body;
        $mail->send();


        //Attach an image file

        return true;
        }catch (PDOException $e) {
          echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function sendEmailRandomPassword($email,$random){
      try {
        //Server settings
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'testesportsuac@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'pentakill123';

        //Set who the message is to be sent from
        $mail->setFrom('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set an alternative reply-to address
        $mail->addReplyTo('no-reply@uacesports.com', 'Liga de deportes electronicos UAC E-Sports');

        //Set who the message is to be sent to
        $mail->addAddress($email, 'John Doe');

        //Set the subject line
        $mail->Subject = "Recuperar credenciales";

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //Replace the plain text body with one created manually
        $mail->Body    = "Se ha generado una nueva contrase&ntilde;a para tu cuenta: ".$email.". Tu nueva contrase&ntilde;a es: ".$random." Te recomendamos cambiar inmediatamente a una que puedas recordar con facilidad.";
        $mail->AltBody = "Se ha generado una nueva contrase&ntilde;a para tu cuenta: ".$email.". Tu nueva contrase&ntilde;a es: ".$random." Te recomendamos cambiar inmediatamente a una que puedas recordar con facilidad.";
        $mail->send();


        //Attach an image file

        return true;
        }catch (PDOException $e) {
          echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function validateCode($email, $code){
      try {
        $db = getDB();
        $stmt = $db->query("SELECT usuarios_code FROM esportsuac_usuarios WHERE usuarios_email = '".$email."'");
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        $toCheck = $stmt['usuarios_code'];
        $var_true = true;
        if ($code==$toCheck) {
          $stmt2 = $db->prepare("UPDATE esportsuac_usuarios SET usuarios_verificado= '".$var_true."' WHERE usuarios_email=:email");
          $stmt2->bindParam("email", $email, PDO::PARAM_STR);
          $stmt2->execute();
          return true;
        }else{
          return false;
        }
      }catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
      }
    }
    public function changePassword($email, $password)
    {
      try {
        $db = getDB();
        $password = sha1($password);
        $stmt = $db->prepare("UPDATE esportsuac_usuarios SET usuarios_password=:password WHERE usuarios_email=:email");
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
      }
    }

    public function selectNombre($email){
      try {
          $db = getDB();
          $stmtname = $db->query("SELECT usuarios_nombre FROM esportsuac_usuarios WHERE usuarios_email = '".$email."'");
          $stmtapellido = $db->query("SELECT usuarios_apellidos FROM esportsuac_usuarios WHERE usuarios_email = '".$email."'");
        /*  $stmtname->bindParam("email", $email, PDO::PARAM_STR);
          $stmtapellido->bindParam("email", $email, PDO::PARAM_STR);*/
          $nombre= $stmtname->fetch(PDO::FETCH_ASSOC);
          $apellido = $stmtapellido->fetch(PDO::FETCH_ASSOC);
          return $nombre['usuarios_nombre']." ".$apellido['usuarios_apellidos'];
      } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
      }

    }

    /* User Registration */
    public function userRegistration($name, $apellido, $tipo_id, $id, $email, $password, $codigo)
    {
        try {
            $db = getDB();
            $st = $db->prepare("SELECT usuarios_id FROM esportsuac_usuarios WHERE usuarios_email=:email");
            $st->bindParam("email", $email, PDO::PARAM_STR);
            $st->execute();
            $var_check = false;
            $count=$st->rowCount();
            if ($count<1) {
                $stmt = $db->prepare("INSERT INTO esportsuac_usuarios(usuarios_nombre,usuarios_apellidos,usuarios_tipo_id,usuarios_identificacion,usuarios_email,usuarios_password, usuarios_verificado, usuarios_codigo)
VALUES (:name,:apellido,:tipo_id,:id,:email,:hash_password,'".$var_check."',:codigo)");
                $stmt->bindParam("name", $name, PDO::PARAM_STR);
                $hash_password= sha1($password); //Password encryption
                $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
                $stmt->bindParam("apellido", $apellido, PDO::PARAM_STR);
                $stmt->bindParam("tipo_id", $tipo_id, PDO::PARAM_STR);
                $stmt->bindParam("id", $id, PDO::PARAM_STR);
                $stmt->bindParam("email", $email, PDO::PARAM_STR);
                  $stmt->bindParam("codigo", $codigo, PDO::PARAM_STR);
                $stmt->execute();
                $uid=$db->lastInsertId(); // Last inserted row id
                $db = null;
                $_SESSION['uid']=$uid;
                return true;
            } else {
                $db = null;
                return false;
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    /* User Details */
}
