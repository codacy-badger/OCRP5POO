<!-- title deinition -->

<?php $title = 'Admin - Tous les articles'; ?>

<!-- $content definition -->

<?php ob_start(); ?>


<!-- Sorting Row -->

<div class="row mb-5">
    <div class="col-12 mb-3">
        <a href="index.php?action=adminPosts">Tous (<?= $totalPostsNb ?>)</a> | <a href="index.php?action=adminPosts&sort=unpublished">Non publiés (<?= $unpublishedPostsNb ?>)</a>
         | Trier par date

        <?php
        if (!isset($_GET['sort']))
        {
            if (!isset($_GET['date']))
            {
                echo '<a href="index.php?action=adminPosts&date=asc" title="Trier du plus ancien au plus récent"><i class="fas fa-sort-down fa-2x ml-2"></i></a>';
            }
            else
            {
                if ($_GET['date'] == 'asc')
                {
                 echo '<a href="index.php?action=adminPosts" title="Trier du plus récent au plus ancien"><i class="fas fa-sort-up fa-2x ml-2 mb-0"></i></a>';
                }
            }
        }
        else
        {
            if ($_GET['sort'] == 'unpublished')
            {
                if (!isset($_GET['date']))
                {
                    echo '<a href="index.php?action=adminPosts&sort=unpublished&date=asc" title="Trier du plus ancien au plus récent"><i class="fas fa-sort-down fa-2x ml-2"></i></a>';
                }
                else
                {
                    if ($_GET['date'] == 'asc')
                    {
                     echo '<a href="index.php?action=adminPosts&sort=unpublished" title="Trier du plus récent au plus ancien"><i class="fas fa-sort-up fa-2x ml-2 mb-0"></i></a>';
                    }
                }
            }
        }

        ?>
    </div>
</div>

<!-- Posts List Row -->

<div class="row">

    <div class="col-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Status</th>
                    <th scope="col">Titre</th>
                    <th scope="col" class="responsive-table-custom">Auteur</th>
                    <th scope="col" class="responsive-table-custom">Chapô</th>
                    <th scope="col">Date de création</th>
                    <th scope="col" title="Nombre de commentaires approuvés/total"><i class="fas fa-comments"></i></th>
                </tr>
            </thead>
            <tbody>

                <?php

                while ($donnees = $allPosts->fetch())
                {
                    if ($donnees['approvedCommentsNb'] != $donnees['commentsNb'])
                    {
                        echo '<tr class="table-success-custom">';
                    }
                    else
                    {
                        echo '<tr>';
                    }
                ?>
                
                    <th scope="row"><?= htmlspecialchars($donnees['postId']); ?></th>

                    <?php 
                    if ($donnees['status'] == 1)
                    {
                    ?>

                    <td><a href="index.php?action=publishPost&amp;id=<?= htmlspecialchars($donnees['postId']); ?>&amp;status=<?= htmlspecialchars($donnees['status']); ?>" title="Ne plus publier"><i class="fas fa-toggle-on"></i></a></td>
                    
                    <?php
                    }
                    else
                    {
                    ?>

                    <td><a href="index.php?action=publishPost&amp;id=<?= htmlspecialchars($donnees['postId']); ?>&amp;status=<?= htmlspecialchars($donnees['status']); ?>" title="Publier"><i class="fas fa-toggle-off"></i></a></td>
                    
                    <?php
                    }
                    ?>

                    <td>
                        <a href="index.php?action=adminPostView&amp;id=<?= htmlspecialchars($donnees['postId']); ?>"><?= htmlspecialchars($donnees['title']); ?></a>
                        <hr class="postlist-divider">
                        <a href="index.php?action=adminPostView&amp;id=<?= htmlspecialchars($donnees['postId']); ?>" class="btn btn-outline-dark btn-sm" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="index.php?action=editPostView&amp;id=<?= htmlspecialchars($donnees['postId']); ?>" class="btn btn-outline-dark btn-sm" title="Modifier">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a data-toggle="modal" data-target="#deletePostModal<?= htmlspecialchars($donnees['postId']); ?>" class="btn btn-outline-dark btn-sm" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                    <td class="responsive-table-custom"><?= htmlspecialchars($donnees['first_name']); ?> <?= substr(htmlspecialchars($donnees['last_name']),0,1); ?></td>
                    <td class="responsive-table-custom">
                        <?= substr(htmlspecialchars($donnees['chapo']), 0, 50); ?>
                        
                        <?php

                        if (array_key_exists($donnees['postId'], $allPostsCategories))
                        {
                            echo '<hr class="postlist-divider">';
                            echo 'Catégorie(s) :';
                        

                            $postCategories = $allPostsCategories[$donnees['postId']];

                            foreach ($postCategories AS $key => $value)
                            {
                                echo '<a class="btn btn-outline-secondary ml-2" href="">' . $value . '</a>';
                            }
                        }
                        
                        ?>

                        
                    </td>
                    <td><?= htmlspecialchars($donnees['date_creation']); ?></td>
                    <td class="responsive-table-custom"><?= htmlspecialchars($donnees['approvedCommentsNb']); ?>/<?= htmlspecialchars($donnees['commentsNb']); ?></td>
                    
                </tr>
                <!-- deletePost Modal-->
                <div class="modal fade" id="deletePostModal<?= htmlspecialchars($donnees['postId']); ?>" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePostLabel">Voulez-vous vraiment supprimer ce post ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Cliquez sur "Valider" pour supprimer définitivement ce post</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <a class="btn btn-primary-custom" href="index.php?action=deletePost&amp;id=<?= htmlspecialchars($donnees['postId']); ?>">Valider</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                $allPosts->closeCursor();
                ?>
                
            </tbody>
        </table>
    </div>
    
</div>


<?php $content = ob_get_clean(); ?>

<?php require('backend_template.php'); ?>
