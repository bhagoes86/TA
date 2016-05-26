<?php 
 /*----------------------------------------------------------------------------*\
 |                                                                              |
 |   Nama File   : server.js                                                    |
 |   Pengembang  : Aranda Rizki Soedjono                                        |
 |                 Febryan Yeremi Sianipar                                      |
 |   Deskripsi   :                                                              |
 |     File ini berisi query-query yang bertugas mengkases database MySQL       |
 |                                                                              |
 \*----------------------------------------------------------------------------*/ 

header('Access-Control-Allow-Origin: *');

if(isset($_GET['type'])) {
  
  /*--------------------*\
  |*  Koneksi Database  *|
  \*--------------------*/
    
    $host = "localhost";        // lokasi database
    $user = "root";             // nama username
    $pass = "";                 // password database
    $dbname = "sim_stranas";       // nama database yang digunakan

    $mysqli = new mysqli("$host", "$user", "$pass","$dbname");
  
  /*------------------------------------------------------------------------*\  
  |*                               LOGIN PAGE                               *|
  \*------------------------------------------------------------------------*/

  /*----------------\
  |  Login Handler  |
  \-----------------/--------------------------------------------------------\
  |                                                                          |
  |   1. Digunakan sebagai user validation                                   |
  |   2. Informasi yang diperiksa adalah :                                   |
  |     - No. Telp ibu balita                                                |
  |     - Password                                                           |
  |     (informasi ini didapat ketika ibu balita mendaftar ke posyandu)      |
  |   3. Hasil dari fungsi ini adalah "NO_KTP" yang akan digunakan sebagai   |
  |      ID ibu selama menggunakan aplikasi                                  | 
  |                                                                          |
  \-------------------------------------------------------------------------*/
    
    if ( $_GET['type'] == "isuserexist" ) {
      $query = "select
                  count(*) AS rownum,
                  user.NO_KTP AS NO_KTP
                from
                  TABLEUSER as user,
                  IBU_BALITA as ibu
                where
                  ibu.TELP_IBU = '" . $_GET['ID'] . "' and
                  user.PASSWORD = '" . $_GET['pass'] . "' and
                  user.NO_KTP is not NULL
                ";

      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      if ( $row['rownum'] > 0 ) {
          $output = array('status' => true, 'session' => $row['NO_KTP']);
          echo json_encode( $output );
        }
      else {
        $output = array('status' => false);
        echo json_encode( $output );
      }
    }
        /*----------------\
        |  CATATAN LOGIN  |
        \-----------------/----------------------------------------------------------------------\
        |                                                                                        |
        |   1. Masukkan query ini jika login bisa dilakukan dengan menggunakan email             |
        |     - user.EMAIL = '" . $_GET['ID'] . "' ) and ->                                      |
        |                                                                                        |
        |   2. Lakukan hal berikut jika ibu PKK bisa akses lewat ePosyandu                       |
        |     - Hapus statement "NO_KTP is not NULL"                                             |
        |     - Aktifkan statement berikut :                                                     |
        |                                                                                        |
        |         if ( $row['rownum'] > 0 ) {                                                    |
        |           if( $row['NO_KTP'] == NULL ) {                                               |
        |             $output = array('status' => true, 'session' => $row['NO_KTP_IBU_PKK']);    |
        |             echo json_encode( $output );                                               |
        |           }                                                                            |
        |           else                                                                         |
        |           {                                                                            |
        |             $output = array('status' => true, 'session' => $row['NO_KTP']);            |
        |             echo json_encode( $output );                                               |
        |           }                                                                            |
        |         }                                                                              |
        |                                                                                        |
        \---------------------------------------------------------------------------------------*/

  else
  
  /*---------------------\
  |  Update Umur Balita  |
  \----------------------/---------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk update usia balita secara otomatis ketika membuka   |
  |      aplikasi. Nantinya digunakan untuk menentukan anak ibu masih        |
  |      balita atau sudah melewati balita                                   |
  |   2. Dalam hal ini masih menghitung usia balita berdasarkan perbedaan    |
  |      bulan dan tahun kelahiran                                           |
  |   3. Hasil dari fungsi ini adalah usia balita dalam ukuran bulan         |
  |                                                                          |
  \-------------------------------------------------------------------------*/
  
    if($_GET['type'] == "updateUmurBalita") {
      $query = "select 
                  TGL_LAHIR, 
                  ID_BALITA
                from  
                  BALITA 
                "; 
      $result = mysqli_query( $mysqli, $query);
      while($row = mysqli_fetch_array($result))
      {
        $simpan = $mysqli->query("UPDATE BALITA SET UMUR_BALITA = TIMESTAMPDIFF(MONTH, '" . $row['TGL_LAHIR'] . "', CURDATE()) WHERE ID_BALITA = '" . $row['ID_BALITA'] . "'");
      }
    }

  else

  /*------------------------------------------------------------------------*\
  |*                                MAIN PAGE                               *|
  \*------------------------------------------------------------------------*/
 
  /*---------------------------\
  |  Menampilkan Pilihan Anak  |
  \----------------------------/---------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan pilihan anak sesuai ID ibu              |
  |   2. Hasil dari fungsi ini adalah nama anak sesuai ID ibu                |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "pilihAnak" ) {
      $query = "select
                  balita.NAMA_BALITA AS NAMA_BALITA,
                  balita.ID_BALITA AS ID_BALITA,
                  balita.UMUR_BALITA AS UMUR_BALITA
                from
                  BALITA balita,
                  IBU_BALITA ibu
                where
                  balita.NO_KTP = '" . $_GET['session'] . "' and
                  ibu.NO_KTP = '" . $_GET['session'] . "' 
                order by
                  balita.TGL_LAHIR asc
                ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"anak":' . json_encode( $var ) . '}';
    }
  
  else

  /*--------------------\
  |  Mengambil ID Anak  |
  \---------------------/----------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk mengambil ID anak sesuai ID ibu                     |
  |   2. Hasil dari fungsi ini adalah ID anak sesuai ID ibu                  |
  |                                                                          |
  \-------------------------------------------------------------------------*/


     if ( $_GET['type'] == "ambilAnak" ) {
      $query = "select
                  ID_BALITA,
                  UMUR_BALITA
                from
                  BALITA
                where
                  ID_BALITA = '" . $_GET['id'] . "'
                ";
      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      $output = array('status' => true, 'idAnak' => $row['ID_BALITA'], 'umur' => $row['UMUR_BALITA']);
      echo json_encode( $output );
    }

  else 

  /*------------------------------\
  | Menampilkan Pilihan Posyandu  |
  \-------------------------------/------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan pilihan posyandu dalam database         |
  |   2. Hasil dari fungsi ini adalah nama posyandu dalam database           |
  |                                                                          |
  \-------------------------------------------------------------------------*/
  
    if($_GET['type'] == "tampilPosyandu" ) {
      $query = "select
                  ID_POSYANDU,
                  NAMA_POSYANDU  
                from
                  POSYANDU
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"posyandu":' . json_encode( $var ) . '}';
    }

  else
  
  /*---------------------\
  |  Menambah Data Anak  |
  \----------------------/---------------------------------------------------\
  |                                                                          |
  |  1. Digunakan untuk menambah informasi data anak yang baru               |
  |  2. Informasi yang perlu dimasukkan adalah :                             |
  |    - Nama anak                                                           |
  |    - Nomor KK                                                            |
  |    - Jenis kelamin                                                       |
  |    - Tanggal lahir (tanggal, bulan, tahun)                               |
  |    - Berat badan lahir                                                   |
  |    - Tinggi badan lahir                                                  |
  |    - Nama ayah                                                           |
  |    - Pekerjaan ayah                                                      |
  |    - Pekerjaan ibu                                                       |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "tambahData") {
      $namaAnak = mysql_real_escape_string($_GET["namaAnak"]);
      $nomorKK = mysql_real_escape_string($_GET["nomorKK"]);
      $JK = mysql_real_escape_string($_GET["JK"]);
      $tanggalLahir = mysql_real_escape_string($_GET["tanggalLahir"]);
      $bulanLahir = mysql_real_escape_string($_GET["bulanLahir"]);
      $tahunLahir = mysql_real_escape_string($_GET["tahunLahir"]);
      $anakKe = mysql_real_escape_string($_GET["anakKe"]);
      $beratBadanLahir = mysql_real_escape_string($_GET["beratBadanLahir"]);
      $panjangBadanLahir = mysql_real_escape_string($_GET["panjangBadanLahir"]);
      $ayah = mysql_real_escape_string($_GET["ayah"]);
      $pekerjaanAyah = mysql_real_escape_string($_GET["pekerjaanAyah"]);
      $pekerjaanIbu = mysql_real_escape_string($_GET["pekerjaanIbu"]);
      // $status = mysql_real_escape_string($_GET["status"]);
     
      $tanggalLahirAnak= date("$tahunLahir-$bulanLahir-$tanggalLahir");

      $result = $mysqli->query("INSERT INTO BALITA (`ID_BALITA`, `NO_KTP`, `NO_KK_BALITA`, `NAMA_BALITA`, `JNS_KELAMIN`, `ANAK_KE`, `TGL_LAHIR`, `TGL_DAFTAR`, `TB_LAHIR`, `BB_LAHIR`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `PEKERJAAN_IBU`) 
                              VALUES (' ', '" . $_GET['session'] . "', '$nomorKK', '$namaAnak', '$JK', '$anakKe', '$tanggalLahirAnak', CURDATE(), '$panjangBadanLahir', '$beratBadanLahir', '$ayah', '$pekerjaanAyah', '$pekerjaanIbu')"); 
    }

  else

  /*------------------------------------------------------------------------*\
  |*                          HALAMAN DATA ANAK                             *|
  \*------------------------------------------------------------------------*/

  /*-------------------------------\
  |  Menampilkan Detail Data Anak  |
  \--------------------------------/-----------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan detail data anak                        |
  |   2. Hasil dari fungsi ini adalah detail data anak                       |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "tampilDataAnak" ) {
      $query = "select
                  balita.NAMA_BALITA AS NAMA_BALITA,
                  balita.JNS_KELAMIN AS JNS_KELAMIN,
                  extract(day from balita.TGL_LAHIR) AS TANGGAL_LAHIR,
                  extract(month from balita.TGL_LAHIR) AS BULAN_LAHIR,
                  extract(year from balita.TGL_LAHIR) AS TAHUN_LAHIR,
                  balita.TB_LAHIR AS TB_LAHIR,
                  balita.BB_LAHIR AS BB_LAHIR,
                  balita.NAMA_AYAH AS NAMA_AYAH,
                  balita.PEKERJAAN_AYAH AS PEKERJAAN_AYAH,
                  balita.PEKERJAAN_IBU AS PEKERJAAN_IBU,
                  ibu.NAMA_IBU AS NAMA_IBU
                from
                  BALITA balita,
                  IBU_BALITA ibu
                where
                  balita.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  balita.NO_KTP = '" . $_GET['session'] . "' and
                  ibu.NO_KTP = '" . $_GET['session'] . "'
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"dataAnak":' . json_encode( $var ) . '}';
    }

  else 

  /*----------------------------------\
  |  Menampilkan Form Ubah Data Anak  |
  \-----------------------------------/--------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk mengambil detail data balita yang akan diubah       |
  |   2. Hasil dari fungsi ini adalah detail data balita                     |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "ubahAnak") {
      $query = "select
                  *,
                  extract(day from TGL_LAHIR) AS TGL_LAHIR,
                  extract(month from TGL_LAHIR) AS BLN_LAHIR,
                  extract(year from TGL_LAHIR) AS THN_LAHIR
                from
                  BALITA
                where
                  ID_BALITA = '" . $_GET['idAnak'] . "'
                ";
      $result = mysqli_query( $mysqli, $query );

      $var = array();

        while ( $obj = mysqli_fetch_object( $result ) ) {
          $var[] = $obj;
          }

      echo '{"ubah":' . json_encode( $var ) . '}';
    } 

  else

  /*-------------------\
  |  Update Data Anak  |
  \--------------------/-----------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk update data balita yang akan diubah                 |
  |   2. Informasi yang perlu dimasukkan sama seperti saat akan menambah     |
  |      data anak baru                                                      |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "ubahData") {
       $namaAnak = mysql_real_escape_string($_GET["namaAnak"]);
       $nomorKK = mysql_real_escape_string($_GET["nomorKK"]);
       $nomorKTP =  mysql_real_escape_string($_GET["session"]);;
       $JK = mysql_real_escape_string($_GET["JK"]);
       $tanggalUbah = mysql_real_escape_string($_GET["tanggalUbah"]);
       $bulanUbah= mysql_real_escape_string($_GET["bulanUbah"]);
       $tahunUbah = mysql_real_escape_string($_GET["tahunUbah"]);
       $anakKe = mysql_real_escape_string($_GET["anakKe"]);
       $beratBadanLahir = mysql_real_escape_string($_GET["beratBadanLahir"]);
       $panjangBadanLahir = mysql_real_escape_string($_GET["panjangBadanLahir"]);
       $ayah = mysql_real_escape_string($_GET["ayah"]);
       $pekerjaanAyah = mysql_real_escape_string($_GET["pekerjaanAyah"]);
       $pekerjaanIbu = mysql_real_escape_string($_GET["pekerjaanIbu"]);
       
       $tanggalUbahData = date("$tahunUbah-$bulanUbah-$tanggalUbah");

       $result = $mysqli->query(" UPDATE BALITA SET NO_KK_BALITA = '$nomorKK', NAMA_BALITA = '$namaAnak', JNS_KELAMIN = '$JK', ANAK_KE = '$anakKe', TGL_LAHIR = '$tanggalUbahData', TGL_DAFTAR = 'CURDATE()', TB_LAHIR = '$panjangBadanLahir', BB_LAHIR = '$beratBadanLahir', NAMA_AYAH = '$ayah', PEKERJAAN_AYAH = '$pekerjaanAyah', PEKERJAAN_IBU = '$pekerjaanIbu' WHERE ID_BALITA = '" . $_GET['idAnak'] . "'");
    }

  else

  /*------------------------------------------------------------------------*\
  |*                      HALAMAN GRAFIK / ISI KMS                          *|
  \*------------------------------------------------------------------------*/

  /*---------------------\
  |  Menampilkan Grafik  |
  \----------------------/---------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan grafik                                  |
  |   2. Hasil dari fungsi ini adalah detail data grafik                     |
  |                                                                          |
  \-------------------------------------------------------------------------*/
 
    if($_GET['type'] == "tampilGrafik" ) {
       $query = "select
                  timbang.UMUR_PENIMBANGAN as UMUR_PENIMBANGAN,
                  timbang.BERAT_BADAN as BERAT_BADAN,
                  balita.JNS_KELAMIN as JNS_KELAMIN
                from
                  BALITA as balita,
                  PENIMBANGAN as timbang
                where
                  timbang.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  balita.ID_BALITA =  '" . $_GET['idAnak'] . "' 
                order by
                  timbang.UMUR_PENIMBANGAN asc
                ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"grafik":' . json_encode( $var ) . '}';
    }
  
  else

  /*----------------\
  |  Memeriksa KMS  |
  \-----------------/--------------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk memeriksa apakah bulan KMS yang akan diisi sudah    |
  |      terisi atau masih kosong (hanya bisa sekali input)                  |
  |   2. Hasil dari fungsi ini adalah status KMS                             |
  |                                                                          |
  \-------------------------------------------------------------------------*/
   
    if($_GET['type'] == "cekKMS"){
      $query = "select
                  count(*) as rownum
                from
                  PENIMBANGAN as timbang
                where
                  timbang.UMUR_PENIMBANGAN = '" . $_GET['umur'] . "' and
                  timbang.ID_BALITA = '" . $_GET['idAnak'] . "'
                ";
      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      if ( $row['rownum'] > 0 ) {
        $output = array('status' => true);
        echo json_encode( $output );
      }
      else {
        $output = array('status' => false);
        echo json_encode( $output );
      }
    }
  
  else

  /*--------------\
  |  Mengisi KMS  |
  \---------------/----------------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk mengisi informasi KMS                               |
  |   2. Informasi yang perlu dimasukkan adalah :                            |
  |     - Umur penimbangan                                                   |
  |     - Tanggal penimbangan (tanggal, bulan, tahun)                        |
  |     - Posyandu                                                           |
  |     - Berat badan                                                        |
  |     - Tinggi badan                                                       |
  |     - Informasi pemberian asi                                            |
  |                                                                          |
  \-------------------------------------------------------------------------*/
  
    if($_GET['type'] == "isiKMS") {
      $umur = mysql_real_escape_string($_GET["umur"]);
      $tanggalTimbang = mysql_real_escape_string($_GET["tanggalTimbang"]);
      $bulanTimbang = mysql_real_escape_string($_GET["bulanTimbang"]);
      $tahunTimbang = mysql_real_escape_string($_GET["tahunTimbang"]);
      $posyandu = mysql_real_escape_string($_GET["posyandu"]);
      $beratBadan = mysql_real_escape_string($_GET["beratBadan"]);
      $tinggiBadan = mysql_real_escape_string($_GET["tinggiBadan"]);
      $idAnak = mysql_real_escape_string($_GET["idAnak"]);
      if($umur > 7){
        $asi = "-";
      } 
      else {
        $asi = mysql_real_escape_string($_GET["asi"]);  
      }
      
      $tanggalKMS = date("$tahunTimbang-$bulanTimbang-$tanggalTimbang");

      $result = $mysqli->query("INSERT INTO PENIMBANGAN (`ID_TIMBANG`, `ID_BALITA`, `ID_POSYANDU`, `UMUR_PENIMBANGAN`,`TGL_TIMBANG`,`BERAT_BADAN`,`TINGGI_BADAN`,`ASI`) 
                                VALUES (' ', '$idAnak', '$posyandu', '$umur', '$tanggalKMS', '$beratBadan', '$tinggiBadan', '$asi') ");
    }
  
  else

  /*-------------------------\
  |  Menampilkan Detail KMS  |
  \--------------------------/-----------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan detail informasi KMS sesuai bulan       |
  |   2. Hasil dari fungsi ini adalah detail informasi KMS sesuai dengan     | 
  |      informasi yang telah dimasukkan, ditampilkan berdasarkan bulan      |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "tampilKMS" ) {
       $query = "select
                      extract(month from timbang.TGL_TIMBANG) AS BULAN_TIMBANG,
                      timbang.TINGGI_BADAN AS TINGGI_BADAN,
                      timbang.BERAT_BADAN AS BERAT_BADAN,
                      timbang.UMUR_PENIMBANGAN AS UMUR_PENIMBANGAN,
                      timbang.ASI AS ASI,
                      balita.JNS_KELAMIN AS JNS_KELAMIN
                    from
                      PENIMBANGAN timbang,
                      BALITA balita
                    where
                      timbang.ID_BALITA = '" . $_GET['idAnak'] . "' and
                      balita.ID_BALITA = '" . $_GET['idAnak'] . "' 
                    order by
                      timbang.UMUR_PENIMBANGAN
                    ";
      $result = mysqli_query( $mysqli, $query );

      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"tampilKMS":' . json_encode( $var ) . '}';
    }    

  else

  /*------------------------------------------------------------------------*\  
  |*                           HALAMAN IMUNISASI                            *|
  \*------------------------------------------------------------------------*/

  /*----------------------\
  |  Memeriksa Imunisasi  |
  \-----------------------/--------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk memeriksa apakah bulan pemberian imunisasi          |
  |      yang akan diisi sudah terisi atau masih kosong (hanya bisa          |
  |      sekali input)                                                       |
  |   2. Hasil dari fungsi ini adalah status imunisasi                       |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "cekImunisasi"){
      $query = "select
                  count(*) as rownum
                from
                  PEMBERIAN_IMUNISASI as beri,
                  IMUNISASI as imun
                where
                  imun.UMUR_IMUNISASI =  '" . $_GET['umur'] . "' and
                  imun.ID_IMUNISASI = beri.ID_IMUNISASI and
                  beri.ID_BALITA = '" . $_GET['idAnak'] . "' 
                ";
      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      if ( $row['rownum'] > 0 ) {
        $output = array('status' => true);
        echo json_encode( $output );
      }
      else {
        $output = array('status' => false);
        echo json_encode( $output );
      }
    }

  else

  /*---------------------\
  |  Mencatat Imunisasi  |
  \----------------------/---------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk mencatat tanggal pemberian imunisasi                | 
  |   2. Informasi yang perlu dimasukkan :                                   | 
  |     - Umur pemberian imunisasi                                           | 
  |     - Tanggal pemberian imunisasi (tanggal, bulan, tahun)                | 
  |     - Posyandu                                                           | 
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "imunisasi") {
      $umur = mysql_real_escape_string($_GET["umur"]);
      // echo $tanggal = mysql_real_escape_string($_GET["tanggal"]);
      $tanggalImunisasi = mysql_real_escape_string($_GET["tanggalImunisasi"]);
      $bulanImunisasi = mysql_real_escape_string($_GET["bulanImunisasi"]);
      $tahunImunisasi = mysql_real_escape_string($_GET["tahunImunisasi"]);
      $posyandu = mysql_real_escape_string($_GET["posyandu"]);
      $idAnak = mysql_real_escape_string($_GET["idAnak"]);
      if($umur == "0") {
        $jenisImunisasi = "HB0";
      } 
      else if($umur == "1") {
        $jenisImunisasi = "BCG";
      } 
      else if($umur == "2") {
        $jenisImunisasi = "HB1";
      } 
      else if($umur == "3") {
        $jenisImunisasi = "HB2";
      } 
      else if($umur == "4") {
        $jenisImunisasi = "HB3";
      } 
      else if($umur == "9") {
        $jenisImunisasi = "CAM";
      }
      else {
        return;
      }
      
      $tanggalBeriImunisasi = date("$tahunImunisasi-$bulanImunisasi-$tanggalImunisasi");

      $result = $mysqli->query("INSERT INTO PEMBERIAN_IMUNISASI (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) 
                                VALUES ('', '$posyandu', '$jenisImunisasi', '$idAnak', '$tanggalBeriImunisasi') ");
    }

  else

  /*------------------------\
  |  Menampilkan Imunisasi  |
  \-------------------------/------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan tanggal pemberian imunisasi             |
  |   2. Hasil dari fungsi ini adalah tanggal pemberian imunisasi            |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "tampilImunisasi" ) {
      $query = "select
                  extract(day from imunisasi.TGL_BERI_IMUNISASI) AS TANGGAL_BERI_IMUNISASI,
                  extract(month from imunisasi.TGL_BERI_IMUNISASI) AS BULAN_BERI_IMUNISASI,
                  extract(year from imunisasi.TGL_BERI_IMUNISASI) AS TAHUN_BERI_IMUNISASI,
                  imunisasi.ID_BALITA AS ID_BALITA,
                  imunisasi.ID_IMUNISASI AS ID_IMUNISASI
                from
                  PEMBERIAN_IMUNISASI imunisasi,
                  BALITA balita
                where
                  balita.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  balita.ID_BALITA = imunisasi.ID_BALITA and
                  balita.NO_KTP = '" . $_GET['session'] . "'
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"imunisasi":' . json_encode( $var ) . '}';
    }

  else

  /*------------------------------------------------------------------------*\  
  |*                            HALAMAN VITAMIN                             *|
  \*------------------------------------------------------------------------*/

  /*--------------------\
  |  Memeriksa Vitamin  |
  \---------------------/----------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk memeriksa apakah bulan pemberian vitamin            |
  |      yang akan diisi sudah terisi atau masih kosong (hanya bisa          |
  |      sekali input)                                                       |
  |   2. Hasil dari fungsi ini adalah status vitamin                         |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "cekVitamin"){
      $umur = mysql_real_escape_string($_GET["umur"]);
      $pemberian = mysql_real_escape_string($_GET["pemberian"]);
      if($umur == "6") {
        $query = "select
                  count(*) as rownum,
                  beri.UMUR AS UMUR,
                  beri.ID_BALITA AS ID_BALITA
                from
                  PEMBERIAN_KAPSUL as beri
                where
                  beri.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  beri.UMUR =  '" . $umur . "' 
                ";
        $result = mysqli_query( $mysqli, $query );
        $row = mysqli_fetch_array( $result );

        if ( $row['rownum'] > 0 ) {
          $output = array('status' => true, 'value'=> '6');
          echo json_encode( $output );
        }
        else {
          $output = array('status' => false, 'value'=> '6');
          echo json_encode( $output );
        }
      }
      else {
        if( $pemberian == "1" ) {
          $jenisKapsul = "Kapsul Merah 1";
        }
        else
        {
          $jenisKapsul = "Kapsul Merah 2";
        }

        $query = "select
                    count(*) as rownum
                  from
                    PEMBERIAN_KAPSUL as beri
                  where
                    beri.UMUR =  '" . $umur . "' and
                    beri.JENIS_KAPSUL = '". $jenisKapsul ."' and
                    beri.ID_BALITA = '" . $_GET['idAnak'] . "' 
                  ";
        $result = mysqli_query( $mysqli, $query );
        $row = mysqli_fetch_array( $result );

        if ( $row['rownum'] > 0 ) {
          $output = array('status' => true, 'value'=> '1');
          echo json_encode( $output );
        }
        else {
          $output = array('status' => false, 'value'=> '1');
          echo json_encode( $output );
        }
      }
    }

  else

  /*-------------------\
  |  Mencatat Vitamin  |
  \--------------------/-----------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk mencatat tanggal pemberian vitamin                  |
  |   2. Informasi yang perlu dimasukkan :                                   |
  |     - Umur pemberian vitamin                                             |
  |     - Tanggal pemberian vitamin (tanggal, bulan, tahun)                  |
  |     - Posyandu                                                           |
  |     - Pemberian ke                                                       |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "vitamin") {
      $umur = mysql_real_escape_string($_GET["umur"]);
      $tanggalVitamin = mysql_real_escape_string($_GET["tanggalVitamin"]);
      $bulanVitamin = mysql_real_escape_string($_GET["bulanVitamin"]);
      $tahunVitamin = mysql_real_escape_string($_GET["tahunVitamin"]);
      $posyandu = mysql_real_escape_string($_GET["posyandu"]);
      $pemberian = mysql_real_escape_string($_GET["pemberian"]);
      $idAnak =  mysql_real_escape_string($_GET["idAnak"]);
      
      if($umur == "6") {
        $jenisKapsul = "Kapsul Biru";
      } 
      else {
        if($pemberian == "1") {
            $jenisKapsul = "Kapsul Merah 1";
          }
        else {
            $jenisKapsul = "Kapsul Merah 2";
          }
      } 

      $tanggalBeriVitamin = date("$tahunVitamin-$bulanVitamin-$tanggalVitamin");

      $result = $mysqli->query("INSERT INTO PEMBERIAN_KAPSUL (`ID_BERI_KAPSUL`, `ID_POSYANDU`, `ID_BALITA`, `TGL_BERI_KAPSUL`, `UMUR`, `JENIS_KAPSUL`) 
                                VALUES (' ', '$posyandu', '$idAnak', '$tanggalBeriVitamin', '$umur', '$jenisKapsul') ");
    }
    
  else 

  /*----------------------\
  |  Menampilkan Vitamin  |
  \-----------------------/--------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan tanggal pemberian vitamin               |
  |   2. Hasil dari fungsi ini adalah tanggal pemberian vitamin              |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "tampilVitamin" ) {
      $query = "select
                  extract(day from kapsul.TGL_BERI_KAPSUL) AS TANGGAL_BERI_KAPSUL,
                  extract(month from kapsul.TGL_BERI_KAPSUL) AS BULAN_BERI_KAPSUL,
                  extract(year from kapsul.TGL_BERI_KAPSUL) AS TAHUN_BERI_KAPSUL,
                  kapsul.UMUR AS UMUR,
                  kapsul.JENIS_KAPSUL AS JENIS_KAPSUL
                from
                  PEMBERIAN_KAPSUL kapsul,
                  BALITA balita
                where
                  balita.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  balita.ID_BALITA = kapsul.ID_BALITA and
                  balita.NO_KTP = '" . $_GET['session'] . "'
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"vitamin":' . json_encode( $var ) . '}';
    }

  else

  /*------------------------------------------------------------------------*\  
  |*                            HALAMAN KELUHAN                             *|
  \*------------------------------------------------------------------------*/
  
  /*---------------------\
  |  Memasukkan Keluhan  |
  \----------------------/---------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk memasukkan keluhan ibu balita                       |
  |   2. Informasi yang perlu dimasukkan adalah :                            |
  |    - Judul keluhan                                                       |
  |    - Isi keluhan                                                         |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "keluhan") {
      $query = "select
                  EMAIL
                from
                  TABLEUSER
                where
                  NO_KTP = '" . $_GET['session'] ."' 
                  "; 
      $result = mysqli_query( $mysqli, $query);
      $row = mysqli_fetch_array( $result );
      
      $emailKeluhan = $row['EMAIL'];
      $judulKeluhan = mysql_real_escape_string($_GET["judulKeluhan"]);
      $isiKeluhan = mysql_real_escape_string($_GET["isiKeluhan"]);
      
      $result = $mysqli->query("INSERT INTO KELUHAN VALUES (' ', '$emailKeluhan', '$judulKeluhan', NOW(), '$isiKeluhan', ' ') ");
    }

  else 

  /*----------------------\
  |  Menampilkan Keluhan  |
  \-----------------------/--------------------------------------------------\
  |                                                                          |
  |   1. Digunakan untuk menampilkan keluhan ibu balita, beserta dengan      |
  |      balasan dari petugas posyandu bila tersedia                         |
  |   2. Hasil dari fungsi ini adalah keluhan beserta dengan balasan         |
  |      keluhan tersebut                                                    |
  |                                                                          |
  \-------------------------------------------------------------------------*/

    if($_GET['type'] == "tampilKeluhan" ) {
      $query = "select
                  extract(day from keluh.TGL_KELUHAN) AS TANGGAL_KELUHAN,
                  extract(month from keluh.TGL_KELUHAN) AS BULAN_KELUHAN,
                  extract(year from keluh.TGL_KELUHAN) AS TAHUN_KELUHAN,
                  dayofweek(keluh.TGL_KELUHAN) AS HARI_KELUHAN,
                  keluh.JUDUL_KELUHAN AS JUDUL_KELUHAN,
                  keluh.ISI_KELUHAN AS ISI_KELUHAN,
                  keluh.BALASAN_KELUHAN AS BALASAN_KELUHAN
                from
                  KELUHAN keluh,
                  TABLEUSER user
                where
                  user.NO_KTP = '" . $_GET['session'] . "' and 
                  user.EMAIL = keluh.EMAIL                  
                order by
                  keluh.TGL_KELUHAN desc
                limit 5";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"keluhan":' . json_encode( $var ) . '}';
    }  

}
?>