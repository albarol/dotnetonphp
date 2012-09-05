<?php

namespace System;

require_once("Enum.php");

/**
 * Specifies the day of the week.
 * @access public
 * @name DayOfWeek
 * @package System
 */
class DayOfWeek extends Enum {

    private function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    public static function sunday() {
        return new DayOfWeek("Sunday", 0);
    }

    public static function monday() {
        return new DayOfWeek("Monday", 1);
    }

    public static function tuesday() {
        return new DayOfWeek("Tuesday", 2);
    }

    public static function wednesday() {
        return new DayOfWeek("Wednesday", 3);
    }

    public static function thursday() {
        return new DayOfWeek("Thursday", 4);
    }

    public static function friday() {
        return new DayOfWeek("Friday", 5);
    }

    public static function saturday() {
        return new DayOfWeek("Saturday", 6);
    }
}
?>
