<?
$sub_menu = "300250";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

$html_title = "ī�װ�";
if ($w == "") {
    $html_title .= " ����";

    $len = strlen($ca_id);
    if ($len >= 20) 
        alert("ī�װ��� �� �̻� �߰��� �� �����ϴ�.\\n\\n5�ܰ� �з������� �����մϴ�.");

    // 4�ڸ��� ���� ū subid�� ã��
    $len2 = $len + 1;
    $sql = " select MAX(SUBSTRING(ca_id,$len2,4)) as max_caid from $g4[category_table]
              where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
    $row = sql_fetch($sql);

    if ($ca_id) // 2�ܰ��̻�
    { 
        $sql = " select * from $g4[category_table] where ca_id = '$ca_id' ";
        $ca = sql_fetch($sql);
        $ca[ca_subject] = "";
    } 
    else // 1�ܰ�
    {
        $ca['ca_use'] = 1;
    }

    $sub_id = getNextAlphaNumeric($row[max_caid]);

} else if ($w == "u") {
    $html_title .= " ����";

    $sql = " select * from $g4[category_table] where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
    if (!$ca[ca_id])
        alert("�������� �ʴ� ī�װ� �Դϴ�.");

    $ca_table_attr = "readonly style='background-color:#dddddd'";
}

$g4[title] = $html_title;
include_once ("./admin.head.php");
?>

<form name=fcategoryform method=post onsubmit="return fcategoryform_submit(this)" enctype="multipart/form-data">
<input type=hidden name="w"     value="<?=$w?>">
<input type=hidden name="sfl"   value="<?=$sfl?>">
<input type=hidden name="stx"   value="<?=$stx?>">
<input type=hidden name="sst"   value="<?=$sst?>">
<input type=hidden name="sod"   value="<?=$sod?>">
<input type=hidden name="page"  value="<?=$page?>">
<input type=hidden name="token" value="<?=$token?>">

<table width=100% cellpadding=0 cellspacing=0 border=0>
<colgroup width=5% class='left'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=75% class='col2 pad2'>
<tr>
    <td colspan=3 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> <?=$html_title?></td>
</tr>
<tr><td colspan=3 class='line1'></td></tr>
<tr class='ht'>
    <td></td>
    <td>ī�װ�ID</td>
    <td>
        <? 
        if ($w == "") {
        ?>
        <?=$ca[ca_id]?> <input type=text class=ed id=ca_id name=ca_id size='<?=$sublen?>' maxlength='<?=$sublen?>' minlength='<?=$sublen?>' <?=$ca_table_attr?> required nospace alphanumeric itemname='ī�װ�ID' value='<?=$sub_id?>'>
        ������, ���ڸ� ���� (������� 4��)
        <?=help("�ڵ����� �������� ID�� ����Ͻñ� ���ص帮���� ���� �Է��� �����ε� ����� �� �ֽ��ϴ�.\nī�װ�ID�� ���߿� ������ ���� �����Ƿ� �����ϰ� �����Ͽ� ����Ͻʽÿ�.");?>
    <? } else { ?>
        <input type=hidden name=ca_id value='<?=$ca[ca_id]?>'><?=$ca[ca_id]?>
        <? echo "<a href='./category_form.php?ca_id=$ca_id&$qstr' title='����ī�װ� �߰�'><img src='$g4[admin_path]/img/icon_insert.gif' border=0 align=absmiddle></a>"; ?>
    <? } ?>
    </td>
</tr>

<tr class='ht'>
    <td></td>
    <td>ī�װ� ����</td>
    <td>
        <input type=text class=ed name=ca_subject size=60 maxlength=120 required itemname='ī�װ� ����' value='<?=get_text($ca[ca_subject])?>'>
    </td>
</tr>

<tr><td colspan=3 class='line2'></td></tr>
<tr class='ht'>
    <td></td>
    <td>ī�װ����</td>
    <td><input type=checkbox name=ca_use value='1' <?=$ca[ca_use]?'checked':'';?>>���</td>
</tr>
<tr class='ht'>
    <td></td>
    <td>ī�װ� ����</td>
    <td><input type=text class=ed name=ca_order size=5 value='<?=$ca[ca_order]?>'> ���ڰ� ���� ī�װ� ���� ���</td>
</tr>

<tr><td colspan=3 class='line2'></td></tr>

<? for ($i=1; $i<=3; $i++) { ?>
<tr class='ht'>
    <td></td>
    <td><input type=text class=ed name='ca_<?=$i?>_subj' value='<?=get_text($ca["ca_{$i}_subj"])?>' title='�����ʵ� <?=$i?> ����' style='text-align:right;font-weight:bold;'></td>
    <td><input type=text class=ed style='width:80%;' name='ca_<?=$i?>' value='<?=get_text($ca["ca_$i"])?>' title='�����ʵ� <?=$i?> ������'></td>
</tr>
<? } ?>

<tr class='ht'>
    <td></td>
    <td>ī�װ� ������</td>
    <td><?=$ca['ca_datetime']?></td>
</tr>

</table>

<p align=center>
    <input type=submit class=btn1 accesskey='s' value='  Ȯ  ��  '>&nbsp;
    <input type=button class=btn1 value='  ��  ��  ' onclick="document.location.href='./category_list.php?<?=$qstr?>';">&nbsp;
</form>

<script type="text/javascript">
function fcategoryform_submit(f) {

    <? if ($w == "") { ?>
    f.ca_id.value = '<?=$ca[ca_id]?>' + f.ca_id.value;
    <? } ?>

    f.action = "./category_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
