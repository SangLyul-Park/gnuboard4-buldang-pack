<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>
<header class="header-wrapper"><!-- ��� header ���� -->
<div class="container" style="margin-bottom:5px;">
<div class="btn-group">
  <a href="<?=$g4[memo_url]?>?kind=recv" class="btn btn-default btn-sm" id="recv"><strong>����</strong></a>
  <a href="<?=$g4[memo_url]?>?kind=send" class="btn btn-default btn-sm" id="send"><strong>�߽�</strong></a>
</div>
<div class="btn-group">
  <a href="<?=$g4[memo_url]?>?kind=write" class="btn btn-default btn-sm" id="write"><strong>������</strong></a>
</div>
<div class="btn-group">
  <a href="<?=$g4[memo_url]?>?kind=save" class="btn btn-default btn-sm" id="save">����</a>
  <a href="<?=$g4[memo_url]?>?kind=notice" class="btn btn-default btn-sm" id="notice">����</a>
  <a href="<?=$g4[memo_url]?>?kind=trash" class="btn btn-default btn-sm" id="trash">����</a>
  <a href="<?=$g4[memo_url]?>?kind=spam" class="btn btn-default btn-sm" id="spam">����</a>
</div>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default btn-sm">ģ��</button>
  <button type="button" class="btn btn-default btn-sm">�׷�</button>
  <button type="button" class="btn btn-default btn-sm">�ּҷ�</button>
  <a href="<?=$g4[memo_url]?>?kind=memo_config" class="btn btn-default btn-sm">����</a>
</div>
</div>
</header><!-- ��� header �� -->

<script type='text/javascript'>
// ���� Ŭ���� ��ư�� active��
$('.btn-group a#<?=$kind?>').addClass('active');
</script>

<!-- �߰��� ���κ� ���� -->
<div role="main">