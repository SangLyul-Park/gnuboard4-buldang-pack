<?
include_once("./_common.php");

$g4[title] = $member[mb_nick] . "���� ���θ��";
//include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/head.php");

$po_id = (int) $po_id;
$po_url = strip_tags($po_url);
$mb_id = $member[mb_id];

// �������
$sql_order = " order by po_no desc ";

if ($po_id == 0) {

    // ���� ���θ�� �ڵ�
    $sql = " select * from $g4[promotion_sign_table] where mb_id = '$mb_id' $sql_order ";
    $result = sql_query($sql);

    echo "���� ���θ��";
    echo "<ul>";
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        $po = sql_fetch(" select * from $g4[promotion_table] where po_id = '$row[po_id]' ");
        echo "<li><a href='$g4[bbs_path]/promotion.php?po_id=$row[po_id]'>$po[po_name]</a>";
        $po_url = "$g4[url]/$g4[bbs]/promotion.php?po_id=$row[po_id]&po_url=$row[po_url]";
        echo "<br><a href='$po_url' target=new>$po_url</a>";
        echo "<br>$row[po_password]";
    }
    echo "</ul>";

    // ���θ�� �ڵ尡 ������, ��� ���θ���� ���� �ݴϴ�.
    $sql = " select * from $g4[promotion_table] order by po_id desc ";
    $result = sql_query($sql);

    echo "��ü ���θ��";
    echo "<ul>";
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        echo "<li><a href='$g4[bbs_path]/promotion.php?po_id=$row[po_id]'>$row[po_name]</a>";
    }
    echo "</ul>";

} else if ($po_id > 0 && $po_url == "") {

    if (!$member[mb_id]) 
        alert("ȸ���� ��ȸ�Ͻ� �� �ֽ��ϴ�.", "./login.php?&url=".urlencode("promotion.php?po_id=$bo_$po_id"));

    // ������ ���θ�Ǹ� ���� �ݴϴ�.
    $sql = " select * from $g4[promotion_table] where po_id = '$po_id' ";
    $po = sql_fetch($sql);

    echo "<ul>";
    echo "<li>���θ�� : " . $po[po_name];
    echo "</ul>";
    
    ?>
    
<form name=fpointlist2 method=post onsubmit="return fpointlist2_submit(this);" autocomplete="off">
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<input type=hidden name=mb_id value='<?=$member[mb_id]?>'>
<input type=hidden name=w value='add'>
<input type=hidden name=po_id value='<?=$po[po_id]?>'>

<table width=100% cellpadding=0 cellspacing=1 class=tablebg>
<colgroup width=''>
<colgroup width=100>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>��������</td>
    <td>�Է�</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<tr class='ht center'>
    <td><input type=text class=ed name=po_content required itemname='����' style='width:99%;'></td>
    <td><input type=submit class=btn1 value='  Ȯ  ��  '></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>
</form>

    <?
    // �������� ���θ�� ȸ����
    $sql = " select * from $g4[promotion_sign_table] where po_id = '$po_id' $sql_order ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
    }
} else if ($po_id > 0 && $po_url !== "") {
    // ���θ�� �ڵ� üũ
    ?>
<form name=fpointlist2 method=post onsubmit="return fpointlist2_submit(this);" autocomplete="off">
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<input type=hidden name=mb_id value='<?=$member[mb_id]?>'>
<input type=hidden name=w value='check'>
<input type=hidden name=po_url value='<?=$po_url?>'>


<table width=100% cellpadding=0 cellspacing=1 class=tablebg>
<colgroup width=300>
<colgroup width=100>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>üũ �н�����</td>
    <td>�Է�</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<tr class='ht center'>
    <td><input type=text class=ed name=po_password required itemname='����' style='width:99%;'></td>
    <td><input type=submit class=btn1 value='  Ȯ  ��  '></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>
</form>

    <?
}
?>

<script type="text/javascript">
function fpointlist2_submit(f)
{
    f.action = "./promotion_update.php";
    return true;
}
</script>

<?
//$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
//include_once("$member_skin_path/promotion_sign.skin.php");

include_once("$g4[path]/tail.php");
//include_once("$g4[path]/tail.sub.php");
?>
