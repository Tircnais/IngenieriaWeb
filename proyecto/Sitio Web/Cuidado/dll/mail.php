<?php
    /*
    require "class.phpmailer.php";
    $mail = new PHPMailer();
    extract($_POST);
    $titulo = "Cuidado cercano - Duda";
    $de = $correo;
    $contenido = $mensaje;
    $telef = $telefono;
    $nomb = $nombre;
    $destinatario = "tircnais.ca@gmail.com, ceaguirre6@utpl.edu.ec";
    echo "Correo de:\t".$de."\r\nPara:\t".$destinatario."\nCorreo:\t".$mail;
    //Luego tenemos que iniciar la validación por SMTP:
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "localhost"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
    $mail->Username = "tircnais.ca@gmail.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente. 
    $mail->Password = "0986679688"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
    $mail->Port = 465; // Puerto de conexión al servidor de envio.
    $mail->From = $de; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
    $mail->FromName = $nomb; //A RELLENAR Nombre a mostrar del remitente. 
    $mail->AddAddress($de); // Esta es la dirección a donde enviamos 
    $mail->IsHTML(true); // El correo se envía como HTML 
    $mail->Subject = $titulo; // Este es el titulo del email. 
    $body .= $contenido;
    $mail->Body = $body; // Mensaje a enviar.
    $exito = $mail->Send(); // Envía el correo.
    if($exito){
        echo "<script>alert('El correo fue enviado correctamente.')</script>";
        echo "Mensaje no enviado";
    }else{
        echo "<script>alert('Mensaje no enviado')</script>";
        echo "Hubo un problema. Contacta a un administrador.";
    }
    */
    extract($_POST);
    $titulo = "Cuidado cercano - Duda";
    $de = $correo;
    $mail = $mensaje;
    $telef = $telefono;
    $nomb = $nombre;
    $destinatario = "tircnais.ca@gmail.com, ceaguirre6@utpl.edu.ec";
    echo "Correo de:\t".$de."\r\nPara:\t".$destinatario."\nCorreo:\t".$mail;
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //dirección del remitente 
    $headers .= "Para: Loja, Cuidado cercano < ".$de." >\r\n";
    $bool = mail($destinatario,$titulo,$mail,$headers);
    if($bool){
        echo "<script>alert('Mensaje enviado')</script>";
        echo "Mensaje enviado";
    }else{
        echo "<script>alert('Mensaje no enviado')</script>";
        echo "Mensaje no enviado";
    }
    $message = "Este es mi primer envío de email con PHP";
    $headers = "From: mi@cuentadeemail.com" . "\r\n" . "CC: destinatarioencopia@email.com";
    $enviado = mail($destinatario, $titulo, $message, $headers);
    if($enviado){
        echo "<script>alert('Mensaje enviado')</script>";
        echo "Mensaje enviado";
    }else{
        echo "<script>alert('Mensaje no enviado')</script>";
        echo "Mensaje no enviado";
    }
    
    /*
    //Configuracion de variables para enviar el correo
    $mail_username=$de;//Correo electronico saliente ejemplo: tucorreo@gmail.com
    $mail_userpassword=$destinatario;//Tu contraseña de gmail
    $mail_addAddress=$destinatario;//correo electronico que recibira el mensaje
    $template="contact.html";//Ruta de la plantilla HTML para enviar nuestro mensaje

    //Inicio captura de datos enviados por $_POST para enviar el correo
    $mail_setFromEmail=$_POST['customer_email'];
    $mail_setFromName=$_POST['customer_name'];
    $txt_message=$_POST['message'];
    $mail_subject=$_POST['subject'];
    sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje
    */    
?>
