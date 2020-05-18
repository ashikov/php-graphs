<?php

namespace PhpGraphs\Tests;

use PHPUnit\Framework\TestCase;

use function PhpGraphs\Graphs\makeJoints;
use function PhpGraphs\Graphs\buildTreeFromLeaf;
use function PhpGraphs\Graphs\sortJoints;
use function PhpGraphs\Graphs\map;
use function PhpGraphs\Graphs\sortTree;

class GraphsTest extends TestCase
{
    public function testMakeJoints()
    {
        $tree = ['A', [
            ['C', [
                ['F', [
                    ['J', [
                        ['O'],
                        ['N'],
                    ]],
                    ['I', [
                        ['M'],
                    ]],
                ]],
                ['G', [
                    ['K'],
                    ['L'],
                ]],
            ]],
            ['B', [
                ['E'],
                ['D', [
                    ['H'],
                ]],
            ]],
        ]];

        $expected = [
          'A' => ['C', 'B', null],
          'C' => ['F', 'G', 'A'],
          'F' => ['J', 'I', 'C'],
          'J' => ['O', 'N', 'F'],
          'O' => ['J'],
          'N' => ['J'],
          'I' => ['M', 'F'],
          'M' => ['I'],
          'G' => ['K', 'L', 'C'],
          'K' => ['G'],
          'L' => ['G'],
          'B' => ['E', 'D', 'A'],
          'E' => ['B'],
          'D' => ['H', 'B'],
          'H' => ['D']
        ];
        

        $actual = makeJoints($tree);
        $this->assertEquals($expected, $actual);
    }

    public function testBuildTreeFromLeaf()
    {
        $joints = [
            'B' => ['D', 'A'],
            'D' => ['B'],
            'A' => ['C', 'B'],
            'C' => ['F', 'E', 'A'],
            'F' => ['C'],
            'E' => ['C'],
        ];

        $expected = ['C', [
            ['F'],
            ['E'],
            ['A', [
                ['B', [
                    ['D']
                ]],
            ]],
        ]];


        $actual = buildTreeFromLeaf($joints, 'C');
        $this->assertEquals($expected, $actual);
    }

    public function testSortJoints()
    {
        $joints = [
            'B' => ['D', 'A'],
            'D' => ['B'],
            'A' => ['C', 'B'],
            'C' => ['F', 'E', 'A'],
            'F' => ['C'],
            'E' => ['C'],
        ];

        $expected = [
            'B' => ['A', 'D'],
            'D' => ['B'],
            'A' => ['B', 'C'],
            'C' => ['A', 'E', 'F'],
            'F' => ['C'],
            'E' => ['C'],
        ];

        $actual = sortJoints($joints);

        $this->assertEquals($expected, $actual);
    }

    public function testMap()
    {
        $tree = ['A', [
            ['C', [
                ['F', [
                    ['J', [
                        ['O'],
                        ['N'],
                    ]],
                    ['I', [
                        ['M'],
                    ]],
                ]],
                ['G', [
                    ['K'],
                    ['L'],
                ]],
            ]],
            ['B', [
                ['E'],
                ['D', [
                    ['H'],
                ]],
            ]],
        ]];

        $expected = ['a', [
            ['c', [
                ['f', [
                    ['j', [
                        ['o'],
                        ['n'],
                    ]],
                    ['i', [
                        ['m'],
                    ]],
                ]],
                ['g', [
                    ['k'],
                    ['l'],
                ]],
            ]],
            ['b', [
                ['e'],
                ['d', [
                    ['h'],
                ]],
            ]],
        ]];

        $actual = map(function ($node) {
            [$name] = $node;
            return strtolower($name);
        }, $tree);
        
        $this->assertEquals($expected, $actual);
    }

    public function testSortTree()
    {
        $tree = ['B', [
            ['D'],
            ['A', [
                ['C', [
                    ['F'],
                    ['E'],
                ]],
                ['B', [
                    ['D'],
                ]],
            ]],
        ]];

        $expected = ['B', [
            ['A', [
                ['B', [
                    ['D'],
                ]],
                ['C', [
                    ['E'],
                    ['F'],
                ]],
            ]],
            ['D'],
        ]];

        $actual = sortTree($tree);
        
        $this->assertEquals($expected, $actual);
    }
}
