<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<div class="panel panel-default">
<div class="panel-heading">
  	<a href='<?=$skin_title_link?>' onfocus='this.blur()'><?=$view[subject]?></a>
    <a class="pull-right" href='<?=$skin_title_link?>' onfocus='this.blur()'><small>more</small></a>
</div>
<div class="panel-body">
    <?
    echo $view[content];
    ?>
</div>
</div>