<?
$sub_menu = "300810";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

if (!$ok)
    alert();

if ($is_admin != "super")
    alert("�Ⱦ��� �̹��� ������ �ְ�����ڸ� �����մϴ�.");

$g4[title] = "�Ⱦ��� �̹��� ����";
include_once("./admin.head.php");

echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

echo "<script>document.getElementById('ct').innerHTML += '<p>�Ⱦ��� �̹��� ������...';</script>\n";
flush();

// ������� 7�� ������ �̹����� ���ؼ��� clear �մϴ�.
$clear_days = 3;
$clear_datetime = date("Y-m-d H:i:s", $g4[server_time] - (86400 * $clear_days));

// �ѹ��� ������ �̹����� ����
$max_mb_num = 100;

// ������ �̹�������� ����� - �հź���
$sql = " SELECT *
           FROM $g4[board_cheditor_table] 
          WHERE bc_datetime < '{$clear_datetime}' and ( wr_id is null or del = '1' )
          ORDER BY bc_id asc ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    // ������ ���ڰ� �Ǹ� break;
    if ($i >= $max_mb_num) 
        break;

    // $img[src] �� ���� ������ �̹Ƿ� �̹��� ������ ����θ� ���մϴ�.
    // �̷��� �߶���� ����� �� ��ΰ� ���´�.
    $fl = explode("/$g4[data]/",$row[bc_dir]);
    $rel_path = "../" . $g4[data] . "/" . $fl[1];

    $img_link = $rel_path . "/" . $row[bc_file];

    // ������� �־�� ���丮. ���� _delete�� ������.
    $img_bkup = $rel_path . "_delete";
    if (!file_exists("$img_bkup")) {
        @mkdir($img_bkup, 0707);
        @chmod($img_bkup, 0707);
    }
    $bkup_link = $img_bkup . "/" . $row[bc_file];
    
    // �̹����� ��� �޴´�
    rename($img_link, $bkup_link);

    // �̹��� ������ �����
    $sql = " delete from $g4[board_cheditor_table] where bc_id = '$row[bc_id]' ";
    sql_query($sql);

    $str = $row[bo_table]." �Խ��ǿ��� ".$row[bc_source]." ������ ���� �Ǿ����ϴ�<br>";
    echo "<script>document.getElementById('ct').innerHTML += '$str';</script>\n";
    flush();
}

echo "<script>document.getElementById('ct').innerHTML += '<p>�� ".$i."���� �Ⱦ��� �̹����� ���� �Ǿ����ϴ�.';</script>\n";
echo "<script>document.getElementById('ct').innerHTML += '<a href=\'" . $g4[admin_path] . "/chimage_unused_list.php\'>�Ⱦ����̹��������� �̵��ϱ�</a>'</script>\n";
?>
