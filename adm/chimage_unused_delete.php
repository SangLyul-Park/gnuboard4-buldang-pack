<?
$sub_menu = "300820";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

check_token();

//print_r2($_POST);

for ($i=0; $i<count($chk); $i++) {
    // ���� ��ȣ�� �ѱ�
    $k = $_POST[chk][$i];

    $bc_now = $bc_id[$k];
    
    // �̹��� ������ �о� �´�
    $bc = sql_fetch(" select * from $g4[board_cheditor_table] where bc_id = '$bc_now' ");

    // $img[src] �� ���� ������ �̹Ƿ� �̹��� ������ ����θ� ���մϴ�.
    // �̷��� �߶���� ����� �� ��ΰ� ���´�.
    $fl = explode("/$g4[data]/",$bc[bc_dir]);
    $rel_path = "../" . $g4[data] . "/" . $fl[1];

    $img_link = $rel_path . "/" . $bc[bc_file];

    // ������� �־�� ���丮. ���� _delete�� ������.
    $img_bkup = $rel_path . "_delete";
    if (!file_exists("$img_bkup")) {
        @mkdir($img_bkup, 0707);
        @chmod($img_bkup, 0707);
    }
    $bkup_link = $img_bkup . "/" . $bc[bc_file];
    
    // �̹����� ��� �޴´�
    rename("$img_link", "$bkup_link");

    // �̹��� ������ �����
    $sql = " delete from $g4[board_cheditor_table] where bc_id = '$bc_now' ";
    sql_query($sql);
}

goto_url("chimage_unused_list.php?$qstr");
?>
