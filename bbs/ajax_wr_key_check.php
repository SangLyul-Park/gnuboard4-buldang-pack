<?
include_once("_common.php");

include_once $g4['path'].'/bbs/securimage.php';

// echo "�ѱ�"�� ������� �ʴ� ������ Ajax �� euc_kr ���� �ѱ��� ����� �ν����� ���ϱ� ����
// ���⿡�� �������� echo �Ͽ� Request �� ���� Javascript ���� �ѱ۷� �޼����� �����

if (preg_match("/[^0-9]+/i", $reg_wr_key)) {
    echo "110"; // ��ȿ���� ���� ����
} else if (strlen($reg_wr_key) < 5) {
    echo "120"; // 4���� ���� ����
} else {

  $img = new Securimage;
  if ($img->check($reg_wr_key) == false) {

        echo "130"; // Ʋ�� �ڵ�

    } else {

            echo "000"; // ����
            set_session('scaptcha_code', md5($reg_wr_key.$_SESSION["ss_token"]));
    }
}
?>
