<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ��Ų���� ����ϴ� lib �о���̱�
include_once("$g4[path]/lib/view.skin.lib.php");
?>

<?
// ����ũ��
if ($write[wr_1] > 0)
{
    // ������ ���� ���θ� Ȯ�� (�����۸� �����ǰ� �Խñ��� ���� �ִ� ��찡 ���� �� �����Ƿ�...)
    $unicro_table = "$g4[table_prefix]unicro_item";
    $result = sql_fetch( "select item_no from $unicro_table where bo_table = '$bo_table' and wr_id = '$wr_id' ");
    $item_exist = $result['item_no'];
    
    if ($delete_href && $member['mb_id'] == $view['mb_id'] && $item_exist) {
        $delete_href = "javascript:del('http://unicro{$g4[cookie_domain]}/item/itemDelete.jsp?CHECKID={$write[wr_1]}&asp_url=Y');";
        $target_href = "target=\"_top\"";
    }
    
    if ($update_href && $member['mb_id'] == $view['mb_id'] && $item_exist) {
        $update_href = "http://unicro{$g4[cookie_domain]}/item/itemUpdate.jsp?item_no={$write[wr_1]}&asp_url=Y";
        $target_href = "target=\"_top\"";
    }
    
    $view[content] = $write[wr_content];
}

if ($write_href) 
   $write_href = "$g4[path]/unicro/unicro_select.php?bo_table=$bo_table";

if ($reply_href) 
   $reply_href = "$g4[path]/unicro/unicro_select.php?w=r&bo_table=$bo_table&wr_id=$wr_id";
   

// ��ȭ��ȣ�� ������, �Խñ� ��ϺҰ�
if ($group[gr_id] == "unicro_sel") {
    $time_on = strtotime($view[wr_datetime]) - ($g4['server_time'] - 86400*30);
    if ($time_on > 0)
        $tmp_mb = get_member($write[mb_id], "mb_tel");
        $tel_str = " (tel. $tmp_mb[mb_tel]) ";
}

// ����õ�� ���θ� �� �� �ְ�
if ($member[mb_id] !== $view[mb_id])
    $is_nogood = false;
?>


<!-- �Խñ� ���� ���� -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0" id="view_<?=$wr_id?>"><tr><td>

