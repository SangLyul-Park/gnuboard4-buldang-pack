<?
include_once("./_common.php");

$g4[title] = "����Ʈ �Խù� �ϰ� ����(Flag Off�� �ϰ� �Խñ� ������ ���մϴ�)" . $act;
include_once("$g4[path]/head.sub.php");

// ���� : /bbs/delete_all.php (�ش� �ڵ尡 ����Ǹ� �� �ڵ嵵 �ݵ�� �����ؾ� ��)

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

if ($sw == "d" || $sw == "r")
    ;
else
    alert("�ٸ��� ���� ����Դϴ�.");

// $_POST[chk_wr_id] : $list[$i][wr_id]}|{$list[$i][bo_table]}

$tmp_array = array();
if ($gp_id) // �Ǻ�����
    $tmp_array[0] = $gl_id;
else // �ϰ�����
    $tmp_array = $_POST[chk_gl_id];

for ($i=count($tmp_array)-1; $i>=0; $i--) {

    if ($sw == "r") {
        $sql = " update $g4[good_list_table] set gl_flag = 0 where gl_id = '{$tmp_array[$i]}' ";
        $write = sql_query($sql);
        $gl_flag = 1;
    } else {
        $sql = " update $g4[good_list_table] set gl_flag = 1 where gl_id = '{$tmp_array[$i]}' ";
        $write = sql_query($sql);
        $gl_flag = 0;
    }

} // for loop�� ��

goto_url("$g4[bbs_path]/good_list.php?gr_id=$gr_id&bo_table=$bo_table&gl_flag=$gl_flag&page=$page" . $qstr);
?>
