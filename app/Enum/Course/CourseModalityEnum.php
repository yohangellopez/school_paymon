<?php

namespace App\Enum\Course;

enum CourseModalityEnum: string
{
    case IN_PERSON = 'in-person';
    case ONLINE = 'online'; 
    case HYBRID = 'hybrid';

    /**
     * Return the name of the Enum.
     */
    public function name(): string
    {
        return match ($this) {
            self::IN_PERSON => 'In person',
            self::ONLINE => 'Online',
            self::HYBRID => 'Hybrid',
        };
    }

    /**
     * Returns an array of all possible values of this Enum (name-value).
     */
    public static function list(): array
    {
        $enumValuesArray = array_map(
            fn ($enumValue) => (object) ['name' => $enumValue->name(), 'value' => $enumValue->value],
            self::cases()
        );

        return $enumValuesArray;
    }

    /**
     * Returns an array of values of this Enum (value).
     */
    public static function values(): array
    {
        $enumValuesArray = array_map(
            fn ($enumValue) => $enumValue->value,
            self::cases()
        );

        return $enumValuesArray;
    }
}
