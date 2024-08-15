<?php

declare(strict_types=1);

namespace FeatureNinja\TestingMatrix;

use Generator;

final class Matrix
{
    /**
     * @param  array<string, mixed>  $matrix
     * @return Generator<string, array<int, mixed>>
     */
    public static function create(array $matrix): Generator
    {
        $names = array_keys($matrix);
        $matrix = array_values($matrix);

        foreach (self::recurse($matrix, []) as $result) {
            $key = implode(' ', array_map(
                fn (mixed $value, int $i) => sprintf(
                    '%s=%s',
                    $names[$i],
                    json_encode($value),
                ),
                $result,
                array_keys($result),
            ));

            yield $key => $result;
        }
    }

    /**
     * @param  array<int, mixed>  $matrix
     * @param  array<int, mixed>  $head
     * @return Generator<int, array<int, mixed>>
     */
    private static function recurse(array $matrix, array $head): Generator
    {
        if (count($matrix) === 0) {
            yield $head;

            return;
        }

        foreach (array_shift($matrix) as $value) {
            foreach (self::recurse($matrix, [...$head, $value]) as $result) {
                yield $result;
            }
        }
    }
}
