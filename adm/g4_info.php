<?
$sub_menu = "100520";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "r");

$g4[title] = "home info";
include_once("./admin.head.php");

// http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech&wr_id=656
//
// db�뷮�� ���ؼ� : http://appleis.tistory.com/507
// safe_mode�� ���ؼ� : http://us2.php.net/features.safe-mode

function size($size) {
	if(!$size) return "0 Byte";
	if($size < 1024) {
		return "$size Byte";
	} elseif($size >= 1024 && $size < 1024 * 1024) {
		return sprintf("%0.1f",$size / 1024)." KB";
	} elseif($size >= 1024 * 1024 && $size < 1024 * 1024 * 1024) {
		return sprintf("%0.1f",$size / 1024 / 1024)." MB";
	} else {
		return sprintf("%0.1f",$size / 1024 / 1024 / 1024)." GB";
	}
}

// safe ������� Ȯ��. safe��忡���� ������ �ȵǴ� ����� �ֽ�
// ini_get("safe_mode")�� ���� �� �ȳ��ͼ�...
$sm = @exec("hostname");
if ($sm)
    $safe_mode = true;
else
    $safe_mode = false;

// ������ ����
$user_id = get_current_user(); 

// os ����
$os_version = php_uname('r');

if ($safe_mode) {

// ������ ip
$ip_addr = @gethostbyname(trim(@exec("hostname")));

// ������ ��뷮�� ���� 
$account_space = exec("du -sb $g4[path]"); 
$account_space = substr($account_space,0,strlen($account_space)-3); 

// DATA ������ �뷮�� ���� 
$data_space = exec("du -sb $g4[data_path]"); 
$data_space = substr($data_space,0,strlen($data_space)-8); 

} // end of safe_mode

// Apache ������ ����
if (function_exists("apache_get_version")) {
    $apache_version = apache_get_version();

    // Apache ��� ����
    $apache_m = @apache_get_modules();
    $apache_modules = "";
    $i = 1;
    foreach ($apache_m as $row) {
        $apache_modules .= $row . " ";
        if ($i == 5) {
            $apache_modules .= "<br>";
            $i = 1;
        } else
            $i++;
    }
}

// PHP ����
$php_version = phpversion();

// Zend ����
$zend_version = zend_version();

// GD ����
$gd_support = extension_loaded('gd');
if ($gd_support) {
    $gd_info = gd_info();
    $gd_version = $gd_info['GD Version'];
} else {
    $gd_support = "GD�� ��ġ���� ����";
}

// ���ε� ������ �ִ� ���ϻ�����
$max_filesize = get_cfg_var('upload_max_filesize');

// MySQL ����
$m_version = sql_fetch(" select version() as ver");

// MySQL Stat - http://kr2.php.net/manual/kr/function.mysql-stat.php
$mysql_stat = explode('  ', mysql_stat());

// MYSQL DB�� ��뷮�� ���� 
$result = sql_query("SHOW TABLE STATUS"); 
$db_using = 0;
$db_count = 0;
$db_rows = 0;
while($dbData=mysql_fetch_array($result)) { 
    $db_using += $dbData[Data_length]+$dbData[Index_length];
    $db_count++;
    $db_rows += $dbData[Rows];
} 

// ��ü �Խ��� ����
$count_board = sql_fetch(" select count(*) as cnt from $g4[board_table] ");

// ��ü �Խñ� ��
$result = sql_query(" select bo_table from $g4[board_table] ");
$count_board_article = 0;
$count_board_comment = 0;
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $tmp_write_table = $g4['write_prefix'] . $row[bo_table]; // �Խ��� ���̺� ��ü�̸�
    $t_sum = sql_fetch(" select count(*) as cnt from $tmp_write_table ");
    $count_board_article += $t_sum[cnt];
    $t_sum = sql_fetch(" select count(*) as cnt from $tmp_write_table where wr_is_comment = 1 ");
    $count_board_comment += $t_sum[cnt];
}

// ���� ���� ������ ����Ʈ�� �� ������ ����Ʈ�� ���� 
$all_point = sql_fetch(" select sum(po_point) as sum from $g4[point_table] ");
$new_point = sql_fetch(" select sum(po_point) as sum from $g4[point_table] WHERE date_format( po_datetime, '%Y-%m-%d' ) = '$g4[time_ymd]'");

// ��� �Խ��ǿ� ÷�ε� ������ ������ ���� 
$count_data = sql_fetch("select count(*) as cnt from $g4[board_file_table]"); 

// �� ȸ�� ���� �� ȸ�� ���� ���� 
$count_member = sql_fetch(" select count(*) as cnt from $g4[member_table] where mb_leave_date = '' "); 
$new_member = sql_fetch(" select count(*) as cnt from $g4[member_table] where mb_open_date = '$g4[time_ymd]' "); 
?>

<table cellpadding=0 cellspacing=0 width=420> 
<colgroup width=160>
<colgroup width=''>
<tr> 
    <td align=left colspan=2>
    <b>���� ����</b>
    </td> 
</tr>
<tr height=15px><td></td></tr>
<tr> 
    <td>����� id</td>
    <td><?=$user_id?></td>
</tr>
<tr>
    <td>���� ��ý���</td>
    <td><?=PHP_OS?></td>
</tr>
<tr>
    <td>���� ��ý��� ����</td>
    <td><?=$os_version?></td>
