<?php
require "class" . DIRECTORY_SEPARATOR . "Message.php";
require "class" . DIRECTORY_SEPARATOR . "GuestBook.php";
require "elements" . DIRECTORY_SEPARATOR . "header.php";
require_once "class" . DIRECTORY_SEPARATOR . "Form.php";

$username="";
$messageText="";
$noError=false;
$register = new GuestBook("data" . DIRECTORY_SEPARATOR . "test.txt");
$messages=$register->getMessage();
if(!empty($_POST["username"]))
{
    $username=$_POST['username'];
    $messageText=$_POST["message"];
    $message = new Message($username,$messageText);
    $noError=$message->isvalid();
    if ($noError) {
        $username="";
        $messageText="";
        $register->addMessage($message);
    }
    else
    {
       $errors=$message->getErrors();
    }
    $_POST=[];
}

?>
<h1 class="h1">Livre d'or</h1>
<?php if($noError){?><div class="alert alert-success">Le message a été posté</div><?php }?>
<form action="livreOr.php" method="POST">
    <div class="form-group">
        <input class="form-control" type="text" name="username" placeholder="Veuillez mettre votre nom" value="<?=$username?>">
        <?php if((!$noError)&&(!empty($errors["Username"]))){?><div class="alert alert-danger">Veuillez rentrer un nom plus long</div><?php }?>

    </div>
    <div class="form-group">
        <input class="form-control" type="textarea" name="message" placeholder="Veuillez mettre votre message" value="<?=$messageText?>">
        <?php if((!$noError)&&(!empty($errors["Message"]))){?><div class="alert alert-danger">Veuillez rentrer un message plus long</div><?php }?>

    </div>
    <button class="btn btn-primary" type="submit">Enregistrer le message</button>
</form>
<div>
    <h2>Ancien Messages</h2>
<?php if(sizeof($messages)>0)
    {
        foreach ($messages as $pastMessage)
        {
            echo $pastMessage->toHTML();
        }
    }
?>
</div>
<?php
require_once "elements".DIRECTORY_SEPARATOR."footer.php";
?>
