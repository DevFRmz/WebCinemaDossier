<?php

require "../database.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_submit"])) {
  if (empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Please fill all the fields";
  } else if (!str_contains($_POST["email"], "@")) {
    $error = "email invalid";
  } else {
    //LIMITAMOS la consulta a 1 para que al hacer el fetch del usuario solo nos devuelva un array con un elemento y poder acceder a el directamente sin utilizar indice
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement->bindParam(":email", $_POST["email"]);
    $statement->execute();

    //si no hay ningun usuario con ese correo mandar error
    if ($statement->rowCount() == 0) {
      $error = "Invalid credentials";
    } else {
      //obtener datos del usuario en formato array asociativo
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      //verificamos si la contraseña que mando el usuario coincida con la de la base de datos
      if (!password_verify($_POST["password"], $user["password"])) {
        $error = "Invalid credentials";
      } else {
        //iniciamos una sesion
        session_start();
        //quitamos la contraseña del usuario en la sesion por seguridad ya que no la usaremos mas
        unset($user["password"]);
        //guardamos los datos del usuario en la sesion
        $_SESSION["user"] = $user;
        header("Location: ../index.php");
      }
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
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <main>
    <img src="../img/logo2.png" alt="logo">
    <div class="card">
      <div class="card2">
        <form class="form" method="POST" action="login.php">
          <p id="heading">Login</p>
          <?php if (!isset($_SESSION["user"])): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif ?>
          <div class="field">
            <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
              <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
            </svg>
            <input type="text" class="input-field" placeholder="Username" autocomplete="off" name="email" />
          </div>
          <div class="field">
            <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
              <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
            </svg>
            <input type="password" class="input-field" placeholder="Password" name="password"/>
          </div>
          <div class="btn">
          <button class="button1" name="login_submit">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </button>
          </div>
          <p class="log-sign">No tienes una cuenta? <a href="signup.php">Sing Up</a></p>
        </form>
      </div>
    </div>

  </main>
</body>

</html>