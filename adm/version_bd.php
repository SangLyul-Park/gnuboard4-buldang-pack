<? 
//
// ������(korone)�� , ���Ծƺ�(eagletalon)�Բ��� ����� �ּ̽��ϴ�.
//

$sub_menu = "100900"; 
include_once("./_common.php"); 

auth_check($auth[$sub_menu], "r");

$g4[title] = "����Ȯ��"; 

include_once("./admin.head.php"); 
include_once("$g4[path]/lib/mailer.lib.php"); 

$handle = @fopen("$g4[path]/HISTORY_BD", "r");
if ($handle) {
    $buffer = fgetss($handle, 4096);
    fclose($handle);
}

echo "������� : <b>";
echo "$buffer";
echo "</b>";

if ($config['cf_db_version'])
    echo "&nbsp;&nbsp;DB���� : <b>$config[cf_db_version]</b>";
?> 

<table width=100% border="0" align="left" cellpadding="0" cellspacing="0"> 
<tr> 
    <td> 

<textarea name="textarea" style='width:100%; line-height:150%; padding:10px;' rows="25" class=ed readonly><?=implode("", file("$g4[path]/HISTORY_BD"));?></textarea> 

    </td> 
</tr>
<tr>
    <td>
    ������������� HISTORY_BD ������ ù���� �о �״�� �����ִ� �� �Դϴ�.<br>
    �������� �߽����� ���������� ������� �ʾҴٸ� HISTORY_BD ������ ���� �Ͻñ� �ٶ��ϴ�.
    </td>
</tr>
</table> 

<? 
include_once("./admin.tail.php"); 
?> 
