<? 
$g4_path = ".."; 
include_once("$g4_path/common.php"); 
$g4[title] = "����Ʈ��å"; 
include_once("$g4[path]/head.php"); 

//$sql_common = " from $g4[board_table] a where (1) and bo_use_search = '1' "; //�Խ��ǰ����ڿ��� �˻����� ���� 
//$sql_common = " from $g4[group_table] a left join $g4[board_table] b on a.gr_id = b.gr_id where (1)"; // �Ϲ����� ����
$sql_common = " from $g4[group_table] a left join $g4[board_table] b on a.gr_id = b.gr_id where (b.bo_use_search = 1 and a.gr_use_access = 0) "; // �Ϲ����� ����

$sql = " select count(*) as cnt $sql_common"; 
$row = sql_fetch($sql); 
$total_count = $row[cnt]; 

$sql = " select * $sql_common"; 
$result = sql_query($sql); 

if (!$sst) { 
$sst= "a.gr_id, a.bo_subject"; 
$sod = "desc"; 
} 
//$sql_order = " order by gr_subject "; ����
$sql_order = " order by a.gr_id, b.bo_table ";

$sql = " select count(*) as cnt 
$sql_common 

$sql_search 
$sql_order "; 
$row = sql_fetch($sql); 
$total_count = $row[cnt]; 

//$rows = $config[cf_page_rows]; 
$rows = 50; // ���η� ��� �Խ��� ��������?

$total_page= ceil($total_count / $rows);// ��ü ������ ��� 
if ($page == "") { $page = 1; } // �������� ������ ù ������ (1 ������) 
$from_record = ($page - 1) * $rows; // ���� ���� ���� 

$sql = " select * 
$sql_common 
$sql_search 
$sql_order 
limit $from_record, $rows "; 
$result = sql_query($sql); 

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>"; 

$colspan = 27; 
?> 

<style> 
.tbline1  { border-top: 1px solid #D7D7D7; border-left: 1px solid #D7D7D7; } 
.tbline2  { border-right: 1px solid #D7D7D7; border-bottom: 1px solid #D7D7D7; } 
</style> 

<a href="<?=$g4['path']?>/sub/point_rule.php"><img src="./img/point_rule.jpg"></a>

<table width="90%" align="center" border="0" cellpadding="5" cellspacing="0"> 
<tr> 
<td> 
* ȸ�����Խ� : <?=$config[cf_register_point]?> ��<br /> 
* ȸ���α�� : <?=$config[cf_login_point]?> �� (�Ϸ� �ѹ��� ����)<br /><br />
* ���� ������ : - <?=$config[cf_memo_send_point]?> ��<br />
* ȸ����õ�� : <?=$config[cf_recommend_point]?> ��<br /><br /><br />

�� �Խ��Ǻ��� ���б�, �۾���, �亯/�ڸ�Ʈ����, �ٿ�ε�� ����Ʈ�� Ʋ���Ƿ� �Ʒ� ǥ�� �����ϼ���. 
[�Խ��Ǽ� : <?=number_format($total_count)?>��] 
</td> 
</tr> 
</table> 

<table width="95%" align="center" border="0" cellpadding="5" cellspacing="0" class="tbline1"> 
<tr align="center"> 
    <td class="tbline2">�׷��</td> 
<td class="tbline2">�Խ��Ǹ�</td> 
    <td class="tbline2">���б�</td> 
    <td class="tbline2">�۾���</td> 
    <td class="tbline2">�ڸ�Ʈ����</td> 
    <td class="tbline2">�ٿ�ε�</td> 
</tr> 


<? 
for ($i=0; $row=sql_fetch_array($result); $i++) { 


//$sql_search = " where gr_id not in ('���ܱ׷�1', '���ܱ׷�2') "; //sir. �����ڰ� �˷���
//���ܰԽ��� ||(or) �� �����մϴ�.
//��) if($row[bo_table]==test||$row[bo_table]==aaa||$row[bo_table]==qna||$row[bo_table]==link){} 
if($row[bo_table]==link){} 
else{ ?> 

<tr onMouseOver=this.style.backgroundColor='#eeeeee' onMouseOut=this.style.backgroundColor=''> 
<td class="tbline2"> 
        <a href='<?=$g4[bbs_path]?>/group.php?gr_id=<?=$row[gr_id]?>'><b><?=$row[gr_subject]?></b></a> 
    </td> 
<td class="tbline2"> 
        <a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$row[bo_table]?>'><b><?=$row[bo_subject]?></b></a> 
    </td> 
    <td align="right" class="tbline2"><?=$row[bo_read_point]?> ��</td> 
    <td align="right" class="tbline2"><?=$row[bo_write_point]?> ��</td> 
    <td align="right" class="tbline2"><?=$row[bo_comment_point]?> ��</td> 
    <td align="right" class="tbline2"><?=$row[bo_download_point]?> ��</td> 
</tr> 
<? } ?> 

<? }  if ($i == 0) echo "<tr><td colspan=6 align=center height=100>�ڷᰡ �����ϴ�.</td></tr>"; ?> 
</table> 

<? 
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?page="); 
echo "<table width='95%' height='40' cellpadding=0 cellspacing=0>"; 
echo "<tr><td width='30%' align='right'>$pagelist&nbsp;&nbsp;</td></tr></table>\n"; 
?> 

<? 
include_once("$g4[path]/tail.php"); 
?>
