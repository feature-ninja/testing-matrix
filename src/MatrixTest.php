<?php

declare(strict_types=1);

namespace FeatureNinja\TestingMatrix;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MatrixTest extends TestCase
{
    #[Test]
    public function cases(): void
    {
        $result = Matrix::create([
            'php' => [8.3, 8.4],
            'node' => [
                Value::of('18', 18),
                Value::of('20', fn () => 20),
            ],
            'postgres' => [
                Value::of('v15', '15.0'),
                Value::lazy('v16', fn () => '16.0'),
            ],
        ]);

        $this->assertSame([
            'php=8.3 node=18 postgres=v15' => [8.3, 18, '15.0'],
            'php=8.3 node=18 postgres=v16' => [8.3, 18, '16.0'],
            'php=8.3 node=20 postgres=v15' => [8.3, 20, '15.0'],
            'php=8.3 node=20 postgres=v16' => [8.3, 20, '16.0'],
            'php=8.4 node=18 postgres=v15' => [8.4, 18, '15.0'],
            'php=8.4 node=18 postgres=v16' => [8.4, 18, '16.0'],
            'php=8.4 node=20 postgres=v15' => [8.4, 20, '15.0'],
            'php=8.4 node=20 postgres=v16' => [8.4, 20, '16.0'],
        ], iterator_to_array($result));
    }
}
