<div class="modal fade" id="md-manage-create-roles">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Nuevo Rol</strong></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-20" id="form-create-roles">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Nombre</label>
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" name="roles[id_role]">
                            <input type="hidden" class="form-control" name="roles[id_app]">
                            <input type="text" class="form-control genera_abreviatura" name="roles[name]" placeholder="Nombre de Rol">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Código</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="code_role" name="roles[code_role]" placeholder="Código de Rol">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Descripción</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="roles[description]" placeholder="Descripcion de Rol"></textarea>
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