<h1>Contact Us</h1>


<form id="contactForm" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">


<input name="name" placeholder="Your Name">
<small data-error="name"></small><br><br>


<input name="email" placeholder="Your Email">
<small data-error="email"></small><br><br>


<textarea name="message" placeholder="Your Message"></textarea>
<small data-error="message"></small><br><br>


<input type="file" name="attachment">
<small data-error="attachment"></small><br><br>


<button>Send</button>
</form>


<p id="contactSuccess" style="color:green"></p>


<script>
	document.getElementById('contactForm').onsubmit = async e => {
		e.preventDefault();


		document.querySelectorAll('small').forEach(s => s.textContent = '');
		document.getElementById('contactSuccess').textContent = '';


		const res = await fetch('<?= BASE_URL ?>/contact/store', {
			method: 'POST',
			body: new FormData(e.target)
		});


		const data = await res.json();


		if (!data.success) {
			for (const field in data.errors) {
				document.querySelector(`[data-error="${field}"]`).textContent = data.errors[field][0];
			}
			return;
		}


		document.getElementById('contactSuccess').textContent = 'Message sent successfully';
		e.target.reset();
	};
</script>