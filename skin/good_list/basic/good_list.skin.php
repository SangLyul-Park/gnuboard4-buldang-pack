<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>

<style>
.n_title1 { font-family:����; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:����; font-size:9pt; color:#5E5E5E; }
</style>

<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="sw"   value="">	
<input type="hidden" name="gr_id"   value="<?=$gr_id?>">	
<input type="hidden" name="view"   value="<?=$view?>">	
<input type="hidden" name="mb_id"   value="<?=$mb_id?>">	

<!-- ���� ���� -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height=2 bgcolor="#0A7299"></td>
    <td bgcolor="#0A7299"></td>
    <td bgcolor="#A4B510"></td>
    <td bgcolor="#A4B510"></td>
    <td bgcolor="#A4B510"></td>
</tr>
<tr height=28 align=center> 
    <td width="100" align="center">�Խ���</td>
    <td width="">����</td>
    <td width="110" align="center">�̸�</td>
    <? if ($wr_id) { ?>
    <td width="40" align="center">�Ͻ�</td>
    <? } else { ?>
    <td width="40" align="center"><?=subject_sort_link('wr_datetime', $qstr2, 1)?>�Ͻ�</a></td>
    <? } ?>
    <td width="50" align="center">��ȸ</td>
</tr>
<tr><td colspan=5 height=3 style="background:url(<?=$good_list_skin_path?>/img/title_bg.gif) repeat-x;"></td></tr>
<?
for ($i=0; $i<count($list); $i++) 
{
    $bo_subject = cut_str($list[$i][bo_subject], 10);
    $wr_subject = get_text(cut_str($list[$i][wr_subject], 40));
?>
<tr height=28 align=center> 
    <td align="center"><a href='./good_list.php?bo_table_search=<?=$list[$i][bo_table]?>'><?=$bo_subject?></a></td>
    <td width="" align=left>
    <a href='<?=$list[$i][href]?>'><?=$list[$i][comment]?><?=$wr_subject?></a>
    </td>
    <td align="center"><?=$list[$i][name]?></td>
    <td align="center"><?=$list[$i][wr_datetime2]?></td>
    <td align="center"><?=$list[$i][wr_hit]?></td>
</tr>
<tr><td colspan=4 height=1 bgcolor=#E7E7E7></td></tr>
<?
}
?>

<? if ($i == 0) { ?>
<tr><td colspan="9" height=50 align=center>�Խù��� �����ϴ�.</td></tr>
<? } ?>
<tr>
    <td colspan="4" height="30" align="center"><?=$write_pages?></td>
</tr>
<tr>
    <td colspan="4" height="30" align="left">
    <a href="./good_list.php?page=<?=$page?>"><img src="<?=$good_list_skin_path?>/img/btn_list.gif" border="0"></a>
    </td>
</tr>
</table>
</form>