<?
include_once("./_common.php");

if ($sw == "move")
    $act = "�̵�";
else if ($sw == "copy")
    $act = "����";
else 
    alert("sw ���� ����� �Ѿ���� �ʾҽ��ϴ�.");

// �Խ��� ������ �̻� ����, �̵� ����
if ($is_admin != "board" && $is_admin != "group" && $is_admin != "super") 
    alert_close("�Խ��� ������ �̻� ������ �����մϴ�.");

$g4[title] = "�Խù� " . $act;
include_once("$g4[path]/head.sub.php");

$wr_id_list = "";
if ($wr_id)
    $wr_id_list = $wr_id;
else {
    $comma = "";
    for ($i=0; $i<count($_POST[chk_wr_id]); $i++) {
        $wr_id_list .= $comma . $_POST[chk_wr_id][$i];
        $comma = ",";
    }
}

$sql = " select *
           from $g4[board_table] a,
                $g4[group_table] b
          where a.gr_id = b.gr_id
            and bo_table <> '$bo_table' ";
if ($is_admin == 'group')
    $sql .= "  and '$member[mb_level]' >= a.bo_write_level and b.gr_use_search ";
else if ($is_admin == 'board')
    $sql .= " and '$member[mb_level]' >= a.bo_write_level and a.gr_id = '$board[gr_id]' a.bo_use_search = 1 ";
$sql .= " order by a.gr_id, a.bo_order_search, a.bo_table ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;
}

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

include_once("$member_skin_path/move.skin.php");

include_once("$g4[path]/tail.sub.php");
?>