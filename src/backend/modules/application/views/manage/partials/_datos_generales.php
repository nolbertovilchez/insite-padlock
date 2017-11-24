<form class="form-horizontal mrg-top-20" id="form-update-application">
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Nombre</label>
        <div class="col-md-9">
            <input type="hidden" class="form-control width-50" name="id" value="<?= $data['ID_APP'] ?>">
            <input type="text" class="form-control width-50" name="nombre" placeholder="Nombre de Aplicación" value="<?= $data['NAME_APP'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Secret App</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="secret_app" readonly="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Key App</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="key_app" readonly="true">
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-success btn-sm" type="submit">Actualizar</button>
    </div>
</form>