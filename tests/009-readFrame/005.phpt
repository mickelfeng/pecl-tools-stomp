--TEST--
Test stomp_read_frame() - Test the body binary safety
--SKIPIF--
<?php
    if (!extension_loaded("stomp")) print "skip";
    if (!stomp_connect()) print "skip";
?>
--FILE--
<?php
$link = stomp_connect();
stomp_send($link, '/queue/test-09', "A test Message\0Foo");
stomp_subscribe($link, '/queue/test-09', array('ack' => 'auto'));
$result = stomp_read_frame($link);
var_dump($result['body']);

?>
--EXPECTF--
string(18) "A test Message Foo"
