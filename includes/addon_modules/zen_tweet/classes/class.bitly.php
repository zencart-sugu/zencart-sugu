<?php
class Bitly {

    private $login;
    private $apikey;
    private $apiversion;
    private $format;

	##### コンストラクタ
    public function __construct() {
        if(MODULE_SALES_TWITTER_BITLY_USER_ACCOUNT != null) $this->login = MODULE_ZEN_TWEET_BITLY_USER_ACCOUNT;
        if(MODULE_ZEN_TWEET_BITLY_API_KEY != null) $this->apikey = MODULE_ZEN_TWEET_BITLY_API_KEY;
        if(MODULE_ZEN_TWEET_BITLY_API_VERSION != null) $this->apiversion = MODULE_ZEN_TWEET_BITLY_API_VERSION;
        if(MODULE_ZEN_TWEET_BITLY_DATA_FORMAT != null) $this->format = MODULE_ZEN_TWEET_BITLY_DATA_FORMAT;
    }

    //URLを短くする
    public function shorten($longurl) {
        $apiurl = MODULE_ZEN_TWEET_BITLY_API_URL . "/" . $this->apiversion
                                . "/shorten?"
                                . "&longUrl=" . urlencode($longurl)
                                . "&login=" . $this->login
                                . "&apikey=" . $this->apikey
                                //. "&format=" . $this->format;
                                . "&format=json";

        $response = file_get_contents($apiurl);

        //if($this->format == "json") {
            $json = json_decode($response, true);
            if($json['status_code'] === 200) {
                return $json['data']['url'];
            }
        //}
    }

}
?>