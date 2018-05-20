<?php
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /');
}

require 'database.php';
require 'partials/header.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $query = $connection->prepare('SELECT id, email, password FROM users where email = :email');
  $query->bindParam(':email', $_POST['email']);
  $query->execute();
  $results = $query->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {

    $_SESSION['user_id'] = $results['id'];
    header('Location: /');

  } else {
    $message = "Las credenciales no coinciden";
  }
}

?>

    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-6 align-self-center">

          <?php if(!empty($message)): ?>
              <div class="alert alert-primary" role="alert">
                <?php echo $message; ?>
              </div>
          <?php endif; ?>

          <div class="card border-info">
            <div class="card-header text-white bg-info">
              Iniciar sesión
            </div>
            <div class="card-body">
              <form action="login.php" method="POST">
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Escriba su correo">
                </div>
                <div class="form-group">
                  <label for="passwd">Contrasela</label>
                  <input type="password" name="password" class="form-control" id="passwd" placeholder="Ingresa tu contraseña">
                </div>
                <div class="form-group form-check">
                  ¿No tienes una cuenta? <a href="signup.php">Registrase</a>
                </div>
                <button type="submit" class="btn btn-info float-right">Entrar</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

<?php require 'partials/footer.php'; ?>