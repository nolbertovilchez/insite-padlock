<div class="modal fade" id="md-add-permit-users">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Adicionar Acciones</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3"><b>Usuario:</b></label>
                            <label class="col-md-9" id="label_usuario"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3"><b>Aplicación:</b></label>
                            <label class="col-md-9" id="label_aplicacion"></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <label class="col-md-3"><b>Rol:</b></label>
                            <label class="col-md-9" id="label_rol"></label>
                            <input type="hidden" id="id_app_user"/>
                        </div>
                    </div>
                </div>
                <div class="row mt-1 mb-1">
                    <label class="col-md-12"><b>Seleccione las acciones adicionales que podrá realizar.</b></label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Acciones Disponibles</h3>
                        <div class="table-overflow">
                            <table class="table table-hover table-lg" id="tb-user-permissions-available">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Acciones Adicionales</h3>
                        <div class="table-overflow">
                            <table class="table table-hover table-lg" id="tb-user-permissions-own">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-4">
                    <a class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
</div>