<?php

/**
 * Specifies how to treat the time value when converting between string and System.DateTime.
 * @access public
 * @name XmlDateTimeSerializationMode
 * @package System
 * @subpackage Xml
 */
class XmlDateTimeSerializationMode extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }

    /**
     * Treat as local time. If the System.DateTime object represents a Coordinated Universal Time (UTC), it is converted to the local time.
     * @access public
     * @static
     * @return XmlDateTimeSerializationMode
     */
    public static function local() {
        return new XmlDateTimeSerializationMode("LOCAL", 0);
    }

     /**
     * Time zone information should be preserved when converting.
     * @access public
     * @static
     * @return XmlDateTimeSerializationMode
     */
    public static function roundTripKind() {
        return new XmlDateTimeSerializationMode("ROUND_TRIP_KIND", 3);
    }

     /**
     * Treat as a local time if a System.DateTime is being converted to a string.
     * @access public
     * @static
     * @return XmlDateTimeSerializationMode
     */
    public static function unspecified() {
        return new XmlDateTimeSerializationMode("UNSPECIFIED", 2);
    }

     /**
     * Treat as a UTC. If the System.DateTime object represents a local time, it is converted to a UTC.
     * @access public
     * @static
     * @return XmlDateTimeSerializationMode
     */
    public static function utc() {
        return new XmlDateTimeSerializationMode("UTC", 1);
    }

}
?>