<!-- ��ũ ��ư -->
<? 
ob_start(); 
?>
<table width='100%' cellpadding=0 cellspacing=0>
<tr height=35>
    <td width=75%>
        <? if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_search_list.gif' border='0' align='absmiddle'></a> "; } ?>
        <? echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>

        <? if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_del.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($good_href) { echo "<a href=\"$good_href\" target='hiddenframe'><img src='$board_skin_path/img/btn_good.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($nogood_href) { echo "<a href=\"$nogood_href\" target='hiddenframe'><img src='$board_skin_path/img/btn_nogood.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\"><img src='$board_skin_path/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>

        <? if ($nosecret_href) { echo "<a href=\"$nosecret_href\"><img src='$board_skin_path/img/btn_nosecret.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($secret_href) { echo "<a href=\"$secret_href\"><img src='$board_skin_path/img/btn_secret.gif' border='0' align='absmiddle'></a> "; } ?>
        <? if ($now_href) { echo "<a href=\"$now_href\"><img src='$board_skin_path/img/btn_now.gif' border='0' align='absmiddle'></a> "; } ?>
    </td>
    <td width=25% align=right>
        <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
        <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    </td>
</tr>
</table>
<?
$link_buttons = ob_get_contents();
ob_end_flush();
?>

<!-- ����, �۾���, ��¥, ��ȸ, ��õ, ����õ -->
<table width="100%" cellspacing="0" cellpadding="0" id="view_Contents">
<tr><td height=2 bgcolor="#0A7299"></td></tr> 
<tr><td height=30 style="padding:5px 0 5px 0;">
    <table width=100% cellpadding=0 cellspacing=0>
    <tr>
    	<td style='word-break:break-all; height:28px;'>&nbsp;&nbsp;<strong>
      <?
        $subject_img = "";
        // ����ũ�� �Ǹ��ߴ�
        if ($view[wr_5] == "�Ǹ�����") 
            $subject_img .= "<img src='$board_skin_path/img/sell_stop.gif' border=0 align=absmiddle > ";
        else if ($view[wr_5] == "�ǸſϷ�")
            $subject_img .= "<img src='$board_skin_path/img/sell__done.gif' border=0 align=absmiddle > ";

        // ����ũ�� �ŷ� - �����ŷ� �̹����� ���
        if ($view[wr_1]) 
            $subject_img .= "<img src='$board_skin_path/img/safe_ico.gif' border=0 align=absmiddle > ";

        // ����ũ�� �ŷ� - �Ǹ��� ������ǰ�ǰ�� 
        if ($view[wr_8]) 
            $subject_img .= "<img src='$board_skin_path/img/secret_ico.gif' border=0 align=absmiddle > ";
      ?>
    	<span id="writeSubject"><?=$subject_img?><? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?><?=cut_hangul_last(get_text($view[wr_subject]))?></span></strong>
    	</td>
    	<td width=230>
    	      <a href="http://thecheat.co.kr/bbs/zboard.php?id=cheat" target="_blank"><b>��ġƮ(���۰˻�)<a/></a>
    	      <a href="javascript:scaleFont(+1);"><img src='<?=$board_skin_path?>/img/icon_zoomin.gif' border=0 title='���� Ȯ��' align=absmiddle></a>
            <a href="javascript:scaleFont(-1);"><img src='<?=$board_skin_path?>/img/icon_zoomout.gif' border=0 title='���� ���' align=absmiddle></a></td>
            <? if ($board['bo_print_level'] && $member[mb_level] >= $board['bo_print_level']) { ?>
            <script type="text/javascript" src="<?=$board_skin_path?>/../print_contents.cheditor.js"></script>
            <a href="#" onclick="javascript:print_contents2('view_Contents', 'commentContents', '<?=$g4[title]?>')"><img src='<?=$board_skin_path?>/img/btn_print.gif' border=0 title='����Ʈ'></a>
            <? }?>
    </tr>
	  <tr><td colspan="2" height=3 style="background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x;"></td></tr>
    </table></td></tr>
<tr><td height=30>
    <span style="float:left;">
    &nbsp;&nbsp;�۾��� : <?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?><? if ($tel_str) echo $tel_str?>&nbsp;&nbsp;&nbsp;&nbsp;
    ��¥ : <?=substr($view[wr_datetime],2,14)?>&nbsp;&nbsp;&nbsp;&nbsp;
    ��ȸ : <?=$view[wr_hit]?>&nbsp;&nbsp;&nbsp;&nbsp;
    <? if ($is_good) { ?><font style="font:normal 11px ����; color:#BABABA;">��õ</font> :<font style="font:normal 11px tahoma; color:#BABABA;"> <?=$view[wr_good]?>&nbsp;&nbsp;&nbsp;&nbsp;<?}?></font>
    <? if ($is_nogood) { ?><font style="font:normal 11px ����; color:#BABABA;">����õ</font> :<font style="font:normal 11px tahoma; color:#BABABA;"> <?=$view[wr_nogood]?>&nbsp;&nbsp;&nbsp;&nbsp;<?}?></font>
    <? if ($trackback_url) { ?><a href="javascript:$.trackback_send_server('<?=$trackback_url?>');" style="letter-spacing:0;" title='�ּ� ����'><img src="<?=$board_skin_path?>/img/icon_trackback.gif" alt="" align="absmiddle"></a><?}?>
    </span>
    <?if ($singo_href) { ?><span style="float:right;padding-right:5px;"><a href="javascript:win_singo('<?=$singo_href?>');"><img src='<?=$board_skin_path?>/img/icon_singo.gif'></a></span><?}?>
    <?if ($unsingo_href) { ?><span style="float:right;padding-right:5px;"><a href="javascript:win_unsingo('<?=$unsingo_href?>');"><img src='<?=$board_skin_path?>/img/icon_unsingo.gif'></a></span><?}?>
</td></tr>

<!-- �Խñ� �ּҸ� �����ϱ� ���� �ϱ� ���ؼ� �Ʒ� �κ��� ���� -->
<tr><td height=30>
        <? $posting_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id"; ?>
        <font style="font:normal 11px ����; color:#BABABA;">&nbsp;&nbsp;�Խñ� �ּ� : <a href="javascript:clipboard_trackback('<?=$posting_url?>');" style="letter-spacing:0;" title='�� ���� �Ұ��� ���� �� �ּҸ� ����ϼ���'><?=$posting_url;?></a></font>
</td></tr>
<tr><td height=1 bgcolor=#E7E7E7></td></tr>

<tr>
    <td height=30>
        <!-- ����ũ�� �ּ� �����ϱ� -->
        <? if ($item_exist) { ?>
        <? $unicro_url = "http://www.unicro.co.kr/main/itemDetail.jsp?item_no=" . $item_exist; ?>
        <font style="font:normal 11px ����; color:#BABABA;">&nbsp;&nbsp;����ũ�� �ּ� : <a href="javascript:clipboard_trackback('<?=$unicro_url?>');" style="letter-spacing:0;" title='����ũ�ο��� �ŷ��� ���� �� �ּҸ� ����ϼ���'><?="$unicro_url";?></a></font>
        <? } ?>
        <? if ($g4[use_bitly]) { ?>
            <? if ($view[bitly_url]) { ?>
            &nbsp;bitly : <span id="bitly_url" class=bitly style="font:normal 11px ����; color:#BABABA;"><a href=<?=$view[bitly_url]?> target=new><?=$view[bitly_url]?></a></span>
            <? } else { ?>
            &nbsp;bitly : <span id="bitly_url" class=bitly style="font:normal 11px ����; color:#BABABA;"></span>
            <script language=javascript>
            // encode �� ���� �Ѱ��ָ�, �˾Ƽ� decode�ؼ� ����� return ���ش�.
            // encode �ϱ� ���� url�� �־�� ����� ���� �� �ֱ� ������, �ᱹ 2���� �Ѱ��ش�.
            // ��? java script������ urlencode, urldecode�� �����ϱ�. ����
            // ���� �̰Ŵ� �������� �ؾ� �Ѵ�. ��??? �׷��� ������ html page�� ������Ʈ ����~!
            get_bitly_g4('#bitly_url', '<?=$bo_table?>', '<?=$wr_id?>');
        </script>
            <?}?>
        <?}?>
        
        <? 
        if ($is_member && $g4[use_gblog]) {
            $gb4_path="../blog";
            include_once("$gb4_path/common.php");
        ?>
        <script language=javascript>
        // gblog���� ���� java script �������� ����
        var gb4_blog        = "<?=$gb4['bbs_path']?>";
        </script>
        <script type="text/javascript"  src="<?="$gb4[path]/js/blog.js"?>"></script>
        <a href="javascript:send_to_gblog('<?=$bo_table?>','<?=$wr_id?>')">��α׷� �ۺ�����</a>
        <? } ?>
</td></tr>
<tr><td height=1 bgcolor=#E7E7E7></td></tr>

<?
// ���� ����
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        //echo "<tr><td height=22>&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle> <a href='{$view[file][$i][href]}' title='{$view[file][$i][content]}'><strong>{$view[file][$i][source]}</strong> ({$view[file][$i][size]}), Down : {$view[file][$i][download]}, {$view[file][$i][datetime]}</a></td></tr>";
        echo "<tr><td height=30>&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle> <a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'><font style='normal 11px ����;'>{$view[file][$i][source]} ({$view[file][$i][size]}), Down : {$view[file][$i][download]}, {$view[file][$i][datetime]}</font></a></td></tr><tr><td height='1'  bgcolor='#E7E7E7'></td></tr>";
    }
}

