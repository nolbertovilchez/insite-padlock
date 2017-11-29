<div class="modal fade" id="md-add-permit-users">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Nuevo Usuario</strong></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-20" id="form-add-permit-users">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Usuario</label>
                        <div class="col-md-9" id="content-create">
                            <select class="form-control" id="cbo_usuario" name="users[id_user]"></select>
                        </div>
                        <div class="col-md-9 d-none" id="content-edit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Rol</label>
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" name="users[id_app_user]">
                            <input type="hidden" class="form-control" name="users[id_app]">
                            <?= yii\helpers\Html::dropDownList("users[id_role]", null, app\modules\application\components\UApplication::cboRolesByApp($data['id_app']), ['class' => "form-control", "id" => "cboRole", "prompt" => "Seleccione..."]); ?>
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