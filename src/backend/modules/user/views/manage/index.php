<?php
/* @var $this yii\web\View */
?>
<h1>Usuarios</h1>

<p>
    Administración de usuarios por aplicación.
</p>

<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <button href="#" class="btn btn-default" id="add-user">
                <i class="fa fa-plus"></i> 
                Nuevo Usuario
            </button>
        </div>
        <div class="card">
            <div class="card-block">
                <div class="table-overflow">
                    <table class="table table-hover table-lg" id="tbUsers">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->render("modals/create_user"); ?>