// ��ũ
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo "<tr><td height=30>&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_link.gif' align=absmiddle> <a href='{$view[link_href][$i]}' target=_blank><font  style='normal 11px ����;'>{$link} ({$view[link_hit][$i]})</font></a></td></tr><tr><td height='1' bgcolor='#E7E7E7'></td></tr>";
    }
}
?>

<!-- <tr><td height=1 bgcolor=#"E7E7E7"></td></tr> //-->
<tr> 
    <td height="150" style='word-break:break-all;padding:10px;'>
    <div id="resContents" class="resContents">

        <?
        $subject_img = "";
        // ����ũ�� �Ǹ��ߴ�
        if ($view[wr_5] == "�Ǹ�����") 
            $subject_img = "<img src='http://unicro.co.kr/images/main/t_txt03.gif' border=0 align=absmiddle > ";
        else if ($view[wr_5] == "�ǸſϷ�")
            $subject_img = "<img src='http://unicro.co.kr/images/main/t_txt02.gif' border=0 align=absmiddle > ";
        if($subject_img)
            echo "<BR>" . $subject_img . "<BR><BR>";
            
        if ($write[wr_1] && !$item_exist)
            echo "<BR><font size=3><b>�� ��ǰ�� ����ũ�ο��� �����Ǿ����ϴ�.<b></font><BR><BR><BR>"
        ?>
        
        <?

        // ���� ���
        ob_start(); 
        for ($i=0; $i<=$view[file][count]; $i++) {
            if ($view[file][$i][view]) {
                echo resize_content($view[file][$i][view]) . "<br/>&nbsp;&nbsp;&nbsp;" . $view[file][$i][content] . "<br/>"; if (trim($view[file][$i][content])) echo "<br/>";
            }
        }
        $file_viewer = ob_get_contents();
        ob_end_clean();

        // �Ű�� �Խñ��� �̹����� �����Ͽ� ����ϱ�
        if ($view['wr_singo'] and trim($file_viewer)) {
            $singo = "<div id='singo_file_title{$view[wr_id]}' class='singo_title'><font color=gray>�Ű� ������ �Խù��Դϴ�. ";
            $singo .= "<span class='singo_here' style='cursor:pointer;font-weight:bold;' onclick=\"document.getElementById('singo_file{$view[wr_id]}').style.display=(document.getElementById('singo_file{$view[wr_id]}').style.display=='none'?'':'none');\"><font color=red>����</font></span>�� Ŭ���Ͻø� ÷�� �̹����� �� �� �ֽ��ϴ�.</font></div>";
            $singo .= "<div id='singo_file{$view[wr_id]}' style='display:none;'><p>";
            $singo .= $file_viewer;
            $singo .= "</div>";
            echo $singo;
        } else {
            echo $file_viewer;
        }
        ?>

        <!-- ���� ��� -->
        <span id="writeContents" class="ct lh">
        <?
            $write_contents=resize_dica($view[content],400,300);
            
            // ������ �̹��� ÷�ΰ� �ִ� ��� 
            $maxmb = $board[bo_image_max_size];
            $curmb = (int) $g4[resize][image_size];
            if ($board[bo_image_info] && $maxmb > 0 && $curmb > $maxmb) {
                $write_msg="<font color=red><b>�̹��� ÷�ΰ� $maxmb kb�� �ʰ��� $curmb kb�̹Ƿ� ����� �� �����ϴ�.<br>������� �̹����� �ٿ��ֽñ� �ٶ��ϴ�.<br></b></font>";
                if (($member[mb_id] && $member[mb_id] == $view[mb_id]) || $is_admin)
                    echo $write_msg;
                else
                    $write_contents = $write_msg;
            }
            echo $write_contents;
        ?>
        </span>

        <?//echo $view[rich_content]; // {�̹���:0} �� ���� �ڵ带 ����� ���?>
        <!-- �׷� �±� ������ --></xml></xmp><a href=""></a><a href=''></a>

        <tr><td height="1" bgcolor="#E7E7E7"></td></tr>
        <? if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // ���� ��� ?>

        <?
        // CCL ����
        $view[wr_ccl] = $write[wr_ccl] = mw_get_ccl_info($write[wr_ccl]);
        ?>

        <? if ($board[bo_ccl] && $view[wr_ccl][by]) { ?>
        <tr style='padding:10px;' class=mw_basic_ccl><td>
        <a rel="license" href="<?=$view[wr_ccl][link]?>" title="<?=$view[wr_ccl][msg]?>" target=_blank><img src="<?=$board_skin_path?>/img/ccls_by.gif">
        <? if ($view[wr_ccl][nc] == "nc") { ?><img src="<?=$board_skin_path?>/img/ccls_nc.gif"><? } ?>
        <? if ($view[wr_ccl][nd] == "nd") { ?><img src="<?=$board_skin_path?>/img/ccls_nd.gif"><? } ?>
        <? if ($view[wr_ccl][nd] == "sa") { ?><img src="<?=$board_skin_path?>/img/ccls_sa.gif"><? } ?>
        </a>
        </td></tr>
        <? } ?>
        
        <? if ($board[bo_related] && $view[wr_related]) { ?>
        <? $rels = mw_related($view[wr_related], $board[bo_related]); ?>
        <? if (count($rels)) {?>
        <tr>
            <td>
            <b>���ñ�</b> : <?=$view[wr_related]?>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                <? for ($i=0; $i<count($rels); $i++) { ?>
                <li> <a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&wr_id=<?=$rels[$i][wr_id]?>"> <?=$rels[$i][wr_subject]?> </a> </li>
                <? } ?>
                </ul>
            </td>
        </tr>
        <? } ?>
        <? } ?>

        <? 
        // �α�˻���
        if ($board[bo_popular]) { 
        
        unset($plist);
        $plist = popular_list($board[bo_popular], $board[bo_popular_days], $bo_table);
        
        if (count($plist) > 0) {
        ?>
        <tr>
            <td>
                <b>�α�˻���</b> : 
                <? 
                for ($i=0; $i<count($plist); $i++) {
                    if (trim($plist[$i][sfl]) == '' || strstr($plist[$i][sfl], '\%7C')) $plist[$i][sfl] = "wr_subject||wr_content";
                ?>
                <a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&sfl=<?=urlencode($plist[$i][sfl])?>&stx=<?=$plist[$i]['pp_word']?>"><?=$plist[$i]['pp_word']?></a>&nbsp;&nbsp;
                <? } ?>
            </td>
        </tr>
        <? } ?>
        <? } ?>
