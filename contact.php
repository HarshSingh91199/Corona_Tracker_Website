
 <?php
require_once 'dbConfig.php'; 
if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $name = strip_tags($name);
        $name = htmlspecialchars($name);

        $message = trim($_POST['message']);
        $message = strip_tags($message);
        $message = htmlspecialchars($message);

        $phone = trim($_POST['phone']);
        $phone = strip_tags($phone);
        $phone = htmlspecialchars($phone);
        
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

$sql="INSERT INTO contactus values ('$name','$email','$phone','$message')";
$result=mysqli_query($db,$sql);

  header("Location:Index.php"); 
}
?> 

<!DOCTYPE html>
<html>
<head>
<title></title>



<link rel="stylesheet" type="text/css" href="contact.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>

<div class="container contact-form">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            <form action="contact.php" method="post">
                <h3>Drop Us a Message</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" required="" />
                        </div>
                        <div class="form-group">
                            <input type="Email" name="email" class="form-control" placeholder="Your Email *" value=""  required="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Your Phone Number *" value="" required="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btnContact" value="Send Message" required="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Your Message *" required="" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>
</body>
</html>