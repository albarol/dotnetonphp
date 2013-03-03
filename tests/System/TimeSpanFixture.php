<?php

use \System\TimeSpan as TimeSpan;

/**
 * @group core
*/
class TimeSpanFixture extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException \System\ArgumentException
     * @test
    */
    public function ThrowsExceptionWhenArgumentIsNotInteger() {
        # Arrange:
        $argument = "a";

        # Act:
        new TimeSpan(0, 0, $argument);
    }

    /**
     * @test
    */
    public function ShouldConstructWithNegativeValues() {
        
        # Arrange:
        $seconds = -10;
    
        # Act:
        $timespan = TimeSpan::fromSeconds($seconds);
    
        # Assert:
        $this->assertEquals(-10, $timespan->totalSeconds());
    }

    /**
     * @test
    */
    public function ShouldAddNewTimeSpan() {
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
    public function ShouldMoveOneHourWhenAddNewTimeSpan() {
        
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
    public function ShouldMoveOneMinuteWhenAddNewTimeSpan() {
        
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
    public function ShouldMoveOneSecondsWhenAddNewTimeSpan() {
        
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
    public function ShouldCreateTimeSpanFromDays() {
        
        # Arrange:
        $total_days = 2;
    
        # Act:
        $time = TimeSpan::fromDays($total_days);
    
        # Assert:
        $this->assertEquals(48, $time->totalHours());
    }

    /**
     * @test
    */
    public function ShouldConstructTimeSpanFromHours() {
        
        # Arrange:
        $total_hours = 24;
    
        # Act:
        $timespan = TimeSpan::fromHours($total_hours);
    
        # Assert:
        $this->assertEquals(1440, $timespan->totalMinutes());
    }

    /**
     * @test
    */
    public function ShouldContructuTimeSpanFromMinutes() {
        
        # Arrange:
        $total_minutes = 60;
    
        # Act:
        $timespan = TimeSpan::fromMinutes($total_minutes);
    
        # Assert:
        $this->assertEquals(3600, $timespan->totalSeconds());
    }

    /**
     * @test
    */
    public function ShouldConstructTimeSpanFromSeconds() {
        
        # Arrange:
        $total_seconds = 60;
    
        # Act:
        $timespan = TimeSpan::fromSeconds($total_seconds);
    
        # Assert:
        $this->assertEquals(1, $timespan->totalMinutes());
    }

    /**
     * @test
    */
    public function ShouldContructTimeSpanFromMilliseconds() {
        
        # Arrange:
        $total_milliseconds = 1000;
    
        # Act:
        $timespan = TimeSpan::fromMilliseconds($total_milliseconds);
    
        # Assert:
        $this->assertEquals(1, $timespan->totalSeconds());
    }

    /**
     * @test
    */
    public function ShouldContructTimeSpanFromTicks() {
        
        # Arrange:
        $ticks = TimeSpan::TicksPerDay;
    
        # Act:
        $timespan = TimeSpan::fromTicks($ticks);
    
        # Assert:
        $this->assertEquals(1, $timespan->totalDays());
    }

    /**
     * @test
    */
    public function ShouldNegateTimeSpan() {
        
        # Arrange:
        $timespan = TimeSpan::fromTicks(TimeSpan::TicksPerDay);
    
        # Act:
        $negate_timespan = $timespan->negate(); 
    
        # Assert:
        $this->assertEquals(-1, $negate_timespan->totalDays());
    }

    /**
     * @test
     * @expectedException \System\FormatException
    */
    public function ThrowsExceptionWhenFormatIsIncorrect() {
        
        # Arrange:
        $format = "a";
    
        # Act:
        TimeSpan::parse($format);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function ThrowsExceptionWhenFormatIsNull() {
        
        # Arrange:
        $format = null;
    
        # Act:
        TimeSpan::parse($format);
    }

    /**
     * @test
    */
    public function ShouldParseDayFormat() {
        
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
    public function ShouldParseHourMinuteFormat() {
        
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
    public function ShouldParseHourMinuteSecondFormat() {
        
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
    public function ShouldParseDayTimeFormat() {
        
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
    public function ShouldParseDayHourMinuteSecondMillisecondFormat() {
        
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
    */
    public function ShouldTryParseValidFormat() {
        
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
    public function ShouldTryParseInvalidFormat() {
        
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
    public function ShouldSubtractTimeSpan() {
        
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
    public function ShouldMoveOneHourWhenSubtractTimeSpan() {
        
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
    public function ShouldMoveOneMinuteWhenSubtractTimeSpan() {
        
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
    public function ShouldMoveOneSecondWhenSubtractTimeSpan() {
        
        # Arrange:
        $timespan = TimeSpan::fromSeconds(2);
    
        # Act:
        $newTimespan = $timespan->subtract(TimeSpan::fromSeconds(1));
    
        # Assert:
        $this->assertEquals(1, $newTimespan->totalSeconds());
    }

    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function ThrowsExceptionWhenTryRemoveLessThanMinValue() {
        
        # Arrange:
        $timespan = TimeSpan::minValue();
    
        # Act:
        $timespan->subtract(TimeSpan::fromSeconds(1));
    }

    /**
     * @test
    */
    public function ShouldTrueWhenCompareTwoTimeSpan() {
        
        # Arrange:
        $first = TimeSpan::fromSeconds(10);
        $second = TimeSpan::fromSeconds(10);
    
        # Act:
        $result = $first->equals($second);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
    */
    public function ShouldFalseWhenCompareTwoTimeSpan() {
        
        # Arrange:
        $first = TimeSpan::fromSeconds(10);
        $second = TimeSpan::fromSeconds(5);
    
        # Act:
        $result = $first->equals($second);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function ThrowsExceptionWhenCompareInvalidValue() {
        
        # Arrange:
        $value = 1;
        $timespan = TimeSpan::fromSeconds(10);
    
        # Act:
        $timespan->compareTo($value);
    }

    /**
     * @test
    */
    public function ShouldCompareToGreaterSpan() {
        
        # Arrange:
        $first = TimeSpan::fromSeconds(10);
        $second = TimeSpan::fromSeconds(8);
    
        # Act:
        $result = $first->compareTo($second);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function ShouldCompareToLesserTimeSpan() {
        
        # Arrange:
        $first = TimeSpan::fromSeconds(8);
        $second = TimeSpan::fromSeconds(10);
    
        # Act:
        $result = $first->compareTo($second);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function ShouldCompareToEqualTimeSpan() {
        
        # Arrange:
        $first = TimeSpan::fromSeconds(10);
        $second = TimeSpan::fromSeconds(10);
    
        # Act:
        $result = $first->compareTo($second);
    
        # Assert:
        $this->assertEquals(0, $result);
    }
}
