<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Carbon;

use Closure;
use ReflectionMethod;

/**
 * A factory to generate Carbon instances with common settings.
 *
 * <autodoc generated by `composer phpdoc`>
 *
 * @method bool canBeCreatedFromFormat($date, $format) Checks if the (date)time string is in a given format and valid to create a
 *         new instance.
 * @method Carbon|false create($year = 0, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $tz = null) Create a new Carbon instance from a specific date and time.
 *         If any of $year, $month or $day are set to null their now() values will
 *         be used.
 *         If $hour is null it will be set to its now() value and the default
 *         values for $minute and $second will be their now() values.
 *         If $hour is not null then the default values for $minute and $second
 *         will be 0.
 * @method Carbon createFromDate($year = null, $month = null, $day = null, $tz = null) Create a Carbon instance from just a date. The time portion is set to now.
 * @method Carbon|false createFromFormat($format, $time, $tz = null) Create a Carbon instance from a specific format.
 * @method Carbon|false createFromIsoFormat($format, $time, $tz = null, $locale = 'en', $translator = null) Create a Carbon instance from a specific ISO format (same replacements as ->isoFormat()).
 * @method Carbon|false createFromLocaleFormat($format, $locale, $time, $tz = null) Create a Carbon instance from a specific format and a string in a given language.
 * @method Carbon|false createFromLocaleIsoFormat($format, $locale, $time, $tz = null) Create a Carbon instance from a specific ISO format and a string in a given language.
 * @method Carbon createFromTime($hour = 0, $minute = 0, $second = 0, $tz = null) Create a Carbon instance from just a time. The date portion is set to today.
 * @method Carbon createFromTimeString($time, $tz = null) Create a Carbon instance from a time string. The date portion is set to today.
 * @method Carbon createFromTimestamp($timestamp, $tz = null) Create a Carbon instance from a timestamp and set the timezone (use default one if not specified).
 *         Timestamp input can be given as int, float or a string containing one or more numbers.
 * @method Carbon createFromTimestampMs($timestamp, $tz = null) Create a Carbon instance from a timestamp in milliseconds.
 *         Timestamp input can be given as int, float or a string containing one or more numbers.
 * @method Carbon createFromTimestampMsUTC($timestamp) Create a Carbon instance from a timestamp in milliseconds.
 *         Timestamp input can be given as int, float or a string containing one or more numbers.
 * @method Carbon createFromTimestampUTC($timestamp) Create a Carbon instance from an timestamp keeping the timezone to UTC.
 *         Timestamp input can be given as int, float or a string containing one or more numbers.
 * @method Carbon createMidnightDate($year = null, $month = null, $day = null, $tz = null) Create a Carbon instance from just a date. The time portion is set to midnight.
 * @method Carbon|false createSafe($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null) Create a new safe Carbon instance from a specific date and time.
 *         If any of $year, $month or $day are set to null their now() values will
 *         be used.
 *         If $hour is null it will be set to its now() value and the default
 *         values for $minute and $second will be their now() values.
 *         If $hour is not null then the default values for $minute and $second
 *         will be 0.
 *         If one of the set values is not valid, an InvalidDateException
 *         will be thrown.
 * @method Carbon disableHumanDiffOption($humanDiffOption) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 * @method Carbon enableHumanDiffOption($humanDiffOption) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 * @method mixed executeWithLocale($locale, $func) Set the current locale to the given, execute the passed function, reset the locale to previous one,
 *         then return the result of the closure (or null if the closure was void).
 * @method Carbon fromSerialized($value) Create an instance from a serialized string.
 * @method void genericMacro($macro, $priority = 0) Register a custom macro.
 * @method array getAvailableLocales() Returns the list of internally available locales and already loaded custom locales.
 *         (It will ignore custom translator dynamic loading.)
 * @method Language[] getAvailableLocalesInfo() Returns list of Language object for each available locale. This object allow you to get the ISO name, native
 *         name, region and variant of the locale.
 * @method array getDays() Get the days of the week
 * @method string|null getFallbackLocale() Get the fallback locale.
 * @method array getFormatsToIsoReplacements() List of replacements from date() format to isoFormat().
 * @method int getHumanDiffOptions() Return default humanDiff() options (merged flags as integer).
 * @method array getIsoUnits() Returns list of locale units for ISO formatting.
 * @method Carbon getLastErrors() {@inheritdoc}
 * @method string getLocale() Get the current translator locale.
 * @method callable|null getMacro($name) Get the raw callable macro registered globally for a given name.
 * @method int getMidDayAt() get midday/noon hour
 * @method Closure|Carbon getTestNow() Get the Carbon instance (real or mock) to be returned when a "now"
 *         instance is created.
 * @method string getTimeFormatByPrecision($unitPrecision) Return a format from H:i to H:i:s.u according to given unit precision.
 * @method string getTranslationMessageWith($translator, string $key, string $locale = null, string $default = null) Returns raw translation message for a given key.
 * @method \Symfony\Component\Translation\TranslatorInterface getTranslator() Get the default translator instance in use.
 * @method int getWeekEndsAt() Get the last day of week
 * @method int getWeekStartsAt() Get the first day of week
 * @method array getWeekendDays() Get weekend days
 * @method bool hasFormat($date, $format) Checks if the (date)time string is in a given format.
 * @method bool hasFormatWithModifiers($date, $format) Checks if the (date)time string is in a given format.
 * @method bool hasMacro($name) Checks if macro is registered globally.
 * @method bool hasRelativeKeywords($time) Determine if a time string will produce a relative date.
 * @method bool hasTestNow() Determine if there is a valid test instance set. A valid test instance
 *         is anything that is not null.
 * @method Carbon instance($date) Create a Carbon instance from a DateTime one.
 * @method bool isImmutable() Returns true if the current class/instance is immutable.
 * @method bool isModifiableUnit($unit) Returns true if a property can be changed via setter.
 * @method bool isMutable() Returns true if the current class/instance is mutable.
 * @method bool isStrictModeEnabled() Returns true if the strict mode is globally in use, false else.
 *         (It can be overridden in specific instances.)
 * @method bool localeHasDiffOneDayWords($locale) Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).
 *         Support is considered enabled if the 3 words are translated in the given locale.
 * @method bool localeHasDiffSyntax($locale) Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).
 *         Support is considered enabled if the 4 sentences are translated in the given locale.
 * @method bool localeHasDiffTwoDayWords($locale) Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).
 *         Support is considered enabled if the 2 words are translated in the given locale.
 * @method bool localeHasPeriodSyntax($locale) Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).
 *         Support is considered enabled if the 4 sentences are translated in the given locale.
 * @method bool localeHasShortUnits($locale) Returns true if the given locale is internally supported and has short-units support.
 *         Support is considered enabled if either year, day or hour has a short variant translated.
 * @method void macro($name, $macro) Register a custom macro.
 * @method Carbon|null make($var) Make a Carbon instance from given variable if possible.
 *         Always return a new instance. Parse only strings and only these likely to be dates (skip intervals
 *         and recurrences). Throw an exception for invalid format, but otherwise return null.
 * @method Carbon maxValue() Create a Carbon instance for the greatest supported date.
 * @method Carbon minValue() Create a Carbon instance for the lowest supported date.
 * @method void mixin($mixin) Mix another object into the class.
 * @method Carbon now($tz = null) Get a Carbon instance for the current date and time.
 * @method Carbon parse($time = null, $tz = null) Create a carbon instance from a string.
 *         This is an alias for the constructor that allows better fluent syntax
 *         as it allows you to do Carbon::parse('Monday next week')->fn() rather
 *         than (new Carbon('Monday next week'))->fn().
 * @method Carbon parseFromLocale($time, $locale = null, $tz = null) Create a carbon instance from a localized string (in French, Japanese, Arabic, etc.).
 * @method string pluralUnit(string $unit) Returns standardized plural of a given singular/plural unit name (in English).
 * @method Carbon|false rawCreateFromFormat($format, $time, $tz = null) Create a Carbon instance from a specific format.
 * @method Carbon rawParse($time = null, $tz = null) Create a carbon instance from a string.
 *         This is an alias for the constructor that allows better fluent syntax
 *         as it allows you to do Carbon::parse('Monday next week')->fn() rather
 *         than (new Carbon('Monday next week'))->fn().
 * @method Carbon resetMacros() Remove all macros and generic macros.
 * @method void resetMonthsOverflow() @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 *         Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
 *         are available for quarters, years, decade, centuries, millennia (singular and plural forms).
 * @method void resetToStringFormat() Reset the format used to the default when type juggling a Carbon instance to a string
 * @method void resetYearsOverflow() @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 *         Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
 *         are available for quarters, years, decade, centuries, millennia (singular and plural forms).
 * @method void serializeUsing($callback) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather transform Carbon object before the serialization.
 *         JSON serialize all Carbon instances using the given callback.
 * @method Carbon setFallbackLocale($locale) Set the fallback locale.
 * @method Carbon setHumanDiffOptions($humanDiffOptions) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 * @method bool setLocale($locale) Set the current translator locale and indicate if the source locale file exists.
 *         Pass 'auto' as locale to use closest language from the current LC_TIME locale.
 * @method void setMidDayAt($hour) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather consider mid-day is always 12pm, then if you need to test if it's an other
 *         hour, test it explicitly:
 *         $date->format('G') == 13
 *         or to set explicitly to a given hour:
 *         $date->setTime(13, 0, 0, 0)
 *         Set midday/noon hour
 * @method Carbon setTestNow($testNow = null) Set a Carbon instance (real or mock) to be returned when a "now"
 *         instance is created. The provided instance will be returned
 *         specifically under the following conditions:
 *         - A call to the static now() method, ex. Carbon::now()
 *         - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
 *         - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
 *         - When a string containing the desired time is passed to Carbon::parse().
 *         Note the timezone parameter was left out of the examples above and
 *         has no affect as the mock value will be returned regardless of its value.
 *         To clear the test instance call this method using the default
 *         parameter of null.
 *         /!\ Use this method for unit tests only.
 * @method void setToStringFormat($format) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather let Carbon object being casted to string with DEFAULT_TO_STRING_FORMAT, and
 *         use other method or custom format passed to format() method if you need to dump an other string
 *         format.
 *         Set the default format used when type juggling a Carbon instance to a string
 * @method void setTranslator(\Symfony\Component\Translation\TranslatorInterface $translator) Set the default translator instance to use.
 * @method Carbon setUtf8($utf8) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use UTF-8 language packages on every machine.
 *         Set if UTF8 will be used for localized date/time.
 * @method void setWeekEndsAt($day) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         Use $weekStartsAt optional parameter instead when using startOfWeek, floorWeek, ceilWeek
 *         or roundWeek method. You can also use the 'first_day_of_week' locale setting to change the
 *         start of week according to current locale selected and implicitly the end of week.
 *         Set the last day of week
 * @method void setWeekStartsAt($day) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         Use $weekEndsAt optional parameter instead when using endOfWeek method. You can also use the
 *         'first_day_of_week' locale setting to change the start of week according to current locale
 *         selected and implicitly the end of week.
 *         Set the first day of week
 * @method void setWeekendDays($days) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather consider week-end is always saturday and sunday, and if you have some custom
 *         week-end days to handle, give to those days an other name and create a macro for them:
 *         ```
 *         Carbon::macro('isDayOff', function ($date) {
 *         return $date->isSunday() || $date->isMonday();
 *         });
 *         Carbon::macro('isNotDayOff', function ($date) {
 *         return !$date->isDayOff();
 *         });
 *         if ($someDate->isDayOff()) ...
 *         if ($someDate->isNotDayOff()) ...
 *         // Add 5 not-off days
 *         $count = 5;
 *         while ($someDate->isDayOff() || ($count-- > 0)) {
 *         $someDate->addDay();
 *         }
 *         ```
 *         Set weekend days
 * @method bool shouldOverflowMonths() Get the month overflow global behavior (can be overridden in specific instances).
 * @method bool shouldOverflowYears() Get the month overflow global behavior (can be overridden in specific instances).
 * @method string singularUnit(string $unit) Returns standardized singular of a given singular/plural unit name (in English).
 * @method Carbon today($tz = null) Create a Carbon instance for today.
 * @method Carbon tomorrow($tz = null) Create a Carbon instance for tomorrow.
 * @method string translateTimeString($timeString, $from = null, $to = null, $mode = CarbonInterface::TRANSLATE_ALL) Translate a time string from a locale to an other.
 * @method string translateWith(\Symfony\Component\Translation\TranslatorInterface $translator, string $key, array $parameters = [], $number = null) Translate using translation string or callback available.
 * @method void useMonthsOverflow($monthsOverflow = true) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 *         Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
 *         are available for quarters, years, decade, centuries, millennia (singular and plural forms).
 * @method Carbon useStrictMode($strictModeEnabled = true) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 * @method void useYearsOverflow($yearsOverflow = true) @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
 *         You should rather use the ->settings() method.
 *         Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
 *         are available for quarters, years, decade, centuries, millennia (singular and plural forms).
 * @method Carbon withTestNow($testNow = null, $callback = null) Temporarily sets a static date to be used within the callback.
 *         Using setTestNow to set the date, executing the callback, then
 *         clearing the test instance.
 *         /!\ Use this method for unit tests only.
 * @method Carbon yesterday($tz = null) Create a Carbon instance for yesterday.
 *        
 *         </autodoc>
 */
