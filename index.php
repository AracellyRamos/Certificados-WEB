<?php
$consulta = false;
$matrizResultado = [];
if (isset($_POST['valor'])){
    $tipodocumento = $_POST['tipodocumento'];
    $valor = $_POST['valor'];
    $consulta = true;

    $con = mysqli_connect("localhost","root","","eventounsa");
    if ($con){
        if ($tipodocumento == "1"){
            $sql = "SELECT * FROM datosusuarios WHERE dni='$valor'";

            $result = $con->query($sql);

            while($registro = mysqli_fetch_array($result)){
                array_push($matrizResultado, $registro);
            }
        }else if ($tipodocumento == "2"){
            $sql = "SELECT * FROM datosusuarios WHERE correo='$valor'";

            $result = $con->query($sql);

            while($registro = mysqli_fetch_array($result)){
                array_push($matrizResultado, $registro);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Portal para poder descargar certificados de los eventos realizados en la FCCF" />
        <meta name="author" content="Stephany Aracelly Ramos Cary" />
        <title>Eventos UNSA</title>
        <link rel="icon" type="image/x-icon" href="assets/img/unsa.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

        <header class="masthead">
            <div class="container d-flex align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 mt-3 text-uppercase">
                        <img src="assets/img/unsa.png" alt="Logo" width="30%">
                    </h1>
                    <br>

                    <div class="row justify-content-center">
                        <div class="col-10 col-sm-8">
                            <div class="card py-4 h-100">
                                <div class="card-body text-center">

                                    <?php
                                    if ($consulta){
                                        if (sizeof($matrizResultado) < 1){
                                            ?>
                                            <h5>NO SE ENCUENTRAN DATOS REGISTRADOS</h5>
                                            <br>
                                            <a href="/" class="btn btn-primary js-scroll-trigger">
                                                Regresar
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Evento</th>
                                                    <th scope="col">Certificado</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                for ($i = 0; $i < sizeof($matrizResultado); $i++){
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo ($i + 1) ?></th>
                                                        <td><?php echo $matrizResultado[$i]['tipoevento'] ?></td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <a href="#" data-toggle="modal" data-target="#certificado<?php echo $matrizResultado[$i]['iddatosusuarios'] ?>">
                                                                Ver Certificado
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                            <a href="/" class="btn btn-primary js-scroll-trigger">
                                                Regresar
                                            </a>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        Verificación de Certificado
                                        <br>
                                        <small>
                                            Ingrese el dato con el cual se registro en el evento.
                                        </small>
                                        <form method="post" class="form mt-2">
                                            <select name="tipodocumento" id="tipodocumento" class="form-control">
                                                <option value="0">Seleccionar identificación</option>
                                                <option value="1">DNI</option>
                                                <option value="2">CORREO</option>
                                            </select>
                                            <br>
                                            <input type="text" class="form-control" name="valor" placeholder="Ingrese Datos">
                                            <div class="small text-black-50 mt-2">
                                                <button type="submit" class="btn btn-primary js-scroll-trigger">
                                                    CONSULTAR
                                                </button>
                                            </div>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="signup-section" id="signup">
                <div class="container-fluid">
                    <div class="row justify-content-between" style="background-color: #800000; color: white">
                        <div class="col-12 col-sm-6 text-left mt-3">
                            <h4>FACULTAD DE CIENCIAS CONTABLES Y FINANCIERAS</h4>
                        </div>
                        <div class="col-12 col-sm-4 text-right mt-2">
                            <small>Dirección: Av. Venezuela s/n - Pab. Area. Cs. Sociales</small>
                            <br>
                            <small>Correo: fccf@unsa.edu.pe</small>
                        </div>
                    </div>
                </div>
            </section>
        </header>

        <?php
        if ($consulta) {
            for ($i = 0; $i < sizeof($matrizResultado); $i++) {
                ?>
                <!-- Modal -->
                <div class="modal fade" id="certificado<?php echo $matrizResultado[$i]['iddatosusuarios'] ?>"
                     tabindex="-1"
                     aria-labelledby="certificado<?php echo $matrizResultado[$i]['iddatosusuarios'] ?>Label"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $matrizResultado[$i]['tipoevento'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="height: 100%">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <iframe  src="/certificados/<?php echo $matrizResultado[$i]['pdf'] ?>" width="100%" height="600px">

                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
