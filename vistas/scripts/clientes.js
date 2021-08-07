var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) 
    {
        guardaryeditar(e);
    });
    
    //Cargamos los items al select Cliente
	$.post("../ajax/prestamos.php?op=selectCliente", function(r){
	            $("#idcliente").append(r);
	            $('#idcliente').selectpicker('refresh');
	});
    
    //Cargamos los items al select Usuarios
    $.post("../ajax/prestamos.php?op=selectUsuarioKEVIN", function(r){
	            $("#usuario").append(r);
	            $('#usuario').selectpicker('refresh');
	});
}

//Funcion Limpiar
function limpiar() {
    $("#idcliente").val("");
    $("#cedula").val("");
    $("#nombre").val("");
    $("#correo").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#ContadorAsignado").val("");
    $("#referencia").val("");
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}


function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/clientes.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}


function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/clientes.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idcliente) {
    $.post("../ajax/clientes.php?op=mostrar", {
        idcliente: idcliente
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#cedula").val(data.cedula);
        $("#nombre").val(data.nombre);
        $("#correo").val(data.correo);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#idcliente").val(data.idcliente);
        $("#ContadorAsignado").val(data.ContadorAsignado);
        $("#referencia").val(data.referencia);

    })
}

//Función para desactivar registros
function desactivar(idcliente) {
    bootbox.confirm("¿Desea desactivar al cliente?", function (result) {
        if (result) {
            $.post("../ajax/clientes.php?op=desactivar", {
                idcliente: idcliente
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idcliente) {
    bootbox.confirm("¿Está Seguro de activar Cliente?", function (result) {
        if (result) {
            $.post("../ajax/clientes.php?op=activar", {
                idcliente: idcliente
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function eliminar(idcliente)
{
	bootbox.confirm("¿Está seguro de eliminar el cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/clientes.php?op=eliminar", {idcliente : idcliente}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();