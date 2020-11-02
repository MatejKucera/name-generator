<?php

use MatejKucera\NameGenerator\NameGenerator;
use PHPUnit\Framework\TestCase;

final class BasicTest extends TestCase
{

    public function testSetLanguage(): void {
        // default
        $generator = new NameGenerator();
        $this->assertEquals('en', $generator->getLanguage());

        // by construct
        $generator = new NameGenerator('pl');
        $this->assertEquals('pl', $generator->getLanguage());

        // set
        $generator = new NameGenerator();
        $generator->setLanguage('en');
        $this->assertEquals('en', $generator->getLanguage());
    }

    public function testGenerateFullName() {
        for($i = 0; $i<=50; $i++) {
            $generator = new NameGenerator();
            $name = $generator->name();
            $words = count(explode(' ', $name));
            $this->assertNotNull($name);
            $this->assertEquals($words, 2);

        }

        $name = $generator->name('male');
        $explodedMaleName = explode(" ", $name);
        $this->assertTrue($this->isNameInList($explodedMaleName[0], 'data/cs/firstname_male.json'));
        $this->assertTrue($this->isNameInList($explodedMaleName[1], 'data/cs/lastname_male.json'));

        $name = $generator->name('female');
        $explodedFemaleName = explode(" ", $name);
        $this->assertTrue($this->isNameInList($explodedFemaleName[0], 'data/cs/firstname_female.json'));
        $this->assertTrue($this->isNameInList($explodedFemaleName[1], 'data/cs/lastname_female.json'));
        
    }

    public function testGenerateFirstName() {
        for($i = 0; $i<=50; $i++) {
            $generator = new NameGenerator();
            $name = $generator->firstName();
            $words = count(explode(' ', $name));
            $this->assertNotNull($name);
            $this->assertEquals($words, 1);
        }

        $name = $generator->firstName('male');
        $this->assertTrue($this->isNameInList($name, 'data/cs/firstname_male.json'));
        $name = $generator->firstName('female');
        $this->assertTrue($this->isNameInList($name, 'data/cs/firstname_female.json'));
    }

    public function testGenerateLastName() {
        for($i = 0; $i<=50; $i++) {
            $generator = new NameGenerator();
            $name = $generator->lastName();
            $words = count(explode(' ', $name));
            $this->assertNotNull($name);
            $this->assertEquals($words, 1);

        }

        $name = $generator->lastName('male');
        $this->assertTrue($this->isNameInList($name, 'data/cs/lastname_male.json'));
        $name = $generator->lastName('female');
        $this->assertTrue($this->isNameInList($name, 'data/cs/lastname_female.json'));
    }

    private function isNameInList($name, $file) {
        $json = json_decode(file_get_contents($file), true);
        $total = $json['total'];
        foreach($json['data'] as $record) {
            if($record['name'] == $name) {
                return true;
            }
        }
        return false;
    }

}
