<?php

namespace System\Text;

require_once(dirname(__FILE__) . "/../ICloneable.php");
require_once(dirname(__FILE__) . "/../ArgumentException.php");
require_once(dirname(__FILE__) . "/../ArgumentOutOfRangeException.php");
require_once(dirname(__FILE__) . "/../NotSupportedException.php");
require_once("EncodingInfo.php");

use System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
use System\NotSupportedException as NotSupportedException;
use System\ArgumentException as ArgumentException;

use System\Text\EncoderFallback as EncoderFallback;
use System\Text\DecoderFallback as DecoderFallback;
use System\ICloneable as ICloneable;
use System\Text\EncodingInfo as EncodingInfo;


/**
 * Represents a character encoding.
 * @access public
 * @name Encoding
 * @package System
 * @subpackage Text
 */
abstract class Encoding implements ICloneable {

    protected static $encodings = array(
      37 => array('IBM037', 'IBM EBCDIC (EUA-Canadá)'), 437 => array('IBM437', 'OEM Estados Unidos'), 500 => array('IBM500', 'IBM EBCDIC (Internacional)'),
      708 => array('ASMO-708', 'Árabe (ASMO 708)'), 720 => array('DOS-720', 'Árabe (DOS)'), 737 => array('ibm737', 'Grego (DOS)'),
      775 => array('ibm775', 'Báltico (DOS)'), 850 => array('ibm850', 'Europa Ocidental (DOS)'), 852 => array('ibm852', 'Europa Central (DOS)'),
      855 => array('IBM855', 'OEM Cirílico'), 857 => array('ibm857', 'Turco (DOS)'), 858 => array('IBM00858', 'OEM Latino Multilíngüe I'),
      860 => array('IBM860', 'Português (DOS)'), 861 => array('ibm861', 'Islandês (DOS)'), 862 => array('DOS-862', 'Hebraico (DOS)'),
      863 => array('IBM863', 'Francês Canadense (DOS)'), 864 => array('IBM864', 'Árabe (864)'), 865 => array('IBM865', 'Nórdico (DOS)'),
      866 => array('cp866', 'Cirílico (DOS)'), 869 => array('ibm869', 'Grego Moderno (DOS)'), 870 => array('IBM870', 'IBM EBCDIC (Latino Multilíngüe-2)'),
      874 => array('windows-874', 'Tai (Windows)'), 875 => array('cp875', 'IBM EBCDIC (Grego Moderno)'), 932 => array('shift_jis', 'Japonês (Shift-JIS)'),
      936 => array('gb2312', 'Chinês Simplificado (GB2312)'), 949 => array('ks_c_5601-1987', 'Coreano'), 950 => array('big5', 'Chinês Tradicional (Big5)'),
      1026 => array('IBM1026', 'IBM EBCDIC (Turco Latino-5)'), 1047 => array('IBM01047', 'IBM Latino-1'), 1140 => array('IBM01140', 'IBM EBCDIC (EUA-Canadá-Euro)'),
      1141 => array('IBM01141', 'IBM EBCDIC (Alemanha-Euro)'), 1142 => array('IBM01142', 'IBM EBCDIC (Dinamarca-Noruega-Euro)'),
      1143 => array('IBM01143', 'IBM EBCDIC (Finlândia-Suécia-Euro)'), 1144 => array('IBM01144', 'IBM EBCDIC (Itália-Euro)'), 1145 => array('IBM01145', 'IBM EBCDIC (Espanha-Euro)'),
      1146 => array('IBM01146', 'IBM EBCDIC (UK-Euro)'), 1147 => array('IBM01147', 'IBM EBCDIC (França-Euro)'), 1148 => array('IBM01148', 'IBM EBCDIC (Internacional-Euro)'),
      1149 => array('IBM01149', 'IBM EBCDIC (Islandês-Euro)'), 1200 => array('utf-16', 'Unicode'), 1201 => array('unicodeFFFE', 'Unicode (Big-Endian)'),
      1250 => array('windows-1250', 'Centro-europeu (Windows)'), 1251 => array('windows-1251', 'Cirílico (Windows)'), 1252 => array('Windows-1252', 'Europa Ocidental (Windows)'),
      1253 => array('windows-1253', 'Grego (Windows)'), 1254 => array('windows-1254', 'Turco (Windows)'), 1255 => array('windows-1255', 'Hebraico (Windows)'),
      1256 => array('windows-1256', 'Árabe (Windows)'), 1257 => array('windows-1257', 'Báltico (Windows)'), 1258 => array('windows-1258', 'Vietnamita (Windows)'),
      1361 => array('Johab', 'Coreano (Johab)'), 10000 => array('macintosh', 'Europa Ocidental (Mac)'), 10001 => array('x-mac-japanese', 'Japonês (Mac)'),
      10002 => array('x-mac-chinesetrad', 'Chinês Tradicional (Mac)'), 10003 => array('x-mac-korean', 'Coreano (Mac)'), 10004 => array('x-mac-arabic', 'Árabe (Mac)'),
      10005 => array('x-mac-hebrew', 'Hebraico (Mac)'), 10006 => array('x-mac-greek', 'Grego (Mac)'), 10007 => array('x-mac-cyrillic', 'Cirílico (Mac)'),
      10008 => array('x-mac-chinesesimp', 'Chinês Simplificado (Mac)'), 10010 => array('x-mac-romanian', 'Romeno (Mac)'), 10017 => array('x-mac-ukrainian', 'Ucraniano (Mac)'),
      10021 => array('x-mac-thai', 'Tai (Mac)'), 10029 => array('x-mac-ce', 'Centro-europeu (Mac)'), 10079 => array('x-mac-icelandic', 'Islandês (Mac)'),
      10081 => array('x-mac-turkish', 'Turco (Mac)'), 10082 => array('x-mac-croatian', 'Croata (Mac)'), 12000 => array('utf-32', 'Unicode (UTF-32)'),
      12001 => array('utf-32BE', 'Unicode (UTF-32 Big-Endian)'), 20000 => array('x-Chinese-CNS', 'Chinês Tradicional (CNS)'), 20001 => array('x-cp20001', 'TCA Taiwan'),
      20002 => array('x-Chinese-Eten', 'Chinês Tradicional (Eten)'), 20003 => array('x-cp20003', 'IBM5550 Taiwan'), 20004 => array('x-cp20004', 'TeleText Taiwan'),
      20005 => array('x-cp20005', 'Wang Taiwan'), 20105 => array('x-IA5', 'Europa Ocidental (IA5)'), 20106 => array('x-IA5-German', 'Alemão (IA5)'),
      20107 => array('x-IA5-Swedish', 'Sueco (IA5)'), 20108 => array('x-IA5-Norwegian', 'Norueguês (IA5)'), 20127 => array('us-ascii', 'US-ASCII'), 20261 => array('x-cp20261', 'T.61'),
      20269 => array('x-cp20269', 'ISO-6937'), 20273 => array('IBM273', 'IBM EBCDIC (Alemanha)'), 20277 => array('IBM277', 'IBM EBCDIC (Dinamarca-Noruega)'),
      20278 => array('IBM278', 'IBM EBCDIC (Finlândia-Suécia)'), 20280 => array('IBM280', 'IBM EBCDIC (Itália)'), 20284 => array('IBM284', 'IBM EBCDIC (Espanha)'),
      20285 => array('IBM285', 'IBM EBCDIC (UK)'), 20290 => array('IBM290', 'IBM EBCDIC (Japonês katakana)'), 20297 => array('IBM297', 'IBM EBCDIC (França)'),
      20420 => array('IBM420', 'IBM EBCDIC (Árabe)'), 20423 => array('IBM423', 'IBM EBCDIC (Grego)'), 20424 => array('IBM424', 'IBM EBCDIC (Hebraico)'),
      20833 => array('x-EBCDIC-KoreanExtended', 'IBM EBCDIC (Coreano Estendido)'), 20838 => array('IBM-Thai', 'IBM EBCDIC (Tai)'), 20866 => array('koi8-r', 'Cirílico (KOI8-R)'),
      20871 => array('IBM871', 'IBM EBCDIC (Islandês)'), 20880 => array('IBM880', 'IBM EBCDIC (Russo Cirílico)'), 20905 => array('IBM905', 'IBM EBCDIC (Turco)'),
      20924 => array('IBM00924', 'IBM Latino-1'), 20932 => array('EUC-JP', 'Japonês (JIS 0208-1990 e 0212-1990)'), 20936 => array('x-cp20936', 'Chinês Simplificado (GB2312-80)'),
      20949 => array('x-cp20949', 'Coreano Wansung'), 21025 => array('cp1025', 'IBM EBCDIC (Servo-Búlgaro Cirílico)'), 21866 => array('koi8-u', 'Cirílico (KOI8-U)'),
      28591 => array('iso-8859-1', 'Europa Ocidental (ISO)'), 28592 => array('iso-8859-2', 'Europa Central (ISO)'), 28593 => array('iso-8859-3', 'Latino 3 (ISO)'),
      28594 => array('iso-8859-4', 'Báltico (ISO)'), 28595 => array('iso-8859-5', 'Cirílico (ISO)'), 28596 => array('iso-8859-6', 'Árabe (ISO)'), 28597 => array('iso-8859-7', 'Grego (ISO)'),
      28598 => array('iso-8859-8', 'Hebraico (ISO-Visual)'), 28599 => array('iso-8859-9', 'Turco (ISO)'), 28603 => array('iso-8859-13', 'Estoniano (ISO)'),
      28605 => array('iso-8859-15', 'Latino 9 (ISO)'), 29001 => array('x-Europa', 'Europa'), 38598 => array('iso-8859-8-i', 'Hebraico (ISO-Lógico)'),
      50220 => array('iso-2022-jp', 'Japonês (JIS)'), 50221 => array('csISO2022JP', 'Japonês (JIS-Permitir Kana de 1 byte)'),
      50222 => array('iso-2022-jp', 'Japonês (JIS-Permitir Kana de 1 byte - SO/SI)'), 50225 => array('iso-2022-kr', 'Coreano (ISO)'),
      50227 => array('x-cp50227', 'Chinês Simplificado (ISO-2022)'), 51932 => array('euc-jp', 'Japonês (EUC)'), 51936 => array('EUC-CN', 'Chinês Simplificado (EUC)'),
      51949 => array('euc-kr', 'Coreano (EUC)'), 52936 => array('hz-gb-2312', 'Chinês Simplificado (HZ)'), 54936 => array('GB18030', 'Chinês Simplificado (GB18030)'),
      57002 => array('x-iscii-de', 'ISCII Devanágari'), 57003 => array('x-iscii-be', 'ISCII Bengali'), 57004 => array('x-iscii-ta', 'ISCII Tâmil'),
      57005 => array('x-iscii-te', 'ISCII Telugu'), 57006 => array('x-iscii-as', 'ISCII Assamês'), 57007 => array('x-iscii-or', 'ISCII Oriya'), 57008 => array('x-iscii-ka', 'ISCII Kannada'),
      57009 => array('x-iscii-ma', 'ISCII Malaio'), 57010 => array('x-iscii-gu', 'ISCII Gujarati'), 57011 => array('x-iscii-pa', 'ISCII Punjabi'), 65000 => array('utf-7', 'Unicode (UTF-7)'),
      65001 => array('utf-8', 'Unicode (UTF-8)')
    );


