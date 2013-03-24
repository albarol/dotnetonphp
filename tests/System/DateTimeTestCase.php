<?php

use \System\DateTime as DateTime;
use \System\TimeSpan as TimeSpan;
use \System\DayOfWeek as DayOfWeek;
use \System\DateTimeKind as DateTimeKind;

/**
 * @group core
*/
class DateTimeTestCase extends PHPUnit_Framework_TestCase 
{
    
    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenYearIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2038, 02, 05);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenYearIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        new DateTime(1901, 02, 05);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenMonthIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 13, 05);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenMonthIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, -01, 05);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenDayIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 32);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenDayIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, -01);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenHourIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 01, 24);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenHourIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 01, -01);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenMinuteIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 01, 12, 60);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenMinuteIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 01, 12, -01);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenSecondIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 01, 12, 12, -01);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenSecondIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        new DateTime(2010, 02, 01, 12, 12, 60);
    }
    
    /**
     * @test
    */
    public function Construct_ShouldCreateDateTimeWithoutTime() 
    {
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01);
    
        # Assert:
        $this->assertEquals(2010, $datetime->year());
    }

    /**
     * @test
    */
    public function Construct_ShouldCreateDateTimeWithTime() 
    {
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(23, $datetime->hour());
    }


    /**
     * @test
    */
    public function Day_ShouldGetDayFromDateTime() 
    {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(01, $datetime->day());
    }

    /**
     * @test
    */
    public function Month_ShouldGetMonthFromDateTime() 
    {
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(01, $datetime->month());
    }

    /**
     * @test
    */
    public function Year_ShouldGetYearFromDateTime() 
    {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(2010, $datetime->year());
    }

    /**
     * @test
    */
    public function Hour_ShouldGetHourFromDateTime() 
    {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(23, $datetime->hour());
    }

    /**
     * @test
    */
    public function Minutes_ShouldGetMinuteFromDateTime() 
    {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(59, $datetime->minute());
    }

    /**
     * @test
    */
    public function Seconds_ShouldGetSecondsFromDateTime() 
    {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(59, $datetime->second());
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseOneDayWhenAddTimeSpan() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromDays(1);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(02, $new_date->day());
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseOneHourWhenAddTimeSpan() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromHours(1);
        $datetime = new DateTime(2010, 01, 01, 23, 0, 0);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(02, $new_date->day());
    }

    /**
     * @test
    */
    public function Add_ShouldDecreaseOneDayWhenAddNegativeTimeSpan() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromDays(1);
        $timespan = $timespan->negate();
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(2009, $new_date->year());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddDays_ThrowsExceptionWhenAddGreaterThanMaxValue() 
    {
        
        # Arrange:
        # Act:
        $date = new DateTime(2037, 12, 31);
    
        # Assert:
        $date->addDays(1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddDays_ThrowsExceptionWhenAddLesserThanMinValue() 
    {
        
        # Arrange:
        # Act:
        $date = new DateTime(1902, 01, 01);
    
        # Assert:
        $date->addDays(-1);
    }

    /**
     * @test
    */
    public function AddDays_ShouldAddOneDay() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 8, 19);
    
        # Act:
        $date->addDays(1);
    
        # Assert:
        $this->assertEquals($date->day(), 20);
    }

    /**
     * @test
    */
    public function AddDays_ShouldAddOneDayInLastDayOfMonth() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 8, 31);
    
        # Act:
        $date->addDays(1);
    
        # Assert:
        $this->assertEquals(9, $date->month());
        $this->assertEquals(1, $date->day());
    }

    /**
     * @test
    */
    public function AddDays_ShouldAddOneDayInLastDayOfYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 12, 31);
    
        # Act:
        $date->addDays(1);
    
        # Assert:
        $this->assertEquals(2011, $date->year());
        $this->assertEquals(1, $date->month());
        $this->assertEquals(1, $date->day());
    }

    /**
     * @test
    */
    public function AddDays_ShouldRemoveOneDay() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 8, 19);
    
        # Act:
        $date->addDays(-1);
    
        # Assert:
        $this->assertEquals($date->day(), 18);
    }

    /**
     * @test
    */
    public function AddDays_ShouldRemoveOneDayInFirstDayOfMonth() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 9, 1);
    
        # Act:
        $date->addDays(-1);
    
        # Assert:
        $this->assertEquals(8, $date->month());
        $this->assertEquals(31, $date->day());
    }

    /**
     * @test
    */
    public function AddDays_ShouldAddRemoveDayInLastDayOfYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 1, 1);
    
        # Act:
        $date->addDays(-1);
    
        # Assert:
        $this->assertEquals(2009, $date->year());
        $this->assertEquals(12, $date->month());
        $this->assertEquals(31, $date->day());
    }

    /**
     * @test
    */
    public function AddHours_CanAddHours() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 1, 0, 0, 0);
        
        # Act:
        $date->addHours(11);

        # Assert:
        $this->assertEquals(11, $date->hour());
    }

    /**
     * @test
    */
    public function AddHours_CanAddHourWhenLastHourOfDay(){
        
        # Arrange:
        $date = new DateTime(2011, 1, 1, 23, 0, 0);
        
        # Act:
        $date->addHours(2);

        # Assert:
        $this->assertEquals(1, $date->hour());
        $this->assertEquals(2, $date->day());
    }

    /**
     * @test
    */
    public function AddHours_CanAddTwentyFourHours() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 1);
        $date->addHours(24);

        # Act:

        # Assert:
        $this->assertEquals(2, $date->day());
        $this->assertEquals(0, $date->hour());
    }

    /**
     * @test
    */
    public function AddHours_CanRemoveHour()  {
        
        # Arrange:
        $date = new DateTime(2011, 1, 1, 23);
        
        # Act:
        $date->addHours(-23);
        
        # Assert:
        $this->assertEquals(1, $date->day());
        $this->assertEquals(0, $date->hour());
    }

    /**
     * @test
    */
    public function AddHours_CanRemoveHourWhenFirstHourOfDay() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 1);
        
        # Act:
        $date->addHours(-1);
        
        # Assert:
        $this->assertEquals(31, $date->day());
        $this->assertEquals(23, $date->hour());
    }

    /**
     * @test
    */
    public function AddHours_CanRemove24Hours() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 2, 0, 0, 0);
        
        # Act:
        $date->addHours(-24);

        # Assert:
        $this->assertEquals(1, $date->day());
        $this->assertEquals(0, $date->hour());
    }
    
    /**
     * @test
     */
    public function AddMinutes_CanAddMinutes() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 01, 01, 23, 59);
        
        # Act:
        $date->addMinutes(1);
        
        # Assert:
        $this->assertEquals(2, $date->day());
        $this->assertEquals(0, $date->hour());
    }

    /**
     * @test
     */
    public function AddMinutes_CanAddSixtyMinutes() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 1, 0, 0, 0);
        
        # Act:
        $date->addMinutes(60);
        
        # Assert:
        $this->assertEquals(1, $date->hour());
    }

    /**
     * @test
     */
    public function AddMinutes_CanRemoveMinutes() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 2, 0, 0, 0);
        
        # Act:
        $date->addMinutes(-1);
        
        # Assert:
        $this->assertEquals(1, $date->day());
        $this->assertEquals(23, $date->hour());
    }

    /**
     * @test
     */
    public function AddMinutes_CanRemoveSixtyMinutes() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 2, 23, 59, 59);
        
        # Act:
        $date->addMinutes(-60);
        
        # Assert:
        $this->assertEquals(2, $date->day());
        $this->assertEquals(22, $date->hour());
    }


    /**
     * @test
     */
    public function AddMonth_CanAddMonth() 
    {

        # Arrange:
        $date = new DateTime(2010, 7, 19);
        
        # Act:
        $date->addMonths(1);
        
        # Assert:
        $this->assertEquals($date->month(), 8);
    }

    /**
     * @test
     */
    public function AddMonth_CanAdd12Months() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 07, 19);
        
        # Act:
        $date->addMonths(12);
        
        # Assert:
        $this->assertEquals($date->month(), 7);
        $this->assertEquals($date->year(), 2011);
    }

    /**
     * @test
     */
    public function AddMonth_CanAddOneMonthWithDifferentQuantityOfDays() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 01, 31);
        
        # Act:
        $date->addMonths(1);
        
        # Assert:
        $this->assertEquals(3, $date->month());
        $this->assertEquals(3, $date->day());
    }
    
    /**
     * @test
     */
    public function AddMonth_RemoveMonth() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 8, 19);
        
        # Act:
        $date->addMonths(-1);
        
        # Assert:
        $this->assertEquals(7, $date->month());
    }

    /**
     * @test
     */
    public function AddMonth_CanRemove12Months() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 07, 19);
        
        # Act:
        $date->addMonths(-12);
        
        # Assert:
        $this->assertEquals(7, $date->month());
        $this->assertEquals(2009, $date->year());
    }

    /**
     * @test
     */
    public function AddMonth_CanRemoveOneMonthWithDifferentQuantityOfDays() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 3, 31);
        
        # Act:
        $date->addMonths(-1);
        
        # Assert:
        $this->assertEquals(3, $date->month());
        $this->assertEquals(3, $date->day());
    }

    /**
     * @test
     */
    public function AddSeconds_CanAddSeconds() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 3, 31, 23);
        
        # Act:
        $date->addSeconds(3600);
        
        # Arrange:
        $this->assertEquals(4, $date->month());
        $this->assertEquals(0, $date->hour());
    }

    /**
     * @test
     */
    public function AddSeconds_CanRemoveSeconds() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 3, 31, 23);
        
        # Act:
        $date->addSeconds(-3600);
        
        # Assert:
        $this->assertEquals(22, $date->hour());
    }

    /**
     * @test
     */
    public function AddYear_CanAddOneYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 3, 31);
        
        # Act:
        $date->addYears(1);
        
        # Assert:
        $this->assertEquals(2011, $date->year());
    }

    /**
     * @test
     */
    public function AddYears_CanAddWhenLeapYear() 
    {
        
        # Arrange:
        $date = new DateTime(2004, 2, 29);
        
        # Act:
        $date->addYears(1);
        
        # Assert:
        $this->assertEquals(1, $date->day());
        $this->assertEquals(3, $date->month());
        $this->assertEquals(2005, $date->year());
    }

    /**
     * @test
     */
    public function AddYears_CanRemoveYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 3, 31);
        
        # Act:
        $date->addYears(-1);
        
        # Assert:
        $this->assertEquals(2009, $date->year());
    }

    /**
     * @test
    */
    public function ShouldGetUtcFromSpecifyKind() 
    {
        
        # Arrange:
        date_default_timezone_set("America/Sao_Paulo");
        $now = new DateTime(2010, 05, 05, 20, 0, 0);
    
        # Act:
        $utc = DateTime::specifyKind($now, DateTimeKind::utc());
    
        # Assert:
        $this->assertEquals(23, $utc->hour());
    }

    // /**
    //  * @test
    // */
    // public function ShouldGetLocalFromSpecifyKind() 
    // {
    //     $this->markTestIncomplete('NotImplemented TimeZoneInfo');
    // }

    /**
     * @test
     */
    public function Subtract_WhenSubtractDateShouldBeTimeSpanWithOneDay() 
    {
       
       # Arrange:
       $date = new DateTime(2010, 1, 5);
       $date_to_remove = new DateTime(2010, 1, 4);
       
       # Act:
       $time = $date->subtract($date_to_remove);
       
       # Assert:
       $this->assertEquals(1, $time->days());
    }

    /**
     * @test
     */
    public function Subtract_WhenSubtractFromTimeSpanShouldBeEqualToThreeDays() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 9, 8);
        
        # Act:
        $time = $date->subtract(new TimeSpan(5));
        
        # Assert:
        $this->assertEquals(3, $time->days());
    }

    /**
     * @test
     */
    public function Compare_ShouldBeZeroWhenEqualAnother() 
    {
        
        # Arrange:
        $first_date = new DateTime(2010, 1, 1);
        $second_date = new DateTime(2010, 1, 1);

        # Act:
        $result = DateTime::compare($first_date, $second_date);

        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function Compare_ShouldBeOneWhenGreaterThanAnother() 
    {
        
        # Arrange:
        $first_date = new DateTime(2010, 1, 2);
        $second_date = new DateTime(2010, 1, 1);

        # Act:
        $result = DateTime::compare($first_date, $second_date);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function Compare_ShouldBeMinusOneWhenGreaterThanAnother() 
    {
        
        # Arrange:
        $first_date = new DateTime(2010, 1, 1);
        $second_date = new DateTime(2010, 1, 2);

        # Act:
        $result = DateTime::compare($first_date, $second_date);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    
    /**
     * @test
     */
    public function DaysInMonth_GetDaysInFebruaryWhenLeapYear() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::daysInMonth(2004, 02);
    
        # Assert:
        $this->assertEquals(29, $result);
    }

    /**
     * @test
     */
    public function DaysInMonth_GetDaysInFebruaryWhenNormalYear() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::daysInMonth(2005, 02);
    
        # Assert:
        $this->assertEquals(28, $result);
    }

    /**
     * @test
     */
    public function DaysInMonth_GetDaysInJanuary() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::daysInMonth(2005, 01);
    
        # Assert:
        $this->assertEquals(31, $result);
    }

    /**
     * @test
     */
    public function GetDateAndTimeFormats_CanGetParameters() 
    {
        
        # Arrange:
        $date = new DateTime(2004, 2, 3, 23, 59, 59);

        # Act:
        $formats = $date->getDateAndTimeFormats();

        # Assert:
        $this->assertTrue(sizeof($formats) > 0);
    }

    /**
     * @test
     */
    public function IsDayLightSavingTime_ShouldBeTrueIfTimezoneHasDaylight() 
    {
        
        # Arrange:
        date_default_timezone_set("America/Sao_Paulo");
        $date = new DateTime(2004, 1, 3, 23, 59, 59);
    
        # Act:
        $result = $date->isDaylightSavingTime();
    
        # Assert:
        $this->assertTrue($result);
    
    }

    /**
     * @test
     */
    public function IsDaylightSavingTime_ShouldBeFalseWhenTimezoneDontHaveDaylight() 
    {
        
        # Arrange:
        date_default_timezone_set("America/Sao_Paulo");
        $date = new DateTime(2004, 10, 3, 23, 59, 59);    
    
        # Act:
        $result = $date->isDaylightSavingTime();
    
        # Assert:
        $this->assertFalse($result);
    }

    
    /**
     * @test
     */
    public function IsLeapYear_ShouldBeTrueWhenYearIsLeap() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::isLeapYear(2004);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function IsLeapYear_ShouldBeFalseWhenYearIsOdd() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::isLeapYear(2005);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Parse_ThrowsExceptionWhenInputIsNull() 
    {
        
        # Arrange:
        $format = null;

        # Act:
        DateTime::parse($format);
    }

    /**
     * @test
     * @expectedException \System\FormatException
     */
    public function Parse_ThrowsExceptionWhenInvalidDateFormat() 
    {
        
        # Arrange:
        $format = "10.30.2999";

        # Act:
        DateTime::parse($format);
    }

    /**
     * @test
     */
    public function Parse_CanParseDateTime() 
    {
        
        # Arrange:
        $format = "2011.8.12 11:39";
        
        # Act:
        $date = DateTime::parse($format);
        
        # Assert:
        $this->assertEquals(2011, $date->year());
        $this->assertEquals(11, $date->hour());
    }

    /**
     * @test
     */
    public function DayOfWeek_CanGetDayOfWeek() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 9, 04);

        # Act:
        $day_of_week = $date->dayOfWeek();
        
        # Assert:
        $this->assertEquals(DayOfWeek::saturday(), $day_of_week);
    }

    /**
     * @test
     */
    public function DayOfYear_CanGetFirstDayOfYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 1, 1);

        # Act:
        $day_of_year = $date->dayOfYear();

        # Assert:
        $this->assertEquals(1, $day_of_year);
    }

    /**
     * @test
     */
    public function DayOfYear_CanGetLastDayOfYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 12, 31);

        # Act:
        $day_of_year = $date->dayOfYear();

        # Assert:
        $this->assertEquals(365, $day_of_year);
    }

    /**
     * @test
     */
    public function DayOfYear_CanGetLastDayOfYearWhenIsLeapYear() 
    {
        
        # Arrange:
        $date = new DateTime(2004, 12, 31);
    
        # Act:
        $day_of_year = $date->dayOfYear();
    
        # Assert:
        $this->assertEquals(366, $day_of_year);
    }

    /**
     * @test
     */
    public function Now_ShouldGetNow() 
    {
        
        # Arrange:
        $date = getdate();

        # Act:
        $now = DateTime::now();

        # Assert:
        $this->assertEquals($date["year"], $now->year());
        $this->assertEquals($date["mon"], $now->month());
        $this->assertEquals($date["mday"], $now->day());
        $this->assertEquals($date["hours"], $now->hour());
        $this->assertEquals($date["minutes"], $now->minute());
        $this->assertEquals($date["seconds"], $now->second());
    }

    /**
     * @test
     */
    public function Today_CanGetToday() 
    {
        
        # Arrange:
        $date = getdate();

        # Act:
        $now = DateTime::today();

        # Assert:
        $this->assertEquals($date["year"], $now->year());
        $this->assertEquals($date["mon"], $now->month());
        $this->assertEquals($date["mday"], $now->day());
        $this->assertEquals(0, $now->hour());
        $this->assertEquals(0, $now->minute());
        $this->assertEquals(0, $now->second());
    }
}
