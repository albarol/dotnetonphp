<?php

use \System\TimeSpan as TimeSpan;

/**
 * @group core
*/
class TimeSpanFixture extends PHPUnit_Framework_TestCase {

    public function test_Add_ThrowsExceptionWhenArgumentIsNotInteger() {
        $this->setExpectedException("\\System\\ArgumentException");
        new TimeSpan(0, 0, "a");
    }

    public function test_Add_CanAddTimeSpan() {
        $time = new TimeSpan(0, 0, 20);
        $time->add(new TimeSpan(1, 24, 30));
        $this->assertEquals(50, $time->minutes());
    }

    public function test_FromDays_CanCreateFromDays() {
        $time = TimeSpan::fromDays(1);
        $this->assertEquals(1, $time->days());
    }


    public function testCanConstructTimeSpanFromHours() {
        $time = TimeSpan::fromHours(24);
        $this->assertEquals(1, $time->days());
        $this->assertEquals(1, $time->totalDays());
        $this->assertEquals(24, $time->totalHours());
        $this->assertEquals(1440, $time->totalMinutes());
        $this->assertEquals(86400, $time->totalSeconds());
        $this->assertEquals(86400000, $time->totalMilliseconds());
    }

    public function testCanConstructTimeSpanFromMilliseconds() {
        $time = TimeSpan::fromMilliseconds(86400000);
        $this->assertEquals(1, $time->days());
        $this->assertEquals(1, $time->totalDays());
        $this->assertEquals(24, $time->totalHours());
        $this->assertEquals(1440, $time->totalMinutes());
        $this->assertEquals(86400, $time->totalSeconds());
        $this->assertEquals(86400000, $time->totalMilliseconds());
    }

    public function testCanConstructTimeSpanFromMinutes() {
        $time = TimeSpan::fromMinutes(1440);
        $this->assertEquals(1, $time->days());
        $this->assertEquals(1, $time->totalDays());
        $this->assertEquals(24, $time->totalHours());
        $this->assertEquals(1440, $time->totalMinutes());
        $this->assertEquals(86400, $time->totalSeconds());
        $this->assertEquals(86400000, $time->totalMilliseconds());
    }

    public function testCanConstructTimeSpanFromSeconds() {
        $time = TimeSpan::fromSeconds(86400);
        $this->assertEquals(1, $time->days());
        $this->assertEquals(1, $time->totalDays());
        $this->assertEquals(24, $time->totalHours());
        $this->assertEquals(1440, $time->totalMinutes());
        $this->assertEquals(86400, $time->totalSeconds());
        $this->assertEquals(86400000, $time->totalMilliseconds());
    }

    public function testCanConstructTimeSpanFromTicks() {
        $time = TimeSpan::fromTicks(TimeSpan::TicksPerDay);
        $this->assertEquals(1, $time->totalDays());
        $this->assertEquals(24, $time->totalHours());
        $this->assertEquals(1440, $time->totalMinutes());
        $this->assertEquals(86400, $time->totalSeconds());
        $this->assertEquals(86400000, $time->totalMilliseconds());
        $this->assertEquals(TimeSpan::TicksPerDay, $time->ticks());
    }

    public function testCanNegateTimeSpanObject() {
        $time = TimeSpan::fromSeconds(86400);
        $this->assertEquals(1, $time->totalDays());
        $this->assertEquals(24, $time->totalHours());
        $this->assertEquals(1440, $time->totalMinutes());
        $this->assertEquals(86400, $time->totalSeconds());
        $this->assertEquals(86400000, $time->totalMilliseconds());

        $negateTime = $time->negate();
        $this->assertEquals(-1, $negateTime->totalDays());
        $this->assertEquals(-24, $negateTime->totalHours());
        $this->assertEquals(-1440, $negateTime->totalMinutes());
        $this->assertEquals(-86400, $negateTime->totalSeconds());
        $this->assertEquals(-86400000, $negateTime->totalMilliseconds());

        $newTime = $negateTime->negate();
        $this->assertEquals(1, $newTime->days());
        $this->assertEquals(1, $newTime->totalDays());
        $this->assertEquals(24, $newTime->totalHours());
        $this->assertEquals(1440, $newTime->totalMinutes());
        $this->assertEquals(86400, $newTime->totalSeconds());
        $this->assertEquals(86400000, $newTime->totalMilliseconds());
    }

