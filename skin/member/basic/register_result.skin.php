<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<div class="jumbotron">
    <h3><strong>ȸ�������� �������� �����մϴ�.</strong></h3>
    <p>
    ȸ������ �н������ �ƹ��� �� �� ���� ��ȣȭ �ڵ�� ����ǹǷ� �Ƚ��ϼŵ� �����ϴ�.
    </p>
    <p>
    ���̵�, �н����� �нǽÿ��� ȸ�����Խ� �Է��Ͻ� �̸����� �̿��Ͽ� ã�� �� �ֽ��ϴ�.
    <? if ($config[cf_use_email_certify]) { ?>
    </p>
    <p>
    E-mail(<?=$mb[mb_email]?>)�� �߼۵� ������ Ȯ���� �� �����ϼž� ȸ�������� �Ϸ�˴ϴ�.
    <? } ?>
    </p>
  <p><a class="btn btn-primary btn-lg" role="button" href="<?=$g4[url]?>">Ȩ���� ����</a></p>
</div>