/*
Navicat MySQL Data Transfer

Source Server         : mysqldata
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : book_manage

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-06-01 19:58:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bookborrowingrecord
-- ----------------------------
DROP TABLE IF EXISTS `bookborrowingrecord`;
CREATE TABLE `bookborrowingrecord` (
  `BBRId` int(11) NOT NULL AUTO_INCREMENT,
  `BNo` char(15) NOT NULL,
  `BerAccount` varchar(15) NOT NULL,
  `BerStartTime` datetime NOT NULL,
  `BerEndTime` datetime NOT NULL,
  `isborrow` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`BBRId`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bookborrowingrecord
-- ----------------------------

-- ----------------------------
-- Table structure for bookinfo
-- ----------------------------
DROP TABLE IF EXISTS `bookinfo`;
CREATE TABLE `bookinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BNo` char(15) NOT NULL,
  `Bisbn` char(13) NOT NULL,
  `BName` varchar(50) NOT NULL,
  `BTId` int(11) NOT NULL,
  `BPressId` char(30) NOT NULL,
  `BAuthor` varchar(30) NOT NULL,
  `BPrice` varchar(50) NOT NULL,
  `BIsOld` int(1) NOT NULL DEFAULT '0',
  `BState` int(11) NOT NULL DEFAULT '0',
  `BUrl` varchar(500) NOT NULL DEFAULT 'default.jpg',
  `SRemark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bookinfo
-- ----------------------------
INSERT INTO `bookinfo` VALUES ('13', '101', '9787572609268', '我在北京送快递', '1', '1', ' 胡安焉', '25', '0', '1', '/storage/topic/20230514/ef474a634a7a64bbf4ee69a8db044c86.png', '进入社会工作至今的十年间，胡安焉走南闯北，辗转于广东、广西、云南、上海、北京等地，做过快递员、夜班拣货工人、便利店店员、保安、自行车店销售、服装店导购、加油站加油工……他将日常的点滴和工作的甘苦化作真诚的自述，记录了一个平凡人在生活中的辛劳、私心、温情、正气。\r\n\r\n在物流公司夜间拣货的一年，给他留下了深刻的生理印记：“这份工作还会令人脾气变坏，因为长期熬夜以及过度劳累，人的情绪控制力会明显下降……我已经感到脑子不好使了，主要是反应变得迟钝，记忆力开始衰退。”在北京送快递的两年，他“把自己看作一个时薪30元的送货机器，一旦达不到额定产出值就恼羞成怒、气急败坏”……\r\n\r\n但他最终认识到，怀着怨恨的人生是不值得过的。这些在事后追忆中写成的工作经历，渗透着他看待生活和世界的态度与反思，旨在表达个人在有限的选择和局促的现实中，对生活意义的直面和肯定：生活中许多平凡隽永的时刻，要比现实困扰的方方面面对人生更具有决定意义。');
INSERT INTO `bookinfo` VALUES ('14', '102', '9787220124693', '书籍与文明：英国维多利亚时代的知识生产与人文景观', '1', '1', '刘松矗 / 武玉红 / 袁曼书', '37', '0', '1', '/storage/topic/20230428/ffad68bba83f3cac2258b1542fc91de6.png', '本书回顾了维多利时代的“知识生产”光景：构建专业化的知识学科、为国民大众出版知识与探寻知识生产的价值隐喻，详细探讨的历史个案——威廉·斯塔布斯与《英国宪政史》、约翰·默里与大众旅游指南书、钱伯斯兄弟与《钱伯斯百科全书》、“疯子”迈纳医生与《牛津英语词典》、“家庭天使”与女性阅读，反映了该时代人文知识生产的不同侧影，其产生的巨大影响印证了英国中产阶级及其文化对“知识”的重新塑造，映照出19世纪英国这一“知识社会”的理念光谱，并表现出英国“知识制造工业”现代化流变的不同样态。全书围绕英国维多利亚时代的大众阅读、书籍出版、学科建立、学派发展等重要事件而展开，梳理了大众、作家、学者和出版商之间的互动共存关系，展现了当时英国崇尚科学与文明进步的社会氛围。');
INSERT INTO `bookinfo` VALUES ('15', '103', '9787544788922', '日常的弦歌：西南联大的回响', '1', '1', '王尧', '67', '0', '1', '/storage/topic/20230428/bbdec5454347fc80d0bc3edc91dde222.png', '西山苍苍，滇水茫茫。仅存八年的“国立西南联合大学”是现代中国高等教育史上的高峰，关于它的著述亦弥漫着传奇色彩。王尧另辟蹊径，于日常生活中聆听弦歌，在历史回响中抵达现场，西南联大于是有了一个全新的讲述。\r\n  “三驾马车”梅贻琦、蒋梦麟、张伯苓，大师巨匠陈寅恪、冯友兰，名士风骨朱自清、闻一多、郑天挺……作者回到困境、欢愉、黑暗、光明、约束、任性、革命、保守、崇高和卑微等鲜活的肌理中去叙述西南联大和生活在其中的人物。论联合，“在动乱时期主持一所大学本来就是头痛的事，尤其要让三个个性不同历史各异的大学共同生活”；论制度，“三校的传统便是学术独立，教授治校”；论社会，“昆明一隅，九儒十丐”；论知识分子，“他们一直思想和生活在新文化与旧道德的双重秩序中”；论生活，“在那样一个纷乱的年代，能够放下一张书桌并读书，便是心安之处”……\r\n  西南联大的回响遥远而清晰，后世读史者怦然而生敬意。西南联大何以可能，大学之道何以相传，知识分子何以自处，这些问题延续至今，文明之火亦藉此而光焰不熄。');
INSERT INTO `bookinfo` VALUES ('16', '104', '9787220128240', '中华文化新读丛书：文物中的鸟兽草木', '1', '1', ' 刘敦愿 著 , 郑岩 编', '72', '0', '1', '/storage/topic/20230428/b95bbf3579e0c5c7d4de7eeeffe26b12.png', '出没于古代器物与画像中的鸟兽草木，题材广泛，映现着人们与自然界生物丰富密切的关联，以及由此形成的文化含义和艺术脉络。本书通过描述这些图案、纹样的风格，剖析其意涵，来推想古人对自然资源的认识、改造与利用，复原彼时的生态环境与社会生活，追踪古族的征伐与迁徙，再现悠远的宗教礼仪与信仰，呈现出考古材料多方面的价值。');
INSERT INTO `bookinfo` VALUES ('19', '105', '9787532185610', '最后的耍猴人', '1', '1', '马宏杰', '68', '0', '1', '/storage/topic/20230428/24644d8b7ffb4108238df9d789935b4d.png', '我们中的一些人曾如此生活\r\n  CCTV、凤凰卫视专题报道，杨锦麟作序推荐\r\n  以真实的影像和文字记录一个消失中的民间中国\r\n  《中国国家地理》摄影师近二十年持续跟拍记录\r\n  豆瓣5000 评价8.8分\r\n  在中国民间，那些牵着猴子、四海为家的耍猴人多半来自河南新野，新野耍猴人每年都像候鸟一样南北迁徙，每到6月麦收后和10月秋收后，大批耍猴人忙完了地里的农活，就开始外出耍猴，卖艺赚钱。\r\n  从2002年开始，《中国国家地理》记者马宏杰深入新野耍猴人群体，跟随他们扒火车、露宿街头，记录他们日常遭遇的酸甜苦辣和命运的流转变化。\r\n  耍猴人杨林贵，耍猴二十余年，到过黑龙江、西藏、海南，也到过越南、缅甸、俄罗斯，在景德镇，一个16岁的女孩看完猴戏，对他说：“老爷爷，你这一生给多少人带来了快乐啊！”杨林贵听后，那天一路上都很开心。\r\n  耍猴人乔梅亭，靠耍猴赚的钱帮助五个弟弟相继成家，自己终生未婚，却被弟弟们认为他有所偏袒，自己为了养老存下的18万元也全部被人骗走……\r\n  耍猴人鲍风山、鲍庆山、苏国印和田军安在黑龙江牡丹江市街头耍猴时，被当地森林公安局无理刑拘一个多月，一只他们赖以为生的猴子在被公安局没收后死亡，他们自己也面临着“非法运输野生动物罪”的指控……\r\n  此外，还有女耍猴人、当过国民党特务的耍猴人、给猴戏做道具的手工艺人……耍猴人的故事如同中国社会的一个切面，他们的时代是我们共同经历过的时代，马宏杰用持续二十年的记录为我们作证，就在不久之前，有人曾如此生活。');
INSERT INTO `bookinfo` VALUES ('20', '106', '9787549637300', '同意', '1', '1', '【法】 瓦内莎·斯普林格拉', '15', '0', '1', '/storage/topic/20230428/27d08d23831486e78d54c479069dca30.png', '这是一部关于创伤、痊愈与勇气的回忆录。\r\n\r\n作者瓦内莎·斯普林格拉以冷静、精确而坦诚的文字，讲述了自己14岁时被年长她30多岁的法国作家G引诱、控制，并发展出一段畸形关系的经历。关系破裂后，这段经历仍被G作为文学素材一再书写，他在文坛也声名愈盛，而瓦内莎仿佛被囚禁在文字中，失去了诠释自己人生的能力，永远停留在十四岁。\r\n\r\n“选中那些孤独、敏感、缺乏家庭关怀的女孩时，G就清楚地知道她们不可能威胁到他的名声。因为沉默便意味着同意。”\r\n\r\n有时候，只需要一个声音，就能打破沉默的共谋。\r\n作者简介:\r\n瓦内莎·斯普林格拉（Vanessa Springora），1972年3月16日出生于法国巴黎，索邦大学现代文学硕士。曾任法国国立视听研究院的编剧和导演、法国朱利亚尔出版社的出版总监。目前是一名作家和独立出版人。\r\n\r\n李溪月，索邦大学文学硕士。译有《消失的塞布丽娜》。');
INSERT INTO `bookinfo` VALUES ('21', '107', '9787108074478', '俄罗斯文学的黄金世纪：从普希金到契诃夫', '1', '1', '张建华', '46', '0', '1', '/storage/topic/20230428/90ad627b39eb16ef3ec46247e105f2a5.png', '落后西欧文学至少100年的“晚生子”，如何实现逆袭？\r\n\r\n为什么俄罗斯文学有动人心魄的力量？\r\n\r\n是什么造就了俄罗斯文学最与众不同之处？\r\n\r\n为什么我们今天仍然需要读俄罗斯文学？\r\n\r\n--\r\n\r\n这些来自极北之地的书页中，有别处罕见的精神品格。一个10世纪才拥有文字的国家，何以在19世纪登上世界文学的巅峰？百年来，中国人是怎样接受俄罗斯文学的？作者张建华从普希金讲起，直至契诃夫，通过俄罗斯文学史上的一颗颗文学巨星窥见俄罗斯民族的内心世界，领略别样的人生世相、人性百态、灵魂奇观。');
INSERT INTO `bookinfo` VALUES ('22', '108', '9787569946055', '走进宋画：10—13世纪的中国文艺复兴', '1', '1', '李冬君', '68', '0', '1', '/storage/topic/20230428/6187e1cf473273d4df9f8467d93653b4.png', '两宋时期，社会进步超乎想象，诸如民生与工艺、艺术与哲学、技术与商业无不粲然，域外史家谓之“近世”，或称“新社会”，在唐、五代的基础上，宋以文艺复兴，形成新的人文天际线。\r\n\r\n文艺复兴带来的审美自由，适合艺术蓬勃地生长，从五代、两宋开始，中国绘画才真正迈进独立的艺术门槛。中国山水画的兴起，尤其水墨山水的兴起，成为 10 世纪至 13 世纪中国文艺复兴的标志。\r\n\r\n本书按照历史顺序，分为五代、北宋和南宋三个时期，解读了近 30 位名家、近 100 幅传世经典画作，探究了山水、花鸟、人物三大绘画类别由技入艺以至于境的发展过程；讲述个体与王朝相互勾连，命运与天才相激共振的历史事件。创作体例上，赏析与评传结合；方法上，审美与思辨兼济。作者试图以此建构新的中国艺术史，这是一部思想、艺术、文化、美学、文学交织的更大的人文作品。\r\n\r\n读过本书，或许你还会发现，去艺术中开拓文化的江山，是一个好去处。追求自由，构建独立人格，安顿自己，这是对中国文化和自我的一次美的救赎。\r\n\r\n美，是引人向上的终极力量。');
INSERT INTO `bookinfo` VALUES ('23', '109', '9787513351201', '盐镇', '1', '1', '易小荷', '14', '1', '1', '/storage/topic/20230428/00a25b0c03039c41a0f165da6283d6ab.png', '<p>&nbsp; &nbsp; 这是一本让读者时刻都会感到触目惊心的书。&nbsp;</p><p>&nbsp; &nbsp; 在四川南部的古老盐业小镇，女人们过着看似波澜不惊实则惊心动魄的生活。早早辍学在小镇叱咤风云的的00后幺妹，经济独立却惧怕离婚的女强人，面临家暴威胁却选择复婚的媒婆，历经四嫁开猫儿店的九十老妪，她们在21世纪仍旧重复着古老时代的人生轮回，在婚姻和贫困的夹缝里，挣扎求生。&nbsp;</p><p>&nbsp; &nbsp; 中国有四万多个乡镇，却只有一个北京、上海、深圳。易小荷回到故乡，选择了一个再普通不过的小镇，又在这里选取了12个再普通不过的女人，持续探寻她们对国家、社会、家庭、婚姻的理解，跟随她们再一次经历被“放咸”的人生。她想知道，在这样一个被遗忘的小镇，那些默默无闻的女人们，在新旧交替的时代里，会活出怎样的人生？</p><p>&nbsp; &nbsp; 历时一年的田野调查，易小荷记录下不被看见、不被听见的她们的生命。在这个如盐一般凝固在时光里的小镇，我们将看到一个不一样的城乡中国。</p>');
INSERT INTO `bookinfo` VALUES ('24', '110', '9787521750461', '达尔文的危险思想：演化与生命的意义', '2', '1', '【美】 丹尼尔·丹尼特', '60', '1', '1', '/storage/topic/20230428/9077549f1d161386d3263f57ed895ac1.png', '<p>&nbsp; &nbsp; &nbsp;查尔斯·达尔文用他的《物种起源》为生命的多姿多彩提供了一种解释：是演化和自然选择造就了这个星球上缤纷的生命。但他真的如这部划时代著作的书名提示的那样，解释了物种的起源吗？\r\n</p><p>&nbsp; &nbsp; &nbsp;自诞生的那一天起，达尔文自然选择和演化的理论就引发过很多争议：被曲解、被滥用、被否认，并且引发过一次又一次激烈的辩论。虽然今天的多数人已经不再相信生命是神创的产物，并接受演化和自然选择才是生命多样性背后的力量，但哲学家丹尼尔·丹尼特认为，很多人，包括很多世俗的学者⸺哲学家、心理学家、物理学家，甚至生物学家⸺对演化和自然选择仍然存在误解。他们的思维中或许已经没有一个至高无上的神，但却仍然为一种变相的“创造论”和无法解释的“奇迹”留有一席之地。</p><p>&nbsp; &nbsp; 在《达尔文的危险思想》中，基于公认的科学事实和缜密的逻辑论证，丹尼特提出，演化是一个机械的算法过程，这种算法过程不仅决定了羚羊的速度、老鹰的翅膀和兰花的形状，也同样决定了心灵、意义、道德等一部分学者不愿意用演化和自然选择来看待和阐释的概念。</p><p>&nbsp; &nbsp; 丹尼特在书中没有把对演化和自然选择的论述局限于生物学领域，还将其拓展到了文化、语言、社会等生物学以外的其他领域，把对演化和自然选择的理解提升到了一个全新的高度。</p>');

-- ----------------------------
-- Table structure for bookrecoveryrecord
-- ----------------------------
DROP TABLE IF EXISTS `bookrecoveryrecord`;
CREATE TABLE `bookrecoveryrecord` (
  `BRRId` int(11) NOT NULL AUTO_INCREMENT,
  `Bisbn` char(13) NOT NULL,
  `BName` varchar(50) NOT NULL,
  `BerAccount` varchar(15) NOT NULL,
  `BRRTime` datetime NOT NULL,
  PRIMARY KEY (`BRRId`),
  UNIQUE KEY `Bisbn` (`Bisbn`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bookrecoveryrecord
-- ----------------------------
INSERT INTO `bookrecoveryrecord` VALUES ('4', '9787521750461', '达尔文的危险思想：演化与生命的意义', '丹尼尔', '2023-05-20 00:27:51');
INSERT INTO `bookrecoveryrecord` VALUES ('5', '9787513351201', '盐镇', '易小荷', '2023-05-22 19:03:27');

-- ----------------------------
-- Table structure for booktypeinfo
-- ----------------------------
DROP TABLE IF EXISTS `booktypeinfo`;
CREATE TABLE `booktypeinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BTName` varchar(255) NOT NULL,
  `BTRemark` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of booktypeinfo
-- ----------------------------
INSERT INTO `booktypeinfo` VALUES ('1', '文学', '关于文学的书籍');
INSERT INTO `booktypeinfo` VALUES ('2', '其他', '关于其他的一些书籍');

-- ----------------------------
-- Table structure for borrowerinfo
-- ----------------------------
DROP TABLE IF EXISTS `borrowerinfo`;
CREATE TABLE `borrowerinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BerAccount` varchar(15) NOT NULL,
  `BerPwd` varchar(50) NOT NULL,
  `BerName` varchar(50) NOT NULL,
  `BerCardId` char(18) NOT NULL,
  `BerPhone` char(11) NOT NULL,
  `BerRole` int(11) NOT NULL,
  `BerBTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of borrowerinfo
-- ----------------------------
INSERT INTO `borrowerinfo` VALUES ('106', '10001', '123456', 'admin', '511622200201300031', '15328553514', '0', '2023-05-26 14:19:03');
INSERT INTO `borrowerinfo` VALUES ('112', '12345678910', '123456', 'over', '511622002013022222', '12345678910', '1', '2023-05-26 14:19:19');

-- ----------------------------
-- Table structure for pressinfo
-- ----------------------------
DROP TABLE IF EXISTS `pressinfo`;
CREATE TABLE `pressinfo` (
  `PressId` int(35) NOT NULL AUTO_INCREMENT,
  `PressName` varchar(50) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PressId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pressinfo
-- ----------------------------
INSERT INTO `pressinfo` VALUES ('1', '社会大学出版社', '是由社会大学出版社提供的书籍');

-- ----------------------------
-- Table structure for releaseinforecord
-- ----------------------------
DROP TABLE IF EXISTS `releaseinforecord`;
CREATE TABLE `releaseinforecord` (
  `RIRId` int(11) NOT NULL AUTO_INCREMENT,
  `RIRTitle` varchar(50) NOT NULL,
  `RIRContent` varchar(255) NOT NULL,
  `RIRType` varchar(15) NOT NULL,
  `BerAccount` varchar(15) NOT NULL,
  `RIRTime` datetime NOT NULL,
  PRIMARY KEY (`RIRId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of releaseinforecord
-- ----------------------------

-- ----------------------------
-- Table structure for reportlossrecord
-- ----------------------------
DROP TABLE IF EXISTS `reportlossrecord`;
CREATE TABLE `reportlossrecord` (
  `RLRId` int(11) NOT NULL AUTO_INCREMENT,
  `BNo` char(11) NOT NULL,
  `BLRTime` datetime NOT NULL,
  `isloss` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`RLRId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reportlossrecord
-- ----------------------------

-- ----------------------------
-- Table structure for reviewinfo
-- ----------------------------
DROP TABLE IF EXISTS `reviewinfo`;
CREATE TABLE `reviewinfo` (
  `RId` int(11) NOT NULL AUTO_INCREMENT,
  `BNo` char(15) NOT NULL,
  `bookName` varchar(50) NOT NULL,
  `RContent` text NOT NULL,
  `RDateTime` datetime NOT NULL,
  `BerAccount` varchar(15) NOT NULL,
  `RSupport` int(11) NOT NULL DEFAULT '0',
  `RHidden` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`RId`)
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reviewinfo
-- ----------------------------

-- ----------------------------
-- Table structure for supportrecord
-- ----------------------------
DROP TABLE IF EXISTS `supportrecord`;
CREATE TABLE `supportrecord` (
  `SRId` int(11) NOT NULL AUTO_INCREMENT,
  `RId` int(11) NOT NULL,
  `BerAccount` varchar(15) NOT NULL,
  `SRTime` datetime NOT NULL,
  PRIMARY KEY (`SRId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of supportrecord
-- ----------------------------

-- ----------------------------
-- Table structure for webinfo
-- ----------------------------
DROP TABLE IF EXISTS `webinfo`;
CREATE TABLE `webinfo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `webname` varchar(50) NOT NULL,
  `book_num` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of webinfo
-- ----------------------------
INSERT INTO `webinfo` VALUES ('1', '博识图书馆', '10');
