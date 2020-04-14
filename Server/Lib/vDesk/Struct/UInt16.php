<?php
declare(strict_types=1);

namespace vDesk\Struct;

/**
 * Represents an unsigned 16-bit integer.
 *
 * @package vDesk\Struct
 * @author  Kerry Holz <DevelopmentHero@gmail.com>
 * @version 1.0.0
 */
class UInt16 {

    /**
     * Represents the largest possible value of an unsigned 16-bit integer.
     */
    public const MaxValue = 65535;

    /**
     * Represents the smallest possible value of an unsigned 16-bit integer.
     */
    public const MinValue = 0;

    /**
     * The size in Bytes an unsigned 16-bit integer will address.
     */
    public const Size = 2;

    /**
     * Parses an unsigned 16-bit integer from a specified string.
     *
     * @param string $String The string to parse.
     *
     * @throws \OverflowException Thrown if the numeric value of the specified string exceeds the value specific value range.
     * @return int An unsigned 16-bit integer that yields the value parsed from the specified string.
     */
    public static function Parse(string $String): int {
        return Number::ParseUInt16($String);
    }

    /**
     * Tries to parse an unsigned 16-bit integer from a specified string.
     *
     * @param string $String The string to parse.
     *
     * @return int|null An unsigned 16-bit integer that yields the value parsed from the specified string; otherwise, null.
     */
    public static function TryParse(string $String): ?int {
        return Number::TryParseUInt16($String);
    }

}
