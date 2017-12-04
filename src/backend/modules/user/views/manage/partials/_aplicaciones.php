<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <button href="#" class="btn btn-info btnAddPartial" data-id="application">
                <i class="fa fa-plus"></i> 
                Nueva Aplicación
            </button>
        </div>
        <div class="table-overflow">
            <table class="table table-hover table-lg" id="tb-application">
            </table>
        </div>
    </div>
</div>
<?= $this->render("/manage/modals/create_application", ["data" => $data]); ?>
<?= $this->render("//global/modals/permits/add_user_permit", ["data" => $data]); ?>
<?= $this->render("//global/modals/permits/remove_user_permit", ["data" => $data]); ?>