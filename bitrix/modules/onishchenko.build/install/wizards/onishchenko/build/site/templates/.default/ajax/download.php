<?
header("HTTP/1.1 200 OK");
header("Accept-Ranges: bytes");
header("Content-Type:".$_GET['type']);
header("Content-Disposition: attachment; filename=".$_GET['name']);
readfile($_SERVER['DOCUMENT_ROOT'].$_GET['src']);
exit;
?>