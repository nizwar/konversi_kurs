# API Sederhana Konversi Matauang
Projek php native sederhana untuk melakukan konversi mata uang dengan mengscraping situs Bank Indonesia sebagai acuan nilai matauangnya.

# Simple_Http_Connection
Scrapping dan pengambilan data menggunakan [simple_http_connection](https://simplehtmldom.sourceforge.io)

## API
### Daftar Kurs
_Request_

`https://nkurs.herokuapp.com/`

_Response_

`
"success": true,
  "data": [
    {
      "kode": "aud",
      "name": "AUSTRALIAN DOLLAR",
      "val": 10086.29
    },
    {...}
  ]
`

### Konversi
_Params_
* val = Angka yang akan dikonversi
* kurs = Kurs yang akan dikonversi

_Request_

`https://nkurs.herokuapp.com/?val=1&kurs=usd`

_Response_

`{
  "success": true,
  "kurs": {
    "name": "US DOLLAR",
    "val": 16986
  },
  "result": 16986
}`



## Tentang Saya 
<p align="center">
  <img width="200px" height="200px" src="https://1.bp.blogspot.com/-JYoVTVvNti8/XD14Y5j6spI/AAAAAAAAC5Q/UOZ0mnILQost96u_VMwnWc61wz60k3zJQCPcBGAYYCw/s500-cc/Nizwar-ID-Header-Background.JPG"/>  
  <br/>
<label>Hanya manusia biasa yang suka makan coklat</label>
  </p>

  > Tinggalkan notice sebelum mendistribusikan ulang kode sumber ini gaes...
  > silahkan email ke [Nizwar@merahputih.id](mailto:nizwar@merahputih.id) 😄😁

