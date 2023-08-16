<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión - Empresa de Limpieza</title>
  <!-- Enlaces a las hojas de estilo de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
   
    <div class="col-md-6">
      <div class="card m-5 p-5 shadow w-100">
        <div class="card-body">
          <h3 class="card-title text-center">Iniciar sesión</h3>

            <!-- Mostrar mensaje de error si existe -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
          <form action="<?= base_url('usuarios') ?>" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Correo</label>
              <input type="email" class="form-control" id="username" name="correo" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Enlaces a los scripts de Bootstrap (jQuery y Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
