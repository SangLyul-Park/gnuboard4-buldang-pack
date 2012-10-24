<?
include_once("./_common.php");

// Ư������ ��ȯ
function specialchars_replace($str, $len=0) {
    if ($len) {
        $str = substr($str, 0, $len);
    }

    $str = preg_replace("/&/", "&amp;", $str);
    $str = preg_replace("/</", "&lt;", $str);
    $str = preg_replace("/>/", "&gt;", $str);
    return $str;
}

// ����ҰŸ� �ʱ�ȭ
$list= array();

// $bo_table�� ������, RSS ������ ��ü �Խ����� RSS
if ($bo_table == "") {
    // tmp ���̺��� ����ϴ�. RSS ������ �Խ��� ����� ����� ���ؼ�
    // ����ó�� create temporaty table�� ������ ���ִ� ���, ������ �� �����ϴ�. �ý��� ���ϰ� �ʹ� Ŀ��.
    if ($g4['old_stype_search']) {
        goto_url("./rss_list.php");
    } else {
        $sql = "select A.bo_table, A.bo_subject, A.bo_use_rss_view, B.gr_id, B.gr_subject
                  from $g4[board_table] A left join $g4[group_table] B on A.gr_id=B.gr_id 
                 where bo_read_level = 1 and bo_use_search = 1 and gr_use_search = 1 and gr_use_access <> 1 and bo_use_rss_view = 1 
                       order by B.gr_order_search, B.gr_id ";
        $sql_tmp = " create TEMPORARY table list_tmp as $sql ";
        $sql_ord = " select B.* from list_tmp A left join $g4[board_new_table] B on A.bo_table = B.bo_table where wr_is_comment = 0 order by bn_id desc limit 0, 20";
        @mysql_query($sql_tmp) or die("<p>$sql_tmp<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
        $result = @mysql_query($sql_ord) or die("<p>$sql_ord<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
        
        $subj1 = "��ü RSS";
        $subj2 = "�Խ��� RSS ����� $g4[url]/bbs/rss_list.php";
        
        $rsslink = "$g4[url]/bbs/rss_list.php";

        $j = 0;
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $board = get_board($row[bo_table]);
            if (!$board)
                continue;
            $tmp_write_table = $g4[write_prefix] . $row[bo_table];
            $write = sql_fetch(" select * from $tmp_write_table where wr_id = '$row[wr_id]' ");
            $list[$j] = get_list($write, $board, $latest_skin_path, $subject_len);

            $list[$j][url] = "$g4[url]/$g4[bbs]/board.php?bo_table=$row[bo_table]&wr_id=$row[wr_id]";
            $list[$i][bo_table] = $row[bo_table];
            $j++;
        }
    }
} else {
    // ��ȸ�� �бⰡ ������ �Խ��Ǹ� RSS ����
    if ($board[bo_read_level] >= 2) {
        echo "��ȸ�� �бⰡ ������ �Խ��Ǹ� RSS �����մϴ�.";
        exit;
    }
    
    // RSS ��� üũ
    if (!$board[bo_use_rss_view]) {
        echo "RSS ���Ⱑ �����Ǿ� �ֽ��ϴ�.";
        exit;
    }

    // �Խ��� ����
    $subj2 = specialchars_replace($board[bo_subject], 255);
    $lines = $board[bo_page_rows];
    
    // �׷� ����
    $sql = " select gr_subject from $g4[group_table] where gr_id = '$board[gr_id]' ";
    $row = sql_fetch($sql);
    $subj1 = specialchars_replace($row[gr_subject], 255);

    // �Խ��� ������ Feed
    $sql = " select wr_id, wr_subject, wr_content, wr_name, wr_datetime, wr_option, wr_link1, wr_link2, mb_id
               from $g4[write_prefix]$bo_table 
              where wr_is_comment = 0 
                and wr_option not like '%secret%'
              order by wr_num, wr_reply limit 0, $lines ";
    $result = sql_query($sql);

    $rsslink = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table";
    
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list[$i] = $row;
        $list[$i][url] = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$row[wr_id]";
        $list[$i][bo_table] = $bo_table;
    }
}


