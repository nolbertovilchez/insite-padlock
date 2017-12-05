<div class="modal fade" id="md-manage-create-application">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Nueva Aplicación</strong></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-20" id="form-create-application">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Aplicación</label>
                        <div class="col-md-9" id="content-create">
                            <select class="form-control" id="cboAplicacion" name="apps[id_app]"></select>
                        </div>
                        <div class="col-md-9 d-none" id="content-edit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Rol</label>
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" name="apps[id_app_user]">
                            <input type="hidden" class="form-control" name="apps[id_user]">
                            <?= yii\helpers\Html::dropDownList("apps[id_role]", null, [], ['class' => "form-control", "id" => "cboRole", "prompt" => "Seleccione..."]); ?>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success btn-sm" type="submit">Guardar</button>
                        <a class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>