</div>
</td>
</tr>

<?
  if ($view[wr_10]) { // ������ �ִ� ���

    $write_time = strtotime($view[wr_datetime]); // �۾� �ð�
    $before_time = $g4[server_time] - (86400 * 90); // ������ ���� ����
    $diff_time = $write_time - $before_time;
    $view_status = 0;

    if ($view[mb_id] == $member[mb_id] or $is_admin) { // ������ ��쿡�� ������ �����ݴϴ�
      $view_status = 1;
    } else if ($diff_time > 0) { // ������ �Ⱓ �̳��� ���� ��쿡�� �ڸ�Ʈ�� �־�� �����ݴϴ�
      $tmp_write_table = $g4[write_prefix] . $board[bo_table]; // �Խ��� ���̺� �����̸�
      $sql = "select count(*) as cnt from $tmp_write_table where wr_parent = $wr_id and mb_id = '$member[mb_id]' and wr_is_comment = 1";
      $result = sql_fetch($sql);
      if ($result[cnt] > 0) { // �ش�ۿ� �ڸ�Ʈ�� �޾��� ���
        $view_status = 1;
      }
    } else { // ������ ������ ���� ��쿡�� ������ ���� ������ �޾Ҵ� �ڸ�Ʈ�� �־������ �����ݴϴ�
      $tmp_write_table = $g4[write_prefix] . $board[bo_table]; // �Խ��� ���̺� �����̸�
      $min_datetime = date("Y-m-d H:i:s", strtotime($view[wr_datetime]) + (86400 * 30));
      $sql = "select count(*) as cnt from $tmp_write_table where wr_parent = $wr_id and mb_id = '$member[mb_id]' and wr_is_comment = 1 and wr_datetime < '$min_datetime' ";
      $result = sql_fetch($sql);
      if ($result[cnt] > 0) { // �ش�ۿ� ������ �Ⱓ �̳��� �ڸ�Ʈ�� �޾��� ���
        $view_status = 1;
      }
    }

    if ($view_status == 1) {
?>

<tr>
    <td height="50" style='word-break:break-all;padding:10px;'>
    <table width='100%'>
      <tr><td height="1" bgcolor="#E7E7E7" colspan=2></td></tr>
      <tr>
        <td>
        <!--<span id="writeAccount"><?=$view[wr_10];?></span>-->
        <?=nl2br($view[wr_10]);?>
        </td>
        <? if ($view[mb_id] == '$member[mb_id]' or $is_admin) { ?>
        <td width=50>
          <a href="javascript:memo_box()"><img src='<?=$board_skin_path?>/img/btn_modify.gif' border='0' align='absmiddle'></a>
        </td>
        <? } ?>
      </tr>
      <tr>
        <td colspan=1>
          <span id='mart_memo' style='display:none;'>
          <form method="post" name="mart_memo" id="mart_memo">
          <input type="hidden" class="ed" name="bo_table" value="<?=$bo_table?>" />
          <table width='100%'><tr><td>
          <textarea id="wr_10" name="wr_10" class=tx style='width:100%; word-break:break-all;' rows=5 itemname="����ó.����"><?=$view[wr_10]?></textarea>
          </td><td width=50>
          <a href='javascript:memo_update(<?=$wr_id?>)'><img src='<?=$board_skin_path?>/img/btn_c_ok.gif' border='0'/ width=50></a>
          </td></tr></table>
          </form>
          </span>
        </td>
      </tr>
      <script language="JavaScript">
          // �޸�ڽ� toggle
          function memo_box() {
            if (document.getElementById('mart_memo').style.display == 'block')
            {
                document.getElementById('mart_memo').style.display = 'none';
            } else {
                document.getElementById('mart_memo').style.display = 'block';
            }
          }
          // ������ �޸� ������Ʈ
          function memo_update(wr_id) {
              var f = document.mart_memo;
              f.action = "<?=$g4[bbs_path]?>/mart_memo_update.php?wr_id=" + wr_id;
              f.submit();
          }
      </script>
    </table>
    </td>
</tr>
<? } ?>
<? } ?>

