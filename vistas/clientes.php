<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['Clientes']==1)
{
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2 class="box-title">Clientes <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h2>
                </header>
                <div class="main-box-body clearfix" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>RFC</th>
                                    <th>Cliente</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Asignado a</th>
                                    <th>Referencias</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                    </div>
                </div>
                
                <div class="main-box-body clearfix" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                            <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>RFC</label>
                            <input type="hidden" name="idcliente" id="idcliente">
                            <input type="text" name="cedula" id="cedula" class="form-control" placeholder="RFC" maxlength="20" required>
                        </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" maxlength="50" required>
                        </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>Correo</label>
                            <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" maxlength="50" required>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>Direccion</label>
                          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion" maxlength="100" required>
                        </div>
                        </div> 
                        <div class="row">
                        <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" maxlength="15" required>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>Asignado a</label>
                          <select id="ContadorAsignado" name="ContadorAsignado" class="form-control selectpicker" required>
                            <option value="">Seleccionar usuario</option>
                            <option value="Kevin Luciano">Kevin Luciano</option>
                            <option value="Dario Campuzano">Dario Campuzano</option>
                            <option value="Humberto García">Humberto García</option>
                            </select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-5 col-sm-8 col-xs-12">
                            <label>Referencias</label>
                            <input type="text" name="referencia" id="referencia" class="form-control" placeholder="Referencias" maxlength="150" required>
                        </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button> 
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
        <script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>

