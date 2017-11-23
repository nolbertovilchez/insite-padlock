<div class="form-group row">
    <label for="form-1-1" class="col-md-3 control-label">Nombre</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="nombre" placeholder="Nombre de Aplicación" value="<?= $data['NAME_APP'] ?>">
    </div>
</div>
<div class="form-group row">
    <label for="form-1-1" class="col-md-3 control-label">Secret App</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="secret_app" readonly="true">
    </div>
</div>
<div class="form-group row">
    <label for="form-1-1" class="col-md-3 control-label">Key App</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="key_app" readonly="true">
    </div>
</div>
<div class="text-right">
    <button class="btn btn-success btn-sm" type="button">Actualizar</button>
</div>


