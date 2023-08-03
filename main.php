<?php
require_once 'src/sortedLinkedList.php';

use SortedLinkedList\SortedLinkedList;

$intList = new SortedLinkedList('int');
$intList->add(5);
$intList->add(3);
$intList->add(2);