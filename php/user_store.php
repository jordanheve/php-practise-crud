<?php

    require_once "main.php";

    // Store data

    $name = clean_string($_POST['name']);
    $lastName = clean_string($_POST['last-name']);
    $username = clean_string($_POST['username']);
    $email = clean_string($_POST['email']);
    $password = clean_string($_POST['password']);
    $passwordRepeat = clean_string($_POST['password_repeat']);

    if($name=='' || $lastName == '' || $username == '' || $email == '' || $password == '' || $passwordRepeat == '' ){
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, no se han llenado todos los campos obligatorios
      </div>
        ';
        exit();
    }
     
    if(check_data("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $name)){
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, el <strong>nombre</strong> no coincide con el formato solicitado
      </div>
        ';
        exit();
    }

    if(check_data("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $lastName)){
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, el <strong>apellido</strong> no coincide con el formato solicitado
      </div>
        ';
        exit();
    }

    if(check_data("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $username)){
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, el <strong>usuario</strong> no coincide con el formato solicitado
      </div>
        ';
        exit();
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $check_email = conection();
        $check_email=$check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
        if($check_email->rowCount()>0){
            echo '
            <div class="alert alert-danger" role="alert">
            Error inesperado, el <strong>correo</strong> ya se encuentra registrado, intenta con otro
          </div>
            ';
            exit();
        }
    }else{
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, el <strong>correo</strong> ingresado no es valido
      </div>
        ';
        exit();
    }
    $check_email=null;


    $check_username=conection();
    $check_username=$check_username->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$username'");
    if($check_username->rowCount()>0){
        echo '
            <div class="alert alert-danger" role="alert">
            Error inesperado, el <strong>nombre de usuario</strong> ya se encuentra registrado, intenta con otro
          </div>
            ';
            exit();
    }

    $check_username=null;

    if(check_data("[a-zA-Z0-9$@.-]{7,100}", $password)){
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, la <strong>contraseña</strong> no coincide con el formato solicitado
      </div>
        ';
        exit();
    }

    

    if($password != $passwordRepeat){
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, las <strong>contraseñas</strong> no coinciden
      </div>
        ';
        
        exit();
    }else{
        $password=password_hash($password, PASSWORD_BCRYPT, ["cost"=>10]);
    }

    //save user data

    $save_user=conection();
    $save_user=$save_user->prepare("INSERT INTO usuario(usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email) VALUES(:name, :lastName, :username, :password, :email)");
    
    $markers=[
        ':name'=>$name,
        ':lastName'=>$lastName,
        ':username'=>$username,
        ':password'=>$password,
        ':email'=>$email
    ];
    
    $save_user->execute($markers);
     
    if($save_user->rowCount()==1){
        echo '
        <div class="alert alert-success" role="alert">
        Registro realizado correctamente!
      </div>
        ';

    }else{
        echo '
        <div class="alert alert-danger" role="alert">
        Error inesperado, no se pudo registrar el usuario intente de nuevo
      </div>
        ';
    }

    $save_user=null;
?>