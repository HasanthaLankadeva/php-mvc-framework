<?php
class PageController
{
	public function about()
	{
		require_once APP_PATH . '/views/layouts/header.php';
		require_once APP_PATH . '/views/about.php';
		require_once APP_PATH . '/views/layouts/footer.php';
	}

	public function contact()
	{
		require_once APP_PATH . '/views/layouts/header.php';
		require_once APP_PATH . '/views/contact.php';
		require_once APP_PATH . '/views/layouts/footer.php';
	}

	public function product()
	{
		require_once APP_PATH . '/views/layouts/header.php';
		require_once APP_PATH . '/views/product.php';
		require_once APP_PATH . '/views/layouts/footer.php';
	}
}
?>