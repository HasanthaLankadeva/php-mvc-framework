<div class="wrapper">
    <?php require VIEW_PATH.'/template/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="row">
            
            <div class="col-md-2 module-list">
                <?php require VIEW_PATH.'/posts/includes/module_list.php'; ?>
            </div>

            <div class="col-md-3">
                <?php require VIEW_PATH.'/posts/includes/module_base.php'; ?>
            </div>
            
            <div class="col-md-7"> 
                <?php 
                if(!empty($includeFile)) { 
                    require VIEW_PATH.'/posts/includes/'.$includeFile.'.php';   
                } ?>
            </div>

        </div>
    </div>
</div>