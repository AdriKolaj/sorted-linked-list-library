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

    private function validateDataType($data): void
    {
        $dataType = $this->dataType === 'string' ? 'string' : 'integer';

        if (!is_string($data) && !is_int($data)) {
            throw new InvalidDataTypeException("Invalid data type. Supported data types: 'string' or 'int'");
        }

        if (gettype($data) !== $dataType) {
            throw new InvalidDataTypeException("Data type mismatch. This SortedLinkedList can only hold '{$this->dataType}' values.");
        }
    }

    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    public function add($data): void
    {
        $this->validateDataType($data);

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
        $this->validateDataType($data);
    
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
        $this->validateDataType($data);
    
        $current = $this->head;
        while ($current !== null) {
            if ($data === $current->data) {
                return true;
            }
            $current = $current->next;
        }
        return false;
    }

    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->size) {
            throw new ElementNotFoundException("Element not found.");
        }
    
        $current = $this->head;
        for ($i = 0; $i < $index; $i++) {
            $current = $current->next;
        }
    
        $this->validateDataType($current->data);
    
        return $current->data;
    }

    public function removeByIndex(int $index): bool
    {
        if ($index < 0 || $index >= $this->size) {
            throw new ElementNotFoundException("Element not found.");
        }

        if ($index === 0) {
            $this->head = $this->head->next;
        } else {
            $current = $this->head;
            $prev = null;
            for ($i = 0; $i < $index; $i++) {
                $prev = $current;
                $current = $current->next;
            }
            $prev->next = $current->next;
        }

        $this->size--;
        return true;
    }

    public function show(): string
    {
        $result = [];
        $current = $this->head;
        while ($current !== null) {
            $result[] = $current->data;
            $current = $current->next;
        }
        return implode(', ', $result);
    }

    public function getFirst()
    {
        if ($this->isEmpty()) {
            throw new ElementNotFoundException("List is empty.");
        }

        return $this->head->data;
    }

    public function getLast()
    {
        if ($this->isEmpty()) {
            throw new ElementNotFoundException("List is empty.");
        }

        $current = $this->head;
        while ($current->next !== null) {
            $current = $current->next;
        }

        return $current->data;
    }

    public function clear(): void
    {
        $this->head = null;
        $this->size = 0;
    }

    public function toArray(): array
    {
        $result = [];
        $current = $this->head;
        while ($current !== null) {
            $result[] = $current->data;
            $current = $current->next;
        }
        return $result;
    }

    public function __toString()
    {
        $result = [];
        $current = $this->head;
        while ($current !== null) {
            $result[] = $current->data;
            $current = $current->next;
        }
        return implode(', ', $result);
    }
}