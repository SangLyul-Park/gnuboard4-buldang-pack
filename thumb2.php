<?
include_once("./lib/thumb.lib.php");

// $file_name   : ���ϸ�
// $width       : ������� ��
// $height      : ������� ���� (�������� ������ ������� ���̸� ���)
//                * $width, $height�� ��� ���� ������, �̹��� ������ �״�� thumb�� ����
// $is_create   : ������� �̹� ���� ��, ���� �������� ���θ� ����
// $is_crop     : ���� ���̰� $height�� ���� �� crop �� �������� ����
//                0 : crop ���� �ʽ��ϴ�
//                1 : �⺻ crop
//                2 : �߰��� �������� crop
// $quality     : ������� quality (jpeg, png���� �ش��ϸ�, gif���� �ش� ����)
// $small_thumb : 1 (true)�̸�, �̹����� ������� ��/���̺��� ���� ������ ���� ����
//                2�̸�, �̹����� ������� ��/���̺��� ���� �� Ȯ��� ���� ����
// $watermark   : ���͸�ũ ��¿� ���� ���� 
//                $watermark[][filename] - ���͸�ũ ���ϸ�
//                $watermark[location] - center, top, top_left, top_right, bottom, bottom_left, bottom_right
//                $watermark[x],$watermark[y] - location������ offset
// $filter      : php imagefilter, http://kr.php.net/imagefilter
//                $filter[type], [arg1] ... [arg4]
// $noimg       : $noimg(�̹�������)
?>

<img src="<?=thumbnail('./data/file/btn_go.gif', 200,200,0,0,70,2)?>" >
<BR>20*20�� 200*200���� �����ѽ���� ����� (Ȯ��)<BR>

<img src="<?=thumbnail('./data/file/btn_go.gif', 200,0,1,0,69,2)?>" >
<BR>20*20�� 200*0���� �����ѽ���� ����� (Ȯ��)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 0,100, 0, 0, 56)?>" >
<BR>���̸� 100���� �����ѽ���� ����� (crop ���� ������ ���� �������� ����� ����)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 1000, 0, 0, 0, 55)?>" >
<BR>���� 1000���� �����ѽ���� ����� (���� 800*600)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 1001, 0, 0, 0, 54)?>" >
<BR>���� 1000���� �����ѽ���� ����� (���� 800*600)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 400, 1000, 0, 0, 54, "", "", "", "", "jpg")?>" >
<BR>���� 400���� �����ѽ���� ���� jpg�� �����ϱ� (���� 800*600)<BR>
