<?php
/* 変換前の絵文字タイプ */
define('MPC_FROM_FOMA'    , 'FOMA');
define('MPC_FROM_EZWEB'   , 'EZWEB');
define('MPC_FROM_SOFTBANK', 'SOFTBANK');
/* 変換前の絵文字体系 */
define('MPC_FROM_OPTION_RAW' , 'RAW'); // バイナリコード
define('MPC_FROM_OPTION_WEB' , 'WEB'); // Web入力コード
define('MPC_FROM_OPTION_IMG' , 'IMG'); // 画像
/* 変換前の文字列の文字コード */
define('MPC_FROM_CHARSET_SJIS', 'SJIS');
define('MPC_FROM_CHARSET_UTF8', 'UTF-8');
/* 変換後の文字列の文字コード */
define('MPC_TO_CHARSET_SJIS', 'SJIS');
define('MPC_TO_CHARSET_UTF8', 'UTF-8');

// {{{ class MobilePictogramConverter
/**
* 絵文字変換クラス
* 
* <pre>
* MobilePictogramConverter  Factory Method クラス
*
* MPC_Common      全てのキャリアに対して共通する機能を備えたベースクラス
* |
* +-MPC_FOMA      FOMA絵文字から他の絵文字に変換する際にベースクラス
* |               MobilePictogramConverter::factoryの第一引数にMPC_FROM_FOMAを指定した場合に呼び出されます。
* |
* +-MPC_EZweb     EZweb絵文字から他の絵文字に変換する際のベースクラス
* |               MobilePictogramConverter::factoryの第一引数にMPC_FROM_EZWEBを指定した場合に呼び出されます。
* |
* +-MPC_SoftBank  SoftBank絵文字から他の絵文字に変換する際のベースクラス
*                 MobilePictogramConverter::factoryの第一引数にMPC_FROM_SOFTBANKを指定した場合に呼び出されます。
* </pre>
* 
* @author   ryster <ryster@php-develop.org>
* @license  http://www.opensource.org/licenses/mit-license.php The MIT License
* @version  Release: 1.2.0
* @link     http://php-develop.org/MobilePictogramConverter/
*/
class MobilePictogramConverter
{
    /**
    * タイプに合わせて、専用のクラスオブジェクトを生成
    * 
    * 例.
    * <code>
    * require_once("MobilePictogramConverter.php");
    * 
    * $mpc =& MobilePictogramConverter::factory($str, MPC_FROM_FOMA, MPC_FROM_CHARSET_SJIS);
    * if (is_object($mpc) == false) {
    *     die($mpc);
    * }
    * </code>
    * 
    * @param string  $str     変換前文字列
    * @param string  $carrier $strの絵文字キャリア (MPC_FROM_FOMA, MPC_FROM_EZWEB, MPC_FROM_SOFTBANK)
    * @param string  $charset 文字コード         (MPC_FROM_CHARSET_SJIS, MPC_FROM_CHARSET_UTF8)
    * @param string  $type    $strの絵文字タイプ  (MPC_FROM_OPTION_RAW, MPC_FROM_OPTION_WEB, MPC_FROM_OPTION_IMG)
    * @return mixed
    */
    function &factory($str, $carrier, $charset, $type = MPC_FROM_OPTION_RAW)
    {
        $filepath = dirname(__FILE__).'/Carrier/'.strtolower($carrier).'.php';
        if (file_exists($filepath) == false) {
            $error = 'The file doesn\'t exist.';
            return $error;
        }
        
        require_once($filepath);
        $classname = 'MPC_'.$carrier;
        
        if (class_exists($classname) == false) {
            $error = 'The class doesn\'t exist.';
            return $error;
        }
        
        $mpc =& new $classname;
        $mpc->setFromCharset($charset);
        $mpc->setString($str);
        $mpc->setFrom(strtoupper($carrier));
        $mpc->setStringType($type);
        
        return $mpc;
    }
}
// }}}
?>