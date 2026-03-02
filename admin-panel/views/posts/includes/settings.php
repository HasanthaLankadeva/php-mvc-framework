<div>Tables in module: <?= $module['name'] ?></div>
<div><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=create_new_table">New table</a></div>
<table class="table table-striped">
    <tbody>
    <?php foreach($tables as $t): ?>
        <tr>
            <td><?= $t['table_name'] ?></td>
            <td><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=edit_settings&submodule=<?= $t['table_name'] ?>">Edit settings</a></td>
            <td><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=relations&submodule=<?= $t['table_name'] ?>">Edit relations</a></td>
            <td><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=edit_fields&submodule=<?= $t['table_name'] ?>">Edit fields</a></td>
            <td><a href="<?= BASE_URL ?>/posts/module/<?= $moduleId ?>?includefile=delete_table&submodule=<?= $t['table_name'] ?>" onclick="return confirm('Delete this table?')">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>