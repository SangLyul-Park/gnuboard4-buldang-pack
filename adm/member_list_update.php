<?
$sub_menu = "200100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

check_token();

for ($i=0; $i<count($chk); $i++) 
{
    // ���� ��ȣ�� �ѱ�
    $k = $_POST['chk'][$i];

    $mb_id = $_POST['mb_id'][$k];
    $mb_level = $_POST['mb_level'][$k];
    $mb_intercept_date = $_POST['mb_intercept_date'][$k];

    $mb = get_member($mb_id);

    if (!$mb[mb_id]) {
        $msg .= "$mb[mb_id] : ȸ���ڷᰡ �������� �ʽ��ϴ�.\\n";
    } else if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level]) {
        $msg .= "$mb[mb_id] : �ڽź��� ������ ���ų� ���� ȸ���� ������ �� �����ϴ�.\\n";
    } else if ($member[mb_id] == $mb[mb_id]) {
        $msg .= "$mb[mb_id] : �α��� ���� �����ڴ� ���� �� �� �����ϴ�.\\n";
    } else {
        $sql = " update $g4[member_table]
                    set mb_level          = '{$mb_level}',
                        mb_intercept_date = '{$mb_intercept_date}'
                  where mb_id             = '{$mb_id}' ";
        sql_query($sql);
    }

    // ȸ�������� ������Ʈ �� ��쿡�� ������ ��¥�� history�� ��� �մϴ�.
    if ($mb[mb_level] !== $mb_level) {
        sql_query(" update $g4[member_table] set mb_level_datetime = '$g4[time_ymdhis]' where mb_id='$mb_id' ");
        sql_query(" insert into $g4[member_level_history_table] set mb_id='$mb_id', from_level='$mb[mb_level]', to_level='$mb_level', level_datetime='$g4[time_ymdhis]' ");
    }
}

if ($msg)
    echo "<script language='JavaScript'> alert('$msg'); </script>";

goto_url("./member_list.php?$qstr");
?>
