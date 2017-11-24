<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <button href="#" class="btn btn-default btnAddPartial" data-id="users">
                <i class="fa fa-plus"></i> 
                Nuevo Usuario
            </button>
        </div>
        <div class="card">
            <div class="card-block">
                <div class="table-overflow">
                    <table class="table table-hover table-lg" id="tb-users">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render("/manage/modals/create_user"); ?>