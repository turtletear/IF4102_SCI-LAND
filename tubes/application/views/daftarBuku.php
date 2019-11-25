<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Daftar Buku Tersedia</title>
  </head>
  <style media="screen">
     body { background-color: #E2F0F1; }
    .atas { height: 100px;
            background-color: #00A8A8;
            width: 60%;
            padding-top: 3px;
            margin-left: 20%;
            margin-top: 5px;}
    img { height : 200px;
          width : 190px; }
    table { margin-left : 20%;
            background-color: white;
            width : 60%; }
    td { padding-left : 20px;
         padding-right : 20px; }
    button { background-color: #00A8A8;
            color: white;
            border-radius: 3px;
            padding: 5px;
            width: 70px;
            height: 45px;
            font-size: 10px; }
    button:hover { cursor: pointer;
           background-color: #13326D; }
    h1 {color: white; }
  </style>
  <body>
    <div class="atas">
        <h1><center>Daftar Buku Tersedia</center></h1>
    </div>
    <table>
      <tr>
        <td> <img src="<?php echo base_url();?>src/nkcthi.jpg"></td>
        <td style="font-size:16px;"> Nanti Kita Cerita Tentang Hari Ini </td>
        <td> <button type="button">Lihat Detail</button> </td>
      </tr>
      <tr>
        <td> <img src="<?php echo base_url();?>src/seni.jpg"></td>
        <td style="font-size:16px;"> Sebuah Seni Untuk Bersikap Bodo Amat </td>
        <td> <button type="button">Lihat Detail</button></td>
      </tr>
      <tr>
        <td> <img src="<?php echo base_url();?>src/tboa.jpg"></td>
        <td style="font-size:16px;"> The Book of Almost </td>
        <td> <button type="button">Lihat Detail</button></td>
      </tr>
    </table>
  </body>
</html>