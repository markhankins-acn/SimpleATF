<?php

namespace SimpleATF\Iterators;

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
        $object = is_object($data) ? $data : json_decode($data);
        $parsed = explode(',', $key);

        $check = $object;
        foreach ($parsed as $key) {
            if (isset($check->$key)) {
                $check = $check->$key;
            } else if (isset($check['key'])) {
                $check = $check['key'];
            } else {
                throw new \Exception('Key '.$key.' does not exist');
            }
        }
        return $check;
    }

    public function keyExists($data, $key)
    {
        $object = is_object($data) ? $data : json_decode($data);
        $parsed = explode(',', $key);

        $check = $object;
        foreach ($parsed as $key) {
            if (isset($check->$key)) {
                $check = $check->$key;
            } else if (array_key_exists($key, $check)) {
                $check = $check['key'];
            } else {
                return false;
            }
        }
        return true;
    }
}