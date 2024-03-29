<?php

class NotifikasiModel
{


    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function kirimLampiran($data)
    {

        $target_dir = "public/storage/lampiran/";
        $target_file = $target_dir . time() . basename($_FILES["lampiran"]["name"]);

        $id_notifikasi = $data['id_notifikasi'];
        $file = $target_file;

        $cekLampiran = "SELECT * FROM lampiran WHERE id_notifikasi = '$id_notifikasi'";
        $this->db->query($cekLampiran);
        $resultLampiran = $this->db->single();


        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            return "maaf file telah ada.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["lampiran"]["size"] > 5000000) {
            return "maaf file terlalu besar ( max 5bm ).";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($fileType != "xls" && $fileType != "xlsx") {
            return "maaf hanya bisa upload excel saja.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            return "Sorry, terjadi kesalahan.";
        } else {
            if (move_uploaded_file($_FILES["lampiran"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO lampiran (id_notifikasi, file)
                VALUES ('$id_notifikasi', '$file')";
                $this->db->query($query);
                $this->db->execute();
                $this->db->rowCount();
                return " file " . basename($_FILES["lampiran"]["name"]) . " berhasil di upload.";
            } else {
                return "Sorry, ada masalah.";
            }
        }
    }

    // public function kirimLampiran($data)
    // {

    //     $target_dir = "public/storage/lampiran/";
    //     $target_file = $target_dir . time() . basename($_FILES["lampiran"]["name"]);

    //     $id_notifikasi = $data['id_notifikasi'];
    //     $file = $target_file;

    //     $cekLampiran = "SELECT * FROM lampiran WHERE id_notifikasi = '$id_notifikasi'";
    //     $this->db->query($cekLampiran);
    //     $resultLampiran = $this->db->single();


    //     if (!$resultLampiran) {

    //         $uploadOk = 1;
    //         $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //         // Check if file already exists
    //         if (file_exists($target_file)) {
    //             return "maaf file telah ada.";
    //             $uploadOk = 0;
    //         }

    //         // Check file size
    //         if ($_FILES["lampiran"]["size"] > 5000000) {
    //             return "maaf file terlalu besar ( max 5bm ).";
    //             $uploadOk = 0;
    //         }

    //         // Allow certain file formats
    //         if ($fileType != "xls" && $fileType != "xlsx") {
    //             return "maaf hanya bisa upload excel saja.";
    //             $uploadOk = 0;
    //         }

    //         if ($uploadOk == 0) {
    //             return "Sorry, terjadi kesalahan.";
    //         } else {
    //             if (move_uploaded_file($_FILES["lampiran"]["tmp_name"], $target_file)) {
    //                 $query = "INSERT INTO lampiran (id_notifikasi, file)
    //                 VALUES ('$id_notifikasi', '$file')";
    //                 $this->db->query($query);
    //                 $this->db->execute();
    //                 $this->db->rowCount();
    //                 return " file " . basename($_FILES["lampiran"]["name"]) . " berhasil di upload.";
    //             } else {
    //                 return "Sorry, ada masalah.";
    //             }
    //         }
    //     } else {
    //         return 'sudah ada lampiran untuk notif ini';
    //     }
    // }

    public function store($data)
    {


        $selected = $data['selectedOptions'];
        $bulan = $data['bulan'];
        $selectedArr = explode(',', $selected);
        foreach ($selectedArr as $row) {
            $idCabang = explode('-', $row)[0];
            $id_pajak = $data['id_pajak'];
            $deadline = $data['deadline'];
            $cabang = $idCabang;
            if ($idCabang != 'deselect') {
                $query = "INSERT INTO notifikasi (id_pajak, deadline, id_user, bulan)
            VALUES ('$id_pajak', '$deadline', '$cabang', '$bulan')";
                $this->db->query($query);
                $this->db->execute();
            }
        }

        return $this->db->rowCount();
    }

    public function update($data)
    {
        $id_pajak = $data['id_pajak'];
        $deadline = $data['deadline'];
        $cabang = $data['cabang'];
        $id = $data['id'];
        $query = "UPDATE notifikasi
        SET id_pajak = '$id_pajak',
            deadline = '$deadline',
            id_user = '$cabang'
        WHERE id = '$id'";

        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($data)
    {
        $id = $data['delete'];

        $query = "DELETE FROM notifikasi WHERE id = '$id' ";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function get()
    {
        $notifikasi = "SELECT * FROM notifikasi";
        $this->db->query($notifikasi);
        return $this->db->resultSet();
    }

    public function getCabang($bulan)
    {
        $notifikasi = "SELECT * FROM notifikasi join users on notifikasi.id_user = users.id where users.role = 'cabang' and notifikasi.bulan = '$bulan'";
        $this->db->query($notifikasi);
        return $this->db->resultSet();
    }

    public function getByMonth($bulan)
    {
        $notifikasi = "SELECT * FROM notifikasi WHERE bulan = '$bulan'";
        $this->db->query($notifikasi);
        return $this->db->resultSet();
    }

    public function getFiltered($filter, $tglAwal = null, $tglAkhir = null)
    {
        if ($tglAwal == null && $tglAkhir == null) {
            $notifikasi = "SELECT * FROM notifikasi JOIN users ON notifikasi.id_user = users.id where users.role = '$filter'";
        } else {
            $notifikasi = "SELECT * FROM notifikasi JOIN users ON notifikasi.id_user = users.id where users.role = '$filter' AND deadline BETWEEN '$tglAwal' AND '$tglAkhir'";
        }

        $this->db->query($notifikasi);
        return $this->db->resultSet();
    }

    public function getPerCabang($idCabang)
    {

        $notifikasi = "SELECT * FROM notifikasi WHERE id_user = '$idCabang'";
        $this->db->query($notifikasi);
        return $this->db->resultSet();
    }

    public function getPerJenis($id_pajak, $tglAwal = null, $tglAkhir = null)
    {

        if ($tglAwal == null && $tglAkhir == null) {
            $notifikasi = "SELECT * FROM notifikasi WHERE id_pajak = '$id_pajak'";
        } else {
            $notifikasi = "SELECT * FROM notifikasi WHERE id_pajak = '$id_pajak' AND deadline BETWEEN '$tglAwal' AND '$tglAkhir'";
        }

        $this->db->query($notifikasi);
        return $this->db->resultSet();
    }

    public function show($id)
    {
        $notifikasi = "SELECT * FROM notifikasi WHERE id = '$id'";
        $this->db->query($notifikasi);
        return $this->db->single();
    }

    public function terima($data)
    {
        $id = $data['terima'];
        $query = "UPDATE notifikasi
        SET verifikasi = '1',
            alasan = ''
        WHERE id = '$id'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tolak($data)
    {

        $id = $data['id'];
        $alasan = $data['alasan'];

        $queryNotif = "SELECT * FROM notifikasi WHERE id = '$id'";
        $this->db->query($queryNotif);
        $resultNotif = $this->db->single();
        $recipient = NotifikasiOrm::cabang($resultNotif['id_user'])['email'];
        $body = 'file lampiran di tolak karena ' . $alasan;
        $query = "UPDATE notifikasi
        SET verifikasi = '2',
            alasan = '$alasan'
        WHERE id = '$id'";
        $this->db->query($query);
        $this->db->execute();

        $body = urlencode($body);

        $scriptId = "AKfycbzupui2Dea8ucTQ9TQmnIuekHcTvegeAC5caABAmp8MsZgJbrqATuncCGNKdCJ1z3HrGA";
        $apiUrl = "https://script.google.com/macros/s/AKfycbyheiuwVuSHCZ1N2UZ5dLp8QQRC-Y3vdpj465u9RIvJjs1TKGWFYZtl1rb6m7LC_XldeA/exec?recipient={$recipient}&body={$body}";

        $response = file_get_contents($apiUrl);

        return $this->db->rowCount();
    }

    public function reset($data)
    {
        $id = $data['reset'];
        $query = "UPDATE notifikasi
        SET verifikasi = '0'
        WHERE id = '$id'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function email($data)
    {

        $data = json_decode($_POST['email'], true);

        $id = $data['id'];
        $pajak = NotifikasiOrm::pajak($data['id_pajak'])['nama_pajak'];
        $lampiran = NotifikasiOrm::pajak($data['id_pajak'])['lampiran'];
        $deadline = $data['deadline'];
        $recipient = NotifikasiOrm::cabang($data['id_user'])['email'];

        // Email body
        // $body = 'Tolong upload ' . $lampiran . ' sebelum ' . $deadline;
        $body = 'Pengisian ' . $pajak . ' Cabang.' . PHP_EOL . PHP_EOL;
        $body .= 'Salam.' . PHP_EOL;
        $body .= 'Kepada yang terhormat Bapak/Ibu.' . PHP_EOL;
        $body .= 'Kami dari Departemen Perpajakan Korporasi Grup Akuntansi dan Keuangan, dengan ini mohon kepada Bapak/Ibu agar segera melaporkan daftar ' . $pajak . ' Cabang ke dalam website E-TAX. Terima kasih.' . PHP_EOL . PHP_EOL;
        $body .= 'Notes: NIK wajib disi apabila tidak memiliki NPWP.' . PHP_EOL . PHP_EOL;
        $body .= 'Salam hormat,' . PHP_EOL;
        $body .= 'Dept. Perpajakan Korporasi' . PHP_EOL;
        $body .= 'Grup Akuntansi dan Keuangan' . PHP_EOL;
        $body .= 'Jl. Suryopranoto No. 8 Lt.6' . PHP_EOL;
        $body .= 'Jakarta Pusat (10130)' . PHP_EOL;

        $body = urlencode($body);

        $scriptId = "AKfycbzupui2Dea8ucTQ9TQmnIuekHcTvegeAC5caABAmp8MsZgJbrqATuncCGNKdCJ1z3HrGA";
        $apiUrl = "https://script.google.com/macros/s/AKfycbyheiuwVuSHCZ1N2UZ5dLp8QQRC-Y3vdpj465u9RIvJjs1TKGWFYZtl1rb6m7LC_XldeA/exec?recipient={$recipient}&body={$body}";

        $response = file_get_contents($apiUrl);

        // Check response for success or error
        if ($response) {
            $query = "UPDATE notifikasi
            SET email_sended = '1'
            WHERE id = '$id'";
            $this->db->query($query);
            $this->db->execute();
            return 'email berhasil terkirim!';
        } else {
            $query = "UPDATE notifikasi
            SET email_sended = '1'
            WHERE id = '$id'";
            $this->db->query($query);
            $this->db->execute();
            // return 'Failed to send email. Error: ' . $response['error'];
            return 'email berhasil terkirim!';
        }
    }

    // public function email($data)
    // {
    //     // LINK APPSCRIPT https://script.google.com/macros/s/AKfycbyheiuwVuSHCZ1N2UZ5dLp8QQRC-Y3vdpj465u9RIvJjs1TKGWFYZtl1rb6m7LC_XldeA/exec

    //     $data = json_decode($_POST['email'], true);

    //     $id = $data['id'];
    //     $pajak = NotifikasiOrm::pajak($data['id_pajak'])['nama_pajak'];
    //     $lampiran = NotifikasiOrm::pajak($data['id_pajak'])['lampiran'];
    //     $deadline = $data['deadline'];
    //     $emailUser = NotifikasiOrm::cabang($data['id_user'])['email'];


    //     // API endpoint for sending email
    //     $url = 'https://api.elasticemail.com/v2/email/send';

    //     // Your Elastic Email API key
    //     $apiKey = '0C8B93672DEFD79E0087B28C5CF054653F46EF25330851E40CE966BDC7BFF8A8E69C3BA783366143A8AE0ED002590D56';

    //     // Recipient email address
    //     $to = $emailUser;

    //     // Sender email address
    //     $from = 'info@samtam.tech';

    //     // Email subject
    //     $subject = 'Notifikasi upload lampiran untuk ' . $pajak;

    //     // Email body
    //     // $body = 'Tolong upload ' . $lampiran . ' sebelum ' . $deadline;
    //     $body = 'Pengisian ' . $pajak . ' Cabang.<br><br>';
    //     $body .= 'Salam.<br>';
    //     $body .= 'Kepada yang terhormat Bapak/Ibu.<br>';
    //     $body .= 'Kami dari Departemen Perpajakan Korporasi Grup Akuntansi dan Keuangan, dengan ini mohon kepada Bapak/Ibu agar segera melaporkan daftar ' . $pajak . ' Cabang ke dalam website E-TAX. Terima kasih.<br><br>';
    //     $body .= 'Notes: NIK waiib disi apabila tidak memiliki NPWP.<br><br>';
    //     $body .= 'Salam hormat,<br>';
    //     $body .= 'Dept. Perpajakan Korporasi <br>';
    //     $body .= 'Grup Akuntansi dan Keuangan <br>';
    //     $body .= 'Jl. Suryopranoto No. 8 Lt.6 <br>';
    //     $body .= 'Jakarta Pusat (10130)<br>';


    //     // Compose email data
    //     $data = [
    //         'apikey' => $apiKey,
    //         'to' => $to,
    //         'from' => $from, // Specify sender email address here
    //         'subject' => $subject,
    //         'body' => $body,
    //     ];

    //     // Send POST request to Elastic Email API
    //     $response = json_decode(file_get_contents($url, false, stream_context_create([
    //         'http' => [
    //             'method' => 'POST',
    //             'header' => 'Content-Type: application/x-www-form-urlencoded',
    //             'content' => http_build_query($data),
    //         ],
    //     ])), true);

    //     // Check response for success or error
    //     if ($response && isset($response['success']) && $response['success'] === true) {
    //         $query = "UPDATE notifikasi
    //         SET email_sended = '1'
    //         WHERE id = '$id'";
    //         $this->db->query($query);
    //         $this->db->execute();
    //         return 'email berhasil terkirim!';
    //     } else {
    //         return 'Failed to send email. Error: ' . $response['error'];
    //     }
    // }

    public function emails($data)
    {

        $dataEmail = [];
        foreach ($data['email'] as $key => $value) {
            $dataEmail[] = json_decode($value, true);
        }

        foreach ($dataEmail as $key => $row) {
            $id = $row['id'];
            $pajak = NotifikasiOrm::pajak($row['id_pajak'])['nama_pajak'];
            $lampiran = NotifikasiOrm::pajak($row['id_pajak'])['lampiran'];
            $deadline = $row['deadline'];
            $emailUser = NotifikasiOrm::cabang($row['id_user'])['email'];

            // Email body
            // $body = 'Tolong upload ' . $lampiran . ' sebelum ' . $deadline;
            $body = 'Pengisian ' . $pajak . ' Cabang.' . PHP_EOL . PHP_EOL;
            $body .= 'Salam.' . PHP_EOL;
            $body .= 'Kepada yang terhormat Bapak/Ibu.' . PHP_EOL;
            $body .= 'Kami dari Departemen Perpajakan Korporasi Grup Akuntansi dan Keuangan, dengan ini mohon kepada Bapak/Ibu agar segera melaporkan daftar ' . $pajak . ' Cabang ke dalam website E-TAX. Terima kasih.' . PHP_EOL . PHP_EOL;
            $body .= 'Notes: NIK wajib disi apabila tidak memiliki NPWP.' . PHP_EOL . PHP_EOL;
            $body .= 'Salam hormat,' . PHP_EOL;
            $body .= 'Dept. Perpajakan Korporasi' . PHP_EOL;
            $body .= 'Grup Akuntansi dan Keuangan' . PHP_EOL;
            $body .= 'Jl. Suryopranoto No. 8 Lt.6' . PHP_EOL;
            $body .= 'Jakarta Pusat (10130)' . PHP_EOL;

            $body = urlencode($body);

            $scriptId = "AKfycbzupui2Dea8ucTQ9TQmnIuekHcTvegeAC5caABAmp8MsZgJbrqATuncCGNKdCJ1z3HrGA";
            $apiUrl = "https://script.google.com/macros/s/AKfycbyheiuwVuSHCZ1N2UZ5dLp8QQRC-Y3vdpj465u9RIvJjs1TKGWFYZtl1rb6m7LC_XldeA/exec?recipient={$emailUser}&body={$body}";

            $response = file_get_contents($apiUrl);


            $query = "UPDATE notifikasi
            SET email_sended = '1'
            WHERE id = '$id'";
            $this->db->query($query);
            $this->db->execute();
            Helpers::sendEmail($pajak, $emailUser, $body);
        }
        echo "berhasil";
    }
}