// RSS ������ XML �������� ���
Header("Content-type: text/xml"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");   

echo "<?xml version=\"1.0\" encoding=\"$g4[charset]\"?>\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
echo "<channel>\n";
echo "<title>".specialchars_replace("$config[cf_title] > $subj1 > $subj2")."</title>\n";
echo "<link>".specialchars_replace("$rsslink")."</link>\n";
echo "<description>�׽�Ʈ ���� 0.2 (2004-04-26)</description>\n";
echo "<language>ko</language>\n";

for ($i=0; $i < count($list); $i++) {

    // $row�� ����ҰŸ� �־��ش�
    $row = $list[$i];
    
    // �Խ����� ������ RSS�� �ƴϸ�, �Խ��� ������ �����´�
    if ($bo_table == "") {
        $board = get_board($row[bo_table]);
        $wr_id = $row[wr_id];
        $write_table = $g4[write_prefix] . $row[bo_table];
    }

    // ��ũ ���
    $link = "";
    for ($j=1; $j<=$g4['link_count']; $j++)
    {
        $lid = $row["wr_link{$j}"];
        if ($lid) {
            $ltext = set_http(get_text($row["wr_link{$j}"]));
            $lhref = "$g4[url]/bbs/link.php?bo_table=$row[bo_table]&wr_id=$row[wr_id]&no=$j";
            $link .= "<p>Link $j : <a href='$lhref' target=_blank>$ltext</a></p>";
        }
    }

    // ÷������ ������ �����´�
    $tmp_file = get_file($row[bo_table], $row['wr_id']);

    // ÷�� �̹��� ���� ���
    $file = "";
    for ($j=0; $j<=count($tmp_file); $j++)
        if ($tmp_file[$j][view])
            $file .= "<p>" . $tmp_file[$j][view] . "</p>";

    if (strstr($row[wr_option], 'html'))
        $html = 1;
    else
        $html = 0;

    // ÷������ �ٿ�ε� ��ũ ���
    if ($board[bo_download_level] == 1) {
        $cnt = 0;
        $download = "";
        for ($j=0; $j<count($tmp_file); $j++) {
            if ($tmp_file[$j][source] && !$tmp_file[$j][view]) {
                $cnt++;
                $dtext = $tmp_file[$j][source];
                $download .= "<p><a href='{$tmp_file[$j][href]}' title='{$tmp_file[$j][source]}'>$dtext </a></p>";
            }
        }
    }

    // ����
    $signature = "";
    if ($board[bo_use_signature]) {
        $mb = get_member($row[mb_id]);
        $signature = $mb[mb_signature];

        //$signature = bad_tag_convert($signature);
        // 081022 : CSRF ���� �������� ���� �ڵ� ����
        $signature = "<p>" . conv_content($signature, 1) . "</p>";
    }

    // �ڸ�Ʈ ���
    $board[bo_comment_read_level] = 10; // �����δ� �ڸ�Ʈ���� �������°Ŵ� rss�� ��Ģ �����̶� mark �صӴϴ�.
    if ($board[bo_comment_read_level] <= 1) {

        $comment = "";

        // �Ҵ��� -- tmp ���̺��� �̿��ؼ� ������ ����� ������ ������ �����Ѵ�
        $sql2 = " select * from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 order by wr_comment, wr_comment_reply ";
        $result2 = sql_query($sql2);
        for ($j=0; $row2=sql_fetch_array($result2); $j++) 
        {
            $comment .= "<table width=100% cellpadding=0 cellspacing=0>";
            $comment .= "<tr><td>";
            for ($k=0; $k<strlen($row2[wr_comment_reply]); $k++) $comment .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $comment .= "</td>";

            $comment .= "<td width=100% align=left><div style='float:left; margin:2px 0 0 2px;'>";
            $comment .= "$row2[wr_name] | " . get_date($row2[wr_datetime]) . " | ";
            $comment .= "</div>";

            $comment .= "<div style='line-height:20px; padding:7px; word-break:break-all; overflow:hidden; clear:both;'>";
            if (!strstr($row2[wr_option], "secret") || $row[wr_singo])
                $comment .= conv_content($row2[wr_content], 0, 'wr_content');
            else
                $comment .= "<font color=red>*��б� �Դϴ�.</font>";

            $comment .= "</div></td></tr>";
            $comment .= "</table>";
        }
    }

    echo "<item>\n";
    echo "<title>".specialchars_replace($row[wr_subject])."</title>\n";
    echo "<link>".specialchars_replace("$row[url]")."</link>\n";
    echo "<description><![CDATA[". $download . $link . $file . conv_content($row[wr_content], $html). $signature . $comment . "]]></description>\n";
    echo "<dc:creator>".specialchars_replace($row[wr_name])."</dc:creator>\n";
    $date = $row[wr_datetime];
    // rss ���� ��Ų���� ȣ���ϸ� ��¥�� ����� ǥ�õ��� ����
    //$date = substr($date,0,10) . "T" . substr($date,11,8) . "+09:00";
    $date = date('r', strtotime($date));
    echo "<dc:date>$date</dc:date>\n";
    echo "</item>\n";
}

echo "</channel>\n";
echo "</rss>\n";
?>
