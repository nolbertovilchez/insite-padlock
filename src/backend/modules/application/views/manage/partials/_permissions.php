<div class="row mb-3">
    <div class="col-md-12">
        <div class="text-left">
            <?= yii\helpers\Html::dropDownList("cboRole", null, [], ['class' => "form-control width-20", "id" => "cboRole","prompt"=>"Seleccione..."]); ?>
        </div>
    </div>
</div>
<div class="row invisible" id="content-role">
    <div class="col-md-6">
        <h3>Acciones Disponibles</h3>
        <div class="table-overflow">
            <table class="table table-hover table-lg" id="tb-permissions-available">
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
        <h3>Acciones Asignadas</h3>
        <div class="table-overflow">
            <table class="table table-hover table-lg" id="tb-permissions-own">
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
<?= $this->render("/manage/modals/create_permission"); ?>