<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<div class="panel panel-default">
    <div class="panel-heading">�Խ��Ƿ�ŷ</div>
    <div class="panel-body">
    <ol class="list-unstyled">
    <? 
    for ($i=0; $i<count($list); $i++) {
        $rank = $i+1;
        if ($i < 3)
            $bs = "label-success";
        else
            $bs = "label-default";
        echo "<li>";
        echo "<span class='label $bs pull-left'>$rank</span>&nbsp;";
        echo "<a href='$g4[bbs_path]/board.php?bo_table={$list[$i][bo_table]}'>";
        echo $list[$i][bo_subject];
        echo "</a></li>";
    }
    ?>
    </ol>
    </div>
</div>