<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

/* mnb ����
�������� : http://html.nhncorp.com/uio_factory/ui_pattern/lnb/1

NHN�� �޴� java script�� ������� �ʽ��ϴ�.
�̰��� ���� �ִϸ��̼ǵ� �̻ڰ� ������, ���õ� �޴��� class�� ��������,
SUB �޴��� �Ⱦ��� �����Դϴ�.
<script type="text/javascript" src="<?=$g4[layout_skin_path]?>/menu.naver.js"></script>

submenu�� �ִ� ���, span�� class="i"�� ���� �մϴ�.
<li><a class="m10" id="qna" href="http://www.bugsboard.co.kr" target=_new><span>����4<span class="i"></span></span></a></a></li>
*/

$mnb_arr[] = array('id'=>'home', 'name'=>'Ȩ����', 'href'=>"$g4[url]" );
if ($is_member) {
    $mnb_arr[] = array('id'=>'myon', 'name'=>'MyOn', 'href'=>"$g4[bbs_path]/whatson.php?rows=30&check=1&mnb=myon" );

    // ���� �Խ����� $snb�� ������ �ݴϴ�.
    $my_menu = array();
    $sql = "select m.bo_table, b.bo_subject from $g4[my_menu_table] as m left join $g4[board_table] as b on m.bo_table = b.bo_table where mb_id = '$member[mb_id]'";
    $qry = sql_query($sql);
    while ($row = sql_fetch_array($qry)) {
        $snb_arr[myboard][] = array('id'=>"{$row[bo_table]}", 'name'=>"{$row[bo_subject]}");
    }

    // ���� �湮�� �Խ����� $snb�� ������ �ݴϴ�.
    $sql = " select b.bo_table, b.bo_subject, a.my_datetime from $g4[my_board_table] a left join $g4[board_table] b on a.bo_table = b.bo_table
              where a.mb_id = '$member[mb_id]' group by b.bo_table order by a.my_datetime desc limit 0, 10 ";
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $bo_subject = cut_str($row[bo_subject], 20);
        $snb_arr[myvisit][] = array('id'=>"$row[bo_table]", 'name'=>"$bo_subject");
    }

    // ��Ÿ 
    $snb_arr[myon][] = array('id'=>'whatson', 'name'=>'Whats On', 'href'=>"$g4[bbs_path]/whatson.php?rows=30&check=1");
    if ($member[mb_level] >= 3 && $g4['member_suggest_join'])
        $snb_arr[myon][] = array('id'=>'suggest', 'name'=>'ȸ��������õ', 'href'=>"$g4[path]/plugin/recommend/");
    $snb_arr[myon][] = array('id'=>'bar', 'type'=>'bar', 'style'=>'height:1px; color:#e9e9e9; background:#e9e9e9; font-size:1em; border:0;');
    $snb_arr[myon][] = array('id'=>'mypost', 'name'=>'���� �ֱ� �Խñ�', 'href'=>"$g4[bbs_path]/new.php?gr_id=&mb_id=$member[mb_id]");
    $snb_arr[myon][] = array('id'=>'mycomment', 'name'=>'�����ø��ڸ�Ʈ', 'href'=>"$g4[bbs_path]/new.php?gr_id=&mb_id=$member[mb_id]&view_type=c");
    $snb_arr[myon][] = array('id'=>'my_reading', 'name'=>'���� ���� ��', 'href'=> "$g4[path]/modules/my_read_list.php"  );
    $snb_arr[myon][] = array('id'=>'scrap', 'name'=>'��ũ��', 'href'=>"$g4[bbs_path]/scrap.php?head_on=1");
    $snb_arr[myon][] = array('id'=>'bar', 'type'=>'bar', 'style'=>'height:1px; color:#e9e9e9; background:#e9e9e9; font-size:1em; border:0;');
    $snb_arr[myon][] = array('id'=>'gooded', 'name'=>'��õ�� ��', 'href'=>"$g4[bbs_path]/my_good_ed.php?head_on=1");
    $snb_arr[myon][] = array('id'=>'nogooded', 'name'=>'����õ�� ��', 'href'=>"$g4[bbs_path]/my_good_ed.php?w=nogood&head_on=1");
    $snb_arr[myon][] = array('id'=>'good', 'name'=>'���� ��õ�� ��', 'href'=>"$g4[bbs_path]/my_good.php?head_on=1");
    $snb_arr[myon][] = array('id'=>'nogood', 'name'=>'���� ����õ�� ��', 'href'=>"$g4[bbs_path]/my_good.php?w=nogood&head_on=1");
    $snb_arr[myon][] = array('id'=>'bar', 'type'=>'bar', 'style'=>'height:1px; color:#e9e9e9; background:#e9e9e9; font-size:1em; border:0;');
    if ($config[cf_use_recycle])
        $snb_arr[myon][] = array('id'=>'trash', 'name'=>'������', 'href'=>"$g4[bbs_path]/recycle_list.php");
    $snb_arr[myon][] = array('id'=>'intercept', 'name'=>'�Ű�� �Խñ�', 'href'=> "$g4[bbs_path]/singo_search.php"  );
    $snb_arr[myon][] = array('id'=>'1to1_bkup', 'name'=>'�Ű��� ���۵�' );
    //$snb_arr[myon][] = array('id'=>'hidden_comment_search', 'name'=>'������ �Խñ�', 'href'=> "$g4[bbs_path]/hidden_comment_search.php"  );

}
$mnb_arr[] = array('id'=>'talk', 'name'=>'��ũ' );
$mnb_arr[] = array('id'=>'tips', 'name'=>'������' );
$mnb_arr[] = array('id'=>'gnu4', 'name'=>'�״�����4' );
$mnb_arr[] = array('id'=>'gnu4_b4', 'name'=>'�Ҵ���' );
$mnb_arr[] = array('id'=>'mart', 'name'=>'����.�Ҽ�' );
$mnb_arr[] = array('id'=>'gblog', 'name'=>'����α�' );
$mnb_arr[] = array('id'=>'club2', 'name'=>'Ŭ��2' );
$mnb_arr[] = array('id'=>'android', 'name'=>'�����' );
$mnb_arr[] = array('id'=>'yc4', 'name'=>'��īƮ4' );
$mnb_arr[] = array('id'=>'bugs4', 'name'=>'����4', 'new'=>'1', 'href'=>'http://www.bugsboard.co.kr' );
$mnb_arr[] = array('id'=>'info', 'name'=>'�����ڵ�', 'hidden'=>'1' );

