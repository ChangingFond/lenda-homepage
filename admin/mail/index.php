<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

// header('Access-Control-Allow-Origin:*');//注意！跨域要加这个头 上面那个没有
//
// $data = $GLOBALS['HTTP_RAW_POST_DATA'];
// $data = json_decode($data, true);  // array
// exit(var_dump($data));
$data["name"] = $_POST["name"];
$data["email"] = $_POST["email"];
$data["message"] = $_POST["message"];

$mail = new PHPMailer(true);                            // Passing `true` enables exceptions
try {
  //Server settings
  $mail->SMTPDebug = 0;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.qq.com';                          // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = '782773117@qq.com';               // SMTP username
  $mail->Password = 'xusdevbfmbhrbfja';                    // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('782773117@qq.com', 'Lenda-Contact');
  $mail->addAddress('fcj2113@163.com', 'Lenda-CEO');     // Add a recipient
  // $mail->addAddress('mail@fangchengjin.cn');              // Name is optional
  // $mail->addReplyTo('info@example.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  //Attachments
  // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

  //Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'LENDA官网Contact回复';
  $mail->Body    = '客户姓名：'. $data["name"] .'<br>客户邮箱：'. $data["email"] .'<br>客户留言：'. $data["message"];

  // $mail->send();
  echo json_encode(['status' => 1]);
} catch (Exception $e) {
  echo json_encode(['status' => 0, 'message' => 'Message could not be sent.' . $mail->ErrorInfo]);
}