</tr>

<tr> 
    <td>���� �ð�</td>
    <td><?=$g4['time_ymdhis']?></td>
</tr>
<? if (function_exists("date_default_timezone_get")) { ?>
<tr>
    <td>Default Time Zone</td>
    <td><?=date_default_timezone_get()?></td>
</tr>
<? } ?>

<? if ($safe_mode) { ?>
<tr> 
    <td>hostname</td>
    <td><?=$sm;?></td>
</tr>
<tr> 
    <td>ip �ּ�</td>
    <td><?=$ip_addr?></td>
</tr>

<tr height=15px><td></td></tr>
<tr> 
    <td>���� DISK ��뷮(A)</td>
    <td><?=size($account_space)?></td>
</tr>
<tr>
    <td>������ ���丮 ��뷮(D)</td>
    <td><?=size($data_space)?></td>
</tr>
<tr>
    <td>���α׷� ��뷮(A-D)</td>
    <td><?=size($account_space - $data_space)?></td>
</tr>
<? } ?>

<? if ($apache_version) { ?>
<tr height=15px><td></td></tr>
<tr>
    <td>Apache ����</td>
    <td><?=$apache_version;?></td>
</tr>
<tr height=15px><td></td></tr>
<tr>
    <td>Apache ���</td>
    <td><?=$apache_modules;?></td>
</tr>
<? } ?>

<tr height=15px><td></td></tr>
<tr>
    <td>PHP ����</td>
    <td><?=$php_version;?></td>
</tr>
<tr>
    <td>Zend ����</td>
    <td><?=$zend_version;?></td>
</tr>
<tr>
    <td>GD ����</td>
    <td><?=$gd_version;?></td>
</tr>
<tr>
    <td>�ִ� Upload ���ϻ�����</td>
    <td><?=$max_filesize;?></td>
</tr>
<tr>
    <td>php�� �Ҵ�� �޸� ������</td>
    <td><?=size(memory_get_usage());?></td>
</tr>
<tr height=15px><td></td></tr>
<tr>
    <td>MYSQL ����</td>
    <td><?=$m_version[ver]?>
    </td> 
</tr>
<tr>
    <td>MYSQL DB Name</td>
    <td><?=$mysql_db ?>
    </td> 
</tr>
<tr>
    <td>MYSQL DB info</td>
    <td><? $a = explode(":", $mysql_stat[0]); echo $a[0] . ": ";?>
        <?
        $days = floor($a[1]/86400);
        if ($days) echo $days . "�� ";
        $hours = (floor($a[1]/3600)%24);
        if ($hours) echo $hours . "�ð� ";
        $min = (floor($a[1]/60)%60);
        if ($min) echo $min . "��";
        ?>
        <BR>
        <?=$mysql_stat[1]?><BR>
        <? $t=explode(":", $mysql_stat[2]); echo $t[0] . ": "; echo number_format($t[1])?><BR>
        <?=$t=explode(":", $mysql_stat[3]); echo $t[0] . ": "; echo number_format($t[1])?><BR>
        <?=$t=explode(":", $mysql_stat[4]); echo $t[0] . ": "; echo number_format($t[1])?><BR>
        <?=$mysql_stat[5]?><BR>
        <?=$mysql_stat[6]?><BR>
        <?=$mysql_stat[7]?><BR>
    </td> 
</tr>
<tr>
    <td>DB ��뷮</td>
    <td><?=size($db_using)?>
    </td> 
</tr> 
<tr>
    <td>��ü DB ���̺� ����</td>
    <td><?=number_format($db_count)?>
    </td> 
</tr> 
<tr>
    <td>��ü DB ROW ����</td>
    <td><?=number_format($db_rows)?>
    </td> 
</tr> 
<tr height=15px><td></td></tr>

<tr> 
    <td align=left colspan=2>
    <b>�״�����4 ����</b>
    </td> 
</tr>
<tr height=15px><td></td></tr>
<tr>
    <td>��ü �Խ��� ����</td>
    <td><?=number_format($count_board[cnt])?>
    </td> 
</tr>
<tr>
    <td>��ü �� ����(�Խñ�+�ڸ�Ʈ)</td>
    <td><?=number_format($count_board_article)?>
    </td> 
</tr>
<tr>
    <td>��ü �Խñ� ����</td>
    <td><?=number_format($count_board_article - $count_board_comment)?>
    </td> 
</tr>
<tr>
    <td>��ü �ڸ�Ʈ ����</td>
    <td><?=number_format($count_board_comment)?>
    </td> 
</tr>
<tr>
    <td>��ü �Խ����� ÷�����ϼ�</td>
    <td><?=number_format($count_data[cnt])?>
    </td> 
</tr> 
<tr>
    <td>��ü ����Ʈ �հ�</td>
    <td><?=number_format($all_point[sum])?>
    </td> 
</tr>
<tr>
    <td>���� �߻��� ����Ʈ</td>
    <td><?=number_format($new_point[sum])?>
    </td> 
</tr>
<tr>
    <td>��ü ȸ����</td>
    <td><?=number_format($count_member[cnt])?>
    </td> 
</tr> 
<tr>
    <td>���� ������ ȸ����</td>
    <td><?=number_format($new_member[cnt])?>
    </td> 
</tr> 

</table> 


<?
include_once("./admin.tail.php");
?>
