<?
$sub_menu = "100300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

if (!$config[cf_email_use])
    alert("ȯ�漳������ \'���Ϲ߼� ���\'�� üũ�ϼž� ������ �߼��� �� �ֽ��ϴ�.");

include_once("$g4[path]/lib/mailer.lib.php");

$g4[title] = "���� �׽�Ʈ";
include_once("./admin.head.php");

if ($mail) {
    check_token();

    $from_name  = "$config[cf_title] - ���ϰ˻�";
    $from_email = "$config[cf_admin_email]";

    $email = explode(",", $mail);
    for ($i=0; $i<count($email); $i++)
        mailer($from_name, $from_email, trim($email[$i]), "[���ϰ˻�] ����", "<span style='font-size:9pt;'>[���ϰ˻�] ����<p>�� ������ ����� ���δٸ� ������ ���� �������� �̻��� ���°��Դϴ�.<p>".date("Y-m-d H:i:s")."<p>�� ���� �ּҷδ� ȸ�ŵ��� �ʽ��ϴ�.</span>", 1);

    echo <<<HEREDOC
    <script type="text/javascript">
        alert("{$mail} (��)�� ������ �߼� �Ͽ����ϴ�.\\n\\n�ش� �ּҷ� ������ �Դ��� Ȯ���Ͽ� �ֽʽÿ�.\\n\\n������ ���� �ʴ´ٸ� ���α׷��� ������ �ƴ� ���� ����(sendmail)�� ������ ���ɼ��� �ֽ��ϴ�.\\n\\n�̷� ��쿡�� �� ���������ڿ��� �����Ͽ� �ֽʽÿ�.");
    </script>
HEREDOC;
}

$token = get_token();
?>
<div class="panel panel-default">
<div class="panel-heading">
    <?=$g4[title]?>
</div>
<div class="panel-body">
    <form name=fsendmailtest method=post>
    <input type=hidden name=token value='<?=$token?>'>
    <p>���Ե鲲�� ������ ���� �ʴ´ٰ� �ϸ� ����ϴ� �޴��Դϴ�.
    <p>�Է��� �����ּҷ� �׽�Ʈ ������ �߼��մϴ�.
    <p>���� [���ϰ˻�] ��� �������� ������ �������� �ʴ´ٸ� ������ ���ϼ����� �޴� ���� ������ ������ �߻����� ���ɼ��� �ֽ��ϴ�.
    <p>������ ���´µ��� �������� �ʴ´ٸ� �ٸ� ���������ε� ������ �߼��Ͽ� �ֽʽÿ�.
    <p>���������� ������ �߼��Ͻ÷��� , �� ������ �����Ͻʽÿ�.
    <p>�޴� �����ּ� : <input type=text class="form-control" name=mail size=40 required itemname="E-mail" value="<?=$config[cf_admin_email]?>">
    <p>
    <input type=submit value="  ��  ��  " class="btn btn-default">
    </form>
</div>
</div>

<?
include_once("./admin.tail.php");
?>
