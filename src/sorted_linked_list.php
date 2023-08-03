<?php

namespace SortedLinkedList;

use SortedLinkedList\Node;
use SortedLinkedList\InvalidDataTypeException;
use SortedLinkedList\ElementNotFoundException;
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
        if (!is_int($data) && !is_string($data)) {
            throw new InvalidDataTypeException("Invalid data type. Supported data types: 'string' or 'int'");
        }
    
        if ($this->dataType === 'string' && !is_string($data)) {
            throw new InvalidDataTypeException("Data type mismatch. This SortedLinkedList can only hold 'string' values.");
        }
    
        if ($this->dataType === 'int' && !is_int($data)) {
            throw new InvalidDataTypeException("Data type mismatch. This SortedLinkedList can only hold 'int' values.");
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

    public function remove($data): bool
    {
        if ($this->isEmpty()) {
            return false;
        }

        if (!is_int($data) && !is_string($data)) {
            throw new InvalidDataTypeException("Invalid data type. Supported data types: 'string' or 'int'");
        }
    
        if ($this->dataType === 'string' && !is_string($data)) {
            throw new InvalidDataTypeException("Data type mismatch. This SortedLinkedList can only hold 'string' values.");
        }
    
        if ($this->dataType === 'int' && !is_int($data)) {
            throw new InvalidDataTypeException("Data type mismatch. This SortedLinkedList can only hold 'int' values.");
        }

        $current = $this->head;
        $prev = null;
        while ($current !== null && $data !== $current->data) {
            $prev = $current;
            $current = $current->next;
        }

        if ($current !== null) {
            if ($prev === null) {
                $this->head = $current->next;
            } else {
                $prev->next = $current->next;
            }
            $this->size--;
            return true;
        }

        throw new ElementNotFoundException("Data not found in the SortedLinkedList.");
    }

    public function size(): int
    {
        return $this->size;
    }

    public function contains($data): bool
    {
        if (!is_int($data) && !is_string($data)) {
            throw new InvalidDataTypeException("Invalid data type. Supported data types: 'string' or 'int'");
        }
    
        $current = $this->head;
        while ($current !== null) {
            if ($data === $current->data) {
                return true;
            }
            $current = $current->next;
        }
        return false;
    }
}