<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="row">
            
            <div class="col-md-2 module-list">
                <?php require VIEW_PATH.'/template/module_list.php'; ?>
            </div>

            <div class="col-md-3">
                <?php require VIEW_PATH.'/template/module_item_list.php'; ?>
            </div>
            
            <div class="col-md-7"> 
                <form method="post" enctype="multipart/form-data" action="<?= BASE_URL ?>/modules/saveRow/<?= $table['id'] ?>/<?= $row['id'] ?? '' ?>">
                    <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= Csrf::generate(); ?>">

                    <?php foreach ($fields as $f): ?>
                        <?php
                            if($f['field_name'] == 'id' || $f['field_name'] == 'created_at'){
                                continue;
                            }
                            
                            $value = $row[$f['field_name']] ?? '';
                        ?>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                <?= ucfirst(str_replace('_', ' ', $f['field_name'])) ?>
                            </label>

                            <?php switch ($f['field_type']):

                                case 'TEXTAREA': ?>
                                    <textarea name="<?= $f['field_name'] ?>"
                                            class="form-control"
                                            rows="4"><?= htmlspecialchars($value) ?></textarea>
                                <?php break;

                                case 'NUMBER': ?>
                                    <input type="number"
                                        name="<?= $f['field_name'] ?>"
                                        class="form-control"
                                        value="<?= htmlspecialchars($value) ?>">
                                <?php break;

                                case 'DATE': ?>
                                    <input type="date"
                                        name="<?= $f['field_name'] ?>"
                                        class="form-control"
                                        value="<?= htmlspecialchars($value) ?>">
                                <?php break;

                                case 'FILE':
                                case 'IMAGE': ?>
                                <?php if (!empty($value)): ?>
                                    <img src="<?= BASE_URL ?>/public/<?= $value ?>" height="60">
                                <?php endif; ?>
                                    <input type="file"
                                        name="<?= $f['field_name'] ?>"
                                        class="form-control">
                                    <?php if ($value): ?>
                                        <small class="text-muted">Current: <?= basename($value) ?></small>
                                    <?php endif; ?>
                                <?php break;

                                default: ?>
                                    <input type="text"
                                        name="<?= $f['field_name'] ?>"
                                        class="form-control"
                                        value="<?= htmlspecialchars($value) ?>"
                                        <?= $f['field_name'] === 'name' ? 'required' : '' ?>>
                            <?php endswitch; ?>
                        </div>
                    <?php endforeach; ?>

                    <button class="btn btn-primary">Save</button>
                    <a href="<?= BASE_URL ?>/modules/rows/<?= $table['id'] ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

        </div>
    </div>
</div>