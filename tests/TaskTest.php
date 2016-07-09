<?php

namespace CountJr\tests;

use function CountJr\testTask\flatArrayToNested;
use function CountJr\testTask\nestedArrayToDotted;
use function CountJr\testTask\dottedArrayToNested;

class TaskTest extends \PHPUnit_Framework_TestCase
{

    protected $x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
    protected $x2 = [
        'h' => [
            'g' => [
                'f' => [
                    'e' => [
                        'd' => [
                            'c' => [
                                'b' => [
                                    'a' =>[]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];
    protected $data = [
        'parent.child.field' => 1,
        'parent.child.field2' => 2,
        'parent2.child.name' => 'test',
        'parent2.child2.name' => 'test',
        'parent2.child2.position' => 10,
        'parent3.child3.position' => 10,
    ];
    protected $data2 = [
        'parent' => [
            'child' => [
                'field' => 1,
                'field2' => 2,
            ]
        ],
        'parent2' => [
            'child' => [
                'name' => 'test'
            ],
            'child2' => [
                'name' => 'test',
                'position' => 10
            ]
        ],
        'parent3' => [
            'child3' => [
                'position' => 10
            ]
        ],
    ];

    public function testFlatArrayToNested()
    {
        
        $this->assertEquals($this->x2, flatArrayToNested($this->x));

    }
    
    public function testDottedArrayToNested()
    {
        
        $this->assertEquals($this->data2, dottedArrayToNested($this->data));
    }
    
    public function testNestedArrayToDotted()
    {
        
        $this->assertEquals($this->data, nestedArrayToDotted($this->data2));
        
    }
}
