<?php
namespace App\Tests;
use PHPUnit\Framework\TestCase;
use App\Entity\Classroom;

class AppTest extends TestCase {
    // public function testTestsAreWorking() {
    //     $this->assertEquals(3, 1+1);
    // }
    public function testClassroomEntity() {
        $classroom = new Classroom();
        $classroom->setName('3A20');
        $this->assertEquals('3A23', $classroom->concat());
    }
}