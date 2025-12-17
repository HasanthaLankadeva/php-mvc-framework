<?php
	function isActive(string $route): string
	{
		return ($GLOBALS['current_route'] ?? '') === $route ? 'active' : '';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My MVC Website</title>
<nav>
    <a class="<?= isActive('') ?>" href="<?= BASE_URL ?>">Home</a> |
    <a class="<?= isActive('about') ?>" href="<?= BASE_URL ?>/about">About</a> |
    <a class="<?= isActive('product') ?>" href="<?= BASE_URL ?>/product">Product</a> |
	<a class="<?= isActive('contact') ?>" href="<?= BASE_URL ?>/contact">Contact</a>
</nav>
<hr>