<?
// ����
// 1. php.ini���� shell_exec(), exec() �Լ��� ����� �� �� �ְ� �����ؾ� �մϴ�.
// 2. g4_member ���̺�, mb_namecheck, mb_realcheck �ʵ带 datetime �������� �����մϴ�.
// 3. ����ȭ�� okname�� ������ �ϰ� okname ����� ��������� �߰�(r-x---r-x)�� �ּž� �մϴ�.
// 4. �α� ���丮(plugin/kcb/data)�� ������ rwx---rwx�� ��� �մϴ�.

// �׽�Ʈ���϶���. 1�� �����ϰ� ���Ŀ��� 0���� �ϸ� �˴ϴ�.
$kcb_test = 0;

// Live  ȸ�����ڵ�
$memid = "kcb���� �˷��ִ� ��...";

// KCB ���������� ��ġ
$kcbpath ="/home/opencode/public_html/plugin/kcb";

// KCB �α������� ��ġ
$kcblog = "/home/opencode/public_html/data/kcb";

// okname ����ȭ���� ������. 
$exe = "$kcbpath/okname";

// *** ȸ���� ������, $_SERVER["HTTP_HOST"] ��밡��.
$qryDomain = $_SERVER["HTTP_HOST"];

// ����Ȯ�� �α� ���丮 (�����η� �ݴϴ�)
$logPath = "$kcblog/real";	

// *** ȸ���� IP,   $_SERVER["SERVER_ADDR"] ��밡��.
$qryIP = "x";

// ����Ȯ�� ���� URL ����- �������� �Ϸ��� ���ϵ� URL (������ ���� full path)
$returnUrl = "http://$qryDomain/plugin/kcb/safe_hs_cert3.php";

// �������� ��뿩��, 1 : �������� ���
$okname_me = 1;

// KCB�� ���� URL.
if ($kcb_test) {
    $EndPointURL = "http://tsafe.ok-name.co.kr:29080/KcbWebService/OkNameService"; 
} else {
    $EndPointURL = "http://safe.ok-name.co.kr/KcbWebService/OkNameService"; 
}

/**************************************************************************
 * okname ���� Ȯ�μ��� �Ķ����
 **************************************************************************/
$inTpBit = "0";										// �Է±����ڵ�(������ '0' : KCB�˾����� �������� �Է�)
$name = "x";										  // ���� (������ 'x')
$birthday = "x";									// ������� (������ 'x')
$gender = "x";										// ���� (������ 'x')
$ntvFrnrTpCd="x";									// ���ܱ��α��� (������ 'x')
$mblTelCmmCd="x";									// �̵���Ż��ڵ� (������ 'x')
$mbphnNo="x";										  // �޴�����ȣ (������ 'x')
	
$svcTxSeqno = date("YmdHis");		  // �ŷ���ȣ. ���Ϲ��ڿ��� �ι� ����� �� ����. ( 20�ڸ��� ���ڿ�. 0-9,A-Z,a-z ���.)
	
$rsv1 = "0";										  // ���� �׸�
$rsv2 = "0";										  // ���� �׸�
$rsv3 = "0";										  // ���� �׸�
	
$hsCertMsrCd = "10";							// ���������ڵ� 2byte  (10:�ڵ���)
$returnMsg = "x";									// ���ϸ޽��� (������ 'x') 

$hsCertRqstCausCd = "02";					// ������û�����ڵ� 2byte  (00:ȸ������, 01:��������, 02:ȸ����������, 03:��й�ȣã��, 04:��ǰ����, 99:��Ÿ)
$option2 = "QL";                  // D: debug mode(Console���� ���ÿ�), L: log ���.
$option3 = "SL";                  // D: debug mode(Console���� ���ÿ�), L: log ���. safe_hd_cert3.php�� �ɼ��� S �Դϴ�.
?>
<script type="text/javascript">
function popup_real()
{
    window.open("<?=$g4[url]?>/plugin/kcb/safe_hs_cert2.php", "auth_popup", "width=432, height=560, scrollbars=0");
}
</script>