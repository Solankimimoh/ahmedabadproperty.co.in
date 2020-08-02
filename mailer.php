<?php
$con = mysqli_connect("localhost", "ahmpropryusr", "Ahm@886611", "ahmedabadproperty") or die("Connection Error");
 
if (isset($_REQUEST['name']) || isset($_REQUEST['email']) || isset($_REQUEST['mobile']) || isset($_REQUEST['message'])) {
   
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['mobile'];
    $message = $_REQUEST['message'];

    
    $insertQuery = "INSERT INTO `inquiry`( `name`, `mobile`, `email`, `message`) VALUES ('$name','$mobile','$email','$message')";
    $numRow = mysqli_query($con, $insertQuery);
    
     if ($numRow > 0) {
            $from = "MIME-Version: 1.0" . "\r\n";
            $from .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $from .= 'From: ahmedabadproperty7@gmail.com' . "\r\n";
            $toemail = "ahmedabadproperty7@gmail.com";
            $subject="Ahmedabad Property Inquiry";
            $message1 = "<html><head> 
                <title>Welcome to Ahmedabad Property </title> 
            </head><body>
            <h1>Ahmedabad Property  </h1>
            <table border='1'>
            <tr><td>Name</td><td>$name</td></tr>
            <tr><td>Email</td><td>$email</td></tr>
            <tr><td>Mobile</td><td>$mobile</td></tr>
            <tr><td>Message</td><td>$message</td></tr></table>
            <a href='http://ahmedabadproperty.co.in/exportsheet.php' style='background-color: #c02f1d;
            padding: 13px;
            text-decoration: none;
            margin: 15px auto;
            color: #fff;
            box-shadow: 0 0 12px 0px #c9c9c9d6;
            display: inline-block;'>DOWNLOAD DATASHEET</a> 
            </body> 
            </html>";

            $result = mail($toemail, $subject, $message1, $from);
            if ($result) {
                    $form_data['success'] = true;
                    $form_data['msg'] = "Query Submitted";
            } else {
                    $form_data['error'] = false;
                    $form_data['msg'] = "Query Not Submitted.. Try Again..!!";            }
         
    }

   
    echo json_encode($form_data);

}else{
    $form_data['success'] = false;
    $form_data['msg'] = "All field Required";
    echo json_encode($form_data); 
}
?>
