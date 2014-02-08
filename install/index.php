<?
$g4['path'] = "..";
include_once ("../config.php");

// �۹̼��� ������ ���� �������� ��´�. drwxrwxrwx
function get_perms($mode)
{
    /* Determine Type */
    if( $mode & 0x1000 )
        $perms["type"] = 'p'; /* FIFO pipe */
    else if( $mode & 0x2000 )
        $perms["type"] = 'c'; /* Character special */
    else if( $mode & 0x4000 )
        $perms["type"] = 'd'; /* Directory */
    else if( $mode & 0x6000 )
        $perms["type"] = 'b'; /* Block special */
    else if( $mode & 0x8000 )
        $perms["type"] = '-'; /* Regular */
    else if( $mode & 0xA000 )
        $perms["type"] = 'l'; /* Symbolic Link */
    else if( $mode & 0xC000 )
        $perms["type"] = 's'; /* Socket */
    else
        $perms["type"] = 'u'; /* UNKNOWN */

    /* Determine permissions */
    $perms["owner_read"]    = ($mode & 00400) ? 'r' : '-';
    $perms["owner_write"]   = ($mode & 00200) ? 'w' : '-';
    $perms["owner_execute"] = ($mode & 00100) ? 'x' : '-';
    $perms["group_read"]    = ($mode & 00040) ? 'r' : '-';
    $perms["group_write"]   = ($mode & 00020) ? 'w' : '-';
    $perms["group_execute"] = ($mode & 00010) ? 'x' : '-';
    $perms["world_read"]    = ($mode & 00004) ? 'r' : '-';
    $perms["world_write"]   = ($mode & 00002) ? 'w' : '-';
    $perms["world_execute"] = ($mode & 00001) ? 'x' : '-';

    /* Adjust for SUID, SGID and sticky bit */
    if( $mode & 0x800 )
        $perms["owner_execute"] = ($perms["owner_execute"]=='x') ? 's' : 'S';
    if( $mode & 0x400 )
        $perms["group_execute"] = ($perms["group_execute"]=='x') ? 's' : 'S';
    if( $mode & 0x200 )
        $perms["world_execute"] = ($perms["world_execute"]=='x') ? 't' : 'T';

    return $perms;
}

// ������ �����Ѵٸ� ��ġ�� �� ����.
if (file_exists("../dbconfig.php")) {
    echo "<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'>";    
    echo <<<HEREDOC
    <script type="text/javascript">
    alert("dbconfig.php�� �־ ��ġ�Ͻ� �� �����ϴ�.\n��ġ�Ͻ÷��� dbconfig.php�� ���켼��.\n���� ��ġ�� �ϸ� db�� ��� ������ �� �ֽ��ϴ�.");
    location.href="../";
    </script>
HEREDOC;
    exit;
}

// ��Ʈ ���丮�� ���� ���� �������� �˻�.
if (!is_writeable("..")) 
{
    echo "<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'>";
    echo "<script language='JavaScript'>alert('��Ʈ ���丮�� �۹̼��� 707�� �����Ͽ� �ֽʽÿ�.\\n\\ncommon.php ������ �ִ°��� ��Ʈ ���丮 �Դϴ�.\\n\\n$> chmod 707 . \\n\\n�� ���� ��ġ�Ͽ� �ֽʽÿ�.');</script>"; 
    exit;
}
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<title>�״�����4 ��ġ (1/3) - ���̼���(License)</title>

<link rel="stylesheet" href="<?=$g4['path']?>/js/bootstrap/css/bootstrap.min.css?bver=<?=$g4[bver]?>" type="text/css" media="screen" title="no title" charset="<?=$g4[charset]?>">
<link rel="stylesheet" href="<?=$g4['path']?>/js/font-awesome/css/font-awesome.min.css?aver=<?=$g4[aver]?>" type="text/css" media="screen" title="no title" charset="<?=$g4[charset]?>">
<!--[if lt IE 7]>
    <script src="<?=$g4['path']?>/js/font-awesome/css/font-awesome-ie7.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?=$g4['path']?>/style.css?sver=<?=$g4[sver]?>" type="text/css">

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
    <script src="<?=$g4['path']?>/js/html5shiv/html5shiv.js"></script>
    <script src="<?=$g4['path']?>/js/respond/respond.min.js"></script>
<![endif]-->
</head>

<body background="img/all_bg.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<div class="container" style="width:621px;margin-top:100px;">

<div class="panel panel-primary">
<div class="panel-heading">
    <strong>�״�����4 ��ġ (1/3)</strong>
</div>
<div class="panel-body">
    <p>
    ���̼���(License) ������ �ݵ�� Ȯ���Ͻʽÿ�.
    </p>
    <textarea name="textarea" style='width:99%;margin-bottom:10px;' rows="9" class="box" readonly><?=implode("", file("../LICENSE"));?></textarea>
    <textarea name="textarea" style='width:99%' rows="9" class="box" readonly><?=implode("", file("../LICENSE_BD"));?></textarea>
    
    <p style="margin-top:5px;" class="text-danger">
    ��ġ�� ���Ͻø� �� ���뿡 �����ϼž� �մϴ�.<br>
    ���Ǹ� ���Ͻø� &lt;��, �����մϴ�&gt; ��ư�� Ŭ���� �ּ���.
    </p>

    <div class="pull-right">
        <form name=frm method=post onsubmit="return frm_submit(document.frm);" autocomplete="off" role="form" class="form-inline">
        <input type="hidden" name="agree" value="������">
        <input type="submit" name="btn_submit" class="btn btn-default" value="��, �����մϴ� ">
        </form>
    </div>

</div>
<div class="panel-footer">
</div>

</div>

</div><!-- end of container -->

<script  type="text/javascript">
function frm_submit(f)
{
    f.action = "./install_config.php";
    f.submit();
}

document.frm.btn_submit.focus();
</script>

</body>
</html>