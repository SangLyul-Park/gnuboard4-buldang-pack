<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if (!$skin_title) {
    if ($board[bo_subject]) {
        $skin_title = $board[bo_subject];
        $skin_title_link = "$g4[bbs_path]/board.php?bo_table=$bo_table";
    } else {
        $skin_title = "�ֽű�";
    }
}

if ($content_len ==0)
    $content_len = 250;

//id�� �����ϰ� ����ϴ�. ��� ���ڵ���� ���� �� �г��� �ʰ�...
$rand1 = rand();
?>
<div class="panel-group" id="accordion_<?=$rand1?>">
    <?
    if (count($list) == 0) {
        echo "<div style='height:200px;'><a href='#'>�������</a></div>";
    } else {
        // �����ϰ� ���ڵ���� �����ݴϴ�
        $open_in = rand(0, count($list)-1);

        // ���µǴ� �迭�� ���� ���� �ø��� (���õ� ���� 0���� �ø���, 0���� ���õȰ� ������ �о� ������)
        $tmp = $list[$open_in];
        for ($i=$open_in; $i>0; $i--) {
            $list[$i] = $list[$i-1];
        }
        $list[0] = $tmp;

        for ($i=0; $i<count($list); $i++) {
    ?>
        <!-- margin-bottom:-6px�� css���� �ٸ��Ƿ�... �˾Ƽ� �������ּ��� -->
        <div class="panel panel-default" style="margin-bottom:-6px;">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion_<?=$rand1?>" href="#collapse_<?=$rand1?>_<?=$i?>">
            <?
            if ($list[$i][icon_secret])
                echo "<i class=\"fa fa-lock\"></i> ";
  
            if ($list[$i][bo_name])
                $list_title = $list[$i][bo_name] . " : " . $list[$i][subject] . " (". $list[$i][datetime] . ")" ;
            else
                $list_title = $list[$i][subject]  . " (". $list[$i][datetime] . ")" ;
  
            if ($list[$i][icon_reply])
                echo "<i class=\"fa fa-reply fa-rotate-180\"></i> ";

  	        if ($list[$i][comment_cnt])
	              echo " <small>" . $list[$i][comment_cnt] . "</small> ";
  
            if ($list[$i][is_notice])
                echo "<strong>" . $list[$i][subject] . "</strong>";
            else
                echo $list[$i][subject];
  
            if ($list[$i][icon_new])
                echo "  <i class=\"fa fa-bell-o\"></i>";
            ?>
            </a>
            <span class="pull-right">
                <a href='<?=$list[$i][href]?>' onfocus='this.blur()' title='<?=$list_title?>' <?=$target_link?>>
                <i class="fa fa-external-link"></i>
                </a>
            </span>
        </div>
        <?
        // ó�������� ���� open... in�� class�� ���� �����ϴ�
        if ($i == 0)
            $in = "in";
        else
            $in = "";
        ?>
        <div id="collapse_<?=$rand1?>_<?=$i?>" class="panel-collapse collapse <?=$in?>" >
            <div class="panel-body">
                <?=cut_str(strip_tags($list[$i][wr_content]),$content_len)?>
            </div>
        </div>
    </div>
    <?
        }
    }
    ?>
</div>