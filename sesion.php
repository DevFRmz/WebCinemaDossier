<?php

require "database.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_submit"])) {
  if(empty( $_POST["email"] ) || empty( $_POST["password"] )){
    $error = "Please fill all the fields";
  } else if (!str_contains($_POST["email"], "@")){
    $error = "email invalid";
  } else {
    //LIMITAMOS la consulta a 1 para que al hacer el fetch del usuario solo nos devuelva un array con un elemento y poder acceder a el directamente sin utilizar indice
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement->bindParam(":email", $_POST["email"]);
    $statement->execute();

    //si no hay ningun usuario con ese correo mandar error
    if($statement->rowCount() == 0) {
      $error = "Invalid credentials";
    } else {
      //obtener datos del usuario en formato array asociativo
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      //verificamos si la contraseña que mando el usuario coincida con la de la base de datos
      if( !password_verify( $_POST["password"], $user["password"] ) ) {
        $error = "Invalid credentials";
      } else {
        //iniciamos una sesion
        session_start();
        //quitamos la contraseña del usuario en la sesion por seguridad ya que no la usaremos mas
        unset($user["password"]);
        //guardamos los datos del usuario en la sesion
        $_SESSION["user"] = $user;
        header("Location: index.php");
      }
    }
  }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup_submit"])) {
  if(empty( $_POST["name"] || empty( $_POST["email"] ) || empty( $_POST["password"] ))){
    $error = "Please fill all the fields";
  } else if (!str_contains($_POST["email"], "@")){
    $error = "email invalid";
  } else {
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $statement->bindParam(":email", $_POST["email"]);
    $statement->execute();

    if($statement->rowCount() > 0) {
      $error = "email already exist";
    } else {
      $conn
        //LIMITAMOS la consulta a 1 para que al hacer el fetch del usuario solo nos devuelva un array con un elemento y poder acceder a el directamente sin utilizar indice
        ->prepare("INSERT INTO users (name, email, password) VALUES(:name, :email, :password) LIMIT 1")
        ->execute([
          ":name" => $_POST["name"],
          ":email" => $_POST["email"],
          ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
        ]);
        //volvemos a recuperar los datos con el nuevo usuario en la base de datos
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindParam(":email", $_POST["email"]);
        $statement->execute();
       //obtener datos del usuario en formato array asociativo
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //iniciamos una sesion
        session_start();

        //quitamos la contraseña del usuario en la sesion por seguridad ya que no la usaremos mas
        unset($user["password"]);
        //guardamos los datos del usuario en la sesion
        $_SESSION["user"] = $user;

        header("Location: index.php");
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Dossier</title>
   <link rel="stylesheet" href="css/normalize.css">
   <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main>
        <div class="wrapper">
            <div class="card-switch">
                <label class="switch">
                   <input type="checkbox" class="toggle">
                   <span class="slider"></span>
                   <span class="card-side"></span>
                   <div class="flip-card__inner">
                    
                      <?php require "./partials/login.php" ?>
                      <?php require "./partials/signup.php" ?>
                   </div>
                </label>
            </div>   
        </div>
    </main>
</body>
</html>