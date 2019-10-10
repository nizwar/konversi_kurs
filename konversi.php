<?php
include 'simple_html_dom.php';

//Output yang dihasilkan berupa Array
function getListOfKurs()
{
    //Ambil script html dari BI untuk discrapping
    $webData = file_get_html("https://www.bi.go.id/id/moneter/kalkulator-kurs/Default.aspx");
    //Petakan id yang mengandung informasi kurs
    $idOfKurs = $webData->find("#ctl00_PlaceHolderMain_biWebKalkulatorKurs_ddlmatauang1");
    //Children (array) dari idKurs yang dipetakan diatas, 
    //ID berupa Select (array), maka Childrennya adalah Option (array)
    $arrOfKurs = $idOfKurs[0]->children;

    //Inisialisasi output
    $arrOutput = array();

    //lakukan pengulangan dari array kurs yang didapatkan
    foreach ($arrOfKurs as $item) {
        //Split dengan simbol '.:.', sesuai dengan script diwebnya (dia ngesplit pake itu)
        //Value adalah nilai dari Attrb Value dalam Tag Option
        //Menggunakan strtolower agar muda untuk diserupakan dengan parameter fungsi convertKurs
        $expItem = explode(".:.", strtolower($item->value));
        //Isi array dengan informasi, bisa dilihat di JS web tsbt
        $arrOutput[trim($expItem[2])] = trim($expItem[1]) / trim($expItem[0]);
    }
    //Return
    return $arrOutput;
}

//Konversi Kurs, dengan memasukan Rupiah ($idr) dan Mata Uang ($kurs, default USD) 
function convertKurs($idr, $kurs = "usd")
{
    //Konversi matauang menjadi tulisan kecil (Lowercase)
    $kurs = strtolower(trim($kurs));
    //Mengambil array kurs dengan memanggil getListOfKurs
    $listKurs = getListOfKurs();
    //Inisialisasi nilai dari matauang (Value Option/Array listKurs)
    $value = 0;
    //Melakukan pengecekan Key array
    if (array_key_exists($kurs, $listKurs)) {
        //Jika sesuai, ambil value $listKurse dengan Key $kurs (parameter)
        $value = $listKurs[$kurs];
        //Mengembalikan data dengan melakukan perhitungan
        //value (mata uang) x nilai rupiah (parameter)
        return $value * $idr;
    } else {
        //Jika tidak ada, return dengan String
        return "Kurs tidak valid";
    }
}

//Perlihatkan isi data dari getListOfKurs berupa JSON
echo json_encode(getListOfKurs());
//Perlihatkan hasil perhitungan KURS 
echo "\n";
//Parameter = (Nilai IDR, Kode Matauang)
echo convertKurs(1000, "nok");
