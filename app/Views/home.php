<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Administración de Usuarios</title>
    <!-- Enlace a la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Enlace a la hoja de estilo de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('home'); ?>"><b>DustBusters</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Agregar otros ítems de navegación aquí si es necesario -->
            </ul>
        </div>
        <!-- Botón de cerrar sesión -->
        <a class="btn btn-danger" href="<?= base_url('logout'); ?>">Cerrar sesión</a>
    </div>
   
</nav>
<div class="row">
    <div class="col-md-7">

    </div>
    <div class="col-md-5">
        <!-- Alerta de error -->
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
                <?= session('error') ?>
                
            </div>
            <script>
                setTimeout(function() {
                    $(".alert-danger").alert('close');
                }, 5000); // Cierra la alerta después de 5 segundos (5000 ms)
            </script>
        <?php endif; ?>

        <!-- Alerta de éxito -->
        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
                <?= session('success') ?>
                
            </div>
            <script>
                setTimeout(function() {
                    $(".alert-success").alert('close');
                }, 5000); // Cierra la alerta después de 5 segundos (5000 ms)
            </script>
        <?php endif; ?>
        
    </div>
</div>




<div class="container my-5">
    <h2>Lista de Limpiadores </h2>
    <table class="table text-center" id="usuarios">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Número de Teléfono</th>
            <th>Correo</th>
            <th>Ver detalles</th>
            
            
        </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($Usuarios as $usuario) { 
            if($usuario->tipoUsuario == 2){
                if(!$usuario->enabled){
            
                    ?>
                    <tr>
                        <td><?= $usuario->userId ?></td>
                        <td><?= $usuario->nombreCompleto ?></td>
                        <td><?= $usuario->numeroTelefono ?></td>
                        <td><?= $usuario->correo ?></td>
                        <td> <a href="<?= base_url('detalle/'.$usuario->userId) ?>"><button type="button" class="btn btn-primary btn-sm">Ver</button> </a></td>
                        
                    </tr>
                    <?php 
                }
            }
        } 
        ?>
        </tbody>
    </table>
</div>

<!-- Enlace al script de Bootstrap (jQuery y Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Enlace al script de DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<!-- Script para inicializar DataTables -->
<script>
    $(document).ready( function () {
        $('#usuarios').DataTable();
    } );
</script>
</body>
</html>
