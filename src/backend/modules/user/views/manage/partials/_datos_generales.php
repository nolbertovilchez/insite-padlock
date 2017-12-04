<form class="form-horizontal mrg-top-20" id="form-update-user" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Código Personal</label>
        <div class="col-md-9">
            <input type="hidden" class="form-control width-50" name="type" value="general">
            <input type="hidden" class="form-control width-50" name="id_user" value="<?= $data['id_user'] ?>">
            <input type="text" class="form-control width-50" name="general[cod_per]" placeholder="Código Personal" value="<?= $data['cod_per'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Username</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="general[username]" placeholder="Username" value="<?= $data['username'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Password</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="general[password]" readonly="true" value="<?= $data['password'] ?>">
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-success btn-sm" type="submit">Actualizar</button>
    </div>
</form>