// snb �鿩 ���� ����, $snb_arr�� �������� ���ǵǴ� �ٸ� ��Ż�� ������ �װ͵� �� �߰��ϸ� �˴ϴ�.
$snb_indent = "text-align:left;margin-left:20px;";

/*
snb - ���� side �޴��� ����

$snb_arr[id]�� id���� ���� $mnb_arr�� id ���� �־��ִµ�, $mnb�� ���� �ȵ� ��쿡�� ����� ������ �˴ϴ�.

$snb_arr�� id�� �׳� ���Ƿ� ���� �˴ϴ�. 
�ߺ� �Ǹ� ���� �� ���� ������ �ߺ� �ȵǰ� "$mnb_�������" �� ���� �ϴ°� ��������,
�����ϱ� ���� �̸� ������ �� �����ϴ�.
*/
$snb_arr[talk][] = array('id'=>'talk_check', 'name'=>'�⼮üũ', 'href'=>"$g4[plugin_path]/attendance/attendance.php" );
$snb_arr[talk][] = array('id'=>'guestbook', 'name'=>'����', 'href'=>"$g4[plugin_path]/guestbook/guestbook.php" );
$snb_arr[talk][] = array('id'=>'notice', 'style'=>'font-weight: bold');
$snb_arr[talk][] = array('id'=>'talk_best', 'name'=>'����Ʈ��', 'href'=>"$g4[bbs_path]/good_list.php" );
$snb_arr[talk][] = array('id'=>'talk_new', 'name'=>'�ֱٰԽñ�', 'href'=>"$g4[bbs_path]/new.php" );
$snb_arr[talk][] = array('id'=>'bar', 'type'=>'bar', 'style'=>'height:1px; color:#e9e9e9; background:#e9e9e9; font-size:1em; border:0;');
$snb_arr[talk][] = array('id'=>'qna', 'name'=>'��㳪����');
$snb_arr[talk][] = array('id'=>'g4_100', 'name'=>'�״�����100�Ͽϼ�');
$snb_arr[talk][] = array('id'=>'g4_books', 'name'=>'�״���������');
$snb_arr[talk][] = array('id'=>'gnu4_pack_req', 'name'=>'�Ҵ��ѹ��׹װ���');
$snb_arr[talk][] = array('id'=>'gnu4_pack_qna', 'name'=>'�״����幯����ϱ�');
$snb_arr[talk][] = array('id'=>'bar', 'type'=>'bar', 'style'=>'height:1px; color:#e9e9e9; background:#e9e9e9; font-size:1em; border:0;');
$snb_arr[talk][] = array('id'=>'sitetips', 'name'=>'����Ʈ���߿');
$snb_arr[talk][] = array('id'=>'biz', 'name'=>'����Ͻ������ڷ�');
$snb_arr[talk][] = array('id'=>'budongsan', 'name'=>'�Ӵ���ũ');
$snb_arr[talk][] = array('id'=>'gabia', 'name'=>'�����', 'img'=>"$g4[path]/img/banner/gabia.gif", 'href'=>"http://www.gabia.com", 'new'=>'1' );

