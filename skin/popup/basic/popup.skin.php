<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>

<? if (count($list)) { ?>
<? if (!jQuery) { ?>
<script src="<?=$g4[path]?>/js/jquery.js" type="text/javascript"></script>
<? } ?>
<script src="<?=$g4[path]?>/js/jquery.ui.core.min.js" type="text/javascript"></script>
<script src="<?=$g4[path]?>/js/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="<?=$g4[path]?>/js/jquery.ui.mouse.min.js" type="text/javascript"></script>
<script src="<?=$g4[path]?>/js/jquery.ui.draggable.min.js" type="text/javascript"></script>
<script language="JavaScript">
<!--
function hideMe(popupid, days){
    if ( document.getElementById('chkbox_'+popupid).checked ) {
    	set_cookie( 'divpop_'+popupid, "done", days*24, g4_cookie_domain);
 		  document.getElementById('chkbox_'+popupid).checked = false;
  	}

  	document.getElementById('divpop_'+popupid).style.visibility="hidden";
}

// �̹����� ���� ���콺�� �̵��� �� ���콺 Ŀ���� �ٲ��ֱ�
function over(id, cursorVal) 
{ 
    document.getElementById(id).style.cursor = cursorVal; 
} 

// �̹����� ������ ���콺�� �̵��� �� ���콺 Ŀ���� �ٲ��ֱ�
function out(id) 
{ 
    document.getElementById(id).style.cursor = 'move'; 
} 
//-->
</script>
<? } ?>

<?
for ($i=0; $i<count($list); $i++) {

// cookie ������ �о, done�� ��쿡�� ����� ���� �ʰ� ����մϴ�. ���ʿ��� â�� ���� ���� �����Դϴ�.
if (!$cate) 
    $cate = "popup2143_"; // $cate�� ���� ��� html �������� �̸��� ��ġ�� ��찡 �߻��ؼ� ���Ƿ� ���� �־��ݴϴ�.
$popup_id = $cate . $list[$i]['wr_id'];
$cookie_name = "divpop_" . $popup_id;
$chkbox_id = "chkbox_" . $popup_id;
$writeContents_id = "writeContents_" . $popup_id;

if ($_COOKIE[$cookie_name] == "done")
    continue;

// �˾����� - ���� ��� (/board/cheditor_popup/view.skin.php���� ����/������ �ڵ带 �־�� �մϴ�.)
$back_img = "";
if ($list[$i][file][0][view]) {
    $img_url = $list[$i][file][0][path]."/".$list[$i][file][0][file];
    if ($list[$i][wr_9]) { // ���� ����ϴ� ���
        // �⺻�� ����
        $popup_padding = "0px";
        $popup_offset_x = 0;
    } else if ($list[$i][link][1]) { // ���� �Ⱦ��鼭 - ��ũ1�� ���� �ִ� ��� - �̹�����
        // �⺻�� ����
        $popup_padding = "0px";
        $popup_offset_x = 0;
    } else { //  ���� �Ⱦ��鼭 - ��ũ1�� ���� ���� ��� - ����̹�����
        // �⺻�� ����
        $popup_padding = "20px";
        $popup_offset_x = 12;
        
        // ����̹��� �ݺ�
        if ($list[$i][wr_10])
            $back_img_repeat = "background-repeat:repeat";
        else
            $back_img_repeat = "background-repeat:no-repeat";
        $back_img = "style=\"background-image:url('$img_url');{$back_img_repeat};width:{$list[$i][wr_5]}\"";
    }
} else {
        // �⺻�� ����
        $popup_padding = "20px";
        $popup_offset_x = 12;
}

// �˾�â ����
$popup_width = $list[$i]['wr_5'];

// �˾�â�� title ���ϴ� ����
$popup_t = 25;
?>

<div class="popups" id="divpop_<?=$popup_id?>" style="border-style:solid;border-width:1px;border-color:#333333;position:absolute;width:<?=$popup_width?>px;left:<?=$list[$i]['wr_3']?>px;top:<?=$list[$i]['wr_4']?>px;z-index:<?=$i?>;" >

<div style="background-color:#888888;height:<?=$popup_t?>px;padding-left:<?=$popup_padding?>;padding-top:5px;">

    <span style="float:left">
    <!-- ������ ��Ʈ ��Ÿ�ϰ� Ÿ���� ���� -->
    <font face="Arial" color="#FFFFFF">&nbsp;<?=$list[$i]['subject']?></font>
    </span>

    <!-- â�� �ݾ��ִ� x�� ���� -->
    <span style="float:right;width=<?=$popup_t?>px;">
    <a href="#" onclick="hideMe('<?=$popup_id?>', <?=$list[$i]['wr_7'];?>);"><font color=#ffffff size=2 face=arial style="text-decoration:none">X</font></a>&nbsp;
    </span>

</div>

<div style="background-color:#FFFFFF;height:<?=$list[$i]['wr_6']?>px;padding-left:<?=$popup_padding?>;padding-top:<?=$popup_padding?>;padding-right:<?=$popup_padding?>;">
		<!-- ���� ��� -->
		<? if ($list[$i][wr_9]) { // ���� ���� ��� ?>
        <span id="<?=$writeContents_id?>" style="overflow:hidden;width:<?=$list[$i][wr_5]?>;height:<?=$list[$i][wr_6]?>;"><img src="<?=$img_url;?>" usemap="#<?=$list[$i][wr_9]?>"><?=conv_content_rev($list[$i][wr_content], $writeContents_id, $list[$i][wr_option]);?></span>
    <? } else if ($list[$i][link][1]) {
      
    		// wr_link1�� �ִ� ��쿡�� wr_link1���� ������ link�� �ɾ��ݴϴ�.
        $popup_link = $list[$i][link][1];
  	    if ($list[$i][link][2])
	          $target_link = " target='new' ";
	      else
	          $target_link = "";
    		?>
        <span id="<?=$writeContents_id?>" ><a href="<?=$popup_link?>" onfocus="this.blur()" style="text-decoration:none;" <?=$target_link?>><img src="<?=$img_url;?>"></a></span>
    <? } else { ?>
        <?
        $wr_content = $list[$i]['wr_content'];
    		if (!strstr($list[$i]['wr_option'], "html1")) {
		        $html = 0;
            $wr_content = conv_content($wr_content, $html);
        }
        ?>
        <span id="<?=$writeContents_id?>" style="overflow:hidden;width:<?=$list[$i][wr_5]?>;height:<?=$list[$i][wr_6]?>;cursor:move;"><?=$wr_content?></span>
    <? } ?>
    </td></tr>
</div>

<div style="background-color:#EFEFEF;height:<?=$popup_t?>px;text-align:right;padding-right:5px;">
  	<input type="checkbox" name="<?=$chkbox_id?>" id="<?=$chkbox_id?>" value="checkbox" onclick="hideMe('<?=$popup_id?>', <?=$list[$i]['wr_7'];?>);" style="cursor:pointer;"> <a href="#" onclick="hideMe('<?=$popup_id?>', <?=$list[$i]['wr_7'];?>);"><?=$list[$i]['wr_8'];?></a> &nbsp;
</div>



</div>

<script type="text/javascript">
$(document).ready(function() {
	  $('.popups').draggable( { cursor: 'hand' } );
});
</script>

<?
} // end of for loop
?>