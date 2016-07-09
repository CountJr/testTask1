<?php

namespace CountJr\testTask;

/**
 * @param array $data
 * @return array
 */
function flatArrayToNested($data)
{

    return array_reduce($data, function ($acc, $item) {

        return [$item => $acc];

    }, []);

}

/**
 * @param array $data
 * @return array
 */
function dottedArrayToNested($data)
{

    return array_reduce(array_keys($data), function ($acc, $item) use ($data) {

        $tempVar = array_reverse(explode('.', $item));
        $lastKey = array_shift($tempVar);
        
        $subTree = array_reduce($tempVar, function ($acc, $key) {
            
            return [$key => $acc];
            
        }, [$lastKey => $data[$item]]);
        
        return array_merge_recursive($acc, $subTree);

    }, []);

}

/**
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
