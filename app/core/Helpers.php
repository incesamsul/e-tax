<?php

class Helpers
{
    public static function setAlert($pesan)
    {
        $_SESSION['alert'] = [
            'pesan' => $pesan,
        ];
    }

    public static function showAlert()
    {
        if (isset($_SESSION['alert'])) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.info(
                    '" . $_SESSION['alert']['pesan'] . "',
                );
            });
            </script>";
            unset($_SESSION['alert']);
        }
    }

    public static function convertNoHp($noHp)
    {
        return '62' . substr($noHp, 1);
    }


    public static function sendEmail($subject, $to, $body)
    {
        // API endpoint for sending email
        $url = 'https://api.elasticemail.com/v2/email/send';

        // Your Elastic Email API key
        $apiKey = '0C8B93672DEFD79E0087B28C5CF054653F46EF25330851E40CE966BDC7BFF8A8E69C3BA783366143A8AE0ED002590D56';

        // Recipient email address
        $to = $to;

        // Sender email address
        $from = 'pajak.bankdki@gmail.com';

        // Email subject
        $subject = $subject;

        // Email body
        $body = $body;

        // Compose email data
        $data = [
            'apikey' => $apiKey,
            'to' => $to,
            'from' => $from, // Specify sender email address here
            'subject' => $subject,
            'body' => $body,
        ];

        // Send POST request to Elastic Email API
        $response = json_decode(file_get_contents($url, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($data),
            ],
        ])), true);

        // Check response for success or error
        if ($response && isset($response['success']) && $response['success'] === true) {
            return 'email berhasil terkirim!';
        } else {
            return 'Failed to send email. Error: ' . $response['error'];
        }
    }

    public static function redirectBack()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}"); //redirect back
    }

    public static function download_contoh_lampiran($files = null)
    {
        $file_name = $files; // replace with your file name
        $file_path = "public/storage/contoh_lampiran/" . $file_name; // replace with your file path

        if (file_exists($file_path)) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=' . $file_name);
            header('Pragma: no-cache');
            readfile($file_path);
            Helpers::redirectBack();
        } else {
            header('location: ' . BASEURL . '/pages/pages404');
        }
    }

    public static function download_manual_book($files = null)
    {
        $file_name = $files; // replace with your file name
        $file_path = "public/storage/manual_book/" . $file_name; // replace with your file path

        if (file_exists($file_path)) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=' . $file_name);
            header('Pragma: no-cache');
            readfile($file_path);
            Helpers::redirectBack();
        } else {
            header('location: ' . BASEURL . '/pages/pages404');
        }
    }
}
