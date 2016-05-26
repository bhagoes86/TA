/*==============================================================*/
/* DBMS name:      Sybase SQL Anywhere 10                       */
/* Created on:     4/6/2015 9:20:47 PM                          */
/*==============================================================*/

/*==============================================================*/
/* Table: ABSEN                                                 */
/*==============================================================*/
create table ABSEN 
(
   ID_ABSEN             varchar(10)                    not null,
   ID_NOTULENSI         varchar(10)                    null,
   NO_KTP_IBU_PKK       varchar(20)                    null,
   KEHADIRAN            smallint                       null,
   constraint PK_ABSEN primary key (ID_ABSEN)
);

/*==============================================================*/
/* Index: ABSEN_PK                                              */
/*==============================================================*/
create unique index ABSEN_PK on ABSEN (
ID_ABSEN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_8_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_8_FK on ABSEN (
ID_NOTULENSI ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_12_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_12_FK on ABSEN (
NO_KTP_IBU_PKK ASC
);

/*==============================================================*/
/* Table: BALITA                                                */
/*==============================================================*/
create table BALITA 
(
   ID_BALITA            numeric                        not null,
   NO_KTP               varchar(20)                    null,
   NO_KK_BALITA         varchar(20)                    null,
   NAMA_BALITA          varchar(30)                    null,
   JNS_KELAMIN          varchar(5)                     null,
   ANAK_KE              numeric                        null,
   TGL_LAHIR            date                           null,
   TGL_DAFTAR           date                           null,
   TB_LAHIR             decimal(10,2)                  null,
   BB_LAHIR             decimal(10,2)                  null,
   NAMA_AYAH            varchar(30)                    null,
   PEKERJAAN_AYAH       varchar(20)                    null,
   PEKERJAAN_IBU        varchar(20)                    null,
   STATUS_BALITA        varchar(20)                    null,
   constraint PK_BALITA primary key (ID_BALITA)
);

/*==============================================================*/
/* Index: BALITA_PK                                             */
/*==============================================================*/
create unique index BALITA_PK on BALITA (
ID_BALITA ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_13_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_13_FK on BALITA (
NO_KTP ASC
);

/*==============================================================*/
/* Table: DATA_JENTIK                                           */
/*==============================================================*/
create table DATA_JENTIK 
(
   ID_PEMERIKSAAN       varchar(10)                    not null,
   ID_DATA_PKK          varchar(10)                    null,
   NO_KTP_IBU_PKK       varchar(20)                    null,
   TGL_PEMERIKSAAN      date                           null,
   ADA_JENTIK           smallint                       null,
   constraint PK_DATA_JENTIK primary key (ID_PEMERIKSAAN)
);

/*==============================================================*/
/* Index: DATA_JENTIK_PK                                        */
/*==============================================================*/
create unique index DATA_JENTIK_PK on DATA_JENTIK (
ID_PEMERIKSAAN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_1_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_1_FK on DATA_JENTIK (
NO_KTP_IBU_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_2_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_2_FK on DATA_JENTIK (
ID_DATA_PKK ASC
);

/*==============================================================*/
/* Table: DATA_PKK                                              */
/*==============================================================*/
create table DATA_PKK 
(
   ID_DATA_PKK          varchar(10)                    not null,
   RT_PKK               numeric                        null,
   RW_PKK               numeric                        null,
   KELURAHAN_PKK        varchar(20)                    null,
   KECAMATAN_PKK        varchar(20)                    null,
   KABUPATEN_PKK        varchar(20)                    null,
   PROVINSI_PKK         varchar(20)                    null,
   constraint PK_DATA_PKK primary key (ID_DATA_PKK)
);

/*==============================================================*/
/* Index: DATA_PKK_PK                                           */
/*==============================================================*/
create unique index DATA_PKK_PK on DATA_PKK (
ID_DATA_PKK ASC
);

/*==============================================================*/
/* Table: IBU_BALITA                                            */
/*==============================================================*/
create table IBU_BALITA 
(
   NO_KTP               varchar(20)                    not null,
   NAMA_IBU             varchar(30)                    null,
   ALAMAT_IBU           varchar(150)                   null,
   TELP_IBU             varchar(20)                    null,
   TGL_LAHIR_IBU        date                           null,
   constraint PK_IBU_BALITA primary key (NO_KTP)
);

/*==============================================================*/
/* Index: IBU_BALITA_PK                                         */
/*==============================================================*/
create unique index IBU_BALITA_PK on IBU_BALITA (
NO_KTP ASC
);

/*==============================================================*/
/* Table: IBU_PKK                                               */
/*==============================================================*/
create table IBU_PKK 
(
   NO_KTP_IBU_PKK       varchar(20)                    not null,
   ID_DATA_PKK          varchar(10)                    null,
   ID_PENGURUS_PKK      varchar(10)                    null,
   NAMA_IBU_PKK         varchar(30)                    null,
   ALAMAT_IBU_PKK       varchar(200)                   null,
   TLP_IBU_PKK          varchar(20)                    null,
   constraint PK_IBU_PKK primary key (NO_KTP_IBU_PKK)
);

/*==============================================================*/
/* Index: IBU_PKK_PK                                            */
/*==============================================================*/
create unique index IBU_PKK_PK on IBU_PKK (
NO_KTP_IBU_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_22_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_22_FK on IBU_PKK (
ID_DATA_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_29_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_29_FK on IBU_PKK (
ID_PENGURUS_PKK ASC
);

/*==============================================================*/
/* Table: IMUNISASI                                             */
/*==============================================================*/
create table IMUNISASI 
(
   ID_IMUNISASI         varchar(10)                    not null,
   JENIS_IMUNISASI      varchar(20)                    null,
   UMUR_IMUNISASI       integer                        null,
   constraint PK_IMUNISASI primary key (ID_IMUNISASI)
);

/*==============================================================*/
/* Index: IMUNISASI_PK                                          */
/*==============================================================*/
create unique index IMUNISASI_PK on IMUNISASI (
ID_IMUNISASI ASC
);

/*==============================================================*/
/* Table: JABATAN                                               */
/*==============================================================*/
create table JABATAN 
(
   ID_JABATAN           varchar(10)                    not null,
   NAMA_JABATAN         varchar(30)                    null,
   constraint PK_JABATAN primary key (ID_JABATAN)
);

/*==============================================================*/
/* Index: JABATAN_PK                                            */
/*==============================================================*/
create unique index JABATAN_PK on JABATAN (
ID_JABATAN ASC
);

/*==============================================================*/
/* Table: JENIS_KAS                                             */
/*==============================================================*/
create table JENIS_KAS 
(
   ID_JENIS_KAS         varchar(10)                    not null,
   JENIS_KAS            varchar(20)                    null,
   constraint PK_JENIS_KAS primary key (ID_JENIS_KAS)
);

/*==============================================================*/
/* Index: JENIS_KAS_PK                                          */
/*==============================================================*/
create unique index JENIS_KAS_PK on JENIS_KAS (
ID_JENIS_KAS ASC
);

/*==============================================================*/
/* Table: KAS_PKK                                               */
/*==============================================================*/
create table KAS_PKK 
(
   ID_KAS_PKK           varchar(10)                    not null,
   NO_KTP_IBU_PKK       varchar(20)                    null,
   ID_JENIS_KAS         varchar(10)                    null,
   ID_PENGURUS_PKK      varchar(10)                    null,
   TGL_KAS_PKK          date                           null,
   JENIS_TRANS_KAS_PKK  smallint                       null,
   NOMINAL_KAS_PKK      integer                        null,
   constraint PK_KAS_PKK primary key (ID_KAS_PKK)
);

/*==============================================================*/
/* Index: KAS_PKK_PK                                            */
/*==============================================================*/
create unique index KAS_PKK_PK on KAS_PKK (
ID_KAS_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_10_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_10_FK on KAS_PKK (
ID_PENGURUS_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_25_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_25_FK on KAS_PKK (
ID_JENIS_KAS ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_32_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_32_FK on KAS_PKK (
NO_KTP_IBU_PKK ASC
);

/*==============================================================*/
/* Table: KAS_POSYANDU                                          */
/*==============================================================*/
create table KAS_POSYANDU 
(
   ID_KAS               varchar(10)                    not null,
   ID_POSYANDU          varchar(10)                    null,
   TGL_KAS              date                           null,
   JENIS_TRANS_KAS      smallint                       null,
   NOMINAL_KAS          integer                        null,
   KETERANGAN_KAS       varchar(30)                    null,
   constraint PK_KAS_POSYANDU primary key (ID_KAS)
);

/*==============================================================*/
/* Index: KAS_POSYANDU_PK                                       */
/*==============================================================*/
create unique index KAS_POSYANDU_PK on KAS_POSYANDU (
ID_KAS ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_14_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_14_FK on KAS_POSYANDU (
ID_POSYANDU ASC
);

/*==============================================================*/
/* Table: KELUHAN                                               */
/*==============================================================*/
create table KELUHAN 
(
   ID_KELUHAN           varchar(10)                    not null,
   EMAIL                varchar(30)                    null,
   JUDUL_KELUHAN        varchar(30)                    null,
   TGL_KELUHAN          timestamp                      null,
   ISI_KELUHAN          varchar(1024)                  null,
   constraint PK_KELUHAN primary key (ID_KELUHAN)
);

/*==============================================================*/
/* Index: KELUHAN_PK                                            */
/*==============================================================*/
create unique index KELUHAN_PK on KELUHAN (
ID_KELUHAN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_34_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_34_FK on KELUHAN (
EMAIL ASC
);

/*==============================================================*/
/* Table: LAPORAN_BIDANG                                        */
/*==============================================================*/
create table LAPORAN_BIDANG 
(
   ID_LAPORAN           varchar(10)                    not null,
   ID_PENGURUS_PKK      varchar(10)                    null,
   FILE_LAPORAN         varchar(100)                   null,
   TGL_LAPORAN          timestamp                      null,
   constraint PK_LAPORAN_BIDANG primary key (ID_LAPORAN)
);

/*==============================================================*/
/* Index: LAPORAN_BIDANG_PK                                     */
/*==============================================================*/
create unique index LAPORAN_BIDANG_PK on LAPORAN_BIDANG (
ID_LAPORAN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_31_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_31_FK on LAPORAN_BIDANG (
ID_PENGURUS_PKK ASC
);

/*==============================================================*/
/* Table: NOTULENSI                                             */
/*==============================================================*/
create table NOTULENSI 
(
   ID_NOTULENSI         varchar(10)                    not null,
   ID_PENGURUS_PKK      varchar(10)                    null,
   TGL_NOTULENSI        date                           null,
   ISI_NOTULENSI        long varchar                   null,
   constraint PK_NOTULENSI primary key (ID_NOTULENSI)
);

/*==============================================================*/
/* Index: NOTULENSI_PK                                          */
/*==============================================================*/
create unique index NOTULENSI_PK on NOTULENSI (
ID_NOTULENSI ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_11_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_11_FK on NOTULENSI (
ID_PENGURUS_PKK ASC
);

/*==============================================================*/
/* Table: PEMBERIAN_IMUNISASI                                   */
/*==============================================================*/
create table PEMBERIAN_IMUNISASI 
(
   ID_BERI_IMUNISASI    varchar(10)                    not null,
   ID_POSYANDU          varchar(10)                    null,
   ID_IMUNISASI         varchar(10)                    null,
   ID_BALITA            numeric                        null,
   TGL_BERI_IMUNISASI   date                           null,
   constraint PK_PEMBERIAN_IMUNISASI primary key (ID_BERI_IMUNISASI)
);

/*==============================================================*/
/* Index: PEMBERIAN_IMUNISASI_PK                                */
/*==============================================================*/
create unique index PEMBERIAN_IMUNISASI_PK on PEMBERIAN_IMUNISASI (
ID_BERI_IMUNISASI ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_15_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_15_FK on PEMBERIAN_IMUNISASI (
ID_IMUNISASI ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_16_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_16_FK on PEMBERIAN_IMUNISASI (
ID_BALITA ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_17_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_17_FK on PEMBERIAN_IMUNISASI (
ID_POSYANDU ASC
);

/*==============================================================*/
/* Table: PEMBERIAN_KAPSUL                                      */
/*==============================================================*/
create table PEMBERIAN_KAPSUL 
(
   ID_BERI_KAPSUL       varchar(10)                    not null,
   ID_POSYANDU          varchar(10)                    null,
   ID_BALITA            numeric                        null,
   TGL_BERI_KAPSUL      date                           null,
   JENIS_KAPSUL         varchar(20)                    null,
   constraint PK_PEMBERIAN_KAPSUL primary key (ID_BERI_KAPSUL)
);

/*==============================================================*/
/* Index: PEMBERIAN_KAPSUL_PK                                   */
/*==============================================================*/
create unique index PEMBERIAN_KAPSUL_PK on PEMBERIAN_KAPSUL (
ID_BERI_KAPSUL ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_19_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_19_FK on PEMBERIAN_KAPSUL (
ID_POSYANDU ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_21_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_21_FK on PEMBERIAN_KAPSUL (
ID_BALITA ASC
);

/*==============================================================*/
/* Table: PENGUMUMAN                                            */
/*==============================================================*/
create table PENGUMUMAN 
(
   ID_PENGUMUMAN        varchar(10)                    not null,
   ID_PENGURUS_PKK      varchar(10)                    null,
   TGL_PENGUMUMAN       timestamp                      null,
   JUDUL_PENGUMUMAN     varchar(30)                    null,
   ISI_PENGUMUMAN       long varchar                   null,
   LINK_UPLOAD_PENGUMUMAN varchar(50)                    null,
   constraint PK_PENGUMUMAN primary key (ID_PENGUMUMAN)
);

/*==============================================================*/
/* Index: PENGUMUMAN_PK                                         */
/*==============================================================*/
create unique index PENGUMUMAN_PK on PENGUMUMAN (
ID_PENGUMUMAN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_9_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_9_FK on PENGUMUMAN (
ID_PENGURUS_PKK ASC
);

/*==============================================================*/
/* Table: PENGUMUMAN_POSYANDU                                   */
/*==============================================================*/
create table PENGUMUMAN_POSYANDU 
(
   ID_PENGUMUMAN_POS    varchar(10)                    not null,
   NO_KTP_PENG_POS      varchar(20)                    null,
   TGL_PENGUMUMAN_POS   timestamp                      null,
   JUDUL_PENGUMUMAN_POS varchar(30)                    null,
   ISI_PENGUMUMAN_POS   long varchar                   null,
   LINK_UPLOAD_PENGUMUMAN_POS varchar(50)                    null,
   constraint PK_PENGUMUMAN_POSYANDU primary key (ID_PENGUMUMAN_POS)
);

/*==============================================================*/
/* Index: PENGUMUMAN_POSYANDU_PK                                */
/*==============================================================*/
create unique index PENGUMUMAN_POSYANDU_PK on PENGUMUMAN_POSYANDU (
ID_PENGUMUMAN_POS ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_33_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_33_FK on PENGUMUMAN_POSYANDU (
NO_KTP_PENG_POS ASC
);

/*==============================================================*/
/* Table: PENGURUS_PKK                                          */
/*==============================================================*/
create table PENGURUS_PKK 
(
   ID_PENGURUS_PKK      varchar(10)                    not null,
   ID_PERIODE           varchar(10)                    null,
   ID_JABATAN           varchar(10)                    null,
   constraint PK_PENGURUS_PKK primary key (ID_PENGURUS_PKK)
);

/*==============================================================*/
/* Index: PENGURUS_PKK_PK                                       */
/*==============================================================*/
create unique index PENGURUS_PKK_PK on PENGURUS_PKK (
ID_PENGURUS_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_23_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_23_FK on PENGURUS_PKK (
ID_PERIODE ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_24_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_24_FK on PENGURUS_PKK (
ID_JABATAN ASC
);

/*==============================================================*/
/* Table: PENGURUS_POSYANDU                                     */
/*==============================================================*/
create table PENGURUS_POSYANDU 
(
   NO_KTP_PENG_POS      varchar(20)                    not null,
   ID_POSYANDU          varchar(10)                    null,
   NAMA_PENG_POS        varchar(30)                    null,
   ALAMAT_PENG_POS      varchar(150)                   null,
   TELP_PENG_POS        numeric                        null,
   constraint PK_PENGURUS_POSYANDU primary key (NO_KTP_PENG_POS)
);

/*==============================================================*/
/* Index: PENGURUS_POSYANDU_PK                                  */
/*==============================================================*/
create unique index PENGURUS_POSYANDU_PK on PENGURUS_POSYANDU (
NO_KTP_PENG_POS ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_26_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_26_FK on PENGURUS_POSYANDU (
ID_POSYANDU ASC
);

/*==============================================================*/
/* Table: PENIMBANGAN                                           */
/*==============================================================*/
create table PENIMBANGAN 
(
   ID_TIMBANG           varchar(10)                    not null,
   ID_BALITA            numeric                        null,
   ID_POSYANDU          varchar(10)                    null,
   TGL_TIMBANG          date                           null,
   BERAT_BADAN          integer                        null,
   TINGGI_BADAN         integer                        null,
   STATUS_GIZI          varchar(20)                    null,
   constraint PK_PENIMBANGAN primary key (ID_TIMBANG)
);

/*==============================================================*/
/* Index: PENIMBANGAN_PK                                        */
/*==============================================================*/
create unique index PENIMBANGAN_PK on PENIMBANGAN (
ID_TIMBANG ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_18_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_18_FK on PENIMBANGAN (
ID_POSYANDU ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_20_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_20_FK on PENIMBANGAN (
ID_BALITA ASC
);

/*==============================================================*/
/* Table: PERIODE                                               */
/*==============================================================*/
create table PERIODE 
(
   ID_PERIODE           varchar(10)                    not null,
   ID_DATA_PKK          varchar(10)                    null,
   TAHUN_MULAI          integer                        null,
   TAHUN_SELESAI        integer                        null,
   constraint PK_PERIODE primary key (ID_PERIODE)
);

/*==============================================================*/
/* Index: PERIODE_PK                                            */
/*==============================================================*/
create unique index PERIODE_PK on PERIODE (
ID_PERIODE ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_4_FK                                     */
/*==============================================================*/
create index RELATIONSHIP_4_FK on PERIODE (
ID_DATA_PKK ASC
);

/*==============================================================*/
/* Table: POSYANDU                                              */
/*==============================================================*/
create table POSYANDU 
(
   ID_POSYANDU          varchar(10)                    not null,
   ALAMAT_POSYANDU      varchar(150)                   null,
   TELP_POSYANDU        numeric                        null,
   constraint PK_POSYANDU primary key (ID_POSYANDU)
);

/*==============================================================*/
/* Index: POSYANDU_PK                                           */
/*==============================================================*/
create unique index POSYANDU_PK on POSYANDU (
ID_POSYANDU ASC
);

/*==============================================================*/
/* Table: TABLEUSER                                             */
/*==============================================================*/
create table TABLEUSER 
(
   EMAIL                varchar(30)                    not null,
   NO_KTP               varchar(20)                    null,
   NO_KTP_PENG_POS      varchar(20)                    null,
   NO_KTP_IBU_PKK       varchar(20)                    null,
   PASSWORD             varchar(20)                    null,
   USER_TYPE            varchar(20)                    null,
   constraint PK_TABLEUSER primary key (EMAIL)
);

/*==============================================================*/
/* Index: USER_PK                                               */
/*==============================================================*/
create unique index USER_PK on TABLEUSER (
EMAIL ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_27_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_27_FK on TABLEUSER (
NO_KTP_PENG_POS ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_28_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_28_FK on TABLEUSER (
NO_KTP_IBU_PKK ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_30_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_30_FK on TABLEUSER (
NO_KTP ASC
);

alter table ABSEN
   add constraint FK_ABSEN_RELATIONS_IBU_PKK foreign key (NO_KTP_IBU_PKK)
      references IBU_PKK (NO_KTP_IBU_PKK)
      on update restrict
      on delete restrict;

alter table ABSEN
   add constraint FK_ABSEN_RELATIONS_NOTULENS foreign key (ID_NOTULENSI)
      references NOTULENSI (ID_NOTULENSI)
      on update restrict
      on delete restrict;

alter table BALITA
   add constraint FK_BALITA_RELATIONS_IBU_BALI foreign key (NO_KTP)
      references IBU_BALITA (NO_KTP)
      on update restrict
      on delete restrict;

alter table DATA_JENTIK
   add constraint FK_DATA_JEN_RELATIONS_IBU_PKK foreign key (NO_KTP_IBU_PKK)
      references IBU_PKK (NO_KTP_IBU_PKK)
      on update restrict
      on delete restrict;

alter table DATA_JENTIK
   add constraint FK_DATA_JEN_RELATIONS_DATA_PKK foreign key (ID_DATA_PKK)
      references DATA_PKK (ID_DATA_PKK)
      on update restrict
      on delete restrict;

alter table IBU_PKK
   add constraint FK_IBU_PKK_RELATIONS_DATA_PKK foreign key (ID_DATA_PKK)
      references DATA_PKK (ID_DATA_PKK)
      on update restrict
      on delete restrict;

alter table IBU_PKK
   add constraint FK_IBU_PKK_RELATIONS_PENGURUS foreign key (ID_PENGURUS_PKK)
      references PENGURUS_PKK (ID_PENGURUS_PKK)
      on update restrict
      on delete restrict;

alter table KAS_PKK
   add constraint FK_KAS_PKK_RELATIONS_PENGURUS foreign key (ID_PENGURUS_PKK)
      references PENGURUS_PKK (ID_PENGURUS_PKK)
      on update restrict
      on delete restrict;

alter table KAS_PKK
   add constraint FK_KAS_PKK_RELATIONS_JENIS_KA foreign key (ID_JENIS_KAS)
      references JENIS_KAS (ID_JENIS_KAS)
      on update restrict
      on delete restrict;

alter table KAS_PKK
   add constraint FK_KAS_PKK_RELATIONS_IBU_PKK foreign key (NO_KTP_IBU_PKK)
      references IBU_PKK (NO_KTP_IBU_PKK)
      on update restrict
      on delete restrict;

alter table KAS_POSYANDU
   add constraint FK_KAS_POSY_RELATIONS_POSYANDU foreign key (ID_POSYANDU)
      references POSYANDU (ID_POSYANDU)
      on update restrict
      on delete restrict;

alter table KELUHAN
   add constraint FK_KELUHAN_RELATIONS_TABLEUSE foreign key (EMAIL)
      references TABLEUSER (EMAIL)
      on update restrict
      on delete restrict;

alter table LAPORAN_BIDANG
   add constraint FK_LAPORAN__RELATIONS_PENGURUS foreign key (ID_PENGURUS_PKK)
      references PENGURUS_PKK (ID_PENGURUS_PKK)
      on update restrict
      on delete restrict;

alter table NOTULENSI
   add constraint FK_NOTULENS_RELATIONS_PENGURUS foreign key (ID_PENGURUS_PKK)
      references PENGURUS_PKK (ID_PENGURUS_PKK)
      on update restrict
      on delete restrict;

alter table PEMBERIAN_IMUNISASI
   add constraint FK_PEMBERIA_RELATIONS_IMUNISAS foreign key (ID_IMUNISASI)
      references IMUNISASI (ID_IMUNISASI)
      on update restrict
      on delete restrict;

alter table PEMBERIAN_IMUNISASI
   add constraint FK_PEMBERIA_RELATIONS_BALITA foreign key (ID_BALITA)
      references BALITA (ID_BALITA)
      on update restrict
      on delete restrict;

alter table PEMBERIAN_IMUNISASI
   add constraint FK_PEMBERIA_RELATIONS_POSYANDU foreign key (ID_POSYANDU)
      references POSYANDU (ID_POSYANDU)
      on update restrict
      on delete restrict;

alter table PEMBERIAN_KAPSUL
   add constraint FK_PEMBERI_RELATIONS_POSYANDU foreign key (ID_POSYANDU)
      references POSYANDU (ID_POSYANDU)
      on update restrict
      on delete restrict;

alter table PEMBERIAN_KAPSUL
   add constraint FK_PEMBERI_RELATIONS_BALITA foreign key (ID_BALITA)
      references BALITA (ID_BALITA)
      on update restrict
      on delete restrict;

alter table PENGUMUMAN
   add constraint FK_PENGUMU_RELATIONS_PENGURUS foreign key (ID_PENGURUS_PKK)
      references PENGURUS_PKK (ID_PENGURUS_PKK)
      on update restrict
      on delete restrict;

alter table PENGUMUMAN_POSYANDU
   add constraint FK_PENGUMUM_RELATIONS_PENGURUS foreign key (NO_KTP_PENG_POS)
      references PENGURUS_POSYANDU (NO_KTP_PENG_POS)
      on update restrict
      on delete restrict;

alter table PENGURUS_PKK
   add constraint FK_PENGURUS_RELATIONS_PERIODE foreign key (ID_PERIODE)
      references PERIODE (ID_PERIODE)
      on update restrict
      on delete restrict;

alter table PENGURUS_PKK
   add constraint FK_PENGURUS_RELATIONS_JABATAN foreign key (ID_JABATAN)
      references JABATAN (ID_JABATAN)
      on update restrict
      on delete restrict;

alter table PENGURUS_POSYANDU
   add constraint FK_PENGURUS_RELATIONS_POSYANDU foreign key (ID_POSYANDU)
      references POSYANDU (ID_POSYANDU)
      on update restrict
      on delete restrict;

alter table PENIMBANGAN
   add constraint FK_PENIMBAN_RELATIONS_POSYANDU foreign key (ID_POSYANDU)
      references POSYANDU (ID_POSYANDU)
      on update restrict
      on delete restrict;

alter table PENIMBANGAN
   add constraint FK_PENIMBAN_RELATIONS_BALITA foreign key (ID_BALITA)
      references BALITA (ID_BALITA)
      on update restrict
      on delete restrict;

alter table PERIODE
   add constraint FK_PERIODE_RELATIONS_DATA_PKK foreign key (ID_DATA_PKK)
      references DATA_PKK (ID_DATA_PKK)
      on update restrict
      on delete restrict;

alter table TABLEUSER
   add constraint FK_TABLEUSE_RELATIONS_PENGURUS foreign key (NO_KTP_PENG_POS)
      references PENGURUS_POSYANDU (NO_KTP_PENG_POS)
      on update restrict
      on delete restrict;

alter table TABLEUSER
   add constraint FK_TABLEUSE_RELATIONS_IBU_PKK foreign key (NO_KTP_IBU_PKK)
      references IBU_PKK (NO_KTP_IBU_PKK)
      on update restrict
      on delete restrict;

alter table TABLEUSER
   add constraint FK_TABLEUSE_RELATIONS_IBU_BALI foreign key (NO_KTP)
      references IBU_BALITA (NO_KTP)
      on update restrict
      on delete restrict;