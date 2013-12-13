<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ��Ų���� ����ϴ� lib �о���̱�
include_once("$g4[path]/lib/view.skin.lib.php");
?>

<div width="<?=$width?>" class="table-responsive" id="view_<?=$wr_id?>" >

<!-- ��ũ ��ư -->
<? ob_start(); // �ѹ� ���� �ι� ���ϴ� ?>
<div id="view_top">
    <div class="btn-group">
        <? if ($search_href) { echo "<a href=\"$search_href\" class=\"btn btn-default btn-sm\">�˻�</a> "; } ?>
        <? echo "<a href=\"$list_href\" class=\"btn btn-default btn-sm\">���</a> "; ?>
    </div>
    <div class="btn-group">
        <? if ($write_href) { echo "<a href=\"$write_href\" class=\"btn btn-default btn-sm\">����</a> "; } ?>
    </div>
    <div class="btn-group">
        <? if ($reply_href) { echo "<a href=\"$reply_href\" class=\"btn btn-default btn-sm\">�亯</a> "; } ?>
        <? if ($update_href) { echo "<a href=\"$update_href\" class=\"btn btn-default btn-sm\">����</a> "; } ?>
        <? if ($delete_href) { echo "<a href=\"$delete_href\" class=\"btn btn-default btn-sm\">����</a> "; } ?>
    </div>
    <div class="btn-group">
        <? if ($good_href) { echo "<a href=\"$good_href\" target='hiddenframe' class=\"btn btn-default btn-sm\">��õ</a> "; } ?>
        <? if ($nogood_href) { echo "<a href=\"$nogood_href\" target='hiddenframe' class=\"btn btn-default btn-sm\">����õ</a> "; } ?>
        <? if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\" class=\"btn btn-default btn-sm\">��ũ��</a> "; } ?>
        <? if ($nosecret_href) { echo "<a href=\"$nosecret_href\" class=\"btn btn-default btn-sm\">��б�����</a> "; } ?>
        <? if ($secret_href) { echo "<a href=\"$secret_href\" class=\"btn btn-default btn-sm\">��б�</a> "; } ?>
    </div>
    <div class="btn-group pull-right">
        <? if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\" class=\"btn btn-default btn-sm\">������</a>"; } ?>
        <? if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\" class=\"btn btn-default btn-sm\">������</a>"; } ?>
 	      <a href="javascript:scaleFont(+1);" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></a>
        <a href="javascript:scaleFont(-1);" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-out"></span></a>
    </div>
    <div class="btn-group hidden-xs hidden-sm  pull-right">
        <? if ($copy_href) { echo "<a href=\"$copy_href\" class=\"btn btn-default btn-sm\">����</a> "; } ?>
        <? if ($move_href) { echo "<a href=\"$move_href\" class=\"btn btn-default btn-sm\">�̵�</a> "; } ?>
        <? if ($now_href) { echo "<a href=\"$now_href\" class=\"btn btn-default btn-sm\">����</a> "; } ?>
    </div>
    <div class="pull-right">
    </div>
</div>
<?
$link_buttons = ob_get_contents();
ob_end_flush();
?>

