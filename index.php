<?php
session_start();

require 'database.php';
require 'partials/header.php';

if (isset($_SESSION['user_id'])) {
  $query = $connection->prepare('SELECT * FROM users');
  // $query->bindParam(':id', $_SESSION['user_id']);
  $query->execute();
  // $results = $query->fetch(PDO::FETCH_ASSOC);
  $results = $query->fetchAll();

  $users = null;

  if (count($results) > 0) {
    $users = $results;
  }
}

?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center border-success">
                  <div class="card-header text-white bg-success">
                    Bienvenido
                  </div>

                <?php if(!empty($users)): ?>

                  <div class="card-body">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Correo electronico</th>
                          <th scope="col">Cifrado</th>
                          <th scope="col">Contraseña</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($users as $user): ?>
                        <tr class="<?= $user['id'] == $_SESSION['user_id'] ? 'table-success': '' ?>">
                          <th scope="row"><?= $user['id']?></th>
                          <td><?= $user['email']?></td>
                          <td><?= $user['encryption']?></td>
                          <td><?= $user['password']?></td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>

                <?php else: ?>

                  <div class="card-body">
                    <h5 class="card-title">Seguridad web - CIFRADO</h5>
                    <p class="card-text">Presentado por:</p>
                    <p class="font-weight-bold">Martha Meza</p>
                    <p class="font-weight-bold">Jesus David Serna Soto</p>
                    <p class="font-weight-bold">Deiver Ali Julio Contreras</p>
                    <p class="card-text">
                      Ejemplo de los diferentes tipos de cifrados utilizados para la seguridad web,
                      entre los cuales tenemos HASH, SHA-1, MD5, SALT, y uno MIXTO;
                      siendo HASH el más utilizado en la actualidad.
                    </p>
                    <a href="login.php" class="btn btn-success">Iniciar sesión</a>
                    <a href="signup.php" class="btn btn-info">Registrarse</a>
                  </div>

                <?php endif; ?>

                  <div class="card-footer text-muted">
                    <?php if(!empty($user)): ?>
                      <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                    <?php else: ?>
                      Ingeniería de Sistemas
                    <?php endif; ?>
                  </div>
                </div>
            </div>
        </div>
    </div>

<?php require 'partials/footer.php'; ?>