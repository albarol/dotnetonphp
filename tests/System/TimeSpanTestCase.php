<?php

use \System\TimeSpan as TimeSpan;

/**
 * @group core
*/
class TimeSpanTestCase extends PHPUnit_Framework_TestCase 
{
    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Construct_ThrowsExceptionWhenArgumentIsGreaterThanMaxValue() 
    {
        # Arrange:
        $days = 99999999999999999;

        # Act:
        new TimeSpan($days);
    }

    /**
     * @test
    */
    public function Construct_ShouldConstructWithPositiveValues() 
    {
        # Arrange:
        $seconds = 10;
    
        # Act:
        $timespan = new TimeSpan(0, 0, 0, $seconds);
    
        # Assert:
        $this->assertEquals(10, $timespan->totalSeconds());
    }

    /**
     * @test
    */
    public function Construct_ShouldConstructWithNegativeValues() 
    {
        
        # Arrange:
        $seconds = -10;
    
        # Act:
        $timespan = new TimeSpan(0, 0, 0, $seconds);
    
        # Assert:
        $this->assertEquals(-10, $timespan->totalSeconds());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Add_ThrowsExceptionWhenResultIsGreaterThanMaxValue() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(TimeSpan::MaxValue);
    
        # Act:
        $timespan->add(TimeSpan::fromMilliseconds(1));
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Add_ThrowsExceptionWhenResultIsLessThanMinValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(TimeSpan::MinValue);
    
        # Act:
        $timespan->add(TimeSpan::fromMilliseconds(-1));
    }


    /**
     * @test
    */
    public function Add_ShouldAddNewTimeSpan() 
    {
        # Arrange:
        $time = new TimeSpan(0, 0, 20);

        # Act:
        $time->add(new TimeSpan(1, 24, 30));
        
        # Assert:
        $this->assertEquals(50, $time->minutes());
    }

    /**
     * @test
    */
    public function Add_ShouldMoveOneHourWhenAddNewTimeSpan() 
    {
        
        # Arrange:
        $minutes = 24;
        $timespan = TimeSpan::fromMinutes(36);
    
        # Act:
        $timespan->add(TimeSpan::fromMinutes($minutes));
    
        # Assert:
        $this->assertEquals(1, $timespan->totalHours());
    }

    /**
     * @test
    */
    public function Add_ShouldMoveOneMinuteWhenAddNewTimeSpan() 
    {
        
        # Arrange:
        $seconds = 24;
        $timespan = TimeSpan::fromSeconds(36);
    
        # Act:
        $timespan->add(TimeSpan::fromSeconds($seconds));
    
        # Assert:
        $this->assertEquals(1, $timespan->totalMinutes());
    }

    /**
     * @test
    */
    public function Add_ShouldMoveOneSecondsWhenAddNewTimeSpan() 
    {
        
        # Arrange:
        $milliseconds = 999;
        $timespan = TimeSpan::fromMilliseconds(1);
    
        # Act:
        $timespan->add(TimeSpan::fromMilliseconds($milliseconds));

    
        # Assert:
        $this->assertEquals(1, $timespan->totalSeconds());
    }

