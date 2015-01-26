<?php

class TestType
{
    public $types = [
        1 => ['id' => 1, 'name' => 'hasText'],
        2 => ['id' => 2, 'name' => 'idHasText'],
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