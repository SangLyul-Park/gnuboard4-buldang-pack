<?php
// ---------------------------------------------------------------------------

# �̹����� ����� ���丮�� ��ü ��θ� �����մϴ�.
# ���� ������(/)�� ������ �ʽ��ϴ�.
# ����: �� ����� ���� ������ ����, �бⰡ �����ϵ��� ������ �ֽʽÿ�.

//define("SAVE_DIR", "/path/to/cheditor/attach");

# ������ ������ 'SAVE_DIR'�� URL�� �����մϴ�.
# ���� ������(/)�� ������ �ʽ��ϴ�.

//define("SAVE_URL", "http://udomain.com/cheditor/attach");

// ---------------------------------------------------------------------------

//define("SAVE_DIR", "/main/data/cheditor4/1006");
//define("SAVE_URL", "http://digitalmind.co.kr/main/data/cheditor4/1006");

include_once("./_common.php");

// ������ �������� ������, ���丮�� ��~ ������.
$ym = date("ym", $g4[server_time]);

// ������ ���丮�� �����Ѵ�
if ($g4[cheditor_save_dir] == "") {
    $g4[cheditor_save_dir] = dirname($g4[data_path] . "/nothing");
    $g4[cheditor_save_dir] = $g4[cheditor_save_dir] . "/" . $g4[cheditor4];
}

define("SAVE_DIR", "$g4[cheditor_save_dir]/$ym");
if (!file_exists("$g4[cheditor_save_dir]/$ym")) {
    @mkdir(SAVE_DIR, 0707);
    @chmod(SAVE_DIR, 0707);
}

// ���� URL�� �����Ѵ�
if ($g4['cheditor_image_url'] == "") {
    $image_url = dirname($_SERVER[REQUEST_URI]);
    $g4['cheditor_image_url'] = "http://{$_SERVER[HTTP_HOST]}{$image_url}/{$g4[data_path]}/$g4[cheditor4]";
}
define('SAVE_URL', "$g4[cheditor_image_url]/$ym");
?>