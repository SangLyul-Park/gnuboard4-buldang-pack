<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ����� ȭ�� ������ �ϴ��� ����ϴ� �������Դϴ�.
// ����, �ϴ� ȭ���� �ٹ̷��� �� ������ �����մϴ�.
?>

</div><!-- ���� content �� -->

</section><!-- �߰��� ���κ� �� -->

<!-- ������ �ϴܺ� footer -->
<footer class="footer-wrapper col-sm-offset-2 visible-sm visible-md visible-lg" role="contentinfo">
<div class="container">
    <div>
        <ul class="list-inline">
        <li><a href="<?=$g4[path]?>/">Ȩ����</a></li>
        <li><a href="<?=$g4[path]?>/company/company.php?id=privacy"><strong>����������޹�ħ</strong></a></li>
        <li><a href="<?=$g4[path]?>/company/company.php?id=service">�̿���</a></li>
        <li><a href="<?=$g4[path]?>/company/company.php?id=disclaimer">å���Ѱ�͹�������</a></li>
        <li><a href="<?=$g4[path]?>/company/company.php?id=rejection">�̸����ּҹ��ܼ����ź�</a></li>
        </ul>
    <p>����ڵ�Ϲ�ȣ :000-00-00000 <span>����Ǹž��Ű��ȣ</span> :��2009-���Ｍ��-0000ȣ<br>
       ��ǥ�̻� :�ƺ��Ҵ� �ּ� :����� ���ʱ� ���ʵ� �ջ� ��ȭ</span> :00-000-0000</p>
    <p><?=$config[cf_title]?>�� �����߰��ڷμ� ������ �ֹ�, ��� �� ȯ���� �ǹ��� å���� �� ȸ���� �ֽ��ϴ�.<br>
    <?=$config[cf_title]?>�� ���� ���� ���� ���� <?=$config[cf_title]?>�� ��ü�� ����, ������ �� UI���� ����� �������� ����, ����, ��ũ���� �� ���� ����� �� �����ϴ�.<br>
    Copyright &copy; <a href="http://opencode.co.kr" target="_blank">Opencode.co.kr</a>. All rights reserved.</p>
    </div>
</div>
</footer>

<?
include_once("$g4[path]/tail.sub.php");
?>