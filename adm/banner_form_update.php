<?
$sub_menu = "300900";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

$bn_id = $_POST[bn_id];
$bg_id = $_POST[bg_id];
$bn_subject = $_POST[bn_subject];

if (!bg_id) { alert("�׷� ID�� �ݵ�� �����ϼ���."); }
if (!$bn_id) { alert("��� ID�� �ݵ�� �Է��ϼ���."); }
if (!preg_match("/^([A-Za-z0-9_]{1,20})$/", $bn_id)) { alert("��� ID���� ������� ������, ����, _ �� ��� �����մϴ�. (20�� �̳�)"); }
if (!$bn_subject) { alert("�Խ��� ������ �Է��ϼ���."); }

if ($img = $_FILES[bn_image][name]) {
    if (!preg_match("/\.(gif|jpg|png)$/i", $img)) {
        alert("��� �̹����� gif, jpg, png ������ �ƴմϴ�.");
    }
}

check_token();

// ���� ������ ���� ����
@mkdir("$g4[data_path]/banner", 0707);
@chmod("$g4[data_path]/banner", 0707);

$banner_path = "$g4[data_path]/banner/$bg_id";
$bn_filename  = $_FILES[bn_image][name];

// ��� ���丮 ���� - ��� �׷캰�� ����
@mkdir($banner_path, 0707);
@chmod($banner_path, 0707);

// ���丮�� �ִ� ������ ����� ������ �ʰ� �Ѵ�.
$file = $banner_path . "/index.php";
$f = @fopen($file, "w");
@fwrite($f, "");
@fclose($f);
@chmod($file, 0606);

$bn_url                 = $_POST[bn_url];
$bn_target              = $_POST[bn_target];
$bn_use                 = $_POST[bn_use];
$bn_order               = $_POST[bn_order];
$bn_start_datetime      = $_POST[bn_start_datetime];
$bn_end_datetime        = $_POST[bn_end_datetime];
$bn_text                = $_POST[bn_text];
// ��¥�� ��� ������ ������ �־��ش�
if ($bn_start_datetime == "0000-00-00 00:00:00" || $bn_end_datetime == "0000-00-00 00:00:00")
    $bn_start_datetime = $bn_end_datetime = $g4['time_ymdhis'];
// ��¥�� ������ �ڿ� ��.��.�ʸ� �ٿ��ش�
if (strlen(trim($bn_end_datetime)) == 10)
    $bn_end_datetime .= " 23:59:59";
$bn_1_subj              = $_POST[bn_1_subj];
$bn_2_subj              = $_POST[bn_2_subj];
$bn_3_subj              = $_POST[bn_3_subj];
$bn_1                   = $_POST[bn_1];
$bn_2                   = $_POST[bn_2];
$bn_3                   = $_POST[bn_3];

$sql_common = " bg_id               = '$bg_id',
                bn_subject          = '$bn_subject',
                bn_url              = '$bn_url',
                bn_target           = '$bn_target',
                bn_start_datetime   = '$bn_start_datetime',
                bn_end_datetime     = '$bn_end_datetime',
                bn_use              = '$bn_use',
                bn_order            = '$bn_order',
                bn_text             = '$bn_text',
                bn_1_subj           = '$bn_1_subj',
                bn_2_subj           = '$bn_2_subj',
                bn_3_subj           = '$bn_3_subj',
                bn_1                = '$bn_1',
                bn_2                = '$bn_2',
                bn_3                = '$bn_3'
                 ";

if ($_FILES[bn_image][name]) {
    $bn_image_urlencode = $bn_id."_".time();
    $sql_common .= " , bn_image = '$bn_image_urlencode' ";
    $sql_common .= " , bn_filename = '$bn_filename' ";
}

if ($bn_image_del) {
    @unlink("$banner_path/$bn_image_del");
    $sql_common .= " , bn_image = '', bn_filename = '' ";
}

if ($w == "") {
    $row = sql_fetch(" select count(*) as cnt from $g4[banner_table] where bn_id = '$bn_id' ");
    if ($row[cnt])
        alert("{$bn_id} ��(��) �̹� �����ϴ� ��� ID �Դϴ�.");

    $sql = " insert into $g4[banner_table]
                set bn_id = '$bn_id',
                    bn_datetime = '$g4[time_ymdhis]',
                    $sql_common ";
    sql_query($sql);

} else if ($w == "u") {

    // ������Ʈ�� �ϴµ�, �׷��� �޶�����??? �̹��� ��ΰ� �޶�����...�Ф�...
    $result = sql_fetch(" select * from $g4[banner_table] where bn_id = '$bn_id' ");
    if ($bg_id !== $result['bg_id']) {
        $from_image = "$g4[data_path]/banner/$result[bg_id]/$result[bn_image]";
        $to_image = "$banner_path/$result[bn_image]";
        rename("$from_image", "$to_image");
    }

    $sql = " update $g4[banner_table]
                set 
                    bn_datetime = '$g4[time_ymdhis]',
                    $sql_common
              where bn_id = '$bn_id' ";
    $result = sql_query($sql);
}

// ���� �׷쳻 �Խ��� ���� �ɼ� ����
$s = "";
if ($chk_use) $s .= " , bn_use = '$bn_use' ";
if ($chk_target) $s .= " , bn_target = '$bb_target' ";
if ($chk_start_datetime) $s .= " , bn_start_datetime = '$bn_start_datetime' ";
if ($chk_end_datetime) $s .= " , bn_end_datetime = '$bn_end_datetime' ";
for ($i=1; $i<=10; $i++) {
    if ($_POST["chk_{$i}"]) {
        $s .= " , bn_{$i}_subj = '".$_POST["bn_{$i}_subj"]."' ";
        $s .= " , bn_{$i} = '".$_POST["bn_{$i}"]."' ";
    }
}

if ($s) {
        $sql = " update $g4[banner_table]
                    set bn_id = bn_id 
                        {$s}
                  where bg_id = '$bg_id' ";
        sql_query($sql);
}


if ($_FILES[bn_image][name]) { 
    $bn_image_path = "$banner_path/$bn_image_urlencode";
    move_uploaded_file($_FILES[bn_image][tmp_name], $bn_image_path);
    chmod($bn_image_path, 0606);
}

goto_url("./banner_form.php?w=u&bn_id=$bn_id$qstr");
?>
