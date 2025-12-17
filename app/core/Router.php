<?php

class Router {
	public function dispatch($url) {
		$url = trim($url, '/');
		$parts = $url === '' ? [] : explode('/', $url);
		$route = $parts[0] ?? '';
		
		$GLOBALS['current_route'] = $route;

		switch ($route) {
			case '':
			(new HomeController())->index();
			break;

			case 'about':
			(new PageController())->about();
			break;

			case 'contact':
			if (isset($parts[0]) && !isset($parts[1])) {
				(new ContactController())->index();
			}
			
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($parts[1] ?? '') === 'store') {
				(new ContactController())->store();
			}
			
			break;

			// Dynamic route: /product/{id}
			case 'product':
				if (isset($parts[0]) && !isset($parts[1])) {
					(new ProductController())->index();
					break;
				}
				
				if (isset($parts[1])) {
					switch ($parts[1] ?? '') {
						case 'enquiry':
							(new ProductController())->add();
							break;
						case 'update':
							(new ProductController())->update();
							break;
						case 'delete':
							(new ProductController())->delete();
							break;
						default:
							(new ProductController())->show($parts[1]);
					}
					break;
				}

				$this->notFound();
				break;
			
			default:
			$this->notFound();
		}
	}
	private function notFound()
	{
		http_response_code(404);
		require APP_PATH . '/views/layouts/header.php';
		require APP_PATH . '/views/errors/404.php';
		require APP_PATH . '/views/layouts/footer.php';
	}
}

?>