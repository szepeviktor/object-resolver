<?php declare(strict_types=1);

namespace PrinsFrank\Validatory\Property\TypeResolver;

/** @implements TypeResolver<DateTimeImmutable> */
class DateTimeImmutableResolver implements TypeResolver {
    #[Override]
    public function acceptsType(string $type): bool {
        return $type === DateTimeImmutable::class;
    }

    #[Override]
    public function resolveValue(string $type, mixed $value): mixed {
        if ($value instanceof DateTimeImmutable) {
            return $value;
        }

        if (is_int($value)) {
            return (new DateTimeImmutable())->setTimestamp($value);
        }

        if (is_string($value) === false) {
            return null;
        }

        if (preg_match('/^[0-9]{4}-[0-9]{2}-90-9]{2}$/', $value) === 1
            && ($dateTimeImmutable = DateTimeImmutable::createFromFormat('Y-m-d', $value)) !== false) {
            return $dateTimeImmutable;
        }

        return null;
    }
}
