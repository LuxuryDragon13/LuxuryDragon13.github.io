<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validar datos (implementa validaciones adicionales según tus necesidades)

    // Conectar a la base de datos
    $db = new SQLite3('db/index.db3');

    // Consulta para buscar el usuario en la base de datos
    $query = $db->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
    $query->bindValue(':username', $username, SQLITE3_TEXT);
    $query->bindValue(':password', md5($password), SQLITE3_TEXT); // Se recomienda usar algoritmos de hash seguros, no md5
    $result = $query->execute();

    // Verificar si se encontró el usuario
    if ($row = $result->fetchArray()) {
        // Inicio de sesión exitoso
        $_SESSION["username"] = $username;
        header("Location: dashboard.php"); // Redirigir a la página de inicio después del inicio de sesión
        exit();
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }

    // Cerrar la conexión a la base de datos
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <script src="js/index.js"></script>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Login -|- integrante H4CK3R2</title>
</head>
<body>

<div class="textbox">
      <h1 class="luxury" style="font-size: 30px;">H4CK3R2</h1>
    </div>
   <p>solo integrantes de H4CK3R2</p>

    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form">
        <input type="text" name="name" id="username" value="" autocomplete="on" required />
        <label for="name" class="label-name">
          <span class="content-name">Username</span>
        </label>
      </div>
      <div class="form">
        <input type="password" name="name" id="password" value="" autocomplete="on" required />
        <label for="name" class="label-name">
          <span class="content-name">Password</span>
        </label>
      </div>
      <div class="form">
        <input type="password" name="name" id="confirm" value="" autocomplete="on" required />
        <label for="name" class="label-name">
          <span class="content-name">Confirm password</span>
        </label>
      </div>
      <input type="submit" name="submit" id="submit" value="Submit" />
    </form>

    <script src="js/main.js"></script>
  <p>No cualquiera va a tener una cuenta a este acceso pero si quiere una cuenta a este acceso</p>

</body>
</html>