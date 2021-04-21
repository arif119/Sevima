        
<?php

function validateMail(&$errors, $field_list, $field_mail){

    $email = $field_list[$field_mail];
    $dbc = new PDO('mysql:host=localhost;dbname=instaapp','root','');		
	$query = $dbc->prepare("SELECT * FROM pengguna WHERE email = :email");
	$query->bindValue(':email', $_POST['Email']);
	$query->execute();
	if ($query->rowCount() > 0){
        $errors[$field_mail] = 'email telah digunakan';
    }
    else if (!isset($field_list[$field_mail]) || empty($field_list[$field_mail]))
        $errors[$field_mail] = 'wajib diisi';
    
    else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($email)))
        $errors[$field_mail] = 'alamat email tidak valid';
}

function validateName(&$errors, $field_list, $field_name)  {
    
    $pattern = "/^['a-zA-Z'\s]+$/"; // format surname (alfabet) 
   
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
    else if (!preg_match($pattern, $field_list[$field_name]))    
        $errors[$field_name] = 'hanya mengandung huruf alfabet';  }


function validatePw(&$errors, $field_list, $field_pw)  {
    //echo 'validate password '.$field_list[$field_pw].'<br>';
    $text = preg_match('@[a-z]@', $field_list[$field_pw]);
    $number = preg_match('@[0-9]@', $field_list[$field_pw]);
   
    if (!isset($field_list[$field_pw]) || empty($field_list[$field_pw]))    
        $errors[$field_pw] = 'wajib diisi';   
    
    else if (!$text || !$number)
        $errors[$field_pw] = 'wajib mengandung huruf dan angka'; 
    else if (strlen($field_list[$field_pw]) < 8)
        $errors[$field_number]= 'minimal 8 karakter';
    }

function validateCpw(&$errors, $pw, $cpw, $field_cpw)  {
   
    if (!isset($cpw) || empty($cpw))    
        $errors[$field_cpw] = 'wajib diisi';   
    
    else if ($pw != $cpw)
        $errors[$field_cpw] = 'password tidak sama';
      }

function validateEmpty(&$errors, $field_list, $field_name)  {
   
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
        }
function validateUsname(&$errors, $field_list, $field_name)  {

    $dbc2 = new PDO('mysql:host=localhost;dbname=instaapp','root','');		
	$query2 = $dbc2->prepare("SELECT * FROM pengguna WHERE username = :username");
	$query2->bindValue(':username', $_POST['Username']);
	$query2->execute();

	if ($query2->rowCount() > 0){
        $errors[$field_name] = ' username telah digunakan';
    }
    else if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
        }
#Untuk Edit
function UpUsname(&$errors, $field_list, $field_name)  {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
        }
function UpeMail(&$errors, $field_list, $field_mail){

    $email = $field_list[$field_mail];
    if (!isset($field_list[$field_mail]) || empty($field_list[$field_mail]))
        $errors[$field_mail] = 'wajib diisi';
    
    else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($email)))
        $errors[$field_mail] = 'alamat email tidak valid';
}

?>