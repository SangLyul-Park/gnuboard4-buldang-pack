<?
include_once("./_common.php");

header("P3P:CP='������ħ��ȣ'");

$g4['title'] = "����������޹�ħ";
include_once("./_head.php");

// ��Ͽ� ���õ� ������ �߰��� �о� ���Դϴ�.
$config = get_config("reg");
?>

<div class="section" style="margin-bottom:20px">
    <h2 class="hx"><?=$g4['title']?></h2>
      	<div class="tx">
      	    <?=nl2br(stripslashes($config[cf_privacy]))?>
        </div>
  	<a class="section_more" href="#">
</div>

<?
include_once("./_tail.php");
?>
