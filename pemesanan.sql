# Host: localhost  (Version 5.5.5-10.4.14-MariaDB)
# Date: 2021-07-09 02:22:29
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "dataikan"
#

DROP TABLE IF EXISTS `dataikan`;
CREATE TABLE `dataikan` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `namaikan` varchar(255) NOT NULL,
  `jenisikan` varchar(255) NOT NULL,
  `harga` int(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `stock` int(20) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

#
# Data for table "dataikan"
#

INSERT INTO `dataikan` VALUES (9,'udin','udin',123,'udin',123,'test.jpg'),(10,'cupang','cupang',50000,'ini ikan cupang',12,'1621215068710.png'),(11,'','',0,'',0,''),(12,'','',0,'',0,'');

#
# Structure for table "datapengiriman"
#

DROP TABLE IF EXISTS `datapengiriman`;
CREATE TABLE `datapengiriman` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `tglpemesanan` date NOT NULL,
  `tglpengiriman` date NOT NULL,
  `jasapengiriman` varchar(255) NOT NULL,
  `namapenerima` varchar(255) NOT NULL,
  `iduser` int(11) NOT NULL,
  `namaikan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

#
# Data for table "datapengiriman"
#

INSERT INTO `datapengiriman` VALUES (2,'2020-11-11','2020-11-11','jdskal','dfjkasl',0,'haflmoono'),(9,'2020-11-11','2020-11-11','sdanjk','sadhjk',0,'cuoang');

#
# Structure for table "datapenjualan"
#

DROP TABLE IF EXISTS `datapenjualan`;
CREATE TABLE `datapenjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namapenerima` varchar(255) NOT NULL,
  `namaikan` varchar(255) NOT NULL,
  `harga` int(20) NOT NULL,
  `tglpengiriman` date NOT NULL,
  `jasapengiriman` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

#
# Data for table "datapenjualan"
#

INSERT INTO `datapenjualan` VALUES (6,'ahmad fadhil','plakat',5000,'2021-10-11','2021-10-11','kirim');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (7,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','fadhil12@gmail.com','tanjung23',8123,'admin','fadhil111111'),(9,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','fadhil12@gmail.com','tanjung23',8123,'admin','admin'),(13,'wewen','547ba58dbfd1a1cdbc0c391baff4160b91f741b4','wewen@gmail.com','tanjung23',8123,'user','wewen'),(14,'wendy','5d0eb97e8e840e171f73b7642c2c89dd3984157b','wendy@gmail.com','jl.ceger',2147483647,'admin','wendy'),(15,'udin','0ff6f2c78c3f785fd15525e78e1fe9a223479ed1','udin@gmail.com','jlasdhji',2147483647,'user','udin');
