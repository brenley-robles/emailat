<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Send Job Application</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6">Job Application Form</h1>
    <form action="generate_cover.php" method="POST" enctype="multipart/form-data">
      <label class="block mb-2">Recipient Email:</label>
      <input type="email" name="email" class="w-full mb-4 p-2 border rounded" required>

      <label class="block mb-2">Company Name:</label>
      <input type="text" name="company" class="w-full mb-4 p-2 border rounded" required>

      <label class="block mb-2">Optional Message:</label>
      <textarea name="message" class="w-full mb-4 p-2 border rounded"></textarea>

      <!-- If needed in future -->
      <!-- <label class="block mb-2">Upload CV (optional):</label>
      <input type="file" name="cv" class="mb-4"> -->

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Generate Cover Letter
      </button>
    </form>
  </div>
</body>
</html>
