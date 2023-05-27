<?php
    $firstname = $name = $email = $phone = $message ="";
    $firstnameError = $name = $email = $phone = $message ="";
    $nameError = $name = $email = $phone = $message ="";
    $emailError = $name = $email = $phone = $message ="";
    $phoneError = $name = $email = $phone = $message ="";
    $messageError = $name = $email = $phone = $message ="";
    $isSuccess = false;
    $emailTo = "jordanmoukam@yahoo.fr";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname = verifyInput($_POST['firstname']);
        $name = verifyInput($_POST['name']);
        $email = verifyInput($_POST['email']);
        $phone = verifyInput($_POST['phone']);
        $message = verifyInput($_POST['message']);
        $isSuccess = true;
        $emailText = "";

        if(empty($firstname))
        {
            $firstnameError = "Please enter your Firstname";
            $isSuccess = false;
        }
        else
        {
            $emailText .="Firstname: $firstname\n";
        }
        if(empty($name))
        {
            $nameError = "Please enter your name";
            $isSuccess = false;
        }
        else
        {
            $emailText .="Name: $name\n";
        }
        if(empty($email))
        {
            $emailError = "I need you to write your email";
            $isSuccess = false;
        }
        else
        {
            $emailText .="Email: $email\n";
        }
        if(empty($message))
        {
            $messageError = "Come on...tell me something";
            $isSuccess = false;
        }        
        else
        {
            $emailText .="Message: $message\n";
        }
        if($isSuccess)
        {
            // envoie d'email
            
            $headers = "From: $firstname $name <$email>\r\nReply-to: $email";
            mail($emailTo, "A message from your site", $emailText, $headers);
            $firstname = $name = $email = $phone = $message ="";
        }
    } 

    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/css?family=lato">
    <link href="fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
</head>
<body>
     <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2>Contact Me</h2>
        </div>

        <!-- Début du formulaire protégé -->
        <div class="row">
            <div class="col-lg10 col-lg-offset-1">
                <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="label" id="firstname" for="firstname">Firstname<span class="blue">*</span></label>
                            <input type="text" name="firstname"  class="form-control" placeholder="Your Firstname" value="<?php echo $firstname; ?>">
                            <p class="comments"><?php echo $firstnameError;?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="label" id="name" for="name">Name<span class="blue">*</span></label>
                            <input type="text" name="name"  class="form-control" placeholder="Your Name"value="<?php echo $name; ?>">
                            <p class="comments"><?php echo $nameError;?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="label" id="email" for="email">Email<span class="blue">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="Your email"value="<?php echo $email; ?>">
                            <p class="comments"><?php echo $emailError;?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="label" id="phone" for="phone">Phone Number</label>
                            <input type="tel" name="phone"  class="form-control" placeholder="phone"value="<?php echo $phone; ?>">
                            <p class="comments"><?php echo $phoneError;?></p>
                        </div>
                        <div class="col-md-12">
                            <label class="label" id="message" for="message">Message<span class="blue">*</span></label>
                            <textarea class="form-control"  placeholder="Write your message" name="message" id="message" cols="30" rows="10" ></textarea>
                            <p class="comments"><?php echo $messageError;?></p>
                        </div>
                        <div class="col-md-12">
                            <p class="blue">* Marque les champs obligatoires</p>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="button1" value="envoyer">
                        </div>
                    </div>
                    <p class="thank-you" style="display:<?php if($isSuccess) echo'block'; else echo 'none'; ?>">Thank you for your message. I will answer as quick as possible</p>
                </form>

                <!-- Fin du formulaire -->
            </div>
        </div>
     </div>
</body>
</html>