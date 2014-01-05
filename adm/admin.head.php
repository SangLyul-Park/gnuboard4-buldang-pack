<?
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

include_once("$g4[path]/head.sub.php");
?>
<body>
<a name='gnuboard4_admin_head'></a>

<header class="header-wrapper"><!-- ��� header ���� -->
<div class="container">

<div class="navbar navbar-default" role="navigation">
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-sm-2">
        <button type="button" class="btn btn-default navbar-toggle" data-toggle="collapse" data-target=".navbar-top-menu-collapse">
            <i class="glyphicon glyphicon-list"></i>
        </button>
        <a class="navbar-brand hidden-xs" href="<?=$g4['admin_path']?>/">
        <img src="<?=$g4[path]?>/images/logo_opencode.gif" align=absmiddle alt="brand logo">
        </a>
        <a class="navbar-brand navbar-toggle pull-left" href="<?=$g4['path']?>/" style="border:0;margin-bottom:0;">
        <img src="<?=$g4[path]?>/images/logo_opencode.gif" alt="brand logo" style="width:120px;">
        </a>
    </div>
    <div class="pull-right">
        <div class="btn-toolbar">
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-warning">5</span>
                </a>
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-comments"></i>
                  <span class="label label-danger">4</span>
                </a>
            </div>
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Document" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-file"></i>
                </a>
                <a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                  <i class="fa fa-question"></i>
                </a>
              </div>
              <div class="btn-group">
                <a href="<?=$g4[bbs_path]?>/logout.php" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-default btn-sm">
                  <i class="fa fa-power-off"></i>
                </a>
              </div>
            </div>
          </div><!-- /.topnav -->
          
    <div class="collapse navbar-collapse navbar-top-menu-collapse col-sm-7">
    <ul class="nav navbar-nav">
        <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=qna">�����Խ���</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">��ũ <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=notice">����</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=g4_100">�״�����100�Ͽϼ�</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=g4_books">�״���������</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=sitetips">����Ʈ���߿</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=biz">����Ͻ������ڷ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/good_list.php">����Ʈ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/new.php">�ֱٰԽñ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=test">�׽�Ʈ</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=test2">�׽�Ʈ2</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">������ <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=linux_tips">Linux</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=virtual">����ȭ</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=apache_tips">Apache</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=mysql_tips">MySQL</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=mariadb_tips">Maria DB</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=nosql">NoSQL</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=css">CSS/��Ʈ��Ʈ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=php_tips">PHP</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=jquery_tips">jQuery</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=javascript_tips">Java Script</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=ajax">AJAX</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=html_tips">HTML</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=html5_tips">HTML5</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=other_tips">��Ÿ ����</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=cheditor">cheditor(���)</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">�״�4 <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_turning">�״�����4 Ʃ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_turning2">�״�����4 Ʃ��(�����)</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=memo4">����5</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=thumb">�Ҵ��/Resize</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=layout">�Ҵ����(100%��������)</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=g4_recycle">������/Recycle</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_unicro">����ũ������/�Խ���</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_skin">�״����彺Ų</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_tips">�״�������</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_qna">�״����� ���� ���ϱ�</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">App <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=and_talk">�ȵ���̵� �Խ���</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=and_tip">�ȵ���̵� ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=and_pds">�ȵ���̵� �ڷ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=webapp">����</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">�Ҵ��� <b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack">�Ҵ��Ѵٿ�ε�</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_book">�Ҵ��� �Ŵ���</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_skin">�Ҵ��� ��Ų</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_req">�Ҵ��� ���� �� ����</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_qna">�Ҵ��� ������ϱ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=yc4_pack_download">��īƮ4s �Ҵ���</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=yc4_tips">��īƮ4s ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=yc4_pack_qna">��īƮ4s ������ϱ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gblog">gblog �Ҵ����</a></li>
                <li><a href="<?=$g4[path]?>/blog/" target=new>gblog �׽�Ʈ</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=club2">Ŭ��2</a></li>
                <li><a href="$g4[path]?>/club/">Ŭ��2 �׽�Ʈ</a></li>
            </ul>
        </li>
        <li><a href="<?=$g4[plugin_path]?>/attendance/attendance.php">�⼮</a></li>
    </ul>
    </div>
</div>








</div>
</header>

<!-- �߰��� ���κ� ���� -->
<div role="main" class="container">
<div class="row">

<!-- ���� side ���� -->
<div class="col-sm-2 visible-sm visible-md visible-lg">
<?
// �ƿ��α���
include_once("$g4[path]/lib/outlogin.lib.php");
echo outlogin("basic");
?>