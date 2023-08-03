<?php

require_once 'src/sorted_linked_list.php';
require_once 'src/node.php';
require_once 'src/sorted_linked_list_exceptions.php';

use SortedLinkedList\SortedLinkedList;

try {
    $intList = new SortedLinkedList('int');

    $intList->add(5);
    $intList->add(2);
    $intList->add(6);

    echo "Integer List: " . $intList . "\n"; // Output: Integer List: 2, 5, 6

    echo "List Size: " . $intList->size() . "\n"; // Output: List Size: 3

    echo "Contains 5: " . ($intList->contains(5) ? "Yes" : "No") . "\n"; // Output: Contains 5: Yes

    echo "First Element: " . $intList->getFirst() . "\n"; // Output: First Element: 2

    echo "Element at Index 1: " . $intList->get(1) . "\n"; // Output: Element at Index 1: 5

    $intList->remove(5);
    echo "After removing 5: " . $intList . "\n"; // Output: After removing 5: 2, 6

    $intList->clear();
    echo "After clearing the list: " . $intList . "\n"; // Output: After clearing the list: (empty list)

    // Adding more elements
    $intList->add(10);
    $intList->add(1);
    $intList->add(8);
    echo "Updated Integer List: " . $intList . "\n"; // Output: Updated Integer List: 1, 2, 8, 10

    // Get element at an invalid index
    // echo $intList->get(10); // This will throw an OutOfRangeException

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}