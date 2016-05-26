-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Jul 2015 pada 11.48
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sim_epkk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE IF NOT EXISTS `absen` (
  `ID_ABSEN` int(11) NOT NULL,
  `ID_NOTULENSI` varchar(10) DEFAULT NULL,
  `NO_KTP_IBU_PKK` varchar(20) DEFAULT NULL,
  `KEHADIRAN` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `balita`
--

CREATE TABLE IF NOT EXISTS `balita` (
`ID_BALITA` int(11) NOT NULL,
  `NO_KTP` varchar(20) DEFAULT NULL,
  `NO_KK_BALITA` varchar(20) DEFAULT NULL,
  `NAMA_BALITA` varchar(30) DEFAULT NULL,
  `JNS_KELAMIN` varchar(5) DEFAULT NULL,
  `ANAK_KE` decimal(10,0) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `TGL_DAFTAR` date DEFAULT NULL,
  `TB_LAHIR` decimal(10,2) DEFAULT NULL,
  `BB_LAHIR` decimal(10,2) DEFAULT NULL,
  `NAMA_AYAH` varchar(30) DEFAULT NULL,
  `PEKERJAAN_AYAH` varchar(20) DEFAULT NULL,
  `PEKERJAAN_IBU` varchar(20) DEFAULT NULL,
  `UMUR_BALITA` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `balita`
--

INSERT INTO `balita` (`ID_BALITA`, `NO_KTP`, `NO_KK_BALITA`, `NAMA_BALITA`, `JNS_KELAMIN`, `ANAK_KE`, `TGL_LAHIR`, `TGL_DAFTAR`, `TB_LAHIR`, `BB_LAHIR`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `PEKERJAAN_IBU`, `UMUR_BALITA`) VALUES
(1, '1234560101600001', '1234560101850001', 'Aksa Uyun', 'L', '1', '2015-02-01', '2015-02-03', '45.00', '2.50', 'Herwan Prandoko', 'Artis', 'Artis', 5),
(2, '1234560404640004', '1234560404890004', 'Putri Perdani', 'P', '1', '2015-03-01', '2015-03-01', '45.30', '2.50', 'M. Abdullah', 'Dai', 'Ibu RT', 4),
(3, '1234563010610001', '1234563010860001', 'Priambodo', 'L', '1', '2015-01-01', '0000-00-00', '42.50', '2.40', 'Junaidi Slamet', 'Dosen', 'Dosen', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jentik`
--

CREATE TABLE IF NOT EXISTS `data_jentik` (
  `ID_PEMERIKSAAN` int(11) NOT NULL,
  `ID_DATA_PKK` varchar(10) DEFAULT NULL,
  `NO_KTP_IBU_PKK` varchar(20) DEFAULT NULL,
  `TGL_PEMERIKSAAN` date DEFAULT NULL,
  `ADA_JENTIK` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pkk`
--

CREATE TABLE IF NOT EXISTS `data_pkk` (
  `ID_DATA_PKK` varchar(20) NOT NULL,
  `RT_PKK` decimal(10,0) DEFAULT NULL,
  `RW_PKK` decimal(10,0) DEFAULT NULL,
  `KELURAHAN_PKK` varchar(20) DEFAULT NULL,
  `KECAMATAN_PKK` varchar(20) DEFAULT NULL,
  `KABUPATEN_PKK` varchar(20) DEFAULT NULL,
  `PROVINSI_PKK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_pkk`
--

INSERT INTO `data_pkk` (`ID_DATA_PKK`, `RT_PKK`, `RW_PKK`, `KELURAHAN_PKK`, `KECAMATAN_PKK`, `KABUPATEN_PKK`, `PROVINSI_PKK`) VALUES
('601111', '1', '7', 'keputih', 'sukolilo', 'surabaya', 'jawa timur'),
('601831', '1', '7', 'kalianak', 'asem rowo', 'surabaya', 'jawa timur'),
('601981', '1', '7', 'sememi', 'benowo', 'surabaya', 'jawa timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ibu_balita`
--

CREATE TABLE IF NOT EXISTS `ibu_balita` (
  `NO_KTP` varchar(20) NOT NULL,
  `NAMA_IBU` varchar(30) DEFAULT NULL,
  `ALAMAT_IBU` varchar(150) DEFAULT NULL,
  `TELP_IBU` varchar(20) DEFAULT NULL,
  `TGL_LAHIR_IBU` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ibu_balita`
--

INSERT INTO `ibu_balita` (`NO_KTP`, `NAMA_IBU`, `ALAMAT_IBU`, `TELP_IBU`, `TGL_LAHIR_IBU`) VALUES
('1234560101600001', 'Soimah', 'Desa Sukamaju No. 1', '0315996999', '1960-01-01'),
('1234560404640004', 'Maria Elisa', 'Jalan Kedondong No. 4', '0318855456', '1964-04-04'),
('1234563010610001', 'Siti Aminah', 'Desa Sukamaju No. 2', '0318855457', '1961-10-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ibu_pkk`
--

CREATE TABLE IF NOT EXISTS `ibu_pkk` (
  `NO_KTP_IBU_PKK` varchar(20) NOT NULL,
  `ID_DATA_PKK` varchar(10) DEFAULT NULL,
  `ID_PENGURUS_PKK` varchar(10) DEFAULT NULL,
  `NAMA_IBU_PKK` varchar(30) DEFAULT NULL,
  `ALAMAT_IBU_PKK` varchar(200) DEFAULT NULL,
  `TLP_IBU_PKK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ibu_pkk`
--

INSERT INTO `ibu_pkk` (`NO_KTP_IBU_PKK`, `ID_DATA_PKK`, `ID_PENGURUS_PKK`, `NAMA_IBU_PKK`, `ALAMAT_IBU_PKK`, `TLP_IBU_PKK`) VALUES
('1234560101600001', '601111', 'ang', 'Soimah', 'Desa Sukamaju No. 1', '0315996999'),
('1234560404640004', '601111', 'bendum', 'Maria Elisa', 'Jalan Kedondong No. 4', '0318855456'),
('1234563010610001', '601111', 'ket', 'Siti Aminah', 'Desa Sukamaju No. 2', '0315923214');

-- --------------------------------------------------------

--
-- Struktur dari tabel `imunisasi`
--

CREATE TABLE IF NOT EXISTS `imunisasi` (
  `ID_IMUNISASI` varchar(10) NOT NULL,
  `JENIS_IMUNISASI` varchar(20) DEFAULT NULL,
  `UMUR_IMUNISASI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `imunisasi`
--

INSERT INTO `imunisasi` (`ID_IMUNISASI`, `JENIS_IMUNISASI`, `UMUR_IMUNISASI`) VALUES
('BCG', 'BCG, Polio 1', 1),
('CAM', 'Campak', 9),
('HB0', 'HB0, Polio 0', 0),
('HB1', 'DPT/HB 1, Polio 2', 2),
('HB2', 'DPT/HB 2, Polio 3', 3),
('HB3', 'DPT/HB3, Polio 4', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `ID_JABATAN` varchar(10) NOT NULL,
  `NAMA_JABATAN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`ID_JABATAN`, `NAMA_JABATAN`) VALUES
('1', 'ketua'),
('2', 'wakil ketua'),
('3', 'sekretaris'),
('4', 'bendahara'),
('5', 'anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kas`
--

CREATE TABLE IF NOT EXISTS `jenis_kas` (
  `ID_JENIS_KAS` varchar(10) NOT NULL,
  `JENIS_KAS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_kas`
--

INSERT INTO `jenis_kas` (`ID_JENIS_KAS`, `JENIS_KAS`) VALUES
('1', 'pemasukan'),
('2', 'pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_pkk`
--

CREATE TABLE IF NOT EXISTS `kas_pkk` (
  `ID_KAS_PKK` int(11) NOT NULL,
  `NO_KTP_IBU_PKK` varchar(20) DEFAULT NULL,
  `ID_JENIS_KAS` varchar(10) DEFAULT NULL,
  `ID_PENGURUS_PKK` varchar(10) DEFAULT NULL,
  `TGL_KAS_PKK` date DEFAULT NULL,
  `JENIS_TRANS_KAS_PKK` smallint(6) DEFAULT NULL,
  `NOMINAL_KAS_PKK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kas_pkk`
--

INSERT INTO `kas_pkk` (`ID_KAS_PKK`, `NO_KTP_IBU_PKK`, `ID_JENIS_KAS`, `ID_PENGURUS_PKK`, `TGL_KAS_PKK`, `JENIS_TRANS_KAS_PKK`, `NOMINAL_KAS_PKK`) VALUES
(1, '1234560101600001', '1', 'bendum', '1985-04-05', 1, 13000),
(2, '1234560404640004', '1', 'ket', '1985-04-05', 1, 16000),
(3, '1234563010610001', '1', 'bendum', '1985-05-05', 1, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas_posyandu`
--

CREATE TABLE IF NOT EXISTS `kas_posyandu` (
  `ID_KAS` varchar(10) NOT NULL,
  `ID_POSYANDU` int(11) DEFAULT NULL,
  `TGL_KAS` date DEFAULT NULL,
  `JENIS_TRANS_KAS` smallint(6) DEFAULT NULL,
  `NOMINAL_KAS` int(11) DEFAULT NULL,
  `KETERANGAN_KAS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kas_posyandu`
--

INSERT INTO `kas_posyandu` (`ID_KAS`, `ID_POSYANDU`, `TGL_KAS`, `JENIS_TRANS_KAS`, `NOMINAL_KAS`, `KETERANGAN_KAS`) VALUES
('in001', 1, '1985-01-01', 1, 50000, 'lunas'),
('in002', 1, '1985-01-01', 1, 50000, 'lunas'),
('out001', 1, '1985-01-01', 0, 25000, 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluhan`
--

CREATE TABLE IF NOT EXISTS `keluhan` (
`ID_KELUHAN` int(11) NOT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `JUDUL_KELUHAN` varchar(30) DEFAULT NULL,
  `TGL_KELUHAN` timestamp NULL DEFAULT NULL,
  `ISI_KELUHAN` varchar(1024) DEFAULT NULL,
  `BALASAN_KELUHAN` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_bidang`
--

CREATE TABLE IF NOT EXISTS `laporan_bidang` (
  `ID_LAPORAN` varchar(10) NOT NULL,
  `ID_PENGURUS_PKK` varchar(10) DEFAULT NULL,
  `FILE_LAPORAN` varchar(100) DEFAULT NULL,
  `TGL_LAPORAN` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_bidang`
--

INSERT INTO `laporan_bidang` (`ID_LAPORAN`, `ID_PENGURUS_PKK`, `FILE_LAPORAN`, `TGL_LAPORAN`) VALUES
('001', 'bendum', 'laporan keuangan.docx', '1985-03-03 00:00:00'),
('002', 'sekret', 'proposal pengajuan dana.docx', '1985-03-03 00:00:00'),
('003', 'ket', 'laporan pertanggung jawaban.pdf', '1985-03-03 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notulensi`
--

CREATE TABLE IF NOT EXISTS `notulensi` (
  `ID_NOTULENSI` varchar(10) NOT NULL,
  `ID_PENGURUS_PKK` varchar(10) DEFAULT NULL,
  `TGL_NOTULENSI` date DEFAULT NULL,
  `ISI_NOTULENSI` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notulensi`
--

INSERT INTO `notulensi` (`ID_NOTULENSI`, `ID_PENGURUS_PKK`, `TGL_NOTULENSI`, `ISI_NOTULENSI`) VALUES
('1', 'ket', '1985-02-03', 'pemilihan ketua baru'),
('2', 'ket', '1985-02-02', 'rapat rutin pengurus hingga sore hari'),
('3', 'ket', '1985-02-04', 'Rencana suksesi ketua lama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberian_imunisasi`
--

CREATE TABLE IF NOT EXISTS `pemberian_imunisasi` (
`ID_BERI_IMUNISASI` int(11) NOT NULL,
  `ID_POSYANDU` int(11) DEFAULT NULL,
  `ID_IMUNISASI` varchar(10) DEFAULT NULL,
  `ID_BALITA` int(11) DEFAULT NULL,
  `TGL_BERI_IMUNISASI` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberian_kapsul`
--

CREATE TABLE IF NOT EXISTS `pemberian_kapsul` (
`ID_BERI_KAPSUL` int(11) NOT NULL,
  `ID_POSYANDU` int(11) DEFAULT NULL,
  `ID_BALITA` int(11) DEFAULT NULL,
  `TGL_BERI_KAPSUL` date DEFAULT NULL,
  `UMUR` varchar(20) NOT NULL,
  `JENIS_KAPSUL` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `ID_PENGUMUMAN` varchar(10) NOT NULL,
  `ID_PENGURUS_PKK` varchar(10) DEFAULT NULL,
  `TGL_PENGUMUMAN` timestamp NULL DEFAULT NULL,
  `JUDUL_PENGUMUMAN` varchar(30) DEFAULT NULL,
  `ISI_PENGUMUMAN` mediumtext,
  `LINK_UPLOAD_PENGUMUMAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`ID_PENGUMUMAN`, `ID_PENGURUS_PKK`, `TGL_PENGUMUMAN`, `JUDUL_PENGUMUMAN`, `ISI_PENGUMUMAN`, `LINK_UPLOAD_PENGUMUMAN`) VALUES
('1', 'bendum', '1985-03-01 00:00:00', 'hello world', 'selamat datang kepada seluruh pengurus, selamat bekerja dan saling menyapa', 'bit.ly/pertamax'),
('2', 'ket', '1985-03-02 00:00:00', 'sambutan', 'ass. wr. wb. Saya mengucapkan selamat atas terpilihnya ibu-ibu sekalian sebagai pengurus. mohon kerja samanya', 'bit.ly/kerjasama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman_posyandu`
--

CREATE TABLE IF NOT EXISTS `pengumuman_posyandu` (
  `ID_PENGUMUMAN_POS` varchar(10) NOT NULL,
  `NO_KTP_PENG_POS` varchar(20) DEFAULT NULL,
  `TGL_PENGUMUMAN_POS` timestamp NULL DEFAULT NULL,
  `JUDUL_PENGUMUMAN_POS` varchar(30) DEFAULT NULL,
  `ISI_PENGUMUMAN_POS` mediumtext,
  `LINK_UPLOAD_PENGUMUMAN_POS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengumuman_posyandu`
--

INSERT INTO `pengumuman_posyandu` (`ID_PENGUMUMAN_POS`, `NO_KTP_PENG_POS`, `TGL_PENGUMUMAN_POS`, `JUDUL_PENGUMUMAN_POS`, `ISI_PENGUMUMAN_POS`, `LINK_UPLOAD_PENGUMUMAN_POS`) VALUES
('86APR01', '1235461112600001', '1986-04-01 00:00:00', 'pembukaan', 'selamat datang para pengurus posyandu, awali kerja dengan semangat hingga akhir waktu', 'bit.ly/pengumuman-pembukaan'),
('86APR02', '1235461112600001', '1986-04-01 00:00:00', 'lokasi posyandu', 'posyandu ini terletak pada tepi desa, di sekitar sungai terbersih di Jawa Timur', 'bit.ly/pengumuman-lokasi'),
('86APR03', '1235461112600001', '1986-04-16 00:00:00', 'kehilangan', 'ditemukan kunci motor beserta stnk, harap menghubungi kantor polisi terdekat', 'bit.ly/pengumuman-kehilangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus_pkk`
--

CREATE TABLE IF NOT EXISTS `pengurus_pkk` (
  `ID_PENGURUS_PKK` varchar(10) NOT NULL,
  `ID_PERIODE` varchar(10) DEFAULT NULL,
  `ID_JABATAN` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengurus_pkk`
--

INSERT INTO `pengurus_pkk` (`ID_PENGURUS_PKK`, `ID_PERIODE`, `ID_JABATAN`) VALUES
('ang', '1', '5'),
('bendum', '1', '4'),
('ket', '1', '1'),
('sekret', '1', '3'),
('waket', '1', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus_posyandu`
--

CREATE TABLE IF NOT EXISTS `pengurus_posyandu` (
  `NO_KTP_PENG_POS` varchar(20) NOT NULL,
  `ID_POSYANDU` int(11) DEFAULT NULL,
  `NAMA_PENG_POS` varchar(30) DEFAULT NULL,
  `ALAMAT_PENG_POS` varchar(150) DEFAULT NULL,
  `TELP_PENG_POS` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengurus_posyandu`
--

INSERT INTO `pengurus_posyandu` (`NO_KTP_PENG_POS`, `ID_POSYANDU`, `NAMA_PENG_POS`, `ALAMAT_PENG_POS`, `TELP_PENG_POS`) VALUES
('1235461112600001', 1, 'Slamet Manfaat', 'Jalan Mangga 3', '315989798'),
('1235461112600002', 1, 'Slamet Riadi', 'Jalan Mangga 9', '315989898'),
('1235461112600008', 1, 'Agus Yusuf', 'Jalan Blewah 16', '315784798');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penimbangan`
--

CREATE TABLE IF NOT EXISTS `penimbangan` (
`ID_TIMBANG` int(11) NOT NULL,
  `ID_BALITA` int(11) DEFAULT NULL,
  `ID_POSYANDU` int(11) DEFAULT NULL,
  `UMUR_PENIMBANGAN` int(20) NOT NULL,
  `TGL_TIMBANG` date DEFAULT NULL,
  `BERAT_BADAN` decimal(10,2) DEFAULT NULL,
  `TINGGI_BADAN` decimal(10,2) DEFAULT NULL,
  `ASI` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_DATA_PKK` varchar(10) DEFAULT NULL,
  `TAHUN_MULAI` int(11) DEFAULT NULL,
  `TAHUN_SELESAI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`ID_PERIODE`, `ID_DATA_PKK`, `TAHUN_MULAI`, `TAHUN_SELESAI`) VALUES
('1', '601111', 1985, 1990),
('2', '601111', 1990, 1995),
('3', '601111', 1980, 1985);

-- --------------------------------------------------------

--
-- Struktur dari tabel `posyandu`
--

CREATE TABLE IF NOT EXISTS `posyandu` (
  `ID_POSYANDU` int(11) NOT NULL,
  `NAMA_POSYANDU` varchar(20) NOT NULL,
  `ALAMAT_POSYANDU` varchar(150) DEFAULT NULL,
  `TELP_POSYANDU` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posyandu`
--

INSERT INTO `posyandu` (`ID_POSYANDU`, `NAMA_POSYANDU`, `ALAMAT_POSYANDU`, `TELP_POSYANDU`) VALUES
(1, 'Posyandu 1', 'Jalan Domodomo 9', '315569899'),
(2, 'Posyandu 2', 'Jalan Sumber Kesehatan', '313813113'),
(3, 'Posyandu 3', 'Jalan Bangka Belitung 16', '315873412');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableuser`
--

CREATE TABLE IF NOT EXISTS `tableuser` (
  `EMAIL` varchar(30) NOT NULL,
  `NO_KTP` varchar(20) DEFAULT NULL,
  `NO_KTP_PENG_POS` varchar(20) DEFAULT NULL,
  `NO_KTP_IBU_PKK` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  `USER_TYPE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tableuser`
--

INSERT INTO `tableuser` (`EMAIL`, `NO_KTP`, `NO_KTP_PENG_POS`, `NO_KTP_IBU_PKK`, `PASSWORD`, `USER_TYPE`) VALUES
('amin@ah.com', '1234563010610001', NULL, '1234563010610001', 'aamiinn', 'user'),
('manfaat@facebook.com', NULL, '1235461112600002', NULL, 'manfaat', 'user'),
('soimah@gmail.com', '1234560101600001', NULL, '1234560101600001', 'soimah', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
 ADD PRIMARY KEY (`ID_ABSEN`), ADD UNIQUE KEY `ABSEN_PK` (`ID_ABSEN`), ADD KEY `RELATIONSHIP_8_FK` (`ID_NOTULENSI`), ADD KEY `RELATIONSHIP_12_FK` (`NO_KTP_IBU_PKK`);

--
-- Indexes for table `balita`
--
ALTER TABLE `balita`
 ADD PRIMARY KEY (`ID_BALITA`), ADD UNIQUE KEY `BALITA_PK` (`ID_BALITA`), ADD KEY `RELATIONSHIP_13_FK` (`NO_KTP`);

--
-- Indexes for table `data_jentik`
--
ALTER TABLE `data_jentik`
 ADD PRIMARY KEY (`ID_PEMERIKSAAN`), ADD UNIQUE KEY `DATA_JENTIK_PK` (`ID_PEMERIKSAAN`), ADD KEY `RELATIONSHIP_1_FK` (`NO_KTP_IBU_PKK`), ADD KEY `RELATIONSHIP_2_FK` (`ID_DATA_PKK`);

--
-- Indexes for table `data_pkk`
--
ALTER TABLE `data_pkk`
 ADD PRIMARY KEY (`ID_DATA_PKK`), ADD UNIQUE KEY `DATA_PKK_PK` (`ID_DATA_PKK`);

--
-- Indexes for table `ibu_balita`
--
ALTER TABLE `ibu_balita`
 ADD PRIMARY KEY (`NO_KTP`), ADD UNIQUE KEY `IBU_BALITA_PK` (`NO_KTP`);

--
-- Indexes for table `ibu_pkk`
--
ALTER TABLE `ibu_pkk`
 ADD PRIMARY KEY (`NO_KTP_IBU_PKK`), ADD UNIQUE KEY `IBU_PKK_PK` (`NO_KTP_IBU_PKK`), ADD KEY `RELATIONSHIP_22_FK` (`ID_DATA_PKK`), ADD KEY `RELATIONSHIP_29_FK` (`ID_PENGURUS_PKK`);

--
-- Indexes for table `imunisasi`
--
ALTER TABLE `imunisasi`
 ADD PRIMARY KEY (`ID_IMUNISASI`), ADD UNIQUE KEY `IMUNISASI_PK` (`ID_IMUNISASI`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
 ADD PRIMARY KEY (`ID_JABATAN`), ADD UNIQUE KEY `JABATAN_PK` (`ID_JABATAN`);

--
-- Indexes for table `jenis_kas`
--
ALTER TABLE `jenis_kas`
 ADD PRIMARY KEY (`ID_JENIS_KAS`), ADD UNIQUE KEY `JENIS_KAS_PK` (`ID_JENIS_KAS`);

--
-- Indexes for table `kas_pkk`
--
ALTER TABLE `kas_pkk`
 ADD PRIMARY KEY (`ID_KAS_PKK`), ADD UNIQUE KEY `KAS_PKK_PK` (`ID_KAS_PKK`), ADD KEY `RELATIONSHIP_10_FK` (`ID_PENGURUS_PKK`), ADD KEY `RELATIONSHIP_25_FK` (`ID_JENIS_KAS`), ADD KEY `RELATIONSHIP_32_FK` (`NO_KTP_IBU_PKK`);

--
-- Indexes for table `kas_posyandu`
--
ALTER TABLE `kas_posyandu`
 ADD PRIMARY KEY (`ID_KAS`), ADD UNIQUE KEY `KAS_POSYANDU_PK` (`ID_KAS`), ADD KEY `RELATIONSHIP_14_FK` (`ID_POSYANDU`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
 ADD PRIMARY KEY (`ID_KELUHAN`), ADD UNIQUE KEY `KELUHAN_PK` (`ID_KELUHAN`), ADD KEY `RELATIONSHIP_34_FK` (`EMAIL`);

--
-- Indexes for table `laporan_bidang`
--
ALTER TABLE `laporan_bidang`
 ADD PRIMARY KEY (`ID_LAPORAN`), ADD UNIQUE KEY `LAPORAN_BIDANG_PK` (`ID_LAPORAN`), ADD KEY `RELATIONSHIP_31_FK` (`ID_PENGURUS_PKK`);

--
-- Indexes for table `notulensi`
--
ALTER TABLE `notulensi`
 ADD PRIMARY KEY (`ID_NOTULENSI`), ADD UNIQUE KEY `NOTULENSI_PK` (`ID_NOTULENSI`), ADD KEY `RELATIONSHIP_11_FK` (`ID_PENGURUS_PKK`);

--
-- Indexes for table `pemberian_imunisasi`
--
ALTER TABLE `pemberian_imunisasi`
 ADD PRIMARY KEY (`ID_BERI_IMUNISASI`), ADD UNIQUE KEY `PEMBERIAN_IMUNISASI_PK` (`ID_BERI_IMUNISASI`), ADD KEY `RELATIONSHIP_15_FK` (`ID_IMUNISASI`), ADD KEY `RELATIONSHIP_16_FK` (`ID_BALITA`), ADD KEY `RELATIONSHIP_17_FK` (`ID_POSYANDU`);

--
-- Indexes for table `pemberian_kapsul`
--
ALTER TABLE `pemberian_kapsul`
 ADD PRIMARY KEY (`ID_BERI_KAPSUL`), ADD UNIQUE KEY `PEMBERIAN_KAPSUL_PK` (`ID_BERI_KAPSUL`), ADD KEY `RELATIONSHIP_19_FK` (`ID_POSYANDU`), ADD KEY `RELATIONSHIP_21_FK` (`ID_BALITA`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
 ADD PRIMARY KEY (`ID_PENGUMUMAN`), ADD UNIQUE KEY `PENGUMUMAN_PK` (`ID_PENGUMUMAN`), ADD KEY `RELATIONSHIP_9_FK` (`ID_PENGURUS_PKK`);

--
-- Indexes for table `pengumuman_posyandu`
--
ALTER TABLE `pengumuman_posyandu`
 ADD PRIMARY KEY (`ID_PENGUMUMAN_POS`), ADD UNIQUE KEY `PENGUMUMAN_POSYANDU_PK` (`ID_PENGUMUMAN_POS`), ADD KEY `RELATIONSHIP_33_FK` (`NO_KTP_PENG_POS`);

--
-- Indexes for table `pengurus_pkk`
--
ALTER TABLE `pengurus_pkk`
 ADD PRIMARY KEY (`ID_PENGURUS_PKK`), ADD UNIQUE KEY `PENGURUS_PKK_PK` (`ID_PENGURUS_PKK`), ADD KEY `RELATIONSHIP_23_FK` (`ID_PERIODE`), ADD KEY `RELATIONSHIP_24_FK` (`ID_JABATAN`);

--
-- Indexes for table `pengurus_posyandu`
--
ALTER TABLE `pengurus_posyandu`
 ADD PRIMARY KEY (`NO_KTP_PENG_POS`), ADD UNIQUE KEY `PENGURUS_POSYANDU_PK` (`NO_KTP_PENG_POS`), ADD KEY `RELATIONSHIP_26_FK` (`ID_POSYANDU`);

--
-- Indexes for table `penimbangan`
--
ALTER TABLE `penimbangan`
 ADD PRIMARY KEY (`ID_TIMBANG`), ADD UNIQUE KEY `PENIMBANGAN_PK` (`ID_TIMBANG`), ADD KEY `RELATIONSHIP_18_FK` (`ID_POSYANDU`), ADD KEY `RELATIONSHIP_20_FK` (`ID_BALITA`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
 ADD PRIMARY KEY (`ID_PERIODE`), ADD UNIQUE KEY `PERIODE_PK` (`ID_PERIODE`), ADD KEY `RELATIONSHIP_4_FK` (`ID_DATA_PKK`);

--
-- Indexes for table `posyandu`
--
ALTER TABLE `posyandu`
 ADD PRIMARY KEY (`ID_POSYANDU`), ADD UNIQUE KEY `POSYANDU_PK` (`ID_POSYANDU`);

--
-- Indexes for table `tableuser`
--
ALTER TABLE `tableuser`
 ADD PRIMARY KEY (`EMAIL`), ADD UNIQUE KEY `USER_PK` (`EMAIL`), ADD KEY `RELATIONSHIP_27_FK` (`NO_KTP_PENG_POS`), ADD KEY `RELATIONSHIP_28_FK` (`NO_KTP_IBU_PKK`), ADD KEY `RELATIONSHIP_30_FK` (`NO_KTP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balita`
--
ALTER TABLE `balita`
MODIFY `ID_BALITA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
MODIFY `ID_KELUHAN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemberian_imunisasi`
--
ALTER TABLE `pemberian_imunisasi`
MODIFY `ID_BERI_IMUNISASI` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemberian_kapsul`
--
ALTER TABLE `pemberian_kapsul`
MODIFY `ID_BERI_KAPSUL` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penimbangan`
--
ALTER TABLE `penimbangan`
MODIFY `ID_TIMBANG` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen`
--
ALTER TABLE `absen`
ADD CONSTRAINT `FK_ABSEN_RELATIONS_IBU_PKK` FOREIGN KEY (`NO_KTP_IBU_PKK`) REFERENCES `ibu_pkk` (`NO_KTP_IBU_PKK`),
ADD CONSTRAINT `FK_ABSEN_RELATIONS_NOTULENS` FOREIGN KEY (`ID_NOTULENSI`) REFERENCES `notulensi` (`ID_NOTULENSI`);

--
-- Ketidakleluasaan untuk tabel `balita`
--
ALTER TABLE `balita`
ADD CONSTRAINT `FK_BALITA_RELATIONS_IBU_BALI` FOREIGN KEY (`NO_KTP`) REFERENCES `ibu_balita` (`NO_KTP`);

--
-- Ketidakleluasaan untuk tabel `data_jentik`
--
ALTER TABLE `data_jentik`
ADD CONSTRAINT `FK_DATA_JEN_RELATIONS_DATA_PKK` FOREIGN KEY (`ID_DATA_PKK`) REFERENCES `data_pkk` (`ID_DATA_PKK`),
ADD CONSTRAINT `FK_DATA_JEN_RELATIONS_IBU_PKK` FOREIGN KEY (`NO_KTP_IBU_PKK`) REFERENCES `ibu_pkk` (`NO_KTP_IBU_PKK`);

--
-- Ketidakleluasaan untuk tabel `ibu_pkk`
--
ALTER TABLE `ibu_pkk`
ADD CONSTRAINT `FK_IBU_PKK_RELATIONS_DATA_PKK` FOREIGN KEY (`ID_DATA_PKK`) REFERENCES `data_pkk` (`ID_DATA_PKK`),
ADD CONSTRAINT `FK_IBU_PKK_RELATIONS_PENGURUS` FOREIGN KEY (`ID_PENGURUS_PKK`) REFERENCES `pengurus_pkk` (`ID_PENGURUS_PKK`);

--
-- Ketidakleluasaan untuk tabel `kas_pkk`
--
ALTER TABLE `kas_pkk`
ADD CONSTRAINT `FK_KAS_PKK_RELATIONS_IBU_PKK` FOREIGN KEY (`NO_KTP_IBU_PKK`) REFERENCES `ibu_pkk` (`NO_KTP_IBU_PKK`),
ADD CONSTRAINT `FK_KAS_PKK_RELATIONS_JENIS_KA` FOREIGN KEY (`ID_JENIS_KAS`) REFERENCES `jenis_kas` (`ID_JENIS_KAS`),
ADD CONSTRAINT `FK_KAS_PKK_RELATIONS_PENGURUS` FOREIGN KEY (`ID_PENGURUS_PKK`) REFERENCES `pengurus_pkk` (`ID_PENGURUS_PKK`);

--
-- Ketidakleluasaan untuk tabel `kas_posyandu`
--
ALTER TABLE `kas_posyandu`
ADD CONSTRAINT `FK_KAS_POSY_RELATIONS_POSYANDU` FOREIGN KEY (`ID_POSYANDU`) REFERENCES `posyandu` (`ID_POSYANDU`);

--
-- Ketidakleluasaan untuk tabel `keluhan`
--
ALTER TABLE `keluhan`
ADD CONSTRAINT `FK_KELUHAN_RELATIONS_TABLEUSE` FOREIGN KEY (`EMAIL`) REFERENCES `tableuser` (`EMAIL`);

--
-- Ketidakleluasaan untuk tabel `laporan_bidang`
--
ALTER TABLE `laporan_bidang`
ADD CONSTRAINT `FK_LAPORAN__RELATIONS_PENGURUS` FOREIGN KEY (`ID_PENGURUS_PKK`) REFERENCES `pengurus_pkk` (`ID_PENGURUS_PKK`);

--
-- Ketidakleluasaan untuk tabel `notulensi`
--
ALTER TABLE `notulensi`
ADD CONSTRAINT `FK_NOTULENS_RELATIONS_PENGURUS` FOREIGN KEY (`ID_PENGURUS_PKK`) REFERENCES `pengurus_pkk` (`ID_PENGURUS_PKK`);

--
-- Ketidakleluasaan untuk tabel `pemberian_imunisasi`
--
ALTER TABLE `pemberian_imunisasi`
ADD CONSTRAINT `FK_PEMBERIA_RELATIONS_IMUNISAS` FOREIGN KEY (`ID_IMUNISASI`) REFERENCES `imunisasi` (`ID_IMUNISASI`),
ADD CONSTRAINT `FK_PEMBERIA_RELATIONS_POSYANDU` FOREIGN KEY (`ID_POSYANDU`) REFERENCES `posyandu` (`ID_POSYANDU`),
ADD CONSTRAINT `pemberian_imunisasi_ibfk_1` FOREIGN KEY (`ID_BALITA`) REFERENCES `balita` (`ID_BALITA`);

--
-- Ketidakleluasaan untuk tabel `pemberian_kapsul`
--
ALTER TABLE `pemberian_kapsul`
ADD CONSTRAINT `FK_PEMBERI_RELATIONS_POSYANDU` FOREIGN KEY (`ID_POSYANDU`) REFERENCES `posyandu` (`ID_POSYANDU`),
ADD CONSTRAINT `pemberian_kapsul_ibfk_1` FOREIGN KEY (`ID_BALITA`) REFERENCES `balita` (`ID_BALITA`);

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
ADD CONSTRAINT `FK_PENGUMU_RELATIONS_PENGURUS` FOREIGN KEY (`ID_PENGURUS_PKK`) REFERENCES `pengurus_pkk` (`ID_PENGURUS_PKK`);

--
-- Ketidakleluasaan untuk tabel `pengumuman_posyandu`
--
ALTER TABLE `pengumuman_posyandu`
ADD CONSTRAINT `FK_PENGUMUM_RELATIONS_PENGURUS` FOREIGN KEY (`NO_KTP_PENG_POS`) REFERENCES `pengurus_posyandu` (`NO_KTP_PENG_POS`);

--
-- Ketidakleluasaan untuk tabel `pengurus_pkk`
--
ALTER TABLE `pengurus_pkk`
ADD CONSTRAINT `FK_PENGURUS_RELATIONS_JABATAN` FOREIGN KEY (`ID_JABATAN`) REFERENCES `jabatan` (`ID_JABATAN`),
ADD CONSTRAINT `FK_PENGURUS_RELATIONS_PERIODE` FOREIGN KEY (`ID_PERIODE`) REFERENCES `periode` (`ID_PERIODE`);

--
-- Ketidakleluasaan untuk tabel `pengurus_posyandu`
--
ALTER TABLE `pengurus_posyandu`
ADD CONSTRAINT `FK_PENGURUS_RELATIONS_POSYANDU` FOREIGN KEY (`ID_POSYANDU`) REFERENCES `posyandu` (`ID_POSYANDU`);

--
-- Ketidakleluasaan untuk tabel `penimbangan`
--
ALTER TABLE `penimbangan`
ADD CONSTRAINT `penimbangan_ibfk_1` FOREIGN KEY (`ID_POSYANDU`) REFERENCES `posyandu` (`ID_POSYANDU`),
ADD CONSTRAINT `penimbangan_ibfk_2` FOREIGN KEY (`ID_BALITA`) REFERENCES `balita` (`ID_BALITA`);

--
-- Ketidakleluasaan untuk tabel `periode`
--
ALTER TABLE `periode`
ADD CONSTRAINT `FK_PERIODE_RELATIONS_DATA_PKK` FOREIGN KEY (`ID_DATA_PKK`) REFERENCES `data_pkk` (`ID_DATA_PKK`);

--
-- Ketidakleluasaan untuk tabel `tableuser`
--
ALTER TABLE `tableuser`
ADD CONSTRAINT `FK_TABLEUSE_RELATIONS_IBU_BALI` FOREIGN KEY (`NO_KTP`) REFERENCES `ibu_balita` (`NO_KTP`),
ADD CONSTRAINT `FK_TABLEUSE_RELATIONS_IBU_PKK` FOREIGN KEY (`NO_KTP_IBU_PKK`) REFERENCES `ibu_pkk` (`NO_KTP_IBU_PKK`),
ADD CONSTRAINT `FK_TABLEUSE_RELATIONS_PENGURUS` FOREIGN KEY (`NO_KTP_PENG_POS`) REFERENCES `pengurus_posyandu` (`NO_KTP_PENG_POS`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
