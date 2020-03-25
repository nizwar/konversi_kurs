<?php
include 'simple_html_dom.php';

class NizwarKurs
{
    public $webData;
    function __construct()
    {
        $this->webData = file_get_html("https://www.bi.go.id/id/moneter/kalkulator-kurs/Default.aspx");
    }

    function getListOfKurs()
    {
        $kodeSingkatan = $this->webData->find("#KodeSingkatan", 0)->find(".table1", 0)->children;
        $arrOfKurs = $this->webData->find("#ctl00_PlaceHolderMain_biWebKalkulatorKurs_ddlmatauang1", 0)->children;
        array_splice($kodeSingkatan, 0, 1);

        $arrNilaiKurs = array();

        foreach ($arrOfKurs as $item) {
            $expItem = explode(".:.", strtolower($item->value));
            $arrNilaiKurs[trim($expItem[2])] =  trim($expItem[1]) / trim($expItem[0]);
        }

        $arrKepanjangan = array();
        foreach ($kodeSingkatan as $item) {
            $arrKepanjangan[trim(strtolower($item->find("td", 0)->innertext))] =  trim($item->find("td", 1)->innertext);
        }
        $arrOutput = array();
        foreach ($arrNilaiKurs as $key => $val) {
            $arrOutput[] = [
                "kode" => $key,
                "name" => $arrKepanjangan[$key] ?? "Tidak Dimengerti",
                "val" => $val,
            ];
        }

        return $arrOutput;
    }
    function convertKurs($idr, $kurs = "usd")
    {
        $kurs = strtolower(trim($kurs));
        $listKurs = $this->getListOfKurs();
        $value = 0;
        if (array_key_exists($kurs, $listKurs)) {
            $value = $listKurs[$kurs]["val"];
            return $value * $idr;
        } else {
            return -1;
        }
    }

    function getKurs($kurs = "usd")
    {
        $listKurs = $this->getListOfKurs();
        if (array_key_exists($kurs, $listKurs)) {
            $value = $listKurs[$kurs];
            return $value;
        } else {
            return null;
        }
    }
}
