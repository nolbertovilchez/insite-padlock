<div class="row">
    <div class="col-md-12">
        <div class="text-left">
            <button href="#" class="btn btn-info btnAddPartial" data-id="roles">
                <i class="fa fa-plus"></i> 
                Nuevo Rol
            </button>
        </div>
        <div class="table-overflow">
            <table class="table table-hover table-lg" id="tb-roles">
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
<?= $this->render("/manage/modals/create_role"); ?>