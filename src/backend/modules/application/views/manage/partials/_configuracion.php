<form class="form-horizontal mrg-top-20" id="form-setting-application">
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Permitir reutilizar sesiones</label>
        <div class="col-md-9">
            <div class="toggle-checkbox checkbox-inline toggle-sm mrg-top-10">
                <input type="checkbox" name="setting[session_reuse_sessions]" id="toggle1" <?= ($data['session_reuse_sessions'] == 1) ? "checked" : "" ?>>
                <label for="toggle1"></label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Permitir nuevas sesiones en el sistema</label>
        <div class="col-md-9">
            <div class="toggle-checkbox checkbox-inline toggle-sm mrg-top-10">
                <input type="checkbox" name="setting[system_no_new_sessions]" id="toggle2" <?= ($data['system_no_new_sessions'] == 1) ? "checked" : "" ?>>
                <label for="toggle2"></label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Duración máxima de la sesión (mins)</label>
        <div class="col-md-9">
            <input type="hidden" class="form-control width-50" name="id" value="<?= $data['id_app'] ?>">
            <input type="text" class="form-control width-10" name="setting[session_max_duration_mins]" value="<?= $data['session_max_duration_mins'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Conexiones máximas por la misma IP</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-10" name="setting[session_max_same_ip_connections]" value="<?= $data['session_max_same_ip_connections'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Sesiones máximas  por día</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-10" name="setting[session_max_sessions_per_day]" value="<?= $data['session_max_sessions_per_day'] ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="form-1-1" class="col-md-3 control-label">Sesiones máximas  por usuario</label>
        <div class="col-md-9">
            <input type="text" class="form-control width-10" name="setting[session_max_sessions_per_user]" value="<?= $data['session_max_sessions_per_user'] ?>">
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-success btn-sm" type="submit">Actualizar</button>
    </div>
</form>