$snb_arr[test][] = array('id'=>'talk_test', 'name'=>'�׽�Ʈ', 'href'=>"$g4[bbs_path]/board.php?bo_table=test2" );
$snb_arr[test][] = array('id'=>'talk_test2', 'name'=>'�׽�Ʈ2', 'href'=>"$g4[bbs_path]/board.php?bo_table=test" );
$snb_arr[test][] = array('id'=>'test_banner', 'name'=>'��� �׽�Ʈ');

$snb_arr[tips][] = array('id'=>'tips_linux_tips', 'name'=>'Linux', 'href'=>"$g4[bbs_path]/board.php?bo_table=linux_tips" );
$snb_arr[tips][] = array('id'=>'tips_apache_tips', 'name'=>'Apache', 'href'=>"$g4[bbs_path]/board.php?bo_table=apache_tips" );
$snb_arr[tips][] = array('id'=>'tips_mysql_tips', 'name'=>'MySQL', 'href'=>"$g4[bbs_path]/board.php?bo_table=mysql_tips" );
$snb_arr[tips][] = array('id'=>'tips_php_tips', 'name'=>'PHP', 'href'=>"$g4[bbs_path]/board.php?bo_table=php_tips" );
$snb_arr[tips][] = array('id'=>'tips_html_tips', 'name'=>'HTML', 'href'=>"$g4[bbs_path]/board.php?bo_table=html_tips" );
$snb_arr[tips][] = array('id'=>'tips_html5_tips', 'name'=>'HTML5', 'href'=>"$g4[bbs_path]/board.php?bo_table=html5_tips" );
$snb_arr[tips][] = array('id'=>'tips_css', 'name'=>'CSS', 'href'=>"$g4[bbs_path]/board.php?bo_table=css" );
$snb_arr[tips][] = array('id'=>'tips_javascript_tips', 'name'=>'Java Script', 'href'=>"$g4[bbs_path]/board.php?bo_table=javascript_tips" );
$snb_arr[tips][] = array('id'=>'tips_jquery_tips', 'name'=>'jQuery', 'href'=>"$g4[bbs_path]/board.php?bo_table=jquery_tips" );
$snb_arr[tips][] = array('id'=>'tips_ajax', 'name'=>'AJAX', 'href'=>"$g4[bbs_path]/board.php?bo_table=ajax" );
$snb_arr[tips][] = array('id'=>'tips_other_tips', 'name'=>'��Ÿ ����', 'href'=>"$g4[bbs_path]/board.php?bo_table=other_tips" );
$snb_arr[tips][] = array('id'=>'tips_cheditor', 'name'=>'cheditor(���)', 'href'=>"$g4[bbs_path]/board.php?bo_table=cheditor" );

