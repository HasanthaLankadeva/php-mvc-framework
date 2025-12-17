<?php
	$homeActive = $modulesActive = $mediaLibActive = $adminToolsActive = $userManagerActive = $settingsActive = '' ;

	switch ($adminPage) {
		case "home":
			$homeActive = "active";
			break;
		case "modules":
			$modulesActive = "active";
			break;
		case "mediaLib":
			$mediaLibActive = "active";
			break;
		case "adminTools":
			$adminToolsActive = "active";
			break;
		case "userManager":
			$userManagerActive = "active";
			break;
		case "settings":
			$settingsActive = "active";
			break;
	}
?>

<div class="login-wrapper">
    <div class="user">Hello <span><?=$user?></span></div>
    <div class="logout"><a href="logout.php">Logout</a></div>
</div>
<div class="menu-wrapper">
    <ul class="no-bullets">
        <li class="home <?=$homeActive;?>">
            <a href="home.php"><span class="fa fa-home"></span> Dashboard</a>
        </li>
        <li class="modules <?=$modulesActive;?>">
            <a href="modules.php"><span class="fa fa-file"></span> Pages</a>
        </li>
        <li class="mediaLib <?=$mediaLibActive;?>">
            <a href="mediaLib.php"><span class="fa fa-file-image-o"></span> Media Manager</a>
        </li>
        <li class="adminTools <?=$adminToolsActive;?>">
            <a href="adminTools.php"><span class="fa fa-cubes"></span> Admin Modules</a>
        </li>
        <li class="userManager <?=$userManagerActive;?>">
            <a href="userManager.php"><span class="fa fa-users"></span> User Manager</a>
        </li>
        <li class="settings <?=$settingsActive;?>">
            <a href="settings.php"><span class="fa fa-cogs"></span> Settings</a>
        </li>
    </ul>
</div>
<div class="side-bar-bottom-content">
    <p>CMS Version: 1.2.0</p>
    <p>PHP Version: <?=phpversion();?></p>
    <p>Developed by WebPartner</p>
</div>