    public function testCantParseTimeSpanBecauseIncorretFormat() {
        $this->setExpectedException("\\System\\FormatException");
        $formats = array("a");
        $time = TimeSpan::parse($formats[0]);
    }

    public function testCantParseTimeSpanBecauseFormatIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $time = TimeSpan::parse(null);
    }

    public function testCanTryParse() {
        $result = new TimeSpan();
        $this->assertEquals(true, TimeSpan::tryParse("23:00", $result));
        $this->assertNotNull($result);
        $this->assertEquals(true, ($result instanceof TimeSpan));
    }

    public function testCanParseTimeSpan() {
        $formats = array("21", "22:50", "22:50:50", "21.22:50:50", "21:22:50:50.1000");

        $time = TimeSpan::parse($formats[0]);
        $this->assertEquals(21, $time->days());
        
        $time = TimeSpan::parse($formats[1]);
        $this->assertEquals(22, $time->hours());
        $this->assertEquals(50, $time->minutes());

        $time = TimeSpan::parse($formats[2]);
        $this->assertEquals(22, $time->hours());
        $this->assertEquals(50, $time->minutes());
        $this->assertEquals(50, $time->seconds());

        $time = TimeSpan::parse($formats[3]);
        $this->assertEquals(21, $time->days());
        $this->assertEquals(22, $time->hours());
        $this->assertEquals(50, $time->minutes());
        $this->assertEquals(50, $time->seconds());

        $time = TimeSpan::parse($formats[4]);
        $this->assertEquals(21, $time->days());
        $this->assertEquals(22, $time->hours());
        $this->assertEquals(50, $time->minutes());
        $this->assertEquals(51, $time->seconds());
    }

    public function testCanSubtractTimeSpan() {
        $time = new TimeSpan(0, 0, 120);
        $this->assertEquals(2, $time->totalHours());

        $newTime = $time->subtract(new TimeSpan(0, 0, 60));
        $this->assertEquals(1, $newTime->totalHours());

        $newHour = $time->subtract(new TimeSpan(0, 1));
        $this->assertEquals(1, $newHour->totalHours());
    }

    public function testCantSubtractTimeSpanBecauseIsLessThanMinValue() {
        $this->setExpectedException("\\System\\OverflowException");
        $time = TimeSpan::minValue();
        $time->subtract(new TimeSpan(1));
    }

    public function testCanConstructTimeSpanWithNegativeValues() {
        $time = new TimeSpan(-1);
        $this->assertEquals(-1, $time->days());
        $time->add(new TimeSpan(1));
        $this->assertEquals(0, $time->days());
    }

    public function testCanCalculateTimeSpanWithRemoveAndAddTimeSpan() {
        $time = new TimeSpan(1, 23);
        $this->assertEquals(1, $time->days());
        $this->assertEquals(23, $time->hours());
        $time->add(new TimeSpan(0, -24));
        $this->assertEquals(0, $time->days());
        $this->assertEquals(23, $time->hours());

        $time = new TimeSpan(0, 0, 0, 23, 0);
        $time->add(new TimeSpan(0, 0, 0, -22, 0));
        $this->assertEquals(0, $time->days());
        $this->assertEquals(0, $time->hours());
        $this->assertEquals(0, $time->minutes());
        $this->assertEquals(1, $time->seconds());
    }

    public function testVerifyIfValuesAreEqualTimeSpan() {
        $time = new TimeSpan(1);
        $time2 = new TimeSpan(1);
        $this->assertEquals(true, $time->equals($time2));
        $this->assertEquals(false, $time->equals(0));
        $this->assertEquals(false, $time->equals(new TimeSpan()));
    }

    public function testCantCompareTimeSpan() {
        $this->setExpectedException("\\System\\ArgumentException");
        $time = new TimeSpan(1);
        $time->compareTo(1);
    }

    public function testTimeSpanIsGreaterThanOtherTimeSpan() {
        $time = new TimeSpan(2);
        $time2 = new TimeSpan(1);
        $this->assertEquals(1, $time->compareTo($time2));
    }

    public function testTimeSpanEqualOtherTimeSpan() {
        $time = new TimeSpan(1);
        $time2 = new TimeSpan(1);
        $this->assertEquals(0, $time->compareTo($time2));
    }

    public function testTimeSpanIsLessThanOtherTimeSpan() {
        $time = new TimeSpan(1);
        $time2 = new TimeSpan(2);
        $this->assertEquals(-1, $time->compareTo($time2));
    }
}
