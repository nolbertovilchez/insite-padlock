<div class="modal fade" id="md-remove-permit-users">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Restringir Acciones</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-md-3">Usuario:</label>
                        <label class="col-md-9" id="label_usuario"></label>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-3">Rol:</label>
                        <label class="col-md-9" id="label_rol"></label>
                        <input type="hidden" id="id_app_user"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Acciones Restringidas</h3>
                        <div class="table-overflow">
                            <table class="table table-hover table-lg" id="tb-user-permissions-restricted">
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
                        <h3>Acciones Permitidas</h3>
                        <div class="table-overflow">
                            <table class="table table-hover table-lg" id="tb-user-permissions-allow">
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
            </div>
        </div>
    </div>
</div>