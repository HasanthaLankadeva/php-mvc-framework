<?php
class ProductController
{
	public function index()
	{
		$products = (new Product())->all();

		require APP_PATH . '/views/layouts/header.php';
		require APP_PATH . '/views/product.php';
		require APP_PATH . '/views/layouts/footer.php';
	}

	public function show($id)
	{
		//$productModel = new Product();
		//$product = $productModel->find((int)$id);
		$product = (new Product())->find((int)$id);

		if (!$product) {
			(new Router())->dispatch('404');
			return;
		}
		
		require APP_PATH . '/views/layouts/header.php';
		require APP_PATH . '/views/product-detail.php';
		require APP_PATH . '/views/layouts/footer.php';
	}
	
	public function add()
	{
		header('Content-Type: application/json');
		
		// CSRF
		if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
			echo json_encode([
				'success' => false,
				'errors' => ['csrf' => ['Invalid CSRF token']]
			]);
			return;
		}

        $title = trim($_POST['product_name'] ?? '');
		$content = trim($_POST['price'] ?? '');

		// Validation
        $validator = new Validator();
        $validator
            ->required('product_name', $title)
            ->min('product_name', $title, 3)
            ->required('price', $content);

        if ($validator->fails()) {
			echo json_encode([
				'success' => false,
				'errors' => $validator->errors()
			]);
			return;
		}

		// Insert
        $product = new Product();
        $product->create([
            'product_name' => $title,
            'price' => $content
        ]);
		
		// Update
		$product = new Product();
        $product->update([
            'product_name' => $title,
            'price' => $content
        ]);

        echo json_encode([
			'success' => true,
			'message' => 'Post created successfully'
		]);
	}
	
	public function update()
	{
		header('Content-Type: application/json');
		
		// CSRF
		if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
			echo json_encode([
				'success' => false,
				'errors' => ['csrf' => ['Invalid CSRF token']]
			]);
			return;
		}
		
		$id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['product_name'] ?? '');
		$content = trim($_POST['price'] ?? '');

		if ($id <= 0) {
			echo json_encode(['success' => false, 'message' => 'Invalid ID']);
			return;
		}
		
		// Validation
        $validator = new Validator();
        $validator
            ->required('product_name', $title)
            ->min('product_name', $title, 3)
            ->required('price', $content);

        if ($validator->fails()) {
			echo json_encode([
				'success' => false,
				'errors' => $validator->errors()
			]);
			return;
		}
		
		// Update
		$updated = (new Product())->update($id, [
			'product_name' => $title,
			'price' => $content
		]);

        echo json_encode([
			'success' => true,
			'message' => 'Post created successfully'
		]);
	}
}
?>