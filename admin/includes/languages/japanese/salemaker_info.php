<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: salemaker_info.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'セールの管理(SALE Maker)');
define('SUBHEADING_TITLE', 'セールの管理(SALE Maker)のコツ(Tips):');
define('INFO_TEXT', '<ul>
                      <li>
                        割引率などを表記する際、少数点記号には「\'.\'」を使ってください。
                      </li>
                      <li>
                        商品情報の追加・編集の際と同じ通貨で総額(amounts)を入力してください。
                      </li>
                      <li>
                        割引き欄には率(例: 表示価格から10%引き)・値引き額(例:現価格の500円引き)・値引き後価格(例:価格2,500円)のいずれも入力可能です。
                      </li>
                      <li>
                        価格範囲(price range)を入力すると、影響する商品範囲(product range)を狭めます。
                      </li>
                      <li>
                        特別価格の商品について、セールを適用する場合の操作を選ぶ必要があります。
						<ul>
                          <li>
                            <strong>「特別価格」を無視する - 商品の定価にセールを適用し「特別価格」を無視する</strong><br>
							セールの値引きはその商品のレギュラー価格に適用される。
                            【例】レギュラー価格が1,000円、特別価格が900円、セール適用が10%の場合、特別価格は無視され、セール価格は900円と表示される。
                          </li>
                          <li>
                            <strong>「セール価格」を無視する -「特別価格」がある場合、セールは適用されない</strong><br>
                            セール価格は特別価格品には適用せず、そのまま特別価格が表記されるのみ。
                            【例】レギュラー価格が1,000円、特別価格が950円、セール適用が10%の場合、セール価格は無視され、価格は950円と表示される。
                          </li>
                          <li>
                            <strong>セール価格を「特別価格」に適用する - いずれの場合でもセールを適用する</strong><br>
                            セールの値引きが特別価格の上に適用され、「特別価格」と「セール価格」の複合価格が表示される。
                            【例】レギュラー価格が1,000円、特別価格が900円、セール適用が10%の場合、最終的に表示される商品価格は855円(原文は「$8.55」だが$8.1ではないか?)。特別価格に更に10%オフが適用される。
                          </li>
                        </ul>
                      </li>
                      <li>
                        「開始日」を未記入にしておくと、セールがすぐにスタートします。
                      </li>
                      <li>
                        「終了日」を未記入にすれば、セールは終了しません。</li>
                      <li>
                        カテゴリをチェックすると、そのカテゴリ内のサブカテゴリも自動的に含まれます。
                      </li>
                    </ul>');
define('TEXT_CLOSE_WINDOW', '[ close window ]');
?>