<h1>Product Listing</h1>
<?php foreach ($products as $product): ?>
<h3><?= htmlspecialchars($product['product_name']) ?></h3>
<p><?= htmlspecialchars($product['price']) ?></p>
<p><a href="<?= BASE_URL . '/product/' . htmlspecialchars($product['id']) ?>">More</a></p>
<hr>
<?php endforeach; ?>