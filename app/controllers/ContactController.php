<?php
class ContactController
{
	private function json($data)
	{
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}

	public function index()
	{
		require APP_PATH . '/views/layouts/header.php';
		require APP_PATH . '/views/contact.php';
		require APP_PATH . '/views/layouts/footer.php';
	}

	public function store()
	{
		if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
			$this->json(['success' => false]);
		}

		$name = trim($_POST['name'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$message = trim($_POST['message'] ?? '');

		$v = new Validator();
		$v->required('name', $name)
		->required('email', $email)
		->required('message', $message)
		->min('message', $message, 10);

		if ($v->fails()) {
			$this->json(['success' => false, 'errors' => $v->errors()]);
		}
		
		$attachmentPath = null;

		if (!empty($_FILES['attachment']['name'])) {
			$file = $_FILES['attachment'];
			$allowed = ['pdf', 'jpg', 'png', 'doc', 'docx'];
			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

			if (!in_array($ext, $allowed)) {
				$this->json([
					'success' => false,
					'errors' => ['attachment' => ['Invalid file type']]
				]);
			}

			if ($file['size'] > 2 * 1024 * 1024) {
				$this->json([
					'success' => false,
					'errors' => ['attachment' => ['Max file size is 2MB']]
				]);
			}

			$filename = uniqid('att_') . '.' . $ext;
			$attachmentPath = 'uploads/enquiries/' . $filename;

			move_uploaded_file(
				$file['tmp_name'],
				PUBLIC_PATH . '/' . $attachmentPath
			);
		}

		// Save enquiry
		(new Enquiry())->create([
			'name' => $name,
			'email' => $email,
			'message' => $message,
			'attachment' => $attachmentPath
		]);

		// Send confirmation email
		$mailer = new Mailer();
        $mailer->send(
            $email,
            'We received your enquiry',
            "Hi $name,\n\nThanks for contacting us.\n\n$message",
            $attachmentPath
        );


		$this->json(['success' => true]);
	}
}
?>