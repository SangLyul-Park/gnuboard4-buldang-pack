<?
if (!defined("_GNUBOARD_")) exit;
?>

</div><!-- ���� content �� -->

</div>
</div><!-- �߰��� ���κ� �� -->

<footer class="footer-wrapper" role="contentinfo" style="margin-top:20px;">
<div class="container well">
    <p>����ð� : <?=get_microtime() - $begin_time;?>
</div>
</footer>

<a href="#" class="btn btn-default back-to-top"><span class="glyphicon glyphicon-chevron-up"></span></a>
<style>
.back-to-top {
    position: fixed;
    bottom: 2em;
    right: 10px;
    padding: 1em;
    display: none;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    var offset = 350;   // �������� ������� �������� ��ư�� ���ñ�?
    var duration = 0;   // top���� �̵��Ҷ������� animate �ð� (�и�������, default�� 400. ������ �⺻�� 500)
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });
    
    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>

<script type="text/javascript" src="<?=$g4[admin_path]?>/admin.js"></script>

<? 
include_once("$g4[path]/tail.sub.php");
?>
