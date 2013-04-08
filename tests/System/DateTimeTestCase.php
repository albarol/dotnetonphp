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
    public function setUp()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }


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
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Add_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromDays(-1);
        $datetime = new DateTime(1902, 01, 01);
    
        # Act:
        $datetime->add($timespan);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Add_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromDays(1);
        $datetime = new DateTime(2037, 12, 31);
    
        # Act:
        $datetime->add($timespan);
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseDays() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromDays(2);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(3, $new_date->day());
    }

    /**
     * @test
    */
    public function Add_ShouldDecreaseDays() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromDays(-1);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(31, $new_date->day());
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseHours() 
    {
        # Arrange:
        $timespan = TimeSpan::fromHours(12);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(12, $new_date->hour());
    }

    /**
     * @test
    */
    public function Add_ShouldDecreaseHours() 
    {
        # Arrange:
        $timespan = TimeSpan::fromHours(-1);
        $datetime = new DateTime(2010, 01, 02, 12, 0, 0);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(11, $new_date->hour());
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseMinutes() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMinutes(12);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(12, $new_date->minute());
    }

    /**
     * @test
    */
    public function Add_ShouldDecreaseMinutes() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMinutes(-1);
        $datetime = new DateTime(2010, 01, 02, 12, 12, 0);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(11, $new_date->minute());
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseSeconds() 
    {
        # Arrange:
        $timespan = TimeSpan::fromSeconds(12);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(12, $new_date->second());
    }

    /**
     * @test
    */
    public function Add_ShouldDecreaseSeconds() 
    {
        # Arrange:
        $timespan = TimeSpan::fromSeconds(-1);
        $datetime = new DateTime(2010, 01, 02, 12, 12, 12);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(11, $new_date->second());
    }

    /**
     * @test
    */
    public function Add_ShouldIncreaseMilliseconds() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(12);
        $datetime = new DateTime(2010, 01, 01);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(12, $new_date->millisecond());
    }

    /**
     * @test
    */
    public function Add_ShouldDecreaseMilliseconds() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(-1);
        $datetime = new DateTime(2010, 01, 02, 12, 12, 12);
    
        # Act:
        $new_date = $datetime->add($timespan);
    
        # Assert:
        $this->assertEquals(999, $new_date->millisecond());
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
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddHours_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        $date = new DateTime(2037, 12, 31);
    
        # Assert:
        $date->addHours(24);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddHours_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        $date = new DateTime(1902, 01, 01);
    
        # Assert:
        $date->addHours(-24);
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
    public function AddHours_CanAddHourWhenLastHourOfDay()
    {
        
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
    public function AddHours_CanRemoveHour()  
    {
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
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddMilliseconds_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        $day_millisecond = TimeSpan::TicksPerDay/TimeSpan::TicksPerMillisecond;
        $date = new DateTime(2037, 12, 31);
    
        # Assert:
        $date->addMilliseconds($day_millisecond);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddMilliseconds_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        $day_millisecond = TimeSpan::TicksPerDay/TimeSpan::TicksPerMillisecond;
        $date = new DateTime(1902, 01, 01);
    
        # Assert:
        $date->addMilliseconds(-$day_millisecond);
    }

    /**
     * @test
    */
    public function AddMilliseconds_ShouldIncreseOneDay() 
    {
        # Arrange:
        $day_millisecond = TimeSpan::TicksPerDay/TimeSpan::TicksPerMillisecond;
        $date = new DateTime(2010, 10, 10);    
    
        # Act:
        $result = $date->addMilliseconds($day_millisecond);
    
        # Assert:
        $this->assertEquals(11, $result->day());
    }

    /**
     * @test
    */
    public function AddMilliseconds_ShouldDecreaseOneDay() 
    {
        # Arrange:
        $day_millisecond = -1*TimeSpan::TicksPerDay/TimeSpan::TicksPerMillisecond;
        $date = new DateTime(2010, 10, 10);    
    
        # Act:
        $result = $date->addMilliseconds($day_millisecond);
    
        # Assert:
        $this->assertEquals(9, $result->day());
    }

    /**
     * @test
    */
    public function AddMilliseconds_ShouldIncreaseFewSeconds() 
    {
        # Arrange:
        $milliseconds = 3300;
        $date = new DateTime(2010, 10, 10);    
    
        # Act:
        $result = $date->addMilliseconds($milliseconds);
    
        # Assert:
        $this->assertEquals(3, $result->second());
    }

    /**
     * @test
    */
    public function AddMilliseconds_ShouldIncreaseFewMilliseconds() 
    {
        # Arrange:
        $milliseconds = 3300;
        $date = new DateTime(2010, 10, 10);    
    
        # Act:
        $result = $date->addMilliseconds($milliseconds);
    
        # Assert:
        $this->assertEquals(300, $result->millisecond());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddMinutes_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $date = new DateTime(2037, 12, 31);
    
        # Act:
        $date->addMinutes(24*60);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddMinutes_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $date = new DateTime(1902, 01, 01);
    
        # Act:
        $date->addMinutes(-24*60);
    }

    /**
     * @test
     */
    public function AddMinutes_ShouldIncreaseOneDay() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 01, 01, 23, 59);
        
        # Act:
        $date->addMinutes(1);
        
        # Assert:
        $this->assertEquals(2, $date->day());
    }

    /**
     * @test
     */
    public function AddMinutes_ShouldDecreaseOneDay() 
    {
        
        # Arrange:
        $date = new DateTime(2011, 1, 2, 0, 0, 0);
        
        # Act:
        $date->addMinutes(-1);
        
        # Assert:
        $this->assertEquals(1, $date->day());
    }

    /**
     * @test
     */
    public function AddMinutes_ShouldIncreaseOneHour() 
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
    public function AddMinutes_ShouldDecreaseOneHour() 
    {
        # Arrange:
        $date = new DateTime(2011, 1, 2, 23, 59, 59);
        
        # Act:
        $date->addMinutes(-60);
        
        # Assert:
        $this->assertEquals(22, $date->hour());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddMonths_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $date = new DateTime(2037, 12, 31);
    
        # Act:
        $date->addMonths(1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddMonths_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $date = new DateTime(1902, 01, 01);
    
        # Act:
        $date->addMonths(-1);
    }

    /**
     * @test
     */
    public function AddMonths_ShouldAddFewMonths() 
    {
        # Arrange:
        $date = new DateTime(2010, 7, 19);
        
        # Act:
        $date->addMonths(2);
        
        # Assert:
        $this->assertEquals(9, $date->month());
    }

    /**
     * @test
     */
    public function AddMonths_ShouldDecreaseFewMonths() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 8, 19);
        
        # Act:
        $date->addMonths(-2);
        
        # Assert:
        $this->assertEquals(6, $date->month());
    }

    /**
     * @test
     */
    public function AddMonths_ShouldIncreaseOneYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 07, 19);
        
        # Act:
        $date->addMonths(12);
        
        # Assert:
        $this->assertEquals($date->year(), 2011);
    }

    /**
     * @test
     */
    public function AddMonths_ShouldDecreaseOneYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 07, 19);
        
        # Act:
        $date->addMonths(-12);
        
        # Assert:
        $this->assertEquals(2009, $date->year());
    }

    /**
     * @test
     */
    public function AddMonths_ShouldIncreaseWithDifferentNumberOfDays() 
    {
        # Arrange:
        $date = new DateTime(2010, 01, 31);
        
        # Act:
        $date->addMonths(1);
        
        # Assert:
        $this->assertEquals(3, $date->month());
    }

    /**
     * @test
     */
    public function AddMonths_ShouldDecreaseWithDifferentNumberOfDays() 
    {
        # Arrange:
        $date = new DateTime(2010, 3, 31);
        
        # Act:
        $date->addMonths(-2);
        
        # Assert:
        $this->assertEquals(1, $date->month());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddSeconds_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $date = new DateTime(2037, 12, 31);
    
        # Act:
        $date->addSeconds(24*60*60);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddSeconds_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $date = new DateTime(1902, 01, 01);
    
        # Act:
        $date->addSeconds(-24*60*60);
    }

    /**
     * @test
     */
    public function AddSeconds_ShouldIncreaseFewSeconds() 
    {
        # Arrange:
        $date = new DateTime(2010, 3, 31, 23);
        
        # Act:
        $date->addSeconds(3600);
        
        # Arrange:
        $this->assertEquals(0, $date->hour());
    }

    /**
     * @test
     */
    public function AddSeconds_ShouldDecreaseFewSeconds() 
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
    public function AddSeconds_ShouldIncreaseOneMinute() 
    {
        # Arrange:
        $date = new DateTime(2010, 3, 31, 23, 0, 0);
        
        # Act:
        $date->addSeconds(60);
        
        # Assert:
        $this->assertEquals(1, $date->minute());
    }

    /**
     * @test
    */
    public function AddSeconds_ShouldDecreaseOneMinute() 
    {
        # Arrange:
        $date = new DateTime(2010, 3, 31, 23, 1, 0);
        
        # Act:
        $date->addSeconds(-60);
        
        # Assert:
        $this->assertEquals(0, $date->minute());
    }

    /**
     * @test
    */
    public function AddSeconds_ShouldIncreaseOneHour() 
    {
        # Arrange:
        $date = new DateTime(2010, 3, 31, 22, 0, 0);
        
        # Act:
        $date->addSeconds(3600);
        
        # Assert:
        $this->assertEquals(23, $date->hour());
    }

    /**
     * @test
    */
    public function AddSeconds_ShouldDecreaseOneHour() 
    {
        # Arrange:
        $date = new DateTime(2010, 3, 31, 22, 0, 0);
        
        # Act:
        $date->addSeconds(-3600);
        
        # Assert:
        $this->assertEquals(21, $date->hour());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddYears_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $date = new DateTime(2037, 12, 31);
    
        # Act:
        $date->addYears(1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function AddYears_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $date = new DateTime(1902, 01, 01);
    
        # Act:
        $date->addYears(-1);
    }

    /**
     * @test
    */
    public function AddYears_ShouldIncreaseFewYears() 
    {
        # Arrange:
        $date = new DateTime(2010, 10, 10);
        
        # Act:
        $date->addYears(1);
        
        # Assert:
        $this->assertEquals(2011, $date->year());
    }

    /**
     * @test
    */
    public function AddYears_ShouldDecreaseFewYears() 
    {
        # Arrange:
        $date = new DateTime(2010, 10, 10);
        
        # Act:
        $date->addYears(-1);
        
        # Assert:
        $this->assertEquals(2009, $date->year());
    }

    /**
     * @test
    */
    public function AddYears_ShouldIncreaseYearWhenIsLeapYear() 
    {
        # Arrange:
        $date = new DateTime(2012, 2, 29);
        
        # Act:
        $date->addYears(1);
        
        # Assert:
        $this->assertEquals(1, $date->day());
    }

    /**
     * @test
    */
    public function AddYears_ShouldIncreaseYearToLeapYear() 
    {
        # Arrange:
        $date = new DateTime(2011, 2, 28);
        
        # Act:
        $date->addYears(1);
        
        # Assert:
        $this->assertEquals(28, $date->day());
    }

    /**
     * @test
     */
    public function Compare_ShouldBeZeroWhenEqualAnother() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 1, 1);
        $t2 = new DateTime(2010, 1, 1);

        # Act:
        $result = DateTime::compare($t1, $t2);

        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function Compare_ShouldBeOneWhenGreaterThanAnother() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 1, 2);
        $t2 = new DateTime(2010, 1, 1);

        # Act:
        $result = DateTime::compare($t1, $t2);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function Compare_ShouldBeMinusOneWhenGreaterThanAnother() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 1, 1);
        $t2 = new DateTime(2010, 1, 2);

        # Act:
        $result = DateTime::compare($t1, $t2);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBePositiveWhenObjectIsNotInstanceOfDateTime() 
    {
        # Arrange:
        $t1 = DateTime::now();
    
        # Act:
        $result = $t1->compareTo(null);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBePositiveWhenInstanceIsGreaterThanValue() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 10, 10);
        $t2 = new DateTime(2010, 10, 9);
    
        # Act:
        $result = $t1->compareTo($t2);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBeZeroWhenInstanceIsEqualToValue() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 10, 10);
        $t2 = new DateTime(2010, 10, 10);
    
        # Act:
        $result = $t1->compareTo($t2);
    
        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBeNegativeWhenInstanceIsLessThanValue() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 10, 9);
        $t2 = new DateTime(2010, 10, 10);
    
        # Act:
        $result = $t1->compareTo($t2);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function Date_ShouldGetOnlyDateFromDateTime() 
    {
        # Arrange:
        $date = new DateTime(2010, 10, 10, 23, 59, 59);
    
        # Act:
        $new_date = $date->date();
    
        # Assert:
        $this->assertEquals(0, $new_date->hour());
    }

    /**
     * @test
    */
    public function Day_ShouldGetDayFromDateTime() 
    {
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 1, 1, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(1, $datetime->day());
    }

    /**
     * @test
    */
    public function DayOfWeek_ShouldGetSaturday() 
    {
        # Arrange:
        $date = new DateTime(2010, 1, 2, 23, 59, 59);

        # Act:
        $weekDay = $date->dayOfWeek();
    
        # Assert:
        $this->assertEquals(DayOfWeek::saturday(), $weekDay);
    }

    /**
     * @test
    */
    public function DayOfWeek_ShouldGetSunday() 
    {
        # Arrange:
        $date = new DateTime(2010, 1, 3, 23, 59, 59);

        # Act:
        $weekDay = $date->dayOfWeek();
    
        # Assert:
        $this->assertEquals(DayOfWeek::sunday(), $weekDay);
    }

    /**
     * @test
     */
    public function DayOfYear_ShouldGetFirstDayOfYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 1, 1);

        # Act:
        $day = $date->dayOfYear();

        # Assert:
        $this->assertEquals(1, $day);
    }

    /**
     * @test
     */
    public function DayOfYear_ShouldGetLastDayOfYear() 
    {
        
        # Arrange:
        $date = new DateTime(2010, 12, 31);

        # Act:
        $day = $date->dayOfYear();

        # Assert:
        $this->assertEquals(365, $day);
    }

    /**
     * @test
     */
    public function DayOfYear_ShouldGetLastDayOfYearWhenIsLeapYear() 
    {
        
        # Arrange:
        $date = new DateTime(2004, 12, 31);
    
        # Act:
        $day = $date->dayOfYear();
    
        # Assert:
        $this->assertEquals(366, $day);
    }

    /**
     * @test
     */
    public function DaysInMonth_GetDaysInJanuary() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::daysInMonth(2010, 01);
    
        # Assert:
        $this->assertEquals(31, $result);
    }

    /**
     * @test
     */
    public function DaysInMonth_GetDaysInFebruaryWhenNormalYear() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::daysInMonth(2010, 02);
    
        # Assert:
        $this->assertEquals(28, $result);
    }

    /**
     * @test
     */
    public function DaysInMonth_GetDaysInFebruaryWhenLeapYear() 
    {
        
        # Arrange:
        # Act:
        $result = DateTime::daysInMonth(2012, 02);
    
        # Assert:
        $this->assertEquals(29, $result);
    }

    /**
     * @test
    */
    public function Equals_ShouldBeTrueWhenHaveSameValue() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 11, 11);
        $t2 = new DateTime(2010, 11, 11);
    
        # Act:
        $result = $t1->equals($t2);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
    */
    public function Equals_ShouldBeFalseWhenHaveDifferentValue() 
    {
        # Arrange:
        $t1 = new DateTime(2010, 11, 11);
        $t2 = new DateTime(2010, 11, 12);
    
        # Act:
        $result = $t1->equals($t2);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function FromBinary_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $binary = mktime(11, 11, 11, 1, 2, 2038);
    
        # Act:
        $date = DateTime::fromBinary($binary);
    }

    /**
     * @test
    */
    public function FromBinary_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $binary = mktime(11, 11, 11, 1, 2, 1901);
    
        # Act:
        $date = DateTime::fromBinary($binary);
    }

    /**
     * @test
    */
    public function FromBinary_ShouldDeserializeObjectFromBinary() 
    {
        # Arrange:
        $binary = mktime(11, 11, 11, 1, 2, 1935);

        # Act:
        $date = DateTime::fromBinary($binary);
    
        # Assert:
        $this->assertEquals(1935, $date->year());
    }

    /**
     * @test
    */
    public function GetDateTimeFormats_ShouldGetBasicFormats() 
    {
        # Arrange:
        $date = DateTime::now();
    
        # Act:
        $formats = $date->getDateTimeFormats();
    
        # Assert:
        $this->assertTrue(sizeof($formats) > 0);
    }

    /**
     * @test
    */
    public function GetTypeCode_CanGetTypeCode() 
    {
        # Arrange:
        $type = "\\System\\TypeCode";
        $date = DateTime::now();
    
        # Act:
        $typeCode = $date->getTypeCode();
    
        # Assert:
        $this->assertInstanceOf($type, $typeCode);
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
    public function IsDayLightSavingTime_ShouldBeTrueIfTimezoneHasDaylight() 
    {
        # Arrange:
        $date = new DateTime(2004, 1, 3, 23, 59, 59);
    
        # Act:
        $result = $date->isDaylightSavingTime();
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
    */
    public function IsDaylightSavingTime_ShouldBeFalseWhenKindIsUtc() 
    {
        # Arrange:
        $date = new DateTime(2004, 10, 3, 23, 59, 59);
        $utc = DateTime::specifyKind($date, DateTimeKind::utc());
    
        # Act:
        $result = $utc->isDaylightSavingTime();
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function IsDaylightSavingTime_ShouldBeFalseWhenTimezoneDontHaveDaylight() 
    {
        # Arrange:
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
    */
    public function Kind_ShouldGetUnespecified() 
    {
        # Arrange:
        $date = new DateTime(2010, 1, 1);
    
        # Act:
        $kind = $date->kind();
    
        # Assert:
        $this->assertEquals(DateTimeKind::unespecified(), $kind);
    }

    /**
     * @test
    */
    public function Kind_ShouldGetLocal() 
    {
        # Arrange:
        $date = DateTime::now();
        $local = DateTime::specifyKind($date, DateTimeKind::local());
    
        # Act:
        $kind = $local->kind();
    
        # Assert:
        $this->assertEquals(DateTimeKind::local(), $kind);
    }

    /**
     * @test
    */
    public function Kind_ShouldGetUtc() 
    {
        # Arrange:
        $date = DateTime::now();
        $utc = DateTime::specifyKind($date, DateTimeKind::utc());
    
        # Act:
        $kind = $utc->kind();
    
        # Assert:
        $this->assertEquals(DateTimeKind::utc(), $kind);
    }

    /**
     * @test
    */
    public function MaxValue_GetDateTimeWithMaxValue() 
    {
        # Arrange:
        # Act:
        $date = DateTime::maxValue();
    
        # Assert:
        $this->assertEquals(2037, $date->year());
    }

    /**
     * @test
    */
    public function Millisecond_ShouldGetMillisecondFromDateTime() 
    {
        # Arrange:
        $date = DateTime::maxValue();
    
        # Act:
        $millisecond = $date->millisecond();
    
        # Assert:
        $this->assertEquals(999, $millisecond);
    }

    /**
     * @test
    */
    public function MinValue_GetDateTimeWithMinValue() 
    {
        # Arrange:
        # Act:
        $date = DateTime::minValue();
    
        # Assert:
        $this->assertEquals(1902, $date->year());
    }

    /**
     * @test
    */
    public function Minute_ShouldGetMinuteFromDateTime() 
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
    public function Now_ShouldGetDateTimeWithLocalDate() 
    {
        # Arrange:
        $local = getdate();

        # Act:
        $now = DateTime::now();

        # Assert:
        $this->assertEquals($local["year"], $now->year());
        $this->assertEquals($local["mon"], $now->month());
        $this->assertEquals($local["mday"], $now->day());
        $this->assertEquals($local["hours"], $now->hour());
        $this->assertEquals($local["minutes"], $now->minute());
        $this->assertEquals($local["seconds"], $now->second());
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
    public function Parse_ShouldParseDate() 
    {
        # Arrange:
        $format = "2010-10-10";

        # Act:
        $date = DateTime::parse($format);
    
        # Assert:
        $this->assertEquals(2010, $date->year());
    }

    /**
     * @test
    */
    public function Parse_ShouldParseTime() 
    {
        # Arrange:
        $format = "23:59:59";
    
        # Act:
        $date = DateTime::parse($format);
    
        # Assert:
        $this->assertEquals(23, $date->hour());
    }

    /**
     * @test
     */
    public function Parse_ShouldParseCompleteFormat()
    {
        
        # Arrange:
        $format = "2011-8-12 11:39";
        
        # Act:
        $date = DateTime::parse($format);
        
        # Assert:
        $this->assertEquals(2011, $date->year());
        $this->assertEquals(11, $date->hour());
    }

    /**
     * @test
    */
    public function Second_ShouldGetSecondsFromDateTime() 
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
    public function SpecifyKind_ShouldSpecifyLocalKind() 
    {
        # Arrange:
        $date = DateTime::now();
        $kind = DateTimeKind::local();
    
        # Act:
        $new_date = DateTime::specifyKind($date, $kind);
    
        # Assert:
        $this->assertEquals($new_date->kind(), $kind);
    }

    /**
     * @test
    */
    public function SpecifyKind_ShouldSpecifyUnspecifiedKind() 
    {
        # Arrange:
        $date = DateTime::now();
        $kind = DateTimeKind::unespecified();
    
        # Act:
        $new_date = DateTime::specifyKind($date, $kind);
    
        # Assert:
        $this->assertEquals($new_date->kind(), $kind);
    }

    /**
     * @test
    */
    public function SpecifyKind_ShouldSpecifyUtcKind() 
    {
        # Arrange:
        $date = DateTime::now();
        $kind = DateTimeKind::utc();
    
        # Act:
        $new_date = DateTime::specifyKind($date, $kind);
    
        # Assert:
        $this->assertEquals($new_date->kind(), $kind);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Subtract_ThrowsExceptionWhenDateTimeHasMaxValue() 
    {
        # Arrange:
        $date = DateTime::maxValue();
        $ts = TimeSpan::fromDays(-10);
    
        # Act:
        $date->subtract($ts);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Subtract_ThrowsExceptionWhenDateTimeHasMinValue() 
    {
        # Arrange:
        $date = DateTime::minValue();
        $ts = TimeSpan::fromDays(10);
    
        # Act:
        $date->subtract($ts);
    }    

    /**
     * @test
     */
    public function Subtract_ShouldSubtractTenDays() 
    {
       # Arrange:
       $date = new DateTime(2010, 10, 11);
       $ts = TimeSpan::fromDays(10);
       
       # Act:
       $date->subtract($ts);
       
       # Assert:
       $this->assertEquals(1, $date->day());
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
