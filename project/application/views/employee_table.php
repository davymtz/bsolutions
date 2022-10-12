<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#employees" role="tab">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#positions" role="tab">Puestos</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="employees" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div>
                            <a href="<?php echo base_url("create_employee"); ?>" class="btn btn-success pull-right">Nuevo empleado</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="employee_bsolution" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Sueldo mensual</th>
                                    <th>RFC</th>
                                    <th>Posición</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="positions" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div>
                            <a href="<?php echo base_url("create_position"); ?>" class="btn btn-success pull-right">Nuevo puesto</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="position_bsolution" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Table employees
            $("#employee_bsolution").DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url("getEmployees"); ?>", // Configurar base_url en config
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [0,1,2,3,4,5,6],
                    "orderable": false
                }]
            });
            // Table positions
            $("#position_bsolution").DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url("getPositions"); ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [0,1,2],
                    "orderable": false
                }]
            });
        });
        // Tabs
        $("#myTab li a").click(function(event){
            event.preventDefault();
            let id_panel = $(this).attr("href")
            console.log($(id_panel))
            // Tabs
            $(".nav-tabs li a").removeClass("active");
            $(this).addClass("active");
            // Panel
            $(".tab-content .tab-pane").removeClass("active");
            $(id_panel).addClass("active");
        });
    </script>
</body>
</html>