class Factory
{

    protected $className = Carbon::class;

    protected $settings = [];

    public function __construct(array $settings = [], string $className = null)
    {
        if ($className) {
            $this->className = $className;
        }

        $this->settings = $settings;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName(string $className)
    {
        $this->className = $className;

        return $this;
    }

    public function className(string $className = null)
    {
        return $className === null ? $this->getClassName() : $this->setClassName($className);
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function setSettings(array $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    public function settings(array $settings = null)
    {
        return $settings === null ? $this->getSettings() : $this->setSettings($settings);
    }

    public function mergeSettings(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);

        return $this;
    }

    public function __call($name, $arguments)
    {
        $method = new ReflectionMethod($this->className, $name);
        $settings = $this->settings;

        if ($settings && isset($settings['timezone'])) {
            $tzParameters = array_filter($method->getParameters(), function ($parameter) {
                return \in_array($parameter->getName(), [
                    'tz',
                    'timezone'
                ], true);
            });

            if (\count($tzParameters)) {
                array_splice($arguments, key($tzParameters), 0, [
                    $settings['timezone']
                ]);
                unset($settings['timezone']);
            }
        }

        $result = $this->className::$name(...$arguments);

        return $result instanceof CarbonInterface && ! empty($settings) ? $result->settings($settings) : $result;
    }
}
