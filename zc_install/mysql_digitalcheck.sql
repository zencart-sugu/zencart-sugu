# デジタルチェック用決済テーブル
CREATE TABLE digitalcheck_transactions (
  sids              int(11)     NOT NULL auto_increment,
  fuka              varchar(32) default '',
  customers_id      int(11)     default 0,
  orders_id         int(11)     default 0,
  type              varchar(16) default '',
  status            varchar(16) default '',
  request           text        default NULL,
  response          text        default NULL,
  created_at        datetime    default '0001-01-01 00:00:00',
  finish_payment_id varchar(16) default '',
  finish_payment_at datetime    default '0001-01-01 00:00:00',
  PRIMARY KEY (sids)
) TYPE=MyISAM;
