<!-- title definition -->

<?php $this->_title = 'Admin - Formulaire de contact '; ?>

<!-- $content definition -->

<?php ob_start(); ?>


<!-- Sorting Row -->

<div class="row mb-5">
    <div class="col-12 mb-3">
        <a href="index.php?action=adminContacts">Tous (<?= $allContactsNb ?>)</a>
         | 
         <a href="index.php?action=adminContacts&sort=unread">Non lus (<?= $unreadContactsNb ?>)</a>
         | Trier par date 
        
        <?php

        if (!$get->get('sort'))
        {
            if (!$get->get('date'))
            {
                echo '<a href="index.php?action=adminContacts&date=asc" title="Trier du plus ancien au plus récent"><i class="fas fa-sort-down fa-2x ml-2"></i></a>';
            }
            else
            {
                if ($get->get('date') == 'asc')
                {
                   echo '<a href="index.php?action=adminContacts" title="Trier du plus récent au plus ancien"><i class="fas fa-sort-up fa-2x ml-2 mb-0"></i></a>';
                }
            }
        }
        else
        {
            if ($get->get('sort') == 'unread')
            {
                if (!$get->get('date'))
                {
                    echo '<a href="index.php?action=adminContacts&sort=unread&date=asc" title="Trier du plus ancien au plus récent"><i class="fas fa-sort-down fa-2x ml-2"></i></a>';
                }
                else
                {
                    if ($get->get('date') == 'asc')
                    {
                     echo '<a href="index.php?action=adminContacts&sort=unread" title="Trier du plus récent au plus ancien"><i class="fas fa-sort-up fa-2x ml-2 mb-0"></i></a>';
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
                    <th scope="col">Statut</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                foreach($allContacts as $contact)
                {
                    if ($contact->statusId() == 1)
                    {
                        echo '<tr class="table-success-custom">';
                    }
                    else
                    {
                        echo '<tr>';
                    }
                ?>
                
                    <th scope="row"><?= htmlspecialchars($contact->id()); ?></th>

                    <?php
                    if ($contact->statusId() == 1)
                    {
                        echo '<td class="responsive-table-custom" title="Non lu"><i class="fas fa-envelope"></i></td>';
                    }
                    elseif ($contact->statusId() == 2)
                    {
                        echo '<td class="responsive-table-custom" title="Lu"><i class="fas fa-envelope-open-text"></i></td>';
                    }
                    else
                    {
                        echo '<td class="responsive-table-custom" title="Répondu"><i class="fas fa-envelope-open-text"></i><i class="fas fa-reply"></i></td>';
                    }
                    ?>

                    
                    <td class="responsive-table-custom"><?= htmlspecialchars($contact->name()); ?></td>
                    <td class="responsive-table-custom"><?= htmlspecialchars($contact->email()); ?></td>
                    <td class="responsive-table-custom"><a href="index.php?action=contactView&amp;id=<?= htmlspecialchars($contact->id()); ?>" ><?= htmlspecialchars($contact->subject()); ?></a></td>
                    <td class="responsive-table-custom"><a href="index.php?action=contactView&amp;id=<?= htmlspecialchars($contact->id()); ?>" ><?= substr(htmlspecialchars($contact->content()), 0, 50); ?>...</a></td>
                    <td class="responsive-table-custom"><?= $contact->dateMessage(); ?></td>
                    <td class="responsive-table-custom">

                        <?php
                        if ($contact->statusId() != 3)
                        {
                            ?>
                            <a href="index.php?action=contactView&amp;id=<?= htmlspecialchars($contact->id()); ?>" class="btn btn-outline-dark btn-sm" title="Répondre">
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>

                            <?php
                        }
                        ?>
                        
                        <a data-toggle="modal" data-target="#deleteContactModal<?= htmlspecialchars($contact->id()); ?>" class="btn btn-outline-dark btn-sm" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                    
                    
                </tr>
                <!-- deleteContact Modal-->
                <div class="modal fade" id="deleteContactModal<?= htmlspecialchars($contact->id()); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteContactLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteContactLabel">Voulez-vous vraiment supprimer ce message ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Cliquez sur "Valider" pour supprimer définitivement ce message</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <a class="btn btn-primary-custom" href="index.php?action=deleteContact&amp;id=<?= htmlspecialchars($contact->id()); ?>">Valider</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>
                
            </tbody>
        </table>
    </div>
    
</div>


<?php $this->_content = ob_get_clean(); ?>

