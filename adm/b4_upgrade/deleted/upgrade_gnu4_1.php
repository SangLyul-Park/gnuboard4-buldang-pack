<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "�״�����4 -> �Ҵ��� ���׷��̵�";
include_once("./admin.head.php");

// ����4 ���� ���� �о���̱�
include_once("../memo.config.php");

// ���̺� ���� (�Ҵ���) ----------------------------
$file = implode("", file("$g4[path]/install.bak/sql_opencode.sql"));
eval("\$file = \"$file\";");

$f = explode(";", $file);
for ($i=0; $i<count($f); $i++) {
    if (trim($f[$i]) == "") continue;
    sql_query($f[$i], false);
    //mysql_query($f[$i]) or die(mysql_error());
}

echo " /install/sql_opencode.sql ���׷��̵� �Ϸ�<br>";
// ���̺� ���� (�Ҵ���) ---------------------------

// ���, �������� ���Ͽ��� �о���� ---------------
$service=addslashes(implode("", file("../company/service.html")));
$priv=addslashes(implode("", file("../company/privacy.html")));

$priv1=addslashes(implode("", file("../company/priv1.txt")));
$priv2=addslashes(implode("", file("../company/priv2.txt")));
$priv3=addslashes(implode("", file("../company/priv3.txt")));
$priv4=addslashes(implode("", file("../company/priv4.txt")));

$sql = " insert into $g4[config_reg_table]
            set 
                cf_stipulation  = '$service',
                cf_privacy      = '$priv',
                cf_privacy_1    = '$priv1',
                cf_privacy_2    = '$priv2',
                cf_privacy_3    = '$priv3',
                cf_privacy_4    = '$priv4'
                ";
sql_query($sql, false);
// ���, �������� ���Ͽ��� �о���� ---------------

include_once("./admin.tail.php");
?>
