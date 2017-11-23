<div class="card">
    <div class="padding-20">
        <h4 class="card-title no-mrg-btm"><?= $data['NAME_APP'] ?></h4>
    </div>
    <div class="tab-info">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a href="#card-tab-1" class="nav-link active" role="tab" data-toggle="tab" aria-expanded="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-2" class="nav-link" role="tab" data-toggle="tab" aria-expanded="false">Configuración</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-3" class="nav-link " role="tab" data-toggle="tab" aria-expanded="false">Roles</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-4" class="nav-link " role="tab" data-toggle="tab" aria-expanded="false">Acciones</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-5" class="nav-link " role="tab" data-toggle="tab" aria-expanded="false">Permisos</a>
            </li>
            <li class="nav-item">
                <a href="#card-tab-6" class="nav-link " role="tab" data-toggle="tab" aria-expanded="false">Usuarios</a>
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
                    <p>Rouge Group, use your harpoons and tow cables. Go for the legs. It might be our only chance of stopping them. All right, stand by, Dack. Luke, we've got a malfunction in fire control. I'll have to cut in the auxiliary. ust hang on. Hang on, Dack. Get ready to fire that tow cable. Dack? Dack! Yes, Lord Vader. I've reached the main power generator. The shield will be down in moments. You may start your landing. Rouge Three. Copy, Rouge Leader Wedge, I've lost my gunner.You'll have to make this shot.</p>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-3" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <p>If only you had attached my legs, I wouldn't be in this ridiculous position. Now, remember, Chewbacca, you have a responsibility to me, so don't do anything foolish. What's going on...buddy? You're being put into carbon freeze. What if he doesn't survive? He's worth a lot to me. The Empire will compensate you if he dies. Put him in! Oh, no! No, no, no! Stop, Chewbacca, stop...! Stop, Chewie, stop! Do you hear me? Stop! Yes, stop, please! I'm not ready to die. Chewie! Chewie, this won't help me.</p>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-4" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <p>If only you had attached my legs, I wouldn't be in this ridiculous position. Now, remember, Chewbacca, you have a responsibility to me, so don't do anything foolish. What's going on...buddy? You're being put into carbon freeze. What if he doesn't survive? He's worth a lot to me. The Empire will compensate you if he dies. Put him in! Oh, no! No, no, no! Stop, Chewbacca, stop...! Stop, Chewie, stop! Do you hear me? Stop! Yes, stop, please! I'm not ready to die. Chewie! Chewie, this won't help me.</p>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="card-tab-5" aria-expanded="false">
                <div class="pdd-horizon-15 pdd-vertical-20">
                    <p>If only you had attached my legs, I wouldn't be in this ridiculous position. Now, remember, Chewbacca, you have a responsibility to me, so don't do anything foolish. What's going on...buddy? You're being put into carbon freeze. What if he doesn't survive? He's worth a lot to me. The Empire will compensate you if he dies. Put him in! Oh, no! No, no, no! Stop, Chewbacca, stop...! Stop, Chewie, stop! Do you hear me? Stop! Yes, stop, please! I'm not ready to die. Chewie! Chewie, this won't help me.</p>
                </div>
            </div>
        </div>
    </div>
</div>