$snb_arr[gnu4_b4][] = array('id'=>'b4_gnu4_pack', 'name'=>'�״�����Ҵ���', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_pack" );
$snb_arr[gnu4_b4][] = array('id'=>'b4_gnu4_pack_book', 'name'=>'�Ҵ��� �Ŵ���', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_pack_book" );
$snb_arr[gnu4_b4][] = array('id'=>'b4_gnu4_pack_skin', 'name'=>'�Ҵ��� ��Ų', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_pack_skin" );
$snb_arr[gnu4_b4][] = array('id'=>'b4_gnu4_pack_req', 'name'=>'�Ҵ��� ���� �� ����', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_pack_req" );
$snb_arr[gnu4_b4][] = array('id'=>'b4_gnu4_pack_qna', 'name'=>'�Ҵ��� ������ϱ�', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_pack_qna" );

$snb_arr[gblog][] = array('id'=>'gblog_gblog4', 'name'=>'gblog �Ҵ����', 'href'=>"$g4[bbs_path]/board.php?bo_table=gblog" );
$snb_arr[gblog][] = array('id'=>'gblog_index', 'name'=>'gblog �׽�Ʈ', 'href'=>"$g4[path]/blog/", 'new'=>'1' );

$snb_arr[club2][] = array('id'=>'club_club2', 'name'=>'Ŭ��2', 'href'=>"$g4[bbs_path]/board.php?bo_table=club2" );
$snb_arr[club2][] = array('id'=>'club_test_club2', 'name'=>'Ŭ��2 �׽�Ʈ', 'href'=>"$g4[path]/club/", 'new'=>'1' );

$snb_arr[android][] = array('id'=>'and_talk', 'name'=>'�ȵ���̵� �Խ���', 'href'=>"$g4[bbs_path]/board.php?bo_table=and_talk" );
$snb_arr[android][] = array('id'=>'and_tip', 'name'=>'�ȵ���̵� ��', 'href'=>"$g4[bbs_path]/board.php?bo_table=and_tip" );
$snb_arr[android][] = array('id'=>'and_pds', 'name'=>'�ȵ���̵� �ڷ��', 'href'=>"$g4[bbs_path]/board.php?bo_table=and_pds" );
$snb_arr[android][] = array('id'=>'webapp', 'name'=>'����', 'href'=>"$g4[bbs_path]/board.php?bo_table=webapp" );

$snb_arr[gnu4][] = array('id'=>'gnu4_gnu4_turning', 'name'=>'�״�����4 Ʃ��', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_turning" );
$snb_arr[gnu4][] = array('id'=>'gnu4_gnu4_turning2', 'name'=>'�״�����4 Ʃ��(�����)', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_turning2" );
$snb_arr[gnu4][] = array('id'=>'gnu4_memo4', 'name'=>'����5', 'href'=>"$g4[bbs_path]/board.php?bo_table=memo4" );
$snb_arr[gnu4][] = array('id'=>'gnu4_thumb', 'name'=>'�Ҵ��/Resize', 'href'=>"$g4[bbs_path]/board.php?bo_table=thumb" );
$snb_arr[gnu4][] = array('id'=>'gnu4_builder', 'name'=>'�Ҵ����(100%��������)', 'href'=>"$g4[bbs_path]/board.php?bo_table=layout" );
$snb_arr[gnu4][] = array('id'=>'gnu4_recycle', 'name'=>'������/Recycle', 'href'=>"$g4[bbs_path]/board.php?bo_table=g4_recycle" );
$snb_arr[gnu4][] = array('id'=>'gnu4_unicro', 'name'=>'����ũ������/�Խ���', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_unicro" );
$snb_arr[gnu4][] = array('id'=>'gnu4_skin', 'name'=>'�״����彺Ų', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_skin" );
$snb_arr[gnu4][] = array('id'=>'gnu4_tips', 'name'=>'�״�������', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_tips" );
$snb_arr[gnu4][] = array('id'=>'gnu4_qna', 'name'=>'�״����� ���� ���ϱ�', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_qna" );

$snb_arr[tobe][] = array('id'=>'gnu4_contentsmall', 'name'=>'��������4', 'href'=>"$g4[bbs_path]/board.php?bo_table=g4_contents" );
$snb_arr[tobe][] = array('id'=>'gnu4_gcash4', 'name'=>'gcash4', 'href'=>"$g4[bbs_path]/board.php?bo_table=gnu4_gcash" );
$snb_arr[tobe][] = array('id'=>'gnu4_popup2', 'name'=>'�˾�������2', 'href'=>"$g4[bbs_path]/board.php?bo_table=popup2" );

$snb_arr[mart][] = array('id'=>'checkout', 'name'=>'���̹� üũ�ƿ�');
$snb_arr[mart][] = array('id'=>'social_pack', 'name'=>'�״����� �Ҽ���', 'href'=>"$g4[bbs_path]/board.php?bo_table=social_pack" );
$snb_arr[mart][] = array('id'=>'social_qna', 'name'=>'�Ҽ��� ������ϱ�', 'href'=>"$g4[bbs_path]/board.php?bo_table=social_qna" );
$snb_arr[mart][] = array('id'=>'mart_download', 'name'=>'�Ҵ�����', 'href'=>"$g4[bbs_path]/board.php?bo_table=mart_download" );
$snb_arr[mart][] = array('id'=>'mart_info', 'name'=>'�Ҵ����� ����', 'href'=>"$g4[bbs_path]/board.php?bo_table=mart_info" );
$snb_arr[mart][] = array('id'=>'mart_qna', 'name'=>'�Ҵ����� ������ϱ�', 'href'=>"$g4[bbs_path]/board.php?bo_table=mart_qna" );
$snb_arr[mart][] = array('id'=>'test_mart', 'name'=>'�Ҵ����� �׽�Ʈ', 'href'=>"$g4[path]/mart/", 'new'=>'1' );

$snb_arr[yc4][] = array('id'=>'yc4_pack', 'name'=>'��4 �Ҵ��� ����', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_pack" );
$snb_arr[yc4][] = array('id'=>'yc4_pack_qna', 'name'=>'��4 �Ҵ��� ������ϱ�', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_pack_qna" );
$snb_arr[yc4][] = array('id'=>'yc4_pack_tips_open', 'name'=>'��4 �Ҵ��� ��', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_pack_tips_open" );
$snb_arr[yc4][] = array('id'=>'yc4_turning', 'name'=>'�ҿ�4 �Ҵ��� Ʃ��', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_turning" );
$snb_arr[yc4][] = array('id'=>'yc4_pack_download', 'name'=>'�ҿ�4 �Ҵ��� �ٿ�(ȸ��)', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_pack_download" );
$snb_arr[yc4][] = array('id'=>'yc4_pack_book', 'name'=>'��4 �Ҵ��� �Ŵ���(ȸ��)', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_pack_book" );
$snb_arr[yc4][] = array('id'=>'test_yc4', 'name'=>'��īƮ4 �׽�Ʈ', 'href'=>"http://www.diorshop.co.kr", 'new'=>'1' );

$snb_arr[yc4_old][] = array('id'=>'yc4_tips', 'name'=>'��īƮ4 ��', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_tips" );
$snb_arr[yc4_old][] = array('id'=>'yc4_tips_hidden', 'name'=>'��īƮ4 ��(ȸ�� only)', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_tips_hidden" );
$snb_arr[yc4_old][] = array('id'=>'yc4_tips_op', 'name'=>'����īƮ4 ������ϱ�', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_tips_op" );
$snb_arr[yc4_old][] = array('id'=>'yc4_tips_tobe', 'name'=>'��īƮ4 HELP', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_tips_tobe" );
$snb_arr[yc4_old][] = array('id'=>'yc4_tips_fixed', 'name'=>'��īƮ4 Fixed', 'href'=>"$g4[bbs_path]/board.php?bo_table=yc4_tips_fixed" );

// ��ܺ� �޴����� ����, �ʿ�ÿ� sub���� ������ ȸ������
$snb_arr[info][] = array('id'=>'talk_notice', 'name'=>'��������', 'href'=>"$g4[bbs_path]/board.php?bo_table=notice" );
$snb_arr[info][] = array('id'=>'privacy', 'name'=>'����������ȣ��ħ', 'href'=>"$g4[path]/company/privacy.php" );
$snb_arr[info][] = array('id'=>'service', 'name'=>'�̿���', 'href'=>"$g4[path]/company/service.php" );
$snb_arr[info][] = array('id'=>'disclaimer', 'name'=>'å���Ѱ�͹�������', 'href'=>"$g4[path]/company/disclaimer.php" );
$snb_arr[info][] = array('id'=>'rejection', 'name'=>'�̸����ּҹ��ܼ����ź�', 'href'=>"$g4[path]/company/rejection.php" );

?>