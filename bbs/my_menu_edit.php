<?
include_once("_common.php");

include_once("$g4[path]/head.sub.php");

if (!$is_member)
    alert_close("�α��� �� �̿��Ͻ� �� �ֽ��ϴ�.");
?>

<div style="margin:10px; text-align:center; padding-bottom:20px; font-family:dotum;">

<h3 style="margin:0; padding:5px;"> �Խ��� �ٷΰ��� ���� </h3>

<table border=0 cellpadding=0 cellspacing=1 width=310 align=center>
<tr>
    <td colspan=3 bgcolor="#808080" height=2></td>
</tr>
<tr bgcolor="#E1E1E1">
    <td align=center style="font-weight:bold;" width=50 height=30> ��ȣ </td>
    <td align=center style="font-weight:bold;"> �Խ��� �ٷΰ��� </td>
    <td align=center style="font-weight:bold;" width=70> ���� </td>
</tr>
<tr>
    <td colspan=3 bgcolor="#dddddd" height=1></td>
</tr>
<?
$num = 1;
$qry = sql_query("select m.bo_table, b.bo_subject from $g4[my_menu_table] as m left join $g4[board_table] as b on b.bo_table = m.bo_table where mb_id = '$member[mb_id]'");

if (!mysql_num_rows($qry)) {
?>
<tr>
    <td colspan=3 height=100 align=center>
        ��ϵ� �ٷΰ��Ⱑ �����ϴ�.
    </td>
</tr>
<?
}
while ($row = sql_fetch_array($qry)) {
?>
<tr bgcolor="#F6F6F6">
    <td align=center height=25> <?=$num++?> </td>
    <td align=left height=25 style="padding-left:10px;"> 
        <a href="javascript:;" onclick="opener.document.location.href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$row[bo_table]?>';"><?=$row[bo_subject]?></a>
    </td>
    <td align=center height=25> 
        <a href="javascript: del('<?=$row[bo_table]?>', '<?=$row[bo_subject]?>');"><img src="<?=$g4[path]?>/skin/member/basic/img/btn_comment_delete.gif"></a> 
    </td>
</tr>
<? } ?>
<tr>
    <td colspan=3 bgcolor="#dddddd" height=1></td>
</tr>
</table>

<div style="margin:20px 0 20px 0;">
<input type=button value="��     ��" onclick="self.close();">
</div>

</div>

<script language=javascript>
function del(bo_table, bo_subject)
{
    if (confirm("'" + bo_subject + "' �Խ��� �ٷΰ��⸦ ���� �����Ͻðڽ��ϱ�?"))
        location.href = "<?=$g4[bbs_path]?>/my_menu_del.php?bo_table=" + bo_table;
}
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
