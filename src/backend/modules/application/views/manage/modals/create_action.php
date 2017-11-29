<div class="modal fade" id="md-manage-create-actions">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Nueva Acción</strong></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-20" id="form-create-actions">
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Nombre</label>
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" name="actions[id_action]">
                            <input type="hidden" class="form-control" name="actions[id_app]">
                            <input type="text" class="form-control" name="actions[name]" placeholder="Nombre de Acción">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="form-1-1" class="col-md-3 control-label">Descripción</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="actions[description]" placeholder="Descripcion de Acción"></textarea>
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