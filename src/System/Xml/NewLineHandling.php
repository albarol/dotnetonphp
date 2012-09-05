<?php


require_once(dirname(__FILE__).'/../Enum.php');

/**
 * Specifies how to handle line breaks.
 * @access public
 * @name NewLineHandling
 * @package System
 * @subpackage Xml
 */
class NewLineHandling extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }

    /**
     * New line characters are entitized. This setting preserves all characters when the output is read by a normalizing System.Xml.XmlReader.
     * @access public
     * @return NewLineHandling
     */
    public static function entitize() {
        return new NewLineHandling("ENTITIZE", 0);
    }


    /**
     * The new line characters are unchanged. The output is the same as the input.
     * @access public
     * @return NewLineHandling
     */
    public static function none() {
        return new NewLineHandling("NONE", 1);
    }


    /**
     * New line characters are replaced to match the character specified in the System.Xml.XmlWriterSettings.NewLineChars property.
     * @access public
     * @return NewLineHandling
     */
    public static function replace() {
        return new NewLineHandling("REPLACE", 2);
    }

}
?>
