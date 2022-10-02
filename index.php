<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FM10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="app.js"></script>
</head>

<body>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3>FORMATO FM10 (INFORME DE ACTIVIDADES DEL CLV / RLV)</h3>
                <hr>
                <form id="form" method="POST" role="form">
                    <div class="row mb-3">
                        <label for="busca" class="form-label">Ingrese su DNI</label>
                        <input type="text" class="form-control" name="Codigo" id="busca" maxlength="8" required>
                    </div>              

                    <button type="submit" class="btn btn-primary mb-4">Buscar</button>    

                </form>

                <?php
                    if($_POST){
                        require('conexion.php');
                        $con = Conectar();
                        $id = $_POST['Codigo'];
                        $SQL = 'SELECT DNI, apellido_patl, apellido_mat, nombre, id_local, nombre_local, provincia, distrito, ccpp, cd_ccp, cd_DNI FROM personal_erm_puno WHERE DNI = :doc';
                        $stmt = $con->prepare($SQL);
                        $result = $stmt->execute(array(':doc'=>$id));
                        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
                        if(count($rows)){
                            foreach ($rows AS $row){
                            ?>
                            <hr>
                            <form id="completador">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="proceso" class="form-label">Proceso Electoral</label>
                                        <input type="text" class="form-control" id="proceso" value="ELECCIONES REGIONALES Y MUNICIPALES" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="DNI" class="form-label">Documento Nacional de Identidad</label>
                                        <input type="text" class="form-control" id="DNI" value="<?php echo $row->DNI; ?>" disabled>
                                    </div>
                                </div> 

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombre" value="<?php echo $row->nombre; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="apellido" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="apellido" value="<?php echo $row->apellido_patl ." ". $row->apellido_mat; ?>" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label for="nombre_cd" class="form-label">Coordinador Distrital (CD)</label>
                                        <input type="text" class="form-control" id="nombre_cd" value="<?php echo $row->cd_ccp; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cd_DNI" class="form-label">DNI del CD </label>
                                        <input type="text" class="form-control" id="cd_DNI" value="<?php echo $row->cd_DNI; ?>" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="idlocal" class="form-label">Codigo de Local</label>
                                        <input type="text" class="form-control" id="idlocal" value="<?php echo $row->id_local; ?>" disabled>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="direccion" class="form-label">Nombre de local</label>
                                        <input type="text" class="form-control" id="direccion" value="<?php echo $row->nombre_local; ?>" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="provincia" class="form-label">Provincia</label>
                                        <input type="text" class="form-control" id="provincia" value="<?php echo $row->provincia; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="distrito" class="form-label">Distrito</label>
                                        <input type="text" class="form-control" id="distrito" value="<?php echo $row->distrito; ?>" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ccpp" class="form-label">CCPP</label>
                                        <input type="text" class="form-control" id="ccpp" value="<?php echo $row->ccpp; ?>" disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="" class="form-label">¿Recibió habilitación por parte de la ODPE?</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="habilitacion" class="form-check-input"
                                                    id="habilitacion-si" value="1">
                                                <label for="habilitacion-si" class="form-check-label">Si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="habilitacion" class="form-check-input"
                                                    id="habilitacion-no" value="0" checked>
                                                <label for="habilitacion-no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="" class="form-label">¿Presentó la rendición por la habilitación?</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="rendicion" class="form-check-input"
                                                    id="rendicion-si" value="1">
                                                <label for="rendicion-si" class="form-check-label">Si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="rendicion" class="form-check-input"
                                                    id="rendicion-no" value="0" checked>
                                                <label for="rendicion-no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h5>ENTREGA DE CREDENCIALES Y DIFUSIÓN DEL PROCESO ELECTORAL</h5>
                                <div class="mb-3">
                                    <label for="dif_entrega" class="form-label">Dificultades en la entrega de credenciales a los MM</label>
                                    <textarea class="form-control" id="dif_entrega" rows="3" maxlength="110"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="re_entrega" class="form-label">Recomendaciones para la entrega de credenciales a los MM</label>
                                    <textarea class="form-control" id="re_entrega" rows="3" maxlength="90"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="dif_difision" class="form-label">Dificultades en la difusión del proceso</label>
                                    <textarea class="form-control" id="dif_difusion" rows="3" maxlength="110"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="re_difision" class="form-label">Recomendaciones para la difusión del proceso</label>
                                    <textarea class="form-control" id="re_difusion" rows="3" maxlength="90"></textarea>
                                </div>

                                <hr>
                                <h5>ACTIVIDADES EN EL LOCAL DE VOTACIÓN</h5>
                                <div class="mb-3">
                                    <label for="dif_aco" class="form-label">Dificultades en el acondicionamiento del local de votación</label>
                                    <textarea class="form-control" id="dif_aco" rows="3" maxlength="290"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="re_aco" class="form-label">Recomendaciones en el acondicionamiento del local de votación</label>
                                    <textarea class="form-control" id="re_aco" rows="3" maxlength="240"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="dif_jo" class="form-label">Dificultades durante la jornada electoral</label>
                                    <textarea class="form-control" id="dif_jo" rows="3"maxlength="290"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="re_jo" class="form-label">Recomendaciones para la jornada electoral</label>
                                    <textarea class="form-control" id="re_jo" rows="3" maxlength="240"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="dif_pos" class="form-label">Dificultades post jornada electoral</label>
                                    <textarea class="form-control" id="dif_pos" rows="3" maxlength="290"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="re_pos" class="form-label">Recomendaciones post jornada electoral</label>
                                    <textarea class="form-control" id="re_pos" rows="3" maxlength="240"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="dif_dev" class="form-label">Dificultades en la devolución del local de votación</label>
                                    <textarea class="form-control" id="dif_dev" rows="3" maxlength="190"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="re_dev" class="form-label">Recomendaciones en la devolución del local de votación</label>
                                    <textarea class="form-control" id="re_dev" rows="3" maxlength="180"></textarea>
                                </div>                                                    


                                <button type="submit" class="btn btn-primary mb-4">Generar PDF</button>
                            
                            </form>
                                
                            <?php
                            }
                        }else{
                            echo "NO ENCONTRADO: (El usuario no esta registrado como CLV o RLV)";
                        }

                    }
                ?>
            </div>
        </div>
    </div>   
</body>
</html>