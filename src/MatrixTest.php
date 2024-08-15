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
            'node' => [18, 20],
            'postgres' => ['v15', 'v16'],
        ]);

        $this->assertSame([
            'php=8.3 node=18 postgres="v15"' => [8.3, 18, 'v15'],
            'php=8.3 node=18 postgres="v16"' => [8.3, 18, 'v16'],
            'php=8.3 node=20 postgres="v15"' => [8.3, 20, 'v15'],
            'php=8.3 node=20 postgres="v16"' => [8.3, 20, 'v16'],
            'php=8.4 node=18 postgres="v15"' => [8.4, 18, 'v15'],
            'php=8.4 node=18 postgres="v16"' => [8.4, 18, 'v16'],
            'php=8.4 node=20 postgres="v15"' => [8.4, 20, 'v15'],
            'php=8.4 node=20 postgres="v16"' => [8.4, 20, 'v16'],
        ], iterator_to_array($result));
    }
}
