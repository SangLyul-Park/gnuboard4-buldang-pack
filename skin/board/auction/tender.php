<?
$g4_path = "../../..";
include_once("$g4_path/common.php");

if (!$bo_table && !$wr_id)
    die("bo_table Ȥ�� wr_id �� �����ϴ�.");

include_once("$board_skin_path/auction.lib.php");
include_once("$g4[path]/head.sub.php");

if (!$write)
    alert_only("bo_table �� wr_id �� Ȯ���Ͻʽÿ�.");

if (!$point)
    alert_only("point �� �Է����ּ���.");

tender_send($wr_id, $point);

?>
<script language=javascript>
alert("<?=number_format($point)?> ����Ʈ�� �����Ͽ����ϴ�.", "<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&wr_id=<?=$wr_id?>");
</script>
<?
include_once("$g4[path]/tail.sub.php");
?>
