#!/usr/bin/perl
# ---------------------------------------------------------------- #
#   AjaxZip 2.0 - Ajax郵便番号→住所自動入力フォーム（CGI不要版）用
#   郵便番号一覧 CSV ファイルを JSON 形式に変換するスクリプト
#   http://www.kawa.net/works/ajax/ajaxzip2/ajaxzip2.html
#   (c) 2001-2007 Kawasaki Yusuke. All rights reserved.
# ---------------------------------------------------------------- #
    use strict;
    use utf8;
    use Encode;                     # 文字コード変換モジュール弾
    use lib qw( lib );
    use JSON;                       # JSON.pm がデフォルトです
#   use JSON::Syck;                 # JSON::Syckがあれば利用可能です
# ---------------------------------------------------------------- #
    my $VERSION   = '2.11';
    my $CSV_ENC   = 'CP932';        # CSVファイルのエンコーディング
    my $JSON_ENC  = 'utf8';         # JSONファイルのエンコーディング
    my $DISP_ENC  = 'utf8';         # 表示用のエンコーディング
    my $CSV_FILE  = 'ken_all.csv';  # 入力元CSVファイル名（デフォルト）
    my $CSV_JIGYO = 'jigyosyo.csv'; # 事業所要郵便番号CSVファイル（オプション）
    my $JSON_BASE = '../data/zip-%s.json';  # 出力先JSONファイル名
# ---------------------------------------------------------------- #
    # local $| = 1;
    &main( @ARGV );
