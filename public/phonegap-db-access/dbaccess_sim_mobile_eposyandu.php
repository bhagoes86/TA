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
    
    $host = "localhost";            // lokasi database
    $user = "root";                 // nama username
    $pass = "";                     // password database
    $dbname = "sim_stranas";        // nama database yang digunakan

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
                  ibu.ID AS ID
                from
                  POSYANDU_IBU as ibu
                where
                  ibu.TELP = '" . $_GET['ID'] . "' and
                  ibu.PASSWORD_MOBILE = '" . $_GET['pass'] . "'
                ";

      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      if ( $row['rownum'] > 0 ) {
          $output = array('status' => true, 'session' => $row['ID']);
          echo json_encode( $output );
        }
      else {
        $output = array('status' => false);
        echo json_encode( $output );
      }
    }

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
                  ID,
                  ID_IBU,
                  ID_POSYANDU,
                  TANGGAL_LAHIR, 
                  UMUR
                from  
                  POSYANDU_BALITA 
                "; 
      $result = mysqli_query( $mysqli, $query);

      while($row = mysqli_fetch_array($result))
      {
        $simpan = $mysqli->query("UPDATE POSYANDU_BALITA SET UMUR = TIMESTAMPDIFF(MONTH, '" . $row['TANGGAL_LAHIR'] . "', CURDATE()) WHERE ID = '" . $row['ID'] . "'");
      }

      $query = "select 
                  ID,
                  ID_IBU,
                  ID_POSYANDU,
                  TANGGAL_LAHIR, 
                  UMUR
                from  
                  POSYANDU_BALITA 
                "; 
      $result = mysqli_query( $mysqli, $query);
      while($row = mysqli_fetch_array($result))
      { 
        $query2 = "select
                    ID,
                    ID_POSYANDU
                  from
                    POSYANDU_IBU
                  ";
        $result2 = mysqli_query( $mysqli, $query2);
        
        while($row2 = mysqli_fetch_array($result2))
        {
          if($row['ID_IBU'] == $row2['ID'])
          {
            if($row['UMUR'] < 60)
            {
              $simpan2 = $mysqli->query("UPDATE POSYANDU_BALITA SET ID_POSYANDU = '" . $row2['ID_POSYANDU'] . "' WHERE ID = '" . $row['ID'] . "'" );
            } 
          }  
        }
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
                  balita.NAMA AS NAMA_BALITA,
                  balita.ID AS ID_BALITA,
                  balita.UMUR AS UMUR_BALITA
                from
                  POSYANDU_BALITA balita,
                  POSYANDU_IBU ibu
                where
                  ibu.ID = '" . $_GET['session'] . "' and
                  balita.ID_IBU = ibu.ID
                order by
                  balita.TANGGAL_LAHIR asc
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
                  ID,
                  UMUR
                from
                  POSYANDU_BALITA
                where
                  ID = '" . $_GET['id'] . "'
                ";
      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      $output = array('status' => true, 'idAnak' => $row['ID'], 'umur' => $row['UMUR']);
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
                  ID,
                  NAMA  
                from
                  POSYANDU_DATA
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"posyandu":' . json_encode(
       $var ) . '}';
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
	  $query ="select
                   ID,
                   ID_POSYANDU
                 from
                   POSYANDU_IBU
                 where
                   ID = '" . $_GET['session'] . "'
               ";
	  $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );
		
    $IDibu = $row[ID];
	  $IDposyandu = $row[ID_POSYANDU];
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

      $result = $mysqli->query("INSERT INTO POSYANDU_BALITA (`ID`, `ID_IBU`, `ID_POSYANDU` , `NO_KK`, `NAMA`, `JENIS_KELAMIN`, `ANAK_KE`, `TANGGAL_LAHIR`, `TB_LAHIR`, `BB_LAHIR`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `PEKERJAAN_IBU`, `CREATED_AT`) 
                              VALUES (' ', '$IDibu', '$IDposyandu', '$nomorKK', '$namaAnak', '$JK', '$anakKe', '$tanggalLahirAnak', '$panjangBadanLahir', '$beratBadanLahir', '$ayah', '$pekerjaanAyah', '$pekerjaanIbu', NOW())"); 
	  
      $query2 ="select
                   ID
                 from
                   POSYANDU_BALITA
                 where
                   ID_IBU = '$IDibu' and
                   NAMA = '$namaAnak'
               ";
	  $result2 = mysqli_query( $mysqli, $query2 );
      $row2 = mysqli_fetch_array( $result2 );
		
	  $id = $row2[ID];
	  
	  $result3 = $mysqli->query("INSERT INTO POSYANDU_PENIMBANGAN (`ID`, `ID_BALITA`, `UMUR`, `TANGGAL`, `BERAT`, `TINGGI`, `NTOB`, `ASI`, `CREATED_AT`) 
                                VALUES (' ', '$id', '0', '$tanggalLahirAnak', '$beratBadanLahir', '$panjangBadanLahir', 'N', 'Yes', NOW()) ");
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
                  balita.NAMA AS NAMA_BALITA,
                  balita.JENIS_KELAMIN AS JNS_KELAMIN,
                  extract(day from balita.TANGGAL_LAHIR) AS TANGGAL_LAHIR,
                  extract(month from balita.TANGGAL_LAHIR) AS BULAN_LAHIR,
                  extract(year from balita.TANGGAL_LAHIR) AS TAHUN_LAHIR,
                  balita.TB_LAHIR AS TB_LAHIR,
                  balita.BB_LAHIR AS BB_LAHIR,
                  balita.NAMA_AYAH AS NAMA_AYAH,
                  balita.PEKERJAAN_AYAH AS PEKERJAAN_AYAH,
                  balita.PEKERJAAN_IBU AS PEKERJAAN_IBU,
                  ibu.NAMA AS NAMA_IBU
                from
                  POSYANDU_BALITA balita,
                  POSYANDU_IBU ibu
                where
                  ibu.ID = '" . $_GET['session'] . "' and
                  balita.ID_IBU = ibu.ID and
                  balita.ID = '" . $_GET['idAnak'] . "'
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
                  NAMA,
                  NO_KK,
                  ANAK_KE,
                  JENIS_KELAMIN,
                  BB_LAHIR,
                  TB_LAHIR,
                  NAMA_AYAH,
                  PEKERJAAN_AYAH,
                  PEKERJAAN_IBU,
                  extract(day from TANGGAL_LAHIR) AS TGL_LAHIR,
                  extract(month from TANGGAL_LAHIR) AS BLN_LAHIR,
                  extract(year from TANGGAL_LAHIR) AS THN_LAHIR
                from
                  POSYANDU_BALITA
                where
                  ID = '" . $_GET['idAnak'] . "'
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

       $result = $mysqli->query(" UPDATE POSYANDU_BALITA SET NO_KK = '$nomorKK', NAMA = '$namaAnak', JENIS_KELAMIN = '$JK', ANAK_KE = '$anakKe', TANGGAL_LAHIR = '$tanggalUbahData', TB_LAHIR = '$panjangBadanLahir', BB_LAHIR = '$beratBadanLahir', NAMA_AYAH = '$ayah', PEKERJAAN_AYAH = '$pekerjaanAyah', PEKERJAAN_IBU = '$pekerjaanIbu', UPDATED_AT = NOW()  WHERE ID = '" . $_GET['idAnak'] . "'");
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
                  timbang.UMUR as UMUR_PENIMBANGAN,
                  timbang.BERAT as BERAT_BADAN,
                  balita.JENIS_KELAMIN as JNS_KELAMIN
                from
                  POSYANDU_BALITA as balita,
                  POSYANDU_PENIMBANGAN as timbang
                where
                  timbang.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  balita.ID =  '" . $_GET['idAnak'] . "' 
                order by
                  timbang.UMUR asc
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
                  POSYANDU_PENIMBANGAN as timbang
                where
                  timbang.UMUR = '" . $_GET['umur'] . "' and
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
      // $posyandu = mysql_real_escape_string($_GET["posyandu"]);
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

      $result = $mysqli->query("INSERT INTO POSYANDU_PENIMBANGAN (`ID`, `ID_BALITA`, `UMUR`,`TANGGAL`,`BERAT`,`TINGGI`,`ASI`, `CREATED_AT`) 
                                VALUES (' ', '$idAnak', '$umur', '$tanggalKMS', '$beratBadan', '$tinggiBadan', '$asi', NOW()) ");
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
                      extract(month from timbang.TANGGAL) AS BULAN_TIMBANG,
                      timbang.TINGGI AS TINGGI_BADAN,
                      timbang.BERAT AS BERAT_BADAN,
                      timbang.UMUR AS UMUR_PENIMBANGAN,
                      timbang.ASI AS ASI,
                      balita.JENIS_KELAMIN AS JNS_KELAMIN,
                      balita.UMUR AS UMUR_BALITA
                    from
                      POSYANDU_PENIMBANGAN timbang,
                      POSYANDU_BALITA balita
                    where
                      balita.ID = '" . $_GET['idAnak'] . "' and 
                      timbang.ID_BALITA = '" . $_GET['idAnak'] . "'
                    order by
                      timbang.UMUR asc
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
                  POSYANDU_PEMBERIAN_IMUNISASI as beri,
                  POSYANDU_IMUNISASI as imun
                where
                  imun.UMUR =  '" . $_GET['umur'] . "' and
                  imun.ID = beri.ID_IMUNISASI and
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
      $query = "select
                  imunisasi.ID AS ID_IMUNISASI
                from
                  POSYANDU_IMUNISASI imunisasi
                where
                  imunisasi.UMUR = '" . $_GET["umur"] . "'
                ";
      $result = mysqli_query( $mysqli, $query );
      $row = mysqli_fetch_array( $result );

      echo $umur = mysql_real_escape_string($_GET["umur"]);
      // echo $tanggal = mysql_real_escape_string($_GET["tanggal"]);
      $tanggalImunisasi = mysql_real_escape_string($_GET["tanggalImunisasi"]);
      $bulanImunisasi = mysql_real_escape_string($_GET["bulanImunisasi"]);
      $tahunImunisasi = mysql_real_escape_string($_GET["tahunImunisasi"]);
      // $posyandu = mysql_real_escape_string($_GET["posyandu"]);
      $idAnak = mysql_real_escape_string($_GET["idAnak"]);
      $idImun = $row['ID_IMUNISASI'];
      $tanggalBeriImunisasi = date("$tahunImunisasi-$bulanImunisasi-$tanggalImunisasi");

      $result = $mysqli->query("INSERT INTO POSYANDU_PEMBERIAN_IMUNISASI (`ID`, `ID_BALITA`, `ID_IMUNISASI`, `TANGGAL`, `CREATED_AT`) 
                                VALUES (' ', '$idAnak', '$idImun', '$tanggalBeriImunisasi', NOW()) ");
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

	if($_GET['type'] == "umurImunisasi" ) {
      $query = "select
                  ID,
                  UMUR  
                from
                  POSYANDU_IMUNISASI
				order by
				  UMUR asc
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"umurImunisasi":' . json_encode( $var ) . '}';
    }

  else

    if($_GET['type'] == "tampilImunisasi" ) {
      $query = "select
                  extract(day from imunisasi.TANGGAL) AS TANGGAL_BERI_IMUNISASI,
                  extract(month from imunisasi.TANGGAL) AS BULAN_BERI_IMUNISASI,
                  extract(year from imunisasi.TANGGAL) AS TAHUN_BERI_IMUNISASI,
                  imunisasi.ID_BALITA AS ID_BALITA,
                  imunisasi.ID AS ID_IMUNISASI
                from
                  POSYANDU_PEMBERIAN_IMUNISASI imunisasi,
                  POSYANDU_BALITA balita
                where
                  balita.ID = '" . $_GET['idAnak'] . "' and
                  balita.ID = imunisasi.ID_BALITA and
                  balita.ID_IBU = '" . $_GET['session'] . "'
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"imunisasi":' . json_encode( $var ) . '}';
    }

  else

    if($_GET['type'] == "tampilTabelImunisasi" ) {
      $query = "select
                  imun.ID AS ID_IMUNISASI,
                  imun.JENIS AS JENIS_IMUNISASI,
                  imun.UMUR AS UMUR_IMUNISASI
                from
                  POSYANDU_IMUNISASI imun
                order by
                  imun.UMUR asc
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"tabelImunisasi":' . json_encode( $var ) . '}';
    }

  else

    if($_GET['type'] == "tampilDataImunisasi" ) {
      $query = "select
                  imun.ID AS ID_IMUNISASI,
                  extract(day from imun.TANGGAL) AS TANGGAL_BERI_IMUNISASI,
                  extract(month from imun.TANGGAL) AS BULAN_BERI_IMUNISASI,
                  extract(year from imun.TANGGAL) AS TAHUN_BERI_IMUNISASI,
                  imunisasi.UMUR AS UMUR_IMUNISASI
                from
                  POSYANDU_PEMBERIAN_IMUNISASI imun,
                  POSYANDU_IMUNISASI imunisasi
                where
                  imun.ID_BALITA = '" . $_GET['idAnak'] . "' and
                  imunisasi.ID = imun.ID_IMUNISASI 
                order by
                  imun.ID_IMUNISASI asc
                  ";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
        }

      echo '{"dataImunisasi":' . json_encode( $var ) . '}';
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
                  POSYANDU_PEMBERIAN_KAPSUL as beri
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
                    POSYANDU_PEMBERIAN_KAPSUL as beri
                  where
                    beri.UMUR =  '" . $umur . "' and
                    beri.JENIS = '". $jenisKapsul ."' and
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
      // $posyandu = mysql_real_escape_string($_GET["posyandu"]);
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

      $result = $mysqli->query("INSERT INTO POSYANDU_PEMBERIAN_KAPSUL (`ID`, `ID_BALITA`, `TANGGAL`, `UMUR`, `JENIS`, `CREATED_AT`) 
                                VALUES (' ', '$idAnak', '$tanggalBeriVitamin', '$umur', '$jenisKapsul', NOW()) ");
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
                  extract(day from kapsul.TANGGAL) AS TANGGAL_BERI_KAPSUL,
                  extract(month from kapsul.TANGGAL) AS BULAN_BERI_KAPSUL,
                  extract(year from kapsul.TANGGAL) AS TAHUN_BERI_KAPSUL,
                  kapsul.UMUR AS UMUR,
                  kapsul.JENIS AS JENIS_KAPSUL
                from
                  POSYANDU_PEMBERIAN_KAPSUL kapsul,
                  POSYANDU_BALITA balita,
                  POSYANDU_IBU ibu
                where
                  ibu.ID = '" . $_GET['session'] . "' and
                  balita.ID_IBU = ibu.ID and
                  balita.ID = '" . $_GET['idAnak'] . "' and
                  balita.ID = kapsul.ID_BALITA
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
                  ID
                from
                  POSYANDU_IBU
                where
                  ID = '" . $_GET['session'] ."' 
                  "; 
      $result = mysqli_query( $mysqli, $query);
      $row = mysqli_fetch_array( $result );
      
      $idIbu = $row['ID'];
      $judulKeluhan = mysql_real_escape_string($_GET["judulKeluhan"]);
      $isiKeluhan = mysql_real_escape_string($_GET["isiKeluhan"]);
      
      $result = $mysqli->query("INSERT INTO POSYANDU_KELUHAN VALUES (' ', '$idIbu', '$judulKeluhan', '$isiKeluhan', NOW(),' ') ");
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
                  extract(day from keluh.CREATED_AT) AS TANGGAL_KELUHAN,
                  extract(month from keluh.CREATED_AT) AS BULAN_KELUHAN,
                  extract(year from keluh.CREATED_AT) AS TAHUN_KELUHAN,
                  dayofweek(keluh.CREATED_AT) AS HARI_KELUHAN,
                  keluh.JUDUL AS JUDUL_KELUHAN,
                  keluh.ISI AS ISI_KELUHAN,
                  keluh.ID AS ID_KELUHAN
                from
                  POSYANDU_KELUHAN keluh
                where
                  keluh.ID_IBU = '" . $_GET['session'] . "'
                order by
                  keluh.CREATED_AT desc
                limit 5";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"keluhan":' . json_encode( $var ) . '}';
    }  

    else 

    if ( $_GET['type'] == "getkeluhanbyid" ) {
      $query = "select
                  extract(day from keluh.CREATED_AT) AS TANGGAL_KELUHAN,
                  extract(month from keluh.CREATED_AT) AS BULAN_KELUHAN,
                  extract(year from keluh.CREATED_AT) AS TAHUN_KELUHAN,
                  dayofweek(keluh.CREATED_AT) AS HARI_KELUHAN,
                  keluh.JUDUL AS JUDUL_KELUHAN,
                  keluh.ISI AS ISI_KELUHAN,
                  keluh.ID AS ID_KELUHAN,
                  jawab.USER AS USER, 
                  jawab.ISI AS ISI_KOMENTAR,
                  extract(day from jawab.CREATED_AT) AS TANGGAL_KOMENTAR,
                  extract(month from jawab.CREATED_AT) AS BULAN_KOMENTAR,
                  extract(year from jawab.CREATED_AT) AS TAHUN_KOMENTAR,
                  extract(hour from jawab.CREATED_AT) AS JAM_KOMENTAR,
                  extract(minute from jawab.CREATED_AT) AS MENIT_KOMENTAR,
                  extract(second from jawab.CREATED_AT) AS DETIK_KOMENTAR,
                  ibu.NAMA AS NAMA_IBU
                from
                  POSYANDU_KELUHAN keluh,
                  POSYANDU_JAWAB_KELUHAN jawab,
                  POSYANDU_IBU ibu
                where
                  keluh.ID = '" . $_GET['keluhanID'] . "' and
                  jawab.ID_KELUHAN = '" . $_GET['keluhanID'] . "' and  
                  ibu.ID = keluh.ID_IBU   
                order by
                  jawab.CREATED_AT asc";
      $result = mysqli_query( $mysqli, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"komentar":' . json_encode( $var ) . '}';
    }

    else
  
    if ( $_GET['type'] == "insertkomentar" ) {
      $idkel = mysql_real_escape_string($_GET["idkel"]);
      $isiKomentar = mysql_real_escape_string($_GET["isi"]);
      
      $result = $mysqli->query("INSERT INTO POSYANDU_JAWAB_KELUHAN (`ID`, `ID_KELUHAN`, `ISI`, `USER`, `CREATED_AT`) 
                                VALUES ('', '$idkel', '$isiKomentar', '0', NOW()) ");
    }
}
?>