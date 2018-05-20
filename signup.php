<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /');
}

require 'database.php';
require 'partials/header.php';

$message = '';

if ( !empty( $_POST['email']) && !empty($_POST['password']) ) {

  $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
  $statement = $connection->prepare($query);
  $statement->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
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
                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
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