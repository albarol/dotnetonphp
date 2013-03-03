<?php

use \System\DateTime as DateTime;
use \System\TimeSpan as TimeSpan;
use \System\DayOfWeek as DayOfWeek;
use \System\DateTimeKind as DateTimeKind;

/**
 * @group core
*/
class DateAndTimeFixture extends PHPUnit_Framework_TestCase {

    
    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function ThrowsExceptionWhenInputInvalidDay() {
        
        # Arrange:
        # Act:
        new DateTime(2010, 02, 31);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function ThrowsExceptionWhenInputInvalidMonth() {
        
        # Arrange:
        # Act:
        new DateTime(2010, 13, 05);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function ThrowsExceptionWhenInputInvalidYear() {
        
        # Arrange:
        # Act:
        new DateTime(9999, 02, 05);
    }

    /**
     * @test
    */
    public function ShouldCreateDateTimeWithoutTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01);
    
        # Assert:
        $this->assertEquals(2010, $datetime->year());
    }

    /**
     * @test
    */
    public function ShouldCreateDateTimeWithTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(23, $datetime->hours());
    }


    /**
     * @test
    */
    public function ShouldGetDayFromDateTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(01, $datetime->day());
    }

    /**
     * @test
    */
    public function ShouldGetMonthFromDateTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(01, $datetime->month());
    }

    /**
     * @test
    */
    public function ShouldGetYearFromDateTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(2010, $datetime->year());
    }

    /**
     * @test
    */
    public function ShouldGetHourFromDateTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(23, $datetime->hours());
    }

    /**
     * @test
    */
    public function ShouldGetMinuteFromDateTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(59, $datetime->minutes());
    }

    /**
     * @test
    */
    public function ShouldGetSecondsFromDateTime() {
        
        # Arrange:
        # Act:
        $datetime = new DateTime(2010, 01, 01, 23, 59, 59);
    
        # Assert:
        $this->assertEquals(59, $datetime->seconds());
    }

    /**
     * @test
    */
    public function ShouldIncreaseOneDayWhenAddTimeSpan() {
        
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
    public function ShouldIncreaseOneHourWhenAddTimeSpan() {
        
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
    public function ShouldDecreaseOneDayWhenAddNegativeTimeSpan() {
        
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
    public function ThrowsExceptionWhenAddGreaterThanMaxValue() {
        
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
    public function ThrowsExceptionWhenAddLesserThanMinValue() {
        
        # Arrange:
        # Act:
        $date = new DateTime(1902, 01, 01);
    
        # Assert:
        $date->addDays(-1);
    }

    /**
     * @test
    */
    public function ShouldAddOneDay() {
        
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
    public function ShouldAddOneDayInLastDayOfMonth() {
        
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
    public function ShouldAddOneDayInLastDayOfYear() {
        
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
    public function ShouldRemoveOneDay() {
        
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
    public function ShouldRemoveOneDayInFirstDayOfMonth() {
        
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
    public function ShouldAddRemoveDayInLastDayOfYear() {
        
        # Arrange:
        $date = new DateTime(2010, 1, 1);
    
        # Act:
        $date->addDays(-1);
    
        # Assert:
        $this->assertEquals(2009, $date->year());
        $this->assertEquals(12, $date->month());
        $this->assertEquals(31, $date->day());
    }

    // public function test_AddHours_CanAddHours() {
    //     $date = new DateTime(2011, 1, 1);
    //     $this->assertEquals(0, $date->hours());
    //     $date->addHours(11);
    //     $this->assertEquals(11, $date->hours());
    // }

    // public function test_AddHours_CanAddHourWhenLastHourOfDay(){
    //     $date = new DateTime(2011, 1, 1, 23);
    //     $this->assertEquals(23, $date->hours());
    //     $this->assertEquals(1, $date->day());

    //     $date->addHours(2);
    //     $this->assertEquals(1, $date->hours());
    //     $this->assertEquals(2, $date->day());
    // }

    // public function test_AddHours_CanAdd24Hours() {
    //     $date = new DateTime(2011, 1, 1);
    //     $date->addHours(24);
    //     $this->assertEquals(2, $date->day());
    //     $this->assertEquals(0, $date->hours());
    // }

    // public function test_AddHours_CanRemoveHour()  {
    //     $date = new DateTime(2011, 1, 1, 23);
    //     $date->addHours(-23);
    //     $this->assertEquals(1, $date->day());
    //     $this->assertEquals(0, $date->hours());
    // }

    // public function test_AddHours_CanRemoveHourWhenFirstHourOfDay() {
    //     $date = new DateTime(2011, 1, 1);
    //     $date->addHours(-1);
    //     $this->assertEquals(31, $date->day());
    //     $this->assertEquals(23, $date->hours());
    // }

    // public function test_AddHours_CanRemove24Hours() {
    //     $date = new DateTime(2011, 1, 2);
    //     $date->addHours(-24);
    //     $this->assertEquals(1, $date->day());
    //     $this->assertEquals(0, $date->hours());
    // }

    // public function test_AddMinutes_CanAddMinutes() {
    //     $date = new DateTime(2011, 01, 01, 23, 59);
    //     $date->addMinutes(1);
    //     $this->assertEquals(2, $date->day());
    //     $this->assertEquals(0, $date->hours());
    // }

    // public function test_AddMinutes_CanAdd60Minutes() {
    //     $date = new DateTime(2011, 01, 01);
    //     $date->addMinutes(60);
    //     $this->assertEquals(1, $date->hours());
    // }

    // public function test_AddMinutes_CanRemoveMinutes() {
    //     $date = new DateTime(2011, 01, 02);
    //     $date->addMinutes(-1);
    //     $this->assertEquals(1, $date->day());
    //     $this->assertEquals(23, $date->hours());
    // }

    // public function test_AddMinutes_CanRemove60Minutes() {
    //     $date = new DateTime(2011, 01, 02, 23, 59, 59);
    //     $date->addMinutes(-60);
    //     $this->assertEquals(2, $date->day());
    //     $this->assertEquals(22, $date->hours());
    // }

    // public function test_AddMonth_CanAddMonth() {
    //     $date = new DateTime(2010, 07, 19);
    //     $date->addMonths(1);
    //     $this->assertEquals($date->month(), 8);
    // }

    // public function test_AddMonth_CanAdd12Months() {
    //     $date = new DateTime(2010, 07, 19);
    //     $date->addMonths(12);
    //     $this->assertEquals($date->month(), 7);
    //     $this->assertEquals($date->year(), 2011);
    // }

    // public function test_AddMonth_CanAddOneMonthWithDifferentQuantityOfDays() {
    //     $date = new DateTime(2010, 01, 31);
    //     $date->addMonths(1);
    //     $this->assertEquals(3, $date->month());
    //     $this->assertEquals(3, $date->day());
    // }
    
    // public function test_AddMonth_RemoveMonth() {
    //     $date = new DateTime(2010, 8, 19);
    //     $date->addMonths(-1);
    //     $this->assertEquals(7, $date->month());
    // }

    // public function test_AddMonth_CanRemove12Months() {
    //     $date = new DateTime(2010, 07, 19);
    //     $date->addMonths(-12);
    //     $this->assertEquals(7, $date->month());
    //     $this->assertEquals(2009, $date->year());
    // }

    // public function test_AddMonth_CanRemoveOneMonthWithDifferentQuantityOfDays() {
    //     $date = new DateTime(2010, 3, 31);
    //     $date->addMonths(-1);
    //     $this->assertEquals(3, $date->month());
    //     $this->assertEquals(3, $date->day());
    // }

    // public function test_AddSeconds_CanAddSeconds() {
    //     $date = new DateTime(2010, 3, 31, 23);
    //     $date->addSeconds(3600);
    //     $this->assertEquals(4, $date->month());
    //     $this->assertEquals(0, $date->hours());
    // }

    // public function test_AddSeconds_CanRemoveSeconds() {
    //     $date = new DateTime(2010, 3, 31, 23);
    //     $date->addSeconds(-3600);
    //     $this->assertEquals(22, $date->hours());
    // }

    // public function test_AddSeconds_CanAddYear() {
    //     $date = new DateTime(2010, 3, 31);
    //     $date->addYears(1);
    //     $this->assertEquals(2011, $date->year());
    // }

    // public function test_AddYears_CanAddWhenLeapYear() {
    //     $date = new DateTime(2004, 2, 29);
    //     $date->addYears(1);
    //     $this->assertEquals(1, $date->day());
    //     $this->assertEquals(3, $date->month());
    //     $this->assertEquals(2005, $date->year());
    // }

    // public function test_AddYears_CanRemoveYear() {
    //     $date = new DateTime(2010, 3, 31);
    //     $date->addYears(-1);
    //     $this->assertEquals(2009, $date->year());
    // }

    // *
    //  * @test
    
    // public function ShouldGetUtcFromSpecifyKind() {
        
    //     # Arrange:
    //     $now = new DateTime(2010, 05, 05, 20, 0, 0);
    
    //     # Act:
    //     $utc = DateTime::specifyKind($now, DateTimeKind::utc());
    
    //     # Assert:
    //     $this->assertEquals(23, $utc->hours());
    // }

    // /**
    //  * @test
    // */
    // public function ShouldGetLocalFromSpecifyKind() {
    //     $this->markTestIncomplete('NotImplemented TimeZoneInfo');
    // }

    // public function test_Subtract_WhenSubtractDateShouldBeTimeSpanWithOneDay() {
    //    $date = DateTime::now();
    //    $time = $date->subtract(DateTime::now()->addDays(-1));
    //    $this->assertEquals(1, $time->days());
    // }

    // public function test_Subtract_WhenSubtractFromTimeSpanShouldBeEqualToThreeDays() {
    //    $date = new DateTime(2010, 9, 8);
    //    $time = $date->subtract(new TimeSpan(5));
    //    $this->assertEquals(3, $time->days());
    // }

    

    


    // public function test_Compare_CanCompareTwoDateAndTime() {
    //     $date1 = new DateTime(2004, 2, 29);
    //     $date2 = new DateTime(2004, 2, 29);
    //     $date3 = new DateTime(2004, 3, 29);
    //     $this->assertEquals(0, DateTime::compare($date1, $date2));
    //     $this->assertEquals(-1, DateTime::compare($date1, $date3));
    //     $this->assertEquals(1, DateTime::compare($date3, $date2));
    // }

    // public function test_Compare_CompareToWithTwoDateAndTime() {
    //     $date1 = new DateTime(2004, 2, 29);
    //     $date2 = new DateTime(2004, 2, 29);
    //     $date3 = new DateTime(2004, 3, 29);
    //     $this->assertEquals(0, $date1->compareTo($date2));
    //     $this->assertEquals(-1, $date1->compareTo($date3));
    //     $this->assertEquals(1, $date3->compareTo($date2));
    //     $this->assertEquals(1, $date1->compareTo(null));
    //     $this->assertEquals(1, $date1->compareTo(2));
    // }

    // public function test_DaysInMonth_CanGetDaysInMonth() {
    //     $this->assertEquals(29, DateTime::daysInMonth(2004, 02));
    //     $this->assertEquals(28, DateTime::daysInMonth(2005, 02));
    //     $this->assertEquals(31, DateTime::daysInMonth(2005, 01));
    // }

    // public function test_GetDateAndTimeFormats_CanGetParameters() {
    //     $date1 = new DateTime(2004, 2, 3, 23, 59, 59);
    //     $formats = $date1->getDateAndTimeFormats();
    //     $this->assertGreaterThan(1, sizeof($formats));
    // }

    // public function test_IsDaylightSavingTime_CanDiscoveryIfTheTimezoneHasDaylightSaving() {
    //     date_default_timezone_set("America/Sao_Paulo");
    //     $date = new DateTime(2004, 10, 3, 23, 59, 59);
    //     $this->assertEquals(false, $date->isDaylightSavingTime());
    // }

    // public function test_IsLeapYear_CanDiscoverIfTheIsLeapYear() {
    //     $this->assertEquals(true, DateTime::isLeapYear(2004));
    //     $this->assertEquals(false, DateTime::isLeapYear(2005));
    // }

    // public function test_Parse_ThrowsExceptionWhenInputIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     DateTime::parse(null);
    // }

    // public function test_Parse_ThrowsExceptionWhenInvalidDateFormat(){
    //     $this->setExpectedException("\\System\\FormatException");
    //     DateTime::parse("10.30.2999");
    // }

    // public function test_Parse_CanParseDateTime() {
    //     $date = DateTime::parse("2011.8.12 11:39");
    //     $this->assertEquals(2011, $date->year());
    //     $this->assertEquals(11, $date->hours());
    // }

    // public function test_DayOfWeek_CanGetDayOfWeek() {
    //     $date1 = new DateTime(2010, 9, 04);
    //     $this->assertEquals(DayOfWeek::saturday(), $date1->dayOfWeek());
    // }

    // public function test_DayOfYear_CanGetDayOfYear() {
    //     $date1 = new DateTime(2010, 1, 1);
    //     $date2 = new DateTime(2010, 12, 31);
    //     $leapYear = new DateTime(2004, 12, 31);

    //     $this->assertEquals(1, $date1->dayOfYear());
    //     $this->assertEquals(365, $date2->dayOfYear());
    //     $this->assertEquals(366, $leapYear->dayOfYear());
    // }

    // public function test_Now_CanGetNow() {
    //     $now = DateTime::now();
    //     $date = getdate();

    //     $this->assertEquals($date["year"], $now->year());
    //     $this->assertEquals($date["mon"], $now->month());
    //     $this->assertEquals($date["mday"], $now->day());
    //     $this->assertEquals($date["hours"], $now->hours());
    //     $this->assertEquals($date["minutes"], $now->minutes());
    //     $this->assertEquals($date["seconds"], $now->seconds());
    // }

    // public function test_Today_CanGetToday() {
    //     $now = DateTime::today();
    //     $date = getdate();

    //     $this->assertEquals($date["year"], $now->year());
    //     $this->assertEquals($date["mon"], $now->month());
    //     $this->assertEquals($date["mday"], $now->day());
    //     $this->assertEquals(0, $now->hours());
    //     $this->assertEquals(0, $now->minutes());
    //     $this->assertEquals(0, $now->seconds());
    // }
    

}
