<? if ($is_member) { ?>

<a href="javascript:my_menu_add()" style="margin:0 10px 0 0;"><img src="<?=$board_skin_path?>/img/btn_my_menu.gif" align=absmiddle></a>

<script language=javascript>
function my_menu_add() { 
if (confirm("'<?=$board[bo_subject]?>' �Խ��� �ٷΰ��⸦ ����Ͻðڽ��ϱ�?")) { 
   hiddenframe.location.href = "../bbs/my_menu_add.php?bo_table=<?=$bo_table?>";
}}
</script>

<? } ?>