<!-- �����ɱ� ��� -->
<? if ($board[bo_hidden_comment]) {
  include_once("$board_skin_path/hidden_comment.skin.php");
} ?>

</table><br>

<?
// ���� �ִ� ��� ���� ����
if (file_exists("$board_skin_path/adsense_view_comment.php"))
    include_once("$board_skin_path/adsense_view_comment.php");

// �ڸ�Ʈ �����
if (!$board['bo_comment_read_level'])
  include_once("./view_comment.php");
else if ($member['mb_level'] >= $board['bo_comment_read_level'])
  include_once("./view_comment.php");
?>

<?=$link_buttons?>

</td></tr>
<tr><td>
<? include_once("$g4[path]/adsense_page_bottom.php"); ?>
</td></tr>
</table><br>

<script type="text/javascript"  src="<?="$g4[path]/js/board.js"?>"></script>
<script language="JavaScript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
    OnclickCheck(document.getElementById("writeContents"), '<?=$config[cf_link_target]?>'); 
}
</script>
<!-- �Խñ� ���� �� -->

<?
// ����ũ��
if ($write[wr_1] > 0)
{
?>
<script>
function link_target()
{
    if (document.getElementById('writeContents')) {
        var target = '_top';
        var link = document.getElementById('writeContents').getElementsByTagName("a");
        for(i=0;i<link.length;i++) {
            if (link[i].target != "_blank")
              link[i].target = target;
        }
    }
}
link_target();
</script>
<? } ?>
