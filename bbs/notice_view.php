<?
include_once("./_common.php");

$g4[title] = "��ü�������� �Խù�";

// ������ ����� ������ �ʰ�
$board[bo_use_list_view] = 0;

// �����̳� �׷��� ��Ŭ��� ���� ���ϰ�
$board[bo_include_head] = 0;
$board[bo_image_head] = 0;
$board[bo_content_head] = 0;

$board[bo_include_tail] = 0;
$board[bo_image_tail] = 0;
$board[bo_content_tail] = 0;

include_once("./_head.php");

include_once("./board.php");

if ($g4['notice_use_list_view'])
    include_once("./notice_list.php");

include_once("./_tail.php");
?>

<script type="text/javascript">
var btn_hide = function() {
    $('.btn-copy').hide();
    $('.btn-move').hide();
    $('.btn-prev').hide();
    $('.btn-next').hide();
    $('.btn-write').hide();
    //$('img[src*="btn_reply.gif"]').hide();
    //$('img[src*="btn_modify.gif"]').hide();
    //$('img[src*="btn_del.gif"]').hide();
    $('.btn-list').closest('a').attr("href", "<?=$g4[bbs_path]?>/notice_list.php?page=<?=$page?>&qstr=<?=$qstr?>");
};

$(function() {
    btn_hide();
});
</script>
