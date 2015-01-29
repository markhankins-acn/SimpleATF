<?php

namespace SimpleATF\Iterators;

use Exception;

class JsonIterator
{
    /**
     * Get the key from an array given a comma seperated string.
     * @param $data
     * @param $key
     *
     * @return mixed
     * @throws Exception
     */
    public function getKeyValue($data, $key)
    {
        try {
            $value = $this->findKey($data, $key);
            return $value;
        } catch (Exception $e) {
            return false;
        }
    }

    public function keyExists($data, $key)
    {
        try {
            $this->findKey($data, $key);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Finds a key and returns it's value, or raises an Exception
     *
     * @param $data
     * @param $key
     *
     * @return mixed
     * @throws Exception
     */
    private function findKey($data, $key)
    {
        $array = $this->checkData($data);
        $parsed = explode(',', $key);
        $check = $array;

        foreach ($parsed as $key) {
            if (isset($check->$key)) {
                $check = $check->$key;
            } elseif (array_key_exists($key, $check)) {
                $check = $check[$key];
            } else {
                throw new Exception('Key '.$key.' does not exist');
            }
        }
        return $check;
    }

    private function checkData($data)
    {
        if (is_array($data) || is_object($data)) {
            return $data;
        } else {
            return json_decode($data);
        }
    }
}