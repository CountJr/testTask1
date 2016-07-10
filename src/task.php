<?php

namespace CountJr\testTask;

/**
 * Task No1. Make nested array from flat one.
 *
 * @param array $data
 * @param array $initValue
 * @return array
 */
function flatArrayToNested($data, $initValue = [])
{

    return array_reduce($data, function ($acc, $item) {

        return [$item => $acc];

    }, $initValue);

}

/**
 * Task No2. Make nested array from flat with dotted keys.
 *
 * @param array $data
 * @return array
 */
function dottedArrayToNested($data)
{

    return array_reduce(array_keys($data), function ($acc, $item) use ($data) {

        $tempVar = array_reverse(explode('.', $item));
        $lastKey = array_shift($tempVar);
        
        $subTree = flatArrayToNested($tempVar, [$lastKey => $data[$item]]);
        
        return array_merge_recursive($acc, $subTree);

    }, []);

}

/**
 * Task No2 vice versa. Make flat array with dotted keys from nested one.
 *
 * @param array $data
 * @return array
 */
function nestedArrayToDotted($data)
{

    return array_reduce(array_keys($data), function ($acc, $key) use ($data) {

        if (is_array($data[$key])) {
            $temp = nestedArrayToDotted($data[$key]);
            
            $temp2 = array_reduce(array_keys($temp), function ($acc, $key2) use ($key, $temp) {

                $newKey = "{$key}.{$key2}";
                $acc[$newKey] = $temp[$key2];
                return $acc;

            }, []);
            
            return array_merge($acc, $temp2);
        }
        
        $acc[$key] = $data[$key];
        return $acc;

    }, []);

}
