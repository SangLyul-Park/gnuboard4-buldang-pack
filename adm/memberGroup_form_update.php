<?
$sub_menu = "200100";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

while(list($key,$value) = each($HTTP_POST_VARS)){
        echo("�������� :".$key." - ������ ���� :".$value."<br>");
}	

if ($w == "")
{
    alert("�߸��� ���ڰ��Դϴ�. w : �Ű����� Ȯ��"); 
}

else if ($w == "u") 
{
    if ($is_admin != "super")
        alert("�����ڸ��� �����ϽǼ� �ֽ��ϴ�..");

    $sql = " select count(*) as cnt from $g4[member_group_table] where gl_id = '$gl_id' ";	
    $gd = sql_fetch($sql);
    if ($gd[cnt] != 1)
        alert("�������� �ʰų� �ߺ��� �ִ´� ȸ�������Դϴ�."); 

    $sql = " update $g4[member_group_table]
                set gl_name = '$gl_name'
              where gl_id = '$gl_id' ";	
    sql_query($sql);
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

goto_url("./memberGroup_list.php");
?>
