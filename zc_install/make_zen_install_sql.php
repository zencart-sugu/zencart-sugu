<?php
	$sql_file = "sugudeki.sql";
	$lines = file($sql_file);
	$insert = "";
	$other = "";

	foreach($lines as $line) {
		$line = trim($line);
/*		$line = str_replace("`", "", $line);
		$line_upper = strtoupper($line);*/

		$line_upper = strtoupper($line);

		if(substr($line_upper, 0, 12) == 'INSERT INTO '){
			if(!preg_match("/(`media_types`)|(`paypal_payment_status`)|(`template_select`)|(`address_format`)|(`admin`)|(`blocks`)|(`banners`)|(`configuration`)|(`configuration_group`)|(`email_templates`)|(`email_templates_description`)|(`countries`)|(`currencies`)|(`languages`)|(`layout_boxes`)|(`orders_status`)|(`product_types`)|(`products_options_types`)|(`zones`)|(`product_type_layout`)|(`query_builder`)|(`get_terms_to_filter`)|(`project_version`)|(`project_version_history`)|(`tax_rates`)|(`geo_zones`)|(`zones_to_geo_zones`)|(`tax_class`)/", $line)) {

				if(preg_match("/`products_options_values`/", $line)) {
					if(preg_match("/'TEXT'/", $line)) {
						$other .= $line."\n";
					}
				}else{
					$insert .= $line."\n";
				}
			}else{
				$other .= $line."\n";
			}
		}else{
			if(!preg_match("/(LOCK TABLES)|(UNLOCK TABLES)|(!40000 ALTER TABLE )/", $line)) {
				$other .= $line."\n";
			}
		}
	}

	$insert = str_replace("`", "", $insert);
	$other = str_replace("`", "", $other);
/*
	$encoding = mb_detect_encoding($insert);
	$insert = mb_convert_encoding($insert, "EUC-JP", $encoding);

	$encoding = mb_detect_encoding($other);
	$other = mb_convert_encoding($other, "EUC-JP", $encoding);*/

	umask(0);
	$file_name = "mysql_zencart.sql";//作成するファイル名
	$file_pointer = fopen($file_name, "w+");
	flock($file_pointer, LOCK_EX);
	fputs($file_pointer, $other);
	flock($file_pointer, LOCK_UN);
	fclose($file_pointer);

	umask(0);
	$file_name = "demo/mysql_demo.sql";//作成するファイル名
	$file_pointer = fopen($file_name, "w+");
	flock($file_pointer, LOCK_EX);
	fputs($file_pointer, $insert);
	flock($file_pointer, LOCK_UN);
	fclose($file_pointer);
?>