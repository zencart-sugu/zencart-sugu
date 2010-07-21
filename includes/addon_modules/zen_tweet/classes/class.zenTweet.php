<?php
class zenTweet extends base {

	var $products;

	function zenTweet() {
        $this->products = $_SESSION['cart']->get_products();
	}

	function execTweet() {
		require_once(DIR_FS_CATALOG . 'includes/addon_modules/' . FILENAME_ZEN_TWEET . '/classes/class.bitly.php');

		########### つぶやきを作成
        for($i=0; $i<count($this->products); $i++) {
            //商品名取得
            $p_name = $this->products[$i]["name"];
            /*
             * セール品の場合、IDの後ろにハッシュキーが付与されている為、
             * IDだけを取る処理を追加
             */
            if(preg_match("/:/", $this->products[$i]["id"])) {
                $arr = explode(":", $this->products[$i]["id"]);
                $p_id = $arr[0];
            } else {
                $p_id = $this->products[$i]["id"];
            }


        /*========================================================================
         * 追加処理 10/06/08
         *
         * 在庫数とおすすめ商品を取得
		========================================================================*/

            $products_quantity = $this->queryGetQuantity($p_id);
            $featured = $this->queryGetFeatured($p_id);

            //おすすめ商品のつぶやきを有効にしている場合
            if(MODULE_ZEN_TWEET_THRESHOLD > 0 && MODULE_ZEN_TWEET_RECOMMEND == "true") {

            	//在庫数がしきい値に達しおすすめ商品だったらつぶやきを作成する
	            if(MODULE_ZEN_TWEET_THRESHOLD >= $products_quantity && $featured == 1) {
		            $url = zen_href_link(FILENAME_PRODUCT_INFO, "&products_id=" . $p_id, 'NONSSL');

		            //bit.ly呼び出し
		            //$bitly = new Bitly();
		            //$shortUrl = $bitly->shorten($url);
		            $words[] = $this->products[$i]["name"] . MODULE_ZEN_TWEET_WORD . "\n" . $url;
	            }

	        //おすすめ商品のつぶやきを無効にしている場合
            }elseif(MODULE_ZEN_TWEET_THRESHOLD > 0 && MODULE_ZEN_TWEET_RECOMMEND == "false") {

            	//在庫数がしきい値に達したらつぶやきを作成する
				if(MODULE_ZEN_TWEET_THRESHOLD >= $products_quantity) {
		            $url = zen_href_link(FILENAME_PRODUCT_INFO, "&products_id=" . $p_id, 'NONSSL');

		            //bit.ly呼び出し
		            //$bitly = new Bitly();
		            //$shortUrl = $bitly->shorten($url);
		            $words[] = $this->products[$i]["name"] . MODULE_ZEN_TWEET_WORD . "\n" . $url;
				}

            }

        }

		########### つぶやきを投稿
	    for($i=0; $i<count($words); $i++) {
	        $message = $words[$i];

	        //文字コードを調べる
	        $code = mb_detect_encoding($message);
			if($code != "UTF-8") {
            	//文字コードを変換
                $message = mb_convert_encoding($message, "UTF-8", $code);
			}

	        $this->tweet_statuses_update(MODULE_ZEN_TWEET_ACCOUNT_ID, MODULE_ZEN_TWEET_ACCOUNT_PASS, $message);
	    }
	}

	/*
	 * 実際の投稿ファンクション
	 */
    function tweet_statuses_update($id, $pw, $msg){
        $url = 'http://twitter.com/statuses/update.xml?status=' . rawurlencode($msg);
        //接続オプション
        $option = array(
			"http"=>array(
				"method"=>"POST",
				"header"=>"Authorization: Basic ". base64_encode($id. ":". $pw)
			)
        );

        //コンテクストリソース
        $context = stream_context_create($option);
        file_get_contents($url, false, $context);
    }

    function queryGetQuantity($id) {

		global $db;

		$query = "select products_quantity from " . TABLE_PRODUCTS . " where products_id = :products_id;";
		$query = $db->bindVars($query, ':products_id', $id, 'integer');
		$quantity = $db->Execute($query);
		return $quantity->fields['products_quantity'];

    }

    function queryGetFeatured($id) {
		global $db;

		$query = "select count(*) as total from " . TABLE_FEATURED . " where products_id = :products_id;";
		$query = $db->bindVars($query, ':products_id', $id, 'integer');
		$num = $db->Execute($query);
		return $num->fields['total'];

    }

}
?>