    /**
     * When overridden in a derived class, calculates the number of bytes produced by encoding a set of characters from the specified character array.
     * @access public
     * @abstract
     * @throws \System\ArgumentNullException|\System\ArgumentOutOfRangeException|\System\Text\EncoderFallbackException
     * @param $value The character array containing the set of characters to encode. -or- The System.String containing the set of characters to encode.
     * @param $index The index of the first character to encode.
     * @param $count The number of characters to encode.
     * @return The number of bytes produced by encoding the specified characters.
     */
    public abstract function getByteCount($value, $index=null, $count=null);

    /**
     * Returns the encoding associated with the specified code page name. Parameters specify an error handler for characters that cannot be encoded and byte sequences that cannot be decoded.
     * @static
     * @param object $value The code page name of the preferred encoding. -or- The code page identifier of the preferred encoding.
     * @param EncoderFallback $encoderFallback A System.Text.EncoderFallback object that provides an error handling procedure when a character cannot be encoded with the current encoding.
     * @param DecoderFallback $decoderFallback A System.Text.DecoderFallback object that provides an error handling procedure when a byte sequence cannot be decoded with the current encoding.
     * @return EncodingInfo The System.Text.Encoding object associated with the specified code page.
     */
    public static function getEncoding($value, EncoderFallback $encoderFallback=null, DecoderFallback $decoderFallback=null) {
        if(is_numeric($value))
            return self::getEncodingFromCodePage($value, $encoderFallback, $decoderFallback);
        return self::getEncodingFromName($value, $encoderFallback, $decoderFallback);
    }

    private static function getEncodingFromCodePage($value, $encoderFallback=null, $decoderFallback=null) {
        if($value < 0 || $value > 65535) throw new ArgumentOutOfRangeException("CodePage is less than zero or greater than 65535.");
        if(!array_key_exists($value, self::$encodings)) throw new NotSupportedException("CodePage is not supported by the underlying platform.");
        $encoding = self::$encodings[$value];
        return new EncodingInfo($value, $encoding[1], $encoding[0]);
    }

    private static function getEncodingFromName($value, $encoderFallback=null, $decoderFallback=null) {
        $codePage = 1;
        foreach( self::$encodings as $key => $names) {
            $codePage = array_search($value, $names);
            if($codePage !== false) {
                $codePage = $key;
                break;
            }
        }
        if($codePage === false) throw new ArgumentException("name is not a valid code page name.");
        $encoding = self::$encodings[$codePage];
        return new EncodingInfo($codePage, $encoding[1], $encoding[0]);
    }


    /**
     * Returns an array containing all encodings.
     * @access public
     * @static
     * @return array An array of type System.Text.EncodingInfo containing all encodings.
     */
    public static function getEncodings() {
        return self::$encodings;
    }
}
?>