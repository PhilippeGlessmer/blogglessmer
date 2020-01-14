<div class="container">
    <div class="card mt-5">
        <form method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="card-header">
                <h3 class="card-title text-primary text-center">Formulaire d'inscription</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="email" class="input-group-text w-100">E-mail : </label>
                    </div>
                    <input type="email" class="form-control " placeholder="Inscrivez votre e-mail" name="email">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="password" class="input-group-text w-100">Mot de passe : </label>
                    </div>
                    <input type="password" class="form-control" placeholder="Inscrivez votre mot de passe" name="password">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="email" class="input-group-text w-100">Nom : </label>
                    </div>
                    <input type="text" class="form-control " placeholder="Inscrivez votre nom" name="firstname">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="email" class="input-group-text w-100">Prénom : </label>
                    </div>
                    <input type="text" class="form-control " placeholder="Inscrivez votre prénom" name="lastname">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-25">
                        <label for="datebirth" class="input-group-text w-100">Date de naissance : </label>
                    </div>
                    <input type="date" class="form-control " placeholder="Inscrivez votre prénom" name="datebirth">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-success btn-block">Sign in | Connexion</button>
            </div>
        </form>
    </div>
</div>