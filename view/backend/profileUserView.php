<!-- $title definition -->

<?php $this->_title = 'Admin - Profil utilisateur'; ?>

<!-- Content title definition -->

<?php $this->_contentTitle = ''; ?>

<!-- $content definition -->

<?php ob_start(); ?>

<div class="row">

    <div class="col-11 mx-auto">

        <div class="card profile-user-card">

            <h5 class="card-header text-primary-custom"><?= htmlspecialchars($user->pseudo()); ?></h5>

            <div class="card-body profileView">
                <div class="profile-card-avatar">

                    <?php
                    if ($user->avatar() != null)
                    {
                        ?>
                        <img class="img-thumbnail" src="<?= htmlspecialchars($user->avatar()); ?>" alt="User profil picture" />
                        <?php
                    }
                    else
                    {
                        ?>
                        <img class="img-thumbnail" src="public/images/profile.jpg" alt="User profil picture" />
                        <?php
                    }
                    ?>
                    
                    <div class="form-group mt-2">
                        <a data-toggle="modal" data-target="#updateProfilePictureModal<?= htmlspecialchars($user->id()); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary-custom shadow-sm ml-1"><i class="fas fa-upload mr-1"></i> Modifier la photo de profil</a>
                    </div>
                </div>

                <!-- updateProfilePicture Modal-->
                    <div class="modal fade" id="updateProfilePictureModal<?= htmlspecialchars($user->id()); ?>" tabindex="-1" role="dialog" aria-labelledby="updateProfilePictureLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateProfilePictureLabel">Choisissez votre nouvelle photo</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                
                                <form enctype="multipart/form-data" action="index.php?action=updateProfilePicture&amp;id=<?= htmlspecialchars($user->id()); ?>" method="POST">
                                    <div class="modal-body">
                                        <input name="picture" type="file" />
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary-custom" >Envoyer</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                <div class="profile-card-info">
                    <h5 class="card-title"><?= htmlspecialchars($user->firstName()); ?> <?= htmlspecialchars($user->lastName()); ?></h5>
                    <p class="card-text">Née le <?= $user->birthDate(); ?></p>
                    <p class="card-text">Habite à <?= htmlspecialchars($user->home()); ?></p>
                    <p class="card-text"><strong>A propos de moi : </strong> <?= htmlspecialchars($user->userAbout()); ?></p>
                    <hr>
                    <p class="card-text"><strong>Email : </strong><?= htmlspecialchars($user->email()); ?></p>
                    <p class="card-text"><strong>Tel : </strong><?= htmlspecialchars($user->mobile()); ?></p>
                    <p class="card-text"><strong>Site internet : </strong><?= htmlspecialchars($user->website()); ?></p>
                    <hr>
                    <p class="card-text"><strong>Rôle : </strong><?= htmlspecialchars($user->role()); ?></p>
                    <p class="card-text"><strong>Date de création : </strong><?= $user->registerDate(); ?></p>
                    <hr>


                    <p class="card-text"><i class="fas fa-newspaper"> <?= $user->postsNb(); ?></i> - <i class="fas fa-comments"> <?= $user->commentsNb(); ?></i></p>
                    <hr>
                    <a href="index.php?action=editUser&amp;id=<?= htmlspecialchars($user->id()); ?>" class="btn btn-outline-dark btn-sm" title="Modifier">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                </div>

            </div>
            
        </div>

    </div>

</div>

                            
<?php $this->_content = ob_get_clean(); ?>