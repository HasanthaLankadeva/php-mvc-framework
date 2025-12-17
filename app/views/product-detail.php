<h1>Product Details</h1>
<?php print_r($product); ?><br/><br/>
<p>Product ID: <?= htmlspecialchars($id ?? '') ?></p>

<form id="postForm">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
	<input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <label>Product Name</label><br>
    <input type="text" name="product_name">
    <small class="error" data-error="product_name"></small><br><br>

    <label>Price</label><br>
    <input type="text" name="price">
    <small class="error" data-error="price"></small><br><br>

    <button type="submit">Create Post</button>
</form>

<p id="successMsg" style="color:green;"></p>

<script>
	document.getElementById('postForm').addEventListener('submit', async function (e) {
		e.preventDefault();

		// Clear old messages
		document.querySelectorAll('.error').forEach(e => e.textContent = '');
		document.getElementById('successMsg').textContent = '';

		const res = await fetch('<?= BASE_URL ?>/product/update', {
			method: 'POST',
			body: new FormData(this)
		});
console.log(res);
		const data = await res.json();

		if (!data.success) {
			for (const field in data.errors) {
				const el = document.querySelector(`[data-error="${field}"]`);
				if (el) el.textContent = data.errors[field][0];
			}
			return;
		}

		document.getElementById('successMsg').textContent = data.message;
		this.reset();
	});
</script>