# ---------------------------------------------------------------- #
sub main {
    my $csvfile  = shift || $CSV_FILE;
    my $csvjigyo = shift || $CSV_JIGYO;

    my $out = {};
    &read_ken_all( $out, $csvfile );
    &read_jigyosyo( $out, $csvjigyo )
    &write_json( $out );
}
# ---------------------------------------------------------------- #
# 読み仮名データの促音・拗音を小書きで表記したもの
# http://www.post.japanpost.jp/zipcode/dl/kogaki.html
# http://www.post.japanpost.jp/zipcode/dl/kogaki/lzh/ken_all.lzh
# ---------------------------------------------------------------- #
sub read_ken_all {
    my $out     = shift or return;
    my $csvfile = shift;
    my $prev    = "";
    my $c       = 0;

    print STDERR "ken_all:\t$csvfile\n";
    open( CSV, $csvfile ) or die "$! - $csvfile\n";
    while ( my $iline = <CSV> ) {
        last if ( $iline =~ /^\x1a/ );  # EOF

        # UTF-8コードで処理する
        $iline = Encode::decode( $CSV_ENC, $iline );

        # CSVとはいっても「,」の文字は住所には利用されていないので簡易処理
        my @r = split( ",", $iline );
        s/^"(.*)"$/$1/s foreach ( @r );

        # 第1・3・10・15カラムは、確実に数字のみのハズ
        if ( $r[0]  !~ m#^\d{5}$# ||
             $r[2]  !~ m#^\d{7}$# ||
             $r[9]  !~ m#^\d{1}$# ||
             $r[14] !~ m#^\d{1}[\r\n]+$# ) {
            die "Invalid Data Source: $csvfile (ken_all.csv)\n$iline\n";
        }

        # 全角かっこ『（』が入る場合は、フリガナからも半角かっこ『(』を除外
        if ( $r[8] =~ s/（(.)+$//s ) {
            $r[5] =~ s/\([^\(]+$//s;
        }

        # 岩手県    和賀郡西和賀町  杉名畑４４地割
        # 岩手県    和賀郡西和賀町  穴明２２地割、穴明２３地割
        # 岩手県    九戸郡洋野町    種市第１５地割～第２１地割
        $r[8] =~ s/(第)?(０|１|２|３|４|５|６|７|８|９)+地割.*$//s;

        #『以下に掲載がない場合』等は削除してしまう
        if ( $r[8] =~ /(^以下に掲載がない場合
                        |の次に番地がくる場合
                        |一円
                        |）
                        |、(.)*
                        )$/xs ) {
            $r[8] = "";
            $r[5] = "";
        }

        # 郵便番号上位3桁
        my $zip3 = ( $r[2] =~ /^([0-9]{3})/ )[0];

        # 都道府県ID・市町村名・町域名のみ記録
        $out->{$zip3} ||= {};
        my $pref = int($r[0]/1000);
        $out->{$zip3}->{$r[2]} ||= [ $pref, $r[7], $r[8] ];

        # 都道府県が変わったら、画面に都道府県名を表示する
        if ( $prev ne $pref ) {
            $prev = $pref;
            print STDERR " $c lines\n" if $c;
            my $v = sprintf( "%s  \t", $r[6] );
            $v = Encode::encode( $DISP_ENC, $v );
            print STDERR $v;
            $c = 0;
        }
        print STDERR "." if ( $c ++ % 200 == 0 );
    }
    print STDERR " $c lines\n" if ( $c > 0 );
    close( CSV );
    $out;
}
# ---------------------------------------------------------------- #
# 事業所の個別郵便番号
# http://www.post.japanpost.jp/zipcode/dl/jigyosyo/index.html
# http://www.post.japanpost.jp/zipcode/dl/jigyosyo/lzh/jigyosyo.lzh
# ---------------------------------------------------------------- #
sub read_jigyosyo {
    my $out      = shift or return;
    my $csvjigyo = shift or return;
    my $prev     = "";
    my $c        = 0;

    return unless ( -f $csvjigyo );

    print STDERR "jigyosyo:\t$csvjigyo\n";
    open( JIGYO, $csvjigyo ) or die "$! - $csvjigyo\n";
    while ( my $iline = <JIGYO> ) {
        last if ( $iline =~ /^\x1a/ );  # EOF

        # UTF-8コードで処理する
        $iline = Encode::decode( $CSV_ENC, $iline );

        # CSVとはいっても「,」の文字は住所には利用されていないので簡易処理
        my @r = split( ",", $iline );
        s/^"(.*)"$/$1/s foreach ( @r );

        # 第1・8・11・13カラムは、確実に数字のみのハズ
        if ( $r[0]  !~ m#^\d{5}$# ||
             $r[7]  !~ m#^\d{7}$# ||
             $r[10] !~ m#^\d{1}$# ||
             $r[12] !~ m#^\d{1}[\r\n]+$# ) {
            die "Invalid Data Source: $csvjigyo (jigyosyo.csv)\n$iline\n";
        }

        # 全角かっこ『（）』や『１Ｆ～９Ｆ』を削除
        $r[6] =~ s/（.*）$//s;
        $r[6] =~ s/(－)?((０|１|２|３|４|５|６|７|８|９)+(Ｆ|階|～|、)+)+
                   (０|１|２|３|４|５|６|７|８|９)+(Ｆ|階)$//sx;

        # 郵便番号上位3桁
        my $zip3 = ( $r[7] =~ /^([0-9]{3})/ )[0];

        # 都道府県ID・市町村名・町域名・番地を記録
        $out->{$zip3} ||= {};
        my $pref = int($r[0]/1000);
        $out->{$zip3}->{$r[7]} ||= [ $pref, $r[4], $r[5], $r[6] ];

        # 都道府県が変わったら、画面に都道府県名を表示する
        if ( $prev ne $pref ) {
            $prev = $pref;
            print STDERR " $c lines\n" if $c;
            my $v = sprintf( "%s  \t", $r[3] );
            $v = Encode::encode( $DISP_ENC, $v );
            print STDERR $v;
            $c = 0;
        }
        print STDERR "." if ( $c ++ % 200 == 0 );
    }
    print STDERR " $c lines\n" if ( $c > 0 );
    close( JIGYO );
    $out;
}
# ---------------------------------------------------------------- #
# 郵便番号上位3桁ごとにJSONファイルに書き出していく
# ---------------------------------------------------------------- #
sub write_json {
    my $out  = shift or return;
    my $prev = "";
    my $c    = 0;

    my $use_syck = $JSON::Syck::VERSION;
    my $use_json = $JSON::VERSION unless $use_syck;
    my $new_json = (( $use_json =~ /^([\d\.]+)/ )[0] >= 2.0 ) if $use_json;

    print STDERR "module: \tJSON.pm ($use_json)\n" if $use_json;
    print STDERR "module: \tJSON::Syck ($use_syck)\n" if $use_syck;
    print STDERR "json:   \t$JSON_BASE\n";

    foreach my $zip3 ( sort keys %$out ) {
        # JSONフォーマットでダンプする
        my $data = $out->{$zip3};
        my $dump = $use_syck ? JSON::Syck::Dump($data) : 
                   $new_json ? to_json($data) : objToJson($data);

        # JSONファイル名の決定
        my $jsonfile = sprintf( $JSON_BASE, $zip3 );

        # JSONファイル設置ディレクトリの確認
        my $jsondir = ( $jsonfile =~ m#^(.*/)[^/]+$# )[0];
        die "$! - $jsondir\n" if ( $jsondir && ! -d $jsondir );

        # JSONファイルに書き出す
        open( JSON, "> $jsonfile" ) or die "$! - $jsonfile\n";
        $dump = Encode::encode( $JSON_ENC, $dump ) if $new_json;
        print JSON $dump, "\n";
        close( JSON );

        # 郵便番号上位1桁が変わったら表示する
        my $zip1 = ( $zip3 =~ /^([0-9])/ )[0];
        if ( $prev ne $zip1 ) {
            $prev = $zip1;
            print STDERR " $c files\n" if $c;
            printf STDERR ( "$JSON_BASE  ", "$zip1**" );
            $c = 0;
        }
        print STDERR "." if ( $c ++ % 10 == 0 );
    }
    print STDERR " $c files\n" if ( $c > 1 );
}
# ---------------------------------------------------------------- #
