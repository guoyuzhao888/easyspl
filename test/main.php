<?php
namespace EasySpl\Test;
use EasySpl\DataStructure\EasySplDoublyLinkedList;
class main
{
    public function test()
    {
        $splDoubleLinkedList = new EasySplDoublyLinkedList();
        $splDoubleLinkedList -> setIteratorMode ('FIFO_KEEP');
        $splDoubleLinkedList->push([
            'A','B','C'
        ]);
        //$splDoubleLinkedList->pop();
        $res = $splDoubleLinkedList->getValues();
        print_r($res);
        $res = $splDoubleLinkedList->getIteratorMode();
        print_r($res);
    }
}

$main = new main();
$main->test();