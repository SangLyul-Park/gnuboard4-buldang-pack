<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<div class="panel panel-default">
<div class="panel-body">
	  <ul class="list-unstyled">
    <?
    if (count($list) == 0) {
        echo "<li><a href='#'>�������</a></li>";
    } else {
        for ($i=0; $i<count($list); $i++) { 

          echo "<li>";

          if ($list[$i][icon_secret])
              echo "<i class=\"fa fa-lock\"></i> ";

          if ($list[$i][bo_name])
              $list_title = $list[$i][bo_name] . " : " . $list[$i][subject] . " (". $list[$i][datetime] . ")" ;
          else
              $list_title = $list[$i][subject]  . " (". $list[$i][datetime] . ")" ;

          if ($list[$i][comment_cnt]) 
              echo " <a href=\"{$list[$i][comment_href]}\" onfocus=\"this.blur()\"><small>{$list[$i][comment_cnt]}</small></a> ";

          if ($list[$i][icon_reply])
              echo $list[$i][icon_reply] . " ";

          echo "<a href='{$list[$i][href]}' onfocus='this.blur()' title='{$list_title}' {$target_link}>";
          if ($list[$i][is_notice])
              echo "<strong>" . $list[$i][subject] . "</strong>";
          else
              echo $list[$i][subject];
          echo "</a>";

          if ($list[$i][icon_new])
              echo " <i class=\"fa fa-bell-o\"></i>";

          echo "</li>";
      }
  }
  // fill�� true�̰�, �� ä������ �� ä���ش�.
  if ($options && $options['fill'] && $i < $rows) {
        for ($j=$i; $j<$rows;$j++) {
            echo "<li><a href='#'>&nbsp;</a></li>";
        }
  }
  ?>
  </ul>
</div>
</div>
