<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<!-- �α��� �� �ܺηα��� ���� -->
<table width="100%" border="0" cellpadding="0" cellspacing="1" style='border:solid 1px #ddd;'>
<tr>
<td width="100%">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr> 
    <td>
        <table width="100%" height="27" border="0" cellpadding="0" cellspacing="0">
        <tr> 
            <td width="10" height="27">&nbsp;</td>
            <td width="" height="27"><a href='#' onclick="win_profile('<?=$member[mb_id]?>');"><span class='member'><strong><?=$nick?></strong></span></a>&nbsp;<img src="<?=$outlogin_skin_path?>/img/<?=$member[mb_level]?>.gif"></td>
            <td height="27">
            <? if ($g4['member_suggest_join']) { ?>
            <span class="btn_pack small"><a href="<?=$g4['g4_path']?>/plugin/recommend/index.php">��õ</a></span>
            <? } ?>
            <? if ($config[cf_use_recycle]) { ?>
            <span class="btn_pack small"><a href="<?=$g4['bbs_path']?>/recycle_list.php">������</a></span>
            <? } ?>
            </td>
        </tr>
      </table></td>
</tr>
<? if ($config[cf_use_point]) { ?>
<tr> 
    <td width="100%" height="20" align="left">&nbsp;&nbsp;<a href="javascript:win_memo('', '<?=$member[mb_id]?>', '<?=$_SERVER[SERVER_NAME]?>');" onfocus="this.blur()">����(<?=$memo_not_read?>)</a>&nbsp;<a href="javascript:win_point();" onfocus="this.blur()"><font color="#737373"><?=$point?>��</font></a>
        <? if ($is_admin == "super" || $is_auth) { ?><span class="btn_pack small"><a href="<?=$g4[admin_path]?>/" onfocus="this.blur()">Admin</a></span><? } ?>
    </td>
</tr>
<? } ?>
<tr> 
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="100%" align="center">
                <table width="100%" height="25" border="0" cellpadding="1" cellspacing="0" align="center">
                <tr> 
                    <td width="58" align="center"><a href="javascript:win_scrap();" onfocus="this.blur()"><img src="<?=$outlogin_skin_path?>/img/scrap_button.gif" width="51" height="20" border="0"></a></td>
                    <td width="58" align="center"><a href="<?=$g4[bbs_path]?>/member_confirm.php?url=register_form.php" onfocus="this.blur()"><img src="<?=$outlogin_skin_path?>/img/login_modify.gif" width="51" height="20" border="0"></a></td>
                    <td width="58" align="center"><a href="<?=$g4[bbs_path]?>/logout.php?url=<?=$urlencode?>" onfocus="this.blur()"><img src="<?=$outlogin_skin_path?>/img/logout_button.gif" width="51" height="20" border="0"></a></td>
			   </tr>
               </table>
			</td>
        </tr>
        </table></td>
</tr>

<?
$my_menu = array();
$sql = "select m.bo_table, b.bo_subject from $g4[my_menu_table] as m left join $g4[board_table] as b on m.bo_table = b.bo_table where mb_id = '$member[mb_id]'";
$qry = sql_query($sql);
while ($row = sql_fetch_array($qry))
{
    $my_menu[] = $row;
}

if (count($my_menu) > 0) { 
?>

<tr><td>
<select class=quick_move onchange="quick_move(this.value)">
<option value="">�Խ��� �ٷΰ���</option>
<option value="">-------------------------</option>
<? for ($i=0; $i<count($my_menu); $i++) {?>
<option value="<?=$my_menu[$i][bo_table]?>"><?=$my_menu[$i][bo_subject]?></option>
<? } ?>
<option value="">-------------------------</option>
<option value="menu-edit">�ٷΰ��� ����</option>
</select>
</td></tr>

<script language="JavaScript">
function quick_move(bo_table)
{
    if (!bo_table) return;
    if (bo_table == 'menu-edit') {
        popup_window("<?=$g4[bbs_path]?>/my_menu_edit.php", "my_menu_edit", "width=350, height=400, scrollbars=1");
        return;
    }
    if (bo_table == 'mypage') {
        location.href = "<?=$g4[path]?>/customer/mypage.php";
        return;
    }
    location.href = "<?=$g4[bbs_path]?>/board.php?bo_table=" + bo_table;
}
</script>

<? } ?>

</table>
</td>
</tr>
</table>
<script language="JavaScript">
// Ż���� ��� �Ʒ� �ڵ带 �����Ͻø� �˴ϴ�.
function member_leave() 
{
    if (confirm("���� ȸ������ Ż�� �Ͻðڽ��ϱ�?")) 
            location.href = "<?=$g4[bbs_path]?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- �α��� �� �ܺηα��� �� -->
