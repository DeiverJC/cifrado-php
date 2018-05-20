<?php
session_start();

require 'database.php';
require 'partials/header.php';

if (isset($_SESSION['user_id'])) {
  $query = $connection->prepare('SELECT id, email, password FROM users WHERE id = :id');
  $query->bindParam(':id', $_SESSION['user_id']);
  $query->execute();
  $results = $query->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}

?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center">
                  <div class="card-header">
                    Bienvenido
                  </div>

                <?php if(!empty($user)): ?>

                  <div class="card-body">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Correo electronico</th>
                          <th scope="col">Contraseña</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><?= $user['id']?></th>
                          <td><?= $user['email']?></td>
                          <td><?= $user['password']?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                <?php else: ?>

                  <div class="card-body">
                    <h5 class="card-title">Seguridad web</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, beatae?</p><br><br>
                    <a href="login.php" class="btn btn-primary">Iniciar sesión</a>
                    <a href="signup.php" class="btn btn-primary">Registrarse</a>
                  </div>

                <?php endif; ?>

                  <div class="card-footer text-muted">
                    <?php if(!empty($user)): ?>
                      <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                    <?php else: ?>
                      CUN 2018
                    <?php endif; ?>
                  </div>
                </div>
            </div>
        </div>
    </div>

<?php require 'partials/footer.php'; ?>