<div id="view_header" class="panel panel-default" style="margin-top:5px; outline: 1px solid white">
<div class="panel-heading">
    <p class="pull-right">
        <?if ($singo_href) { ?><a class="btn btn-default btn-xs" href="javascript:win_singo('<?=$singo_href?>');">�Ű�</a><?}?>
        <?if ($unsingo_href) { ?><span style="float:right;padding-right:5px;"><a href="javascript:win_unsingo('<?=$unsingo_href?>');"><img src='<?=$board_skin_path?>/img/icon_unsingo.gif' alt='unsingo'></a></span><?}?>
		</p>
		<p>
        <? if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?>
        <strong><?=cut_hangul_last(get_text($view[wr_subject]))?></strong>
		</p>
		<p>
        �۾��� : <?=$view[name]?><? if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;
	  		��¥ : <?php echo substr($view['wr_datetime'], 2, 14); ?>&nbsp;&nbsp;
        ��ȸ : <?=$view[wr_hit]?>&nbsp;&nbsp;
        <? if ($is_good) { ?><font style="font:normal 11px ����; color:#BABABA;">��õ</font> :<font style="font:normal 11px tahoma; color:#BABABA;"> <?=$view[wr_good]?>&nbsp;&nbsp;&nbsp;&nbsp;</font><?}?>
        <? if ($is_nogood) { ?><font style="font:normal 11px ����; color:#BABABA;">����õ</font> :<font style="font:normal 11px tahoma; color:#BABABA;"> <?=$view[wr_nogood]?>&nbsp;&nbsp;&nbsp;&nbsp;</font><?}?>
    </p>
    <!-- �Խñ� �ּҸ� �����ϱ� ���� �ϱ� ���ؼ� �Ʒ� �κ��� ���� -->
    <p class="row collapse navbar-collapse">
    <font style="font:normal 11px ����; color:#BABABA;">�Խñ� �ּ� : <a href="javascript:clipboard_trackback('<?=$posting_url?>');" style="letter-spacing:0;" title='�� ���� �Ұ��� ���� �� �ּҸ� ����ϼ���'><?=$posting_url;?></a></font>
    <? if ($g4[use_bitly]) { ?>
        <? if ($view[bitly_url]) { ?>
        &nbsp;bitly : <span id="bitly_url" class=bitly style="font:normal 11px ����; color:#BABABA;"><a href=<?=$view[bitly_url]?> target=new><?=$view[bitly_url]?></a></span>
        <? } else { ?>
        &nbsp;bitly : <span id="bitly_url" class=bitly style="font:normal 11px ����; color:#BABABA;"></span>
        <script language=javascript>
        // encode �� ���� �Ѱ��ָ�, �˾Ƽ� decode�ؼ� ����� return ���ش�.
        // encode �ϱ� ���� url�� �־�� ����� ���� �� �ֱ� ������, �ᱹ 2���� �Ѱ��ش�.
        // ��? java script������ urlencode, urldecode�� �����ϱ�. ����
        // ���� �̰Ŵ� �������� �ؾ� �Ѵ�. ��??? �׷��� ������ html page�� ������Ʈ ����~!
        get_bitly_g4('#bitly_url', '<?=$bo_table?>', '<?=$wr_id?>');
        </script>
        <?}?>
    <?}?>
    </p>
    <p>
        <?
        // ���� ����
        $cnt = 0;
        for ($i=0; $i<count($view[file]); $i++) {
            if ($view[file][$i][source] && !$view[file][$i][view]) {
                $cnt++;
                echo "<i class=\"fa fa-file\" title='attached file'></i> <a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'><font style='normal 11px ����;'>{$view[file][$i][source]} ({$view[file][$i][size]}), Down : {$view[file][$i][download]}, {$view[file][$i][datetime]}</font></a><br>";
            }
        }

        // ��ũ
        $cnt = 0;
        for ($i=1; $i<=$g4[link_count]; $i++) {
            if ($view[link][$i]) {
                $cnt++;
                $link = cut_str($view[link][$i], 70);
                echo "<a href='{$view[link_href][$i]}' target=_blank><font  style='normal 11px ����;'>{$link} ({$view[link_hit][$i]})</font></a>";
            }
        }
    ?>
    </p>
</div>

<div id="view_main" class="panel-body">

    <?
    // ���� ���
    for ($i=0; $i<=$view[file][count]; $i++) {
        if ($view[file][$i][view]) {
            echo resize_dica($view[file][$i][view],250,300) . "<p>" . $view[file][$i][content] . "<br/>";
        }
    }

    // �Ű�� �Խñ��� �̹����� �����Ͽ� ����ϱ�
    if ($view['wr_singo'] and trim($file_viewer)) {
        $singo = "<div id='singo_file_title{$view[wr_id]}' class='singo_title'><font color=gray>�Ű� ������ �Խù��Դϴ�. ";
        $singo .= "<span class='singo_here' style='cursor:pointer;font-weight:bold;' onclick=\"document.getElementById('singo_file{$view[wr_id]}').style.display=(document.getElementById('singo_file{$view[wr_id]}').style.display=='none'?'':'none');\"><font color=red>����</font></span>�� Ŭ���Ͻø� ÷�� �̹����� �� �� �ֽ��ϴ�.</font></div>";
        $singo .= "<div id='singo_file{$view[wr_id]}' style='display:none;'><p>";
        $singo .= $file_viewer;
        $singo .= "</div>";
        echo $singo;
    } else {
        echo $file_viewer;
    }
    ?>

    <!-- ���� ��� -->
    <span id="writeContents">
    <?
        $write_contents=resize_dica($view[content],400,300);
        echo $write_contents;
    ?>
    </span>

    <? if ($is_signature && $signature) { echo "<div style='margin-top:20px;text-align:center;'>$signature</div>"; } // ���� ��� ?>

</div>

<?
// ���� �ִ� ��� ���� ����
if (file_exists("$g4[path]/adsense_view_comment.php"))
    include_once("$g4[path]/adsense_view_comment.php");
?>

</div>

<?
// �ڸ�Ʈ �����
if (!$board['bo_comment_read_level'])
  include_once("./view_comment.php");
else if ($member['mb_level'] >= $board['bo_comment_read_level'])
  include_once("./view_comment.php");
?>
<?=$link_buttons?>
<? include_once("$g4[path]/adsense_page_bottom.php"); ?>

</div>

<script type="text/javascript"  src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage($(view_main).width()-20);
    drawFont();
    OnclickCheck(document.getElementById("writeContents"), '<?=$config[cf_link_target]?>'); 
}
</script>
<!-- �Խñ� ���� �� -->