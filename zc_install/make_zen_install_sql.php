<?php
	$sql_file = "sugudeki.sql";
	$lines = file($sql_file);
	$demo = "";
	$def = "";

	foreach($lines as $line) {
		$line = trim($line);
		$line_upper = strtoupper($line);

		if(substr($line_upper, 0, 12) == 'INSERT INTO '){
			//デモ用データ
			if(preg_match("/(`categories`)|(`categories_description`)|(`ezpages`)|(`featured`)|(`group_pricing`)|(`manufacturers`)|(`manufacturers_info`)|(`media_clips`)|(`media_manager`)|(`media_to_products`)|(`meta_tags_categories_description`)|(`meta_tags_products_description`)|(`music_genre`)|(`product_music_extra`)|(`product_types_to_category`)|(`products`)|(`products_attributes`)|(`products_attributes_download`)|(`products_description`)|(`products_discount_quantity`)|(`products_options`)|(`products_options_values`)|(`products_options_values_to_products_options`)|(`products_to_categories`)|(`record_artists`)|(`record_artists_info`)|(`record_company`)|(`record_company_info`)|(`reviews`)|(`reviews_description`)|(`salemaker_sales`)|(`specials`)/", $line)) {
				$demo .= $line."\n";

			//デフォルトデータ
			}elseif(!preg_match("/(`orders`)|(`orders_products`)|(`orders_products_attributes`)|(`orders_total`)|(`orders_status_history`)|(`customers`)|(`customers_info`)|(`customers_basket`)|(`address_book`)|(`admin_activity_log`)|(`banners_history`)|(`counter_history`)|(`coupon_email_track`)|(`coupon_gv_customer`)|(`coupon_redeem_track`)|(`coupons`)|(`coupons_description`)|(`customers_points`)|(`newsletters`)|(`orders_products_download`)|(`point_histories`)|(`products_with_attributes_stock`)|(`sessions`)/", $line)){
				$def .= $line."\n";
			}
		}else{
			if(!preg_match("/(LOCK TABLES)|(UNLOCK TABLES)|(!40000 ALTER TABLE )/", $line)) {
				$def .= $line."\n";
			}
		}

	}

	$demo = str_replace("`", "", $demo);
	$def = str_replace("`", "", $def);

	umask(0);
	$file_name = "mysql_zencart.sql";//作成するファイル名
	$file_pointer = fopen($file_name, "w+");
	flock($file_pointer, LOCK_EX);
	fputs($file_pointer, $def);
	flock($file_pointer, LOCK_UN);
	fclose($file_pointer);

	umask(0);
	$file_name = "demo/mysql_demo.sql";//作成するファイル名
	$file_pointer = fopen($file_name, "w+");
	flock($file_pointer, LOCK_EX);
	fputs($file_pointer, $demo);
	flock($file_pointer, LOCK_UN);
	fclose($file_pointer);
?>