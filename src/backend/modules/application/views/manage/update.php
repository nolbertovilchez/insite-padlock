<div class="card">
    <div class="tab-info">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a href="#card-tab-1" class="nav-link active tabApplications" data-id='general' data-list='false' role="tab" data-toggle="tab" aria-expanded="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-2" class="nav-link tabApplications" data-id='setting' data-list='false' role="tab" data-toggle="tab" aria-expanded="false">Configuración</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-3" class="nav-link tabApplications" data-id='roles' data-list='true' role="tab" data-toggle="tab" aria-expanded="false">Roles</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-4" class="nav-link tabApplications" data-id='actions' data-list='true' role="tab" data-toggle="tab" aria-expanded="false">Acciones</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-5" class="nav-link tabApplications" data-id='permissions' data-list='false' role="tab" data-toggle="tab" aria-expanded="false">Permisos</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-6" class="nav-link tabApplications" data-id='users' data-list='true' role="tab" data-toggle="tab" aria-expanded="false">Usuarios</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active show" id="card-tab-1" aria-expanded="true">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <?= $this->render("partials/_datos_generales", ["data" => $data]); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-2" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <?= $this->render("partials/_configuracion", ["data" => $data]); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-3" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <?= $this->render("partials/_roles", ["data" => $data]); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-4" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <?= $this->render("partials/_actions", ["data" => $data]); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-5" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <?= $this->render("partials/_permissions", ["data" => $data]); ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-6" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <?= $this->render("partials/_users", ["data" => $data]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
