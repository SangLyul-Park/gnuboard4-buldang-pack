<?
include_once("./_common.php");

// ������ �±׸� �����ݴϴ�
$id = strip_tags($id);

// ��Ͽ� ���õ� ������ �߰��� �о� ���Դϴ�.
$config = get_config("reg");

switch ($id) {
    case 'disclaimer' :
        $g4['title'] = "å���Ѱ�� ��������";
        $wr_content = nl2br(implode("", file("./disclaimer.php")));
        break;
    case 'rejection' :
        $g4['title'] = "�̸����ּҹ��ܼ����ź�";
        $wr_content = nl2br(implode("", file("./rejection.php")));
        break;
    case 'service' :
    default :
        $g4['title'] = "�̿���";
        $wr_content = nl2br(stripslashes($config[cf_stipulation]));
        break;
    case 'privacy' :
    default :
        $g4['title'] = "����������޹�ħ";
        $wr_content = nl2br(stripslashes($config[cf_privacy]));
        break;
}
include_once("./_head.php");
?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><?=$g4['title']?></h3>
  </div>
  <div class="panel-body">
    <?=$wr_content?>
  </div>
</div>
<?
include_once("./_tail.php");
?>