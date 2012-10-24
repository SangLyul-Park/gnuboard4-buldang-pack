<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

include_once("$board_skin_path/auction.lib.php");

// ���ÿɼ����� ���� ����ġ�Ⱑ ���������� ����
$colspan = 7;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// ������ ���ٷ� ǥ�õǴ� ��� �� �ڵ带 ����� ������.
// <nobr style='display:block; overflow:hidden; width:000px;'>����</nobr>
?>

<style type="text/css">
.act_subject { background:url(<?=$board_skin_path?>/img/list_head.gif); border:1px solid #DDDDDD; }
a.act_subject_text:link,
a.act_subject_text:active,
a.act_subject_text:visited,
a.act_subject_text:hover
{ margin:0 5px 0 10px; color:#888888; font-size:14px; font-family:dotum; font-weight:bold; text-decoration:none; }

a.act_subject_link:link,
a.act_subject_link:active,
a.act_subject_link:visited,
a.act_subject_link:hover
{ margin:0 5px 0 10px; color:#888888; font-size:12px; font-family:dotum; text-decoration:none; }

.act_image { width:100px; height:100px; border:1px solid #ddd; background-color:#FBFBFB; margin:12px 0 10px 10px; }

.act_info { font-family:dotum; font-size:12px; color:#555; line-height:20px; margin-top:5px; }
.pr_name { padding-left:5px; color:#000; font-weight:bold; overflow:hidden; width:205px; }
.pr_tender_point { padding-left:5px; color:#000; }
.pr_hr { line-height:1px; font-size:1px; background:url(<?=$board_skin_path?>/img/list_dot.gif); height:1px; margin:2px 0 2px 0; }
.act_date { padding-left:5px; }
.act_status { padding-left:5px; width:200px; overflow:hidden; }
.act_status_ok { font-weight:bold; color:#009520; }
.act_status_end { font-weight:bold; color:#950000; }
.act_status_no { font-weight:bold; color:#888888; }

</style>

<!-- �Խ��� ��� ���� -->
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td>

<!-- �з� ����Ʈ �ڽ�, �Խù� ���, ������ȭ�� ��ũ -->
<table width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <td width="50%">
    <? if ($is_category) { ?>
    <form name="fcategory" method="get"><td width="50%">
    <select name=sca onchange="location='<?=$category_location?>'+<?=strtolower($g4[charset])=='utf-8' ? "encodeURIComponent(this.value)" : "this.value"?>;">
    <option value=''>��ü</option><?=$category_option?></select>
    </td></form>
    <? } ?>
    </td>
    <td align="right" style="font:normal 11px tahoma; color:#BABABA;">
        Total <?=number_format($total_count)?> 
        <? if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border=0 align=absmiddle></a><?}?>
        <? if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" title="������" align="absmiddle"></a><?}?></td>
</tr>
<tr><td height=5></td></tr>
</table>

<!-- ���� -->
<form name="fboardlist" method="post" style="margin:0px;">
<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
<input type='hidden' name='sfl'  value='<?=$sfl?>'>
<input type='hidden' name='stx'  value='<?=$stx?>'>
<input type='hidden' name='spt'  value='<?=$spt?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='sw'   value=''>

<table border=0 cellpadding=0 cellspacing=0 width=100% height=4>
<tr>
    <td background="<?=$board_skin_path?>/img/top_line_1.gif" width="30%"></td>
    <td background="<?=$board_skin_path?>/img/top_line_2.gif" width="70%"></td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 style="margin:5px 0 5px 0;">
<tr>
<? 
$mod = $board[bo_gallery_cols];
for ($i=0; $i<count($list); $i++) 
{
    if ($i && $i%$mod==0) echo "</tr><tr><td height=10 colspan=2></td></tr><tr>";

    auction_successful($wr_id);

    $info = get_info_auction($list[$i][wr_id], $list[$i]);

    switch ($info[status])
    {
        case 0: // ������
            if (strtotime($info[start_datetime]) > $g4[server_time]) {
                $status = "������";
                $class = "";
                break;
            }
        case 1: // ������
            $status = "�������� <span style='font-size:11px;'>(".number_format($info[tender_count])."�� ����)</span>";
            $class = "act_status_ok";
            break;
        case 2: // ����
            $status = "�������";
            if ($info[mb_id]) {
                $mb = get_member($info[mb_id]);
                $status .= " ($mb[mb_nick])";
            }
            $class = "act_status_end";
            break;
        case 3: // ����
            $status = "�����Ǿ����ϴ�.";
            $class = "act_status_no";
            break;
        case 4: // ����
            $status = "������������Դϴ�.";
            $class = "act_status_no";
            break;
    }

    // ��ǰ�̹��� (��)
    $file = get_file($bo_table, $list[$i][wr_id]);
    $img = "{$file[0][path]}/{$file[0][file]}";
    if (!file_exists($img) or trim($img) == "/")
        $img = "{$board_skin_path}/img/noimage.gif";
?>
    <td valign=top>
        <table border=0 cellpadding=0 cellspacing=0 width=330>
        <tr>
            <td height=25 class=act_subject colspan=2>
                <div style="padding-top:3px;">
                <? 
                if ($list[$i][link][1]) {
                ?>
                  <a href="<?=$list[$i][link_href][1]?>" class=act_subject_text target=_blank>���� : <?=$info[company]?></a>
                  <!--<a href="<?=$list[$i][link_href][1]?>" class=act_subject_link target=_blank><?=str_replace("http://", "", $list[$i][link][1])?></a>-->
                <? } else { ?>
                  <a href="#" class=act_subject_text>���� : <?=$info[company]?></a>
                <? } ?>
                </div>
            </td>
        </tr>
        <tr>
            <td width=120>
                <div class=act_image><a href="<?=$list[$i][href]?>"><img src="<?=$img?>" width=98 height=98></a></div>
            </td>
            <td>
                <div class=act_info><a href="<?=$list[$i][href]?>" style="text-decoration:none;">
                <div class=pr_name><nobr><?=cut_str($info[product],28)?><? if ($list[$i][comment_cnt]) echo " <span style='font-family:Tahoma;font-size:10px;color:#EE5A00; font-weight:normal;'>{$list[$i][comment_cnt]}</span>"; ?></nobr></div>
                <div class=pr_tender_point>���� ����Ʈ : <?=number_format($info[tender_lower])?>~<?=number_format($info[tender_higher])?>P</div>
                <div class=pr_hr>&nbsp;</div>
                <div class=act_date>������ : <?=date("Y/m/d [H:i]",strtotime($info[start_datetime]))?></div>
                <div class=act_date>������ : <?=date("Y/m/d [H:i]",strtotime($info[end_datetime]))?></div>
                <div class=act_status> <nobr>��Ż��� :<span class="<?=$class?>"><?=$status?></span></nobr></div>
                </a></div>
            </td>
        </tr>
        <tr><td colspan=2 background="<?=$board_skin_path?>/img/list_tail.gif" height=3></tr>
        </table>
    </td>

<?
if (($i+1)%$mod!=0)
    echo "<td width=10>&nbsp;</td>";

} 
?>

<? if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>�Խù��� �����ϴ�.</td></tr>"; } ?>


<table border=0 cellpadding=0 cellspacing=0 width=100% height=4>
<tr>
    <td background="<?=$board_skin_path?>/img/bottom_line_1.gif"></td>
</tr>
</table>

</form>

<div style="clear:both; margin-top:7px; height:31px;">
    <div style="float:left;">
    <? if ($list_href) { ?>
    <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align=absmiddle></a>
    <? } ?>
    <? if ($is_checkbox) { ?>
    <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align=absmiddle></a>
    <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align=absmiddle></a>
    <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align=absmiddle></a>
    <? } ?>
    </div>

    <div style="float:right;">
    <? if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0"></a><? } ?>
    </div>
</div>

<div style="height:1px; line-height:1px; font-size:1px; background-color:#eee; clear:both;">&nbsp;</div>
<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<!-- ������ -->
<div style="text-align:center; line-height:30px; clear:both; margin:5px 0 10px 0; padding:5px 0;">

    <? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border=0 align=absmiddle title='�����˻�'></a>"; } ?>
    <?
    // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �̹����ε� ����� �� �ֽ��ϴ�.
    //echo $write_pages;
    $write_pages = str_replace("ó��", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='ó��'>", $write_pages);
    $write_pages = str_replace("����", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='����'>", $write_pages);
    $write_pages = str_replace("����", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='����'>", $write_pages);
    $write_pages = str_replace("�ǳ�", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='�ǳ�'>", $write_pages);
    $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><span style=\"color:#B3B3B3; font-size:12px;\">$1</span></b>", $write_pages);
    $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
    ?>
    <?=$write_pages?>
    <? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border=0 align=absmiddle title='�����˻�'></a>"; } ?>

</div>


<!-- ��ũ ��ư, �˻� -->
<div style="text-align:center;">
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<select name=sfl style="background-color:#f6f6f6; border:1px solid #7f9db9; height:21px;">
    <option value='wr_subject'>����</option>
    <option value='wr_content'>����</option>
    <option value='wr_subject||wr_content'>����+����</option>
    <option value='mb_id,1'>ȸ�����̵�</option>
    <option value='mb_id,0'>ȸ�����̵�(��)</option>
    <option value='wr_name,1'>�۾���</option>
    <option value='wr_name,0'>�۾���(��)</option>
</select>
<input name=stx maxlength=15 itemname="�˻���" required value='<?=stripslashes($stx)?>' style="width:204px; background-color:#f6f6f6; border:1px solid #7f9db9; height:21px;">
<input type=image src="<?=$board_skin_path?>/img/btn_search.gif" border=0 align=absmiddle>
<input type=radio name=sop value=and>and
<input type=radio name=sop value=or>or

</form>
</div>

</td></tr></table>

<script language="JavaScript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<? if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str) {
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "�� �Խù��� �ϳ� �̻� �����ϼ���.");
        return false;
    }
    return true;
}

// ������ �Խù� ����
function select_delete() {
    var f = document.fboardlist;

    str = "����";
    if (!check_confirm(str))
        return;

    if (!confirm("������ �Խù��� ���� "+str+" �Ͻðڽ��ϱ�?\n\n�ѹ� "+str+"�� �ڷ�� ������ �� �����ϴ�"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// ������ �Խù� ���� �� �̵�
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "����";
    else
        str = "�̵�";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<? } ?>
<!-- �Խ��� ��� �� -->
