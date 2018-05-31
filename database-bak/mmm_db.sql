/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100126
 Source Host           : localhost
 Source Database       : mmm_db

 Target Server Type    : MySQL
 Target Server Version : 100126
 File Encoding         : utf-8

 Date: 12/01/2017 14:53:49 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `admins`
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES ('1', 'admin', 'admin@admin.com', '', '$2y$10$nfCNB/Gb9/Moch4IdsA97.LIWKu55Ybkh4sEFP2bm7MdyxTGJCDy6', '2uhKd6RK4YSuRo84Pzjbf6eS4r4ZoRVCkrpnik4ZNl3igc9sdw7LkVD8kXk8', null, null), ('2', 'maymymy_admin', 'maymymy_admin@maymymy.vn', '', '$2y$10$6Ji2vqAjzfEZS54WfwHzJu4Sy2.7OzK0zYq14j8beZeBmYVkHk.1q', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `blog`
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `blog`
-- ----------------------------
BEGIN;
INSERT INTO `blog` VALUES ('5', '7', '0', 'Cách ra nắng không đen lắm', 'cach-ra-nang-khong-den-lam', 'advises/dxgr0EXvgKeaFs3T4yvfSsUyaFcnFbEs7ReEtaK9.jpeg', 'Cách ra nắng không đen lắm tóm tắt, Cách ra nắng không đen lắm tóm tắt, Cách ra nắng không đen lắm tóm tắt, Cách ra nắng không đen lắm tóm tắt', '<p><img src=\"/mmm/laravel-filemanager/photos/shares/trademark_cover.jpg\" alt=\"\" width=\"851\" height=\"315\" /></p>\r\n<p>C&aacute;ch ra nắng kh&ocirc;ng đen lắm nội dung,&nbsp;</p>\r\n<p>C&aacute;ch ra nắng kh&ocirc;ng đen lắm nội dung,&nbsp;</p>\r\n<p>C&aacute;ch ra nắng kh&ocirc;ng đen lắm nội dung,&nbsp;</p>\r\n<p>C&aacute;ch ra nắng kh&ocirc;ng đen lắm nội dung</p>', '1', '2017-11-14 11:47:14', '2017-11-28 14:58:32'), ('6', '7', '0', 'tư', 'tu', 'advises/JgYic1UC4gdSPyA06olm9YulFjM1GufD74HgIMmP.jpeg', 'asd', '<p>asd</p>', '1', '2017-11-14 11:51:40', '2017-11-28 14:58:34'), ('7', '11', '0', 'CÁCH CHĂM SÓC DA NHỜN VÀ LỖ CHÂN LÔNG TO', 'cach-cham-soc-da-nhon-va-lo-chan-long-to', 'advises/lZ3psHCWTPQzOcSv595x1iqSq9llmcHDnNH64sp0.jpeg', 'Lỗ chân lông to là vấn đề luôn gặp phải ở các cô nàng da nhờn do quá tải sự điều tiết bã nhờn. \r\nChăm sóc da nhờn lỗ chân lông to là câu hỏi rất thường xuất hiện trên các diễn đàn làm đẹp, nhất là những cô gái ở khí hậu nhiệt đới như Việt Nam.', '<ol>\r\n<li>SE KH&Iacute;T LỖ CH&Acirc;N L&Ocirc;NG NHỜ X&Ocirc;NG HƠI V&Agrave; TẨY TẾ B&Agrave;O CHẾT&nbsp;<br />\r\n<p>X&ocirc;ng hơi cho da mặt l&agrave; c&aacute;ch l&agrave;m tốt nhất để c&aacute;c tế b&agrave;o được tuần ho&agrave;n v&agrave; lưu th&ocirc;ng, đẩy bụi bẩn v&agrave; b&atilde; nhờn ra ngo&agrave;i.<br />Khi những bụi bẩn v&agrave; độc tố tr&ecirc;n da được đẩy ra ngo&agrave;i, lỗ ch&acirc;n l&ocirc;ng th&ocirc;ng tho&aacute;ng sẽ gi&uacute;p cho da hấp thụ được nhiều tinh chất dưỡng hơn trong quy tr&igrave;nh dưỡng da của bạn.<br />Sau khi x&ocirc;ng hơi, biểu b&igrave; da mềm hơn, lợi dụng khi lỗ ch&acirc;n l&ocirc;ng được mở ra, bạn c&oacute; thể kết hợp d&ugrave;ng tẩy tế b&agrave;o chết để loại bỏ sạch hơn c&aacute;c b&atilde; nhờn v&agrave; bụi bẩn nh&eacute;!<br /><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_1_2.jpg\" width=\"600\" height=\"338\" /></p>\r\n</li>\r\n<li>DƯỠNG ẨM DA ĐỂ HẠN CHẾ DA TIẾT DẦU<br />Da nhờn rất cần được cấp nước. V&igrave; t&igrave;nh trạng thiếu nước sẽ khiến da mất đi độ ẩm, cơ chế sản sinh dầu sẽ hoạt động mạnh để c&acirc;n bằng bề mặt da. Do đ&oacute;, duy tr&igrave; cấp nước cho l&agrave;n da sẽ hạn chế được dầu thừa. Bạn n&ecirc;n lựa chọn v&agrave; sử dụng c&aacute;c sản phẩm dưỡng ẩm chuy&ecirc;n d&ugrave;ng cho da hỗn hợp hoặc hỗn hợp thi&ecirc;n dầu. Chăm chỉ sử dụng xịt kho&aacute;ng nhằm cấp ẩm cho da, tr&aacute;nh da bị kh&ocirc; nh&eacute;!&nbsp;</li>\r\n<li>SỬ DỤNG MẶT NẠ CHO DA DẦU<br />\r\n<p>Chắc hẳn c&aacute;c c&ocirc; g&aacute;i đều biết đắp mặt nạ l&agrave; bước chăm s&oacute;c da kh&ocirc;ng thể thiếu đ&uacute;ng kh&ocirc;ng n&agrave;o?&nbsp;<br />Đắp mặt nạ thường xuy&ecirc;n sẽ gi&uacute;p lỗ ch&acirc;n l&ocirc;ng được l&agrave;m sạch, s&aacute;ng hơn cũng khiến cho l&agrave;n da được mịn m&agrave;ng v&agrave; săn chắc. C&aacute;c bạn n&ecirc;n đắp mặt nạ thường xuy&ecirc;n, thường th&igrave; trung b&igrave;nh 1 tuần 2 lần, da sẽ cải thiện v&agrave; đẹp l&ecirc;n tr&ocirc;ng thấy đấy!</p>\r\n<p>Hi vọng với b&agrave;i viết n&agrave;y, c&aacute;c c&ocirc; n&agrave;ng đang trăn trở v&igrave; l&agrave;n da b&oacute;ng nhờn của m&igrave;nh sẽ t&igrave;m được c&aacute;ch chăm s&oacute;c da đ&uacute;ng c&aacute;ch, để l&agrave;n da l&uacute;c n&agrave;o cũng thật căng mịn v&agrave; đầy sức sống nh&eacute;!</p>\r\n<br /><br /></li>\r\n</ol>', '0', '2017-11-28 15:08:28', '2017-11-28 15:08:28'), ('8', '11', '0', 'NHỮNG ĐIỀU CẦN CHÚ Ý KHI CHĂM SÓC DA MÙA THU(MÙA KHÔ)', 'nhung-dieu-can-chu-y-khi-cham-soc-da-mua-thumua-kho', 'advises/z9OP9ypj5rCMCA0FyMhaThhkQ9MitypONtxNjp8l.jpeg', 'Mùa hạ nóng bức đã dần đi qua, thay vào đó làmua khô hanh. Bạn có biết rằng mỗi khi nhiệt độ giảm thấp 1 độ C, lượng bã nhờn của da cũng giảm đi 10%, chức năng giữ nước của da cũng kém, hàm lượng nước giảm. Vì thế công việc giữ ẩm cho da rất quan trọng.', '<ol>\r\n<li>C&acirc;n bằng lượng dầu v&agrave; nước<br />\r\n<p>M&ugrave;a thu nhiều gi&oacute;, kh&iacute; hậu kh&ocirc; hanh, l&agrave;n da cũng căng l&ecirc;n v&igrave; thế bạn cần chọn loại kem c&oacute; nồng độ dầu cao để l&agrave;m mềm da. Bạn sẽ ph&aacute;t hiện mặt của m&igrave;nh c&oacute; dầu những vẫn c&oacute; những nếp nhăn nhỏ hiện ra. Thậm ch&iacute; c&oacute; người c&ograve;n nổi những hạt lipit m&agrave;u trắng xung quanh v&ugrave;ng mắt.</p>\r\n<p>Nguy&ecirc;n nh&acirc;n l&agrave; do vừa v&agrave;o m&ugrave;a thu lượng nước trong da bốc hơi nhiều m&agrave; lượng dầu tiết ra kh&ocirc;ng giảm. Lượng dầu v&agrave; nước kh&ocirc;ng c&acirc;n bằng. V&igrave; thế, sản phẩm dưỡng da th&iacute;ch hợp nhất v&agrave;o m&ugrave;a thu l&agrave; những d&ograve;ng giữa ẩm nhưng kh&ocirc;ng chứa dầu.<br /><br /><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_2_1.jpg\" alt=\"\" width=\"600\" /></p>\r\nNếu bạn chỉ d&ugrave;ng sản phẩm trang điểm &ocirc;n h&ograve;a v&agrave; giữ ẩm, e rằng ch&uacute;ng kh&ocirc;ng nhiều gi&uacute;p cho l&agrave;n da đang kh&ocirc; nẻ, bong tr&oacute;c. Bạn c&oacute; thể d&ugrave;ng c&aacute;ch sau để cấp cứu l&agrave;n da: Trước hết d&ugrave;ng khăn b&ocirc;ng ng&acirc;m nước n&oacute;ng, vắt kiệt nước đắp l&ecirc;n da<br /><br /></li>\r\n<li>Tẩy tế b&agrave;o chết<br />Kh&ocirc;ng n&ecirc;n coi thường việc tẩy tế b&agrave;o chết. Trải qua một m&ugrave;a h&egrave; đầy nắng, chức năng bảo vệ da bị tổn thương. C&aacute;c ph&acirc;n tử bảo vệ giữ ẩm tự nhi&ecirc;n của da bắt đầu mất đi. Khi lớp sừng của da bị ảnh hưởng th&igrave; chức năng giữ nước của da cũng giảm v&agrave; xuất hiện những nếp nhăn. Nếu ai khuy&ecirc;n bạn tẩy tế b&agrave;o chết th&igrave; bạn kh&ocirc;ng n&ecirc;n nghe lời bởi m&ugrave;a thu, l&agrave;n da kh&ocirc; nẻ, chất sừng chứa nước giảm đi.<br />L&uacute;c n&agrave;y, sức đề kh&aacute;ng c&aacute;c k&iacute;ch ứng m&ocirc;i trường b&ecirc;n ngo&agrave;i cũng giảm, da rất yếu, t&iacute;nh chịu đựng k&eacute;m. Bạn n&ecirc;n cẩn thận tẩy tế b&agrave;o chết v&agrave;o l&uacute;c n&agrave;y để tr&aacute;nh g&acirc;y tổn thương cho da. Đồng thời cần tăng cường bảo vệ lớp chất sừng mới c&oacute; thể hỗ trợ da nhanh ch&oacute;ng kh&ocirc;i phục lại trạng th&aacute;i ban đầu.<br /><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_2_2.png\" alt=\"\" width=\"600\" /><br /><em>Kem tẩy tế b&agrave;o chết Nam Anh Khương.</em>&nbsp;</li>\r\n<li>L&agrave;m trắng<br />Nếu m&ugrave;a h&egrave;, bạn đ&atilde; thực hiện việc l&agrave;m trắng da th&igrave; m&ugrave;a thu, bạn h&atilde;y tiếp tục thực hiện. M&ugrave;a h&egrave; da bắt nắng k&iacute;ch th&iacute;ch sản sinh ra hắc sắc tố, c&aacute;c chất t&iacute;ch tụ trong da b&agrave;i tiết rất chậm. Đồng thời c&aacute;c hắc sắc tố đ&atilde; chạy đến tầng biểu b&igrave; cũng t&iacute;ch tụ dưới da do c&aacute;c tế b&agrave;o chết kh&ocirc;ng được giải tỏa khiến bạn cảm thấy 2 b&ecirc;n m&aacute; xuất hiện vết n&aacute;m.<br />V&igrave; thế, bạn h&atilde;y d&ugrave;ng c&aacute;c sản phẩm l&agrave;m trắng da để gi&uacute;p b&agrave;i tiết hắc sắc tố, l&agrave;m l&agrave;n da được rạng ngời. C&aacute;c sản phẩm l&agrave;m trắng da như vitamin C... l&agrave; th&agrave;nh phần &ocirc;n h&ograve;a kh&ocirc;ng bị k&iacute;ch ứng.<br /><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_2_3.png\" alt=\"\" width=\"600\" /><br /><em>Kem dưỡng da đa năng cream Nam Anh Khương</em><br /><em><br /></em>Hi vọng với b&agrave;i viết n&agrave;y, c&aacute;c bạn đ&atilde; biết c&aacute;ch chăm s&oacute;c da đ&uacute;ng c&aacute;ch, v&agrave; đạt được hiệu quả dưỡng da tốt nhất! Nhớ đ&oacute;n đọc c&aacute;c b&agrave;i viết tiếp theo của Mỹ phẩm Nam Anh Khương trong chuy&ecirc;n mục G&oacute;c L&agrave;m Đẹp nh&eacute;!&nbsp;<br /><br /></li>\r\n</ol>', '0', '2017-11-28 15:11:38', '2017-11-28 15:11:38'), ('9', '11', '0', 'CÁC BƯỚC CHĂM SÓC DA BAN ĐÊM CƠ BẢN ĐÚNG CHUẨN', 'cac-buoc-cham-soc-da-ban-dem-co-ban-dung-chuan', 'advises/Ji1CUomj6v9qcdV1qzYYEONuLaLkWGybROcXac3P.jpeg', 'Thông thường các nàng sẽ dành là 40 phút một ngày để chăm sóc làn da của mình chia làm 2 lần sáng và tối. Tuy nhiên, buổi tối là lúc da tái tạo tế bào mạnh nhất, nên chúng ta đừng xem nhẹ việc chăm sóc da buổi tối nhé!', '<p>Th&ocirc;ng thường c&aacute;c n&agrave;ng sẽ d&agrave;nh l&agrave; 40 ph&uacute;t một ng&agrave;y để chăm s&oacute;c l&agrave;n da của m&igrave;nh chia l&agrave;m 2 lần s&aacute;ng v&agrave; tối. Tuy nhi&ecirc;n, buổi tối l&agrave; l&uacute;c da t&aacute;i tạo tế b&agrave;o mạnh nhất, n&ecirc;n ch&uacute;ng ta đừng xem nhẹ việc chăm s&oacute;c da buổi tối nh&eacute;!<br />H&atilde;y c&ugrave;ng&nbsp;<a href=\"https://www.facebook.com/hashtag/m%E1%BB%B9ph%E1%BA%A9mnamanhkh%C6%B0%C6%A1ng?source=feed_text&amp;story_id=355052768250417\">Mỹ phẩm Nam Anh Khương</a>&nbsp;t&igrave;m hiểu c&aacute;c bước chăm s&oacute;c da mặt buổi tối đ&uacute;ng chuẩn nh&eacute;!</p>\r\n<p>Quy tr&igrave;nh chăm s&oacute;c da ban đ&ecirc;m cơ bản c&oacute; 4 bước m&agrave; bạn cần ghi nhớ:<br />Bước 1: L&agrave;m sạch&nbsp;<br />L&agrave;m sạch l&agrave; một trong c&aacute;c bước chăm s&oacute;c da ban đ&ecirc;m đ&oacute;ng vai tr&ograve; quan trọng nhất trong cả chu tr&igrave;nh chăm s&oacute;c da buổi tối đ&oacute; c&aacute;c n&agrave;ng nh&eacute;! V&igrave; l&agrave;m sạch da g&uacute;p cho lỗ ch&acirc;n l&ocirc;ng th&ocirc;ng tho&aacute;ng, bề mặt da sạch sẽ, tạo điều kiện cho da hấp thu c&aacute;c dưỡng chất ở c&aacute;c bước tiếp theo. V&agrave; tất nhi&ecirc;n, l&agrave; c&ograve;n l&agrave;m ngăn ngừa mụn rồi!</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_3_2.png\" alt=\"\" width=\"600\" /><br /><br /><em>Sữa rửa mặt Q10 Phấn hoa</em></p>\r\n<p>Bước 2: Cấp ẩm<br />Khi l&agrave;m sạch xong, da bạn sẽ mất đi độ ẩm một ch&uacute;t so với th&ocirc;ng thường, v&igrave; thế cấp ẩm ngay sau đ&oacute; l&agrave; một trong c&aacute;c bước chăm s&oacute;c da ban đ&ecirc;m gi&uacute;p da bổ sung ẩm tức th&igrave;, tr&aacute;nh hi&ecirc;n tượng da bị mất nước v&agrave; kh&ocirc; căng.&nbsp;<br />Ở bước n&agrave;y, tiện lợi nhất l&agrave; bạn c&oacute; thể d&ugrave;ng xịt kho&aacute;ng hoặc nước hoa hồng(toner) dạng xịt. Nếu c&oacute; thời gian, bạn c&oacute; thể d&ugrave;ng lotion mask để gi&uacute;p bổ sung độ ẩm tốt hơn. Cần lưu &yacute;, nếu da bạn l&agrave; da kh&ocirc;, nhạy cảm th&igrave; tr&aacute;nh d&ugrave;ng c&aacute;c loại cấp ẩm c&oacute; cồn nh&eacute;!</p>\r\n<p>Bước 3: Đặc trị&nbsp;<br />Nếu da bạn đang trong t&igrave;nh trạng mụn, nhạy cảm, da kh&ocirc;ng đều m&agrave;u, hoặc đơn giản l&agrave; muốn th&ecirc;m c&aacute;c dưỡng chất s&acirc;u mang t&iacute;nh sửa chữa , nếu kh&ocirc;ng cần thiết hoặc v&agrave;o những ng&agrave;y lười, bạn c&oacute; thể bỏ qua bước n&agrave;y cũng được. Ở c&aacute;c bước chăm s&oacute;c da cơ bản th&igrave; bước n&agrave;y gi&uacute;p cung cấp th&ecirc;m dưỡng chất cho da, gi&uacute;p da của bạn được chăm s&oacute;c một c&aacute;ch tốt nhất.&nbsp;<em><br /></em></p>\r\n<p>Ở bước n&agrave;y bạn c&oacute; thể sử dụng serium hoặc treatment nh&eacute;!</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_3_3.png\" alt=\"\" width=\"600\" /></p>\r\n<p><em>Serium Nam Anh Khương</em></p>\r\n<p>Bước 4: Kho&aacute; ẩm&nbsp;<br />Sau bước serium th&igrave; bước kho&aacute; ẩm cũng đ&oacute;ng vai tr&ograve; kh&aacute; quan trọng trong q&uacute;a tr&igrave;nh chăm s&oacute;c da ban đ&ecirc;m. Mọi người n&ecirc;n d&ugrave;ng kem dưỡng ẩm hoặc dầu dưỡng để kho&aacute; serium lại, tr&aacute;nh t&igrave;nh trạng serium bay hơi. Hoặc c&aacute;c treatment c&oacute; xu hướng l&agrave;m kh&ocirc; căng da th&igrave; bước n&agrave;y sẽ gi&uacute;p l&agrave;m da dễ chịu hơn, giảm thiểu c&aacute;c t&aacute;c dụng phụ.&nbsp;</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/blog/blog_3_4.png\" alt=\"\" width=\"600\" /></p>\r\n<p><em>Kem dưỡng trắng da đa năng cream Nam Anh Khương</em></p>\r\n<p><em>Tr&ecirc;n đ&acirc;y l&agrave; tất tần tật c&aacute;c bước chăm s&oacute;c da ban đ&ecirc;m đ&uacute;ng chuẩn gi&uacute;p bạn c&oacute; một l&agrave;n da thực sự trẻ đẹp từ b&ecirc;n trong. Đ&oacute;n đọc c&aacute;c b&agrave;i viết tiếp theo của Mỹ phẩm Nam Anh Khương nh&eacute;!</em></p>', '0', '2017-11-28 15:15:29', '2017-11-28 15:15:29'), ('10', '12', '1', 'Mỹ phẩm Nam Anh Khương triển khai chương trình khuyến mãi chào mừng ngày Nhà giáo Việt Nam 20-11', 'my-pham-nam-anh-khuong-trien-khai-chuong-trinh-khuyen-mai-chao-mung-ngay-nha-giao-viet-nam-20-11', 'news/9QWCH4WTtxOQRdWO8f2bGmz0sPoDDPIsRvWDJAs6.jpeg', 'Nhân tháng tri ân ngày Nhà Giáo Việt Nam 20/11, công ty TNHH MTV Hoá mỹ phẩm Nam Anh Khương triển khai hàng loạt các chương trình khuyến mãi, giảm giá đồng loạt các sản phẩm từ 20-30%.', '<p>Nh&acirc;n th&aacute;ng tri &acirc;n ng&agrave;y Nh&agrave; Gi&aacute;o Việt Nam 20/11, c&ocirc;ng ty TNHH MTV Ho&aacute; mỹ phẩm Nam Anh Khương triển khai h&agrave;ng loạt c&aacute;c chương tr&igrave;nh khuyến m&atilde;i, giảm gi&aacute; đồng loạt c&aacute;c sản phẩm từ 20-30%</p>\r\n<ol>\r\n<li>Khi mua 1 kem dưỡng trắng da đa năng Cream Nam Anh Khương(loại 9 t&aacute;c dụng v&agrave; 10 t&aacute;c dụng) , bạn sẽ được tặng ngay 1 sữa rửa mặt s&aacute;ng ra Nam Anh Khương. Đ&acirc;y l&agrave; bộ đ&ocirc;i sản phẩm đang được đ&ocirc;ng đảo chị em tin tưởng v&agrave; lựa chọn.<br /><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_1_0.jpg\" alt=\"\" width=\"600\" /><br /><em>Kem dưỡng trắng da đa năng cream Nam Anh Khương 9 t&aacute;c dụng.</em><br /><br /><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_1_2.jpg\" alt=\"\" width=\"600\" /><br /><em>Kem dưỡng trắng da đa năng 10 t&aacute;c dụng</em></li>\r\n<li><em><em>Khi mua 1 kem dưỡng trắng da đa năng 13 t&aacute;c dụng, bạn sẽ được tặng ngay 1 kem tẩy tế b&agrave;o chết Nam Anh Khương<br /></em></em>\r\n<p>Đ&acirc;y cũng l&agrave; một trong những sản phẩm được chị em &ldquo;săn đ&oacute;n&rdquo; kh&aacute; nhiều, thuộc d&ograve;ng sản phẩm VIP của c&ocirc;ng ty.</p>\r\n<p>Với ưu điểm l&agrave; th&agrave;nh phần sản phẩm ho&agrave;n to&agrave;n từ thi&ecirc;n nhi&ecirc;n, kem rất an to&agrave;n, th&acirc;n thiện với l&agrave;n da, kh&ocirc;ng g&acirc;y k&iacute;ch ứng da. C&oacute; t&aacute;c dụng dưỡng trắng, cung cấp độ ẩm v&agrave; se kh&iacute;t lỗ ch&acirc;n l&ocirc;ng, mang lại cho bạn g&aacute;i một l&agrave;n da trắng s&aacute;ng mịn m&agrave;ng đ&aacute;ng mơ ước.</p>\r\n<p>Cả 3 sản phẩm đang được giảm gi&aacute; chỉ c&ograve;n 550.000đ/1 sản phẩm.</p>\r\n</li>\r\n<li>Khi mua 1 kem dưỡng da body cream Nam Anh Khương, bạn sẽ đươc tặng ngay 1 bịch kem v&agrave; bột tắm trắng. Bộ đ&ocirc;i ho&agrave;n hảo gi&uacute;p bạn g&aacute;i c&oacute; 1 l&agrave;n da trắng s&aacute;ng mịn m&agrave;ng. Kem body thơm dịu, thấm nhanh qua da, kh&ocirc;ng g&acirc;y cảm gi&aacute;c bết d&iacute;nh, hiệu quả ngay sau v&agrave;i tuần sử dụng. Đ&acirc;y l&agrave; một d&ograve;ng sản phẩm mới ra mắt của c&ocirc;ng ty, nhưng cũng đ&atilde; khẳng định được vị thế của m&igrave;nh khi li&ecirc;n tiếp được kh&aacute;ch h&agrave;ng ủng hộ v&agrave; đặt h&agrave;ng.<br /><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_1_3.jpg\" alt=\"\" width=\"600\" /><br />B&ecirc;n cạnh chương tr&igrave;nh mua 1 tặng 1, Mỹ phẩm Nam Anh Khương c&ograve;n triển khai chương tr&igrave;nh giảm gi&aacute; sản phẩm, từ 20-30% cho tất cả c&aacute;c d&ograve;ng. Chi tiết bạn c&oacute; thể tham khảo tr&ecirc;n website hoặc tr&ecirc;n fanpage ch&iacute;nh thức của c&ocirc;ng ty.</li>\r\n</ol>', '0', '2017-11-28 15:20:41', '2017-11-28 15:20:41'), ('11', '12', '1', 'MỸ PHẨM NAM ANH KHƯƠNG TƯNG BỪNG NGÀY HỘI TRI ÂN KHÁCH HÀNG', 'my-pham-nam-anh-khuong-tung-bung-ngay-hoi-tri-an-khach-hang', 'news/vD2ctNklxrnrByyH0FTjF7Rpi2hf4kahE9uBSAFy.jpeg', 'Ngày 2/9 vừa qua, công ty mỹ phẩm Nam Anh Khương đã có dịp đón hơn 800 quan khách đến dự ngày hội tri ân khách hàng, được tổ chức tại thành phố Cần Thơ.', '<p>Ng&agrave;y 2/9 vừa qua, c&ocirc;ng ty mỹ phẩm Nam Anh Khương đ&atilde; c&oacute; dịp đ&oacute;n hơn 800 quan kh&aacute;ch đến dự ng&agrave;y hội tri &acirc;n kh&aacute;ch h&agrave;ng, được tổ chức tại th&agrave;nh phố Cần Thơ.</p>\r\n<p>Trong số c&aacute;c quan kh&aacute;ch tới dự, c&oacute; sự tham gia của ca sĩ Phi Nhung v&agrave; ca sĩ L&acirc;m H&ugrave;ng- l&agrave; 2 Đại sứ Thương Hiệu của nh&atilde;n h&agrave;ng mỹ phẩm Nam Anh Khương.</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_2_1.jpg\" alt=\"\" width=\"600\" /></p>\r\n<p>Với 7 năm x&acirc;y dựng v&agrave; ph&aacute;t triển tr&ecirc;n thị trường, tới nay, c&ocirc;ng ty đ&atilde; gặt h&aacute;i được nhiềy th&agrave;nh c&ocirc;ng v&agrave; dần khẳng định được vị thế của m&igrave;nh trong thị trường mỹ phẩm v&agrave; l&agrave;m đẹp.&nbsp;Trao đổi với c&aacute;c kh&aacute;ch mời v&agrave; to&agrave;n bộ nh&acirc;n vi&ecirc;n của c&ocirc;ng ty, &ocirc;ng L&ecirc; Văn Khương, Tổng gi&aacute;m đốc c&ocirc;ng ty cho biết:</p>\r\n<p>Trong suốt 7 năm vừa qua, c&ocirc;ng ty đ&atilde; trải qua v&ocirc; v&agrave;n kh&oacute; khăn, thử th&aacute;ch, nhưng đ&oacute; l&agrave; điều đ&atilde; gi&uacute;p cho thương hiệu Mỹ phẩm Nam Anh Khương tới gần hơn với người ti&ecirc;u d&ugrave;ng. Mong muốn đem tới một thương hiệu mỹ phẩm thi&ecirc;n nhi&ecirc;n, an to&agrave;n, đội ngũ nh&acirc;n vi&ecirc;n c&ocirc;ng ty sẽ kh&ocirc;ng ngừng cố gắng nghi&ecirc;n cứu v&agrave; sản xuất ra những sản phẩm chất lượng nhất, nhằm phục vụ nhu cầu l&agrave;m đẹp của kh&aacute;ch h&agrave;ng</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_2_2.jpg\" alt=\"\" width=\"600\" /></p>\r\n<p>Bằng chứng cho sự ph&aacute;t triển kh&ocirc;ng ngừng nghỉ đ&oacute;, l&agrave; hệ thống h&agrave;ng trăm đại l&yacute; ph&acirc;n phối, cửa h&agrave;ng đặt tại hơn 50 tỉnh th&agrave;nh tr&ecirc;n cả nước.&nbsp;<br />Với tinh thần hợp t&aacute;c c&ugrave;ng ph&aacute;t triển, l&agrave;m việc dựa tr&ecirc;n nguy&ecirc;n tắc t&ocirc;n trọng quyền v&agrave; lợi &iacute;ch của đ&ocirc;i b&ecirc;n, Mỹ phẩm Nam Anh Khương đ&atilde; ng&agrave;y một mở rộng, rất nhiều c&aacute;c đại l&yacute;, cửa h&agrave;ng, c&aacute; nh&acirc;n đ&atilde; đăng k&yacute; để trở th&agrave;nh một th&agrave;nh vi&ecirc;n trong \"ng&ocirc;i nh&agrave; chung\" của c&ocirc;ng ty.</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_2_3.jpg\" alt=\"\" width=\"600\" /></p>\r\n<p>Hi vọng rằng với sự cố gắng kh&ocirc;ng ngừng nghỉ của đội ngũ nh&acirc;n vi&ecirc;n c&ocirc;ng ty, thương hiệu Mỹ phẩm Nam Anh Khương sẽ ng&agrave;y&nbsp; một th&agrave;nh c&ocirc;ng hơn nữa v&agrave; được đ&ocirc;ng đảo người ti&ecirc;u d&ugrave;ng tin tưởng v&agrave; ủng hộ!</p>', '0', '2017-11-28 15:22:49', '2017-11-28 15:22:49'), ('12', '12', '1', 'MỸ PHẨM NAM ANH KHƯƠNG RA MẮT SẢN PHẨM MỚI VÀ LIÊN TỤC TUYỂN ĐẠI LÝ ONLINE TRÊN TOÀN QUỐC', 'my-pham-nam-anh-khuong-ra-mat-san-pham-moi-va-lien-tuc-tuyen-dai-ly-online-tren-toan-quoc', 'news/uJ4UhqKLUBSU5ENQgzAEghsIZfauML5E5Y8uDc4C.jpeg', 'Nối tiếp thành công từ nhiều dòng sản phẩm đang được ưa chuộng, trong tháng 9, công ty mỹ phẩm Nam Anh Khương đã chính thức công bố việc ra mắt dòng sản phẩm mới Cream Nam Anh Khương.', '<p>Nối tiếp th&agrave;nh c&ocirc;ng từ nhiều d&ograve;ng sản phẩm đang được ưa chuộng, trong th&aacute;ng 9, c&ocirc;ng ty mỹ phẩm Nam Anh Khương đ&atilde; ch&iacute;nh thức c&ocirc;ng bố việc ra mắt d&ograve;ng sản phẩm mới Cream Nam Anh Khương.</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_3_1.png\" alt=\"\" width=\"600\" /></p>\r\n<p><em>Kem dưỡng da đa năng cream Nam Anh Khương</em></p>\r\n<p>Sản phẩm Cream Nam Anh Khương l&agrave; t&acirc;m huyết của c&ocirc;ng ty, được &acirc;m thầm nghi&ecirc;n cứu, ph&aacute;t triển trong một thời gian d&agrave;i.&nbsp;<br />C&aacute;c sản phẩm Cream Nam Anh Khương đều c&oacute; th&agrave;nh phần chiết xuất từ thảo dược từ thi&ecirc;n nhi&ecirc;n c&ugrave;ng c&aacute;c hợp chất gi&agrave;u dinh dưỡng Vitamim c&oacute; trong Ngọc trai, Nh&acirc;n s&acirc;m, Sữa non v&agrave; L&aacute; ch&egrave; xanh... Từ đ&oacute;, quy tr&igrave;nh sản xuất ti&ecirc;n tiến gi&uacute;p tạo ra c&aacute;c sản phẩm an to&agrave;n v&agrave; th&acirc;n thiện với l&agrave;n da.</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_3_2.png\" alt=\"\" width=\"600\" /></p>\r\n<p>Với d&ograve;ng sản phẩm Cream Nam Anh Khương v&agrave; nhiều sản phẩm chất lượng kh&aacute;c, li&ecirc;n tục trong 7 năm qua, thương hiệu Nam Anh Khương đ&atilde; được người ti&ecirc;u d&ugrave;ng tr&ecirc;n cả nước ưa chuộng. T&iacute;nh đến nay, sản phẩm của c&ocirc;ng ty đ&atilde; c&oacute; mặt tại hơn 50 tỉnh th&agrave;nh, dựa tr&ecirc;n năng lực cung ứng lớn của hệ thống nh&agrave; ph&acirc;n phối, đại l&yacute;, cửa h&agrave;ng rộng khắp.</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_3_3.jpg\" alt=\"\" width=\"600\" /></p>\r\n<p><em>Mỹ phẩm Nam Anh Khương li&ecirc;n tục tuyển đại l&yacute;, CTV b&aacute;n h&agrave;ng online to&agrave;n quốc.</em></p>\r\n<p>Nhận thấy sự b&ugrave;ng nổ của truyền th&ocirc;ng v&agrave; mạng x&atilde; hội, c&ocirc;ng ty đ&atilde; tiến h&agrave;nh x&acirc;y dựng v&agrave; tập trung ph&aacute;t triển mảng b&aacute;n h&agrave;ng online, cụ thể l&agrave; việc tuyển dụng c&aacute;c đại l&yacute;, cộng t&aacute;c vi&ecirc;n b&aacute;n h&agrave;ng online tr&ecirc;n to&agrave;n quốc với mức chiết khấu hấp dẫn, v&agrave; rất nhiều quyền lợi k&egrave;m theo.</p>\r\n<p><img src=\"/mmm/laravel-filemanager/photos/shares/news/news_3_4.jpg\" alt=\"\" width=\"600\" /></p>\r\n<p><em>C&aacute;c ch&iacute;nh s&aacute;ch v&agrave; quyền lợi khi trở th&agrave;nh đại l&yacute; v&agrave; CTV b&aacute;n h&agrave;ng của c&ocirc;ng ty</em></p>\r\n<p>&nbsp;</p>\r\n<p>Mọi thắc mắc, vui l&ograve;ng li&ecirc;n hệ theo địa chi:</p>\r\n<p>Th&ocirc;ng tin li&ecirc;n hệ: C&ocirc;ng ty TNHH MTV MP Nam Anh Khương<br />Địa chỉ: 11/B6 KP. B&igrave;nh Thuận 2, P.Thuận Giao, TX.Thuận An, B&igrave;nh Dương<br />Hotline: 0274 3717507 hoặc 0983 979 567<br />Email: namanhkhuong@yahoo.com.vn<br />Fanpage: link tại&nbsp;<a href=\"https://www.facebook.com/myphamnamanhkhuong/\">đ&acirc;y</a></p>', '0', '2017-11-28 15:24:48', '2017-11-28 15:24:48');
COMMIT;

-- ----------------------------
--  Table structure for `blog_category`
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` text,
  `description` text,
  `type` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `blog_category`
-- ----------------------------
BEGIN;
INSERT INTO `blog_category` VALUES ('10', 'Góc làm đẹp', 'goc-lam-dep', 'advises/category/loeOFv7Boe2wmcuKmyxA0ucYUSKOKRgMDmXywIB2.jpeg', null, '0', '2017-11-28 14:57:43', '2017-11-28 14:57:43', '1', '0'), ('11', 'Chăm sóc da', 'cham-soc-da', 'advises/category/Vap2eV4IEtCqlMas1bgXk7aqLCVOzUF1HtH2eZYz.jpeg', null, '0', '2017-11-28 14:58:20', '2017-11-28 14:58:20', '1', '0'), ('12', 'Tin tức', 'tin-tuc', 'news/category/myXkqdlXaJDeTT70jmFCkQOwIHmOUZ5X2ckUYNoQ.jpeg', null, '1', '2017-11-28 15:17:20', '2017-11-28 15:17:20', '1', '0'), ('13', 'Tuyển dụng', 'tuyen-dung', 'news/category/klvnkoai4CYmkbb5V0iVXJ0PDhUAVypPZRpFJPbK.jpeg', null, '1', '2017-11-28 15:17:34', '2017-11-28 15:17:34', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `introduce`
-- ----------------------------
DROP TABLE IF EXISTS `introduce`;
CREATE TABLE `introduce` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `introduce`
-- ----------------------------
BEGIN;
INSERT INTO `introduce` VALUES ('1', 'Về chúng tôi', 've-chung-toi', 'introduce/s8ZEzY18Dk193BB4nrsiTugshpjkBYWCV8NLCsHX.jpeg', '<p>C&ocirc;ng ty TNHH MTV SX TM h&oacute;a mỹ phẩm Nam Anh Khương chuy&ecirc;n sản xuất, đ&oacute;ng g&oacute;i v&agrave; ph&acirc;n phối c&aacute;c loại mỹ phẩm đặc trị chuy&ecirc;n s&acirc;u về chống l&atilde;o h&oacute;a v&agrave; chăm s&oacute;c da to&agrave;n diện như: Kem trắng da Q10 - Sữa D&ecirc;, kem trị mụn, kem v&agrave; bột tắm trắng, sữa rửa mặt, kem tẩy tế b&agrave;o chết&hellip; Đồng thời, c&ocirc;ng ty c&ograve;n sở hữu một đội ngũ nh&acirc;n vi&ecirc;n gi&agrave;u kinh nghiệm v&agrave; kiến thức chuy&ecirc;n s&acirc;u về c&aacute;c loại mỹ phẩm, kem trị n&aacute;m, kem chống nắng, kem trắng da... để tư vấn cho kh&aacute;ch h&agrave;ng nhanh nhất v&agrave; hiệu quả nhất.<br /><br />Kh&ocirc;ng chỉ quan t&acirc;m đến chất lượng sản phẩm, đội ngũ nh&acirc;n vi&ecirc;n của C&ocirc;ng ty TNHH MTV SX TM h&oacute;a mỹ phẩm Nam Anh Khương c&ograve;n kh&ocirc;ng ngừng nghi&ecirc;n cứu để cho ra đời những d&ograve;ng sản phẩm chăm s&oacute;c da mới nhằn đ&aacute;p ứng tốt nhất nhu cầu của kh&aacute;ch h&agrave;ng. Hiện tại c&ocirc;ng ty c&oacute; tới 30 loại mỹ phẩm chăm s&oacute;c da kh&aacute;c nhau, tất cả đều được tạo n&ecirc;n từ việc ứng dụng nghi&ecirc;n cứu khoa học v&agrave; kết hợp h&agrave;i h&ograve;a với việc sử dụng nguồn nguy&ecirc;n liệu từ thi&ecirc;n nhi&ecirc;n, mang lại hiệu quả cao v&agrave; tuyệt đối an to&agrave;n, &ecirc;m dịu cho l&agrave;n da.</p>', '0', null, '2017-11-28 14:06:35'), ('2', 'Tầm nhìn chiến lược', 'tam-nhin-chien-luoc', 'introduce/DAUXK971T0dSwnalxtFsemkwspZrAb5hFlnWAje1.jpeg', '<p>Mỹ phẩm Maymymy l&agrave; thương hiệu mỹ phẩm lớn, uy t&iacute;n v&agrave; an to&agrave;n. Được đ&ocirc;ng đảo người ti&ecirc;u d&ugrave;ng tin tưởng v&agrave; lựa chọn.</p>\r\n<p>Với 7 năm x&acirc;y dựng v&agrave; ph&aacute;t triển tr&ecirc;n thị trường, Mỹ phẩm Maymymy đ&atilde; đạt được nhiều th&agrave;nh c&ocirc;ng rực rỡ. Những sản phẩm của Maymymy lu&ocirc;n ch&uacute; trọng cả về kh&acirc;u sản xuất lẫn đ&oacute;ng g&oacute;i,&nbsp;th&agrave;nh phẩn chiết xuất từ thi&ecirc;n nhi&ecirc;n, an to&agrave;n với mọi l&agrave;n da.</p>\r\n<p>Ch&uacute;ng t&ocirc;i mong muốn trao tới tay người ti&ecirc;u d&ugrave;ng 1 sản phẩm thực sự chất lượng, g&oacute;p phần mang thương hiệu Mỹ phẩm Việt Nam tới gần hơn với mọi người!</p>\r\n<p>Phương ch&acirc;m kinh doanh của ch&uacute;ng t&ocirc;i l&agrave; : CHẤT LƯỢNG, UY T&Iacute;N, TRUNG THỰC!</p>', '0', null, '2017-11-28 14:07:17'), ('3', 'Sứ mệnh', 'su-menh', 'introduce/3PoFSgfTrcsF0rNtcjDe7iIPh4anRhHjUAkmlVMn.jpeg', '<p>Sắc đẹp ch&iacute;nh l&agrave; vũ kh&iacute; lợi hại nhất gi&uacute;p chị em tỏa s&aacute;ng v&agrave; th&agrave;nh c&ocirc;ng hơn trong cuộc sống. Thấu hiểu được điều đ&oacute;, Mỹ phẩm Nam Anh Khương đ&atilde; nghi&ecirc;n cứu, s&aacute;ng tạo kh&ocirc;ng ngừng để tạo ra c&aacute;c sản phẩm chăm s&oacute;c sắc đẹp cho chị em phụ nữ.</p>\r\n<p>H&atilde;y để mỹ phẩm Nam Anh Khương đồng h&agrave;nh c&ugrave;ng bạn trong h&agrave;nh tr&igrave;nh chinh phục vẻ đẹp của ch&iacute;nh m&igrave;nh!</p>', '0', null, '2017-11-28 14:07:46'), ('4', 'Chứng nhận', 'chung-nhan', 'introduce/z47H97qzTwsB0Ww0LsPCWEBb7HkaPiCAOGVuyhoQ.jpeg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem. Aliquam feugiat est quis nisl varius sodales. Curabitur vel nibh dapibus, condimentum nunc ac, fringilla nunc. Praesent enim ex, molestie id sapien sed, tincidunt finibus dui. Praesent quis diam ultrices, iaculis nisi et, condimentum ex. In lacinia augue felis, nec lobortis risus aliquet in. Curabitur id tortor diam. Maecenas id interdum felis. Cras egestas, orci ut cursus dictum, neque purus sodales dui, a elementum mauris enim sed arcu.</p>', '0', null, '2017-11-28 14:08:53'), ('5', 'Điểu khoản', 'dieu-khoan', 'introduce/W1cAVHfj4YBGD1yBpx9Wenv2dakH2l8HtScWUdZH.jpeg', '<p><strong>Thương hiệu v&agrave; bản quyền</strong></p>\r\n<p>C&ocirc;ng ty TNHH MTV SX TM h&oacute;a mỹ phẩm Nam Anh Khương l&agrave; nh&agrave; ph&acirc;n phối độc quyền thương hiệu mỹ phẩm</p>\r\n<p>Nam Anh Khương tại Việt Nam.</p>\r\n<p>To&agrave;n bộ nội dung của trang web được bảo vệ bởi luật bản quyền của Việt Nam v&agrave; c&aacute;c c&ocirc;ng ước quốc tế. Bản quyền đ&atilde; được bảo lưu.<br /><strong>&nbsp;Ch&iacute;nh s&aacute;ch khuyến m&atilde;i gi&aacute;<br /></strong>- Th&ocirc;ng tin, ch&iacute;nh s&aacute;ch gi&aacute; tr&ecirc;n trang web lu&ocirc;n giống ở c&aacute;c cửa h&agrave;ng b&aacute;n h&agrave;ng trực tiếp v&agrave; tr&ecirc;n fanpage ch&iacute;nh thức của c&ocirc;ng ty.<br />- Tuy nhi&ecirc;n trong một số chương tr&igrave;nh khuyến m&atilde;i, một số mặt h&agrave;ng gi&aacute; SỐC c&oacute; thể online chỉ c&oacute; số lượng nhất định, ch&uacute;ng t&ocirc;i sẽ c&ocirc;ng bố số lượng n&agrave;y l&ecirc;n trang web, nếu đ&atilde; b&aacute;n hết số lượng quy định n&agrave;y, bạn vui l&ograve;ng đến c&aacute;c cửa h&agrave;ng để mua h&agrave;ng.<br />- Nếu c&oacute; sai s&oacute;t ch&ecirc;nh lệch n&agrave;o đ&oacute; giữa gi&aacute; online v&agrave; gi&aacute; tại c&aacute;c cửa h&agrave;ng b&aacute;n h&agrave;ng trực tiếp của Nam Anh Khương th&igrave; gi&aacute; khuyến m&atilde;i sẽ được &aacute;p dụng cho k&ecirc;nh b&aacute;n h&agrave;ng n&agrave;o m&agrave; bạn quyết định chọn mua.<br />- Một số chương tr&igrave;nh d&agrave;nh ri&ecirc;ng cho online, khi đ&oacute; gi&aacute; khuyến m&atilde;i online c&oacute; thể kh&aacute;c so với gi&aacute; khuyến m&atilde;i tại c&aacute;c cửa h&agrave;ng b&aacute;n h&agrave;ng trực tiếp,&hellip; c&aacute;c gi&aacute; n&agrave;y chỉ d&agrave;nh ri&ecirc;ng cho online m&agrave; kh&ocirc;ng &aacute;p dụng cho b&aacute;n h&agrave;ng trực tiếp tại c&aacute;c cửa h&agrave;ng.</p>\r\n<p><strong>&nbsp;Ch&iacute;nh s&aacute;ch khuyến m&atilde;i qu&agrave; tặng<br /></strong>- C&aacute;c ch&iacute;nh s&aacute;ch qu&agrave; tặng khi mua online sẽ được hưởng t&ugrave;y theo c&aacute;c chương tr&igrave;nh qu&agrave; tặng của Mỹ phẩm Nam Anh Khương.</p>', '0', null, '2017-11-28 14:08:15'), ('6', 'Thư viện ảnh', 'thu-vien-anh', 'introduce/lSDOcIRzwjzjY20CS6oDCCMRw9huC3IuqFt4VxSu.jpeg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem. Aliquam feugiat est quis nisl varius sodales. Curabitur vel nibh dapibus, condimentum nunc ac, fringilla nunc. Praesent enim ex, molestie id sapien sed, tincidunt finibus dui. Praesent quis diam ultrices, iaculis nisi et, condimentum ex. In lacinia augue felis, nec lobortis risus aliquet in. Curabitur id tortor diam. Maecenas id interdum felis. Cras egestas, orci ut cursus dictum, neque purus sodales dui, a elementum mauris enim sed arcu.</p>', '0', null, '2017-11-28 14:09:07');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1'), ('2', '2014_10_12_100000_create_password_resets_table', '1'), ('3', '2017_02_25_025103_create_admins_table', '1'), ('4', '2017_11_01_042108_adds_api_token_to_users_table', '2'), ('5', '2017_11_07_164248_create_blog_table', '3'), ('6', '2017_11_07_170713_create_comment_blog_table', '3');
COMMIT;

-- ----------------------------
--  Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` decimal(20,0) DEFAULT NULL,
  `customer_address` varchar(200) DEFAULT NULL,
  `customer_district` varchar(100) DEFAULT NULL,
  `customer_city` varchar(100) DEFAULT NULL,
  `customer_content` text,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: pending; 1: ongoing; 2: complete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `order`
-- ----------------------------
BEGIN;
INSERT INTO `order` VALUES ('1', 'Ha Nguyen', 'hanguyen@user.com', '123', 'Số 1 ABC', 'Hoàn Kiếm', 'Hà Nội', 'asd', '1'), ('2', 'Ha Nguyen', 'hanguyen@user.com', '1', 'a', 'asd', 'asd', 'adas', '1'), ('3', 'Ha Nguyen', 'hanguyen@user.com', '123', 'a', 'asd', 'asd', 'sd', '1'), ('4', 'Ha Nguyen', 'hanguyen@user.com', '123', 'a', 'asd', 'asd', 'ad', '0'), ('5', 'Ha Nguyen', 'hanguyen@user.com', '123', 'a', 'asd', 'asd', 'asd', '0'), ('6', 'Ha Nguyen', 'hanguyen@user.com', '23', 'a', 'asd', 'asd', 'asd', '0'), ('7', 'Ha Nguyen', 'hanguyen@user.com', '123', 'a', 'asd', 'asd', 'asd', '0');
COMMIT;

-- ----------------------------
--  Table structure for `order_product`
-- ----------------------------
DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_quantity` decimal(20,0) DEFAULT NULL,
  `product_total_cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `order_product`
-- ----------------------------
BEGIN;
INSERT INTO `order_product` VALUES ('1', '1', '33', 'Body cream', '1', '350000'), ('2', '1', '36', 'Kem trắng da, chống nắng', '1', '450000'), ('3', '2', '33', 'Body cream', '1', '350000'), ('4', '2', '36', 'Kem trắng da, chống nắng', '1', '450000'), ('5', '3', '33', 'Body cream', '1', '350000'), ('6', '3', '36', 'Kem trắng da, chống nắng', '1', '450000'), ('7', '4', '33', 'Body cream', '1', '350000'), ('8', '4', '36', 'Kem trắng da, chống nắng', '1', '450000'), ('9', '5', '35', 'Kem nám trắng da', '1', '450000'), ('10', '5', '33', 'Body cream', '1', '350000'), ('11', '6', '32', 'Serum nám', '1', '130000'), ('12', '6', '33', 'Body cream', '1', '350000'), ('13', '7', '35', 'Kem nám trắng da', '1', '450000'), ('14', '7', '36', 'Kem trắng da, chống nắng', '1', '450000'), ('15', '7', '34', 'Body Spa Beauty', '1', '300000');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `password_resets`
-- ----------------------------
BEGIN;
INSERT INTO `password_resets` VALUES ('vinhan16sep@gmail.com', '$2y$10$aa3z2u1C4IAkZJiWpWHGyORJf2pnZppYY26W2pNRYLD5V9jtCV3Ba', '2017-11-02 06:32:26'), ('vinhan16sep@gmail.com', '$2y$10$aa3z2u1C4IAkZJiWpWHGyORJf2pnZppYY26W2pNRYLD5V9jtCV3Ba', '2017-11-02 06:32:26');
COMMIT;

-- ----------------------------
--  Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trademark_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `effect` text COLLATE utf8mb4_unicode_ci,
  `weight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(60,0) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `guide` text COLLATE utf8mb4_unicode_ci,
  `discount_percent` int(4) DEFAULT NULL,
  `discount_price` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_discount` tinyint(1) DEFAULT '0',
  `is_special` tinyint(4) NOT NULL DEFAULT '0',
  `is_new` tinyint(4) NOT NULL DEFAULT '0',
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `product`
-- ----------------------------
BEGIN;
INSERT INTO `product` VALUES ('25', '12', '22', 'Kem AAA', 'kem-aaa', '15', 'Chống nắng', '123gr', 'Nam Anh Khương', '100000', null, null, '10', '90000', '1', '1', '1', 'products/kem-aaa/0ELLysOA99XHogIpTOZHymPR7texYvA6Ma8K4OFs.jpeg', '2017-11-14 10:24:04', '2017-11-28 14:24:31', null, '1'), ('27', '12', '23', 'Kem BBB', 'kem-bbb', '12', 'ABC', '456gr', 'Nam Anh Khương', '1000000', null, null, '10', '800000', '1', '1', '0', 'products/kem-bbb/RbrHF7OXoROIOuWZXFvFAziq0ofqqFy1zOyviOIZ.jpeg', '2017-11-14 10:26:22', '2017-11-28 14:24:35', null, '1'), ('28', '13', '26', 'Mỹ phẩm Blush CCC', 'my-pham-blush-ccc', '2', 'BCA', '123gr', 'Blush', '200000', null, null, '20', '180000', '1', '1', '0', 'products/my-pham-blush-ccc/ctvlkJdLALPWDyU7DTUTgsntnXo6Sa69L8TUQFFB.jpeg', '2017-11-14 10:27:23', '2017-11-28 14:24:38', null, '1'), ('29', '15', '25', 'Son Vapour xanh MMM', 'son-vapour-xanh-mmm', '12', 'MNB', '456gr', 'Vapour', '20000', null, null, '5', '19000', '1', '0', '1', 'products/son-vapour-xanh-mmm/yiLHgL8UR1uOGDfARoP7725XhFQw7yJp43U3dGLD.jpeg', '2017-11-14 10:28:15', '2017-11-28 14:24:40', null, '1'), ('30', '12', '22', 'Kem CCC', 'kem-ccc', '12', 'Chống mưa', '222gr', 'Nam Anh Khương', '800000', null, null, '10', '720000', '1', '1', '0', 'products/kem-ccc/hn4ciCpOSOg8nHs9pGsEfNqRr9Hn9afrDd1tlS5r.jpeg', '2017-11-15 17:06:51', '2017-11-28 14:24:43', null, '1'), ('31', '16', '28', 'Serum Trắng da', 'serum-trang-da', '100', 'Trắng da, chống nắng, tái tạo, lão hóa', '100', 'Nam Anh Khương', '150000', null, null, '0', '130000', '1', '1', '1', 'products/serum-trang-da/ArYczR7oBkhE1los6BhVQ5ySRZLFiliDadJ0zgAz.png', '2017-11-28 14:21:33', '2017-12-01 14:02:57', null, '0'), ('32', '16', '28', 'Serum nám', 'serum-nam', '100', 'Trị nắm, trắng da, chống nắng, se khít lỗ chân lông', '100', 'Nam Anh Khương', '150000', null, null, '0', '130000', '1', '1', '1', 'products/serum-nam/xx2fHRx3pgWBKi5wo1ClolQAykrieHKZ4ERYkpna.png', '2017-11-28 14:24:23', '2017-11-28 14:24:23', null, '0'), ('33', '16', '29', 'Body cream', 'body-cream', '100', 'Dưỡng trắng da toàn thân', '150', 'Nam Anh Khương', '350000', null, null, null, null, '0', '0', '1', 'products/body-cream/X5v0qGfkwf0jtitqRfxSvzS6HdNmRuymtrsBJmZY.png', '2017-11-28 14:31:57', '2017-11-28 14:31:57', null, '0'), ('34', '16', '29', 'Body Spa Beauty', 'body-spa-beauty', '100', 'Trắng hồng tự nhiên', '180', 'Nam Anh Khương', '300000', null, null, null, null, '0', '0', '1', 'products/body-spa-beauty/N8QJwUQ40uK4cHV09YyxzFMkp8kWUHToCISAAyKH.png', '2017-11-28 14:32:49', '2017-11-28 14:32:49', null, '0'), ('35', '17', '30', 'Kem nám trắng da', 'kem-nam-trang-da', '100', 'Trị nắm, trắng da, chống nắng, se khít lỗ chân lông', '150', 'Nam Anh Khương', '600000', null, null, '15', '450000', '1', '1', '1', 'products/kem-nam-trang-da/8csXGgOJDqTCp1ux8jROtR22uap3evxLWs2MG70D.png', '2017-11-28 14:34:19', '2017-11-28 14:34:19', null, '0'), ('36', '17', '30', 'Kem trắng da, chống nắng', 'kem-trang-da-chong-nang', '100', 'Trắng da, chống nắng, tái tạo, lão hóa', '150', 'Nam Anh Khương', '600000', null, null, '15', '450000', '1', '1', '1', 'products/kem-trang-da-chong-nang/bI3to4r8NTGaeQSISijHKIkGL4HZRVe3w3wmr2i4.png', '2017-11-28 14:35:13', '2017-12-01 13:52:24', null, '1');
COMMIT;

-- ----------------------------
--  Table structure for `product_category`
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `trademark_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `image` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `product_category`
-- ----------------------------
BEGIN;
INSERT INTO `product_category` VALUES ('28', '16', 'Serum', 'serum', '1', 'categories/0dtd0GrfwEp6niHXOUq17ZY8bxoldhtZE9b0IlaI.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem.', '2017-11-28 14:16:03', '2017-11-28 14:16:03', null, '0'), ('29', '16', 'Kem dưỡng da toàn thân', 'kem-duong-da-toan-than', '1', 'categories/zud7FsVM3I2X9T4TYKNyBN3XfDc02IYQc1BMImXe.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem.', '2017-11-28 14:16:27', '2017-11-28 14:16:27', null, '0'), ('30', '17', 'Kem dưỡng da mặt', 'kem-duong-da-mat', '1', 'categories/e93cvMbzv8ZqaUdW2GYQ6WQI32NVAsV33eTZ8V0z.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem.', '2017-11-28 14:16:57', '2017-11-28 14:16:57', null, '0');
COMMIT;

-- ----------------------------
--  Table structure for `product_trademark`
-- ----------------------------
DROP TABLE IF EXISTS `product_trademark`;
CREATE TABLE `product_trademark` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `product_trademark`
-- ----------------------------
BEGIN;
INSERT INTO `product_trademark` VALUES ('12', 'NAK Nam Anh Khương', 'nak-nam-anh-khuong', 'trademarks/i76F4BScLtCuc6po5z6ZJJs67KhxqgOqCt9ZAdQa.jpeg', 'NAK Nam Anh Khương', '2017-11-14 10:18:01', '2017-11-28 14:09:47', null, '1', '1'), ('13', 'Mỹ phẩm Blush', 'my-pham-blush', 'trademarks/f4aKWOERpknMNPJ0I5oMEux6TIjjuEr1QEXsH9sU.jpeg', 'Mỹ phẩm Blush', '2017-11-14 10:18:20', '2017-11-28 14:09:44', null, '1', '1'), ('14', 'Kem Barbie Pink', 'kem-barbie-pink', 'trademarks/fAwkB54WfTCRKlRiURS55FA5isBBC14GhGnBgHaT.jpeg', 'Kem Barbie Pink', '2017-11-14 10:18:35', '2017-11-28 14:09:42', null, '1', '1'), ('15', 'Son Vapour', 'son-vapour', 'trademarks/piKdWlr9xFmAoMeYq3447u1MpItVVzHKBUGwEf5t.jpeg', 'Son Vapour', '2017-11-14 10:18:49', '2017-11-28 14:09:40', null, '1', '1'), ('16', 'Cream Nam Anh Khương', 'cream-nam-anh-khuong', 'trademarks/TI1263lp4l2ku4iFwramtQrVIBXTorsIxZ6cUqpR.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem.', '2017-11-28 14:10:24', '2017-11-28 14:10:24', null, '1', '0'), ('17', 'Wikipedia', 'wikipedia', 'trademarks/HoO8fvlW1Pm4hjeJKZbrvP0XznSIbOpwR2iKLxm4.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida tempor lacinia. Nam odio metus, ornare vitae diam in, tempus pellentesque magna. Nullam eget nisi non quam luctus posuere. Quisque sem sapien, congue tincidunt varius in, sagittis in lorem.', '2017-11-28 14:10:41', '2017-11-28 14:10:41', null, '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'an nguyen', 'annguyen@admin.com', '$2y$10$nfCNB/Gb9/Moch4IdsA97.LIWKu55Ybkh4sEFP2bm7MdyxTGJCDy6', 'lp2HOrf8IWodg172HyuCTGhaqdUWJSGSzG0pvPW9mSBY1wbD9HmTpUhdyXJw', '2017-10-31 01:59:43', '2017-10-31 01:59:43', null), ('2', 'hung nguyen', 'hungalexi@gmail.com', '$2y$10$vi.MnC67kuYKDaMv00mSteizdcOcA6Q4QoSu/wIA16UfaR1dvrHVG', '8qDVsHCkhkXIJdEWwngXWncqqRxPhBYk2XW5bZgpd9pTA6VX26QOm9m9Zy6M', '2017-11-03 08:39:19', '2017-11-03 08:39:19', null), ('3', '1 an nguyen', 'eagleele_admin@eagleele.vn', '$2y$10$nI/oa4cvbzB9cQXm0kK0b.nuTraKB8zEHcW7IPusBvFIYQtQexhYy', '6PHA9vtpEsAW1irg36eZUjL4BxCHYFx4FtYpzXIoTMd9zdMkruCUSoccAsc1', '2017-11-03 09:34:39', '2017-11-03 09:34:39', null), ('4', 'an nguyen', 'admin123@admin.com', '$2y$10$Dmr8Ms7CnV4lFzZAv2sSRe7rvDk6mDj5qVuaGsjHW9WNqulQ2stoq', null, '2017-11-08 16:33:49', '2017-11-08 16:33:49', null), ('5', 'Ha Tran', 'hatran1@admin.com', '$2y$10$aJvJY/O01vV3oNVSoW8RheyeQZtbKbfza5JNovNv3L6.Avb6.TnEC', 'ev2TPUvwWzOXS66x0hvLEDaHewT5JsJMh5k64p10zzNnMKjvHeRWuI5A1uUU', '2017-11-15 15:32:19', '2017-11-15 15:32:19', null), ('6', 'Ha Nguyen', 'hanguyen@user.com', '$2y$10$X97HEadux3XWWStnjse8GerJBmscjrfZtoNcTA5r.p0VcJvzlGP/u', 'QbwllRTxK61BzoVOBqQhzRpjpsndyJvQh37u2KobEQ2LteCx5YLzwE5w5Q4i', '2017-11-15 15:35:57', '2017-11-15 15:35:57', null), ('7', 'Admin', 'maymymy_admin@maymymy.vn', '$2y$10$6Ji2vqAjzfEZS54WfwHzJu4Sy2.7OzK0zYq14j8beZeBmYVkHk.1q', 'haC2I6lYRQW5xd4MiKb4FHN1fA2RS3XpkJl6NxbMrh3UN0kEiHI3gfrYTOE5', '2017-11-17 14:41:14', '2017-11-17 14:41:14', null), ('8', 'Dung Nguyen', 'dungnguyen@user.com', '$2y$10$zof5dy..mDQ4MYrsGVazE.dkVfc9dfBV283/1RjbsouEiEsOXNTlq', null, '2017-11-20 18:09:32', '2017-11-20 18:09:32', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
