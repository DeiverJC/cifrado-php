<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /');
}

require 'database.php';
require 'encrypt.php';
require 'partials/header.php';

$message = '';

if ( !empty( $_POST['email']) && !empty($_POST['password']) ) {

  $query = "INSERT INTO users (email, encryption, password ) VALUES (:email, :encryption, :password)";
  $statement = $connection->prepare($query);
  $statement->bindParam(':email', $_POST['email']);
  $statement->bindParam(':encryption', $_POST['encrypt']);

  switch ($_POST['encrypt']) {
    case 'HASH':
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        break;
    case 'SHA-1':
        $password = encryptSha1($_POST['password']);
        break;
    case 'MD5':
        $password = encryptMd5($_POST['password']);
        break;
    case 'SALT':
        $password = encryptSalt($_POST['password']);
        break;
  }

  $statement->bindParam(':password', $password);

  if ($statement->execute()) {
    $message = 'Nuevo usuario creado correctamente.';
    header('location: login.php');
  } else {
    $message = 'Lo sentimos, el usuario no pudo ser creado.';
  }
}
?>

    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-6 align-self-center">

          <?php if(!empty($message)){ ?>
              <div class="alert alert-primary" role="alert">
                <?php echo $message; ?>
                <a href="login.php">Iniciar sesión</a>
              </div>
          <?php } ?>

          <div class="card border-info">
            <div class="card-header text-white bg-info">
              Registrarse
            </div>
            <div class="card-body">
              <form action="signup.php" method="POST">
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Escriba su correo">
                </div>
                <div class="form-group">
                  <label for="encrypt">Tipo de encriptacion</label>
                  <select class="form-control" id="encrypt" name="encrypt">
                    <option value="HASH">Seleccione una opción</option>
                    <option value="HASH">HASH</option>
                    <option value="SHA-1">SHA-1</option>
                    <option value="MD5">MD5</option>
                    <option value="SALT">SALT</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="passwd">Contrasela</label>
                  <input type="password" name="password" class="form-control" id="passwd" placeholder="Ingresa su contraseña">
                </div>
                <div class="form-group">
                  <label for="passwd">Confirmar contrasela</label>
                  <input type="password" name="re-password" class="form-control" id="passwd" placeholder="Repetir contraseña">
                </div>
                <div class="form-group form-check">
                  ¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a>
                </div>
                <button type="submit" class="btn btn-info float-right">Entrar</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

<?php require 'partials/footer.php'; ?>