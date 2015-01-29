<?php

class TestType
{
    public $types = [
        1 => ['id' => 1, 'name' => 'hasText'],
        2 => ['id' => 2, 'name' => 'idHasText'],
        3 => ['id' => 3, 'name' => 'hasStatusCode'],
        4 => ['id' => 4, 'name' => 'hasJsonKey'],
        5 => ['id' => 5, 'name' => 'hasJson'],
    ];

    public function getTestTypes()
    {
        return $this->types;
    }

    public function idToName($id)
    {
        return $this->types[$id]['name'];
    }
}