<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

global $is_admin;
?>

<div class="section_ul">
<ul style='text-align:left;margin-left: 40px;'>
	<li><span class="bu"></span> ���� <span><?=number_format($visit[1])?><? if ($is_admin == "super") { ?><a href="<?=$g4['admin_path']?>/visit_list.php"><img src="<?=$visit_skin_path?>/img/admin.gif" width="33" height="15" border="0" align="absmiddle"></a><?}?></span></li>
	<li><span class="bu"></span> ���� <span><?=number_format($visit[2])?></span></li>
	<li><span class="bu"></span> ��ü <span><?=number_format($visit[3])?></span></li>
	<li><span class="bu"></span> �ִ� <span><?=number_format($visit[4])?></span></li>
</li>
</ul>
</div>