<?php

namespace System;

require_once("Enum.php");

/**
 * Specifies whether a System.DateTime object represents a local time, a Coordinated Universal Time (UTC), or is not specified as either local time or UTC.
 * @access public
 * @name DateTimeKind
 * @package System
 */
final class DateTimeKind extends Enum {

    private function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * The time represented is local time.
     * @access public
     * @return DateTimeKind
     */
    public static function local() {
        return new DateTimeKind("Local", 0);
    }

    /**
     * The time represented is not specified as either local time or Coordinated Universal Time (UTC).
     * @access public
     * @return DateTimeKind
     */
    public static function unespecified() {
        return new DateTimeKind("Unespecified", 1);
    }

    /**
     * The time represented is UTC.
     * @access public
     * @return DateTimeKind
     */
    public static function utc() {
        return new DateTimeKind("Utc", 2);
    }
}
?>
