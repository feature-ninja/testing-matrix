<?php

declare(strict_types=1);

namespace FeatureNinja\TestingMatrix;

use Closure;

final readonly class Value
{
    public function __construct(
        public string $label,
        public Closure $resolve,
    ) {}

    public static function of(string $label, mixed $value): self
    {
        return new self(
            $label,
            fn () => $value,
        );
    }

    public static function wrap(mixed $value): self
    {
        return self::of(json_encode($value), $value);
    }

    public static function lazy(string $label, callable $resolve): self
    {
        return new self($label, $resolve(...));
    }

    public function resolve(): mixed
    {
        return ($this->resolve)();
    }
}
