<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

for ($i=0; $i<count($list); $i++) {

    // cookie ������ �о, done�� ��쿡�� ����� ���� �ʰ� ����մϴ�. ���ʿ��� â�� ���� ���� �����Դϴ�.
    if (!$cate) 
        $cate = "popup9125_"; // $cate�� ���� ��� html �������� �̸��� ��ġ�� ��찡 �߻��ؼ� ���Ƿ� ���� �־��ݴϴ�.
    $popup_id = $cate . $list[$i]['wr_id'];
    $cookie_name = "divpop_" . $popup_id;
    $chkbox_id = "chkbox_" . $popup_id;
    $writeContents_id = "writeContents_" . $popup_id;

    if ($_COOKIE[$cookie_name] == "done")
        continue;
?>

    <div class="container" id="divpop_<?=$popup_id?>">
    <div class="alert alert-success" id="<?=$writeContents_id?>">
        <?
        $wr_content = $list[$i]['wr_content'];
    		if (!strstr($list[$i]['wr_option'], "html1")) {
		        $html = 0;
            $wr_content = conv_content($wr_content, $html);
        }
        echo $wr_content;
        ?>
    <a id="checkbox_<?=$popup_id?>" class="close" data-dismiss="alert" href="#" aria-hidden="true" onclick="hideMe_x('<?=$popup_id?>', 7);"><i class="fa fa-times"></i></a>
    </div>
    </div>
<? } // end of for loop ?>
<script type="text/javascript">
<!--
function hideMe_x(popupid, days){
  	set_cookie( 'divpop_'+popupid, "done", days*24, g4_cookie_domain);
  	$('#writeContents_'+popupid).alert('close');
}
-->
</script>