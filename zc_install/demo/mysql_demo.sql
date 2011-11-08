# MySQL file for Zen Cart Demo Products load
#
# $Id: mysql_demo.sql 3784 2006-06-17 00:35:28Z drbyte $
#

#
# Dumping data for table `address_book`
#

INSERT INTO address_book (address_book_id, customers_id, entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) VALUES (NULL, 1, 'm', 'JustaDemo', 'Bill', 'Smith', '123 Any Avenue', '', '12345', 'Here', '', 223, 12);

#
# Dumping data for table `categories`
#

INSERT INTO categories VALUES (1,'',0,10,'2007-01-15 13:01:41','2007-02-01 17:33:02',1);
INSERT INTO categories VALUES (2,'',1,0,'2007-01-15 13:01:41','2007-02-01 17:34:46',1);
INSERT INTO categories VALUES (3,'',0,20,'2007-01-15 13:10:03','2007-02-01 17:33:18',1);
INSERT INTO categories VALUES (4,'',3,0,'2007-01-15 13:10:03','2007-02-01 17:35:48',1);
INSERT INTO categories VALUES (5,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:55',1);
INSERT INTO categories VALUES (6,'',0,30,'2007-01-15 13:10:04','2007-02-01 17:33:37',1);
INSERT INTO categories VALUES (7,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:37',1);
INSERT INTO categories VALUES (8,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:36:05',1);
INSERT INTO categories VALUES (9,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:38',1);
INSERT INTO categories VALUES (10,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:49',1);
INSERT INTO categories VALUES (11,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:56',1);
INSERT INTO categories VALUES (12,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:22',1);
INSERT INTO categories VALUES (13,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:30',1);
INSERT INTO categories VALUES (14,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:14',1);
INSERT INTO categories VALUES (15,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:37',1);
INSERT INTO categories VALUES (16,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:25',1);
INSERT INTO categories VALUES (17,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:28',1);
INSERT INTO categories VALUES (96,NULL,94,20,'2007-01-26 03:33:54',NULL,1);
INSERT INTO categories VALUES (27,NULL,25,20,'2007-01-16 00:24:50','2007-01-26 03:31:06',1);
INSERT INTO categories VALUES (20,'',0,190,'2007-01-15 13:10:05','2007-02-01 17:38:10',1);
INSERT INTO categories VALUES (21,'',0,100,'2007-01-15 13:15:14','2007-02-01 17:37:40',1);
INSERT INTO categories VALUES (22,'',0,110,'2007-01-15 13:15:17','2007-02-01 17:37:55',1);
INSERT INTO categories VALUES (26,NULL,25,10,'2007-01-16 00:24:31','2007-01-26 03:43:46',1);
INSERT INTO categories VALUES (23,'',0,40,'2007-01-15 14:10:00','2007-02-01 17:37:13',1);
INSERT INTO categories VALUES (25,NULL,0,9000,'2007-01-16 00:22:56','2007-01-26 03:31:59',1);
INSERT INTO categories VALUES (29,NULL,26,10,'2007-01-16 00:25:31','2007-01-26 03:34:26',1);
INSERT INTO categories VALUES (30,NULL,26,20,'2007-01-16 00:25:46','2007-01-26 03:34:33',1);
INSERT INTO categories VALUES (31,NULL,26,30,'2007-01-16 00:26:06','2007-01-26 03:34:44',1);
INSERT INTO categories VALUES (94,NULL,25,30,'2007-01-26 03:29:40','2007-01-26 03:45:01',1);
INSERT INTO categories VALUES (95,NULL,94,10,'2007-01-26 03:32:51','2007-01-26 03:33:32',1);
INSERT INTO categories VALUES (45,'',84,100,'2007-01-16 19:27:32','2007-01-24 17:11:06',1);
INSERT INTO categories VALUES (41,'',0,400,'2007-01-16 15:11:23','2007-01-19 01:41:40',1);
INSERT INTO categories VALUES (40,'categories/category_free.gif',0,300,'2007-01-16 15:03:58','2007-02-01 17:41:21',1);
INSERT INTO categories VALUES (70,'',66,100,'2007-01-18 14:08:42','2007-01-18 14:40:49',1);
INSERT INTO categories VALUES (68,'',66,210,'2007-01-18 14:08:42','2007-01-18 14:19:31',1);
INSERT INTO categories VALUES (69,'',66,220,'2007-01-18 14:08:42','2007-01-18 14:19:51',1);
INSERT INTO categories VALUES (67,'',66,200,'2007-01-18 14:08:42','2007-01-18 15:28:46',1);
INSERT INTO categories VALUES (66,'',0,1000,'2007-01-18 14:08:42','2007-01-19 00:29:36',1);
INSERT INTO categories VALUES (61,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:54',1);
INSERT INTO categories VALUES (62,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:08',1);
INSERT INTO categories VALUES (63,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:33',1);
INSERT INTO categories VALUES (64,NULL,66,10000,'2007-01-17 18:06:48','2007-01-19 00:25:42',1);
INSERT INTO categories VALUES (60,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:40:03',1);
INSERT INTO categories VALUES (59,'',0,200,'2007-01-17 15:20:31','2007-02-01 17:38:41',1);
INSERT INTO categories VALUES (58,NULL,99,10000,'2007-01-16 21:31:45','2007-01-26 18:10:30',1);
INSERT INTO categories VALUES (71,'',66,700,'2007-01-18 14:08:42','2007-01-19 00:03:55',1);
INSERT INTO categories VALUES (72,'',66,1000,'2007-01-18 14:11:14','2007-01-19 00:05:31',1);
INSERT INTO categories VALUES (73,'',66,500,'2007-01-18 14:11:14','2007-01-18 14:18:33',1);
INSERT INTO categories VALUES (74,'',66,510,'2007-01-18 14:11:14','2007-01-18 14:18:39',1);
INSERT INTO categories VALUES (75,'',66,520,'2007-01-18 14:13:02','2007-01-18 14:18:46',1);
INSERT INTO categories VALUES (76,NULL,77,10,'2007-01-18 17:10:12','2007-01-23 00:59:03',1);
INSERT INTO categories VALUES (77,NULL,0,1200,'2007-01-18 17:40:48','2007-01-26 16:30:14',1);
INSERT INTO categories VALUES (78,NULL,77,20,'2007-01-18 17:45:38','2007-01-23 23:49:43',1);
INSERT INTO categories VALUES (79,NULL,0,500,'2007-01-19 01:25:28','2007-02-01 17:40:56',1);
INSERT INTO categories VALUES (80,NULL,99,3000,'2007-01-21 21:47:15','2007-01-26 18:15:51',1);
INSERT INTO categories VALUES (81,NULL,99,4000,'2007-01-23 10:24:53','2007-01-26 18:10:49',1);
INSERT INTO categories VALUES (82,NULL,99,5000,'2007-01-23 11:44:05','2007-01-26 18:12:53',1);
INSERT INTO categories VALUES (83,NULL,84,200,'2007-01-24 10:06:24','2007-01-25 20:18:56',1);
INSERT INTO categories VALUES (84,NULL,0,1100,'2007-01-24 10:18:28',NULL,1);
INSERT INTO categories VALUES (85,NULL,84,300,'2007-01-24 17:09:48','2007-01-24 17:10:44',1);
INSERT INTO categories VALUES (86,NULL,77,30,'2007-01-24 19:31:55','2007-01-24 20:55:37',1);
INSERT INTO categories VALUES (87,NULL,0,1300,'2007-01-24 20:02:17','2007-01-26 16:17:44',1);
INSERT INTO categories VALUES (89,NULL,0,2000,'2007-01-25 20:32:45','2007-01-26 18:17:18',1);
INSERT INTO categories VALUES (91,NULL,0,7200,'2007-01-26 03:16:19','2007-01-26 18:03:38',1);
INSERT INTO categories VALUES (99,NULL,0,10000,'2007-01-26 18:10:20',NULL,1);
INSERT INTO categories VALUES (93,NULL,0,7400,'2007-01-26 03:22:16','2007-01-26 18:04:08',1);
INSERT INTO categories VALUES (98,NULL,0,7300,'2007-01-26 14:12:54','2007-01-26 18:03:49',1);
INSERT INTO categories VALUES (97,NULL,0,7500,'2007-01-26 11:30:57','2007-01-26 18:18:53',1);
INSERT INTO categories VALUES (100,NULL,0,800,'2007-01-26 18:19:30',NULL,1);
INSERT INTO categories VALUES (101,NULL,59,0,'2007-01-31 01:39:40','2007-02-01 17:39:44',1);

#
# Dumping data for table `categories_description`
#

INSERT INTO categories_description VALUES (1,2,'Ｔシャツ（白）','ホワイトＴシャツ（大人サイズ）です');
INSERT INTO categories_description VALUES (2,2,'ロゴ(白)','');
INSERT INTO categories_description VALUES (3,2,'Ｔシャツ（カラー）','カラーＴシャツ（大人サイズ）です');
INSERT INTO categories_description VALUES (4,2,'ロゴ(カラー)','');
INSERT INTO categories_description VALUES (5,2,'猫シリーズ(白)','');
INSERT INTO categories_description VALUES (6,2,'キッズT','子供向けのＴシャツです。');
INSERT INTO categories_description VALUES (7,2,'かわいいの(for KIDS)','');
INSERT INTO categories_description VALUES (8,2,'猫シリーズ(カラー)','');
INSERT INTO categories_description VALUES (9,2,'ドラゴン(カラー)','');
INSERT INTO categories_description VALUES (10,2,'ドラゴン(for KIDS)','');
INSERT INTO categories_description VALUES (11,2,'犬シリーズ(カラー)','');
INSERT INTO categories_description VALUES (12,2,'アニマル(カラー)','');
INSERT INTO categories_description VALUES (13,2,'イラスト(カラー)','');
INSERT INTO categories_description VALUES (14,2,'アイコン(カラー)','');
INSERT INTO categories_description VALUES (15,2,'イラスト(白)','');
INSERT INTO categories_description VALUES (16,2,'アニマル(白)','');
INSERT INTO categories_description VALUES (17,2,'おさかな(for KIDS)','');
INSERT INTO categories_description VALUES (20,2,'ギフト券','ご家族やお友達、会社の同僚にギフト券を贈りましょう！<br /><br />\r\n\r\nギフト券はショップ内のすべての商品購入に使えます。<br /><br />\r\n\r\nギフト券を購入すると、まず自分のマイページ上にギフト券残高が追加され、この残高の範囲で誰か他の人に引換コードを贈ることができるようになります。');
INSERT INTO categories_description VALUES (21,2,'禅太郎\'s セレクト（リンク商品）','このカテゴリは「リンク商品」のサンプルです。<br />つまり、ここにある商品はすべて他のカテゴリにも登録され、共通の商品情報を参照している状態です。<br /><br />リンク商品の商品情報は、どちらか一方を編集するだけで両方に反映されます。<br /><br />複数のカテゴリにリンクしている商品には、「商品マスターカテゴリ」を指定しておきます。これは例えばセールなど商品カテゴリ毎に価格設定をするような場合に使われます。所属するマスターカテゴリにセール設定すると、その商品が適用対象になります。<br /><br />\r\n\r\n<strong>ONE POINT：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。');
INSERT INTO categories_description VALUES (22,2,'当店オリジナル（非リンク商品）','このカテゴリは、非リンク商品の例です。<br/>\r\n非リンク商品とは、つまり他のどのカテゴリからもリンクされていない（このカテゴリ配下にしか存在しない）商品という意味です。<br /><br />\r\n\r\n<strong>ONE POINT（1）：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。<br /><br />\r\n\r\n<strong>ONE POINT（2）：商品の並び順について</strong><br />\r\n商品が一覧されるときは、商品名のABC、あいうえお順に並びますが、<br />\r\n漢字を含む商品名は期待通りに並んでくれない可能性が高いです。<br /><br />\r\nもし、商品の並び順を明示的に与えたければ、商品情報の「ソート順」に数字をセットします。<br />\r\n同じカテゴリ内で、上から「ソート順」の数字が小さい順に並びます。<br />\r\nセットする数字は10、20、100など飛び飛びでもかまいません。');
INSERT INTO categories_description VALUES (23,2,'オリジナル壁紙','ダウンロード販売商品のサンプルです。');
INSERT INTO categories_description VALUES (25,1,'[1]Category(top level)','');
INSERT INTO categories_description VALUES (25,2,'カテゴリ構成例（[1]第1カテゴリ','これは、カテゴリ構成を理解するためのものです。<br /><br />\r\nここは第1レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリは以下のようなツリー構成になっています。<br /><br />\r\n[1]第1カテゴリ<br />\r\n　├[1.1]第2カテゴリ<br />\r\n　│　├[1.1.1]第3カテゴリ<br />\r\n　│　├[1.1.2]第3カテゴリ<br />\r\n　│　└[1.1.3]第3カテゴリ<br />\r\n　├[1.2]第2カテゴリ<br />\r\n　└[1.3]第2カテゴリ(1.3)<br />\r\n　　　├[1.3.1]第3カテゴリ<br />\r\n　　　└[1.3.2]第3カテゴリ');
INSERT INTO categories_description VALUES (95,1,'[1.3.1]Category(level3)','');
INSERT INTO categories_description VALUES (95,2,'[1.3.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO categories_description VALUES (26,1,'[1.1]Category(level2)','');
INSERT INTO categories_description VALUES (26,2,'[1.1]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。');
INSERT INTO categories_description VALUES (27,1,'[1.2]Category(level2)','');
INSERT INTO categories_description VALUES (27,2,'[1.2]第2カテゴリ','第2レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO categories_description VALUES (96,1,'[1.3.2]Category(level3)','');
INSERT INTO categories_description VALUES (29,1,'[1.1.1]Category(level3)','');
INSERT INTO categories_description VALUES (29,2,'[1.1.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO categories_description VALUES (30,1,'[1.1.2]Category(level3)','');
INSERT INTO categories_description VALUES (30,2,'[1.1.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO categories_description VALUES (31,1,'[1.1.3]Category(level3)','');
INSERT INTO categories_description VALUES (31,2,'[1.1.3]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO categories_description VALUES (94,1,'[1.3]Category(level2)','');
INSERT INTO categories_description VALUES (94,2,'[1.3]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。');
INSERT INTO categories_description VALUES (41,2,'お問い合せ商品例','価格お問い合せ商品の例です。<br /><br />\r\n\r\n価格お問い合せに指定した商品では、通常の購入（カゴに入れる）ボタンの代わりに、お問い合せフォームへのリンクが表示されます。<br /><br />顧客と担当者間での個別打ち合わせをはさんで下代を決めたい商品や、事前見積もりが必要なワークフローなどのケースに使います。');
INSERT INTO categories_description VALUES (40,2,'無料サンプル品の例','サンプル商品の提供など価格無料商品の各種設定例です。無料カタログ、プレゼント商品の提供などいろいろな応用シーンが考えられます。<br /><br />\r\n\r\n元の価格を表示しつつ無料化することや、本体価格は無料だが特定のオプション料金は有料とするなど細かい設定が可能です。また、送料も同時に無料にしたり、反対に送料だけ有料とすることも可能です。');
INSERT INTO categories_description VALUES (58,1,'SEO(META, Title..)','');
INSERT INTO categories_description VALUES (58,2,'SEO（METAタグ）設定例','SEO対策の一環として、Zen CartではMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのカテゴリに対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>〜</head>部分を確認してみてください。<br /><br />\r\n\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「このカテゴリには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br />');
INSERT INTO categories_description VALUES (45,2,'【基本】商品に対する数量割引設定','ここでは、いわゆるボリュームディスカウントの設定例を集めました。');
INSERT INTO categories_description VALUES (63,2,'DROPDOWNとRADIOタイプ','');
INSERT INTO categories_description VALUES (59,2,'商品オプションの各種タイプ','商品オプション属性の設定例を、オプションのタイプ別に例示します。');
INSERT INTO categories_description VALUES (60,2,'TEXTタイプ','');
INSERT INTO categories_description VALUES (61,2,'READONLYタイプ','');
INSERT INTO categories_description VALUES (62,2,'CHCKBOXタイプ','');
INSERT INTO categories_description VALUES (64,1,'(temporary)','');
INSERT INTO categories_description VALUES (64,2,'※商品オプション活用例説明用','※このカテゴリは、他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。');
INSERT INTO categories_description VALUES (66,2,'セールと特価','このカテゴリは、\r\nZen Cartが持つさまざまな割引機能の中でメイン機能ともいえる「特価」と「セール」について理解を深めるためのサンプル集です。<br /><br />\r\n\r\n\r\n<strong>NOTE：</strong> 特価とセールの違い<br />\r\n特価は、商品単位で設定可能な割引機能です。<br />\r\nそれに対してセールは、カテゴリ単位で設定可能な割引機能です。<br />\r\nこの2つは両方組み合わせて適用することも、どちらかを優先させることも可能です。<br /><br /><br />\r\n\r\n<strong>NOTE：</strong><br />\r\n以下の各カテゴリには全く同じ商品が3点ずつ収められており、違いはカテゴリに対するセール設定だけとしています。<br />\r\n異なるカテゴリの同じ商品同士を見比べると、セール設定によるふるまいの違いが理解しやすいと思います。<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の商品が3点ずつ入っています<br />\r\n　・セール：10％OFF<br />\r\n　・セール：10％OFF<br />\r\n　・セール：1万円を8000円に<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の特価適用商品が3点ずつ入っています<br />\r\n　・セール×特価：両方適用<br />\r\n　・セール×特価：セール優先<br />\r\n　・セール×特価：特価優先<br /><br /><br />\r\n\r\n---------\r\nなお、<br />\r\n「※商品オプション活用例説明用」カテゴリは<br />\r\n　他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。');
INSERT INTO categories_description VALUES (67,2,'セール：10％OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、10％引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO categories_description VALUES (68,2,'セール：500円OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、500円引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO categories_description VALUES (69,2,'セール：1万円を8000円に','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO categories_description VALUES (70,2,'特価設定例','商品単位で特価価格を設定することができます。<br />\r\nこのカテゴリでは特価機能の基本例を収めています。');
INSERT INTO categories_description VALUES (71,2,'セール関連etc','');
INSERT INTO categories_description VALUES (72,2,'セール対象外カテゴリ','このカテゴリは「商品マスターカテゴリ」を理解するためのサンプルです。<br />\r\n複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />\r\n\r\nこのカテゴリにはセールの設定をしていません。<br />\r\nこのカテゴリ配下には、共に複数のカテゴリにリンクされた商品が2つ入っています。<br /><br />\r\n\r\n1つは、このカテゴリが商品マスターカテゴリなのでセールは適用されません。<br />\r\nしかし、もう一方の商品は、セール適用カテゴリ「10％OFF」を商品マスターカテゴリとしているため、\r\n（このカテゴリがセール対象でないにもかかわらず）10％OFFになります。');
INSERT INTO categories_description VALUES (73,2,'セール×特価：両方適用','');
INSERT INTO categories_description VALUES (74,2,'セール×特価：セール優先','');
INSERT INTO categories_description VALUES (75,2,'セール×特価：特価優先','');
INSERT INTO categories_description VALUES (76,1,'Qty Min','');
INSERT INTO categories_description VALUES (76,2,'最小購入数：ご購入は●個から！','最小購入数を使えば<br />\r\n「ご購入は10個からとさせていただきます」といったケースに対応できます。');
INSERT INTO categories_description VALUES (78,1,'Qty Max','');
INSERT INTO categories_description VALUES (78,2,'最大購入数：お一人さま●点まで！','最大購入数の設定により\r\n「お一人さま1点まで」のように一度の購入に買える数を制限することができます。');
INSERT INTO categories_description VALUES (77,1,'Qty Min,Mix, Units','');
INSERT INTO categories_description VALUES (77,2,'購入単位や最小/大購入数の制限','Zen Cartでは、最小販売数、最大販売数を制限したり、購入単位の制限（ご購入は5個ずつ）などが可能です。');
INSERT INTO categories_description VALUES (79,1,'Shipping free products','');
INSERT INTO categories_description VALUES (79,2,'送料無料商品例','ここでは配送料無料とする設定例をご紹介します。<br />\r\nダウンロード商品はもちろん、有形の商品を送料サービスにしたい場合に使います。<br /><br />\r\n\r\nなお、<strong>ショップ全体に「ご購入1万円以上で送料無料！」を適用したい</strong>などのケースについては、配送モジュール設定の範疇ですので、ここでは扱いません。');
INSERT INTO categories_description VALUES (80,1,'Product Expected & Out of Stock','');
INSERT INTO categories_description VALUES (80,2,'入荷予定と在庫切れ商品例','このカテゴリには入荷予定商品と在庫切れ商品の例を収めてあります。<br /><br />\r\n\r\n<strong>【入荷予定商品】</strong>\r\n商品情報の「提供可能日」に未来の日付を入力すると入荷予定商品として扱われます。<br /><br />\r\n\r\n・入荷予定商品の場合、ユーザは商品情報の閲覧ができ、注文も可能です。<br />\r\n・入荷予定商品は、管理メニューの商品の管理＞入荷予定商品の管理 で一覧表示され一括管理することができます。<br /><br />\r\n\r\n\r\n<strong>【在庫切れ商品】</strong>\r\n在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br /><br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない');
INSERT INTO categories_description VALUES (81,1,'Consumption Tax','');
INSERT INTO categories_description VALUES (81,2,'消費税の扱い','消費税の扱いは2通り考えられます。<br />\r\nどちらも方法でも表示価格は同じように税込み価格で表示されますが、運営側内部で商品価格を内税/外税のどちらで管理するかが異なります。<br /><br />\r\n（1）外税で管理する：<br />\r\n　　商品価格には消費税分を含めない価格を入力します。<br />\r\n　　商品価格(グロス)には自動計算された税込み価格が入り、表示価格にはこれが表示されます。<br />\r\n　　消費税率が変更された場合は、管理サイトから税率を変えるだけで、対象商品全てに反映されます。<br /><br />\r\n（2）内税で管理する：<br />\r\n　　商品価格(グロス)に消費税分を含めた価格を入力して税区分を「消費税」とするか、税区分を「なし」にして商品価格に内税価格を直接入力するの2方法あります。<br />\r\n　　表示価格は、内税が表示されます。<br />\r\n　　もともとショップ内の基本台帳が税込み価格で管理されている場合はこちらを使います。<br />\r\n　　税込みの表示価格をキッカリ9800円にしたいなどの場合は内税で管理する方がわかりやすいです。<br />\r\n　　ただし、税区分を「なし」で設定した場合は、税率が変われば対象商品すべてを見直す必要があります');
INSERT INTO categories_description VALUES (82,1,'Add Images','');
INSERT INTO categories_description VALUES (82,2,'説明欄に追加の画像を掲載する方法','商品説明欄に、メイン画像以外の商品画像を掲載する方法を説明しています。<br />\r\n実現方法は、（1）自動表示する方法と（2）説明欄にHTML直書きして表示させる（手動）の2タイプあります。<br /><br />\r\n\r\n機能としては別モノですが、<br />\r\n商品オプションごとに画像を掲載する方法についても併せて掲載しておきます。');
INSERT INTO categories_description VALUES (83,1,'Qty Discounts by Attributes','');
INSERT INTO categories_description VALUES (83,2,'オプションに対する数量割引','Zen Cartでボリュームディスカウントを実現するもう一つの方法として、商品のオプション属性ごとのボリュームディスカウント設定方法があります。<br /><br />\r\n\r\n商品オプションごとの設定をすると、<br />\r\n同じTシャツ商品に対して、レッド選択時は10個以上で100円引きだけど、イエローだったら5個以上で200円引き・・といったことが実現できます。');
INSERT INTO categories_description VALUES (84,1,'Qty Discounts','Discount Quantities can be set for Products or on the individual attributes.<br />\r\nDiscounts on the Product do NOT reflect on the attributes price.<br />\r\nOnly discounts based on Special and Sale Prices are applied to attribute prices.');
INSERT INTO categories_description VALUES (84,2,'ボリュームディスカウント例','数量割引（ボリュームディスカウント）の設定例を集めたカテゴリです。<br /><br />\r\n\r\nZen Cartのボリュームディスカウント機能は2方法あり、設定対象や実現できることが異なります。<br /><br />\r\n\r\n（1）その商品に対して数量割引を行う方法<br />\r\n　　　数量割引の基本機能です。<br />\r\n　　　[商品価格の管理(Price Manager)]から設定します。<br /><br />\r\n\r\n（2）その商品のオプション属性に対して数量割引を行う方法<br />\r\n　　　オプション属性ごとに異なる数量割引設定が可能です。<br />\r\n<br />\r\n　　　[商品オプション属性]から設定します。<br />');
INSERT INTO categories_description VALUES (85,1,'OneTime Discount','');
INSERT INTO categories_description VALUES (85,2,'ワンタイム割引','オプション属性のワンタイム割引機能についての説明カテゴリです。<br />\r\n最初の1点目だけ500円割り引くといった使い方をします。<br />\"割引\"とネーミングされていますが、使い方次第で何個買っても1回だけかかる「基本料金（つまり割増）」としても使えます。');
INSERT INTO categories_description VALUES (86,1,'Qty Unit','');
INSERT INTO categories_description VALUES (86,2,'商品の数量単位：●個単位でご注文','ユニット単位で販売したい場合は、[商品の数量単位]を設定します。<br /><br />\r\n[商品の最小数量]や[商品の最大数量]の設定を組み合わせれば、<br />「1000個以上、200個単位でご注文ください。注文可能な最大数は5000個までです」<br />\r\nのような販売が可能になります。<br /><br />');
INSERT INTO categories_description VALUES (87,1,'Price-factor, Offset','');
INSERT INTO categories_description VALUES (87,2,'プライスファクターとオフセット','商品オプション属性の中でも、わかりづらいと悪評高い？！[プライスファクター]、[オフセット]などについて説明します。');
INSERT INTO categories_description VALUES (89,1,'Base/Product/Option Price','');
INSERT INTO categories_description VALUES (89,2,'ベース価格、商品価格、オプション','<strong>ベース価格、商品価格、オプション価格の関係</strong><br /><br />\r\n\r\nZen Cartでは、「ベース価格」という言い方があちこちに出てきますが、これは管理画面で入力した「商品価格」や「オプション価格」とどう違うのでしょうか？<br /><br />\r\n\r\nベース価格は、特価やセールなどの値引き計算や、プライスファクターを適用する際の基準額として使われます。商品名直下に表示される価格（ここでは表示価格と呼んでおきます）もこのベース価格が表示されます。<br /><br />\r\n\r\nあるオプションを選択した場合のベース価格は、<br /><br />\r\n\r\n　<strong>基本的には・・・<br />\r\n　[ベース価格]＝[商品価格]＋[（そのオプションの）オプション価格]</strong><br />\r\n\r\nです。<br />\r\nただし、以下の2つのフラグの状態によってオプション価格をベース価格に含めない場合があります。逆に言えばそのオプションに対してどう値付けをしたいかによってこのフラグを制御するわけです。\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nフラグとベース価格の関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>−</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\n家の電灯にたとえると、[商品属性による価格]フラグは家全体のブレーカー（これが切れれば全ての電灯が消える）にあたり、[属性による価格増減をベース価格に含める]フラグは各部屋のスイッチにあたります。');
INSERT INTO categories_description VALUES (91,1,'Product - Music','');
INSERT INTO categories_description VALUES (91,2,'特別な製品タイプ：Music','');
INSERT INTO categories_description VALUES (99,1,'Tips','');
INSERT INTO categories_description VALUES (93,1,'Document Type','');
INSERT INTO categories_description VALUES (93,2,'特別な製品タイプ：Document','商品タイプがドキュメントのカテゴリは、第1レベルでないとうまく動かないようです。');
INSERT INTO categories_description VALUES (96,2,'[1.3.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO categories_description VALUES (98,2,'特別な製品タイプ：Free Shipping','');
INSERT INTO categories_description VALUES (98,1,'Product - Free Shipping','');
INSERT INTO categories_description VALUES (97,1,'Mixed Product Types','This is a category with mixed product types. This includes both products and documents. There are two types of documents - Documents that are for reading and Documents that are for reading and purchasing.');
INSERT INTO categories_description VALUES (97,2,'さまざまな製品タイプを含む例','カテゴリに対する[商品タイプの制限]をしないか、あるいは扱いたい製品タイプを複数登録しておけば、そのカテゴリに異なる製品タイプを混在させることができます。');
INSERT INTO categories_description VALUES (99,2,'その他のTips','');
INSERT INTO categories_description VALUES (100,1,'Download Files','');
INSERT INTO categories_description VALUES (100,2,'ダウンロード商品','');
INSERT INTO categories_description VALUES (101,1,'FILE type','');
INSERT INTO categories_description VALUES (101,2,'FILEタイプ','このオプションタイプにすると、アップロード用のファイル選択欄が表示されます。');
INSERT INTO categories_description VALUES (1,1,'T-shirts(white)','T-shirts(white)');
INSERT INTO categories_description VALUES (2,1,'Logo T(white)','');
INSERT INTO categories_description VALUES (3,1,'T-shirts(color)','T-shirts(color)');
INSERT INTO categories_description VALUES (4,1,'Logo T(color)','');
INSERT INTO categories_description VALUES (5,1,'Cat T(white)','');
INSERT INTO categories_description VALUES (6,1,'T-shirts for kids','T-shirts for kids');
INSERT INTO categories_description VALUES (7,1,'Cute T(for Kids)','');
INSERT INTO categories_description VALUES (8,1,'Cat T(color)','');
INSERT INTO categories_description VALUES (9,1,'Dragon T(color)','');
INSERT INTO categories_description VALUES (10,1,'Dragon T(for Kids)','');
INSERT INTO categories_description VALUES (11,1,'Dog T(color)','');
INSERT INTO categories_description VALUES (12,1,'Animal T(color)','');
INSERT INTO categories_description VALUES (13,1,'Illust. T(color)','');
INSERT INTO categories_description VALUES (14,1,'Icon T(color)','');
INSERT INTO categories_description VALUES (15,1,'Illust. T(white)','');
INSERT INTO categories_description VALUES (16,1,'Animal T(white)','');
INSERT INTO categories_description VALUES (17,1,'Fish T(for Kids)','');
INSERT INTO categories_description VALUES (20,1,'Gift Certificates','Send a Gift Certificate today!<br />\r\nGift Certificates are good for anything in the store.');
INSERT INTO categories_description VALUES (21,1,'Zen\'s selection(Linked products','All of these products are \"Linked Products\".\r\n\r\nThis means that they appear in more than one Category.\r\n\r\nHowever, you only have to maintain the product in one place.\r\n\r\nThe Master Product is used for pricing purposes.');
INSERT INTO categories_description VALUES (22,1,'Shop Original(unlinked products)','shop originals. these are unlinked products.');
INSERT INTO categories_description VALUES (23,1,'wallpapers','wallpapers(download)');
INSERT INTO categories_description VALUES (40,1,'Free products','Free products');
INSERT INTO categories_description VALUES (41,1,'Call Stuff','call staff products');
INSERT INTO categories_description VALUES (45,1,'Qty Discount','');
INSERT INTO categories_description VALUES (59,1,'Option Types','Option Types');
INSERT INTO categories_description VALUES (60,1,'TEXT type','');
INSERT INTO categories_description VALUES (61,1,'READONLY Type','');
INSERT INTO categories_description VALUES (62,1,'CHCKBOX Type','');
INSERT INTO categories_description VALUES (63,1,'DROPDOWN & RADIO Type','');
INSERT INTO categories_description VALUES (66,1,'SALE & Special price','Sale & Special price');
INSERT INTO categories_description VALUES (67,1,'SALE Percent: 10% off','SALE 10% off');
INSERT INTO categories_description VALUES (68,1,'SALE Deduction: 500yen off','Sale Deduction');
INSERT INTO categories_description VALUES (69,1,'SALE New Price: set 8000 yen','Sale New Price');
INSERT INTO categories_description VALUES (70,1,'Special Price','Special Price');
INSERT INTO categories_description VALUES (71,1,'SALE etc..','');
INSERT INTO categories_description VALUES (72,1,'Not SALE','');
INSERT INTO categories_description VALUES (73,1,'SALE x Special','');
INSERT INTO categories_description VALUES (74,1,'SALE x Special: skip special','');
INSERT INTO categories_description VALUES (75,1,'SALE x Special: skip SALE','');

#
# Dumping data for table `customers`
#

INSERT INTO customers (customers_id, customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_nick, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_newsletter, customers_group_pricing, customers_email_format, customers_authorization, customers_referral) VALUES (NULL, 'm', 'Bill', 'Smith', '2001-01-01 00:00:00', 'root@localhost', '', 1, '12345', '', 'd95e8fa7f20a009372eb3477473fcd34:1c', '0', 0, 'TEXT', 0, '');

#
# Dumping data for table `customers_info`
#

INSERT INTO customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) VALUES (1, '0001-01-01 00:00:00', 0, '2004-01-21 01:35:28', '0001-01-01 00:00:00', 0);

#
# Dumping data for table `ezpages`
#

INSERT INTO ezpages (pages_id, languages_id, pages_title, alt_url, alt_url_external, pages_html_text, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter) VALUES (1, 1, 'EZページ', '', '', 'このページは、ヘッダにある「EZページ」からリンクされているページ群のメインページです。<br />\r\n<br />\r\n<strong>注意：EZページの活用方法については「EZ(イージー)ページとは?」を参照してください。</strong><br />\r\n<br />\r\n「EZページ」ボタンは、ヘッダ、サイドボックス、フッタのいずれか、または全ての場所に表示することができます。<br />\r\n<br />\r\nグルーピングを設定すると、グループ化されたページ郡の目次を表示することができます。<br />\r\n<br />\r\n他のページは、このメインページに設置した目次からリンクするか、またはヘッダーにメニューとして表示することもできます。好みで設定してください。<br />\r\n<br />\r\n', 1, 0, 0, 1, 10, 0, 0, 10, 0, 0, 10),
(2, 2, '追加ページ1(EZページの例)', '', '', 'このページは追加ページの例です。<br />\r\n<br />\r\nグループID10でグルーピングされ、目次は、表示順に従ってソートされています。<br />\r\n<br />\r\nこのページにはヘッダ、フッタ、サイドボックスからのリンクはなく、メインページの目次に表示されます。<br />\r\n<br />\r\n', 0, 0, 0, 1, 0, 0, 0, 30, 0, 0, 10),
(3, 2, '追加ページ2(EZページの例)', '', '', 'このページは、グループID10に属するもう1つの追加ページです。<br />\r\n<br />\r\nグループ内の表示順は10・20・30といった順であれば自由にナンバー付けすることができます。また、後でページを追加したり、すでにあるページへのリンクを追加したりすることができます。<br />\r\n<br />\r\nグループの単位にまとめることができるページやリンク先に制限はありません。<br />\r\n<br />\r\n[前へ][次へ]ボタンや、目次の表示・非表示については、設定画面で切り替えることができます。', 0, 0, 0, 1, 0, 0, 0, 40, 0, 0, 10),
(4, 2, 'Myリンク(EZページの例)', '', '', 'これは、サイドボックスにリンクが表示される単独のページの例です。<br />\r\n<br />\r\nこのページは章に属していないので、他の追加ページへのリンクはありません。<br />\r\n<br />\r\nあとからページを作成し、章や目次について設定することもできます。<br />\r\n<br />\r\n章に属していないページでは、[前へ] [次へ] ボタンや目次は自動的に非表示となります。', 0, 1, 0, 0, 0, 10, 0, 0, 0, 0, 0),
(5, 2, '何かのページ(EZページの例)', '', '', 'ページタイトルとリンク名は、コンテンツの内容を考慮して自由に設定することができます。<br />\r\n<br />\r\nまた、リンクの表示場所はヘッダ、サイドボックス、フッタから1ヵ所だけ・全てなどを設定できます。<br />\r\n<br />\r\nこのページからのリンクを、同一ウィンドウで開くか別ウィンドウで開くか、リンク先は非セキュア(非SSL)ページかセキュア(SSL)ページか、などを設定することもできます。', 0, 1, 0, 0, 0, 20, 0, 0, 0, 0, 0),
(6, 2, 'シェアード(Shared)ページ(EZページの例)', '', '', 'このページはヘッダ、サイドボックス、フッタからのシェアード(Shared)リンクが張られたページの例です。<br />\r\n<br />\r\nソート順はわかりやすく50に設定してありますが、ヘッダ、サイドボックス、フッタのそれぞれで違うものにすることもできます。<br />\r\n<br />\r\n', 1, 1, 1, 0, 50, 50, 50, 0, 0, 0, 0),
(7, 2, 'Myアカウント(EZページの例)', 'index.php?main_page=account', '', '', 0, 0, 1, 0, 0, 0, 10, 0, 0, 1, 0),
(8, 2, 'サイトマップ(EZページの例)', 'index.php?main_page=site_map', '', '', 0, 1, 1, 0, 0, 40, 20, 0, 0, 0, 0),
(9, 2, '個人情報保護方針(EZページの例)', 'index.php?main_page=privacy', '', '', 1, 0, 1, 0, 30, 0, 40, 0, 0, 0, 0),
(10, 2, 'Zen Cartについて(EZページの例)', '', 'http://www.zen-cart.com', '', 1, 0, 0, 0, 60, 0, 0, 0, 1, 0, 0),
(11, 2, 'ギフト券について(EZページの例)', 'index.php?main_page=index&cPath=21', '', '', 0, 1, 0, 0, 0, 60, 0, 0, 0, 0, 0),
(12, 2, 'DVD - アクション(EZページの例)', 'index.php?main_page=index&cPath=3_10', '', '', 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, 0),
(13, 2, 'Googleについて(EZページの例)', '', 'http://www.google.com', '', 0, 1, 0, 0, 0, 70, 0, 0, 1, 0, 0),
(14, 2, 'EZ(イージー)ページとは?', '', '', '<table cellspacing="4" cellpadding="4" border="3" align="center" style="width: 80%;"><tbody><tr><td><span style="font-style: italic;"><span style="font-weight: bold;">注意：このEZページは、HTMLareaを使って作成しました。ですので、他のエディタではうまく表示できない可能性があります。</span></span></td></tr></tbody></table><br />\r\n<br />\r\n<span style="font-weight: bold; color: rgb(255, 0, 0);">まとめ</span><br />\r\n<br />\r\n<span style="font-weight: bold;">EZページ</span>では、追加ページの作成や、リンクの設定を簡単に行うことができます。<br />\r\n<br />\r\n追加ページの用途の例：<br />\r\n<ul><li>新規ページ</li><li>サイト内リンクのページ</li><li>サイト外リンクのページ</li><li>セキュア(SSL)/非セキュア(非SSL)ページ</li><li>同一ウィンドウで開くページ/別ウィンドウで開くページ</li></ul>さらにページ同士をグループでまとめ、その「目次」を表示することもできます。<br />\r\n<br />\r\n<span style="font-weight: bold; color: rgb(255, 0, 0);">リンクの命名</span><br />\r\n<br />\r\nリンクはページタイトルで命名されます。すべてのリンクは、機能するためにはページタイトルが必要であり、これを忘れるとリンクを追加することができません。<br />\r\n<br />\r\n<span style="font-weight: bold;"><span style="color: rgb(255, 0, 0);">リンクの設置</span><br />\r\n<br />\r\n</span>管理画面で、ヘッダ、サイドボックス、フッタのどこに表示するかを設定する必要があります。3ヵ所全てに表示することも、好みの場所だけに表示することもできます。<br />\r\n30をヘッダに、50をサイドボックスに、といった設定も可能です。<br />\r\nナンバーの振り方は自由ですが、たとえば10・20・30というナンバー付けをすれば、ソートに役立ち、また後から(それらの間に)リンクを追加することもできるでしょう。<br />\r\n<br />\r\n注意：値を「0」にするとリンクは表示されなくなります。<br />\r\n<br />\r\n<span style="font-weight: bold;"><span style="color: rgb(255, 0, 0);">「別ウィンドウで開く」とセキュア(SSL対応)ページ</span><br />\r\n</span><br />\r\nEZページでは、リンク先を通常のように同一ウィンドウで開くことも、また新規ウィンドウで開くように設定することもできます。<br />\r\nまた、リンク先をセキュア(SSL対応)ページで開くか、非セキュア(SSL非対応)ページとして開くかを設定することもできます。<br />\r\n<br />\r\n<span style="font-weight: bold; color: rgb(255, 0, 0);">「グルーピング」</span><br style="font-weight: bold; color: rgb(255, 0, 0);" /><br />\r\n「グルーピング」は、EZページ同士をまとめ相互をリンクさせるスマートな方法です。<br />\r\n<br />\r\nEZページで作成された複数のページ群がある際に、そのメインページへのリンクをヘッダ、サイドボックス、フッタのいずれかに表示するリンク設定をしましょう。<br />\r\n次に、そのリンクと関連づけるグループIDを設定します。<br />\r\nそして、グループ内の表示順を設定してください。これが目次の並び順になります。<br />\r\n<br />\r\n<span style="font-weight: bold; font-style: italic;">注意：ヘッダ、サイドボックス、フッタには、グループに含まれる全てのページをリンクとして表示することもでき、ヘッダにはAというページを、フッタにはBというページを、と設定することもできます。または、グループのメインページか特定のページが開いている際にだけ表示するリンクを設定することもできます。</span><br />\r\n<br />\r\n<span style="color: rgb(255, 0, 0); font-weight: bold;">「外部リンク」</span><br />\r\n<br />\r\n「外部リンク」は、あなたのショップ外のページへのリンクです。このページへのリンクは "http://www.sashbox.net/" のように設定します。<br />\r\nリンク先を同一ウィンドウで開くか、別ウィンドウで開くかを設定することができます。<br />\r\n<br />\r\n<span style="color: rgb(255, 0, 0); font-weight: bold;">「内部リンク」</span><br />\r\n<br />\r\n「内部リンク」はあなたのショップ内のページへのリンクです。このページへのリンクは、たとえばID21のカテゴリへリンクする際には "index.php?main_page=index&cPath=21" のように相対パスで設定します。絶対パスで記入する際には、ドメインを変更した際などに修正する必要があることに注意してください。<br />\r\nリンク先を同一ウィンドウで開くか、別ウィンドウで開くかを設定することができます。<br />\r\n<br />\r\n<span style="font-weight: bold; color: rgb(255, 0, 0);">EZページの編集についての注意</span><br />\r\n<br />\r\nHTMLareaのようなエディタを使っている際、HTML編集エリアでEnterキーなどを押すと、コンテンツが追加されたと見なされる(「追加ページ」となる)ことがあります。その場合、内部リンクや外部リンクの設定は無効になってしまいますので注意してください。<br />\r\n<br />\r\n<span style="font-weight: bold; color: rgb(255, 0, 0);">「管理者にのみ表示」設定</span><br />\r\n<br />\r\nこれは、実際に稼動しているショップでEZページを編集する際に便利な設定です。<br />\r\nEZページのヘッダ、サイドボックス、フッタへの表示は<br />\r\n<ul><li>オフ</li><li>オン</li><li>管理者にのみ表示</li></ul>の設定をすることができます。「管理者にのみ表示」にしておくと、管理画面の「『メンテナンス中』- 設定したIPアドレスを除く」で設定したIPアドレスでアクセスした際にだけ、EZページへのリンクが表示されます。<br />\r\n<br />\r\n', 0, 0, 0, 1, 0, 0, 0, 20, 0, 0, 10);

#
# Dumping data for table `featured`
#

INSERT INTO featured VALUES (1,18,'2007-01-18 00:38:40',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO featured VALUES (2,2,'2007-01-18 00:38:50',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO featured VALUES (3,4,'2007-01-18 00:38:59',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO featured VALUES (4,9,'2007-01-18 00:39:11',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO featured VALUES (5,28,'2007-01-18 00:39:33',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO featured VALUES (6,11,'2007-01-18 00:40:27',NULL,'0001-01-01',NULL,1,'0001-01-01');

#
# Dumping data for table `group_pricing`
#

INSERT INTO group_pricing (group_id, group_name, group_percentage, last_modified, date_added) VALUES (1, '10%割引', '10.00', NULL, '2004-04-29 00:21:04');

#
# Dumping data for table `manufacturers`
#

INSERT INTO manufacturers VALUES (1,'ABCアート',NULL,'2007-01-17 14:59:37','2007-01-21 22:22:03');
INSERT INTO manufacturers VALUES (2,'山田屋Tシャツ株式会社',NULL,'2007-01-21 22:19:08','2007-01-21 22:19:55');
INSERT INTO manufacturers VALUES (3,'ZenMarT商会',NULL,'2007-01-21 22:20:41',NULL);
INSERT INTO manufacturers VALUES (4,'XYZデザイン',NULL,'2007-01-21 22:21:38',NULL);

#
# Dumping data for table `manufacturers_info`
#

INSERT INTO manufacturers_info VALUES (2,1,'',0,NULL);
INSERT INTO manufacturers_info VALUES (2,2,'',0,NULL);
INSERT INTO manufacturers_info VALUES (3,1,'',0,NULL);
INSERT INTO manufacturers_info VALUES (3,2,'',0,NULL);
INSERT INTO manufacturers_info VALUES (4,1,'',0,NULL);
INSERT INTO manufacturers_info VALUES (4,2,'',0,NULL);

#
# Dumping data for table `media_clips`
#

INSERT INTO media_clips VALUES (1,1,1,'thehunter.mp3','2007-01-26 10:50:45','0001-01-01 00:00:00');
INSERT INTO media_clips VALUES (3,1,1,'help.mp3','2007-01-26 11:03:23','0001-01-01 00:00:00');

#
# Dumping data for table `media_manager`
#

INSERT INTO media_manager VALUES (1,'Help!','2007-01-26 11:03:23','2007-01-26 10:50:30');
INSERT INTO media_manager VALUES (2,'Russ Tippins - The Hunter','2007-01-26 10:51:28','2007-01-26 10:51:10');

#
# Dumping data for table `media_to_products`
#

INSERT INTO media_to_products VALUES (1,213);
INSERT INTO media_to_products VALUES (1,229);
INSERT INTO media_to_products VALUES (2,212);

#
# Dumping data for table `music_genre`
#

INSERT INTO music_genre VALUES (1,'Jazz','2007-01-26 10:45:31',NULL);
INSERT INTO music_genre VALUES (2,'Rock','2007-01-26 10:45:46',NULL);

#
# Dumping data for table `product_music_extra`
#

INSERT INTO product_music_extra VALUES (212,1,0,2);
INSERT INTO product_music_extra VALUES (213,0,1,2);
INSERT INTO product_music_extra VALUES (229,0,1,2);

#
# Dumping data for table `product_types_to_category`
#

INSERT INTO product_types_to_category VALUES (2,91);
INSERT INTO product_types_to_category VALUES (3,93);
INSERT INTO product_types_to_category VALUES (4,93);
INSERT INTO product_types_to_category VALUES (1,97);
INSERT INTO product_types_to_category VALUES (3,97);
INSERT INTO product_types_to_category VALUES (4,90);
INSERT INTO product_types_to_category VALUES (4,92);
INSERT INTO product_types_to_category VALUES (4,97);
INSERT INTO product_types_to_category VALUES (5,98);

#
# Dumping data for table `products`
#

INSERT INTO products VALUES (1,1,1000,'SAMPLE-T01','sample_t/t-shirt_01.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 22:27:22',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,4050.0000,2,1,0,0,0,0,0);
INSERT INTO products VALUES (2,1,1000,'SAMPLE-T02','sample_t/t-shirt_02.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 22:28:03',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,4,1,0,0,0,0,0);
INSERT INTO products VALUES (3,1,1000,'SAMPLE-T03','sample_t/t-shirt_03.gif',4500.0000,0,'2007-01-16 15:03:56','2007-01-21 22:27:35',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,2,1,0,0,0,0,0);
INSERT INTO products VALUES (4,1,1000,'SAMPLE-T04','sample_t/t-shirt_04.gif',4500.0000,0,'2007-01-16 15:03:56','2007-01-20 17:48:17',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,2,1,0,0,0,0,0);
INSERT INTO products VALUES (5,1,1000,'SAMPLE-T05','sample_t/t-shirt_05.gif',4500.0000,0,'2007-01-16 15:03:56','2007-01-21 22:27:48',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (6,1,1000,'SAMPLE-T06','sample_t/t-shirt_06.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,5,1,0,0,0,0,0);
INSERT INTO products VALUES (7,1,1000,'SAMPLE-T06KIDS','sample_t/t-shirt_06.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (8,1,1000,'SAMPLE-T07','sample_t/t-shirt_07.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (9,1,1000,'SAMPLE-T08','sample_t/t-shirt_08.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,5,1,0,0,0,0,0);
INSERT INTO products VALUES (10,1,1000,'SAMPLE-T09','sample_t/t-shirt_09.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (11,1,1000,'SAMPLE-T10','sample_t/t-shirt_10.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:42:21',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,5,1,0,0,0,0,0);
INSERT INTO products VALUES (12,1,0,'SAMPLE-T10KIDS','sample_t/t-shirt_10.gif',3800.0000,0,'2007-01-16 15:03:57','2007-02-01 18:55:14',NULL,0.2,1,1,1,0,1,1,0,0,0,0,0,1,0,10,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (13,1,1000,'SAMPLE-T11','sample_t/t-shirt_11.gif',4500.0000,0,'2007-01-16 15:03:57','2007-02-01 18:56:23',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (14,1,0,'SAMPLE-T12','sample_t/t-shirt_12.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:11:55',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,12,0,0,4500.0000,5,1,0,0,0,0,0);
INSERT INTO products VALUES (15,1,1000,'SAMPLE-T13','sample_t/t-shirt_13.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (16,1,1000,'SAMPLE-T13KIDS','sample_t/t-shirt_13.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (17,1,1000,'SAMPLE-T14','sample_t/t-shirt_14.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,11,0,0,0,0,0,0);
INSERT INTO products VALUES (18,1,1000,'SAMPLE-T15','sample_t/t-shirt_15.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (19,1,1000,'SAMPLE-T16','sample_t/t-shirt_16.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:25:53',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (20,1,1000,'SAMPLE-T16KIDS','sample_t/t-shirt_16.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-21 22:30:37',NULL,0.2,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (21,1,1000,'SAMPLE-T17','sample_t/t-shirt_17.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 22:26:50',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,13,1,0,0,0,0,0);
INSERT INTO products VALUES (22,1,1000,'SAMPLE-T18','sample_t/t-shirt_18.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 22:26:38',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (23,1,1000,'SAMPLE-T19','sample_t/t-shirt_19.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,14,1,0,0,0,0,0);
INSERT INTO products VALUES (24,1,1000,'SAMPLE-T20','sample_t/t-shirt_20.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,14,1,0,0,0,0,0);
INSERT INTO products VALUES (25,1,1000,'SAMPLE-T21','sample_t/t-shirt_21.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (26,1,1000,'SAMPLE-T21KIDS','sample_t/t-shirt_21.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (27,1,1000,'SAMPLE-T22','sample_t/t-shirt_22.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:31:27',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (28,1,1000,'SAMPLE-T22KIDS','sample_t/t-shirt_22.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-21 22:30:49',NULL,0.2,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (29,1,1000,'SAMPLE-T23','sample_t/t-shirt_23.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,14,1,0,0,0,0,0);
INSERT INTO products VALUES (30,1,1000,'SAMPLE-T23KIDS','sample_t/t-shirt_23.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (31,1,1000,'SAMPLE-T24','sample_t/t-shirt_24.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,14,1,0,0,0,0,0);
INSERT INTO products VALUES (32,1,1000,'SAMPLE-T25','sample_t/t-shirt_25.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-18 00:35:01',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,14,1,0,0,0,0,0);
INSERT INTO products VALUES (33,1,1000,'SAMPLE-T26','sample_t/t-shirt_26.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (34,1,1000,'SAMPLE-T27','sample_t/t-shirt_27.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (35,1,1000,'SAMPLE-T28','sample_t/t-shirt_28.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (36,1,1000,'SAMPLE-T28KIDS','sample_t/t-shirt_28.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (37,1,1000,'SAMPLE-T29','sample_t/t-shirt_29.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (38,1,1000,'SAMPLE-T30','sample_t/t-shirt_30.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-26 03:38:47',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,9,1,0,0,0,0,0);
INSERT INTO products VALUES (39,1,1000,'SAMPLE-T30KIDS','sample_t/t-shirt_30.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (40,1,1000,'SAMPLE-T31','sample_t/t-shirt_31.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (41,1,1000,'SAMPLE-T31KIDS','sample_t/t-shirt_31.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (42,1,1000,'SAMPLE-T32','sample_t/t-shirt_32.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (43,1,1000,'SAMPLE-T33','sample_t/t-shirt_33.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 21:26:40','2007-06-10 00:00:00',0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (44,1,1000,'SAMPLE-T34','sample_t/t-shirt_34.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (45,1,1000,'SAMPLE-T35','sample_t/t-shirt_35.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (46,1,1000,'SAMPLE-T36','sample_t/t-shirt_36.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:26:23',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (47,1,1000,'SAMPLE-T37','sample_t/t-shirt_37.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (48,1,1000,'SAMPLE-T38','sample_t/t-shirt_38.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 21:25:57','2007-04-01 00:00:00',0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,13,1,0,0,0,0,0);
INSERT INTO products VALUES (49,1,1000,'SAMPLE-T39','sample_t/t-shirt_39.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-18 00:37:13',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (50,1,1000,'SAMPLE-T40','sample_t/t-shirt_40.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:24:08',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,15,1,0,0,0,0,0);
INSERT INTO products VALUES (51,1,1000,'SAMPLE-T41','sample_t/t-shirt_41.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:23:36',NULL,0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,16,1,0,0,0,0,0);
INSERT INTO products VALUES (52,1,1000,'SAMPLE-T41KIDS','sample_t/t-shirt_41.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-21 22:28:43',NULL,0.2,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (53,1,1000,'SAMPLE-T42','sample_t/t-shirt_42.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:22:48',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,16,1,0,0,0,0,0);
INSERT INTO products VALUES (54,1,1000,'SAMPLE-T43','sample_t/t-shirt_43.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 22:25:40',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,12,1,0,0,0,0,0);
INSERT INTO products VALUES (55,1,1000,'SAMPLE-T43KIDS','sample_t/t-shirt_43.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-21 22:29:01',NULL,0.2,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (56,1,1000,'SAMPLE-T44','sample_t/t-shirt_44.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:25:19',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (57,1,1000,'SAMPLE-T44KIDS','sample_t/t-shirt_44.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-21 21:58:29','2007-06-03 00:00:00',0.2,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,17,1,0,0,0,0,0);
INSERT INTO products VALUES (58,1,1000,'SAMPLE-T45','sample_t/t-shirt_45.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (59,1,1000,'SAMPLE-T45KIDS','sample_t/t-shirt_45.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (60,1,1000,'SAMPLE-T46','sample_t/t-shirt_46.gif',4500.0000,0,'2007-01-16 15:03:58','2007-01-21 22:24:33',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (61,1,1000,'SAMPLE-T46KIDS','sample_t/t-shirt_46.gif',3800.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,3800.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (62,1,1000,'SAMPLE-T47','sample_t/t-shirt_47.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:22:26',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,16,1,0,0,0,0,0);
INSERT INTO products VALUES (63,1,1000,'SAMPLE-T48','sample_t/t-shirt_48.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:25:02','2007-08-12 00:00:00',0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,12,1,0,0,0,0,0);
INSERT INTO products VALUES (64,1,1000,'SAMPLE-T49','sample_t/t-shirt_49.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-21 22:23:12',NULL,0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,16,1,0,0,0,0,0);
INSERT INTO products VALUES (65,1,1000,'SAMPLE-T50','sample_t/t-shirt_50.gif',4500.0000,0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,2,1,0,0,0,0,0);
INSERT INTO products VALUES (90,1,1000,'SAMPLE-WP03','sample_w/wallpaper_03.jpg',200.0000,1,'2007-01-16 15:50:07','2007-01-23 11:34:23',NULL,0,1,1,0,0,1,1,0,0,0,0,2,1,0,3,0,0,200.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (89,1,1000,'SAMPLE-WP02','sample_w/wallpaper_02.jpg',200.0000,1,'2007-01-16 15:50:07','2007-01-23 11:34:10',NULL,0,1,1,0,0,1,1,0,0,0,0,2,1,0,2,0,0,200.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (88,1,1000,'SAMPLE-WP01','sample_w/wallpaper_01.jpg',200.0000,1,'2007-01-16 15:50:07','2007-01-23 11:33:59',NULL,0,1,1,0,0,1,1,0,0,0,0,2,1,0,1,0,0,200.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (70,1,1000,'GIFT005','gift_certificates/gv_5.gif',500.0000,0,'2007-01-16 15:03:58','2007-01-20 14:40:45',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,500,0,0,500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (71,1,1000,'GIFT 010','gift_certificates/gv_10.gif',1000.0000,0,'2007-01-16 15:03:58','2007-01-20 14:37:46',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,1000,0,0,1000.0000,20,1,0,0,0,0,0);
INSERT INTO products VALUES (72,1,1000,'GIFT025','gift_certificates/gv_25.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-20 14:38:41',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,2500,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (73,1,1000,'GIFT050','gift_certificates/gv_50.gif',5000.0000,0,'2007-01-16 15:03:58','2007-01-27 20:58:47',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,5000,0,0,5000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (74,1,1000,'GIFT100','gift_certificates/gv_100.gif',10000.0000,0,'2007-01-16 15:03:58','2007-01-20 14:38:11',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,10000,0,0,10000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (75,1,1000,'GIFTSELECT','gift_certificates/gv.gif',0.0000,0,'2007-01-16 15:03:58','2007-01-22 10:56:42',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,20000,0,0,0.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (76,1,1000,'NOTLINK01','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:28:51',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (77,1,1000,'NOTLINK02','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:29:10',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (78,1,1000,'NOTLINK03','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:29:22',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (79,1,1000,'NOTLINK04','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:29:33',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (80,1,1000,'NOTLINK05','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:29:52',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (81,1,1000,'NOTLINK08','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:30:45',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (82,1,1000,'NOTLINK10','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:31:56',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (83,1,1000,'NOTLINK06','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:31:04',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (84,1,1000,'NOTLINK07','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:31:20',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (85,1,1000,'NOTLINK12','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:32:37',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (86,1,1000,'NOTLINK09','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:31:41',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (87,1,1000,'NOTLINK11','sample_t/t-sample.gif',2500.0000,0,'2007-01-16 15:03:58','2007-01-18 00:32:23',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,2500.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (92,1,1000,'FREEALL','sample_t/t-sample.gif',0.0000,0,'2007-01-16 15:50:07','2007-01-26 15:10:55',NULL,1,1,0,0,0,1,1,0,1,0,0,1,1,0,10,0,0,0.0000,40,1,0,0,0,0,0);
INSERT INTO products VALUES (93,1,1000,'FREE3','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 15:50:07','2007-01-18 09:59:02',NULL,1,1,0,0,0,1,1,0,1,0,0,0,1,0,40,0,0,0.0000,40,1,0,0,0,0,0);
INSERT INTO products VALUES (91,1,1000,'SAMPLE-WP04','sample_w/wallpaper_04.jpg',200.0000,1,'2007-01-16 15:50:07','2007-01-23 11:34:34',NULL,0,1,1,4,0,1,1,0,0,0,0,2,1,0,4,0,0,200.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (222,1,1000,'FREESHIP1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-26 15:27:23','2007-01-26 15:39:06',NULL,50,1,0,0,0,1,1,0,0,0,0,1,1,0,1,0,0,4000.0000,79,1,0,0,0,0,0);
INSERT INTO products VALUES (95,1,1000,'FREE1','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 15:50:07','2007-01-18 09:57:54',NULL,10,1,0,0,0,1,1,0,1,0,0,1,1,0,20,0,0,0.0000,40,1,0,0,0,0,0);
INSERT INTO products VALUES (101,1,1000,'CALL3','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 17:24:53','2007-01-24 09:52:47',NULL,1,1,0,0,0,1,1,0,0,1,0,0,1,0,0,0,0,8100.0000,64,1,0,0,0,0,0);
INSERT INTO products VALUES (98,1,1000,'FREEATTRB1','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 15:50:07','2007-01-23 00:15:26',NULL,0,1,0,0,0,1,1,0,1,0,0,0,1,0,50,0,0,0.0000,40,1,0,0,0,0,0);
INSERT INTO products VALUES (99,1,1000,'CALL1','sample_t/t-sample.gif',0.0000,0,'2007-01-16 15:50:07','2007-01-16 15:50:07',NULL,1,1,0,NULL,0,1,1,0,0,1,0,0,1,0,0,0,0,0.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (100,1,1000,'CALL2','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 15:50:07','2007-01-21 00:15:45',NULL,1,1,0,0,0,1,1,0,0,1,0,0,1,0,0,0,0,10000.0000,41,1,0,0,0,0,0);
INSERT INTO products VALUES (102,1,1000,'DISCNTQTY1','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:16','2007-01-17 23:37:02',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,10,1,0,10000.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (103,1,1000,'DISCNTQTY2','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:16','2007-01-21 00:33:44',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,20,3,0,10000.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (104,1,1000,'DISCNTQTY3','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:17','2007-01-17 23:37:35',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,30,2,0,10000.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (115,1,1000,'SEO','',10000.0000,0,'2007-01-16 21:41:07','2007-01-17 16:30:59',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,0,0,0,10000.0000,58,1,1,1,1,1,1);
INSERT INTO products VALUES (113,1,1000,'DISCNTQTY8','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:17','2007-01-24 15:56:19',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,80,1,1,5000.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (112,1,1000,'DISCNTQTY7','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:17','2007-01-24 15:55:33',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,70,1,0,10000.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (111,1,1000,'DISCNTQTY5','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:17','2007-01-17 23:55:45',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,50,1,1,5000.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (110,1,1000,'DISCNTQTY4','sample_t/t-sample.gif',10000.0000,0,'2007-01-16 21:10:17','2007-01-17 23:55:21',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,40,1,0,9500.0000,45,1,0,0,0,0,0);
INSERT INTO products VALUES (116,1,1000,'SEO2','',10000.0000,0,'2007-01-16 21:54:19','2007-01-16 22:00:23',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,10000.0000,58,1,0,0,0,0,0);
INSERT INTO products VALUES (151,1,1000,'ATTR_RADIO3','no_picture.gif',0.0000,0,'2007-01-17 18:12:19','2007-01-18 01:04:39',NULL,0,1,0,0,0,10,1,1,0,0,0,0,1,0,0,0,0,5.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (227,1,1000,'ATTR_FILE','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-31 01:40:08','2007-02-01 18:36:02',NULL,0.2,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,5000.0000,101,1,0,0,0,0,0);
INSERT INTO products VALUES (139,1,1000,'ATTR_TEXT1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-17 15:20:31','2007-01-17 17:28:37',NULL,0.2,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,4000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (140,1,1000,'ATTR_TEXT2','sample_t/t-shirt_02.gif',4000.0000,0,'2007-01-17 15:20:31','2007-01-17 17:29:01',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (141,1,1000,'ATTR_RDONLY','no_picture.gif',4000.0000,0,'2007-01-17 15:20:31','2007-01-17 17:31:44',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4000.0000,61,1,0,0,0,0,0);
INSERT INTO products VALUES (142,1,1000,'ATTR_CHKBOX1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-17 15:20:31','2007-01-17 15:20:31',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (143,1,1000,'ATTR_CHKBOX2','sample_t/t-shirt_02.gif',0.0000,0,'2007-01-17 15:20:31','2007-01-17 17:57:25',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,0.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (144,1,1000,'ATTR_DROPDOWN1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-17 15:20:31','2007-01-17 19:09:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4000.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (152,1,1000,'ATTR_DROPDOWN2','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-17 19:09:41','2007-01-21 00:04:16',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,3600.0000,64,0,0,0,0,0,0);
INSERT INTO products VALUES (146,1,1000,'ATTR_DROPDOWN3','no_picture.gif',0.0000,0,'2007-01-17 15:20:31','2007-01-18 01:04:56',NULL,0,1,0,0,0,10,1,1,0,0,0,0,1,0,0,0,0,5.0000,0,1,0,0,0,0,0);
INSERT INTO products VALUES (156,1,1000,'SALE10-1','sample_t/t-shirt_01.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-26 15:19:15',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,9000.0000,67,1,0,0,0,0,0);
INSERT INTO products VALUES (155,1,1000,'FREEATTRB2','sample_t/t-sample.gif',10000.0000,0,'2007-01-18 10:22:57','2007-01-18 10:25:25',NULL,0,1,0,0,0,1,1,0,1,0,0,0,1,0,50,0,0,0.0000,40,1,0,0,0,0,0);
INSERT INTO products VALUES (157,1,1000,'SALE10-2','sample_t/t-shirt_02.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,10000.0000,67,1,0,0,0,0,0);
INSERT INTO products VALUES (158,1,1000,'SALE10-3','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-18 23:24:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,9000.0000,67,1,0,0,0,0,0);
INSERT INTO products VALUES (159,1,1000,'SALE500-1','sample_t/t-shirt_01.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,9500.0000,68,1,0,0,0,0,0);
INSERT INTO products VALUES (160,1,1000,'SALE500-2','sample_t/t-shirt_02.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-19 01:10:08',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,9500.0000,68,1,0,0,0,0,0);
INSERT INTO products VALUES (161,1,1000,'SALE500-3','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,9500.0000,68,1,0,0,0,0,0);
INSERT INTO products VALUES (162,1,1000,'SALESET8000-1','sample_t/t-shirt_01.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,8000.0000,69,1,0,0,0,0,0);
INSERT INTO products VALUES (163,1,1000,'SALESET8000-2','sample_t/t-shirt_02.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 01:15:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,8000.0000,69,1,0,0,0,0,0);
INSERT INTO products VALUES (164,1,1000,'SALESET8000-3','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,8000.0000,69,1,0,0,0,0,0);
INSERT INTO products VALUES (165,1,1000,'SPECIAL1-1','sample_t/t-shirt_01.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,8000.0000,70,1,0,0,0,0,0);
INSERT INTO products VALUES (166,1,1000,'SPECIAL2-1','sample_t/t-shirt_01.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,70,1,0,0,0,0,0);
INSERT INTO products VALUES (167,1,1000,'SPECIAL2-2','sample_t/t-shirt_02.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,70,1,0,0,0,0,0);
INSERT INTO products VALUES (168,1,1000,'SPECIAL2-3','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,70,1,0,0,0,0,0);
INSERT INTO products VALUES (169,1,1000,'SPECIAL3','sample_t/t-shirt_04.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:29:48',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,70,0,0,0,0,0,0);
INSERT INTO products VALUES (170,1,1000,'SALE_ETC1','sample_t/t-shirt_01.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,9000.0000,71,1,0,0,0,0,0);
INSERT INTO products VALUES (171,1,1000,'SALE_ETC2','sample_t/t-shirt_02.gif',7500.0000,0,'2007-01-18 14:13:03','2007-01-18 14:13:03',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,7500.0000,71,1,0,0,0,0,0);
INSERT INTO products VALUES (172,1,1000,'NOSALE','sample_t/t-shirt_04.gif',10000.0000,0,'2007-01-18 14:13:01','2007-01-26 15:18:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,10000.0000,72,1,0,0,0,0,0);
INSERT INTO products VALUES (173,1,1000,'SALE_SPECIAL1-1','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:25:48',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,73,1,0,0,0,0,0);
INSERT INTO products VALUES (174,1,1000,'SALE_SPECIAL1-2','sample_t/t-shirt_04.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:27:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,73,1,0,0,0,0,0);
INSERT INTO products VALUES (175,1,1000,'SALE_SPECIAL1-3','sample_t/t-shirt_05.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:27:22',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,4500.0000,73,1,0,0,0,0,0);
INSERT INTO products VALUES (176,1,1000,'SALE_SPECIAL2-1','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:27:42',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,9000.0000,74,1,0,0,0,0,0);
INSERT INTO products VALUES (177,1,1000,'SALE_SPECIAL2-2','sample_t/t-shirt_04.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:27:54',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,9000.0000,74,1,0,0,0,0,0);
INSERT INTO products VALUES (178,1,1000,'SALE_SPECIAL2-3','sample_t/t-shirt_05.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:28:06',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,9000.0000,74,1,0,0,0,0,0);
INSERT INTO products VALUES (179,1,1000,'SALE_SPECIAL3-1','sample_t/t-shirt_03.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:28:29',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,75,1,0,0,0,0,0);
INSERT INTO products VALUES (180,1,1000,'SALE_SPECIAL3-2','sample_t/t-shirt_04.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:28:44',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,75,1,0,0,0,0,0);
INSERT INTO products VALUES (181,1,1000,'SALE_SPECIAL3-3','sample_t/t-shirt_05.gif',10000.0000,0,'2007-01-18 14:13:02','2007-01-19 13:28:59',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,5000.0000,75,1,0,0,0,0,0);
INSERT INTO products VALUES (182,1,1000,'DISCNTQTY6','sample_t/t-sample.gif',10000.0000,0,'2007-01-18 16:31:53','2007-01-24 15:54:28',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,60,1,0,10000.0000,45,0,0,0,0,0,0);
INSERT INTO products VALUES (183,1,1000,'MIN','',200.0000,0,'2007-01-18 17:13:22','2007-01-24 19:27:00',NULL,1,1,0,0,0,10,1,0,0,0,1,0,1,0,10,0,0,200.0000,76,1,0,0,0,0,0);
INSERT INTO products VALUES (184,1,1000,'MIN_ATR1','',200.0000,0,'2007-01-18 17:14:01','2007-01-24 19:46:56',NULL,1,1,0,0,0,10,1,0,0,0,1,0,1,0,20,0,0,200.0000,76,1,0,0,0,0,0);
INSERT INTO products VALUES (185,1,1000,'MIN_ATR2','',200.0000,0,'2007-01-18 17:19:58','2007-01-24 19:47:20',NULL,1,1,0,0,0,10,1,0,0,0,0,0,1,0,30,0,0,200.0000,76,0,0,0,0,0,0);
INSERT INTO products VALUES (187,1,1000,'LIMIT-5','',200.0000,0,'2007-01-19 01:58:18','2007-01-24 19:15:18',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,5,10,0,0,200.0000,78,1,0,0,0,0,0);
INSERT INTO products VALUES (188,1,1000,'LIMIT_ATR1','',200.0000,0,'2007-01-19 02:04:36','2007-01-24 19:22:43',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,5,50,0,0,200.0000,78,1,0,0,0,0,0);
INSERT INTO products VALUES (189,1,1000,'LIMIT_ATR2','',200.0000,0,'2007-01-19 02:13:38','2007-01-24 19:16:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,5,60,0,0,200.0000,78,0,0,0,0,0,0);
INSERT INTO products VALUES (190,1,1000,'TAXOUT','sample_t/t-sample.gif',10000.0000,0,'2007-01-23 10:39:16','2007-01-23 11:18:43',NULL,0.25,1,1,0,0,1,1,0,0,0,1,0,1,0,1,0,0,10000.0000,81,1,0,0,0,0,0);
INSERT INTO products VALUES (191,1,1000,'TAXIN','sample_t/t-sample.gif',10000.0000,0,'2007-01-23 10:41:32','2007-01-23 11:29:24',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,10000.0000,81,1,0,0,0,0,0);
INSERT INTO products VALUES (192,1,1000,'ATTR_IMAGE1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-23 11:50:48','2007-01-24 00:13:12',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,3,0,0,4000.0000,82,1,0,0,0,0,0);
INSERT INTO products VALUES (193,1,1000,'ATTR_IMAGE2','sample_t/t-shirt_02.gif',4000.0000,0,'2007-01-23 11:53:44','2007-01-24 00:15:48',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,4,0,0,4000.0000,82,1,0,0,0,0,0);
INSERT INTO products VALUES (194,1,1000,'IMAGE1','samples/IMAGE1.jpg',4000.0000,0,'2007-01-24 00:34:30','2007-01-24 01:59:35',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,1,0,0,4000.0000,82,1,0,0,0,0,0);
INSERT INTO products VALUES (195,1,1000,'IMAGE2','samples/IMAGE2.gif',4000.0000,0,'2007-01-24 00:39:27','2007-01-24 02:21:17',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,4000.0000,82,1,0,0,0,0,0);
INSERT INTO products VALUES (196,1,1000,'DISCNTQTY_ATTR1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-24 11:25:24','2007-01-25 20:01:10',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,1,0,0,4000.0000,83,1,0,0,0,0,0);
INSERT INTO products VALUES (197,1,1000,'DISCNTQTY_ATTR2','sample_t/t-shirt_01.gif',0.0000,0,'2007-01-24 15:35:08','2007-01-25 19:26:28',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,2,0,0,4000.0000,83,1,0,0,0,0,0);
INSERT INTO products VALUES (198,1,1000,'DSCNT_ONE1','sample_t/t-shirt_01.gif',0.0000,0,'2007-01-24 16:37:59','2007-01-26 03:05:02',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,1,0,0,4000.0000,85,1,0,0,0,0,0);
INSERT INTO products VALUES (199,1,1000,'DSCNT_ONE2','sample_t/t-sample.gif',4000.0000,0,'2007-01-24 17:42:19','2007-01-26 03:08:54',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,4000.0000,85,1,0,0,0,0,0);
INSERT INTO products VALUES (200,1,1000,'LIMIT-2','',200.0000,0,'2007-01-24 19:07:16','2007-01-24 19:15:29',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,1,20,0,0,200.0000,78,1,0,0,0,0,0);
INSERT INTO products VALUES (201,1,1000,'UNIT1','',200.0000,0,'2007-01-24 19:32:13','2007-01-24 19:36:47',NULL,1,1,0,0,0,100,100,0,0,0,1,0,1,0,10,0,0,200.0000,86,1,0,0,0,0,0);
INSERT INTO products VALUES (202,1,1000,'UNIT2','',200.0000,0,'2007-01-24 19:37:00','2007-01-24 19:43:47',NULL,1,1,0,0,0,2000,100,0,0,0,1,0,1,0,20,0,0,200.0000,86,1,0,0,0,0,0);
INSERT INTO products VALUES (203,1,1000,'UNIT_ATR1','',200.0000,0,'2007-01-24 19:44:59','2007-01-24 19:52:48',NULL,1,1,0,0,0,100,1,0,0,0,1,0,1,100,30,0,0,200.0000,86,1,0,0,0,0,0);
INSERT INTO products VALUES (204,1,1000,'UNIT_ATR2','',200.0000,0,'2007-01-24 19:45:15','2007-01-24 19:54:44',NULL,1,1,0,0,0,100,100,0,0,0,0,0,1,0,40,0,0,200.0000,86,0,0,0,0,0,0);
INSERT INTO products VALUES (205,1,1000,'PRCFACTOR','samples/teacup.png',20000.0000,0,'2007-01-25 12:48:10','2007-01-25 18:56:07',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,20000.0000,87,1,0,0,0,0,0);
INSERT INTO products VALUES (206,1,1000,'PRCFACTOR_OFFSET','sample_t/t-shirt_01.gif',0.0000,0,'2007-01-25 17:47:50','2007-01-26 01:32:25',NULL,0,1,0,0,0,1,1,1,0,0,1,0,1,0,20,0,0,4000.0000,87,1,0,0,0,0,0);
INSERT INTO products VALUES (209,1,1000,'BASEPRICE1','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-26 01:57:23','2007-01-26 02:57:14',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,1,0,0,4500.0000,89,1,0,0,0,0,0);
INSERT INTO products VALUES (207,1,1000,'PRCFACTOR_OFFSET_ONCE','sample_t/t-sample.gif',4000.0000,0,'2007-01-25 18:59:30','2007-01-26 17:48:08',NULL,0,1,0,0,0,1,1,1,0,0,1,0,1,0,30,0,0,4000.0000,87,1,0,0,0,0,0);
INSERT INTO products VALUES (208,1,1000,'DISCNTQTY_ATTR_ONCE','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-25 19:23:37','2007-01-25 20:01:38',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,3,0,0,4000.0000,83,1,0,0,0,0,0);
INSERT INTO products VALUES (210,1,1000,'BASEPRICE3','sample_t/t-shirt_01.gif',4000.0000,0,'2007-01-26 02:26:19','2007-01-26 02:50:02',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,3,0,0,5000.0000,89,1,0,0,0,0,0);
INSERT INTO products VALUES (211,1,1000,'BASEPRICE2','sample_t/t-shirt_02.gif',4000.0000,0,'2007-01-26 02:46:13','2007-01-26 02:59:27',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,2,0,0,4000.0000,89,1,0,0,0,0,0);
INSERT INTO products VALUES (212,2,1001,'RTBHUNTER','sooty.jpg',500.0000,0,'2007-01-26 10:54:55','2007-01-26 19:40:58',NULL,3,1,0,NULL,0,1,1,0,0,0,1,0,1,0,1,0,0,450.0000,91,1,0,0,0,0,0);
INSERT INTO products VALUES (213,2,1001,'HELP','samples/music.jpg',3500.0000,0,'2007-01-26 10:55:12','2007-02-01 18:28:20',NULL,0,1,0,NULL,0,1,1,0,0,0,1,2,1,0,2,0,0,3500.0000,91,1,0,0,0,0,0);
INSERT INTO products VALUES (214,3,0,'','samples/DOC_GENERAL.gif',0.0000,0,'2007-01-26 12:02:50','2007-01-26 17:09:58',NULL,0,1,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0.0000,93,1,0,0,0,0,0);
INSERT INTO products VALUES (215,4,1000,'DOC_PRODUCT','samples/DOC_PRODUCT.gif',2000.0000,0,'2007-01-26 12:22:09','2007-01-26 17:01:36',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,2000.0000,93,1,0,0,0,0,0);
INSERT INTO products VALUES (225,1,1001,'DOWNLOAD1','samples/download.jpg',5000.0000,0,'2007-01-26 18:38:56','2007-01-26 19:58:12',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,5000.0000,100,1,0,0,0,0,0);
INSERT INTO products VALUES (217,5,1001,'TYPE_P_FREESHIP','sample_t/t-sample.gif',4000.0000,0,'2007-01-26 14:35:30','2007-01-26 16:53:40',NULL,1,1,0,0,0,1,1,0,0,0,1,1,1,0,10,0,0,4000.0000,98,1,0,0,0,0,0);
INSERT INTO products VALUES (218,1,1000,'FREE2','sample_t/t-sample.gif',0.0000,1,'2007-01-26 15:10:08','2007-01-26 15:10:10','0000-00-00 00:00:00',2,1,0,0,0,1,1,0,1,0,0,0,1,0,30,0,0,0.0000,40,1,0,0,0,0,0);
INSERT INTO products VALUES (224,1,1000,'FREESHIP3','sample_t/t-shirt_02.gif',4000.0000,0,'2007-01-26 15:54:57','2007-01-26 16:12:01',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,3,0,0,4000.0000,79,1,0,0,0,0,0);
INSERT INTO products VALUES (223,1,1000,'FREESHIP2','sample_w/wallpaper_M01.jpg',4000.0000,1,'2007-01-26 15:39:15','2007-01-26 15:48:48',NULL,50,1,0,0,0,1,1,0,0,0,0,1,1,0,2,0,0,4000.0000,79,1,0,0,0,0,0);
INSERT INTO products VALUES (226,1,1000,'DOWNLOAD2','samples/download.jpg',5000.0000,0,'2007-01-26 19:08:15','2007-01-26 19:58:26',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,20,0,0,5000.0000,100,1,0,0,0,0,0);
INSERT INTO products VALUES (229,2,1001,'MEDIA_MIX','samples/music.jpg',3500.0000,0,'2007-02-01 18:06:43','2007-02-01 18:30:53',NULL,0,1,0,0,0,1,1,0,0,0,1,2,1,0,30,0,0,3500.0000,91,1,0,0,0,0,0);
# (Fix Illegal master_categories_id)
UPDATE products set master_categories_id = '4' WHERE products_id = '5';
UPDATE products set master_categories_id = '7' WHERE products_id = '7';
UPDATE products set master_categories_id = '8' WHERE products_id = '8';
UPDATE products set master_categories_id = '8' WHERE products_id = '10';
UPDATE products set master_categories_id = '9' WHERE products_id = '15';
UPDATE products set master_categories_id = '10' WHERE products_id = '16';
UPDATE products set master_categories_id = '8' WHERE products_id = '18';
UPDATE products set master_categories_id = '12' WHERE products_id = '19';
UPDATE products set master_categories_id = '7' WHERE products_id = '20';
UPDATE products set master_categories_id = '11' WHERE products_id = '25';
UPDATE products set master_categories_id = '12' WHERE products_id = '27';
UPDATE products set master_categories_id = '7' WHERE products_id = '28';
UPDATE products set master_categories_id = '7' WHERE products_id = '30';
UPDATE products set master_categories_id = '13' WHERE products_id = '33';
UPDATE products set master_categories_id = '13' WHERE products_id = '34';
UPDATE products set master_categories_id = '10' WHERE products_id = '36';
UPDATE products set master_categories_id = '9' WHERE products_id = '37';
UPDATE products set master_categories_id = '10' WHERE products_id = '39';
UPDATE products set master_categories_id = '9' WHERE products_id = '40';
UPDATE products set master_categories_id = '10' WHERE products_id = '41';
UPDATE products set master_categories_id = '13' WHERE products_id = '42';
UPDATE products set master_categories_id = '12' WHERE products_id = '43';
UPDATE products set master_categories_id = '13' WHERE products_id = '45';
UPDATE products set master_categories_id = '13' WHERE products_id = '46';
UPDATE products set master_categories_id = '11' WHERE products_id = '47';
UPDATE products set master_categories_id = '7' WHERE products_id = '52';
UPDATE products set master_categories_id = '12' WHERE products_id = '56';
UPDATE products set master_categories_id = '17' WHERE products_id = '59';
UPDATE products set master_categories_id = '17' WHERE products_id = '61';
UPDATE products set master_categories_id = '23' WHERE products_id = '90';
UPDATE products set master_categories_id = '23' WHERE products_id = '88';
UPDATE products set master_categories_id = '20' WHERE products_id = '70';
UPDATE products set master_categories_id = '20' WHERE products_id = '72';
UPDATE products set master_categories_id = '20' WHERE products_id = '73';
UPDATE products set master_categories_id = '20' WHERE products_id = '74';
UPDATE products set master_categories_id = '20' WHERE products_id = '75';
UPDATE products set master_categories_id = '23' WHERE products_id = '91';
UPDATE products set master_categories_id = '41' WHERE products_id = '99';
UPDATE products set master_categories_id = '63' WHERE products_id = '151';
UPDATE products set master_categories_id = '60' WHERE products_id = '139';
UPDATE products set master_categories_id = '60' WHERE products_id = '140';
UPDATE products set master_categories_id = '62' WHERE products_id = '142';
UPDATE products set master_categories_id = '62' WHERE products_id = '143';
UPDATE products set master_categories_id = '63' WHERE products_id = '144';
UPDATE products set master_categories_id = '63' WHERE products_id = '146';
UPDATE products set master_categories_id = '7' WHERE products_id = '12';
UPDATE products set master_categories_id = '8' WHERE products_id = '13';
UPDATE products set master_categories_id = '13' WHERE products_id = '22';
UPDATE products set master_categories_id = '7' WHERE products_id = '26';
UPDATE products set master_categories_id = '9' WHERE products_id = '35';
UPDATE products set master_categories_id = '12' WHERE products_id = '44';
UPDATE products set master_categories_id = '13' WHERE products_id = '49';
UPDATE products set master_categories_id = '7' WHERE products_id = '55';
UPDATE products set master_categories_id = '12' WHERE products_id = '58';
UPDATE products set master_categories_id = '12' WHERE products_id = '60';
UPDATE products set master_categories_id = '23' WHERE products_id = '89';

#
# Dumping data for table `products_attributes`
#

INSERT INTO products_attributes VALUES (1,57,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (2,57,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (3,57,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (4,57,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (5,57,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (306,59,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (305,59,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (304,59,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (303,59,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (302,59,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (311,61,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (310,61,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (309,61,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (308,61,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (307,61,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (16,7,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (17,7,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (18,7,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (19,7,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (20,7,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (21,12,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (22,12,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (23,12,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (24,12,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (25,12,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (26,20,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (27,20,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (28,20,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (29,20,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (30,20,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (31,26,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (32,26,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (33,26,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (34,26,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (35,26,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (36,28,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (37,28,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (38,28,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (39,28,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (40,28,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (41,30,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (42,30,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (43,30,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (44,30,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (45,30,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (46,52,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (47,52,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (48,52,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (49,52,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (50,52,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (51,55,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (52,55,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (53,55,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (54,55,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (55,55,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (56,16,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (57,16,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (58,16,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (59,16,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (60,16,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (61,36,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (62,36,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (63,36,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (64,36,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (65,36,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (66,39,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (67,39,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (68,39,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (69,39,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (70,39,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (71,41,2,9,0.0000,'+',210,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (72,41,2,10,0.0000,'+',220,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (73,41,2,11,0.0000,'+',230,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (74,41,2,12,0.0000,'+',240,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (75,41,2,13,0.0000,'+',250,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (77,98,3,4,500.0000,'+',110,0,0,'+',0,1,1,'attributes/color_red.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (78,98,3,5,0.0000,'+',120,0,0,'+',0,0,1,'attributes/color_yellow.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (81,112,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (80,98,3,8,0.0000,'+',140,0,0,'+',0,0,1,'attributes/color_black.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (82,112,3,8,1000.0000,'+',140,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (83,113,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (84,113,3,8,1000.0000,'+',140,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (112,141,6,17,0.0000,'+',620,1,0,'+',0,0,1,'attributes/washM40.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (110,141,6,15,0.0000,'+',600,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (107,139,5,0,0.0000,'+',0,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,5.0000,0,1);
INSERT INTO products_attributes VALUES (108,140,4,0,0.0000,'+',0,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',20.0000,2,0.0000,0,1);
INSERT INTO products_attributes VALUES (101,53,1,2,0.0000,'+',20,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (100,53,1,1,0.0000,'+',30,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (104,64,1,2,0.0000,'+',20,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (103,64,1,1,0.0000,'+',30,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (111,141,6,16,0.0000,'+',610,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (106,139,4,0,0.0000,'+',0,0,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,10.0000,5,1);
INSERT INTO products_attributes VALUES (102,53,1,3,0.0000,'+',10,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (105,64,1,3,0.0000,'+',10,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (113,141,6,18,0.0000,'+',630,1,0,'+',0,0,1,'attributes/ironM.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (115,142,7,21,0.0000,'+',700,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (116,142,7,22,0.0000,'+',710,1,0,'+',0,0,1,'',0,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (117,142,7,23,100.0000,'+',720,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (118,143,8,27,3000.0000,'+',830,1,0.1,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (119,143,8,28,3000.0000,'+',840,1,0.1,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (120,143,8,29,3000.0000,'+',850,1,0.1,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (121,143,8,30,3500.0000,'+',860,1,0.15,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (122,143,8,31,3500.0000,'+',870,1,0.15,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (123,143,8,26,4500.0000,'+',820,1,0.25,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (124,143,8,24,4000.0000,'+',800,1,0.2,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (125,143,8,25,4000.0000,'+',810,1,0.2,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (126,144,1,1,0.0000,'+',30,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (127,144,1,2,0.0000,'+',20,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (128,144,1,3,0.0000,'+',10,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (129,144,1,19,500.0000,'+',40,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (130,144,3,5,0.0000,'+',120,1,0,'+',0,1,0,'attributes/color_yellow.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (132,144,3,8,500.0000,'+',140,1,0,'+',0,0,0,'attributes/color_black.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (133,144,3,7,0.0000,'+',130,1,0,'+',0,0,0,'attributes/color_blue.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (134,144,3,14,0.0000,'+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (148,144,1,20,0.0000,'+',50,1,0,'+',1,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (163,152,1,19,500.0000,'+',40,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (164,152,3,5,0.0000,'+',120,1,0,'+',0,1,0,'attributes/color_yellow.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (165,152,3,8,500.0000,'+',140,1,0,'+',0,0,0,'attributes/color_black.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (166,152,3,7,0.0000,'+',130,1,0,'+',0,0,0,'attributes/color_blue.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (167,152,3,14,0.0000,'+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (168,152,1,20,0.0000,'+',50,1,0,'+',1,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (144,146,9,32,500.0000,'',900,1,0.1,'',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (145,146,9,33,5.0000,'',910,1,0.001,'',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (146,151,10,35,5.0000,'',1010,1,0.001,'',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (147,151,10,34,500.0000,'',1000,1,0.1,'',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (149,144,3,4,0.0000,'+',110,1,0,'+',0,0,0,'attributes/color_red.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (169,152,3,4,0.0000,'+',110,1,0,'+',0,0,0,'attributes/color_red.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (160,152,1,1,0.0000,'+',30,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (161,152,1,2,0.0000,'+',20,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (162,152,1,3,0.0000,'+',10,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (173,155,3,4,0.0000,'+',110,1,0,'+',0,1,1,'attributes/color_red.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (174,155,3,5,0.0000,'+',120,0,0,'+',0,0,1,'attributes/color_yellow.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (175,155,3,8,0.0000,'+',140,0,0,'+',0,0,1,'attributes/color_black.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (291,156,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (292,156,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (293,156,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (290,156,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (180,157,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (181,157,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (182,157,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (183,157,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (184,158,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (185,158,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (186,158,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (187,158,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (188,176,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (189,176,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (190,176,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (191,176,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (192,177,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (193,177,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (194,177,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',2000.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (195,177,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (196,178,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (197,178,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (198,178,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (199,178,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (200,159,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (201,159,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (202,159,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (203,159,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (204,160,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (205,160,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (206,160,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (207,160,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (208,161,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (209,161,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (210,161,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (211,161,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (212,162,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (213,162,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (214,162,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (215,162,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (216,163,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (217,163,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (218,163,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (219,163,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (220,164,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (221,164,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (222,164,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (223,164,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (224,170,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (225,170,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (226,170,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (227,170,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (228,171,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (229,171,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (230,171,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (231,171,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (232,173,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (233,173,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (234,173,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (235,173,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (236,174,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (237,174,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (238,174,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (239,174,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (240,175,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (241,175,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (242,175,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (243,175,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (244,179,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (245,179,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (246,179,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (247,179,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (248,180,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (249,180,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (250,180,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (251,180,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (252,181,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (253,181,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (254,181,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (255,181,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (256,172,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (257,172,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (258,172,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (259,172,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (260,165,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (261,165,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (262,165,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (263,165,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (264,166,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (265,166,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (266,166,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (267,166,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (268,167,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (269,167,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (270,167,3,4,2000.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (271,167,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (272,168,3,5,0.0000,'+',120,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (273,168,3,14,0.0000,'+',100,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (274,168,3,4,2000.0000,'+',110,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (275,168,3,7,0.0000,'+',130,1,0,'+',0,0,0,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (276,169,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (277,169,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (278,169,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (279,169,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (280,182,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (281,182,3,8,1000.0000,'+',140,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (282,184,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (283,184,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (284,184,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (285,184,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (286,185,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (287,185,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (288,185,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (289,185,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (294,188,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (295,188,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (296,188,3,4,0.0000,'+',110,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (297,188,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (298,189,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (299,189,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (300,189,3,4,0.0000,'+',110,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (301,189,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (316,88,11,37,0.0000,'+',2010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (315,88,11,36,0.0000,'+',2000,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (317,89,11,36,0.0000,'+',2000,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (318,89,11,37,0.0000,'+',2010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (319,90,11,36,0.0000,'+',2000,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (320,90,11,37,0.0000,'+',2010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (321,91,11,36,0.0000,'+',2000,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (322,91,11,37,0.0000,'+',2010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (356,193,6,15,0.0000,'+',600,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (365,198,3,14,4000.0000,'',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,-500.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (327,190,3,5,2000.0000,'+',120,1,0,'+',0,0,0,'attributes/color_yellow.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (360,192,3,38,0.0000,'+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (361,196,3,14,0.0000,'+',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'9:-0,10:-100,11:-200','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (330,190,3,14,1000.0000,'+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (353,192,3,14,0.0000,'+',100,1,0,'+',0,0,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (332,190,3,4,0.0000,'+',110,1,0,'+',0,1,0,'attributes/color_red.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (362,196,3,38,0.0000,'+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'19:-0,20:-150','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (363,197,3,14,4000.0000,'',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'9:-0,10:-100,11:-200','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (364,197,3,38,5000.0000,'',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'19:-0,20:-150','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (366,198,3,38,5000.0000,'',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,-1000.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (343,191,3,5,2000.0000,'+',120,1,0,'+',0,0,0,'attributes/color_yellow.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (344,191,3,14,1000.0000,'+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (345,191,3,4,0.0000,'+',110,1,0,'+',0,1,0,'attributes/color_red.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (357,193,6,16,0.0000,'+',610,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (358,193,6,17,0.0000,'+',620,1,0,'+',0,0,1,'attributes/washM40.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (359,193,6,18,0.0000,'+',630,1,0,'+',0,0,1,'attributes/ironM.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (367,199,12,39,600.0000,'+',2100,1,0,'+',0,1,1,'',1,10000.0000,0.0000,0.0000,0.0000,0.0000,'49:-0,50:-200,100:-300','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (368,199,12,40,700.0000,'+',2120,1,0,'+',0,0,1,'',1,20000.0000,0.0000,0.0000,0.0000,0.0000,'49:-0,50:-200,100:-300','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (369,199,12,41,800.0000,'+',2130,1,0,'+',0,0,1,'',1,30000.0000,0.0000,0.0000,0.0000,0.0000,'49:-0,50:-200,100:-300','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (370,203,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (371,203,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (372,203,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (373,203,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (374,204,3,5,0.0000,'+',120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (375,204,3,14,0.0000,'+',100,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (376,204,3,4,0.0000,'+',110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (377,204,3,7,0.0000,'+',130,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (379,205,14,45,0.0000,'+',2310,1,0,'+',0,1,1,'',1,0.0000,0.0500,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (380,205,14,46,0.0000,'+',2320,1,0,'+',0,0,1,'',1,0.0000,0.1500,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (381,205,14,44,0.0000,'+',2300,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (382,206,13,43,4000.0000,'',2210,1,0,'+',0,1,1,'',1,0.0000,100.0000,1.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (389,209,3,50,1000.0000,'+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (385,208,3,14,0.0000,'+',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','9:-0,10:-1000,11:-4000',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (386,208,3,38,0.0000,'+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','19:-0,20:-5000',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (390,209,3,49,500.0000,'+',170,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (405,207,7,21,0.0000,'+',700,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.3000,0.1000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (391,210,3,50,1000.0000,'+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (393,210,3,48,500.0000,'+',160,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',0,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (394,211,3,50,1000.0000,'+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (396,211,3,49,500.0000,'+',170,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (397,217,6,18,1000.0000,'+',630,1,10,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (398,217,3,5,2000.0000,'+',120,1,20,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (399,222,3,14,0.0000,'+',100,1,100,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (400,222,3,38,0.0000,'+',150,1,40,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (404,224,3,38,0.0000,'+',150,1,20,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (403,224,3,14,0.0000,'+',100,1,2,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (406,225,15,53,0.0000,'+',3010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (407,225,15,52,0.0000,'+',3000,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (408,226,15,53,0.0000,'+',3010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (409,226,15,52,0.0000,'+',3000,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (410,226,16,56,0.0000,'+',3120,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (411,226,16,54,0.0000,'+',3100,1,0,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (412,226,16,55,0.0000,'+',3110,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (413,213,17,57,0.0000,'+',4000,1,1,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (414,213,17,58,0.0000,'+',4010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (417,227,18,0,1000.0000,'+',0,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (420,229,17,57,0.0000,'+',4000,1,1,'+',0,1,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);
INSERT INTO products_attributes VALUES (421,229,17,58,0.0000,'+',4010,1,0,'+',0,0,1,'',1,0.0000,0.0000,0.0000,0.0000,0.0000,'','',0.0000,0,0.0000,0,0);

#
# Dumping data for table `products_attributes_download`
#

INSERT INTO products_attributes_download VALUES (315,'wallpaper_M01.jpg',7,5);
INSERT INTO products_attributes_download VALUES (316,'wallpaper_L01.jpg',7,5);
INSERT INTO products_attributes_download VALUES (317,'wallpaper_M02.jpg',7,5);
INSERT INTO products_attributes_download VALUES (318,'wallpaper_L02.jpg',7,5);
INSERT INTO products_attributes_download VALUES (319,'wallpaper_M03.jpg',7,5);
INSERT INTO products_attributes_download VALUES (320,'wallpaper_L03.jpg',7,5);
INSERT INTO products_attributes_download VALUES (321,'wallpaper_M04.jpg',7,5);
INSERT INTO products_attributes_download VALUES (322,'wallpaper_L04.jpg',7,5);
INSERT INTO products_attributes_download VALUES (406,'pdf_sample.zip',7,5);
INSERT INTO products_attributes_download VALUES (407,'ms_word_sample.zip',7,5);
INSERT INTO products_attributes_download VALUES (410,'mac-jp.zip',7,5);
INSERT INTO products_attributes_download VALUES (409,'pdf_sample.zip',7,5);
INSERT INTO products_attributes_download VALUES (408,'ms_word_sample.zip',7,5);
INSERT INTO products_attributes_download VALUES (411,'win-en.zip',7,5);
INSERT INTO products_attributes_download VALUES (412,'win-jp.zip',7,5);
INSERT INTO products_attributes_download VALUES (414,'help.mp3',7,5);

#
# Dumping data for table `products_description`
#

INSERT INTO products_description VALUES (1,1,'t-shirt_01','','',0);
INSERT INTO products_description VALUES (1,2,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (2,1,'t-shirt_02','','',0);
INSERT INTO products_description VALUES (2,2,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO products_description VALUES (3,1,'t-shirt_03','','',0);
INSERT INTO products_description VALUES (3,2,'CCロゴTシャツ','クリエイティブ・コモンズロゴのTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','http://www.creativecommons.jp/',1);
INSERT INTO products_description VALUES (4,1,'t-shirt_04','','',0);
INSERT INTO products_description VALUES (4,2,'GoogleロゴTシャツ','検索エンジン「Google」のロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.google.co.jp/',6);
INSERT INTO products_description VALUES (5,1,'t-shirt_05','','',0);
INSERT INTO products_description VALUES (5,2,'FeedアイコンTシャツ','フィードアイコンTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (6,1,'t-shirt_06','','',0);
INSERT INTO products_description VALUES (6,2,'三毛猫','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (7,1,'t-shirt_06','','',0);
INSERT INTO products_description VALUES (7,2,'三毛猫 for KIDS','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (8,1,'t-shirt_07','','',0);
INSERT INTO products_description VALUES (8,2,'三毛猫','三毛猫の写真をあしらったTシャツです。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (9,1,'t-shirt_08','','',0);
INSERT INTO products_description VALUES (9,2,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',5);
INSERT INTO products_description VALUES (10,1,'t-shirt_09','','',0);
INSERT INTO products_description VALUES (10,2,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4);
INSERT INTO products_description VALUES (11,1,'t-shirt_10','','',1);
INSERT INTO products_description VALUES (11,2,'黒猫こまる（1）','段ボール箱にもぐりこんだ子猫のこまるTシャツ。その愛くるしさに当店人気ナンバーワン商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO products_description VALUES (12,1,'t-shirt_10','','',0);
INSERT INTO products_description VALUES (12,2,'箱の中のこまる for KIDS','段ボール箱に潜り込んだ黒猫\"こまる\"Tシャツ。人気ナンバーワン商品です。<br />\r\n大人用もございます。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 \r\n豊富なカラーバリエーションで人気 No.1のTシャツです。\r\n良質な綿花で知られるメンフィスコットンを主に使用し、 \r\n水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',11);
INSERT INTO products_description VALUES (13,1,'t-shirt_11','','',0);
INSERT INTO products_description VALUES (13,2,'黒猫こまる（2）','当ショップのモデル猫\"こまる\"のTシャツ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO products_description VALUES (14,1,'t-shirt_12','','',0);
INSERT INTO products_description VALUES (14,2,'Extream Cat（モトクロス）','エクストリームキャットシリーズ。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br />豊富なカラーバリエーションで人気 No.1のTシャツです。良質な綿花で知られるメンフィスコットンを主に使用し、水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',3);
INSERT INTO products_description VALUES (15,1,'t-shirt_13','','',0);
INSERT INTO products_description VALUES (15,2,'レッドドラゴン','貴族の紋章のようなドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (16,1,'t-shirt_13','','',0);
INSERT INTO products_description VALUES (16,2,'レッドドラゴン for KIDS','貴族の紋章のようなドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (17,1,'t-shirt_14','','',0);
INSERT INTO products_description VALUES (17,2,'おねむ・・・','ねむた〜い春にこんな犬柄はいかが？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO products_description VALUES (18,1,'t-shirt_15','','',0);
INSERT INTO products_description VALUES (18,2,'Extream Cat（サーフィン）','エクストリームキャットシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO products_description VALUES (19,1,'t-shirt_16','','',0);
INSERT INTO products_description VALUES (19,2,'ラビット','子供たちにも人気の高いラビットキャラ。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (20,1,'t-shirt_16','','',0);
INSERT INTO products_description VALUES (20,2,'ラビット for KIDS','子供たちに大人気のラビットキャラ。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (21,1,'t-shirt_17','','',0);
INSERT INTO products_description VALUES (21,2,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (22,1,'t-shirt_18','','',0);
INSERT INTO products_description VALUES (22,2,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (23,1,'t-shirt_19','','',0);
INSERT INTO products_description VALUES (23,2,'アイコン（二人）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (24,1,'t-shirt_20','','',0);
INSERT INTO products_description VALUES (24,2,'アイコン（ベビー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (25,1,'t-shirt_21','','',0);
INSERT INTO products_description VALUES (25,2,'花と犬','お花に囲まれシアワ気分の犬の写真をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (26,1,'t-shirt_21','','',0);
INSERT INTO products_description VALUES (26,2,'花と犬 for KIDS','お花に囲まれシアワ気分の犬の写真をあしらいました。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (27,1,'t-shirt_22','','',0);
INSERT INTO products_description VALUES (27,2,'フラミンゴ','とぼけた表情が隠れた人気のフラミンゴ柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (28,1,'t-shirt_22','','',0);
INSERT INTO products_description VALUES (28,2,'フラミンゴ for KIDS','とぼけた表情が隠れた人気のフラミンゴ柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4);
INSERT INTO products_description VALUES (29,1,'t-shirt_23','','',0);
INSERT INTO products_description VALUES (29,2,'矢印（イエロー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (30,1,'t-shirt_23','','',0);
INSERT INTO products_description VALUES (30,2,'矢印（イエロー） for KIDS','ビビッドな色使いが印象的なアイコンシリーズ。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (31,1,'t-shirt_24','','',0);
INSERT INTO products_description VALUES (31,2,'矢印（グリーン）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (32,1,'t-shirt_25','','',0);
INSERT INTO products_description VALUES (32,2,'アイコン（ハロー）','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (33,1,'t-shirt_26','','',0);
INSERT INTO products_description VALUES (33,2,'レモンソーダ','レモンソーダのイラストがかわいいです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (34,1,'t-shirt_27','','',0);
INSERT INTO products_description VALUES (34,2,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (35,1,'t-shirt_28','','',0);
INSERT INTO products_description VALUES (35,2,'グリーンドラゴン','とぼけた表情が大人気のドラゴン柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (36,1,'t-shirt_28','','',0);
INSERT INTO products_description VALUES (36,2,'グリーンドラゴン for KIDS','とぼけた表情が大人気のドラゴン柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (37,1,'t-shirt_29','','',0);
INSERT INTO products_description VALUES (37,2,'首長竜','ドラゴンシリーズの定番柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (38,1,'t-shirt_30','','',0);
INSERT INTO products_description VALUES (38,2,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (39,1,'t-shirt_30','','',0);
INSERT INTO products_description VALUES (39,2,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (40,1,'t-shirt_31','','',0);
INSERT INTO products_description VALUES (40,2,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (41,1,'t-shirt_31','','',0);
INSERT INTO products_description VALUES (41,2,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (42,1,'t-shirt_32','','',0);
INSERT INTO products_description VALUES (42,2,'四つ葉のクローバー（2）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (43,1,'t-shirt_33','','',0);
INSERT INTO products_description VALUES (43,2,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4);
INSERT INTO products_description VALUES (44,1,'t-shirt_34','','',0);
INSERT INTO products_description VALUES (44,2,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (45,1,'t-shirt_35','','',0);
INSERT INTO products_description VALUES (45,2,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (46,1,'t-shirt_36','','',0);
INSERT INTO products_description VALUES (46,2,'カフェオレ','ホッと一息つきたい時にやさしいカフェオレ柄はいかがですか？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (47,1,'t-shirt_37','','',0);
INSERT INTO products_description VALUES (47,2,'ミニチュアダックス','ワン好きにはたまらない、人気のミニチュアダックス柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (48,1,'t-shirt_38','','',0);
INSERT INTO products_description VALUES (48,2,'レディー（1）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',3);
INSERT INTO products_description VALUES (49,1,'t-shirt_39','','',0);
INSERT INTO products_description VALUES (49,2,'レディー（2）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',0);
INSERT INTO products_description VALUES (50,1,'t-shirt_40','','',0);
INSERT INTO products_description VALUES (50,2,'コーラ','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO products_description VALUES (51,1,'t-shirt_41','','',0);
INSERT INTO products_description VALUES (51,2,'ザリガニ','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',6);
INSERT INTO products_description VALUES (52,1,'t-shirt_41','','',0);
INSERT INTO products_description VALUES (52,2,'ザリガニ for KIDS','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (53,1,'t-shirt_42','','',0);
INSERT INTO products_description VALUES (53,2,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (54,1,'t-shirt_43','','',0);
INSERT INTO products_description VALUES (54,2,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (55,1,'t-shirt_43','','',0);
INSERT INTO products_description VALUES (55,2,'ペンギン for KIDS','人気の皇帝ペンギン柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (56,1,'t-shirt_44','','',0);
INSERT INTO products_description VALUES (56,2,'ぷにぷに','正体不明の海の生き物。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (57,1,'t-shirt_44','','',0);
INSERT INTO products_description VALUES (57,2,'ぷにぷに for KIDS','正体不明の海の生き物。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',5);
INSERT INTO products_description VALUES (58,1,'t-shirt_45','','',0);
INSERT INTO products_description VALUES (58,2,'ブルーホエール','神秘的なブルーホエール（くじら）柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (59,1,'t-shirt_45','','',0);
INSERT INTO products_description VALUES (59,2,'ホエール for KIDS','神秘的なブルーホエール（くじら）柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (60,1,'t-shirt_46','','',0);
INSERT INTO products_description VALUES (60,2,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO products_description VALUES (61,1,'t-shirt_46','','',0);
INSERT INTO products_description VALUES (61,2,'オルカ（シャチ） for KIDS','当ショップ定番Tのシャチ柄<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO products_description VALUES (62,1,'t-shirt_47','','',0);
INSERT INTO products_description VALUES (62,2,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO products_description VALUES (63,1,'t-shirt_48','','',0);
INSERT INTO products_description VALUES (63,2,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO products_description VALUES (64,1,'t-shirt_49','','',0);
INSERT INTO products_description VALUES (64,2,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (65,1,'t-shirt_50','','',0);
INSERT INTO products_description VALUES (65,2,'I love T-Shirt','定番の「I love T-Shirt」ロゴ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO products_description VALUES (91,1,'wallpaper_04','','',0);
INSERT INTO products_description VALUES (90,2,'Extream Cat（カヌー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',6);
INSERT INTO products_description VALUES (90,1,'wallpaper_03','','',0);
INSERT INTO products_description VALUES (89,2,'Extream Cat（サーフィン）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',2);
INSERT INTO products_description VALUES (89,1,'wallpaper_02','','',0);
INSERT INTO products_description VALUES (88,1,'wallpaper_01','','',0);
INSERT INTO products_description VALUES (88,2,'Extream Cat（ジェットスキー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',11);
INSERT INTO products_description VALUES (70,1,'Gift Certificate $  5.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO products_description VALUES (70,2,'ギフト券　500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',1);
INSERT INTO products_description VALUES (71,1,'Gift Certificate $ 10.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO products_description VALUES (71,2,'ギフト券 1,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO products_description VALUES (72,1,'Gift Certificate $ 25.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO products_description VALUES (72,2,'ギフト券 2,500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO products_description VALUES (73,1,'Gift Certificate $ 50.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO products_description VALUES (73,2,'ギフト券 5,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',3);
INSERT INTO products_description VALUES (74,1,'Gift Certificate $100.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO products_description VALUES (74,2,'ギフト券 10,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',1);
INSERT INTO products_description VALUES (75,1,'Gift Certificates by attributes','Priced by Attributes Gift Certificates.','',0);
INSERT INTO products_description VALUES (75,2,'ギフト券（購入時に種類を選択）','ギフト券の種類（額面）をオプション属性で設定する例です','',2);
INSERT INTO products_description VALUES (76,1,'Test One','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (76,2,'サンプル01','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (77,1,'Test Two','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (77,2,'サンプル02','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (78,1,'Test Three','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (78,2,'サンプル03','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (79,1,'Test Four','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (79,2,'サンプル04','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (80,1,'Test Five','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (80,2,'サンプル05','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (81,1,'Test Eight','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (81,2,'サンプル08','この商品は、他のカテゴリにリンクしていません。','',2);
INSERT INTO products_description VALUES (82,1,'Test Ten','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (82,2,'サンプル10','この商品は、他のカテゴリにリンクしていません。','',1);
INSERT INTO products_description VALUES (83,1,'Test Six','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (83,2,'サンプル06','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (156,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は、「セール10％OFF」カテゴリ（←これがマスターカテゴリ）の他に、\r\n「セールと特価 > セール対象外カテゴリ」にもリンクされています。<br /><br />\r\n「セール対象外カテゴリ」は、セールの設定をしていないカテゴリですが、\r\nこの商品のマスターカテゴリはセール設定されたカテゴリなので、「セール対象外カテゴリ」で表示される時もセールが適用される点に注目してください。','',2);
INSERT INTO products_description VALUES (84,1,'Test Seven','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (84,2,'サンプル07','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (85,1,'Test Twelve','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (85,2,'サンプル12','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (86,1,'Test Nine','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (86,2,'サンプル09','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (87,1,'Test Eleven','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO products_description VALUES (87,2,'サンプル11','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO products_description VALUES (91,2,'Extream Cat（モトクロス）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',2);
INSERT INTO products_description VALUES (92,1,'A Free Product - All','This is a free product where there are no prices at all.  <br /><br />    The Always Free Shipping is also turned ON.  <br /><br />    If this is bought separately, the Zen Cart Free Charge payment module will show if there is no charges on shipping.  <br /><br />    If other products are purchased with a price or shipping charge, then the Zen Cart Free Charge payment module will not show and the shipping will be applied accordingly.','',0);
INSERT INTO products_description VALUES (92,2,'【例1】無料商品：定価0円、送料も無料','無料商品のサンプルです。もともとの商品価格が0円の商品で、同時に送料も無料に設定した例で、例えばデモ商品やサンプル商品請求などのケースがこれにあたるでしょう。<br /><br /><br />なお、同時購入した他の商品すべてがデモ商品であるときは送料は全く発生しませんが、他に送料がかかる商品も購入すれば、送料は通常通りかかります。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格：　0円<br /><br />・常に送料無料：　はい、常に送料無料<br />','',12);
INSERT INTO products_description VALUES (93,1,'A Free Product - SALE','This is a free product that is also on special.  <br />    This should show as having a price, special price but then be free.  <br />','',0);
INSERT INTO products_description VALUES (93,2,'【例4】無料商品：特価商品をさらに無料に。送料は有料','無料商品のサンプルです。もともとの商品価格は10000円で、さらに特価価格7500円の商品ですが、無料商品＝「はい」に設定したことにより、結果的に無料商品となります。もとの商品価格と、特価価格の両方が表示され、さらにそれらが打ち消されて無料商品と表示されます。<br /><br />商品自体は無料となりますが、この例では送料は無料とせず、通常送料がかかるよう設定しました。このケースは、サンプル商品請求時に送料だけは負担していただきたいような場合を想定しています。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品：　はい<br /><br />・商品価格： 10000円<br /><br />・特価価格： 7500円<br /><br />・常に送料無料： いいえ、通常送料を適用<br />','',10);
INSERT INTO products_description VALUES (222,1,'FREESHIP1','','',0);
INSERT INTO products_description VALUES (222,2,'【1】常に送料無料','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品として扱う例です。オプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',9);
INSERT INTO products_description VALUES (223,1,'FREESHIP2','','',0);
INSERT INTO products_description VALUES (223,2,'【2】送料無料・バーチャル商品','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品になります。さらに[ヴァーチャル商品]の設定も\"はい\"にしたので、注文手続き送付先住所の入力ステップがスキップされます。<br />\r\nオプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',4);
INSERT INTO products_description VALUES (95,1,'Free Ship & Payment Virtual weight 10','Free Shipping and Payment  <br /><br />    The Price is set to 25.00 ... but what makes it Free is that this product has been marked as:  <br />  Product is Free: Yes  <br /><br />    This would allow the product to be listed with a price, but the actual charge is $0.00  <br /><br />    The weight is set to 10 but could be set to 0. What really makes it truely Free Shipping is that it has been marked to be Always Free Shipping.  <br /><br />    Always Free shipping is set to: Yes<br />  This will not charge for shipping, but requres a shipping address.  <br /><br />    Because there is no shipping and the price is 0, the Zen Cart Free Charge comes up for the payment module and the other payment modules vanish.  <br /><br />    You can change the text on the Zen Cart Free Charge module to read as you would prefer.  <br /><br />    Note: if you add products that incur a charge or shipping charge, then the Zen Cart Free Charge payment module will vanish and the regular payment modules will show.','',0);
INSERT INTO products_description VALUES (95,2,'【例2】無料商品：定価1万円のところ価格・送料共に無料化','無料商品で、かつ送料無料の例です。<br /><br /><br />元の商品価格は10000円ですが、無料商品に設定されているため無料となります。<br />また、商品重量は10Kgありますが、送料を無料に設定していますので送料もかかりません。ただし、バーチャル商品＝いいえに設定してあるのでユーザは送付先住所の入力が必要です。<br /><br />【設定メモ】<br />・無料商品： はい<br />・商品価格：　0円<br />・ヴァーチャル商品： いいえ、送付先住所が必要<br />・常に送料無料：　はい、常に送料無料','',14);
INSERT INTO products_description VALUES (101,2,'【例3】価格お問い合せ商品（定価とセール価格表示）','この商品はセール対象商品です。商品価格（定価）と特価価格、セール価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円<br />・商品の管理＞セールの管理：　この商品マスターカテゴリに10％のセール設定してある','',9);
INSERT INTO products_description VALUES (102,1,'Normal Product','<p>This is a normal product priced at $15</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p>','',0);
INSERT INTO products_description VALUES (102,2,'【例1】○個以上買うと1個あたり○％引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛定価×（1−数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br /><br />　割引レベル　　　　最小限の有効数量　　　割引の値<br /><br />　------------------------------------------<br /><br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br /><br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br /><br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br /><br />　------------------------------------------<br /><br />','',11);
INSERT INTO products_description VALUES (103,1,'Normal Product（2）','','',0);
INSERT INTO products_description VALUES (103,2,'【例2】○個以上買うと1個あたり○円引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10〜20個で定価の1000円引き、20〜49個で1500円引き、50個以上で2000円引きというように、定価から一定額値引きされる数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（定価−定額値引き）　×　購入数となります。<br /><br />・ディスカウントタイプ：　一定金額割引<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　1000　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　1500　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　2000　（円）　<br />　------------------------------------------<br />','',8);
INSERT INTO products_description VALUES (155,1,'A Free Product with Attributes','This is a free product that is also on special.  <br /><br />    This should show as having a price, special price but then be free.  <br /><br />    Attributes can be added that can optionally be set to free or not free  <br /><br />    The Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free  <br /><br />    The Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free','',0);
INSERT INTO products_description VALUES (101,1,'A Call for Price Product SALE','This is a Call for Price product that is also on special and has a Sale price via Sale Maker.<br /><br /><br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it.<br /><br /><br /><br /><br />The Add to Cart buttons automatically change to Call for Price, which is defined as: TEXT_CALL_FOR_PRICE<br /><br /><br /><br /><br />This link will take the customer to the Contact Us page.<br /><br /><br />','',0);
INSERT INTO products_description VALUES (98,1,'A Free Product with Attributes','This is a free product that is also on special.  <br /><br />    This should show as having a price, special price but then be free.  <br /><br />    Attributes can be added that can optionally be set to free or not free  <br /><br />    The Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free  <br /><br />    The Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free','',0);
INSERT INTO products_description VALUES (98,2,'【例5】無料商品：本体無料だけどオプションは有料','商品を無料商品にしても、商品オプションの追加料金の方は有料のままにしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝いいえ」に設定されているので、商品を無料商品に設定しても\r\n属性価格には影響しません。つまり、レッドを選択すると500円、他の色を選択したときは0円となります。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円<br />\r\n・商品が無料のとき属性による価格も無料にする： いいえ','',18);
INSERT INTO products_description VALUES (155,2,'【例6】無料商品：本体無料ならオプションも無料','商品を無料商品にしたら、商品オプションの追加料金の方も無料にしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝はい」に設定されているので、商品を無料商品に設定したら\r\n属性価格も無料になります。つまり、レッドを選択しても0円です。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円　（ベース価格に500円増し）<br />\r\n・商品が無料のとき属性による価格も無料にする： はい','',3);
INSERT INTO products_description VALUES (99,1,'A Call No Price','This is a Call for Price product with no price<br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it.<br /><br />','',0);
INSERT INTO products_description VALUES (99,2,'【例1】価格お問い合せ商品（定価表示なし）','これは「価格お問い合せ商品」の例です。<br /><br />商品価格（定価）を0円に設定してあり価格表示はされません（ただし無料商品には設定されていないので無料マークはつかない）。この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： いいえ<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 0円','',5);
INSERT INTO products_description VALUES (100,1,'A Call for Price Product','This is a Call for Price product that is also on special. <br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it','',0);
INSERT INTO products_description VALUES (100,2,'【例2】価格お問い合せ商品（価格表示あり）','価格お問い合せ商品の例です<br /><br /><br />この商品には商品価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円','',9);
INSERT INTO products_description VALUES (104,1,'Normal Product(3)','','',0);
INSERT INTO products_description VALUES (104,2,'【例3】○個以上買うと1個あたり○○円','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは単価10000円、10〜20個で単価9500円、20〜49個で単価9000円、50個以上で単価8000円というように、単価が割り引き価格になるような数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝割引後価格　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引後価格<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　9500　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　9000　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　8000　（円）　<br />　------------------------------------------<br />','',8);
INSERT INTO products_description VALUES (115,1,'SEO','','',0);
INSERT INTO products_description VALUES (115,2,'商品ページへのSEO（META、title）設定例','SEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのサンプル商品に対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>〜</head>部分を確認してみてください。<br /><br />\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「この商品ページには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br /><br />\r\n\r\nNOTE：<br />\r\n・ちなみにこの機能を利用しなくても、Zen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br />\r\n・管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',15);
INSERT INTO products_description VALUES (113,1,'Normal Product(8)','','',0);
INSERT INTO products_description VALUES (113,2,'【例8】カラー混在OKで合計○個以上なら特価をさらに数量割引','サイズやカラーなどのオプション属性を持ち、さらに特価設定された商品に対して数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br />特価ベースで数量割引率が適用される点以外は、前の【例6】と同じ設定です。ふるまいがどう変わるか見比べてみてください。<br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛特価×（1−数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br />　------------------------------------------<br /><br />\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい<br /><br />\r\n\r\nNOTE：<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />','',9);
INSERT INTO products_description VALUES (112,1,'Normal Product(7)','','',0);
INSERT INTO products_description VALUES (112,2,'【例7】カラー混在OKで合計○個以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1−数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　はい<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',16);
INSERT INTO products_description VALUES (110,1,'Normal Product（4）','','',0);
INSERT INTO products_description VALUES (110,2,'【例4】○個までは特価、それ以上なら定価の○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />数が少ないうちは特価価格が適用され、一定数以上購入すると、1個あたりの価格が、定価の○％値引かれる数量割引が適用されます。つまり数量割引分は定価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、<br />　・数量割引以下の時：　購入代＝特価 × 購入数<br />　・数量割引以上の時：　購入代金＝｛定価×（1−数量割引率）｝　×　購入数で計算されます。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　定価<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',17);
INSERT INTO products_description VALUES (111,1,'Normal Product(5)','','',0);
INSERT INTO products_description VALUES (111,2,'【例5】○個までは特価、それ以上なら特価をさらに○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />一定数以上購入すると、1個あたりの価格が、特価価格からさらに○％値引かれます。つまり割引分も特価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（特価×（1−数量割引率）　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',12);
INSERT INTO products_description VALUES (116,1,'SEO2','','',0);
INSERT INTO products_description VALUES (116,2,'META、title設定していない標準の商品ページ例','これは標準の商品ページ（META設定例、title設定を明示的に設定していない）のサンプルです。<br /><br />\r\n\r\nSEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができますが、<br />\r\nこのページをみてわかるように、<br />\r\nZen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br /><br />\r\n\r\n管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',3);
INSERT INTO products_description VALUES (142,1,'ATTR_CHKBOX1','','',0);
INSERT INTO products_description VALUES (142,2,'【1】ギフトオプション','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ご贈答用やプレゼント向けのオプションとして、（1）ギフト包装、（2）メッセージカード、（3）オリジナルキーホルダー付きの3つを設定しました。<br />このうちオリジナルキーホルダー付きは有料オプション、他の2つは無料サービスとしました。なおオプション料金は特価/セールの影響をうけない設定にしています。<br /><br /><br />【設定メモ】<br />■オプション名：　ギフトオプション<br />　・オプションのタイプ：　CHECKBOX<br />■オプション属性＞価格と重量： <br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　（1）ギフト包装　　　　 　　　＋0円　　　　　　いいえ<br />　（2）メッセージカード　　　　＋0円　　　　　　いいえ<br />　（3）キーホルダー付き　＋100円　　　　　　いいえ<br />','',16);
INSERT INTO products_description VALUES (140,1,'ATTR_TEXT2','','',0);
INSERT INTO products_description VALUES (140,2,'【2】名入れオプション例（1ワードいくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />前の例同様、この例でもＴシャツへの名入れ指定として使っています。<br />前の例では1文字いくらの料金設定でしたが、ここでは1ワードいくらでカウントします（Wordでカウントするのは日本語にはなじまないやり方かもしれませんが？！）<br /><br /><br />2ワードまで無料、3ワード以上では1ワードあたり20円の追加料金でTシャツに指定の文字を入れられる設定です。<br /><br />【設定メモ】<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「入れたい文字列を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・言葉ごとの価格？：　20円<br />　・無料の言葉？：　2（ワード）<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい','',5);
INSERT INTO products_description VALUES (141,1,'ATTR_RDONLY','','',0);
INSERT INTO products_description VALUES (141,2,'表示のみオプション利用例','オプション属性の利用方法は、商品バリエーションの選択肢としての利用だけではありません。<br />商品ページに定型文を表示する用途としても利用可能です。<br />その場合は、オプションのタイプとして「READ ONLY」を使います。<br /><br />【設定メモ】<br />■オプション名：　お手入れ方法<br />　・オプションのタイプ：　READ ONLY<br />■オプション値<br />　（1）綿 100％ <br />　（2）６.1オンス<br />　（3）洗濯機（弱水流）または手荒い。水温は40℃まで。※オプション画像を登録<br />　（4）アイロンは中温（〜160℃）まで 　　※オプション画像を登録','',17);
INSERT INTO products_description VALUES (139,1,'ATTR_TEXT1','','',0);
INSERT INTO products_description VALUES (139,2,'【1】名入れオプション例（1文字いくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />この例では、Ｔシャツへの名入れ指定として使っています。<br /><br /><br />名入れエリアは最大2行、<br />　・1行目は5文字まで無料、6文字以上は一文字10円<br />　・2行目は1文字5円<br />の追加料金でTシャツに指定の文字を入れられる想定で設定しました。<br /><br />【設定メモ：商品情報】<br />\r\n・商品属性による価格：　はい<br /><br />【設定メモ】　※ 1行目名入れエリア用<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「1行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　10円<br />　・無料の文字？：　5文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />-----------------------<br />【設定メモ】　※2行目名入れエリア用<br />■オプション名：　名入れ（2）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「2行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　5円<br />　・無料の文字？：　0文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />','',7);
INSERT INTO products_description VALUES (144,1,'ATTR_DROPDOWN1','','',0);
INSERT INTO products_description VALUES (144,2,'【1】サイズ、カラー選択','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />Tシャツの販売でよく使われる例として、サイズやカラー選択を例にしました。<br />DROPDOWNやRADIOでは、複数ある選択肢の中から1つだけ選択可能です。<br /><br />選択肢によって追加料金を設定することも可能です。<br />ここではXLサイズ（DROPDOWN）とブラック（RADIO）のみ＋500円と設定しました。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',28);
INSERT INTO products_description VALUES (152,1,'ATTR_DROPDOWN2','','',0);
INSERT INTO products_description VALUES (152,2,'【2】サイズ、カラー選択（セール10％オフ適用）','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />前の例（【1】サイズ、カラー選択）とオプション設定内容は全く同じですが、<br />\r\nこの商品はセール10％引きの対象になっている点が異なります。<br /><br />\r\n\r\n選択肢によって追加料金を設定することも可能で、<br />\r\nその場合、セールが追加料金に適用されるかどうかはオプション属性の設定次第です。<br />\r\n\r\n例えばXLサイズは追加料金＋500円のところ、<br />\r\n「オプション属性にも割引を適用する＝はい」に設定しているので<br />\r\nこの追加料金に対しても10％引きが適用されることになり、<br />\r\nXLサイズ選択時の実際の追加料金は＋450円です。<br /><br />\r\n\r\nこれに対してブラック（カラー）はXLサイズと同じ追加料金＋500円ですが、<br />\r\n「オプション属性にも割引を適用する＝いいえ」に設定しているので<br />\r\n10％引きが適用されず、実際の追加料金も＋500円のままかかります。<br /><br />\r\n\r\n【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />　・オプション属性にも割引を適用する：　はい<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br />　・オプション属性にも割引を適用する：　いいえ<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',43);
INSERT INTO products_description VALUES (146,1,'ATTR_DROPDOWN3','','',0);
INSERT INTO products_description VALUES (146,2,'【3D】リボンの量り売り（DROPDOWN）','商品オプションのタイプ＝DROPDOWN（リストから選択）の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をRADIO（ラジオボタン）タイプで設定した例を掲載しています（→【3R】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',12);
INSERT INTO products_description VALUES (157,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',5);
INSERT INTO products_description VALUES (158,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例（【2】商品オプションの追加料金にもセールが適用される例）と異なり、この例ではセールが適用された時に、オプション料金にはセールが適用されない設定にしています。つまり、セール中も、通常通りのオプション料金がかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',1);
INSERT INTO products_description VALUES (143,1,'ATTR_CHKBOX2','','',0);
INSERT INTO products_description VALUES (143,2,'【2】ファミリー向けセット販売','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ファミリーでお揃いのTシャツを購入するようなケースを想定して、<br />パパ用にLサイズ、ママはSサイズ、お兄ちゃんには身長150cmサイズで妹のA子ちゃんに身長120cmサイズ・・・のようにサイズを選び、<br />セット購入できるよう設定しました。<br /><br /><br />NOTE：<br />選んだサイズごとに価格と商品重量が異なりそれらはオプション料金、オプション重量として設定しています。<br />これらは「特価商品/セールによって割引を適用する＝はい」の設定なので、<br />もしこの商品に特価設定等を行えばオプション料金の額も変化します。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　CHECKBOX<br />■オプション値：　S, M, L, 110, 120, 130, 140, 150<br />■オプション属性<br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　Sサイズ　　　　　　　　　　　 +4000円　　　　はい<br />　Mサイズ 　　　　　　　　　　　+4000円　　　　はい<br />　Lサイズ： 　　　　　　　　　　+4500円　　　　はい<br />　140、150cm：　　　　　　　 +3500円　　　　はい<br />　110、120、130cm：　　　　+3000円　　　　はい','',10);
INSERT INTO products_description VALUES (151,1,'ATTR_RADIO3','','',0);
INSERT INTO products_description VALUES (151,2,'【3R】リボンの量り売り（RADIO）','商品オプションのタイプ＝RADIO（ラジオボタン））の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をDROPDOWN（リスト選択）タイプで設定した例を掲載しています（→【3D】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',4);
INSERT INTO products_description VALUES (227,2,'【1】ロゴデータ・ファイルを添付して注文','商品オプションのタイプ＝FILEの活用サンプルです。<br /><br />\r\n\r\nFILEタイプにすると、アップロードファイルの指定欄が表示され、ユーザはファイルを添付して注文することができます。<br />\r\n\r\nこの例で扱うＴシャツは、会社やクラブのロゴをオリジナルプリントできる商品で、ロゴのデータファイルはユーザがあらかじめイラストレータなどで作成したものをアップロードして運営者に渡します。なお、オプション料金として1000円かかります。<br /><br /><br />\r\n\r\n\r\n【オプション名の設定】<br />\r\n・[オプション名]：　\"ロゴ・データ添付\"<br />\r\n・[オプションのタイプ]：　FILE<br /><br />\r\n※FILEタイプの場合は、オプション値登録は不要です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ：オプション属性】\"ロゴ・データ添付\"オプション<br />\r\n・オプション価格：+1000 円<br />','',4);
INSERT INTO products_description VALUES (227,1,'ATTR_FILE','','',0);
INSERT INTO products_description VALUES (159,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、500円引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br />','',2);
INSERT INTO products_description VALUES (160,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、10％引きのセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />\r\n・セール名：　500円OFF<br />\r\n・値引き額：　500（円）<br />\r\n・タイプ：　値引き額<br />\r\n・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong>\r\n※実際の運用においては、固定額の値引きセールをオプション料金にも適用する場合は注意が必要です。<br />\r\nこのケースでは、たまたまオプション料金（2000円）がセールの値引き額（-500円）よりも大きいために正常に500円引きが反映されていますが、特に、オプション料金よりもセールの値引き額の方が大きい場合は正しく機能しません。固定額を値引く意味をよく考えて適用を決めてください。<br /><br />','',5);
INSERT INTO products_description VALUES (161,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　セール500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',1);
INSERT INTO products_description VALUES (162,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br />','',2);
INSERT INTO products_description VALUES (163,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />\r\n・値引き額：　8000（円）<br />\r\n・タイプ：　新しい価格<br />\r\n・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong><br />\r\n実際にはレッドに対するオプション料金は割引きされません（そもそも2000円のオプション料金に新価格8000円セールを適用したら割り増し価格になってしまいます！）。<br />\r\nこのように、”新しい価格”で元値を置き換えるセール設定をオプションへも適用すること自体無意味な場合が多いため、オプションへの適用は無視される仕様になっています。<br /><br />','',6);
INSERT INTO products_description VALUES (164,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',3);
INSERT INTO products_description VALUES (165,2,'【SP1-1】特価商品の基本例（1万円を8000円に）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは新価格で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　8000円','',0);
INSERT INTO products_description VALUES (166,2,'【SP2-1】特価商品の基本例（50%引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%','',0);
INSERT INTO products_description VALUES (167,2,'【SP2-2】商品オプション料金にも特価適用（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、商品への特価適用時に、オプション料金にも特価が適用されるように設定しています。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',2);
INSERT INTO products_description VALUES (168,2,'【SP2-2】商品オプション料金は特価対象外（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0);
INSERT INTO products_description VALUES (169,2,'【SP3】期間限定で特価価格','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品は通常価格10000円のところを特価で半額にし、<br />さらに特価実施期間を設けました（半年間だけ値引きされます）<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br />・提供開始日〜終了日：　2007/1/15 〜 2007/6/15','',0);
INSERT INTO products_description VALUES (170,2,'セール期間と適用価格帯（適用されるケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円〜10000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は1万円なので、セールが適用されます。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　10000円','',1);
INSERT INTO products_description VALUES (171,2,'セール期間と適用価格帯（適用されないケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円〜10000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は7500円ですので、セールの適用対象外となります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　7500円','',2);
INSERT INTO products_description VALUES (172,2,'【4】この商品にはセールが適用されません','この商品はセールが適用されません。なぜでしょうか？<br />理由は、この商品はリンク商品で、「商品マスターカテゴリ」がセール対象外のカテゴリだからです。<br /><br /><strong>NOTE：</strong><br />複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「このカテゴリにはセール設定していない」カテゴリ<br />・商品価格：　10000円','',2);
INSERT INTO products_description VALUES (173,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br />','',2);
INSERT INTO products_description VALUES (174,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',1);
INSERT INTO products_description VALUES (175,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',2);
INSERT INTO products_description VALUES (176,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格を半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',4);
INSERT INTO products_description VALUES (177,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',5);
INSERT INTO products_description VALUES (178,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール・特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',6);
INSERT INTO products_description VALUES (179,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',2);
INSERT INTO products_description VALUES (180,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br />','',2);
INSERT INTO products_description VALUES (181,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',2);
INSERT INTO products_description VALUES (182,1,'Normal Product(6)','','',0);
INSERT INTO products_description VALUES (182,2,'【例6】1色あたり○点以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、1つのオプションに対して規定量以上購入した場合に割り引きが適用されます。<br />\r\nつまり、ホワイトとブラックを5コずつ購入しても割り引き対象にはならず、ホワイトあるいはブラック単体で10個以上購入してはじめて割引になります。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝いいえ」に設定しているからです。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1−数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　いいえ<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',7);
INSERT INTO products_description VALUES (183,1,'MIN','','',0);
INSERT INTO products_description VALUES (183,2,'【1】10個以上でご注文ください','これは、「最低10個より販売いたします」など、最小購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br />','',14);
INSERT INTO products_description VALUES (184,1,'MIN_ATR1','','',0);
INSERT INTO products_description VALUES (184,2,'【OP1】オプション問わず合計10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が最小購入数以上であれば（個々のオプション選択がなんであれ）購入可能です。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブルーを5コカゴに入れた時点で合計10コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',7);
INSERT INTO products_description VALUES (185,1,'MIN_ATR2','','',0);
INSERT INTO products_description VALUES (185,2,'【OP2】1オプションあたり10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで最小購入数に達しないと決済に進めません。<br />\r\nつまり、ホワイトとブルーを5コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で10個以上ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',4);
INSERT INTO products_description VALUES (187,1,'LIMIT-1','','',0);
INSERT INTO products_description VALUES (187,2,'【1】お一人さま5点まで！','これは、「お一人さま5点まで！」など、注文1回あたりの購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　5<br />\r\n・商品の数量単位：　1<br /><br />','',8);
INSERT INTO products_description VALUES (188,1,'LIMIT_ATR1','','',0);
INSERT INTO products_description VALUES (188,2,'【OP1】カラーを問わず全部で5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br />\r\nこの例では、オプションにかかわらず、この商品は全部で5点までしか購入できません。<br />\r\nつまり、ホワイトとイエローで計5コカゴに入っていたら、いったん精算しないかぎり追加はできません。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',17);
INSERT INTO products_description VALUES (201,2,'【1】100個単位でご注文ください','これは、「100個単位でご注文ください」のように、ユニット単位の販売を行いたい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　100　※<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\n※この例において[最小購入数]設定は必須ではないが、どのみち100個ずつ売りたいので一応設定しておく','',0);
INSERT INTO products_description VALUES (189,1,'LIMIT_ATR2','','',0);
INSERT INTO products_description VALUES (189,2,'【OP2】1オプションあたり5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br /><br />\r\nこの例では、各オプションは独立で扱われ、それぞれについて5点まで購入することができます。<br />\r\nつまり、ホワイト5コをカゴに入れたら、ホワイトはもう追加できませんが、他の色（ブルーやイエロー）なら購入可能です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',12);
INSERT INTO products_description VALUES (202,1,'UNIT2','','',0);
INSERT INTO products_description VALUES (190,1,'TAXOUT','','',0);
INSERT INTO products_description VALUES (190,2,'商品価格を税抜き（外税）で管理する例','商品価格を外税（税抜き価格）で管理する例です。<br /><br />\r\n\r\n表示価格には、管理サイト側で入力した商品価格に消費税分を上乗せしたものが表示されます。オプション料金にも同じように適用します。<br /><br />\r\nなお消費税分は、あらかじめショップ全体の設定値として設定したものが使われます（デフォルトで5％になっています）。<br /><br />\r\n\r\n・メリット：\r\n　消費税分が自動で上乗せされるので、運営側では税抜き価格で管理できる。また、消費税率が変わった時に、ショップ全体の税率設定値を変更するだけで済む。<br /><br />\r\n・デメリット： 4,980円など商売上ウケの良い価格表示にしたい場合、制御しづらい<br /><br /><br />\r\n\r\n【設定メモ】商品情報：<br />\r\n・[税種別]：　消費税<br />\r\n・[商品価格（ネット）]：10000円　（消費税分を含めない）<br /><br />\r\n\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）<br /><br />\r\n\r\n【ショップ全体の設定】　地域・税率設定＞税率設定　<br />\r\n・[消費税の税率]：　5％<br />','',9);
INSERT INTO products_description VALUES (191,1,'TAXIN-2','','',1);
INSERT INTO products_description VALUES (191,2,'商品価格を税込み（内税）で管理する例(2)','こちらは、商品価格を内税（税込み価格）で管理する例です。<br />\r\n内税の場合、2つのやり方があります（前の例と比べてみてください）。<br />\r\nこのケースでは税種別を「消費税」にしています。商品価格（グロス）の方に内税価格を入力します。<br /><br />\r\n\r\n\r\n[税種別]を消費税に指定し、商品価格（グロス）に内税価格を入力すると、商品価格（ネット）には自動計算された税抜き価格が入ります。ショップ側に表示されるのは商品価格（グロス）の方なのでつまり内税価格が表示されるというわけです。オプション価格は設定値に消費税分が上乗せされて表示されるので注意してください。<br /><br />\r\n\r\n\r\n【設定メモ】内税で管理する：<br />\r\n・[税種別]：　-- 消費税 --<br />\r\n・[商品価格（グロス）]：10000円 （税込み価格を入力する）<br /><br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）','',8);
INSERT INTO products_description VALUES (192,1,'ATTR_IMAGE1','','',0);
INSERT INTO products_description VALUES (192,2,'【OP1】画像付きオプションの例','画像付き商品オプションの例です。ここでは、2色あるカラー（商品オプション属性）のそれぞれに、画像を添えて表示しています。<br /><br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※各[オプション値]に対して<br />\r\n　・[属性の見本画像]： 画像ファイル（ここからアップロード可）<br />\r\n　・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />\r\n\r\n【参考】オプション名<br />\r\n・[オプション名]：　カラー<br />\r\n・[オプションのタイプ]：　RADIO<br />\r\n※ただし見本画像表示はタイプに依らず可能<br /><br />\r\n\r\nNOTE：<br />\r\nなお、要素（ラジオボタン）、オプション名、見本画像の配置関係は、管理メニューの商品の管理＞オプション名の管理から目的のオプション名の[編集]にて<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nの設定で変えることができます。','',19);
INSERT INTO products_description VALUES (193,1,'ATTR_IMAGE2','','',0);
INSERT INTO products_description VALUES (193,2,'【OP2】画像付きオプションの例','画像付き商品オプションの例その2です。<br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br /><br />\r\n\r\nこの例は、「素材とお手入れ方法」（READ ONLYタイプの商品オプションを使用）に関して、洗濯表示とアイロンの温度の2オプションを画像付きにしています。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※[オプション値]＝\"洗濯機〜\"、および  ”アイロンは〜” に対してそれぞれ下記の見本画像を指定する。<br />\r\n・[属性の見本画像]： ※あらかじめ用意した見本画像のファイル（ここからアップロードできる）<br />\r\n・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />','',12);
INSERT INTO products_description VALUES (194,1,'IMAGE1','','',0);
INSERT INTO products_description VALUES (194,2,'【1】複数の商品画像を掲載（自動掲載）','メインの画像の他に関連画像を何点か掲載したい場合がありますよね。<br />\r\nそんな時に最も簡単なのがこの方法で、一定のルールで画像ファイルを命名してFTPしておけば自動掲載されます。<br />\r\n→この説明文の一番下に画像が3点掲載されています！<br /><br />\r\n\r\n【ルール】<br />\r\n・2点目以降の画像ファイル名＝[メイン画像ファイル名]＋[枝番(_xx）]＋[.同じ拡張子] でつける<br />\r\n・メイン画像と同じディレクトリにアップロードする<br />\r\n・2点目以降の画像掲載順は、枝番の小さい順になる<br /><br />\r\n\r\n【例】商品情報の管理で<br />\r\n・[商品画像]が[IMAGE1.jpg] <br />\r\n・[アップロード先ディレクトリ]：　”samples”を選択<br />\r\nとした場合は、<br /><br />\r\n\r\n2点目以降の画像<br />\r\n　IMAGE1_01.jpg<br />\r\n　IMAGE1_02.jpg<br />\r\n　IMAGE1_03.jpg<br />\r\n　・・・<br />\r\nを、（ショップ設置ディレクトリ）/images/samples/　配下にFTPすればよい。<br /><br />\r\n\r\nNOTE：<br />\r\n枝番付きの画像が自動掲載されるということは、逆に言えば、ある商品Aの画像ファイル名が、たまたま別の商品Bの画像名_xxになっていたら、商品Bのページに自動掲載されてしまうということを意味します。<br /><br />\r\nこれを避けるためにも、メイン画像についても命名ルールをよく考えて決めましょう。おすすめは、商品型番と同じにしておくことです（通常商品型番は、商品ごとに固有でしょうから）。どの商品の画像かもわかりやすく一石二鳥です。','',18);
INSERT INTO products_description VALUES (195,1,'IMAGE2','','',0);
INSERT INTO products_description VALUES (195,2,'【2】複数の商品画像を掲載(紹介文中にHTML直書き）','[商品説明]欄に＜img＞タグを直書きする方法もアリです。<br /><br />\r\n\r\nこの方法は、\r\n<ul>\r\n<li>紹介文の途中に画像を埋め込め、キャプションを添えることもできるなどレイアウトの自由度が高い</li>\r\n<li>画像名がバラバラだったり、拡張子が異なる画像でも扱える</li>\r\n<li><a href=\"http://www.flickr.com/\">Flickr</a>にアップした画像や、<a href=\"http://www.youtube.com\">YouTube</a>上の動画を掲載することもできる</li>\r\n</ul>\r\nなどのメリットがあります。<br />ただし、HTMLを知らない人にとっては厳しいかもしれません。<br /><br />\r\n\r\n＜img src=\"画像のURL\" alt=\"画像の説明\" /＞を書けばその画像が表示されます。<br /><br />\r\n【例】<br />\r\n<img src=\"http://okra.ark-web.jp/~shinchi/zenc/images/samples/IMAGE2_related.jpg\" alt=\"このTシャツのモデル猫『こまる』です\" /><br />\r\nこのTシャツでも使われている、当ショップ自慢のモデル猫『こまる』です。後ろ姿もかわいいでしょ（*^o^*）b','',17);
INSERT INTO products_description VALUES (196,1,'DISCNTQTY_ATTR1','','',0);
INSERT INTO products_description VALUES (196,2,'【1】カラーで割引条件が異なる数量割引例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n数量のしきい値、割引額をオプションごとに独立して設定できます。<br /><br />\r\n\r\nこの例では、ホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br /><br />\r\n\r\n<strong>オプションの数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　1〜N0個まで： D0円引き<br />\r\n　　　N1〜N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)〜Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n意味：　〜9点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションの数値値引設定]　19:-0,20:-150<br />\r\n意味：　〜19点までは値引き0、20点以上買うと＠150円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',35);
INSERT INTO products_description VALUES (197,1,'DISCNTQTY_ATTR2','','',0);
INSERT INTO products_description VALUES (197,2,'【2】カラーで通常価格も数量割引条件も異なる例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n直前の【1】の例と異なるのは、【1】では商品価格側に基本価格分を持たせ、オプション属性では数量割引分だけを担当させていたのに対し、この例では、商品価格を0として、オプション料金側で価格をセットしている点です。<br />\r\n違いがわかるよう、ホワイトの定価（数量割引適用前オプション料金）を4000円、オレンジを5000円にしてあります。<br />\r\n\r\n数量割引額は、【1】と同じ設定になっていて、<br />\r\nホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br />\r\n\r\n各オプション属性の[オプションの数量値引設定]の書式については【1】で説明していますのでご覧ください。<br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n　意味：　〜9点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　19:-0,20:-150<br />\r\n　意味：　〜19点までは値引き0、20点以上買うと＠150円引き<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。','',13);
INSERT INTO products_description VALUES (198,1,'DSCNT_ONE1','','',0);
INSERT INTO products_description VALUES (198,2,'【OT1】ワンタイム割引例：1注文につき500円引き！','オプション属性の[ワンタイム割引]機能を使って、同一商品同一カラーを規定量以上なら「1注文あたり500円引き」を実現する例です。この割引はオプションごとの設定なので、カラーごとに割引額を変えることも可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。<br /><br /><br />','',7);
INSERT INTO products_description VALUES (199,1,'DSCNT_ONE2','','',0);
INSERT INTO products_description VALUES (199,2,'【OT2】ワンタイム割\"増\"例：1注文につき初期費用を加算','ワンタイム割引機能は、使い方次第では初期費用的な使い方もできます。<br />\r\nここで初期費用と言っているのは、「注文個数にかかわらず1回の注文あたり1度だけかかる料金」という意味です。<br /><br />\r\n\r\nかなり応用問題ですが、ワンタイム割引機能＋オプション属性の数量割引を使ったTシャツのオリジナルプリントの例をおみせしましょう。<br /><br />\r\n\r\nこの例は、無地Tシャツにロゴや社名などのオリジナルプリントを加工する、いわゆる\"チームTシャツ\"商品です。料金は以下のように決まります、\r\n<ul>\r\n<li>プリント原版代（版下代）がかかります。インクの色数だけで決まり注文数によりません。</li>\r\n<li>そのほかにTシャツ1枚あたりのプリント代（加工代）がかかります。これもインクの色数で単価が違い、さらに注文数がおおければ単価がさがります。</li>\r\n<li>もちろん、Tシャツ本体の値段が別途かかります</li>\r\n</ul>\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：　4000円　※Tシャツ本体の価格。<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n[オプション値]／[オプション価格]／[ワンタイム値引の値引金額]／[オプションの数量値引設定]　の順に<br />\r\n・プリント1色　／+ 600 ／ +10000 ／49:-0,50:-200,100:-300<br />\r\n・プリント2色　／+ 700 ／ +20000 ／49:-0,50:-200,100:-300<br />\r\n・プリント3色　／+ 800 ／ +30000 ／49:-0,50:-200,100:-300<br /><br />\r\n\r\nNOTE：<br />\r\n・[商品価格]＝無地Tシャツ代<br />\r\n・[オプション価格]＝加工代<br />\r\n・[ワンタイム値引の値引金額]＝プリント原版代<br />\r\nにあたります。<br /><br />\r\n\r\nワンタイム割引は頭に\"+\"がつけば割増（今回の例）に、\"-\"がつけば割引（【1】の例）として機能します。','',10);
INSERT INTO products_description VALUES (201,1,'UNIT1','','',0);
INSERT INTO products_description VALUES (200,1,'LIMIT-2','','',0);
INSERT INTO products_description VALUES (200,2,'【2】お一人さま1点限り！（数量入力欄非表示）','注文1回あたりの購入数を最大1個に設定すると、数量入力欄は非表示になり、1点ずつしかカートに追加できなくなります。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　1<br />\r\n・商品の数量単位：　1<br /><br />','',1);
INSERT INTO products_description VALUES (202,2,'【2】2000個以上＆100個単位でご注文ください','これは、100個単位で、かつ最低でも2000個以上からの注文だけ受けたいなどのケースを想定した例です。卸販売や大量購入を対象とした販売などで役に立つと思います。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　2000<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\nNOTE：<br />\r\nさらに[最大購入数]を設定しておくと、注文の上限を制限できる。<br />','',0);
INSERT INTO products_description VALUES (203,1,'UNIT_ATR1','','',0);
INSERT INTO products_description VALUES (203,2,'【OP1】100個単位でご注文ください（オプション混在OK）','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、オプションの組み合わせがどうあれ、最終的にこの商品合計点数が単位数量の倍数であれば購入可能です。<br />\r\nつまり、ホワイト50コカゴに入れ、続いてブルーを50コカゴに入れた時点で合計100コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',1);
INSERT INTO products_description VALUES (204,1,'UNIT_ATR2','','',0);
INSERT INTO products_description VALUES (204,2,'【OP2】1オプションあたり100個単位でご注文ください','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで単位数量の倍数でないとと決済に進めません。<br />\r\nつまり、ホワイトとブルーを50コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で100個とか200個ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',1);
INSERT INTO products_description VALUES (205,1,'PRCFACTOR','','',0);
INSERT INTO products_description VALUES (205,2,'【1】プライスファクター：ティーカップ（保証サービスあり）','プライスファクターの例です。<br />\r\nティーカップを販売します。このティーカップには、商品価格の何％かを追加で払うと購入後の一定期間、割れ・欠け時に無償交換してくれる「保証サービス」が用意されています。ここでは、この保証サービスを、プライスファクターを使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：20000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「5年保証」オプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[プライスファクター]： 0.05 　※ベース価格の5％<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n【設定メモ】「20年保証」オプション<br />\r\n・[プライスファクター]： 0.15 　※ベース価格の15％<br />\r\n・他の設定は「5年保証」オプションと同じ。<br /><br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の追加料金<br />\r\n　＝ [オプション価格] ＋  <br />\r\n　　 [ベース価格] ×（[プライスファクター]−[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグが両方とも\"はい\"なら<br />\r\n　[ベース価格] ＝ [商品価格]＋[オプション価格]<br /><br />\r\n\r\n　どちらか（あるいは両方）が\"いいえ\"なら<br /><br />\r\n　[ベース価格] ＝ [商品価格]\r\n\r\n\r\n※この例では1と2のフラグは、両方\"はい\"にしましたが、もともとオプション価格を0円としているので\r\n実際は\"はい\"でも\"いいえ\"でも同じ結果になります。<br />','',69);
INSERT INTO products_description VALUES (206,1,'PRCFACTOR_OFFSET1','','',0);
INSERT INTO products_description VALUES (206,2,'【2】プライスファクターとオフセット：パッケージ販売','前の例ではプライスファクターに1以下の値（価格の5％等）を使いましたが、今度はパッケージ販売を例にとって大きな整数値を使う例をお見せしましょう。この例ではオフセットも併せて利用します。<br /><br />\r\n\r\n業者向けにTシャツをパッケージ販売する想定です。商品名の下には内包物（Tシャツ）1枚の価格が表示されますが、実際の注文は1パック100枚入りをパッケージ数で注文してもらいます。1パックの料金はTシャツ100枚分です。<br /><br />\r\n\r\nここでは、この1パックあたりの値段をオプション料金（＝Tシャツ単価）、プライスファクター（セット枚数）とオフセット（無料サービス分）を使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：0 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「業務用パック（100枚入り）」オプション<br />\r\n・[オプション価格]： 4000円<br />\r\n・[プライスファクター]： 100 <br />\r\n・[オフセット]： 1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]  <br />\r\n　　＋ [ベース価格] ×（[プライスファクター]−[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>\r\n</ul>\r\n\r\n\r\n<strong>※オフセット値について</strong><br />\r\nこの設定例をみて、「なんでオフセットを1にするんだろう？」と思いませんでしたか？前述の「オプション選択時の追加料金」の式を注意して見て欲しいのですが、プライスファクターで100倍している他に、式の1行目でもう1点分の価格（＝[商品価格] ＋ [オプション価格]）  が加算されていますよね。このままでは101点分の料金になってしまい具合が悪いので、オフセット側で余分な1点分をキャンセルしているのです。<br />\r\n応用例として、上記例で100枚のうち5枚分の料金は無料サービスにするなら、[オフセット]＝\"6\" （キャンセル1＋無料サービス5）となります。<br /><br />\r\n\r\n<strong>NOTE： 在庫の増減について</strong><br />\r\n在庫の増減について注意して欲しいのは、この例ですと1パッケージ購入したら、在庫の減り方としては1（パッケージ）分であって、100枚分（内包物の個数）ではないということです。<br />\r\nもし在庫数を内包物ベースで管理したいのであれば、プライスファクターではなく、[商品の数量単位]を100にする方法（こうすると100単位でしか注文できない）がベターかもしれません。','',41);
INSERT INTO products_description VALUES (207,1,'PRCFACTOR_OFFSET_ONCE','','',0);
INSERT INTO products_description VALUES (207,2,'【3】ワンタイムプライスファクターとオフセット','前の例ではプライスファクターとオフセットを使ったパッケージ販売の例をお見せしました。今度は名前は似ていますが、1注文あたりにかかる料金としてワンタイムプライスファクターとオフセットについて説明します。<br /><br />\r\n\r\n通常のプライスファクター／オフセットと、ワンタイム〜の違いは、<br />\r\n　・追加分が商品単価に加算されるか（プライスファクター。N個買えばN倍かかる）、<br />\r\n　・注文1回あたりだけに加算されるか（ワンタイム〜。何個買っても追加分は1注文あたり一定額）<br />\r\nという点です。<br /><br />\r\n\r\nここでもTシャツを販売します。「ギフト包装」オプションがあって、これは個別包装ではなく（何枚買っても）1個口でラッピングするものとします。つまり1注文あたり1ラッピングということで、このオプションの追加費用として商品1個の値段の20％いただくことにしました。これをワンタイムプライスファクターで実現します。<br /><br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】ギフトオプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[ワンタイムプライスファクター]： 0.3 <br />\r\n・[ワンタイムオフセット]： 0.1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： ワンタイムプライスファクターおよびワンタイムオフセットについて</strong><br />\r\nワンタイムプライスファクター／オフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]</strong><br /><br />\r\n\r\n　この他に、1注文あたりかかる料金があって・・・<br />\r\n　<strong>オプション選択時の追加料金（1注文あたり）<br />\r\n　　 [ベース価格] ×（[ワンタイムプライスファクター]−[ワンタイムオフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>','',18);
INSERT INTO products_description VALUES (209,1,'BASEPRICE1','','',0);
INSERT INTO products_description VALUES (209,2,'【1】ベース価格＝商品価格＋オプション価格','ベース価格、商品価格、オプション価格の関係を理解する（1）<br /><br />\r\n\r\nベース価格は、オプションごとの数量割引や、プライスファクターを適用する際の基準額として使われます。<br /><br />\r\n\r\nベース価格は、\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nの2フラグの状態が影響します。関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>−</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\nここでは、どちらのフラグも\"はい\"の例を提示します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、ベース価格の最小値が表示されます。ホワイトのベース価格の方がオレンジより小さいので、ホワイトの値が表示されているわけです。','',11);
INSERT INTO products_description VALUES (208,1,'DISCNTQTY_ATTR_ONCE','','',0);
INSERT INTO products_description VALUES (208,2,'【3】カラーで割引条件が異なるワンタイム数量割引例','[オプションのワンタイム数量値引設定]を使う例です。<br />\r\n前の2例で扱った[オプションの数量値引設定]が単価に作用する値引きだったのに対して、ここで扱う[オプションのワンタイム数量値引設定]は、1回の注文あたりにかかる値引きである点が異なります。<br /><br />\r\n\r\nつまり、<br />\r\n商品価格が1000円、10個以上買ったら100円引きしたいときに<br />\r\n\r\n[オプションの数量値引設定] で設定した場合：<br />\r\n　　購入価格[10個分]＝（1000円 − 100円）×10個 ＝9000円<br />\r\n　　※単価が900円になる。<br /><br />\r\n　\r\nですが、同じことを<br />\r\n[オプションのワンタイム数量値引設定]で設定した場合：<br />\r\n　　購入価格[10個分]＝ （1000円 × 10個）−100円 ＝ 9900円<br />\r\n　　※単価は変化せず、合計から100円引かれる<br /><br />\r\n\r\nという結果になります。<br />\r\nなお、数量のしきい値、割引額をオプションごとに独立して設定できる点などは同じです。<br /><br /><br />\r\n\r\n<strong>オプションのワンタイム数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　1〜N0個まで： D0円引き<br />\r\n　　　N1〜N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)〜Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションのワンタイム数量値引設定]　9:-0,10:-1000,11:-4000<br />\r\n意味：　〜9点までは値引き0、10点なら合計から1000円引き、11点以上では4000円を合計から引く<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションのワンタイム数量値引設定]　19:-0,20:-5000<br />\r\n意味：　〜19点までは値引き0、20点以上買うと合計から5000円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',11);
INSERT INTO products_description VALUES (210,1,'BASEPRICE3','','',0);
INSERT INTO products_description VALUES (210,2,'【3】ベース価格に含める/ない 混在','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\n【1】や【2】の例とほぼ同じ設定ですが、<br />\r\n\"ホワイト\"の方は、[属性による価格増減をベース価格に含める]フラグ＝\"いいえ\"に、<br />\r\n一方\"オレンジ\"はフラグ＝\"はい\"のようにオプションによって混在している例です。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：いいえ<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、通常ベース価格の最小値が表示されます。しかし、ホワイトは[属性による価格増減をベース価格に含める]フラグが\"いいえ\"なので対象からはずれて、オレンジのベース価格が表示されます。','',9);
INSERT INTO products_description VALUES (211,1,'BASEPRICE2','','',0);
INSERT INTO products_description VALUES (211,2,'【2】ベース価格にオプション価格を含めない','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\nすぐ直前の【1】とほぼ同じ設定ですが、<br />\r\nおおもとの[商品属性による価格]フラグが\"いいえ\"なので<br />\r\n\"ホワイト\"\"オレンジ\"オプションともに[ベース価格]には[オプション料金]を含みません。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）やベース価格（オプションごと数量割引などの基本額）に含まれないだけで、そのオプション選択時の追加料金としては機能します。','',3);
INSERT INTO products_description VALUES (212,1,'Russ Tippins Band - The Hunter','The Product Music Type is specially designed for music media. This can offer a lot more flexibility than the Product','',0);
INSERT INTO products_description VALUES (212,2,'Russ Tippins Band - The Hunter','「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',9);
INSERT INTO products_description VALUES (213,1,'Help!','','',0);
INSERT INTO products_description VALUES (213,2,'Help!','この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',21);
INSERT INTO products_description VALUES (214,1,'DOC_GENERAL','Document General Type is used for Products that are actually Documents. These cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.','',0);
INSERT INTO products_description VALUES (214,2,'一般ドキュメント（非売品）の例','これは製品タイプを[Document - General]で登録したドキュメントで、今読んでいるこれは[ドキュメントの内容]そのものです。<br /><br />\r\n\r\n[Document - General]に指定されたドキュメントは、カートに入れられません。また、販売商品ではないので、[\r\n商品型番]もありません。<br /><br />\r\n\r\nそのかわりに、「書類」と名付けられた特別なサイドボックスに掲載されます。この商品タイプは、文字通りドキュメントとして、このサイトのオンラインマニュアルやFAQとして使うなどの用途が考えられます。<br /><br />\r\n\r\n■■■■■\r\n\r\n<p>WWW(World Wide Web)は, スイスのCERN(欧州素粒子物理研究所)において, 所内の研究者間の研究成果の共有を支援することを目的として, 1990年に分散形広域ハイパテキストシステムの構築のためのプロジェクトによって設立された。このハイパテキストでは, テキスト又はテキストの集合を分割してノードという単位に分け, ノード内にアンカ(端点)を定義して, アンカ間の関係としてハイパリンクを規定している。</p> \r\n\r\n<p>WWWのプロジェクトができた当初は, CERNにおいて特定マシン上のラインモードブラウザが用意されただけであったが, 1991年にはCERN以外でもWWWの利用が可能になり, Xウィンドウシステム用のブラウザが開発された。1993年になると, イリノイ大学でMOSAICが発表されて文書中の画像表示が可能になり, Windows版に加えてMAC版も発表された。1994年のNetscape Navigatorのリリースは, WWWの爆発的普及のきっかけをつくり, それがさらにインタネット利用者を増やすことになった。 </p>\r\n\r\n<p>CERNでのハイパテキストの構造記述及びその交換手続きは, 開発当初は研究所内の仕様にとどまっていたが, WWWの普及と共にそれらの標準化への意識が高まり, IETF(Internet Engineering Task Force)において, HTML及びHTTP(Hypertext Transfer Protocol)の作業グループが設立されて本格的な標準化作業が開始された。HTML 2.0は, IETF RFC1866[1]として公表され, その後, HTMLの標準化作業は, W3C(World Wide Web Consortium)に移された。 </p>\r\n\r\n<p>W3Cでの初期のHTML改版作業は, ブラウザメーカの独自の拡張を吸収してスタイル指定を含む多くの機能を盛り込む方針で行われた。しかしその後, HTMLを本来の文書論理構造記述の言語に引き戻して, スタイル指定については別の交換様式で対応するという方針が主流となり, HTML 3.2[2], HTML 4.0[3]へと改版されてきた。</p>','',9);
INSERT INTO products_description VALUES (215,1,'Document - Product type','','',0);
INSERT INTO products_description VALUES (215,2,'商品ドキュメント（販売商品）の例','これは商品として販売するドキュメントで、商品タイプは[Document - Product]です。<br /><br />\r\n\r\n商品タイプが[Document - General]だった直前の例と異なり、ここにはカゴへ入れるボタンが表示されています。<br />\r\n\r\n商品ドキュメント（販売商品）タイプでは、商品情報の入力項目などは一般商品とかわりありません。しかし、「書類」という特別なサイドボックスに表示されるなど、ドキュメントとして特別扱いされます。','',4);
INSERT INTO products_description VALUES (225,1,'Single Download','','',0);
INSERT INTO products_description VALUES (225,2,'ダウンロード商品例（1ファイル）','これはファイルが1つだけの場合のダウンロード例です。<br />\r\nオプションで選んだファイル形式のファイル1点をダウンロード可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"マニュアル\"<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',4);
INSERT INTO products_description VALUES (217,1,'Sample of Product Free Shipping Type','<p>Product Free Shipping can be setup to highlight the Free Shipping aspect of the product. <br /><br />These pages include a Free Shipping Image on them. <br /><br />You can define the ALWAYS_FREE_SHIPPING_ICON in the language file. This can be Text, Image, Text/Image Combo or nothing. <br /><br />The weight does not matter on Always Free Shipping if you set Always Free Shipping to Yes. <br /><br />Be sure to have the Free Shipping Module Turned on! Otherwise, if this is the only product in the cart, it will not be able to be shipped. <br /><br />Notice that this is defined with a weight of 5lbs. But because of the Always Free Shipping being set to Y there will be no shipping charges for this product. <br /><br />You do not have to use the Product Free Shipping product type just to use Always Free Shipping. But the reason you may want to do this is so that the layout of the Product Free Shipping product info page can be layout specifically for the Free Shipping aspect of the product. <br /><br />This includes a READONLY attribute for Option Name: Shipping and Option Value: Free Shipping Included. READONLY attributes do not show on the options for the order.</p>','',0);
INSERT INTO products_description VALUES (217,2,'送料無料タイプ商品の例','ここでは、商品タイプあるいはカテゴリを[Product - Free Shipping]タイプにした場合のふるまいを説明します。<br /><br />\r\n\r\nこの商品の所属するカテゴリは、[Product - Free Shipping]商品タイプ（以下、送料無料タイプ）限定に設定されています。このカテゴリ配下で新しい商品を登録すると、送料無料タイプの商品として登録されます。<br /><br />\r\n\r\n送料無料タイプの商品は、機能的には一般の商品とかわりませんが、あらかじめ[常に送料無料]フラグが\"はい\"に設定されています。<br /><br /><br />\r\n\r\n送料無料の商品には「送料無料！」マークがついてハイライト表示されます。<br /><br />\r\n\r\n[常に送料無料]フラグが\"はい\"なら、商品重量に関係なく、常に送料無料となります。<br /><br />\r\nなお、配送モジュールの「配送料無料」モジュールを有効にしておくこと。さもないと、カートに入れた送料無料商品の精算ができなくなってしまいます。<br /><br />\r\n\r\nNOTE:<br />\r\n送料無料になるかどうかの判定基準は5lbs（約2Kg強）です。しかし[常に送料無料]フラグが\"はい\"になっていると、そのしきい値にかかわらず送料は無料です。<br /><br />\r\n\r\nNOTE：<br />\r\nLanguage file中の、[ALWAYS_FREE_SHIPPING_ICON] 変数を変更することで、送料無料の時のふるまい（テキストを表示する／イメージ画像を表示／テキストと画像の組み合わせを表示／なにも表示しない）を制御できます。<br /><br />','',7);
INSERT INTO products_description VALUES (218,1,'Free Ship & Payment Virtual','Product Price is set to 0  <br /><br />    Payment weight is set to 2 ...  <br /><br />    Virtual is ON ... this will skip shipping address  <br /><br />','',0);
INSERT INTO products_description VALUES (218,2,'【例3】無料商品：送料無料かつ送付先住所入力不要','商品価格が0円（無料商品）で、商品重量は2Kgの商品ですが、バーチャル商品扱いに設定したため、送料無料でお届け先の住所入力をスキップします。<br />これは一見不自然な設定に見えますが、例えばお届け先をユーザ登録住所に限定したい（他の住所は指定できない）場合などの利用が考えられます。<br />なお、同時購入した他の商品すべてがデモ商品であるとき、送料は全く発生しません。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格： 0円<br /><br />・・バーチャル商品：　はい、送付先住所をスキップ<br /><br />・常に送料無料：　いいえ、通常送料を適用<br />','',1);
INSERT INTO products_description VALUES (224,1,'FREESHIP3','','',0);
INSERT INTO products_description VALUES (224,2,'【3】送料無料（重量＝０Kgの商品）','【3】送料無料（重量が0Kgの商品）\r\nこれまでの2例では、[常に送料無料]フラグが\"はい\"に設定することにより常時送料無料商品として取り扱われる例を見てきました。<br /><br />\r\nこれに対して、ここでは重量が0である結果として送料が無料になる例を提示します。<br /><br />\r\n\r\nここでの商品重量は0です。またオプションカラー\"ホワイト\"の追加重量も0ですので、ホワイト購入時は送料が無料になります。\r\n※ただしカゴの中に他の送料有料商品が入っていないこと）\r\n\r\n一方\"オレンジ\"のオプション重量は20Kgあります。従って、オレンジ選択時は送料は無料になりません。\r\n\r\n【設定メモ】商品情報\r\n・[常に送料無料]：いいえ、通常送料を適用\r\n・[商品重量]：0（Kg）\r\n\r\n【設定メモ】商品オプション属性\r\n・\"ホワイト\"の[重量]：0（Kg）\r\n・\"オレンジ\"の[重量]：20（Kg）','',6);
INSERT INTO products_description VALUES (226,1,'Multiple Download','<p>This product is set up to have multiple downloads.</p><p>The Product Price is $49.99</p><p>The attributes are setup with two Option Names, one for each download to allow for two downloads at the same time.</p><p>The first Download is listed under:</p><p>Option Name: Version<br />Option Value: Download Windows - English<br />Option Value: Download Windows - Spanish<br />Option Value: DownloadMAC - English<br /></p><p>The second Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value:MS Word- English</p>','',0);
INSERT INTO products_description VALUES (226,2,'ダウンロード商品例（複数ファイル）','これは複数ファイル一括ダウンロード商品の例です。<br /><br />\r\nここではソフト本体とそのマニュアルをセットでダウンロード販売する想定です。本体とマニュアルそれぞれのファイル形式を選んで（商品オプション）注文すると、2ファイルが同時にダウンロード可能になります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】<br />\r\n■オプション名：\"ソフト本体\"に関し<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"Windows(en)版\": win-en.zip<br />\r\n　-\"Windows(jp)版\": win-jp.zip<br />\r\n　-\"Mac(jp)版\"：mac-jp.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n■オプション名：\"マニュアル\"に関して<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',3);
INSERT INTO products_description VALUES (229,1,'CD and download file(mp3)','','',0);
INSERT INTO products_description VALUES (229,2,'ダウンロード商品とリアル商品の混在（CDとmp3ファイル）','ここまでの2例がダウンロード商品のみで構成されていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）が混在した販売例です。ユーザは購入時に好みの媒体を選んでカゴに入れます。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\nこの商品の商品タイプは「Product - Music」です。「Product - Music」タイプは音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',2);
INSERT INTO products_description VALUES (156,1,'SALE10%OFF-1','','',0);
INSERT INTO products_description VALUES (157,1,'SALE10%OFF-2','','',0);
INSERT INTO products_description VALUES (158,1,'SALE10%OFF-3','','',0);
INSERT INTO products_description VALUES (159,1,'SALE500yenOFF-1','','',0);
INSERT INTO products_description VALUES (160,1,'SALE500yenOFF-2','','',0);
INSERT INTO products_description VALUES (161,1,'SALE500yenOFF-3','','',0);
INSERT INTO products_description VALUES (162,1,'SALE set8000yen-1','','',0);
INSERT INTO products_description VALUES (163,1,'SALE set8000yen-2','','',0);
INSERT INTO products_description VALUES (164,1,'SALE set8000yen-3','','',0);
INSERT INTO products_description VALUES (165,1,'SPECIAL1-1','','',0);
INSERT INTO products_description VALUES (166,1,'SPECIAL2-1','','',0);
INSERT INTO products_description VALUES (167,1,'SPECIAL2-2','','',0);
INSERT INTO products_description VALUES (168,1,'SPECIAL2-3','','',0);
INSERT INTO products_description VALUES (169,1,'SPECIAL3','','',0);
INSERT INTO products_description VALUES (170,1,'SALE_ETC1','','',0);
INSERT INTO products_description VALUES (171,1,'SALE_ETC2','','',0);
INSERT INTO products_description VALUES (172,1,'NOSALE','','',0);
INSERT INTO products_description VALUES (173,1,'SALE_SPECIAL1-1','','',0);
INSERT INTO products_description VALUES (174,1,'SALE_SPECIAL1-2','','',0);
INSERT INTO products_description VALUES (175,1,'SALE_SPECIAL1-3','','',0);
INSERT INTO products_description VALUES (176,1,'SALE_SPECIAL2-1','','',0);
INSERT INTO products_description VALUES (177,1,'SALE_SPECIAL2-2','','',0);
INSERT INTO products_description VALUES (178,1,'SALE_SPECIAL2-3','','',0);
INSERT INTO products_description VALUES (179,1,'SALE_SPECIAL3-1','','',0);
INSERT INTO products_description VALUES (180,1,'SALE_SPECIAL3-2','','',0);
INSERT INTO products_description VALUES (181,1,'SALE_SPECIAL3-3','','',0);

#
# Dumping data for table `products_discount_quantity`
#

INSERT INTO products_discount_quantity VALUES (2,182,20,20.0000);
INSERT INTO products_discount_quantity VALUES (1,182,10,10.0000);
INSERT INTO products_discount_quantity VALUES (3,102,50,25.0000);
INSERT INTO products_discount_quantity VALUES (2,102,20,20.0000);
INSERT INTO products_discount_quantity VALUES (1,102,10,10.0000);
INSERT INTO products_discount_quantity VALUES (3,103,50,2000.0000);
INSERT INTO products_discount_quantity VALUES (2,103,20,1500.0000);
INSERT INTO products_discount_quantity VALUES (1,103,10,1000.0000);
INSERT INTO products_discount_quantity VALUES (3,104,50,8000.0000);
INSERT INTO products_discount_quantity VALUES (2,104,20,9000.0000);
INSERT INTO products_discount_quantity VALUES (1,104,10,9500.0000);
INSERT INTO products_discount_quantity VALUES (3,110,50,25.0000);
INSERT INTO products_discount_quantity VALUES (2,110,20,20.0000);
INSERT INTO products_discount_quantity VALUES (1,110,10,10.0000);
INSERT INTO products_discount_quantity VALUES (1,111,10,10.0000);
INSERT INTO products_discount_quantity VALUES (2,111,20,20.0000);
INSERT INTO products_discount_quantity VALUES (3,111,50,25.0000);
INSERT INTO products_discount_quantity VALUES (3,112,50,25.0000);
INSERT INTO products_discount_quantity VALUES (2,112,20,20.0000);
INSERT INTO products_discount_quantity VALUES (1,112,10,10.0000);
INSERT INTO products_discount_quantity VALUES (3,113,50,25.0000);
INSERT INTO products_discount_quantity VALUES (2,113,20,20.0000);
INSERT INTO products_discount_quantity VALUES (1,113,10,10.0000);
INSERT INTO products_discount_quantity VALUES (3,182,50,25.0000);

#
# Dumping data for table `products_options`
#

INSERT INTO products_options VALUES (1,1,'size',1,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (1,2,'サイズ',1,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (2,1,'size for kids',2,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (2,2,'サイズ（キッズ）',2,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (3,1,'color',100,2,32,'',32,0,0,0);
INSERT INTO products_options VALUES (3,2,'カラー',100,2,32,'カラーを選択してください',32,5,5,0);
INSERT INTO products_options VALUES (4,1,'Line1',500,1,80,'Enter your text up to 80 characters, punctuation and spaces.',60,5,0,1);
INSERT INTO products_options VALUES (4,2,'名入れ（1）',500,1,80,'1行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1);
INSERT INTO products_options VALUES (5,1,'Line2',510,1,80,'Enter your text up to 80 characters, punctuation and spaces.',60,5,0,1);
INSERT INTO products_options VALUES (5,2,'名入れ（2）',510,1,80,'2行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1);
INSERT INTO products_options VALUES (6,1,'How to care, materials',600,5,32,'',32,0,0,0);
INSERT INTO products_options VALUES (6,2,'素材とお手入れ方法',600,5,32,'',32,5,0,0);
INSERT INTO products_options VALUES (7,1,'Gift',700,3,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (7,2,'ギフトオプション',700,3,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (8,1,'Size(for chckbox)',800,3,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (8,2,'サイズ（大人・キッズ）',800,3,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (9,1,'',0,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (9,2,'購入単位',900,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (10,1,'',0,2,32,'',32,0,0,0);
INSERT INTO products_options VALUES (10,2,'購入単位(radio)',1000,2,32,'',32,0,0,0);
INSERT INTO products_options VALUES (11,1,'wallpaper-size',2000,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (11,2,'壁紙サイズ',2000,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (12,1,'print',2100,2,32,'',32,0,0,0);
INSERT INTO products_options VALUES (12,2,'オリジナルプリント',2100,2,32,'',32,0,0,0);
INSERT INTO products_options VALUES (13,1,'Package',2200,2,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (13,2,'パッケージ',2200,2,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (14,1,'guarantee',2300,2,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (14,2,'保証サービス',2300,2,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (15,1,'File Type(1)',3000,0,32,'',32,0,0,0);
INSERT INTO products_options VALUES (15,2,'マニュアル',3000,0,32,'',32,0,0,0);
INSERT INTO products_options VALUES (16,1,'File Type(2)',3100,0,32,'',32,0,0,0);
INSERT INTO products_options VALUES (16,2,'ソフト本体',3100,0,32,'',32,0,0,0);
INSERT INTO products_options VALUES (17,1,'Media Type',4000,0,32,'',32,0,0,0);
INSERT INTO products_options VALUES (17,2,'メディアタイプ',4000,0,32,'',32,0,0,0);
INSERT INTO products_options VALUES (18,1,'Attach file',5000,4,32,'',32,0,0,0);
INSERT INTO products_options VALUES (18,2,'ロゴ・データ添付',5000,4,32,'',32,0,0,0);
INSERT INTO products_options VALUES (19,1,'test',0,0,32,NULL,32,0,0,0);
INSERT INTO products_options VALUES (19,2,'テスト',0,0,32,NULL,32,0,0,0);

#
# Dumping data for table `products_options_values`
#

INSERT INTO products_options_values VALUES (1,1,'Large',30);
INSERT INTO products_options_values VALUES (1,2,'Ｌサイズ',30);
INSERT INTO products_options_values VALUES (2,1,'Midium',20);
INSERT INTO products_options_values VALUES (2,2,'Ｍサイズ',20);
INSERT INTO products_options_values VALUES (3,1,'Small',10);
INSERT INTO products_options_values VALUES (3,2,'Ｓサイズ',10);
INSERT INTO products_options_values VALUES (4,1,'red',110);
INSERT INTO products_options_values VALUES (4,2,'レッド',110);
INSERT INTO products_options_values VALUES (5,1,'yellow',120);
INSERT INTO products_options_values VALUES (5,2,'イエロー',120);
INSERT INTO products_options_values VALUES (15,1,'COTTON 100％',600);
INSERT INTO products_options_values VALUES (7,1,'blue',130);
INSERT INTO products_options_values VALUES (7,2,'ブルー',130);
INSERT INTO products_options_values VALUES (8,1,'blank',140);
INSERT INTO products_options_values VALUES (8,2,'ブラック',140);
INSERT INTO products_options_values VALUES (9,1,'',210);
INSERT INTO products_options_values VALUES (9,2,'110cm',210);
INSERT INTO products_options_values VALUES (10,1,'',220);
INSERT INTO products_options_values VALUES (10,2,'120cm',220);
INSERT INTO products_options_values VALUES (11,1,'',230);
INSERT INTO products_options_values VALUES (11,2,'130cm',230);
INSERT INTO products_options_values VALUES (12,1,'140cm',240);
INSERT INTO products_options_values VALUES (12,2,'140cm',240);
INSERT INTO products_options_values VALUES (13,1,'150cm',250);
INSERT INTO products_options_values VALUES (13,2,'150cm',250);
INSERT INTO products_options_values VALUES (14,1,'white',100);
INSERT INTO products_options_values VALUES (14,2,'ホワイト',100);
INSERT INTO products_options_values VALUES (15,2,'綿 100％',600);
INSERT INTO products_options_values VALUES (16,1,'',610);
INSERT INTO products_options_values VALUES (16,2,'６.1オンス',610);
INSERT INTO products_options_values VALUES (17,1,'',620);
INSERT INTO products_options_values VALUES (17,2,'洗濯機（弱水流）または手洗い',620);
INSERT INTO products_options_values VALUES (18,1,'',630);
INSERT INTO products_options_values VALUES (18,2,'アイロンは中温（〜160℃）まで',630);
INSERT INTO products_options_values VALUES (19,1,'X-Large',40);
INSERT INTO products_options_values VALUES (19,2,'XLサイズ',40);
INSERT INTO products_options_values VALUES (20,1,'Select one...',50);
INSERT INTO products_options_values VALUES (20,2,'ご選択ください・・・',50);
INSERT INTO products_options_values VALUES (21,1,'Wrapping',700);
INSERT INTO products_options_values VALUES (21,2,'ギフト包装',700);
INSERT INTO products_options_values VALUES (22,1,'Message Card',710);
INSERT INTO products_options_values VALUES (22,2,'メッセージカード',710);
INSERT INTO products_options_values VALUES (23,1,'Prezent Keyholder',720);
INSERT INTO products_options_values VALUES (23,2,'オリジナルキーホルダー',720);
INSERT INTO products_options_values VALUES (24,1,'S',800);
INSERT INTO products_options_values VALUES (24,2,'Ｓサイズ',800);
INSERT INTO products_options_values VALUES (25,1,'M',810);
INSERT INTO products_options_values VALUES (25,2,'Ｍサイズ',810);
INSERT INTO products_options_values VALUES (26,1,'L',820);
INSERT INTO products_options_values VALUES (26,2,'Ｌサイズ',820);
INSERT INTO products_options_values VALUES (27,1,'110cm',830);
INSERT INTO products_options_values VALUES (27,2,'110cm',830);
INSERT INTO products_options_values VALUES (28,1,'120cm',840);
INSERT INTO products_options_values VALUES (28,2,'120cm',840);
INSERT INTO products_options_values VALUES (29,1,'130cm',850);
INSERT INTO products_options_values VALUES (29,2,'130cm',850);
INSERT INTO products_options_values VALUES (30,1,'140cm',860);
INSERT INTO products_options_values VALUES (30,2,'140cm',860);
INSERT INTO products_options_values VALUES (31,1,'150cm',870);
INSERT INTO products_options_values VALUES (31,2,'150cm',870);
INSERT INTO products_options_values VALUES (32,1,'m',900);
INSERT INTO products_options_values VALUES (32,2,'メートル（m）',900);
INSERT INTO products_options_values VALUES (33,1,'cm',910);
INSERT INTO products_options_values VALUES (33,2,'センチメートル（cm）',910);
INSERT INTO products_options_values VALUES (34,1,'m',1000);
INSERT INTO products_options_values VALUES (34,2,'メートル（m）',1000);
INSERT INTO products_options_values VALUES (35,1,'cm',1010);
INSERT INTO products_options_values VALUES (35,2,'センチメートル（cm）',1010);
INSERT INTO products_options_values VALUES (36,1,'midium',2000);
INSERT INTO products_options_values VALUES (36,2,'幅500px',2000);
INSERT INTO products_options_values VALUES (37,1,'Large',2010);
INSERT INTO products_options_values VALUES (37,2,'幅1024px',2010);
INSERT INTO products_options_values VALUES (38,1,'orange',150);
INSERT INTO products_options_values VALUES (38,2,'オレンジ',150);
INSERT INTO products_options_values VALUES (39,1,'print1',2100);
INSERT INTO products_options_values VALUES (39,2,'プリント1色',2100);
INSERT INTO products_options_values VALUES (40,1,'print2',2120);
INSERT INTO products_options_values VALUES (40,2,'プリント2色',2120);
INSERT INTO products_options_values VALUES (41,1,'',2130);
INSERT INTO products_options_values VALUES (41,2,'プリント3色',2130);
INSERT INTO products_options_values VALUES (42,1,'package5',2200);
INSERT INTO products_options_values VALUES (42,2,'お試しパック（5枚入り）',2200);
INSERT INTO products_options_values VALUES (43,1,'package100',2210);
INSERT INTO products_options_values VALUES (43,2,'業務用パック（100枚入り）',2210);
INSERT INTO products_options_values VALUES (44,1,'none',2300);
INSERT INTO products_options_values VALUES (44,2,'なし',2300);
INSERT INTO products_options_values VALUES (45,1,'5 years',2310);
INSERT INTO products_options_values VALUES (45,2,'5年保証（保証料は商品の5％分）',2310);
INSERT INTO products_options_values VALUES (46,1,'20 years',2320);
INSERT INTO products_options_values VALUES (46,2,'20年保証（保証料は商品の15％分）',2320);
INSERT INTO products_options_values VALUES (47,2,'初期費用（表示価格の20％）込み',2140);
INSERT INTO products_options_values VALUES (47,1,'initial cost 20%',2140);
INSERT INTO products_options_values VALUES (48,1,'white(NOT add to base price)',160);
INSERT INTO products_options_values VALUES (48,2,'ホワイト（ベース価格に含めない）',160);
INSERT INTO products_options_values VALUES (49,1,'white (add to base price)',170);
INSERT INTO products_options_values VALUES (49,2,'ホワイト（ベース価格に含める）',170);
INSERT INTO products_options_values VALUES (50,1,'orange',180);
INSERT INTO products_options_values VALUES (50,2,'オレンジ（ベース価格に含める）',180);
INSERT INTO products_options_values VALUES (51,1,'orange(NOT add to base price)',190);
INSERT INTO products_options_values VALUES (51,2,'オレンジ（ベース価格に含めない）',190);
INSERT INTO products_options_values VALUES (52,1,'Adobe PDF',3000);
INSERT INTO products_options_values VALUES (52,2,'PDFファイル',3000);
INSERT INTO products_options_values VALUES (53,1,'microsoft Word',3010);
INSERT INTO products_options_values VALUES (53,2,'Wordファイル',3010);
INSERT INTO products_options_values VALUES (54,1,'Windows(en)',3100);
INSERT INTO products_options_values VALUES (54,2,'Windows(en)版',3100);
INSERT INTO products_options_values VALUES (55,1,'Windows(jp)',3110);
INSERT INTO products_options_values VALUES (55,2,'Windows(jp)版',3110);
INSERT INTO products_options_values VALUES (56,1,'Mac(jp)',3120);
INSERT INTO products_options_values VALUES (56,2,'Mac(jp)版',3120);
INSERT INTO products_options_values VALUES (57,1,'CD',4000);
INSERT INTO products_options_values VALUES (57,2,'CD',4000);
INSERT INTO products_options_values VALUES (58,1,'mp3',4010);
INSERT INTO products_options_values VALUES (58,2,'mp3（ダウンロード商品）',4010);
INSERT INTO products_options_values VALUES (59,1,'gold',160);
INSERT INTO products_options_values VALUES (59,2,'ゴールド',160);

#
# Dumping data for table `products_options_values_to_products_options`
#

INSERT INTO products_options_values_to_products_options VALUES (1,1,1);
INSERT INTO products_options_values_to_products_options VALUES (2,1,2);
INSERT INTO products_options_values_to_products_options VALUES (3,1,3);
INSERT INTO products_options_values_to_products_options VALUES (4,3,4);
INSERT INTO products_options_values_to_products_options VALUES (5,3,5);
INSERT INTO products_options_values_to_products_options VALUES (15,4,0);
INSERT INTO products_options_values_to_products_options VALUES (7,3,7);
INSERT INTO products_options_values_to_products_options VALUES (8,3,8);
INSERT INTO products_options_values_to_products_options VALUES (9,2,9);
INSERT INTO products_options_values_to_products_options VALUES (10,2,10);
INSERT INTO products_options_values_to_products_options VALUES (11,2,11);
INSERT INTO products_options_values_to_products_options VALUES (12,2,12);
INSERT INTO products_options_values_to_products_options VALUES (13,2,13);
INSERT INTO products_options_values_to_products_options VALUES (14,3,14);
INSERT INTO products_options_values_to_products_options VALUES (16,5,0);
INSERT INTO products_options_values_to_products_options VALUES (17,6,15);
INSERT INTO products_options_values_to_products_options VALUES (18,6,16);
INSERT INTO products_options_values_to_products_options VALUES (19,6,17);
INSERT INTO products_options_values_to_products_options VALUES (20,6,18);
INSERT INTO products_options_values_to_products_options VALUES (21,1,19);
INSERT INTO products_options_values_to_products_options VALUES (22,1,20);
INSERT INTO products_options_values_to_products_options VALUES (23,7,21);
INSERT INTO products_options_values_to_products_options VALUES (24,7,22);
INSERT INTO products_options_values_to_products_options VALUES (25,7,23);
INSERT INTO products_options_values_to_products_options VALUES (26,8,24);
INSERT INTO products_options_values_to_products_options VALUES (27,8,25);
INSERT INTO products_options_values_to_products_options VALUES (28,8,26);
INSERT INTO products_options_values_to_products_options VALUES (29,8,27);
INSERT INTO products_options_values_to_products_options VALUES (30,8,28);
INSERT INTO products_options_values_to_products_options VALUES (31,8,29);
INSERT INTO products_options_values_to_products_options VALUES (32,8,30);
INSERT INTO products_options_values_to_products_options VALUES (33,8,31);
INSERT INTO products_options_values_to_products_options VALUES (34,9,32);
INSERT INTO products_options_values_to_products_options VALUES (35,9,33);
INSERT INTO products_options_values_to_products_options VALUES (36,10,34);
INSERT INTO products_options_values_to_products_options VALUES (37,10,35);
INSERT INTO products_options_values_to_products_options VALUES (38,11,36);
INSERT INTO products_options_values_to_products_options VALUES (39,11,37);
INSERT INTO products_options_values_to_products_options VALUES (40,3,38);
INSERT INTO products_options_values_to_products_options VALUES (41,12,39);
INSERT INTO products_options_values_to_products_options VALUES (42,12,40);
INSERT INTO products_options_values_to_products_options VALUES (43,12,41);
INSERT INTO products_options_values_to_products_options VALUES (44,13,42);
INSERT INTO products_options_values_to_products_options VALUES (45,13,43);
INSERT INTO products_options_values_to_products_options VALUES (46,14,44);
INSERT INTO products_options_values_to_products_options VALUES (47,14,45);
INSERT INTO products_options_values_to_products_options VALUES (48,14,46);
INSERT INTO products_options_values_to_products_options VALUES (50,12,47);
INSERT INTO products_options_values_to_products_options VALUES (51,3,48);
INSERT INTO products_options_values_to_products_options VALUES (52,3,49);
INSERT INTO products_options_values_to_products_options VALUES (53,3,50);
INSERT INTO products_options_values_to_products_options VALUES (54,3,51);
INSERT INTO products_options_values_to_products_options VALUES (55,15,52);
INSERT INTO products_options_values_to_products_options VALUES (56,15,53);
INSERT INTO products_options_values_to_products_options VALUES (57,16,54);
INSERT INTO products_options_values_to_products_options VALUES (58,16,55);
INSERT INTO products_options_values_to_products_options VALUES (59,16,56);
INSERT INTO products_options_values_to_products_options VALUES (60,17,57);
INSERT INTO products_options_values_to_products_options VALUES (61,17,58);
INSERT INTO products_options_values_to_products_options VALUES (62,18,0);
INSERT INTO products_options_values_to_products_options VALUES (63,3,59);

#
# Dumping data for table `products_to_categories`
#

INSERT INTO products_to_categories VALUES (1,2);
INSERT INTO products_to_categories VALUES (1,21);
INSERT INTO products_to_categories VALUES (2,4);
INSERT INTO products_to_categories VALUES (2,21);
INSERT INTO products_to_categories VALUES (3,2);
INSERT INTO products_to_categories VALUES (4,2);
INSERT INTO products_to_categories VALUES (5,4);
INSERT INTO products_to_categories VALUES (6,5);
INSERT INTO products_to_categories VALUES (6,21);
INSERT INTO products_to_categories VALUES (7,7);
INSERT INTO products_to_categories VALUES (8,8);
INSERT INTO products_to_categories VALUES (9,5);
INSERT INTO products_to_categories VALUES (10,8);
INSERT INTO products_to_categories VALUES (11,5);
INSERT INTO products_to_categories VALUES (11,21);
INSERT INTO products_to_categories VALUES (12,7);
INSERT INTO products_to_categories VALUES (12,80);
INSERT INTO products_to_categories VALUES (13,8);
INSERT INTO products_to_categories VALUES (13,27);
INSERT INTO products_to_categories VALUES (14,5);
INSERT INTO products_to_categories VALUES (14,80);
INSERT INTO products_to_categories VALUES (15,9);
INSERT INTO products_to_categories VALUES (16,10);
INSERT INTO products_to_categories VALUES (17,11);
INSERT INTO products_to_categories VALUES (17,27);
INSERT INTO products_to_categories VALUES (18,8);
INSERT INTO products_to_categories VALUES (19,12);
INSERT INTO products_to_categories VALUES (20,7);
INSERT INTO products_to_categories VALUES (21,13);
INSERT INTO products_to_categories VALUES (21,21);
INSERT INTO products_to_categories VALUES (22,13);
INSERT INTO products_to_categories VALUES (22,21);
INSERT INTO products_to_categories VALUES (23,14);
INSERT INTO products_to_categories VALUES (24,14);
INSERT INTO products_to_categories VALUES (24,96);
INSERT INTO products_to_categories VALUES (25,11);
INSERT INTO products_to_categories VALUES (26,7);
INSERT INTO products_to_categories VALUES (26,30);
INSERT INTO products_to_categories VALUES (27,12);
INSERT INTO products_to_categories VALUES (28,7);
INSERT INTO products_to_categories VALUES (29,14);
INSERT INTO products_to_categories VALUES (29,21);
INSERT INTO products_to_categories VALUES (30,7);
INSERT INTO products_to_categories VALUES (31,14);
INSERT INTO products_to_categories VALUES (32,14);
INSERT INTO products_to_categories VALUES (33,13);
INSERT INTO products_to_categories VALUES (34,13);
INSERT INTO products_to_categories VALUES (35,9);
INSERT INTO products_to_categories VALUES (35,27);
INSERT INTO products_to_categories VALUES (36,10);
INSERT INTO products_to_categories VALUES (37,9);
INSERT INTO products_to_categories VALUES (38,9);
INSERT INTO products_to_categories VALUES (38,21);
INSERT INTO products_to_categories VALUES (38,31);
INSERT INTO products_to_categories VALUES (39,10);
INSERT INTO products_to_categories VALUES (40,9);
INSERT INTO products_to_categories VALUES (41,10);
INSERT INTO products_to_categories VALUES (42,13);
INSERT INTO products_to_categories VALUES (43,12);
INSERT INTO products_to_categories VALUES (44,12);
INSERT INTO products_to_categories VALUES (44,30);
INSERT INTO products_to_categories VALUES (45,13);
INSERT INTO products_to_categories VALUES (46,13);
INSERT INTO products_to_categories VALUES (47,11);
INSERT INTO products_to_categories VALUES (48,13);
INSERT INTO products_to_categories VALUES (48,21);
INSERT INTO products_to_categories VALUES (49,13);
INSERT INTO products_to_categories VALUES (49,96);
INSERT INTO products_to_categories VALUES (50,15);
INSERT INTO products_to_categories VALUES (51,16);
INSERT INTO products_to_categories VALUES (52,7);
INSERT INTO products_to_categories VALUES (53,16);
INSERT INTO products_to_categories VALUES (53,30);
INSERT INTO products_to_categories VALUES (54,12);
INSERT INTO products_to_categories VALUES (54,21);
INSERT INTO products_to_categories VALUES (55,7);
INSERT INTO products_to_categories VALUES (55,29);
INSERT INTO products_to_categories VALUES (56,12);
INSERT INTO products_to_categories VALUES (57,17);
INSERT INTO products_to_categories VALUES (57,80);
INSERT INTO products_to_categories VALUES (57,95);
INSERT INTO products_to_categories VALUES (58,12);
INSERT INTO products_to_categories VALUES (58,21);
INSERT INTO products_to_categories VALUES (59,17);
INSERT INTO products_to_categories VALUES (60,12);
INSERT INTO products_to_categories VALUES (60,21);
INSERT INTO products_to_categories VALUES (61,17);
INSERT INTO products_to_categories VALUES (62,16);
INSERT INTO products_to_categories VALUES (63,12);
INSERT INTO products_to_categories VALUES (63,80);
INSERT INTO products_to_categories VALUES (64,16);
INSERT INTO products_to_categories VALUES (65,2);
INSERT INTO products_to_categories VALUES (65,29);
INSERT INTO products_to_categories VALUES (70,20);
INSERT INTO products_to_categories VALUES (71,20);
INSERT INTO products_to_categories VALUES (72,20);
INSERT INTO products_to_categories VALUES (73,20);
INSERT INTO products_to_categories VALUES (74,20);
INSERT INTO products_to_categories VALUES (75,20);
INSERT INTO products_to_categories VALUES (76,22);
INSERT INTO products_to_categories VALUES (77,22);
INSERT INTO products_to_categories VALUES (78,22);
INSERT INTO products_to_categories VALUES (79,22);
INSERT INTO products_to_categories VALUES (80,22);
INSERT INTO products_to_categories VALUES (81,22);
INSERT INTO products_to_categories VALUES (82,22);
INSERT INTO products_to_categories VALUES (83,22);
INSERT INTO products_to_categories VALUES (84,22);
INSERT INTO products_to_categories VALUES (85,22);
INSERT INTO products_to_categories VALUES (86,22);
INSERT INTO products_to_categories VALUES (87,22);
INSERT INTO products_to_categories VALUES (88,23);
INSERT INTO products_to_categories VALUES (89,23);
INSERT INTO products_to_categories VALUES (89,27);
INSERT INTO products_to_categories VALUES (90,23);
INSERT INTO products_to_categories VALUES (91,23);
INSERT INTO products_to_categories VALUES (92,40);
INSERT INTO products_to_categories VALUES (93,40);
INSERT INTO products_to_categories VALUES (95,40);
INSERT INTO products_to_categories VALUES (98,40);
INSERT INTO products_to_categories VALUES (99,41);
INSERT INTO products_to_categories VALUES (100,41);
INSERT INTO products_to_categories VALUES (101,41);
INSERT INTO products_to_categories VALUES (101,64);
INSERT INTO products_to_categories VALUES (102,45);
INSERT INTO products_to_categories VALUES (103,45);
INSERT INTO products_to_categories VALUES (104,45);
INSERT INTO products_to_categories VALUES (110,45);
INSERT INTO products_to_categories VALUES (111,45);
INSERT INTO products_to_categories VALUES (112,45);
INSERT INTO products_to_categories VALUES (113,45);
INSERT INTO products_to_categories VALUES (115,58);
INSERT INTO products_to_categories VALUES (116,58);
INSERT INTO products_to_categories VALUES (139,60);
INSERT INTO products_to_categories VALUES (140,60);
INSERT INTO products_to_categories VALUES (141,61);
INSERT INTO products_to_categories VALUES (142,62);
INSERT INTO products_to_categories VALUES (143,62);
INSERT INTO products_to_categories VALUES (144,63);
INSERT INTO products_to_categories VALUES (146,63);
INSERT INTO products_to_categories VALUES (151,63);
INSERT INTO products_to_categories VALUES (152,63);
INSERT INTO products_to_categories VALUES (152,64);
INSERT INTO products_to_categories VALUES (155,40);
INSERT INTO products_to_categories VALUES (156,67);
INSERT INTO products_to_categories VALUES (156,72);
INSERT INTO products_to_categories VALUES (157,67);
INSERT INTO products_to_categories VALUES (158,67);
INSERT INTO products_to_categories VALUES (159,68);
INSERT INTO products_to_categories VALUES (160,68);
INSERT INTO products_to_categories VALUES (161,68);
INSERT INTO products_to_categories VALUES (162,69);
INSERT INTO products_to_categories VALUES (163,69);
INSERT INTO products_to_categories VALUES (164,69);
INSERT INTO products_to_categories VALUES (165,70);
INSERT INTO products_to_categories VALUES (166,70);
INSERT INTO products_to_categories VALUES (167,70);
INSERT INTO products_to_categories VALUES (168,70);
INSERT INTO products_to_categories VALUES (169,70);
INSERT INTO products_to_categories VALUES (170,71);
INSERT INTO products_to_categories VALUES (171,71);
INSERT INTO products_to_categories VALUES (172,67);
INSERT INTO products_to_categories VALUES (172,72);
INSERT INTO products_to_categories VALUES (173,73);
INSERT INTO products_to_categories VALUES (174,73);
INSERT INTO products_to_categories VALUES (175,73);
INSERT INTO products_to_categories VALUES (176,74);
INSERT INTO products_to_categories VALUES (177,74);
INSERT INTO products_to_categories VALUES (178,74);
INSERT INTO products_to_categories VALUES (179,75);
INSERT INTO products_to_categories VALUES (180,75);
INSERT INTO products_to_categories VALUES (181,75);
INSERT INTO products_to_categories VALUES (182,45);
INSERT INTO products_to_categories VALUES (183,76);
INSERT INTO products_to_categories VALUES (184,76);
INSERT INTO products_to_categories VALUES (185,76);
INSERT INTO products_to_categories VALUES (187,78);
INSERT INTO products_to_categories VALUES (188,78);
INSERT INTO products_to_categories VALUES (189,78);
INSERT INTO products_to_categories VALUES (190,81);
INSERT INTO products_to_categories VALUES (191,81);
INSERT INTO products_to_categories VALUES (192,82);
INSERT INTO products_to_categories VALUES (193,82);
INSERT INTO products_to_categories VALUES (194,82);
INSERT INTO products_to_categories VALUES (195,82);
INSERT INTO products_to_categories VALUES (196,83);
INSERT INTO products_to_categories VALUES (197,83);
INSERT INTO products_to_categories VALUES (198,85);
INSERT INTO products_to_categories VALUES (199,85);
INSERT INTO products_to_categories VALUES (200,78);
INSERT INTO products_to_categories VALUES (201,86);
INSERT INTO products_to_categories VALUES (202,86);
INSERT INTO products_to_categories VALUES (203,86);
INSERT INTO products_to_categories VALUES (204,86);
INSERT INTO products_to_categories VALUES (205,87);
INSERT INTO products_to_categories VALUES (206,87);
INSERT INTO products_to_categories VALUES (207,87);
INSERT INTO products_to_categories VALUES (208,83);
INSERT INTO products_to_categories VALUES (209,89);
INSERT INTO products_to_categories VALUES (210,89);
INSERT INTO products_to_categories VALUES (211,89);
INSERT INTO products_to_categories VALUES (212,91);
INSERT INTO products_to_categories VALUES (213,91);
INSERT INTO products_to_categories VALUES (214,93);
INSERT INTO products_to_categories VALUES (215,93);
INSERT INTO products_to_categories VALUES (215,97);
INSERT INTO products_to_categories VALUES (217,79);
INSERT INTO products_to_categories VALUES (217,98);
INSERT INTO products_to_categories VALUES (218,40);
INSERT INTO products_to_categories VALUES (222,79);
INSERT INTO products_to_categories VALUES (223,79);
INSERT INTO products_to_categories VALUES (224,79);
INSERT INTO products_to_categories VALUES (225,100);
INSERT INTO products_to_categories VALUES (226,100);
INSERT INTO products_to_categories VALUES (227,101);
INSERT INTO products_to_categories VALUES (229,100);

#
# Dumping data for table `record_artists`
#

INSERT INTO record_artists VALUES (1,'The Russ Tippins Band','sooty.jpg','2007-01-26 10:42:36',NULL);

#
# Dumping data for table `record_artists_info`
#

INSERT INTO record_artists_info VALUES (1,1,'',0,NULL);
INSERT INTO record_artists_info VALUES (1,2,'',0,NULL);

#
# Dumping data for table `record_company`
#

INSERT INTO record_company VALUES (1,'HMV Group',NULL,'2007-01-26 10:43:16','2007-01-26 10:43:59');

#
# Dumping data for table `record_company_info`
#

INSERT INTO record_company_info VALUES (1,1,'www.hmvgroup.com',0,NULL);
INSERT INTO record_company_info VALUES (1,2,'www.hmvgroup.com',0,NULL);

#
# Dumping data for table `reviews`
#

INSERT INTO reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read, status) VALUES (1, 19, 0, 'Bill Smith', 5, '2003-12-23 03:18:19', '0001-01-01 00:00:00', 11, 1);

#
# Dumping data for table `reviews_description`
#

INSERT INTO reviews_description (reviews_id, languages_id, reviews_text) VALUES (1, 1, 'This really is a very funny but old movie!');

#
# Dumping data for table `salemaker_sales`
#

INSERT INTO salemaker_sales VALUES (1,1,'10%OFF',10.0000,1,0.0000,0.0000,2,'64,67',',64,67,','0001-01-01','0001-01-01','2007-01-17','2007-01-18','2007-01-17');
INSERT INTO salemaker_sales VALUES (2,1,'500円OFF',500.0000,0,0.0000,0.0000,2,'68',',68,','0001-01-01','0001-01-01','2007-01-18','2007-01-19','2007-01-18');
INSERT INTO salemaker_sales VALUES (3,1,'新価格8000円',8000.0000,2,0.0000,0.0000,2,'69',',69,','0001-01-01','0001-01-01','2007-01-18','2007-01-19','2007-01-18');
INSERT INTO salemaker_sales VALUES (4,1,'10％OFF（特価＋セール）',10.0000,1,0.0000,0.0000,2,'73',',73,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18');
INSERT INTO salemaker_sales VALUES (5,1,'10％OFF（セール優先）',10.0000,1,0.0000,0.0000,0,'74',',74,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18');
INSERT INTO salemaker_sales VALUES (6,1,'10％OFF（特価優先）',10.0000,1,0.0000,0.0000,1,'75',',75,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18');
INSERT INTO salemaker_sales VALUES (7,1,'10％セール期間と価格帯限定',10.0000,1,10000.0000,0.0000,2,'71',',71,','2007-01-15','2007-06-15','2007-01-18','2007-01-18','2007-01-18');

#
# Dumping data for table `specials`
#

INSERT INTO specials VALUES (1,1,4050.0000,'2007-01-16 00:29:45',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (2,17,3800.0000,'2007-01-16 00:31:09','2007-01-16 00:31:50','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (3,79,2000.0000,'2007-01-16 00:34:02',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (4,93,7500.0000,'2007-01-16 15:11:23','2007-01-16 15:50:07','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (7,101,9000.0000,'2007-01-16 17:24:53',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (27,212,450.0000,'2007-01-26 11:08:19',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (11,111,5000.0000,'2007-01-16 20:38:12','2007-01-16 21:13:28','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (10,110,9500.0000,'2007-01-16 20:38:12','2007-01-16 21:10:17','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (12,113,5000.0000,'2007-01-16 21:03:43','2007-01-16 21:14:42','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (13,165,8000.0000,'2007-01-18 14:08:42','2007-01-18 14:13:02','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (14,166,5000.0000,'2007-01-18 14:28:21',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (15,167,5000.0000,'2007-01-18 14:28:40',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (16,168,5000.0000,'2007-01-18 14:28:51',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (17,169,5000.0000,'2007-01-18 14:29:19','2007-01-18 14:29:48','2007-06-15',NULL,1,'2007-01-15');
INSERT INTO specials VALUES (18,173,5000.0000,'2007-01-18 14:30:15',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (19,174,5000.0000,'2007-01-18 14:30:26',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (20,175,5000.0000,'2007-01-18 14:30:35',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (21,176,5000.0000,'2007-01-18 14:30:53',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (22,177,5000.0000,'2007-01-18 14:31:03',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (23,178,5000.0000,'2007-01-18 14:31:11',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (24,179,5000.0000,'2007-01-18 14:34:01',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (25,180,5000.0000,'2007-01-18 14:34:11',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO specials VALUES (26,181,5000.0000,'2007-01-18 14:34:24',NULL,'0001-01-01',NULL,1,'0001-01-01');

#
# Dumping data for table `meta_tags_categories_description`
#

INSERT INTO meta_tags_categories_description VALUES (58,1,'','','');
INSERT INTO meta_tags_categories_description VALUES (58,2,'このカテゴリには明示的にtitleタグを設定しました。','このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3','このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');

#
# Dumping data for table `meta_tags_products_description`
#

INSERT INTO meta_tags_products_description VALUES (115,1,'','','');
INSERT INTO meta_tags_products_description VALUES (115,2,'この商品ページには明示的にtitleタグを設定しました。','この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3','この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');

#
# Initial setup for Japanese demo
#

# `configuration` setup

UPDATE configuration SET configuration_value='true' WHERE configuration_key='DOWNLOAD_ENABLED';
UPDATE configuration SET configuration_value='107' WHERE configuration_key='SHIPPING_ORIGIN_COUNTRY';
UPDATE configuration SET configuration_value='100-0000' WHERE configuration_key='SHIPPING_ORIGIN_ZIP';
UPDATE configuration SET configuration_value='1' WHERE configuration_key='ORDER_WEIGHT_ZERO_STATUS';
UPDATE configuration SET configuration_value='在庫切れです' WHERE configuration_key='STOCK_MARK_PRODUCT_OUT_OF_STOCK';
UPDATE configuration SET configuration_value='False' WHERE configuration_key='SKIP_SINGLE_PRODUCT_CATEGORIES';

# shipping module install ( freeshipper and yamato )

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('無料配送', 'MODULE_SHIPPING_FREESHIPPER_STATUS', 'True', '無料配送を提供しますか？', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('無料配送コスト', 'MODULE_SHIPPING_FREESHIPPER_COST', '0', '無料配送にかかるコスト', '6', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('手数料', 'MODULE_SHIPPING_FREESHIPPER_HANDLING', '0', '無料配送にかかる手数料.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('税種別', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', '定額料金に適用される税種別を選択してください。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('配送地域', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', '配送地域を選択すると選択された地域のみで利用可能になります。.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('表示の整列順', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '0', '表示の整列順を設定できます。数字が小さいほど上位に表示されます。', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('佐川急便の配送を有効にする', 'MODULE_SHIPPING_YAMATO_STATUS', 'True', 'ヤマト運輸(宅急便)の配送を提供しますか?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('取扱い手数料', 'MODULE_SHIPPING_YAMATO_HANDLING', '0', '送料に適用する取扱手数料を設定できます.', '6', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('送料無料設定', 'MODULE_SHIPPING_YAMATO_FREE_SHIPPING', 'False', '送料無料設定を有効にしますか? [合計モジュール]-[送料]-[送料無料設定]を優先する場合は False を選んでください.', '6', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('送料を無料にする購入金額設定', 'MODULE_SHIPPING_YAMATO_OVER', '5000', '設定金額以上をご購入の場合は送料を無料にします.', '6', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('送料の値引率', 'MODULE_SHIPPING_YAMATO_DISCOUNT', '0', '送料の値引率を指定します.(％)', '6', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('配送地域', 'MODULE_SHIPPING_YAMATO_ZONE', '0', '配送地域を選択すると選択された地域のみで利用可能となります.', '6', '5', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('表示の整列順', 'MODULE_SHIPPING_YAMATO_SORT_ORDER', '0', '表示の整列順を設定できます. 数字が小さいほど上位に表示されます.', '6', '6', now());
