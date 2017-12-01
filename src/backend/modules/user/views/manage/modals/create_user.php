<div class="modal fade" id="md-manage-create-user">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Nuevo Usuario</strong></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mrg-top-20" id="form-create-user">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Datos Personales</h3>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Código personal</label>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" name="identis[CodIden]">
                                    <input type="hidden" class="form-control" name="identis[CodTMoti]">
                                    <input type="text" class="form-control" name="identis[CodPer]" autocomplete="off" placeholder="Código Personal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Nombres</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="identis[Nombres]" autocomplete="off" placeholder="Nombres">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Apellido Paterno</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="identis[Ape1]" autocomplete="off" placeholder="Apellido Paterno">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Apellido Materno</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="identis[Ape2]" autocomplete="off" placeholder="Apellido Materno">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Sexo</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="identis[Sexo]" autocomplete="off" placeholder="Sexo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Contacto</h3>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Teléfono</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="contacto[telefono]" autocomplete="off" placeholder="Teléfono">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="contacto[email]" autocomplete="off" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success btn-sm" type="submit">Crear</button>
                        <a class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>