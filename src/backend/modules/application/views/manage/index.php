<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <button href="#" class="btn btn-default" id="add-application">
                <i class="fa fa-plus"></i> 
                Nueva Aplicación
            </button>
        </div>
        <div class="card">
            <div class="card-block">
                <div class="table-overflow">
                    <table class="table table-hover table-lg" id="tbApplications">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>KEY APP</th>
                                <th>SECRET APP</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render("modals/create_application"); ?>