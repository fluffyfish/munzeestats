<html>
 <head>
  <title>Munzee User Info</title>

  <link rel="stylesheet" type="text/css" href="mystyle.css">
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />


 </head>
 <body>
<p>
Input a munzee player name to see their munzee number!
</p>
<FORM NAME ="form1" METHOD ="POST" ACTION = "munzeeuser.php">
<INPUT TYPE = "Text" VALUE ="coachV" NAME = "username">
<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Submit">

</FORM>



<?php

$username = $_POST['username'];
// echo $username;
$ch = curl_init("https://api.munzee.com/user");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: ' // Keys go here
     ));
curl_setopt($ch, CURLOPT_POST, 1);
// returning data rather than displaying it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = array(
    'data' => '{"username":"'.$username.'"}');
//      'data' => '{"username":"fluffyfish"}');
curl_setopt($ch, CURLOPT_POSTFIELDS,
            $data);

$jsoninfo = curl_exec($ch);
//$info = curl_getinfo($ch);
curl_close($ch);


//echo $jsoninfo;
//echo '<p></p>';
//echo $info;
//echo '<p></p>';
//echo '<br>';
//$results = var_dump(json_decode($jsoninfo,true));
$results = json_decode($jsoninfo,true);
//print_r(json_decode($jsoninfo,true));

//print_r($results);

if (!function_exists('json_last_error_msg')) {
    function json_last_error_msg() {
        static $errors = array(
            JSON_ERROR_NONE             => null,
            JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH   => 'Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR        => 'Unexpected control character found',
            JSON_ERROR_SYNTAX           => 'Syntax error, malformed JSON',
            JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );
        $error = json_last_error();
        return array_key_exists($error, $errors) ? $errors[$error] : "Unknown error ({$error})";
    }
}

//echo '<br>';
//echo '<br>';
//print_r($results['data']['username']);
//echo '<br>';
//echo '<br>';
?>

<table>
  <tr>
    <th>Player</th> 
    <th>Player ID</th>
  </tr>
  <tr>
    <td><?php print_r($results['data']['username']);?></td>      
    <td><?php print_r($results['data']['user_id']);?></td>
  </tr>
</table>
<br>

 </body>
</html>