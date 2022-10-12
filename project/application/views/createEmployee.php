<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Editar empleado</title>
</head>
<body>
    <div class="container border p-2 rounded-bottom">
        <ol class="breadcrumb">
            <li><a href="<?=base_url("employee");?>">Principal</a></li>
            &nbsp;/&nbsp;
            <li class="active"><b>Nuevo registro</b></li>
        </ol>
        <?php echo form_open(base_url("createEmployee")); ?>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" value="" class="form-control" placeholder="Ingrese nombre" required>
            </div>
            <div class="form-group">
                <label>Edad</label>
                <input type="number" name="age" value="" class="form-control" placeholder="Ingrese edad" required>
            </div>
            <div class="form-group">
                <label>Sueldo Mensal</label>
                <input type="number" name="monthly_salary" value="" class="form-control" placeholder="Ingrese sueldo mensual" required>
            </div>
            <div class="form-group">
                <label>RFC</label>
                <input type="text" name="rfc" value="" class="form-control" placeholder="Ingrese RFC" required>
            </div>
            <div class="form-group">
                <label>Posición</label>
                <select name="position" required>
                    <option value="" id="opt_0">-- Seleccione una posición --</option>
                    <?php foreach($positions as $opt): ?>
                    <option id="opt_<?= $opt->id; ?>"value="<?= $opt->id ?>"><?= $opt->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <hr />
            <div class="text-right">
                <a href="<?=base_url("employee");?>" type="button" class="btn btn-default">Atrás</a>
                <?php echo form_submit("employee_submit","Guardar",["class"=>"btn btn-primary"]); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>