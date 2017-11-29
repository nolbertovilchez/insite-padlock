<form class="form-horizontal mrg-top-20" id="form-update-recovery" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Email</label>
        <div class="col-md-9">
            <input type="hidden" class="form-control width-50" name="type" value="recovery">
            <input type="hidden" class="form-control width-50" name="id_recovery" value="<?= $data['id_recovery'] ?>">
            <input type="text" class="form-control width-50" name="email" placeholder="Email" value="<?= $data['email'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Teléfono</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="number" placeholder="Teléfono" value="<?= $data['number'] ?>">
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-success btn-sm" type="submit">Actualizar</button>
    </div>
</form>