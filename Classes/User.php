<?php 
class User {
private $name;
private $email;
private $password;
protected $options;


/**
 * Get the value of username
 */ 
public function getName()
{
return $this->name;
}

/**
 * Set the value of username
 *
 * @return  self
 */ 
public function setName($name)
{
$this->name = $name;

return $this;
}

/**
 * Get the value of email
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @return  self
 */ 
public function setEmail($email)
{

//if (stripos($this->email, '@student.thomasmore.be') !== false || stripos($this->email, '@thomasmore.be')!== false) {
    //Als het email adres bestaat ui thomasmore.be dan kan er verder gedaan worden

    //echo "Hallo ik ben er";
    $this->email = $email;
    return $this;


//}
//else {
   /// echo "Email adres is niet juist";
//}

}

/**
 * Get the value of password
 */ 
public function getPassword()
{
return $this->password;
}

/**
 * Set the value of password
 *
 * @return  self
 */ 
public function setPassword($password)
{

$options  = ['cost' => 12,];
$password = password_hash($password, PASSWORD_DEFAULT, $options);
$this->password = $password;

return $this;
}



//Account aanmaken
public function SignUp() {

    //Connectie met de databank
    
    $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
    
    
    //Als email thomas more in heeft dan wordt er gekeken, dan wordt getEmail aangeroepen
    
    $email = $this->getEmail();
    $password = $this->getPassword();
    $name =$this->getName();
    
        $query = $conn->prepare("select * from user where email = :email");
        $query->bindValue(":email", $email);
        $query->execute();
        $result = $query->rowCount();
    
        if ($result > 0) {
            throw new Exception("Dit e-mail adres bestaat al");
        }
        else {
            
            $statement = $conn->prepare("insert into user ( email, name, password) VALUES ( :email, :name, :password);");
            $statement->bindValue(":name",$name);
            $statement->bindValue(":password",$password);
            $statement->bindValue(":email",$email);
        
            $result = $statement->execute();
        
            return $result;
        
        }
}
public static function login($email, $password, $name){
    //Connectie met de databank
    $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
    //query
    $statement = $conn->prepare("select * from user where email = :email");
    $statement->bindValue(":email", $email);
    $statement->execute();
    //user connecteren met username
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if(!$user){
        throw new Exception('Deze gebruiker bestaat niet.');
    }
    //var_dump($user);

    //wachtwoord verifiëren
    $hash = $user["password"];
    if(password_verify($password, $hash)){
        // login
        echo "oke";
        session_start();
        //$name = $this->getName();

        //$name = $this->getName();
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["name"] = $name;

        
        //$_SESSION["name"] = $name;
       //$_SESSION["name"] = $_POST['name'];
      
        //doorsturen naar index.php (empty state)
        header("Location: profile.php");
    }
    else{
        echo "niet oke";
        throw new Exception('Gebruikersnaam en wachtwoord komen niet overeen.');
    }

}
//Resetcode aanvragen en naar mail versturen
public static function requestResetCode($email){
    
    try {
        //connectie met databank
        $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
        //query maken
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $resetCode = $user['verificationcode'];
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }


    function smtpmailer($to, $from, $from_name, $subject, $body, $smtpServer, $smtpUsername, $smtpPassword, $smtpPort){
        date_default_timezone_set('Europe/Brussels');

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        //$mail->Debugoutput = 'html';
        $mail->Host = $smtpServer;
        $mail->Port = $smtpPort;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->setFrom($from, $from_name);
        $mail->addReplyTo($from, $from_name);
        $mail->addAddress($to, 'Beste student');
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->Body .= "\nAls je deze email niet aanvraagde, contacteer ons dan zo snel mogelijk!";
        //$mail->msgHTML(file_get_contents('librariess\phpmail\mail.php'), dirname(__FILE__));

        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

    try {
        $characters = '012345678901234567890123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&$@';
        $requestCode = '';

        for ($i = 0; $i < 8; $i++) {
            $nextSymbol = rand(0, strlen($characters) - 1);
            $requestCode .= $characters[$nextSymbol];
        }
            echo $requestCode;

            $from = 'info@duckstyle.be';
            $smtpServer = 'webreus.email';
            $smtpUsername = 'info@duckstyle.be';
            $smtpPassword = 'd3!nqd!djz8';
            $smtpPort = '25025';
            $name = 'WhiteStreams';
            $subj = 'WhiteStreams resetcode';
            $body = "Kopieer deze code en plak het in het formulier: " . $requestCode;
            $sendMail = smtpmailer($email, $from, $name, $subj, $body, $smtpServer, $smtpUsername, $smtpPassword, $smtpPort);
            echo $sendMail;

            $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
            $statement = $conn->prepare("UPDATE user SET verificationcode = :verificationcode WHERE email = :email");
            $statement->bindValue(":email", $email);
            $statement->bindValue(":verificationcode", $requestCode);
            $statement->execute();
            header("Location: forgotPassword.php");
    }
    catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }
}
public static function resetPassword($email, $recievedCode){
    try {
        //connectie met databank
        $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
        //query maken
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $resetCode = $user['verificationcode'];

        if ($recievedCode == $resetCode) {
            return true;
        } else {
            return false;
        }
    } catch (Throwable $e) {
        echo $e->getMessage();
        return false;
    }
}
public static function resetUserPassword($email, $newpassword){
        $clearverificationcode = NULL;
        $conn = new PDO('mysql:host=localhost:8889;dbname=whitestreams', "root", "root");
        $statement = $conn->prepare("UPDATE user SET password = :password, verificationcode = :clearverificationcode WHERE email = :email");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $newpassword);
        $statement->bindValue(":clearverificationcode", $clearverificationcode);
        $statement->execute();
        header("Location: ./index.php");
}

}