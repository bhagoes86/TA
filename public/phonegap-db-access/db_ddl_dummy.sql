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

/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: ibu_balita                                               */
/*==============================================================*/
INSERT INTO `ibu_balita` (`NO_KTP`, `NAMA_IBU`, `ALAMAT_IBU`, `TELP_IBU`, `TGL_LAHIR_IBU`) VALUES ('1234560101600001', 'Soimah', 'Desa Sukamaju No. 1', '0315996999', '1960-01-01');
INSERT INTO `ibu_balita` (`NO_KTP`, `NAMA_IBU`, `ALAMAT_IBU`, `TELP_IBU`, `TGL_LAHIR_IBU`) VALUES ('1234563010610001', 'Siti Aminah', 'Desa Sukamaju No. 2', '0318855456', '1961-10-30');
INSERT INTO `ibu_balita` (`NO_KTP`, `NAMA_IBU`, `ALAMAT_IBU`, `TELP_IBU`, `TGL_LAHIR_IBU`) VALUES ('1234560404640004', 'Maria Elisa', 'Jalan Kedondong No. 4', '0318855456', '1964-04-04');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: balita                                                */
/*==============================================================*/
INSERT INTO `balita` (`ID_BALITA`, `NO_KTP`, `NO_KK_BALITA`, `NAMA_BALITA`, `JNS_KELAMIN`, `ANAK_KE`, `TGL_LAHIR`, `TGL_DAFTAR`, `TB_LAHIR`, `BB_LAHIR`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `PEKERJAAN_IBU`, `STATUS_BALITA`) VALUES ('0', '1234560101600001', '1234560101850001', 'Aksa Uyun', 'L', '1', '1985-01-01', '1985-01-02', '45', '2.5', 'Herwan Prandoko', 'Artis', 'Artis', 'sehat');
INSERT INTO `balita` (`ID_BALITA`, `NO_KTP`, `NO_KK_BALITA`, `NAMA_BALITA`, `JNS_KELAMIN`, `ANAK_KE`, `TGL_LAHIR`, `TGL_DAFTAR`, `TB_LAHIR`, `BB_LAHIR`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `PEKERJAAN_IBU`, `STATUS_BALITA`) VALUES ('1', '1234560404640004', '1234560404890004', 'Putri Perdani', 'P', '1', '1989-04-04', '1989-04-05', '45.3', '2.5', 'M. Abdullah', 'Dai', 'Ibu RT', 'sehat');
INSERT INTO `balita` (`ID_BALITA`, `NO_KTP`, `NO_KK_BALITA`, `NAMA_BALITA`, `JNS_KELAMIN`, `ANAK_KE`, `TGL_LAHIR`, `TGL_DAFTAR`, `TB_LAHIR`, `BB_LAHIR`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `PEKERJAAN_IBU`, `STATUS_BALITA`) VALUES ('2', '1234563010610001', '1234563010860001', 'Priambodo', 'L', '1', '1986-10-30', '1986-10-31', '42.8', '2.2', 'Junaidi', 'Dosen', 'Dosen', 'sehat');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: imunisasi                                             */
/*==============================================================*/
INSERT INTO imunisasi VALUES ('BCG', 'BCG', 3);
INSERT INTO imunisasi VALUES ('HB1', 'Hepatitis B_1', 0);
INSERT INTO imunisasi VALUES ('HB2', 'Hepatitis B_2', 1);
INSERT INTO imunisasi VALUES ('HB3', 'Hepatitis B_3', 3);
INSERT INTO imunisasi VALUES ('POL1', 'Polio_1', 0);
INSERT INTO imunisasi VALUES ('POL2', 'Polio_2', 2);
INSERT INTO imunisasi VALUES ('POL3', 'Polio_3', 4);
INSERT INTO imunisasi VALUES ('POL4', 'Polio_4', 6);
INSERT INTO imunisasi VALUES ('POL5', 'Polio_5', 18);
INSERT INTO imunisasi VALUES ('POL6', 'Polio_6', 60);
INSERT INTO imunisasi VALUES ('DTP1', 'DTP_1', 1);
INSERT INTO imunisasi VALUES ('DTP2', 'DTP_2', 6);
INSERT INTO imunisasi VALUES ('DTP3', 'DTP_3', 18);
INSERT INTO imunisasi VALUES ('DTP4', 'DTP_4', 60);
INSERT INTO imunisasi VALUES ('CAM', 'Campak', 9);


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: posyandu                                              */
/*==============================================================*/
INSERT INTO `posyandu` (`ID_POSYANDU`, `ALAMAT_POSYANDU`, `TELP_POSYANDU`) VALUES ('psy1', 'Jalan Domodomo 9', '0315569899');
INSERT INTO `posyandu` (`ID_POSYANDU`, `ALAMAT_POSYANDU`, `TELP_POSYANDU`) VALUES ('psy2', 'Jalan Sumber Kesehatan', '0313813113');
INSERT INTO `posyandu` (`ID_POSYANDU`, `ALAMAT_POSYANDU`, `TELP_POSYANDU`) VALUES ('psy3', 'Jalan Bangka Belitung 16', '0315873412');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: pemberian_imunisasi                                   */
/*==============================================================*/
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun1', 'psy1', 'BCG', '0', '1985-04-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun2', 'psy1', 'HB1', '0', '1985-01-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun3', 'psy1', 'HB2', '0', '1985-02-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun4', 'psy1', 'HB3', '0', '1985-04-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun5', 'psy1', 'POL1', '0', '1985-01-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun6', 'psy1', 'POL2', '0', '1985-03-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun7', 'psy1', 'POL3', '0', '1985-05-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun8', 'psy1', 'POL4', '0', '1985-07-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun9', 'psy1', 'POL5', '0', '1986-07-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun10', 'psy1', 'DTP1', '0', '1985-02-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun11', 'psy1', 'DTP2', '0', '1985-07-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun12', 'psy1', 'DTP3', '0', '1986-07-01');
INSERT INTO `pemberian_imunisasi` (`ID_BERI_IMUNISASI`, `ID_POSYANDU`, `ID_IMUNISASI`, `ID_BALITA`, `TGL_BERI_IMUNISASI`) VALUES ('imun13', 'psy1', 'CAM', '0', '1985-10-01');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: penimbangan                                           */
/*==============================================================*/
INSERT INTO `penimbangan` (`ID_TIMBANG`, `ID_BALITA`, `ID_POSYANDU`, `TGL_TIMBANG`, `BERAT_BADAN`, `TINGGI_BADAN`, `STATUS_GIZI`) VALUES ('tbg1', '0', 'psy1', '1985-03-01', '3', '47.5', 'bergizi');
INSERT INTO `penimbangan` (`ID_TIMBANG`, `ID_BALITA`, `ID_POSYANDU`, `TGL_TIMBANG`, `BERAT_BADAN`, `TINGGI_BADAN`, `STATUS_GIZI`) VALUES ('tbg2', '1', 'psy2', '1989-06-04', '3', '47.7', 'bergizi');
INSERT INTO `penimbangan` (`ID_TIMBANG`, `ID_BALITA`, `ID_POSYANDU`, `TGL_TIMBANG`, `BERAT_BADAN`, `TINGGI_BADAN`, `STATUS_GIZI`) VALUES ('tbg3', '2', 'psy3', '1986-12-30', '2.8', '45.1', 'bergizi');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: pemberian_kapsul                                      */
/*==============================================================*/
INSERT INTO `pemberian_kapsul` (`ID_BERI_KAPSUL`, `ID_POSYANDU`, `ID_BALITA`, `TGL_BERI_KAPSUL`, `JENIS_KAPSUL`) VALUES ('kap1', 'psy1', '0', '1985-08-01', 'Vit. A Biru'), ('kap2', 'psy1', '0', '1986-02-01', 'Vit. A Merah');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: kas_posyandu                                          */
/*==============================================================*/
INSERT INTO `kas_posyandu` (`ID_KAS`, `ID_POSYANDU`, `TGL_KAS`, `JENIS_TRANS_KAS`, `NOMINAL_KAS`, `KETERANGAN_KAS`) VALUES ('in001', 'psy1', '1985-01-01', '1', '50000', 'lunas');
INSERT INTO `kas_posyandu` (`ID_KAS`, `ID_POSYANDU`, `TGL_KAS`, `JENIS_TRANS_KAS`, `NOMINAL_KAS`, `KETERANGAN_KAS`) VALUES ('in002', 'psy1', '1985-01-01', '1', '50000', 'lunas');
INSERT INTO `kas_posyandu` (`ID_KAS`, `ID_POSYANDU`, `TGL_KAS`, `JENIS_TRANS_KAS`, `NOMINAL_KAS`, `KETERANGAN_KAS`) VALUES ('out001', 'psy1', '1985-01-01', '0', '25000', 'lunas');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: pengurus_posyandu                                     */
/*==============================================================*/
INSERT INTO `pengurus_posyandu` (`NO_KTP_PENG_POS`, `ID_POSYANDU`, `NAMA_PENG_POS`, `ALAMAT_PENG_POS`, `TELP_PENG_POS`) VALUES ('1235461112600002', 'psy1', 'Slamet Riadi', 'Jalan Mangga 9', '0315989898');
INSERT INTO `pengurus_posyandu` (`NO_KTP_PENG_POS`, `ID_POSYANDU`, `NAMA_PENG_POS`, `ALAMAT_PENG_POS`, `TELP_PENG_POS`) VALUES ('1235461112600001', 'psy1', 'Slamet Manfaat', 'Jalan Mangga 3', '0315989798');
INSERT INTO `pengurus_posyandu` (`NO_KTP_PENG_POS`, `ID_POSYANDU`, `NAMA_PENG_POS`, `ALAMAT_PENG_POS`, `TELP_PENG_POS`) VALUES ('1235461112600008', 'psy1', 'Agus Yusuf', 'Jalan Blewah 16', '0315784798');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: pengumuman_posyandu                                   */
/*==============================================================*/
INSERT INTO `pengumuman_posyandu` (`ID_PENGUMUMAN_POS`, `NO_KTP_PENG_POS`, `TGL_PENGUMUMAN_POS`, `JUDUL_PENGUMUMAN_POS`, `ISI_PENGUMUMAN_POS`, `LINK_UPLOAD_PENGUMUMAN_POS`) VALUES ('86APR01', '1235461112600001', '1986-04-01 07:00:00', 'pembukaan', 'selamat datang para pengurus posyandu, awali kerja dengan semangat hingga akhir waktu', 'bit.ly/pengumuman-pembukaan');
INSERT INTO `pengumuman_posyandu` (`ID_PENGUMUMAN_POS`, `NO_KTP_PENG_POS`, `TGL_PENGUMUMAN_POS`, `JUDUL_PENGUMUMAN_POS`, `ISI_PENGUMUMAN_POS`, `LINK_UPLOAD_PENGUMUMAN_POS`) VALUES ('86APR02', '1235461112600001', '1986-04-01 07:00:00', 'lokasi posyandu', 'posyandu ini terletak pada tepi desa, di sekitar sungai terbersih di Jawa Timur', 'bit.ly/pengumuman-lokasi');
INSERT INTO `pengumuman_posyandu` (`ID_PENGUMUMAN_POS`, `NO_KTP_PENG_POS`, `TGL_PENGUMUMAN_POS`, `JUDUL_PENGUMUMAN_POS`, `ISI_PENGUMUMAN_POS`, `LINK_UPLOAD_PENGUMUMAN_POS`) VALUES ('86APR03', '1235461112600001', '1986-04-16 07:00:00', 'kehilangan', 'ditemukan kunci motor beserta stnk, harap menghubungi kantor polisi terdekat', 'bit.ly/pengumuman-kehilangan');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: data_pkk                                              */
/*==============================================================*/
INSERT INTO `data_pkk` (`ID_DATA_PKK`, `RT_PKK`, `RW_PKK`, `KELURAHAN_PKK`, `KECAMATAN_PKK`, `KABUPATEN_PKK`, `PROVINSI_PKK`) VALUES ('601111', '1', '7', 'keputih', 'sukolilo', 'surabaya', 'jawa timur');
INSERT INTO `data_pkk` (`ID_DATA_PKK`, `RT_PKK`, `RW_PKK`, `KELURAHAN_PKK`, `KECAMATAN_PKK`, `KABUPATEN_PKK`, `PROVINSI_PKK`) VALUES ('601831', '1', '7', 'kalianak', 'asem rowo', 'surabaya', 'jawa timur');
INSERT INTO `data_pkk` (`ID_DATA_PKK`, `RT_PKK`, `RW_PKK`, `KELURAHAN_PKK`, `KECAMATAN_PKK`, `KABUPATEN_PKK`, `PROVINSI_PKK`) VALUES ('601981', '1', '7', 'sememi', 'benowo', 'surabaya', 'jawa timur');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: periode                                               */
/*==============================================================*/
INSERT INTO `periode` (`ID_PERIODE`, `ID_DATA_PKK`, `TAHUN_MULAI`, `TAHUN_SELESAI`) VALUES ('1', '601111', '1985', '1990');
INSERT INTO `periode` (`ID_PERIODE`, `ID_DATA_PKK`, `TAHUN_MULAI`, `TAHUN_SELESAI`) VALUES ('2', '601111', '1990', '1995');
INSERT INTO `periode` (`ID_PERIODE`, `ID_DATA_PKK`, `TAHUN_MULAI`, `TAHUN_SELESAI`) VALUES ('3', '601111', '1980', '1985');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: jenis_kas                                             */
/*==============================================================*/
INSERT INTO `jenis_kas` (`ID_JENIS_KAS`, `JENIS_KAS`) VALUES ('1', 'pemasukan'), ('2', 'pengeluaran');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: jabatan                                               */
/*==============================================================*/
INSERT INTO `jabatan` (`ID_JABATAN`, `NAMA_JABATAN`) VALUES ('1', 'ketua'), ('2', 'wakil ketua'), ('3', 'sekretaris'), ('4', 'bendahara'), ('5', 'anggota');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: pengurus_pkk                                          */
/*==============================================================*/
INSERT INTO `pengurus_pkk` (`ID_PENGURUS_PKK`, `ID_PERIODE`, `ID_JABATAN`) VALUES ('ket', '1', '1'), ('waket', '1', '2'), ('sekret', '1', '3'), ('bendum', '1', '4'), ('ang', '1', '5');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: laporan_bidang                                        */
/*==============================================================*/
INSERT INTO `laporan_bidang` (`ID_LAPORAN`, `ID_PENGURUS_PKK`, `FILE_LAPORAN`, `TGL_LAPORAN`) VALUES ('001', 'bendum', 'laporan keuangan.docx', '1985-03-03 07:00:00'), ('002', 'sekret', 'proposal pengajuan dana.docx', '1985-03-03 07:00:00'), ('003', 'ket', 'laporan pertanggung jawaban.pdf', '1985-03-03 07:00:00');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: ibu_pkk                                               */
/*==============================================================*/
INSERT INTO `ibu_pkk` (`NO_KTP_IBU_PKK`, `ID_DATA_PKK`, `ID_PENGURUS_PKK`, `NAMA_IBU_PKK`, `ALAMAT_IBU_PKK`, `TLP_IBU_PKK`) VALUES ('1234560101600001', '601111', 'ang', 'Soimah', 'Desa Sukamaju No. 1', '0315996999'), ('1234560404640004', '601111', 'bendum', 'Maria Elisa', 'Jalan Kedondong No. 4', '0318855456'), ('1234563010610001', '601111', 'ket', 'Siti Aminah', 'Desa Sukamaju No. 2', '0315923214');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: data_jentik                                           */
/*==============================================================*/
INSERT INTO `data_jentik` (`ID_PEMERIKSAAN`, `ID_DATA_PKK`, `NO_KTP_IBU_PKK`, `TGL_PEMERIKSAAN`, `ADA_JENTIK`) VALUES ('1', '601111', '1234560101600001', '1986-03-04', '0'), ('2', '601111', '1234560404640004', '1986-03-04', '0'), ('3', '601111', '1234563010610001', '1986-03-04', '1');
UPDATE `sim_epkk`.`data_jentik` SET `ADA_JENTIK` = '8' WHERE `data_jentik`.`ID_PEMERIKSAAN` = '1'; UPDATE `sim_epkk`.`data_jentik` SET `ADA_JENTIK` = '6' WHERE `data_jentik`.`ID_PEMERIKSAAN` = '2'; UPDATE `sim_epkk`.`data_jentik` SET `ADA_JENTIK` = '3' WHERE `data_jentik`.`ID_PEMERIKSAAN` = '3';


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: kas_pkk                                               */
/*==============================================================*/
INSERT INTO `kas_pkk` (`ID_KAS_PKK`, `NO_KTP_IBU_PKK`, `ID_JENIS_KAS`, `ID_PENGURUS_PKK`, `TGL_KAS_PKK`, `JENIS_TRANS_KAS_PKK`, `NOMINAL_KAS_PKK`) VALUES ('1', '1234560101600001', '1', 'bendum', '1985-04-05', '1', '13000'), ('2', '1234560404640004', '1', 'ket', '1985-04-05', '1', '16000'), ('3', '1234563010610001', '2', 'bendum', '1985-04-05', '1', '12000');
UPDATE `kas_pkk` SET `ID_JENIS_KAS` = '1', `TGL_KAS_PKK` = '1985-05-05' WHERE `kas_pkk`.`ID_KAS_PKK` = '3';


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: notulensi                                             */
/*==============================================================*/
INSERT INTO `notulensi` (`ID_NOTULENSI`, `ID_PENGURUS_PKK`, `TGL_NOTULENSI`, `ISI_NOTULENSI`) VALUES ('1', 'sekret', '1985-02-03', 'pemilihan ketua baru'), ('2', 'sekret', '1985-02-02', 'rapat rutin pengurus hingga sore hari'), ('3', 'sekret', '1985-02-04', 'Rencana suksesi ketua lama');
UPDATE `notulensi` SET `ID_PENGURUS_PKK` = 'ket' WHERE `notulensi`.`ID_NOTULENSI` = '1'; UPDATE `notulensi` SET `ID_PENGURUS_PKK` = 'ket' WHERE `notulensi`.`ID_NOTULENSI` = '2'; UPDATE `notulensi` SET `ID_PENGURUS_PKK` = 'ket' WHERE `notulensi`.`ID_NOTULENSI` = '3';


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: absen                                                 */
/*==============================================================*/
INSERT INTO `absen` (`ID_ABSEN`, `ID_NOTULENSI`, `NO_KTP_IBU_PKK`, `KEHADIRAN`) VALUES ('1', '1', '1234560101600001', '1'), ('2', '1', '1234560404640004', '0'), ('3', '1', '1234563010610001', '1');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: tableuser                                             */
/*==============================================================*/
INSERT INTO `tableuser` (`EMAIL`, `NO_KTP`, `NO_KTP_PENG_POS`, `NO_KTP_IBU_PKK`, `PASSWORD`, `USER_TYPE`) VALUES ('soimah@gmail.com', '1234560101600001', NULL, NULL, 'soimah', 'user'), ('manfaat@facebook.com', NULL, '1235461112600002', NULL, 'manfaat', 'user'), ('amin@ah.com', NULL, NULL, '1234563010610001', 'aamiinn', 'user');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: keluhan                                               */
/*==============================================================*/
INSERT INTO `keluhan` (`ID_KELUHAN`, `EMAIL`, `JUDUL_KELUHAN`, `TGL_KELUHAN`, `ISI_KELUHAN`) VALUES ('1', 'manfaat@facebook.com', 'manfaat utama', '1985-01-09 07:00:00', 'tong sampah di posyandu terasa tidak bermanfaat, mohon digunakan dengan benar'), ('2', 'soimah@gmail.com', 'kurang hiburan', '1985-01-09 07:00:00', 'butuh hiburan di saat menunggu');


/*==============================================================*/
/* INSERT DATA                                                  */
/* Table: pengumuman                                            */
/*==============================================================*/
INSERT INTO `pengumuman` (`ID_PENGUMUMAN`, `ID_PENGURUS_PKK`, `TGL_PENGUMUMAN`, `JUDUL_PENGUMUMAN`, `ISI_PENGUMUMAN`, `LINK_UPLOAD_PENGUMUMAN`) VALUES ('1', 'bendum', '1985-03-01 07:00:00', 'hello world', 'selamat datang kepada seluruh pengurus, selamat bekerja dan saling menyapa', 'bit.ly/pertamax'), ('2', 'ket', '1985-03-01 07:00:00', 'sambutan', 'ass. wr. wb. Saya mengucapkan selamat atas terpilihnya ibu-ibu sekalian sebagai pengurus. mohon kerja samanya', 'bit.ly/kerjasama');
UPDATE `pengumuman` SET `TGL_PENGUMUMAN` = '1985-03-02 07:00:00' WHERE `pengumuman`.`ID_PENGUMUMAN` = '2';