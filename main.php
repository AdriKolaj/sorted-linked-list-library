<?php

require_once 'src/sorted_linked_list.php';
require_once 'src/node.php';
require_once 'src/sorted_linked_list_exceptions.php';

use SortedLinkedList\SortedLinkedList;

$intList = new SortedLinkedList('int');

$intList->add(5);
$intList->add(2);
$intList->add(6);

$intList->remove(2);