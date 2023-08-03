<?php
namespace SortedLinkedList;

require_once 'Node.php';

use \InvalidArgumentException;

class SortedLinkedList
{
  private $head;
  private $dataType;
  private $size;

  public function __construct(string $dataType)
  {
    if ($dataType !== 'string' && $dataType !== 'int') {
      throw new InvalidArgumentException("Invalid data type. Supported data types: 'string' or 'int'");
    }

    $this->head = null;
    $this->dataType = $dataType;
    $this->size = 0;
  }

  public function isEmpty(): bool
  {
    return $this->head === null;
  }

  public function add($data): void
  {
    if (func_num_args() !== 1) {
      throw new InvalidArgumentException("Invalid number of arguments. The add method accepts only one value at a time.");
    }

    if ($this->dataType === 'string' && !is_string($data)) {
      throw new InvalidArgumentException("Data type mismatch. This SortedLinkedList can only hold 'string' values.");
    }

    if ($this->dataType === 'int' && !is_int($data)) {
      throw new InvalidArgumentException("Data type mismatch. This SortedLinkedList can only hold 'int' values.");
    }

    $newNode = new Node($data);

    if ($this->isEmpty() || $data <= $this->head->data) {
      $newNode->next = $this->head;
      $this->head = $newNode;
    } else {
      $current = $this->head;
      while ($current->next !== null && $data > $current->next->data) {
        $current = $current->next;
      }
      $newNode->next = $current->next;
      $current->next = $newNode;
    }

    $this->size++;
  }
}