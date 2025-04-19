<?php

/**
 * Get zodiac symbol for a given sign
 *
 * @param string $sign
 * @return string
 */
function getZodiacSymbol($sign)
{
    $symbols = [
        'Aries' => '♈',
        'Taurus' => '♉',
        'Gemini' => '♊',
        'Cancer' => '♋',
        'Leo' => '♌',
        'Virgo' => '♍',
        'Libra' => '♎',
        'Scorpio' => '♏',
        'Sagittarius' => '♐',
        'Capricorn' => '♑',
        'Aquarius' => '♒',
        'Pisces' => '♓'
    ];

    return $symbols[$sign] ?? '✨';
}

/**
 * Get zodiac element for a given sign
 *
 * @param string $sign
 * @return string
 */
function getZodiacElement($sign)
{
    $elements = [
        'Aries' => 'fire',
        'Leo' => 'fire',
        'Sagittarius' => 'fire',
        'Taurus' => 'earth',
        'Virgo' => 'earth',
        'Capricorn' => 'earth',
        'Gemini' => 'air',
        'Libra' => 'air',
        'Aquarius' => 'air',
        'Cancer' => 'water',
        'Scorpio' => 'water',
        'Pisces' => 'water'
    ];

    return $elements[$sign] ?? 'unknown';
}

/**
 * Get zodiac date range for a given sign
 *
 * @param string $sign
 * @return string
 */
function getZodiacDateRange($sign)
{
    $dateRanges = [
        'Aries' => 'March 21 - April 19',
        'Taurus' => 'April 20 - May 20',
        'Gemini' => 'May 21 - June 20',
        'Cancer' => 'June 21 - July 22',
        'Leo' => 'July 23 - August 22',
        'Virgo' => 'August 23 - September 22',
        'Libra' => 'September 23 - October 22',
        'Scorpio' => 'October 23 - November 21',
        'Sagittarius' => 'November 22 - December 21',
        'Capricorn' => 'December 22 - January 19',
        'Aquarius' => 'January 20 - February 18',
        'Pisces' => 'February 19 - March 20'
    ];

    return $dateRanges[$sign] ?? '';
}
