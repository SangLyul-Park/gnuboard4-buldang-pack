<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<div class="panel panel-default">
  <div class="panel-body">
      <ul class="list-unstyled">
    	<li> ���� <span><?=number_format($visit[1])?><? if ($is_admin == "super") { ?>&nbsp;&nbsp;<a href="<?=$g4['admin_path']?>/visit_list.php"><i class="fa fa-cog"></i></a><?}?></li>
    	<li> ���� <span><?=number_format($visit[2])?></li>
    	<li> �ִ� <span><?=number_format($visit[3])?></li>
    	<li> ��ü <span><?=number_format($visit[4])?></li>
      </li>
</ul>
  </div>
</div>