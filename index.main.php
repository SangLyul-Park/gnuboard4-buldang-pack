<!-- ����ȭ�� �ֽű� ���� -->

<?
include_once("$g4[path]/lib/popular.lib.php");      // �α��
include_once("$g4[path]/lib/latest.lib.php");       // �ֽű�
include_once("$g4[path]/lib/latest.group.lib.php"); // �׷� �ֽű�
include_once("$g4[path]/lib/latest.my.lib.php"); // �׷� �ֽű�
include_once("$g4[path]/lib/latest.club.lib.php");  // Ŭ�� �ֽű�
?>
<div class="row-fluid row">
<div class="col-sm-6">
<?echo latest_scrap("scrap", "", "echo4me", 9, 40);?>
</div>
<div class="col-sm-6">
<table width=100%><tr><td><!-- ��⸸ table�� �����ִ� ���� �׷��� ���� ������ div, span �±װ� �̻��ϰ� �����ϱ� �����̴� -->
<?echo db_cache('main_notice2', 1, "latest_one('one', 'gnu4_pack_skin, 118, 0, 430)");?>
</td></tr></table>
</div>
</div>

<div class="row-fluid row">
<div class="col-sm-6">
<?echo db_cache('all_latest', 1, "latest_group(naver, , 12, 40, , ��ü�ֱٱ�, '$g4[bbs_path]/new.php')");?>
</div>
<div class="col-sm-6">
<? 
$db_key = $member[mb_id] . "_all_my_latest";
echo db_cache("$db_key", 1, "latest_group(naver, , 12, 40, , ��ü�����ǹ���, '$g4[bbs_path]/new.php','my_datetime')");
?>
</div>
</div>

<div class="row-fluid row">
<div class="col-sm-6">
<?
// ��α� �ֽű��� ���
include_once("$g4[path]/lib/latest.gblog.lib.php");
echo latest_gblog('naver','',12,40);
?>
</div>
<div class="col-sm-6">
<?
// Ŭ�� �ֽű��� ���
?>
</div>
</div>

<div class="row-fluid row">
<div class="col-sm-6">
<?
// �ֱٱ� - ���� �׳� ����ϰ� ������ ������ ��,
echo db_cache('gr_trash', 1, "latest(naver, gnu4_pack)");
?>
</div>
<div class="col-sm-6">
<?echo db_cache('gr_turning', 1, "latest(naver, gnu4_turning)");?>
</div>
</div>

<!-- ����ȭ�� �ֽű� �� -->