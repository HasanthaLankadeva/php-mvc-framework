<div>Relations with (<?= $submodule ?>) As parent</div>
<p><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=new_relations&submodule=<?= $table ?>">New relation</a></p>

<?php 
    //if($relations){
       // echo 'Edit Relation ';
    //} else {
?>
        <table class="table table-striped">
            <tbody>
            <?php foreach($relations as $r): //print_r($r);?>
                <tr>
                    <td><?= $r['relationname'] ?></td>
                    <td>id-><?= $submodule ?> (<?= $r['childtable'] ?>:parentID)</td>
                    <td>
                        <a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=relations&submodule=<?= $submodule ?>&editrel=<?= $r['id'] ?>">Edit relations</a>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>/modules/deleteTable/<?= $r['id'] ?>" onclick="return confirm('Delete this table?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<?php 
    //}
?>
