<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: KUBO Atsuhiro <kubo@isite.co.jp>                            |
// +----------------------------------------------------------------------+
//
// $Id: DoCoMoDisplayMap.php,v 1.1 2006/02/19 23:58:03 shida Exp $
//

/**
 * Display infomation mapping for DoCoMo
 *
 * @package  Net_UserAgent_Mobile
 * @category Networking
 * @author   KUBO Atsuhiro <kubo@isite.co.jp>
 * @access   public
 * @version  $Revision: 1.1 $
 * @see      Net_UserAgent_Mobile_Display
 * @link     http://www.nttdocomo.co.jp/p_s/imode/spec/ryouiki.html
 */
class Net_UserAgent_Mobile_DoCoMoDisplayMap
{

    /**
     * returns display infomation of the model
     *
     * @param string $model name of the model
     * @return array
     * @access public
     * @static
     */
    function get($model)
    {
        static $displayMap;
        if (!isset($displayMap)) {
            if (isset($_SERVER['DOCOMO_MAP'])) {

                // using the specified XML data
                while (true) {
                    if (!function_exists('xml_parser_create')
                        || !is_readable($_SERVER['DOCOMO_MAP'])
                        ) {
                        break;
                    }
                    $xml = file_get_contents($_SERVER['DOCOMO_MAP']);
                    $parser = xml_parser_create();
                    if ($parser === false) {
                        break;
                    }
                    xml_parse_into_struct($parser, $xml, $values, $indexes);
                    if (!xml_parser_free($parser)) {
                        break;
                    }
                    if (isset($indexes['OPT'])) {
                        unset($indexes['OPT']);
                    }
                    foreach ($indexes as $modelName => $modelIndexes) {
                        $displayMap[$modelName] = array();
                        foreach ($values[ $modelIndexes[0] ]['attributes'] as $attributeName => $attributeValue) {
                            $displayMap[$modelName][ strtolower($attributeName) ] = $attributeValue;
                        }
                    }
                    break;
                }
            }

            if (!isset($displayMap)) {
                $displayMap = array(

                                    // i-mode compliant HTML 1.0
                                    'D501I' => array(
                                                     'width'  => 96,
                                                     'height' => 72,
                                                     'depth'  => 2,
                                                     'color'  => 0
                                                     ),
                                    'F501I' => array(
                                                     'width'  => 112,
                                                     'height' => 84,
                                                     'depth'  => 2,
                                                     'color'  => 0
                                                     ),
                                    'N501I' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 2,
                                                     'color'  => 0
                                                     ),
                                    'P501I' => array(
                                                     'width'  => 96,
                                                     'height' => 120,
                                                     'depth'  => 2,
                                                     'color'  => 0
                                                     ),

                                    // i-mode compliant HTML 2.0
                                    'D502I' => array(
                                                     'width'  => 96,
                                                     'height' => 90,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'F502I' => array(
                                                     'width'  => 96,
                                                     'height' => 91,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'N502I' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'P502I' => array(
                                                     'width'  => 96,
                                                     'height' => 117,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'NM502I' => array(
                                                      'width'  => 111,
                                                      'height' => 106,
                                                      'depth'  => 2,
                                                      'color'  => 0
                                                      ),
                                    'SO502I' => array(
                                                      'width'  => 120,
                                                      'height' => 120,
                                                      'depth'  => 4,
                                                      'color'  => 0
                                                      ),
                                    'F502IT' => array(
                                                      'width'  => 96,
                                                      'height' => 91,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'N502IT' => array(
                                                      'width'  => 118,
                                                      'height' => 128,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'SO502IWM' => array(
                                                        'width'  => 120,
                                                        'height' => 113,
                                                        'depth'  => 256,
                                                        'color'  => 1
                                                        ),
                                    'SH821I' => array(
                                                      'width'  => 96,
                                                      'height' => 78,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'N821I' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'P821I' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'D209I' => array(
                                                     'width'  => 96,
                                                     'height' => 90,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'ER209I' => array(
                                                      'width'  => 120,
                                                      'height' => 72,
                                                      'depth'  => 2,
                                                      'color'  => 0
                                                      ),
                                    'F209I' => array(
                                                     'width'  => 96,
                                                     'height' => 91,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'KO209I' => array(
                                                      'width'  => 96,
                                                      'height' => 96,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'N209I' => array(
                                                     'width'  => 108,
                                                     'height' => 82,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'P209I' => array(
                                                     'width'  => 96,
                                                     'height' => 87,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'P209IS' => array(
                                                      'width'  => 96,
                                                      'height' => 87,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'R209I' => array(
                                                     'width'  => 96,
                                                     'height' => 72,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'P651PS' => array(
                                                      'width'  => 96,
                                                      'height' => 87,
                                                      'depth'  => 4,
                                                      'color'  => 0
                                                      ),
                                    'R691I' => array(
                                                     'width'  => 96,
                                                     'height' => 72,
                                                     'depth'  => 4,
                                                     'color'  => 0
                                                     ),
                                    'F671I' => array(
                                                     'width'  => 120,
                                                     'height' => 126,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'F210I' => array(
                                                     'width'  => 96,
                                                     'height' => 113,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'N210I' => array(
                                                     'width'  => 118,
                                                     'height' => 113,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'P210I' => array(
                                                     'width'  => 96,
                                                     'height' => 91,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'KO210I' => array(
                                                      'width'  => 96,
                                                      'height' => 96,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),

                                    // i-mode compliant HTML 3.0
                                    'F503I' => array(
                                                     'width'  => 120,
                                                     'height' => 130,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'F503IS' => array(
                                                      'width'  => 120,
                                                      'height' => 130,
                                                      'depth'  => 4096,
                                                      'color'  => 1
                                                      ),
                                    'P503I' => array(
                                                     'width'  => 120,
                                                     'height' => 130,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'P503IS' => array(
                                                      'width'  => 120,
                                                      'height' => 130,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'N503I' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'N503IS' => array(
                                                      'width'  => 118,
                                                      'height' => 128,
                                                      'depth'  => 4096,
                                                      'color'  => 1
                                                      ),
                                    'SO503I' => array(
                                                      'width'  => 120,
                                                      'height' => 113,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SO503IS' => array(
                                                       'width'  => 120,
                                                       'height' => 113,
                                                       'depth'  => 65536,
                                                       'color'  => 1
                                                       ),
                                    'D503I' => array(
                                                     'width'  => 132,
                                                     'height' => 126,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'D503IS' => array(
                                                      'width'  => 132,
                                                      'height' => 126,
                                                      'depth'  => 4096,
                                                      'color'  => 1
                                                      ),
                                    'D210I' => array(
                                                     'width'  => 96,
                                                     'height' => 91,
                                                     'depth'  => 256,
                                                     'color'  => 1
                                                     ),
                                    'SO210I' => array(
                                                      'width'  => 120,
                                                      'height' => 113,
                                                      'depth'  => 256,
                                                      'color'  => 1
                                                      ),
                                    'F211I' => array(
                                                     'width'  => 96,
                                                     'height' => 113,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'D211I' => array(
                                                     'width'  => 100,
                                                     'height' => 91,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'N211I' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'N211IS' => array(
                                                      'width'  => 118,
                                                      'height' => 128,
                                                      'depth'  => 4096,
                                                      'color'  => 1
                                                      ),
                                    'P211I' => array(
                                                     'width'  => 120,
                                                     'height' => 130,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P211IS' => array(
                                                      'width'  => 120,
                                                      'height' => 130,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SO211I' => array(
                                                      'width'  => 120,
                                                      'height' => 112,
                                                      'depth'  => 4096,
                                                      'color'  => 1
                                                      ),
                                    'R211I' => array(
                                                     'width'  => 96,
                                                     'height' => 98,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'SH251I' => array(
                                                      'width'  => 120,
                                                      'height' => 130,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SH251IS' => array(
                                                       'width'  => 176,
                                                       'height' => 187,
                                                       'depth'  => 65536,
                                                       'color'  => 1
                                                       ),
                                    'R692I' => array(
                                                     'width'  => 96,
                                                     'height' => 98,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),

                                    // i-mode compliant HTML 3.0
                                    // (FOMA 2001/2002/2101V)
                                    'N2001' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 4096,
                                                     'color'  => 1
                                                     ),
                                    'N2002' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P2002' => array(
                                                     'width'  => 118,
                                                     'height' => 128,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'D2101V' => array(
                                                      'width'  => 120,
                                                      'height' => 130,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P2101V' => array(
                                                      'width'  => 163,
                                                      'height' => 182,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SH2101V' => array(
                                                       'width'  => 800,
                                                       'height' => 600,
                                                       'depth'  => 65536,
                                                       'color'  => 1
                                                       ),
                                    'T2101V' => array(
                                                      'width'  => 176,
                                                      'height' => 144,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),

                                    // i-mode compliant HTML 4.0
                                    'D504I' => array(
                                                     'width'  => 132,
                                                     'height' => 144,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'F504I' => array(
                                                     'width'  => 132,
                                                     'height' => 136,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'F504IS' => array(
                                                      'width'  => 132,
                                                      'height' => 136,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'N504I' => array(
                                                     'width'  => 160,
                                                     'height' => 180,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'N504IS' => array(
                                                      'width'  => 160,
                                                      'height' => 180,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SO504I' => array(
                                                      'width'  => 120,
                                                      'height' => 112,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'P504I' => array(
                                                     'width'  => 132,
                                                     'height' => 144,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P504IS' => array(
                                                      'width'  => 132,
                                                      'height' => 144,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'D251I' => array(
                                                     'width'  => 132,
                                                     'height' => 144,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'D251IS' => array(
                                                      'width'  => 132,
                                                      'height' => 144,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'F251I' => array(
                                                     'width'  => 132,
                                                     'height' => 140,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'N251I' => array(
                                                     'width'  => 132,
                                                     'height' => 140,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'N251IS' => array(
                                                      'width'  => 132,
                                                      'height' => 140,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'P251IS' => array(
                                                      'width'  => 132,
                                                      'height' => 144,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'F671IS' => array(
                                                      'width'  => 160,
                                                      'height' => 120,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'F212I' => array(
                                                     'width'  => 132,
                                                     'height' => 136,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'SO212I' => array(
                                                      'width'  => 120,
                                                      'height' => 112,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'F661I' => array(
                                                     'width'  => 132,
                                                     'height' => 136,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'F672I' => array(
                                                     'width'  => 160,
                                                     'height' => 120,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'SO213I' => array(
                                                      'width'  => 120,
                                                      'height' => 112,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SO213IS' => array(
                                                       'width'  => 120,
                                                       'height' => 112,
                                                       'depth'  => 65536,
                                                       'color'  => 1
                                                       ),

                                    // i-mode compliant HTML 4.0
                                    // (FOMA 2051/2102V/2701)
                                    'F2051' => array(
                                                     'width'  => 176,
                                                     'height' => 182,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'N2051' => array(
                                                     'width'  => 176,
                                                     'height' => 198,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P2102V' => array(
                                                      'width'  => 176,
                                                      'height' => 198,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P2102V' => array(
                                                      'width'  => 176,
                                                      'height' => 198,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'F2102V' => array(
                                                      'width'  => 176,
                                                      'height' => 182,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'N2102V' => array(
                                                      'width'  => 176,
                                                      'height' => 198,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'N2701' => array(
                                                     'width'  => 176,
                                                     'height' => 198,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),

                                    // i-mode compliant HTML 5.0 (505i etc.)
                                    'D505I' => array(
                                                     'width'  => 240,
                                                     'height' => 270,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'SO505I' => array(
                                                      'width'  => 256,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SH505I' => array(
                                                      'width'  => 240,
                                                      'height' => 252,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'N505I' => array(
                                                     'width'  => 240,
                                                     'height' => 270,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'F505I' => array(
                                                     'width'  => 240,
                                                     'height' => 268,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'P505I' => array(
                                                     'width'  => 240,
                                                     'height' => 266,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'D505IS' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P505IS' => array(
                                                      'width'  => 240,
                                                      'height' => 266,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'N505IS' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SO505IS' => array(
                                                       'width'  => 240,
                                                       'height' => 256,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'SH505IS' => array(
                                                       'width'  => 240,
                                                       'height' => 252,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'F505IGPS' => array(
                                                        'width'  => 240,
                                                        'height' => 268,
                                                        'depth'  => 262144,
                                                        'color'  => 1
                                                        ),
                                    'D252I' => array(
                                                     'width'  => 176,
                                                     'height' => 198,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'SH252I' => array(
                                                      'width'  => 240,
                                                      'height' => 252,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P252I' => array(
                                                     'width'  => 132,
                                                     'height' => 144,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'N252I' => array(
                                                     'width'  => 132,
                                                     'height' => 140,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P252IS' => array(
                                                      'width'  => 132,
                                                      'height' => 144,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'D506I' => array(
                                                     'width'  => 240,
                                                     'height' => 270,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'F506I' => array(
                                                     'width'  => 240,
                                                     'height' => 268,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'N506I' => array(
                                                     'width'  => 240,
                                                     'height' => 295,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'P506IC' => array(
                                                      'width'  => 240,
                                                      'height' => 266,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SH506IC' => array(
                                                       'width'  => 240,
                                                       'height' => 252,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'SO506IC' => array(
                                                       'width'  => 240,
                                                       'height' => 256,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'N506IS' => array(
                                                      'width'  => 240,
                                                      'height' => 295,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SO506I' => array(
                                                      'width'  => 240,
                                                      'height' => 256,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SO506IS' => array(
                                                       'width'  => 240,
                                                       'height' => 256,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'D253I' => array(
                                                     'width'  => 176,
                                                     'height' => 198,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'N253I' => array(
                                                     'width'  => 160,
                                                     'height' => 180,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P253I' => array(
                                                     'width'  => 132,
                                                     'height' => 144,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'D253IWM' => array(
                                                     'width'  => 220,
                                                     'height' => 144,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'P253IS' => array(
                                                      'width'  => 132,
                                                      'height' => 144,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'P213I' => array(
                                                     'width'  => 132,
                                                     'height' => 144,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),

                                    // i-mode compliant HTML 5.0
                                    // (FOMA 900i etc.)
                                    'F900I' => array(
                                                     'width'  => 230,
                                                     'height' => 240,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'N900I' => array(
                                                     'width'  => 240,
                                                     'height' => 269,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'P900I' => array(
                                                     'width'  => 240,
                                                     'height' => 266,
                                                     'depth'  => 65536,
                                                     'color'  => 1
                                                     ),
                                    'SH900I' => array(
                                                      'width'  => 240,
                                                      'height' => 252,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'F900IT' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P900IV' => array(
                                                      'width'  => 240,
                                                      'height' => 266,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'N900IS' => array(
                                                      'width'  => 240,
                                                      'height' => 269,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'D900I' => array(
                                                     'width'  => 240,
                                                     'height' => 270,
                                                     'depth'  => 262144,
                                                     'color'  => 1
                                                     ),
                                    'F900IC' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'F880IES' => array(
                                                       'width'  => 240,
                                                       'height' => 256,
                                                       'depth'  => 65536,
                                                       'color'  => 1
                                                       ),
                                    'N900IL' => array(
                                                      'width'  => 240,
                                                      'height' => 269,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'N900IG' => array(
                                                      'width'  => 240,
                                                      'height' => 269,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SH901IC' => array(
                                                       'width'  => 240,
                                                       'height' => 252,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'F901IC' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'N901IC' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'D901I' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P901I' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'F700I' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SH700I' => array(
                                                      'width'  => 240,
                                                      'height' => 252,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'N700I' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'P700I' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'F700IS' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'SH700IS' => array(
                                                      'width'  => 240,
                                                      'height' => 252,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),

                                    'SH901IS' => array(
                                                       'width'  => 240,
                                                       'height' => 252,
                                                       'depth'  => 262144,
                                                       'color'  => 1
                                                       ),
                                    'F901IS' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'D901IS' => array(
                                                      'width'  => 230,
                                                      'height' => 240,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      ),
                                    'P901IS' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'N901IS' => array(
                                                      'width'  => 240,
                                                      'height' => 270,
                                                      'depth'  => 65536,
                                                      'color'  => 1
                                                      ),
                                    'SH851I' => array(
                                                      'width'  => 240,
                                                      'height' => 252,
                                                      'depth'  => 262144,
                                                      'color'  => 1
                                                      )
                                    );
            }
        }

        return @$displayMap[ strtoupper($model) ];
    }
}

/*
 * Local Variables:
 * mode: php
 * coding: iso-8859-1
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
?>
