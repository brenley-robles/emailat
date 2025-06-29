<?php
require_once __DIR__ . '/vendor/autoload.php';

// Get POST data
$email = $_POST['email'];
$company = htmlspecialchars($_POST['company']);
$message = nl2br(htmlspecialchars($_POST['message']));
date_default_timezone_set('Asia/Manila');
$today = date('l, F j, Y');


$coverLetterHTML = '
<html>
<head>
  <style>
    body {
      font-family: "Montserrat", sans-serif;
      font-size: 11pt;
      line-height: 1.7;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .header-bar {
      background-color: #1E3A8A; /* Tailwind blue-900 */
      height: 10px;
      width: 100%;
      margin-bottom: 20px;
    }
    .container {
      padding: 30px;
    }
    .header h2 {
      margin: 0;
      font-size: 16pt;
      color: #111;
    }
    .header p {
      margin: 2px 0;
      font-size: 10pt;
      color: #555;
    }
    .date {
      margin-top: 10px;
      font-size: 10.5pt;
    }
    .content {
      margin-top: 20px;
      text-align: justify;
    }
    .content p {
      margin-bottom: 10px;
    }
    .signature {
      margin-top: 25px;
    }
    .signature strong {
      font-size: 11.5pt;
    }
  </style>
</head>
<body>
  <div class="header-bar"></div>

  <div class="container">
    <div class="header">
      <h2>Brenley Ian Robles</h2>
      <p>Malolos, Bulacan</p>
      <p>brenley.robles.dr@gmail.com | (+63) 977-681-2713</p>
    </div>

    <div class="date">' . $today . '</div>

    <div class="content">
      <p><strong>' . $company . '</strong><br>Human Resources Department</p>

      <p>Dear Hiring Team,</p>

        <p>
        I am writing to express my interest in becoming part of <strong>' . $company . '</strong>. With a strong foundation in developing digital solutions, user interface and experience design, IT business analysis, and quality assurance from my most recent experience, I am confident in my ability to contribute meaningfully to your customer experience and development initiatives.
        </p>

        <p>
        During my internship, I was immersed in end-to-end testing, user flow analysis, and close collaboration with both developers and stakeholders. I handled responsibilities such as drafting detailed test scripts, raising user acceptance tickets, and actively participating in meetings that validated real customer pain points and behavior. These experiences, coupled with my exposure to tools like Azure DevOps, ClickUp, and Notion, helped me develop a data-informed and quality-focused approach to software and service delivery.
        </p>

        <p>
        What sets me apart is my strong foundation in user experience thinking and a genuine curiosity for understanding the “why” behind every user interaction. Becoming part of <strong>' . $company . '</strong> would be an incredible opportunity to grow in an environment that values innovation, collaboration, and customer-centricity.
        </p>

        <p>
        Thank you for considering my application. I would welcome the opportunity to further discuss how my skills and mindset align with your goals. I am available for an interview at your convenience.
        </p>

      <div class="signature">
        <p>Sincerely,</p>
        <p><strong>Brenley Ian Robles</strong></p>
      </div>
    </div>
  </div>
</body>
</html>';



// Save PDF version
$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
  'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
  'fontdata' => $fontData + [
    'montserrat' => [
      'R' => 'MONTSERRAT-REGULAR.ttf',
      'B' => 'Montserrat-Bold.ttf',
    ]
  ],
  'default_font' => 'montserrat'
]);

$mpdf->WriteHTML($coverLetterHTML);
$pdfPath = __DIR__ . '/upload/generated_cover_letter.pdf';
$mpdf->Output($pdfPath, \Mpdf\Output\Destination::FILE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Review Cover Letter</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Preview Your Cover Letter</h2>
    <div class="prose max-w-none">
      <?= $coverLetterHTML ?>
    </div>

    <form action="send_email.php" method="POST" class="mt-6">
      <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
      <input type="hidden" name="company" value="<?= htmlspecialchars($company) ?>">
      <input type="hidden" name="message" value="<?= htmlspecialchars($_POST['message']) ?>">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Send Email with Attachments
      </button>
    </form>
  </div>
</body>
</html>
