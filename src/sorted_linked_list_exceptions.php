<?php 

namespace SortedLinkedList;

use Exception;

class SortedLinkedListException extends Exception { }

class InvalidDataTypeException extends SortedLinkedListException { }

class ElementNotFoundException extends SortedLinkedListException { }

class OutOfRangeException extends SortedLinkedListException { }
