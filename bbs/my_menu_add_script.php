<? if ($is_member) { ?>

<a class="btn btn-default" href="javascript:my_menu_add()" style="margin:0 10px 0 0;"><i class="fa fa-thumb-tack"></i></a>

<script language=javascript>
function my_menu_add() { 
if (confirm("'<?=$board[bo_subject]?>' �Խ��� �ٷΰ��⸦ ����Ͻðڽ��ϱ�?")) { 
   hiddenframe.location.href = "../bbs/my_menu_add.php?bo_table=<?=$bo_table?>";
}}
</script>

<? } ?>
