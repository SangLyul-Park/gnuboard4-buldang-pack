<?
include_once("./_common.php");

$g4[title] = "�з�����";
include_once ("./_head.php");

$where = " where ";
$sql_search = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if ($save_stx != $stx)
        $page = 1;
}

$sql_common = " from $g4[category_table] ";
$sql_common .= $sql_search;


// ���̺��� ��ü ���ڵ���� ����
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") { $page = 1; } // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

if (!$sst) 
{
    $sst  = "ca_id";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

// ����� ���ڵ带 ����
$sql  = " select *
           $sql_common
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql);

$qstr  = "$qstr&sca=$sca&page=$page&save_stx=$stx";
?>

<table width=100% cellpadding=4 cellspacing=0>
<form name=flist>
<input type=hidden name=page value="<?=$page?>">
<tr>
    <td width=20%><a href='<?=$_SERVER[PHP_SELF]?>'>ó��</a></td>
    <td width=60% align=center>
        <select name=sfl>
            <option value='ca_name'>�з���
            <option value='ca_id'>�з��ڵ�
        </select>
        <? if ($sfl) echo "<script> document.flist.sfl.value = '$sfl';</script>"; ?>

        <input type=hidden name=save_stx value='<?=$stx?>'>
        <input type=text name=stx value='<?=$stx?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle>
    </td>
    <td width=20% align=right>�Ǽ� : <? echo $total_count ?>&nbsp;</td>
</tr>
</form>
</table>

<form name=fcategorylist method='post' action='./categorylistupdate.php' autocomplete='off' style="margin:0px;">

<table cellpadding=0 cellspacing=0 width=100%>
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
<tr><td colspan=11 height=2 bgcolor=#0E87F9></td></tr>
<tr align=center class=ht>
    <td width=80><?=subject_sort_link("ca_id");?>�з��ڵ�</a></td>
    <td width='' ><?=subject_sort_link("ca_name");?>�з���</a></td>
    <td width=80 title='�ش�з����� ȸ�����̵�'><?=subject_sort_link("ca_mb_id");?>ȸ�����̵�</a></td>
    <td width=60 ><?=subject_sort_link("ca_use");?>�ǸŰ���</a></td>
    <td width=60 ><?=subject_sort_link("ca_stock_qty");?>�⺻���</a></td>
    <td width=50 >��ǰ��</td>
    <td width=120>
        <? 
        if ($is_admin == 'super')
            echo "<a href='./categoryform.php'><img src='$g4[admin_path]/img/icon_insert.gif' border=0 title='1�ܰ�з� �߰�'></a>";
        else
            echo "&nbsp;";
        ?>
    </td>
</tr>
<tr><td colspan=11 height=1 bgcolor=#CCCCCC></td></tr>

<?
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $s_level = "";
    $level = strlen($row[ca_id]) / 2 - 1;
    if ($level > 0) // 2�ܰ� �̻�
    {
        $s_level = "&nbsp;&nbsp;<img src='./img/icon_catlevel.gif' border=0 width=17 height=15 align=absmiddle alt='".($level+1)."�ܰ� �з�'>";
        for ($k=1; $k<$level; $k++)
            $s_level = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $s_level;
        $style = " ";
    } 
    else // 1�ܰ�
    {
        $style = " style='border:1 solid; border-color:#0071BD;' ";
    }

    $s_add = icon("�߰�", "./categoryform.php?ca_id=$row[ca_id]&$qstr");
    $s_upd = icon("����", "./categoryform.php?w=u&ca_id=$row[ca_id]&$qstr");
    $s_vie = icon("����", "$g4[shop_path]/list.php?ca_id=$row[ca_id]");

    if ($is_admin == 'super')
        $s_del = icon("����", "javascript:del('./categoryformupdate.php?w=d&ca_id=$row[ca_id]&$qstr');");
    

    // �ش� �з��� ���� ��ǰ�� ����
    $sql1 = " select COUNT(*) as cnt from $g4[yc4_item_table] 
               where ca_id = '$row[ca_id]' 
                  or ca_id2 = '$row[ca_id]' 
                  or ca_id3 = '$row[ca_id]' ";
    $row1 = sql_fetch($sql1);

    $list = $i%2;
    echo "
    <input type=hidden name='ca_id[$i]' value='$row[ca_id]'>
    <tr class='list$list center ht'>
        <td align=left>$row[ca_id]</td>
        <td align=left>$s_level <input type=text name='ca_name[$i]' value='".get_text($row[ca_name])."' title='$row[ca_id]' required itemname='�з���' class=ed size=35 $style></td>";

    if ($is_admin == 'super')
        echo "<td><input type=text class=ed name='ca_mb_id[$i]' size=10 maxlength=20 value='$row[ca_mb_id]'></td>";
    else
    {
        echo "<input type=hidden name='ca_mb_id[$i]' value='$row[ca_mb_id]'>";
        echo "<td>$row[ca_mb_id]</td>";
    }

    echo "
        <td><input type=checkbox name='ca_use[$i]' ".($row[ca_use] ? "checked" : "")." value='1'></td>
        <td><input type=text name='ca_stock_qty[$i]'        size=6 style='text-align:right;' class=ed value='$row[ca_stock_qty]'></td>
        <td><a href='./itemlist.php?sca=$row[ca_id]'><U>$row1[cnt]</U></a></td>
        <td>$s_upd $s_del $s_vie $s_add</td>
    </tr>";
}

if ($i == 0) {
    echo "<tr><td colspan=20 height=100 bgcolor='#ffffff' align=center><span class=point>�ڷᰡ �Ѱǵ� �����ϴ�.</span></td></tr>\n";
}
?>
<tr><td colspan=11 height=1 bgcolor=#CCCCCC></td></tr>

</table>


<table width=100%>
<tr>
    <td width=50%><input type=submit class=btn1 value='�ϰ�����'></td>
    <td width=50% align=right><?=get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
</tr>
</form>
</table>


<?
include_once ("$g4[admin_path]/admin.tail.php");
?>
