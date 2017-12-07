-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: shop1024
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `php_attribute`
--

DROP TABLE IF EXISTS `php_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_attribute` (
  `attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `attr_name` varchar(32) NOT NULL COMMENT '属性名称',
  `type_id` smallint(5) unsigned NOT NULL COMMENT '对应类型id',
  `attr_is_sel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:唯一 1:多选',
  `attr_write_mod` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:手工  1:下拉列表选择',
  `attr_sel_opt` varchar(100) NOT NULL DEFAULT '' COMMENT '多选情况被选取的项目信息，多个值彼此使用,逗号分隔',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_attribute`
--

LOCK TABLES `php_attribute` WRITE;
/*!40000 ALTER TABLE `php_attribute` DISABLE KEYS */;
INSERT INTO `php_attribute` VALUES (1,'网络',1,0,0,''),(2,'尺寸',1,0,0,''),(3,'操作系统',1,1,1,'IOS,android'),(4,'内存ram',4,1,1,'4G,6G,8G，16G'),(5,'颜色',1,1,1,'red,green,black');
/*!40000 ALTER TABLE `php_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_auth`
--

DROP TABLE IF EXISTS `php_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL DEFAULT '' COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '基别',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_auth`
--

LOCK TABLES `php_auth` WRITE;
/*!40000 ALTER TABLE `php_auth` DISABLE KEYS */;
INSERT INTO `php_auth` VALUES (101,'商品管理',0,'','','101',0),(102,'订单管理',0,'','','102',0),(103,'权限管理',0,'','','103',0),(104,'商品列表',101,'Goods','showlist','101-104',1),(105,'添加商品',101,'Goods','tianjia','101-105',1),(107,'订单列表',102,'Order','showlist','102-107',1),(108,'查询订单',102,'Order','look','102-108',1),(109,'订单打印',102,'Order','dayin','102-109',1),(110,'管理员列表',103,'Admin','showlist','103-110',1),(111,'角色列表',103,'Role','showlist','103-111',1),(112,'权限列表',103,'Auth','showlist','103-112',1),(113,'商品品牌',101,'Brand','showlist','101-113',1),(114,'商品分类',101,'Type','showlist','101-114',1),(115,'商品类型',101,'Category','showlist','101-115',1);
/*!40000 ALTER TABLE `php_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_category`
--

DROP TABLE IF EXISTS `php_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `cat_name` varchar(32) NOT NULL COMMENT '分类名称',
  `cat_pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `cat_path` varchar(32) NOT NULL DEFAULT '' COMMENT '全路径',
  `cat_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '等级',
  PRIMARY KEY (`cat_id`),
  KEY `cat_pid` (`cat_pid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='商品分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_category`
--

LOCK TABLES `php_category` WRITE;
/*!40000 ALTER TABLE `php_category` DISABLE KEYS */;
INSERT INTO `php_category` VALUES (1,'数字商品',0,'1',0),(2,'电子书',1,'1-2',1),(3,'免费',2,'1-2-3',2),(4,'小说',2,'1-2-4',2),(5,'文学',2,'1-2-5',2),(6,'经营',2,'1-2-6',2),(7,'数字音乐',1,'1-7',1),(8,'音像',1,'1-8',1),(9,'家用电器',0,'9',0),(10,'大家电',9,'9-10',1),(11,'电视',10,'9-10-11',2),(12,'空调',10,'9-10-12',2),(13,'冰箱',10,'9-10-13',2),(14,'生活电器',9,'9-14',1),(15,'饮水器',14,'9-14-15',2),(16,'空气净化器',14,'9-14-16',2),(17,'手机数码',0,'17',0),(18,'国产手机',17,'17-18',1),(19,'外国手机',17,'17-19',1),(20,'大屏',18,'17-18-20',2),(21,'高颜值',18,'17-18-21',2),(22,'曲面',19,'17-19-22',2),(23,'双射',19,'17-19-23',2);
/*!40000 ALTER TABLE `php_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_goods`
--

DROP TABLE IF EXISTS `php_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_goods` (
  `goods_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `goods_name` varchar(256) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `goods_number` smallint(6) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `goods_weight` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品重量',
  `cat_id` mediumint(9) NOT NULL DEFAULT '0' COMMENT '商品分类',
  `brand_id` mediumint(9) NOT NULL DEFAULT '0' COMMENT '商品品牌',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型id',
  `goods_big_logo` char(100) NOT NULL DEFAULT '' COMMENT '商品大图片',
  `goods_small_logo` char(100) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `goods_introduce` text COMMENT '商品介绍',
  `is_sale` enum('上架','下架') NOT NULL DEFAULT '上架' COMMENT '上架，下架',
  `is_qiang` enum('不抢','抢') NOT NULL DEFAULT '不抢' COMMENT '是否抢购',
  `is_rec` enum('推荐','不推荐') NOT NULL DEFAULT '不推荐' COMMENT '推荐与否',
  `is_hot` enum('热销','不热销') NOT NULL DEFAULT '不热销' COMMENT '热销与否',
  `is_new` enum('新品','不新品') NOT NULL DEFAULT '不新品' COMMENT '新品与否',
  `add_time` int(11) NOT NULL COMMENT '添加信息时间',
  `upd_time` int(11) NOT NULL COMMENT '修改信息时间',
  `is_del` enum('删除','不删除') NOT NULL DEFAULT '不删除' COMMENT '删除与否',
  PRIMARY KEY (`goods_id`),
  KEY `goods_shop_price` (`goods_shop_price`),
  KEY `goods_price` (`goods_price`),
  KEY `cat_id` (`cat_id`),
  KEY `brand_id` (`brand_id`),
  KEY `add_time` (`add_time`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_goods`
--

LOCK TABLES `php_goods` WRITE;
/*!40000 ALTER TABLE `php_goods` DISABLE KEYS */;
INSERT INTO `php_goods` VALUES (1,'One Plus',2999.00,0.00,1,186,0,0,0,'','','一加5T，等于几<span style=\"font-size:24px;color:rgb(255,0,0);\">？</span>','上架','不抢','不推荐','不热销','不新品',1508999624,1508999624,'不删除'),(2,'小米',3299.00,0.00,1,168,0,0,0,'','','全陶瓷，全面屏。<br />','上架','不抢','不推荐','不热销','不新品',1508999791,1508999791,'不删除'),(3,'小米mix2',3599.00,0.00,1,0,0,0,0,'./Common/Uploads/2017-11-02/59fa88748050e.png','','','上架','不抢','不推荐','不热销','不新品',1509591156,1509591156,'不删除'),(4,'zuk',1299.00,0.00,1,115,0,0,0,'./Common/Uploads/2017-11-02/59fa8b8eeec9d.png','./Common/Uploads/2017-11-02/small_59fa8b8eeec9d.png','zuk要倒闭了','上架','不抢','不推荐','不热销','不新品',1509591950,1509591950,'不删除'),(5,'1',1.00,0.00,1,0,0,0,0,'','','','上架','不抢','不推荐','不热销','不新品',1509607905,1509607905,'不删除'),(6,'1',1.00,0.00,1,0,0,0,0,'','','','上架','不抢','不推荐','不热销','不新品',1509608256,1509608256,'删除'),(7,'1',1.00,0.00,1,0,0,0,0,'','','','上架','不抢','不推荐','不热销','不新品',1509608332,1509608332,'删除'),(8,'1',1.00,0.00,1,0,0,0,0,'','','','上架','不抢','不推荐','不热销','不新品',1509608372,1509608372,'不删除'),(9,'1',1.00,0.00,1,0,0,0,0,'','','','上架','不抢','不推荐','不热销','不新品',1509608419,1509608419,'不删除'),(10,'1',1.00,0.00,1,0,0,0,0,'','','','上架','不抢','不推荐','不热销','不新品',1509608455,1509608455,'不删除'),(11,'dada',222.00,0.00,1,122,0,0,0,'./Common/Uploads/2017-11-02/59fad9852655c.png','./Common/Uploads/2017-11-02/small_59fad9852655c.png','daad测试<img src=\"http://img.baidu.com/hi/jx2/j_0014.gif\" alt=\"j_0014.gif\" />','上架','不抢','不推荐','不热销','不新品',1509611908,1509611908,'不删除'),(12,'dada',222.00,0.00,1,122,0,0,0,'./Common/Uploads/2017-11-02/59fad9e18424a.png','./Common/Uploads/2017-11-02/small_59fad9e18424a.png','daad测试<img src=\"http://img.baidu.com/hi/jx2/j_0014.gif\" alt=\"j_0014.gif\" />','上架','不抢','不推荐','不热销','不新品',1509612001,1509612001,'不删除'),(13,'elephant',99999999.99,0.00,1,73,0,0,0,'./Common/Uploads/2017-11-03/59fbd4ef18a17.png','./Common/Uploads/2017-11-03/small_59fbd4ef18a17.png','elephant','上架','不抢','不推荐','不热销','不新品',1509676270,1509676270,'不删除'),(14,'as',444.00,0.00,1,0,0,0,0,'./Common/Uploads/2017-11-03/59fc108b8e1b5.png','./Common/Uploads/2017-11-03/small_59fc108b8e1b5.png','&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0003.gif&quot;/&gt;&lt;/p&gt;','上架','不抢','不推荐','不热销','不新品',1509691531,1509936281,'不删除'),(15,'yijia5T',3599.00,0.00,1,666,0,0,0,'./Common/Uploads/2017-11-06/59ffdc0b279b8.png','./Common/Uploads/2017-11-06/small_59ffdc0b279b8.png','&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0057.gif&quot; alt=&quot;j_0057.gif&quot;/&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0002.gif&quot;/&gt;&lt;/p&gt;','上架','不抢','不推荐','不热销','不新品',1509939181,1509957911,'不删除'),(16,'一加5T',2999.00,0.00,1,166,0,0,1,'./Common/Uploads/2017-11-21/5a13f3a2690bb.png','./Common/Uploads/2017-11-21/small_5a13f3a2690bb.png','yijiayijia<img src=\"http://img.baidu.com/hi/jx2/j_0003.gif\" alt=\"j_0003.gif\" />','上架','不抢','不推荐','不热销','不新品',1511256993,1511256993,'不删除'),(17,'mixPerfect1',5999.00,0.00,1,0,0,0,1,'./Common/Uploads/2017-11-22/5a1538e863896.png','./Common/Uploads/2017-11-22/small_5a1538e863896.png','&lt;p&gt;perfec&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0004.gif&quot; alt=&quot;j_0004.gif&quot;/&gt;&lt;/p&gt;','上架','不抢','不推荐','不热销','不新品',1511340264,1511432997,'不删除'),(18,'一加5T',2999.00,0.00,1,0,17,0,1,'./Common/Uploads/2017-11-28/5a1d00089ffe3.png','./Common/Uploads/2017-11-28/small_5a1d00089ffe3.png','&lt;p&gt;555555555555tttttttttttt&lt;/p&gt;','上架','不抢','不推荐','不热销','不新品',1511849991,1511850006,'不删除');
/*!40000 ALTER TABLE `php_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_goods_attr`
--

DROP TABLE IF EXISTS `php_goods_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_goods_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `attr_id` mediumint(8) unsigned NOT NULL COMMENT '属性id',
  `attr_value` varchar(64) NOT NULL DEFAULT '' COMMENT '属性对应的值',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='商品-属性关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_goods_attr`
--

LOCK TABLES `php_goods_attr` WRITE;
/*!40000 ALTER TABLE `php_goods_attr` DISABLE KEYS */;
INSERT INTO `php_goods_attr` VALUES (1,16,1,'4G'),(2,16,2,'6.1'),(3,16,3,'android'),(4,16,5,'red'),(5,16,5,'black'),(34,17,5,'red'),(33,17,5,'black'),(32,17,3,'android'),(31,17,2,'6.01'),(30,17,1,'5G'),(35,17,5,'green'),(45,18,5,'black'),(44,18,5,'red'),(43,18,3,'android'),(42,18,2,'6.1'),(41,18,1,'4G');
/*!40000 ALTER TABLE `php_goods_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_goods_cat`
--

DROP TABLE IF EXISTS `php_goods_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_goods_cat` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `cat_id` mediumint(8) unsigned NOT NULL COMMENT '分类id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品-分类，关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_goods_cat`
--

LOCK TABLES `php_goods_cat` WRITE;
/*!40000 ALTER TABLE `php_goods_cat` DISABLE KEYS */;
INSERT INTO `php_goods_cat` VALUES (4,18,18),(3,18,21);
/*!40000 ALTER TABLE `php_goods_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_goods_pics`
--

DROP TABLE IF EXISTS `php_goods_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_goods_pics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `pics_big` char(100) NOT NULL COMMENT '相册原图',
  `pics_small` char(100) NOT NULL COMMENT '相册缩略图',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='商品相册表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_goods_pics`
--

LOCK TABLES `php_goods_pics` WRITE;
/*!40000 ALTER TABLE `php_goods_pics` DISABLE KEYS */;
INSERT INTO `php_goods_pics` VALUES (1,12,'./Common/Pics/2017-11-02/59fad9e19c50c.png','./Common/Pics/2017-11-02/small_59fad9e19c50c.png'),(2,12,'./Common/Pics/2017-11-02/59fad9e19e835.png','./Common/Pics/2017-11-02/small_59fad9e19e835.png'),(3,12,'./Common/Pics/2017-11-02/59fad9e19ffa5.png','./Common/Pics/2017-11-02/small_59fad9e19ffa5.png'),(4,13,'./Common/Pics/2017-11-03/59fbd4ef844eb.png','./Common/Pics/2017-11-03/small_59fbd4ef844eb.png'),(5,13,'./Common/Pics/2017-11-03/59fbd4ef8642c.png','./Common/Pics/2017-11-03/small_59fbd4ef8642c.png'),(6,14,'./Common/Pics/2017-11-06/59ffcc82c3769.png','./Common/Pics/2017-11-06/small_59ffcc82c3769.png'),(13,15,'./Common/Pics/2017-11-06/5a0021173129c.jpg','./Common/Pics/2017-11-06/small_5a0021173129c.jpg'),(9,15,'./Common/Pics/2017-11-06/59ffd7edb96ad.png','./Common/Pics/2017-11-06/small_59ffd7edb96ad.png'),(10,15,'./Common/Pics/2017-11-06/59ffd7edba266.png','./Common/Pics/2017-11-06/small_59ffd7edba266.png'),(11,15,'./Common/Pics/2017-11-06/59fff9b7a6ab5.png','./Common/Pics/2017-11-06/small_59fff9b7a6ab5.png'),(12,15,'./Common/Pics/2017-11-06/59fff9b7a766d.png','./Common/Pics/2017-11-06/small_59fff9b7a766d.png'),(14,15,'./Common/Pics/2017-11-06/5a00211736c76.png','./Common/Pics/2017-11-06/small_5a00211736c76.png'),(15,16,'./Common/Pics/2017-11-21/5a13f3a2d5333.png','./Common/Pics/2017-11-21/small_5a13f3a2d5333.png'),(16,16,'./Common/Pics/2017-11-21/5a13f3a2da923.png','./Common/Pics/2017-11-21/small_5a13f3a2da923.png'),(17,17,'./Common/Pics/2017-11-22/5a1538e8e5ad3.png','./Common/Pics/2017-11-22/small_5a1538e8e5ad3.png'),(18,17,'./Common/Pics/2017-11-23/5a16a3263c9af.png','./Common/Pics/2017-11-23/small_5a16a3263c9af.png');
/*!40000 ALTER TABLE `php_goods_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_manager`
--

DROP TABLE IF EXISTS `php_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(32) NOT NULL,
  `mg_pwd` varchar(32) NOT NULL,
  `mg_time` int(10) unsigned NOT NULL COMMENT '时间',
  `mg_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_manager`
--

LOCK TABLES `php_manager` WRITE;
/*!40000 ALTER TABLE `php_manager` DISABLE KEYS */;
INSERT INTO `php_manager` VALUES (1,'tom','123456',1323212345,50),(2,'xiaoming','123456',1312345324,51),(3,'admin','123456',1323456543,0);
/*!40000 ALTER TABLE `php_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_role`
--

DROP TABLE IF EXISTS `php_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_role`
--

LOCK TABLES `php_role` WRITE;
/*!40000 ALTER TABLE `php_role` DISABLE KEYS */;
INSERT INTO `php_role` VALUES (50,'主管','101,104,105,106,102,107,108,109','Goods-showlist,Goods-tianjia,Goods-category,Order-showlist,Order-look,Order-dayin'),(51,'经理','102,107,108,109','Goods-tianjia,Goods-category,Order-showlist,Order-look');
/*!40000 ALTER TABLE `php_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_type`
--

DROP TABLE IF EXISTS `php_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type_name` varchar(32) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商品类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_type`
--

LOCK TABLES `php_type` WRITE;
/*!40000 ALTER TABLE `php_type` DISABLE KEYS */;
INSERT INTO `php_type` VALUES (1,'手机'),(2,'音乐'),(3,'电影'),(4,'电脑'),(5,'相机'),(6,'摄像机'),(7,'化妆品');
/*!40000 ALTER TABLE `php_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `php_user`
--

DROP TABLE IF EXISTS `php_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `php_user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_name` varchar(32) NOT NULL COMMENT '会员名称',
  `user_email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `user_pwd` char(32) NOT NULL COMMENT '密码',
  `openid` char(32) NOT NULL DEFAULT '' COMMENT 'qq登录的openid信息',
  `user_sex` enum('男','女','保密') NOT NULL DEFAULT '男' COMMENT '性别',
  `user_weight` smallint(6) NOT NULL DEFAULT '0' COMMENT '体重',
  `user_height` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '身高',
  `user_logo` varchar(128) NOT NULL DEFAULT '' COMMENT '头像',
  `user_tel` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `user_identify` char(18) NOT NULL DEFAULT '' COMMENT '身份号码',
  `user_check` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否激活, 0:未激活  1:已激活',
  `user_check_code` char(32) NOT NULL DEFAULT '' COMMENT '邮箱验证激活码',
  `add_time` int(11) NOT NULL COMMENT '注册时间',
  `is_del` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否删除, 0:正常  1:被删除',
  PRIMARY KEY (`user_id`),
  KEY `user_name` (`user_name`),
  KEY `user_tel` (`user_tel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `php_user`
--

LOCK TABLES `php_user` WRITE;
/*!40000 ALTER TABLE `php_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `php_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-05 10:57:43