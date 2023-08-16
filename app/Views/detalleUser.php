<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Usuario</title>
    <!-- Enlace a la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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



<div class="container mt-5">
    <div class="card m-5 p-5 shadow">
        <div class="card-body">
            <h2 class="text-center">Detalle de Usuario</h2>
            <div class="row">
                <div class="col">
                    <h5 class="card-title"><?= $Usuario['Usuario']->nombreCompleto ?></h5>
                    <p class="card-text">Número de Teléfono: <?= $Usuario['Usuario']->numeroTelefono ?></p>
                    <p class="card-text">Correo: <?= $Usuario['Usuario']->correo ?></p>
                    <p class="card-text">Curp: <?= $Usuario['Usuario']->curp ?></p>
                    <p class="card-text">Tipo de Usuario: <?= $Usuario['Usuario']->tipoUsuario ?></p>
                    <p class="card-text">Fecha de Registro: <?= $Usuario['Usuario']->fechaRegistro ?></p>
                    <p class="card-text">Última Sesión: <?= $Usuario['Usuario']->ultimaSesion ?></p>
                    <h6 class="card-subtitle mb-2 text-muted">Authorities:</h6>
                    <ul>
                        <?php foreach ($Usuario['Usuario']->authorities as $authority) : ?>
                            <li><?= $authority->authority ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="card-text">UserId Openpay: <?= $Usuario['Usuario']->userIdOpenpay ?></p>
                </div>

                <div class="col">
                    <h6 class="mt-5 text-center">Documentos</h6>
                    <ul>
                        <?php foreach ($Usuario['Documentos'] as $documento) : ?>
                            <li>
                                <strong>Nombre del Documento:</strong> <?= $documento->nombreDoc ?><br>
                                <strong>URL del Documento:</strong> <a href="<?= $documento->urlDoc ?>" target="_blank"><?= $documento->urlDoc ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-8">

                </div>
                <div class="col-sm-4">
                    <?php //echo "<pre>".print_r($Usuario,true)."<pre>"; ?>
                    <form action="<?= base_url('aprobar') ?>" method="post">

                        <input type="hidden" name="idUser" value="<?php echo $Usuario['Usuario']->userId; ?>">
                        
                        <button type="submit" class="btn btn-success" >Aprobar limpiador </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enlace al script de Bootstrap (jQuery y Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<script>
    //onclick='aprobar(<?php /*json_encode($Usuario)*/ ?>)'
let aprobar = (usuario) => {
    usuario.Usuario.enabled=true;
    console.log(usuario.Usuario);
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", "Bearer <?= session('token'); ?>");
    myHeaders.append("Cookie", "ARRAffinity=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b; ARRAffinitySameSite=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b");

    var raw = usuario.Usuario;

    var requestOptions = {
    method: 'PUT',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
    };

    fetch("https://dustbusterapi.azurewebsites.net/api/usuarios/"+usuario.Usuario.userId, requestOptions)
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));

}

</script>
