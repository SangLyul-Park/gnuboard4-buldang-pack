<?
$g4['path'] = "..";
include_once ("../config.php");

// ������ �����Ѵٸ� ��ġ�� �� ����.
if (file_exists("../dbconfig.php")) {
    echo "<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'>";
    echo <<<HEREDOC
    <script language="JavaScript">
    alert("��ġ�Ͻ� �� �����ϴ�.");
    location.href="../";
    </script>
HEREDOC;
    exit;
}

$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

if ($_POST["agree"] != "������") {
    echo "<meta http-equiv='content-type' content='text/html; charset=$g4[charset]'>";
    echo <<<HEREDOC
    <script language="JavaScript">
    alert("���̼���(License) ���뿡 �����ϼž� ��ġ�� ����Ͻ� �� �ֽ��ϴ�.");
    history.back();
    </script>
HEREDOC;
    exit;
}
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<title>�״�����4 ��ġ (2/3) - ���̼���(License)</title>

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

<form name=frm method=post action="javascript:frm_submit(document.frm)" autocomplete="off">

<div class="container" style="width:621px;margin-top:100px;">

<div class="panel panel-primary">
<div class="panel-heading">
    <strong>�״�����4 ��ġ (2/3)</strong>
</div>
<div class="panel-body">

    <table width=100% class="table table-condensed table-hover table-borderless" style="word-wrap:break-word;">
    <tr>
        <td width=45%>
            <!-- TAB ���� ������ ���̺��� 2���� -->
            <table width=100% class="table table-condensed table-hover table-borderless" style="word-wrap:break-word;">
            <tr>
                <td colspan=2><strong>MySQL �����Է�</strong></td>
            </tr>
            <tr>
                <td width=80>Host :</td>
                <td>
                    <input name="mysql_host" type="text" class="form-control" value="localhost">
                </td>
            </tr>
            <tr>
                <td>User :</td>
                <td>
                    <input name="mysql_user" type="text" class="form-control" placeholder="MySQL ����ڸ�">
                </td>
            </tr>
            <tr>
                <td>Password :</td>
                <td>
                    <input name="mysql_pass" type="text" class="form-control" placeholder="MySQL ���� �н�����">
                </td>
            </tr>
            <tr>
                <td>DB :</td>
                <td>
                    <input name="mysql_db" type="text" class="form-control" placeholder="MySQL DB �̸�">
                </td>
            </tr>
            </table>

        </td>
        <td width=5%></td>
        <td width=45%>

            <table width=100% class="table table-condensed table-hover table-borderless" style="word-wrap:break-word;">
            <tr>
                <td colspan=2><strong>�ְ������ �����Է�</strong></td>
            </tr>
            <tr>
                <td width=80>ID :</td>
                <td>
                    <input name="admin_id" type="text" class="form-control" value="admin" onkeypress="only_alpha_numeric();">
                </td>
            </tr>
            <tr>
                <td>Password :</td>
                <td>
                    <input name="admin_pass" type="text" class="form-control" placeholder="������ �н�����">
                </td>
            </tr>
            <tr>
                <td>Name :</td>
                <td>
                    <input name="admin_name" type="text" class="form-control" value="�ְ������" placeholder="�ְ������ �̸�">
                </td>
            </tr>
            <tr>
                <td>E-mail :</td>
                <td>
                    <input name="admin_email" type="text" class="form-control" value="admin@domain.domain">
                </td>
            </tr>
            </table>

        </td>
        <td width=5%></td>
    </tr>
    </table>

    <p class="text-danger">
    �̹� �״�����4�� �����Ѵٸ� DB �ڷᰡ ���ǵǹǷ� �����Ͻʽÿ�.
    </p>

    <div class="pull-right" style="margin-bottom:10px;">
        <input type="submit" name="submit2" class="btn btn-default" value=" ��   �� ">
    </div>
</div>
<div class="panel-footer">
</div>
</div>
</form>

</div><!-- end of container -->

<script type="text/javascript">
<!--
function frm_submit(f)
{
    if (f.mysql_host.value == "")
    {   
        alert("MySQL Host �� �Է��Ͻʽÿ�."); f.mysql_host.focus(); return; 
    }
    else if (f.mysql_user.value == "")
    {
        alert("MySQL User �� �Է��Ͻʽÿ�."); f.mysql_user.focus(); return; 
    }
    else if (f.mysql_db.value == "")
    {
        alert("MySQL DB �� �Է��Ͻʽÿ�."); f.mysql_db.focus(); return; 
    }
    else if (f.admin_id.value == "")
    {
        alert("�ְ������ ID �� �Է��Ͻʽÿ�."); f.admin_id.focus(); return; 
    }
    else if (f.admin_pass.value == "")
    {
        alert("�ְ������ �н����带 �Է��Ͻʽÿ�."); f.admin_pass.focus(); return; 
    }
    else if (f.admin_name.value == "")
    {
        alert("�ְ������ �̸��� �Է��Ͻʽÿ�."); f.admin_name.focus(); return; 
    }
    else if (f.admin_email.value == "")
    {
        alert("�ְ������ E-mail �� �Է��Ͻʽÿ�."); f.admin_email.focus(); return; 
    }

    if(/[^a-zA-Z0-9]/g.test(f.admin_id.value)) {
        alert("�ְ������ ID �� ������ �� ���ڰ� �ƴմϴ�.");
        f.admin_id.focus();
    }

    f.action = "./install_db.php";
    f.submit();

    return true;
}

// �����ڸ� �Է� ����   
function only_alpha() 
{
    var c = event.keyCode;
    if (!(c >= 65 && c <= 90 || c >= 97 && c <= 122)) {
        event.returnValue = false;
    }
}

// �����ڿ� ���ڸ� �Է� ����   
function only_alpha_numeric() 
{
    var c = event.keyCode;
    if (!(c >= 65 && c <= 90 || c >= 97 && c <= 122 || c >= 48 && c <= 57)) {
        event.returnValue = false;
    }
}

document.frm.mysql_user.focus();
//-->
</script>

</body>
</html>
