<form class="form-horizontal mrg-top-20" id="form-update-application" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Nombre</label>
        <div class="col-md-9">
            <input type="hidden" class="form-control width-50" name="id" value="<?= $data['id_app'] ?>">
            <input type="text" class="form-control width-50" name="nombre" placeholder="Nombre de Aplicación" value="<?= $data['name'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">URL</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="url" placeholder="URL de Aplicación" value="<?= $data['url'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Secret App</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="secret_app" readonly="true" value="<?= $data['secretkey'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Key App</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-50" name="key_app" readonly="true" value="<?= $data['key'] ?>"> 
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Imagen</label>
        <div class="col-md-6">
            <div>
                <label for="img-upload" class="pointer">
                    <?= yii\helpers\Html::img("@web/files/applications/{$data['id_app']}/{$data['image']}", ['id'=>'img-preview', 'width'=>'117']); ?>
                    <span class="btn btn-default display-block no-mrg-btm">Seleccionar Archivo</span>
                    <input class="d-none" type="file" name="image" multiple="" id="img-upload">
                </label>
            </div>
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-success btn-sm" type="submit">Actualizar</button>
    </div>
</form>