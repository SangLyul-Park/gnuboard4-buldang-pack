<?
if (!defined('_GNUBOARD_')) exit;

// cheditor�� ���ε��� �̹��� ��������
function chimage($skin_dir="", $bo_table, $wr_id=0, $rows=10)
{
    global $config, $g4;

    if ($wr_id == 0) {
        // �Խ����� chimage�� $rows ��ŭ �����ش�. ��? �ʹ� �����ϱ�.
        $sql = " select * from $g4[board_cheditor_table] where bo_table = '$bo_table' and and del = 0 and bc_type > 0 limit 0, $rows ";
    } else {
        // �Խñ��� chimage�� �� �����ִ°� ��Ģ. �ʹ� ������ �������� ����� ��.
        $sql = " select * from $g4[board_cheditor_table] where bo_table = '$bo_table' and wr_id='$wr_id' and del = 0 and bc_type > 0 ";
    }

    if ($skin_dir)
        $chimage_skin_path = "$g4[path]/chimage/connect/$skin_dir";
    else
        $chimage_skin_path = "$g4[path]/skin/chimage/basic";

    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $list[$i] = $row;

        // $img[src] �� ���� ������ �̹Ƿ� �̹��� ������ ����θ� ���մϴ�.
        // �̷��� �߶���� ����� �� ��ΰ� ���´�.
        $fl = explode("/$g4[data]/",$row[bc_dir]);
        $rel_path = "../" . $g4[data] . "/" . $fl[1];

        $list[$i]['image_path'] = $rel_path . "/" . $row['bc_file'];
    }

    ob_start();
    include_once ("$chimage_skin_path/chimage.skin.php");
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>