    /**
     * @test
    */
    public function Compare_ShouldBeNegativeWhenIsLessThanOther() 
    {
        # Arrange:
        $t1 = TimeSpan::fromSeconds(0);
        $t2 = TimeSpan::fromSeconds(1);
  
        # Act:
        $result = TimeSpan::compare($t1, $t2);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function Compare_ShouldBeZeroWhenEqualOther() 
    {
        # Arrange:
        $t1 = TimeSpan::fromSeconds(0);
        $t2 = TimeSpan::fromSeconds(0);
    
        # Act:
        $result = TimeSpan::compare($t1, $t2);
    
        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
    */
    public function Compare_ShouldBePositiveWhenGreaterThanOther() 
    {
        # Arrange:
        $t1 = TimeSpan::fromSeconds(1);
        $t2 = TimeSpan::fromSeconds(0);
    
        # Act:
        $result = TimeSpan::compare($t1, $t2);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function CompareTo_ThrowsExceptionWhenCompareInvalidValue() 
    {
        
        # Arrange:
        $value = 1;
        $timespan = TimeSpan::fromSeconds(10);
    
        # Act:
        $timespan->compareTo($value);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBePositiveWhenGreaterThanOther() 
    {
        
        # Arrange:
        $t1 = TimeSpan::fromSeconds(1);
        $t2 = TimeSpan::fromSeconds(0);
    
        # Act:
        $result = $t1->compareTo($t2);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBeNegativeWhenLessThanOther() 
    {
        
        # Arrange:
        $t1 = TimeSpan::fromSeconds(0);
        $t2 = TimeSpan::fromSeconds(1);
    
        # Act:
        $result = $t1->compareTo($t2);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBeZeroWhenEqualOther() 
    {
        
        # Arrange:
        $t1 = TimeSpan::fromSeconds(0);
        $t2 = TimeSpan::fromSeconds(0);
    
        # Act:
        $result = $t1->compareTo($t2);
    
        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldBePositiveWhenCompareWithNull() 
    {
        # Arrange:
        $t1 = TimeSpan::fromSeconds(0);
    
        # Act:
        $result = $t1->compareTo(null);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function Days_ShouldGetWholeDay() 
    {
        # Arrange:
        $t1 = TimeSpan::fromDays(1);
    
        # Act:
        $result = $t1->days();
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function Days_ShouldGetPartOfDay() 
    {
        # Arrange:
        $t1 = TimeSpan::fromHours(28);
    
        # Act:
        $result = $t1->days();
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Duration_ThrowsExceptionWhenTimeSpanIsMinValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(TimeSpan::MinValue);
    
        # Act:
        $duration = $timespan->duration();
    }


    /**
     * @test
    */
    public function Duration_GetAbsoluteValueFromTimespanWhenValueIsNegative() 
    {
        # Arrange:
        $timespan = TimeSpan::fromHours(-1);
    
        # Act:
        $duration = $timespan->duration();
    
        # Assert:
        $this->assertEquals(1, $duration->hours());
    }

    /**
     * @test
    */
    public function Duration_GetAbsoluteValueFromTimespanWhenValueIsPositive() 
    {
        # Arrange:
        $timespan = TimeSpan::fromHours(1);
    
        # Act:
        $duration = $timespan->duration();
    
        # Assert:
        $this->assertEquals(1, $duration->hours());
    }

    /**
     * @test
    */
    public function Equals_ShouldBeTrueWhenObjectIsEqual() 
    {
        # Arrange:
        $t1 = TimeSpan::fromSeconds(1);
        $t2 = TimeSpan::fromSeconds(1);
    
        # Act:
        $result = $t1->equals($t2);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
    */
    public function Equals_ShouldBeFalseWhenObjectIsNotEqual() 
    {
        # Arrange:
        $t1 = TimeSpan::fromSeconds(1);
        $t2 = TimeSpan::fromSeconds(2);
    
        # Act:
        $result = $t1->equals($t2);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function FromDays_ThrowsExceptionWhenValueIsNaN() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromDays(NAN);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromDays_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromDays(99999999);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromDays_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromDays(-99999999);
    }

    /**
     * @test
    */
    public function FromDays_ShouldCreateTimeSpanFromDays() 
    {
        
        # Arrange:
        $days = 2;
    
        # Act:
        $time = TimeSpan::fromDays($days);
    
        # Assert:
        $this->assertEquals(48, $time->totalHours());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function FromHours_ThrowsExceptionWhenValueIsNaN() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromHours(NAN);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromHours_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $hours = TimeSpan::MaxValue;
    
        # Act:
        TimeSpan::fromHours($hours);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromHours_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $hours = TimeSpan::MinValue;
    
        # Act:
        TimeSpan::fromHours($hours);
    }

    /**
     * @test
    */
    public function FromHours_ShouldConstructTimeSpanFromHours() 
    {
        # Arrange:
        $total_hours = 24;
    
        # Act:
        $timespan = TimeSpan::fromHours($total_hours);
    
        # Assert:
        $this->assertEquals(1440, $timespan->totalMinutes());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function FromMilliseconds_ThrowsExceptionWhenValueIsNaN() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromMilliseconds(NAN);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromMilliseconds_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $milliseconds = TimeSpan::MaxValue + 1;
    
        # Act:
        TimeSpan::fromMilliseconds($milliseconds);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromMilliseconds_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $milliseconds = TimeSpan::MinValue - 1;
    
        # Act:
        TimeSpan::fromMilliseconds($milliseconds);
    }

    /**
     * @test
    */
    public function FromMilliseconds_ShouldContructTimeSpanFromMilliseconds() 
    {
        
        # Arrange:
        $total_milliseconds = 1000;
    
        # Act:
        $timespan = TimeSpan::fromMilliseconds($total_milliseconds);
    
        # Assert:
        $this->assertEquals(1, $timespan->totalSeconds());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function FromMinutes_ThrowsExceptionWhenValueIsNaN() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromMinutes(NAN);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromMinutes_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $minutes = TimeSpan::MaxValue;
    
        # Act:
        TimeSpan::fromMinutes($minutes);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromMinutes_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $minutes = TimeSpan::MinValue;
    
        # Act:
        TimeSpan::fromMinutes($minutes);
    }

    /**
     * @test
    */
    public function FromMinutes_ShouldContructTimeSpanFromMinutes() 
    {
        
        # Arrange:
        $total_minutes = 60;
    
        # Act:
        $timespan = TimeSpan::fromMinutes($total_minutes);
    
        # Assert:
        $this->assertEquals(3600, $timespan->totalSeconds());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function FromSeconds_ThrowsExceptionWhenValueIsNaN() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromSeconds(NAN);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromSeconds_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $seconds = TimeSpan::MaxValue;
    
        # Act:
        TimeSpan::fromSeconds($seconds);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromSeconds_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $seconds = TimeSpan::MinValue;
    
        # Act:
        TimeSpan::fromSeconds($seconds);
    }

    /**
     * @test
    */
    public function FromSeconds_ShouldConstructTimeSpanFromSeconds() 
    {
        
        # Arrange:
        $total_seconds = 60;
    
        # Act:
        $timespan = TimeSpan::fromSeconds($total_seconds);
    
        # Assert:
        $this->assertEquals(1, $timespan->totalMinutes());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function FromTicks_ThrowsExceptionWhenValueIsNaN() 
    {
        # Arrange:
        # Act:
        TimeSpan::fromTicks(NAN);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromTicks_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $ticks = TimeSpan::MaxValue*TimeSpan::TicksPerSecond;
    
        # Act:
        TimeSpan::fromTicks($ticks);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function FromTicks_ThrowsExceptionWhenValueIsLessThanMinValue() 
    {
        # Arrange:
        $ticks = TimeSpan::MinValue*TimeSpan::TicksPerSecond;
    
        # Act:
        TimeSpan::fromTicks($ticks);
    }

    /**
     * @test
    */
    public function FromTicks_ShouldContructTimeSpanFromTicks() 
    {
        
        # Arrange:
        $ticks = TimeSpan::TicksPerDay;
    
        # Act:
        $timespan = TimeSpan::fromTicks($ticks);
    
        # Assert:
        $this->assertEquals(1, $timespan->totalDays());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Negate_ThrowsExceptionWhenValusIsLessThanMinValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(TimeSpan::MinValue);
    
        # Act:
        $timespan->negate();
    }

    /**
     * @test
    */
    public function Negate_ShouldNegateTimeSpan() 
    {
        
        # Arrange:
        $timespan = TimeSpan::fromTicks(TimeSpan::TicksPerDay);
    
        # Act:
        $negate_timespan = $timespan->negate(); 
    
        # Assert:
        $this->assertEquals(-1, $negate_timespan->totalDays());
    }

    /**
     * @test
    */
    public function Negate_ShouldNegateArbitraryValue() 
    {
        # Arrange:
        $timespan = new TimeSpan(21, 10, 21, 0);
    
        # Act:
        $negated = $timespan->negate();
    
        # Assert:
        $this->assertEquals(-21, $negated->days());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Parse_ThrowsExceptionWhenParameterIsNull() 
    {
        # Arrange:
        # Act:
        TimeSpan::parse(null);
    }

    /**
     * @test
     * @expectedException \System\FormatException
    */
    public function Parse_ThrowsExceptionWhenFormatIsIncorrect() 
    {
        
        # Arrange:
        $format = "a";
    
        # Act:
        TimeSpan::parse($format);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Parse_ThrowsExceptionWhenValueIsGreaterThanMaxValue() 
    {
        # Arrange:
        $format = "999999999999";
    
        # Act:
        TimeSpan::parse($format);
    }


    /**
     * @test
    */
    public function Parse_ShouldParseDayFormat() 
    {
        
        # Arrange:
        $format = "21";
    
        # Act:
        $timespan = TimeSpan::parse($format);
    
        # Assert:
        $this->assertEquals(21, $timespan->totalDays());
    }

    /**
     * @test
    */
    public function Parse_ShouldParseHourMinuteFormat() 
    {
        
        # Arrange:
        $format = "22:50";
    
        # Act:
        $timespan = TimeSpan::parse($format);
    
        # Assert:
        $this->assertEquals(22, $timespan->hours());
        $this->assertEquals(50, $timespan->minutes());
    }

    /**
     * @test
    */
    public function Parse_ShouldParseHourMinuteSecondFormat() 
    {
        
        # Arrange:
        $format = "22:59:59";
    
        # Act:
        $timespan = TimeSpan::parse($format);
    
        # Assert:
        $this->assertEquals(22, $timespan->hours());
        $this->assertEquals(59, $timespan->minutes());
        $this->assertEquals(59, $timespan->seconds());
    }

    /**
     * @test
    */
    public function Parse_ShouldParseDayTimeFormat() 
    {
        
        # Arrange:
        $format = "10.22:59:59";
    
        # Act:
        $timespan = TimeSpan::parse($format);
    
        # Assert:
        $this->assertEquals(10, $timespan->days());
        $this->assertEquals(22, $timespan->hours());
        $this->assertEquals(59, $timespan->minutes());
        $this->assertEquals(59, $timespan->seconds());
    }

    /**
     * @test
    */
    public function Parse_ShouldParseDayHourMinuteSecondMillisecondFormat() 
    {
        
        # Arrange:
        $format = "21.22:50:50.999";
    
        # Act:
        $timespan = TimeSpan::parse($format);
    
        # Assert:
        $this->assertEquals(21, $timespan->days());
        $this->assertEquals(22, $timespan->hours());
        $this->assertEquals(50, $timespan->minutes());
        $this->assertEquals(50, $timespan->seconds());
        $this->assertEquals(999, $timespan->milliseconds());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Subtract_ThrowsExceptionWhenTryRemoveLessThanMinValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(TimeSpan::MinValue);
    
        # Act:
        $timespan->subtract(TimeSpan::fromSeconds(1));
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Subtract_ThrowsExceptionWhenTryRemoveGreaterThanMaxValue() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMilliseconds(TimeSpan::MaxValue);
    
        # Act:
        $timespan->subtract(TimeSpan::fromSeconds(-1));
    }

    /**
     * @test
    */
    public function Subtract_ShouldSubtractTimeSpan() 
    {
        # Arrange:
        $timespan = TimeSpan::fromSeconds(10);
    
        # Act:
        $newTimespan = $timespan->subtract(TimeSpan::fromSeconds(5));
    
        # Assert:
        $this->assertEquals(5, $newTimespan->totalSeconds());
    }

    /**
     * @test
    */
    public function Subtract_ShouldMoveOneHourWhenSubtractTimeSpan() 
    {
        # Arrange:
        $timespan = TimeSpan::fromHours(2);
    
        # Act:
        $newTimespan = $timespan->subtract(TimeSpan::fromHours(1));
    
        # Assert:
        $this->assertEquals(1, $newTimespan->totalHours());
    }

    /**
     * @test
    */
    public function Subtract_ShouldMoveOneMinuteWhenSubtractTimeSpan() 
    {
        # Arrange:
        $timespan = TimeSpan::fromMinutes(2);
    
        # Act:
        $newTimespan = $timespan->subtract(TimeSpan::fromMinutes(1));
    
        # Assert:
        $this->assertEquals(1, $newTimespan->totalMinutes());
    }

    /**
     * @test
    */
    public function Subtract_ShouldMoveOneSecondWhenSubtractTimeSpan() 
    {
        # Arrange:
        $timespan = TimeSpan::fromSeconds(2);
    
        # Act:
        $newTimespan = $timespan->subtract(TimeSpan::fromSeconds(1));
    
        # Assert:
        $this->assertEquals(1, $newTimespan->totalSeconds());
    }

    /**
     * @test
    */
    public function TryParse_ShouldTryParseValidFormat() 
    {
        # Arrange:
        $format = "22:50";
    
        # Act:
        $obj = TimeSpan::tryParse($format);
    
        # Assert:
        $this->assertTrue($obj['result']);
        $this->assertEquals(22, $obj['object']->hours());
    }

    /**
     * @test
    */
    public function TryParse_ShouldTryParseInvalidFormat() 
    {
        
        # Arrange:
        $format = "dotnetonphp";
    
        # Act:
        $obj = TimeSpan::tryParse($format);
    
        # Assert:
        $this->assertFalse($obj['result']);
        $this->assertNull($obj['object']);
    }

    /**
     * @test
    */
    public function ToString_ShouldGetTimeSpanStringFormat() 
    {
        # Arrange:
        $timespan = new TimeSpan(21, 12, 3, 9, 8);
    
        # Act:
        $result = $timespan->toString();
    
        # Assert:
        $this->assertEquals("21.12:03:09.8000000", $result);
    }

    /**
     * @test
    */
    public function ToString_ShouldGetTimeSpanStringFormatNegative() 
    {
        # Arrange:
        $timespan = new TimeSpan(21, 12, 3, 9, 8);
    
        # Act:
        $result = $timespan->negate()->toString();
    
        # Assert:
        $this->assertEquals("-21.12:03:09.8000000", $result);
    }
}
