<?php
namespace EasySpl\Test;
use EasySpl\DataStructure\EasyDoublyLinkedList;
class main
{
    public function test()
    {
        $EasySdll = new EasyDoublyLinkedList();
        $EasySdll -> setIteratorMode ('FIFO_KEEP');
        $EasySdll->push([
            'A','B','C'
        ]);
        //$splDoubleLinkedList->pop();
        $res = $EasySdll->getValues();
        print_r($res);
        $res = $EasySdll->getIteratorMode();
        print_r($res);
    }
}
$main = new main();
$main->test();