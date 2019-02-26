<?php

include("dbcon.php");



	function generateRandomString($length = 4) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}if (isset($_POST['submit'])){
	$fn=$_POST['fn'];
	$ln=$_POST['ln'];
	$L_id=$_POST['Location_id'];
	$gender=$_POST['SEX'];
	$address=$_POST['Location'];
	$email=$_POST['email'];
	$c_number=$_POST['c_number'];



$strr=generateRandomString();







	mysql_query("insert into reg_member (firstname,lastname,L_id,address,gender,email,c_number,date,uid)
	values('$fn','$ln','$L_id','$address','$gender','$email','$c_number',NOW(),'$strr')
	")or die(mysql_error());
	session_start();
	$_SESSION['strr']

	?>
	<script type="text/javascript">
	alert('you are sucessfully registered');

	alert('<?php echo $strr; ?>');
	//window.location="testmail.php";
	</script>

	<?php
	}
	?>
<?php

// example on using PHPMailer with GMAIL

include("class.phpmailer.php");
include("class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

$mail             = new PHPMailer();
//$fn=
//$ln=$_POST['ln']; 
$body = "hello you would start getting mail"." ".$_POST['fn'];
	//file_get_contents('contents.html');
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = "vnglraja1999@gmail.com";  // GMAIL username
$mail->Password   = "amma@@#$";            // GMAIL password

$mail->From       = "vnglraja1999@gmail.com";
$mail->FromName   = "Webmaster";
$mail->Subject    = "This is the subject";
$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddReplyTo("replyto@yourdomain.com","Webmaster");

//$mail->AddAttachment("/path/to/file.zip");             // attachment
//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

$mail->AddAddress($_POST['email'],"First Last");

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}

?>
<html>
<meta charset="UTF-8">
<?php  // PHP Yandex Translate API v1.5 - Working Example PHP Code - http://www.aw6.de/yandex/  11.02.18
$AW6_text = $_POST['fn'];
$AW6_from = 'en';
$AW6_to = $_POST['lang'];

    $AW6_translation = translate($AW6_text, $AW6_from, $AW6_to);

function translate($text, $from, $to)
{
    $api = 'trnsl.1.1.20190224T181835Z.a2ae44dfe68c4b04.b1d07057e47ce96b2ce318d7855ae3e15800a1c8'; // TODO: Get your key from https://tech.yandex.com/translate/
    $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $api . '&lang=' . $from . '-' . $to . '&text=' . urlencode($text));
    $json = json_decode($url);
    return $json->text[0];
}
// Yandex Translation API v1.5 End
echo $AW6_translation;
?>
</html>
<?php

//Your authentication key
$authKey = "205027ADCEgG1h5ab26812";

//Multiple mobiles numbers separated by comma
$mobileNumber = $_POST['c_number'];

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "RATION";

//Your message to send, Add URL encoding here.
$message = urlencode("hello");
$message = "hello". $AW6_translation." "."your unique id".$strr;
//Define route
$route = "4";
$unicode=1;
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route,
    'unicode'=> $unicode
);

//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

echo "You have sucessfully registered,you will sucessfully start getting notifications";
?>

