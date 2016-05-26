<?php
  header( 'Access-Control-Allow-Origin: *');

  if ( isset( $_GET['type'] ) ) {
    // koneksi database
    $host = "localhost";        // lokasi database
    $user = "root";             // nama username
    $pass = "";                 // password database
    $dbname = "sim_stranas";       // nama database yang digunakan

    $cn = mysqli_connect( $host, $user, $pass, $dbname );

    if ( $_GET['type'] == "getpengumuman" ) {
      $query = "select
                  extract(day from peng.tgl_pengumuman) AS TANGGAL_PENGUMUMAN,
                  extract(month from peng.tgl_pengumuman) AS BULAN_PENGUMUMAN,
                  extract(year from peng.tgl_pengumuman) AS TAHUN_PENGUMUMAN,
                  dayofweek(peng.tgl_pengumuman) AS HARI_PENGUMUMAN,
                  peng.judul_pengumuman AS JUDUL_PENGUMUMAN,
                  peng.isi_pengumuman AS ISI_PENGUMUMAN,
                  peng.link_upload_pengumuman AS LINK_UPLOAD_PENGUMUMAN,
                  ibu.nama_ibu_pkk AS NAMA_IBU_PKK,
                  ibu.id_pengurus_pkk AS ID_PENGURUS_PKK
                from
                  pengumuman peng,
                  ibu_pkk ibu
                where
                  ibu.id_pengurus_pkk = peng.id_pengurus_pkk
                order by
                  peng.tgl_pengumuman desc
                limit 5";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"pengumuman":' . json_encode( $var ) . '}';
    }
    else if ( $_GET['type'] == "isuserexist" ) {
      $query = "select
                  count(*) as rownum,
                  tu.no_ktp_ibu_pkk
                from
                  tableuser tu,
                  ibu_pkk ibu
                where
                  ibu.tlp_ibu_pkk = '" . $_GET['telp'] . "' and
                  tu.password = '" . $_GET['pass'] . "' and
                  tu.no_ktp_ibu_pkk is not NULL and
                  tu.no_ktp_ibu_pkk = ibu.no_ktp_ibu_pkk";
      $result = mysqli_query( $cn, $query );
      $row = mysqli_fetch_array( $result );

      if ( $row['rownum'] > 0 ) {
        echo $row['no_ktp_ibu_pkk'];
      }
      else {
        echo "";
      }
    }
    else if ( $_GET['type'] == "gettahuniuran" ) {
      $query = "select
                  extract(year from tgl_kas_pkk) AS TAHUN_IURAN_PKK
                from
                  kas_pkk
                where
                  no_ktp_ibu_pkk = '" . $_GET['session'] . "'
                order by
                  TAHUN_IURAN_PKK desc";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"tahuniuran":' . json_encode( $var ) . '}';      
    }
    else if ( $_GET['type'] == "gettableiuran" ) {
      $query = "select
                  extract(day from tgl_kas_pkk) AS TANGGAL_IURAN_PKK,
                  extract(month from tgl_kas_pkk) AS BULAN_IURAN_PKK,
                  extract(year from tgl_kas_pkk) AS TAHUN_IURAN_PKK,
                  nominal_kas_pkk AS NOMINAL_IURAN_PKK
                from
                  kas_pkk
                where
                  no_ktp_ibu_pkk = '" . $_GET['session'] . "' and
                  extract(year from tgl_kas_pkk) = '" . $_GET['year'] . "'
                order by
                  BULAN_IURAN_PKK";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"iuran":' . json_encode( $var ) . '}';
    }
    else if ( $_GET['type'] == "getdaftarrapat" ) {
      $query = "select
                  id_notulensi AS ID_NOTULENSI,
                  extract(day from tgl_notulensi) AS TANGGAL_NOTULENSI,
                  extract(month from tgl_notulensi) AS BULAN_NOTULENSI,
                  extract(year from tgl_notulensi) AS TAHUN_NOTULENSI,
                  isi_notulensi AS ISI_NOTULENSI
                from
                  notulensi
                order by
                  tgl_notulensi desc
                limit 5";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"daftarrapat":' . json_encode( $var ) . '}';      
    }
    else if ( $_GET['type'] == "gettablerapat" ) {
      $query = "select
                  extract(day from ntl.tgl_notulensi) AS TANGGAL_NOTULENSI,
                  extract(month from ntl.tgl_notulensi) AS BULAN_NOTULENSI,
                  extract(year from ntl.tgl_notulensi) AS TAHUN_NOTULENSI,
                  dayofweek(ntl.tgl_notulensi) AS HARI_NOTULENSI,
                  ntl.isi_notulensi AS ISI_NOTULENSI,
                  ibu.nama_ibu_pkk AS NAMA_IBU_PKK,
                  ibu.id_pengurus_pkk AS ID_PENGURUS_PKK
                from
                  notulensi ntl,
                  ibu_pkk ibu
                where
                  ibu.id_pengurus_pkk = ntl.id_pengurus_pkk and
                  ntl.id_notulensi = " . $_GET['meetingno'];
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"notulensi":' . json_encode( $var ) . '}';      
    }
    else if ( $_GET['type'] == "gettahunjentik" ) {
      $query = "select distinct
                  tahun_data_jentik AS TAHUN_PEMERIKSAAN
                from
                  data_jentik
                where
                  no_ktp_ibu_pkk = '" . $_GET['session'] . "'
                order by
                  TAHUN_PEMERIKSAAN desc";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"tahunjentik":' . json_encode( $var ) . '}';      
    }
    else if ( $_GET['type'] == "gettablejentik" ) {
      $query = "select
                  extract(day from tgl_pemeriksaan) AS TANGGAL_PEMERIKSAAN,
                  extract(month from tgl_pemeriksaan) AS BULAN_PEMERIKSAAN,
                  extract(year from tgl_pemeriksaan) AS TAHUN_PEMERIKSAAN,
                  bulan_data_jentik AS BULAN_DATA_JENTIK,
                  tahun_data_jentik AS TAHUN_DATA_JENTIK,
                  ada_jentik AS NOMINAL_JENTIK
                from
                  data_jentik
                where
                  no_ktp_ibu_pkk = '" . $_GET['session'] . "' and
                  tahun_data_jentik = '" . $_GET['year'] . "'
                order by
                  BULAN_PEMERIKSAAN";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"jentik":' . json_encode( $var ) . '}';
    }
    else if ( $_GET['type'] == "getkeluhan" ) {
      $query = "select
                  extract(day from keluhan.waktu_keluhan) AS TANGGAL_KELUHAN,
                  extract(month from keluhan.waktu_keluhan) AS BULAN_KELUHAN,
                  extract(year from keluhan.waktu_keluhan) AS TAHUN_KELUHAN,
                  dayofweek(keluhan.waktu_keluhan) AS HARI_KELUHAN,
                  keluhan.judul_keluhan AS JUDUL_KELUHAN,
                  keluhan.isi_keluhan AS ISI_KELUHAN,
                  keluhan.id_keluhan AS ID_KELUHAN
                from
                  keluhan_pkk keluhan
                where
                  keluhan.no_ktp_ibu_pkk = " . $_GET['session'] . "
                order by
                  keluhan.waktu_keluhan desc";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"keluhan":' . json_encode( $var ) . '}';
    }
    else if ( $_GET['type'] == "insertkeluhan" ) {
      $query = "insert into
                  keluhan_pkk(no_ktp_ibu_pkk, judul_keluhan, isi_keluhan)
                values
                  ('" . $_GET['session'] . "', '" . $_GET['judul'] . "', '" . $_GET['isi'] . "')";

      mysqli_query( $cn, $query );
    }
    else if ( $_GET['type'] == "insertkomentar" ) {
      $query = "insert into
                  keluhan_komentar_pkk(isi_komentar, id_keluhan, no_ktp_ibu_pkk)
                values
                  ('" . $_GET['isi'] . "', '" . $_GET['idkel'] . "', '" . $_GET['session'] . "')";

      mysqli_query( $cn, $query );
    }
    else if ( $_GET['type'] == "changepass" ) {
      $query = "select
                  count(*) as rownum,
                  no_ktp_ibu_pkk
                from
                  tableuser
                where
                  no_ktp_ibu_pkk is not null and
                  no_ktp_ibu_pkk = '" . $_GET['session'] . "' and
                  password = '" . $_GET['oldpass'] . "'";
      $result = mysqli_query( $cn, $query );
      $row = mysqli_fetch_array( $result );

      if ( $row['rownum'] > 0 ) {
        if ( $_GET['newpass'] == $_GET['renewpass'] ) {
          $query = "update
                      tableuser
                    set
                      password = '" . $_GET['newpass'] . "'
                    where
                      no_ktp_ibu_pkk = '" . $_GET['session'] . "'";
          $result = mysqli_query( $cn, $query );
        }
        else {
          echo "noMatchPass";
        }
      }
      else {
        echo "noMatchUser";
      }
    }
    else if ( $_GET['type'] == "getkeluhanbyid" ) {
      $query = "select
                  extract(day from keluhan.waktu_keluhan) AS TANGGAL_KELUHAN,
                  extract(month from keluhan.waktu_keluhan) AS BULAN_KELUHAN,
                  extract(year from keluhan.waktu_keluhan) AS TAHUN_KELUHAN,
                  dayofweek(keluhan.waktu_keluhan) AS HARI_KELUHAN,
                  keluhan.judul_keluhan AS JUDUL_KELUHAN,
                  keluhan.isi_keluhan AS ISI_KELUHAN,
                  keluhan.id_keluhan AS ID_KELUHAN,
                  komentar.isi_komentar AS ISI_KOMENTAR,
                  ibu.nama_ibu_pkk AS NAMA_IBU_PKK,
                  extract(day from komentar.tanggal_komentar) AS TANGGAL_KOMENTAR,
                  extract(month from komentar.tanggal_komentar) AS BULAN_KOMENTAR,
                  extract(year from komentar.tanggal_komentar) AS TAHUN_KOMENTAR,
                  extract(hour from komentar.tanggal_komentar) AS JAM_KOMENTAR,
                  extract(minute from komentar.tanggal_komentar) AS MENIT_KOMENTAR,
                  extract(second from komentar.tanggal_komentar) AS DETIK_KOMENTAR
                from
                  keluhan_pkk keluhan,
                  keluhan_komentar_pkk komentar,
                  ibu_pkk ibu
                where
                  ibu.no_ktp_ibu_pkk = komentar.no_ktp_ibu_pkk and
                  keluhan.id_keluhan = komentar.id_keluhan and
                  keluhan.id_keluhan = " . $_GET['keluhanID'] . " and
                  keluhan.no_ktp_ibu_pkk = " . $_GET['session'] . "
                order by
                  keluhan.waktu_keluhan desc";
      $result = mysqli_query( $cn, $query );
      $var = array();

      while ( $obj = mysqli_fetch_object( $result ) ) {
        $var[] = $obj;
      }

      echo '{"komentar":' . json_encode( $var ) . '}';
    }
    else if ( $_GET['type'] == "insertjentik" ) {
      $query = "select
                  *
                from
                  data_jentik
                where
                  bulan_data_jentik = " . $_GET['bulan'] . " and
                  tahun_data_jentik = " . $_GET['tahun'] . " and
                  no_ktp_ibu_pkk = '" . $_GET['session'] . "'";
      $result = mysqli_query( $cn, $query );
      $numrow = mysqli_num_rows( $result );

      if ( $numrow > 0 ) {
        if ( $_GET['jumlah'] > 0 ) {
          $query = "update
                      data_jentik
                    set
                      ada_jentik = " . $_GET['jumlah'] . ",
                      tgl_pemeriksaan = current_timestamp
                    where
                      bulan_data_jentik = " . $_GET['bulan'] . " and
                      tahun_data_jentik = " . $_GET['tahun'] . " and
                      no_ktp_ibu_pkk = '" . $_GET['session'] . "'";
          $result = mysqli_query( $cn, $query );
        }
        else if ( $_GET['jumlah'] == 0 ) {
          $query = "delete from
                      data_jentik
                    where
                      bulan_data_jentik = " . $_GET['bulan'] . " and
                      tahun_data_jentik = " . $_GET['tahun'] . " and
                      no_ktp_ibu_pkk = '" . $_GET['session'] . "'";
          $result = mysqli_query( $cn, $query );
        }
      }
      else if ( $numrow == 0 && $_GET['jumlah'] > 0 ) {
        $idDataPKK = "";
        $lastID = "";
        $query = "select
                    id_data_pkk
                  from
                    ibu_pkk
                  where
                    no_ktp_ibu_pkk = '" . $_GET['session'] . "'";
        
        $result = mysqli_query( $cn, $query );
        if ( mysqli_num_rows( $result ) > 0 ) {
          while ( $row = mysqli_fetch_assoc( $result ) ) {
            $idDataPKK = $row['id_data_pkk'];
          }
        }

        $query = "select
                    id_pemeriksaan
                  from
                    data_jentik
                  order by
                    id_pemeriksaan desc
                  limit 1";
        
        $result = mysqli_query( $cn, $query );
        if ( mysqli_num_rows( $result ) > 0 ) {
          while ( $row = mysqli_fetch_assoc( $result ) ) {
            $lastID = $row['id_pemeriksaan'];
          }
        }
        $lastID = intval( $lastID ) + 1;

        $query = "insert into
                    data_jentik(id_pemeriksaan, id_data_pkk, no_ktp_ibu_pkk, tgl_pemeriksaan, ada_jentik, bulan_data_jentik, tahun_data_jentik)
                  values
                    ('" . $lastID . "', '" . $idDataPKK . "', '" . $_GET['session'] . "', current_timestamp, " . $_GET['jumlah'] . ", " . $_GET['bulan'] . ", " . $_GET['tahun'] . ")";

        mysqli_query( $cn, $query );
      }
    }
  }
?>