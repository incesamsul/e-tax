<?php

class Ajax extends Controller
{

    public function index()
    {
        $data['judul'] = 'print';
        $data['costumer'] = $this->model('Costumer_model')->getCostumerById($_POST['costumerId']);
        $this->view('ajax/index', $data);
    }

    public function getPekerjaanTeknisiByNama()
    {
        $dataPekerjaan = $this->model("Teknisi_model")->prosesGetPekerjaanTeknisiByNama($_POST['teknisi']);
        echo json_encode($dataPekerjaan);
    }

    public function getAllData()
    {
        $bulan = $_POST['bulan'];
        echo json_encode($this->getDataPer($bulan));
    }

    public function getStatisticData()
    {
        $januari = $this->getDataPer('01');
        $februari = $this->getDataPer('02');
        $maret = $this->getDataPer('03');
        $april = $this->getDataPer('04');
        $may = $this->getDataPer('05');
        $june = $this->getDataPer('06');
        $july = $this->getDataPer('07');
        $allMonth = [
            "januari" => $januari,
            "februari" => $februari,
            "maret" => $maret,
            "april" => $april,
            "may" => $may,
            "june" => $june,
            "july" => $july
        ];
        echo json_encode($allMonth);
    }

    public function perkembanganBulanan()
    {
        $januari = $this->getDataPer('01');
        $februari = $this->getDataPer('02');
        $amountOfChange = $februari['servisanOke'] - $januari['servisanOke'];
        $lastMontMeasurement = $amountOfChange / $januari['servisanOke'];
        $presentage = $lastMontMeasurement * 100;
        echo $presentage;
    }

    public function getDataPer($bulan)
    {
        $dataServisan = $this->model('Servisan_model')->getAllRingkasServisan();
        $servisanPerbulan = [];
        $servisanBerhasilPerbulan = [];
        $servisanBatalPerbulan = [];
        $servisanKeluarPerbulan = [];
        $dataServisan = $this->model('Servisan_model')->getAllRingkasServisan();
        foreach ($dataServisan as $ds) {
            $bulanServisan = date('m', $ds['tgl_masuk']);
            if ($bulanServisan == $bulan) {
                $servisanPerbulan[] = $ds;
            }
            if ($bulanServisan == $bulan && $ds['kondisi_servisan'] == "Berhasil") {
                $servisanBerhasilPerbulan[] = $ds;
            }
            if ($bulanServisan == $bulan && $ds['kondisi_servisan'] == "Batal") {
                $servisanBatalPerbulan[] = $ds;
            }
            if ($bulanServisan == $bulan && $ds['tgl_keluar'] != 0) {
                $servisanKeluarPerbulan[] = $ds;
            }
        }
        $servisanTidakTerdata =  count($servisanKeluarPerbulan) - (count($servisanBerhasilPerbulan) + count($servisanBatalPerbulan));
        $laporanData = [
            "servisanOke" => count($servisanBerhasilPerbulan),
            "servisanBatal" => count($servisanBatalPerbulan),
            "servisanKeluar" => count($servisanKeluarPerbulan),
            "totalServisan" => count($servisanPerbulan),
            "servisanTidakTerdata" => $servisanTidakTerdata
        ];
        return $laporanData;
    }
}
