<?php

namespace SimpleATF\Tests\Iterators;

use SimpleATF\Tests\TestCase;
use SimpleATF\Iterators\JsonIterator;

class JsonIteratorTest extends TestCase
{
    public function testItFindsKey()
    {
        $object = new \stdClass();
        $object->metadata = (object)['author' => 'PrivateSniper'];

        $iterator = new JsonIterator();
        $value = $iterator->getKeyValue($object, 'metadata,author');
        assert($value === "PrivateSniper");
    }

    public function testKeyExistsReturnsTrueForValidKey()
    {
        $object = new \stdClass();
        $object->metadata = (object)['author' => 'PrivateSniper'];

        $iterator = new JsonIterator();
        $value = $iterator->keyExists($object, 'metadata,author');
        assert($value === true);
    }

    public function testItFindsKeyInArray()
    {
        $object = new \stdClass();
        $object->metadata = ['author' => 'PrivateSniper'];

        $iterator = new JsonIterator();
        $value = $iterator->getKeyValue($object, 'metadata,author');
        assert($value === true);
    }

    public function testKeyExistsIsTrueForKeyInArray()
    {
        $object = new \stdClass();
        $object->metadata = ['author' => 'PrivateSniper'];

        $iterator = new JsonIterator();
        $value = $iterator->keyExists($object, 'metadata,author');
        assert($value === true);
    }

    public function testKeyExistsReturnsFalseForInvalidKey()
    {
        $object = new \stdClass();
        $object->metadata = (object)['author' => 'PrivateSniper'];

        $iterator = new JsonIterator();
        $value = $iterator->keyExists($object, 'metadata,description');
        assert($value === false);
    }
}