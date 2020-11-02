<?php

namespace MatejKucera\NameGenerator;


class NameGenerator
{

    private $language;

    public const GENDER_RANDOM = 'random';
    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    private const FILE_FIRST_MALE   = 'data/cs/firstname_male.json';
    private const FILE_LAST_MALE    = 'data/cs/lastname_male.json';
    private const FILE_FIRST_FEMALE = 'data/cs/firstname_female.json';
    private const FILE_LAST_FEMALE  = 'data/cs/lastname_female.json';

    public function __construct($language = 'cs')
    {
        $this->language = $language;
    }

    /**
     * TODO LANGUAGE NOT IMPLEMENTED YET
     */
    public function setLanguage($language) {
        $this->language = $language;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function name($gender = self::GENDER_RANDOM) {
        if($gender == self::GENDER_RANDOM) {
            if(rand(0,1)) {
                $gender = self::GENDER_MALE;
            } else {
                $gender = self::GENDER_FEMALE;
            }
        }        

        return $this->firstName($gender) . ' ' . $this->lastName($gender);
    }

    public function firstName($gender = self::GENDER_RANDOM) {
        if($gender == self::GENDER_RANDOM) {
            if(rand(0,1)) {
                $gender = self::GENDER_MALE;
            } else {
                $gender = self::GENDER_FEMALE;
            }
        } 

        if($gender == self::GENDER_MALE) {
            return $this->getFromFile(self::FILE_FIRST_MALE);
        } else {
            return $this->getFromFile(self::FILE_FIRST_FEMALE);
        }
    }

    public function lastName($gender = self::GENDER_RANDOM) {
        if($gender == self::GENDER_RANDOM) {
            if(rand(0,1)) {
                $gender = self::GENDER_MALE;
            } else {
                $gender = self::GENDER_FEMALE;
            }    
        } 

        if($gender == self::GENDER_MALE) {
            return $this->getFromFile(self::FILE_LAST_MALE);
        } else {
            return $this->getFromFile(self::FILE_LAST_FEMALE);
        }
    }

    private function getFromFile($file) {
        $json = json_decode(file_get_contents($file), true);
        $total = $json['total'];
        $random = rand(1, $total);
        $result = null;
        foreach($json['data'] as $record) {
            if($random >= $record['from'] && $random <= $record['to']) {
                $result = $record['name'];
            }
        }
        return $result;
    }

}