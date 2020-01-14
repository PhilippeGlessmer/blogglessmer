<div class="container">
    <div class="card mt-5">
        <form method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="card-header">

                <h3 class="card-title text-primary text-center">Formulaire de connexion</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="email" class="input-group-text w-100">E-mail : </label>
                    </div>
                    <input type="email" class="form-control " placeholder="Inscrivez votre e-mail" name="email" id="email" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="password" class="input-group-text w-100">Mot de passe : </label>
                    </div>
                    <input type="password" class="form-control" placeholder="Inscrivez votre mot de passe" name="password" id="password" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <div class="input-group-text w-100">
                            <input type="checkbox" aria-label="Checkbox for following text input" name="fidme" id="fidme" checked>
                        </div>
                    </div>
                    <label for="fidme" class="form-control">Se souvenir de moi</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-block">Sign in | Connexion</button>
            </div>
        </form>
    </div>
</div>