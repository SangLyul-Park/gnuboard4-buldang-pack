<?
include_once("./_common.php");

include_once("$g4[path]/head.sub.php");

// ȸ������ �˻��Ͽ� ȸ���� �ƴ� ��쿡�� �α��� �������� �̵��Ѵ�.
if (!$member[mb_id]) 
    alert("ȸ���� �Ű� ȭ���� �� �� �ֽ��ϴ�.");

    
// �Ű� ���� ��ȸ
if (!$is_admin)
    $sql_where = " and sg_mb_id = '$member[mb_id]' ";

$singo = sql_fetch(" select * from $g4[singo_table] where sg_id = '$sg_id' $sql_where ");

?>

<table width=100% cellpadding=5 cellspacing=0 border=0>
<colgroup width=90>
<colgroup >
<tr>
    <td colspan=2>
    ȸ�� �Ű� ���� ��ȸ
    </td>
</tr>
<tr class='ht'><td colspan=2 height=10></td></tr>
<tr>
    <td>�Ű��� ȸ��</td>
    <td><?=$singo['sg_mb_id']?></td>
</tr>
<tr>
    <td>�Ű�� ȸ��</td>
    <td><?=$singo['mb_id']?></td>
</tr>
<tr>
    <td>�Ű� �Ͻ�</td>
    <td class="style5" ><?=$singo['sg_datetime']?></td>
</tr>
<tr>
    <td>�Ű� ����</td>
    <td><?=$singo['sg_reason']?></td>
</tr>

</table>
<?
?>
