<?
$sub_menu = "100210";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

$g4[title] = "db ���";

// ������� ���� �̸�, ��¥�� ���ݴϴ�.
$filename = $_SERVER['HTTP_HOST']."_".$g4[table_prefix]."_".date("Ymd").".sql";

// === ���α׷� �ҽ�, http://davidwalsh.name/backup-mysql-database-php
function backup_tables($table_prefix) {

    global $g4;

    $sql = "SHOW TABLES like '$table_prefix%'";
    $result = sql_query($sql);

    $tables = array();
    while($row = sql_fetch_array($result)) {
        // ���̺� �÷��� �̸��� ���Ƿ� �ٲ�, �迭�� implode�ؾ� ���� ���´�. 
        // �迭�� �÷��� 1���� ���� implode, 2�� �̻��� array_values�� ���°� ����.
        $tables[] = implode($row);
    }

    //cycle through
    foreach($tables as $table) {

        // ���̺��� ���Ǹ� ���
        // Ȥ�� �Ǽ��� �� �ֱ� ������, DROP TABLE ����� �ڸ�Ʈ�� ���ƵӴϴ�.
        // �ִµ�, ���̺� �μ��� ������ �ø��� ��� ���� �ְŵ��.
        //$return.= 'DROP TABLE IF EXISTS '.$table.';';
        $sql = " SHOW CREATE TABLE $table ";
        $row2 = sql_fetch($sql);
        $row2 = array_values($row2);
        echo "\n\n".$row2[1].";\n\n";

        // ���̺��� �ʵ带 ���.
        $result = sql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);

        for ($i = 0; $i < $num_fields; $i++) {
            while($row = sql_fetch_array($result)) {
                $row = array_values($row);
                $return = 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) 
                {
                  $row[$j] = addslashes($row[$j]);
                  $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
                  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                  if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";

                // �ѹ��� echo�� �ϸ� ���� ������ �־, ������ ����� �մϴ�.
                echo $return;
            }
        }
        echo "\n\n\n";
    }
}

// ���κ��� admin_setup.php���� �����ͼ� ������ �ڵ�
function zbDB_Header($filename) {
		global $HTTP_USER_AGENT;
		//if(eregi("msie",$HTTP_USER_AGENT)) $browser="1"; else $browser="0";
		if(preg_match("/msie/i",$HTTP_USER_AGENT)) $browser="1"; else $browser="0";
		header("Content-Type: application/octet-stream");
		if ($browser) {
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Expires: 0");
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
		} else {
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Expires: 0");
			header("Pragma: public");
		}
}

zbDB_Header($filename);
//backup_tables("$g4[table_prefix]");
backup_tables("");
?>
