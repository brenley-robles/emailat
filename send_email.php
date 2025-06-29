<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

// Get POST data
$emailTo = $_POST['email'];
$company = $_POST['company'];
$message = nl2br($_POST['message']);

// Email body
$body = '
<p>Greetings,</p>

<p>
I am writing to formally express my interest in exploring potential opportunities with <strong>' . $company . '</strong>. Attached to this email are my Curriculum Vitae and a cover letter addressed to your company.
</p>

<p>
I am an Information Technology professional with experience in mobile and web development, UI/UX design, IT business analysis, and quality assurance. Throughout my academic, internship journey, as well as in industry-level job exposure, I have consistently demonstrated a strong work ethic, problem-solving abilities, and leadership capacity. I am confident that my background and skills could be of value to your team.
</p>

<p>
I would be truly grateful for the opportunity to further discuss how I can contribute to <strong>' . $company . '</strong>. Please feel free to reach out should you need any additional information or documents.
</p>

' . ($message ? '<p>' . nl2br(htmlspecialchars($message)) . '</p>' : '') . '

<p>
Thank you very much for your time and kind consideration.
</p>

<p>Respectfully,<br><strong>Brenley Ian Robles</strong></p>
';

$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'brenley.robles.dr@gmail.com'; // your Gmail
    $mail->Password   = 'nzof ujtk mqjj czyu';         // app password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Sender and Recipient
    $mail->setFrom('brenley.robles.dr@gmail.com', 'Brenley Ian Robles');
    $mail->addAddress($emailTo);

    // Attachments
    $mail->addAttachment(__DIR__ . '/upload/generated_cover_letter.pdf', 'CoverLetter.pdf');
    $mail->addAttachment(__DIR__ . '/Brenley Robles - Curriculum Vitae.pdf', 'CurriculumVitae.pdf');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Application for Potential Opportunity at ' . $company . ' - Brenley Ian Robles';
    $mail->Body    = $body;

    $mail->send();

    // ✅ Show success page
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Email Sent</title>
      <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
      <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
          </svg>
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Email Sent Successfully!</h2>
        <p class="text-gray-600 mb-6">Your application has been delivered. Thank you for using the app.</p>
        <a href="index.php" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">Send Another</a>
      </div>
    </body>
    </html>
    <?php
} catch (Exception $e) {
    echo "<h2 style='color:red; text-align:center;'>❌ Email could not be sent. Error: {$mail->ErrorInfo}</h2>";
}
