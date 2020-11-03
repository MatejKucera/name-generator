# MAC address manipulation tool for PHP

[![Build Status](https://travis-ci.org/MatejKucera/name-generator.svg?branch=master)](https://travis-ci.org/MatejKucera/name-generator)
[![Coverage Status](https://coveralls.io/repos/github/MatejKucera/name-generator/badge.svg?branch=master)](https://coveralls.io/github/MatejKucera/name-generator?branch=master)
[![composer.lock available](https://poser.pugx.org/matejkucera/name-generator/composerlock)](https://packagist.org/packages/matejkucera/name-generator)
[![Latest Stable Version](https://poser.pugx.org/matejkucera/name-generator/v/stable)](https://packagist.org/packages/matejkucera/name-generator)

## Introduction
This library allows you to generate random names. More common names will be generated more than less common.

## Supported languages
* Czech

## Installation

```
composer require matejkucera/name-generator
```

## Usage

```
use MatejKucera\NameGenerator\NameGenerator;

$generator = new NameGenerator();

// get full name
$name = $generator->name();

// get full female name
$name = $generator->name(NameGenerator::GENDER_FEMALE);

// get full male name
$name = $generator->name(NameGenerator::GENDER_MALE);

// get first name or last name only
$name = $generator->firstName();
$name = $generator->lastName();

// you can use specific gender for first and last names
$name = $generator->firstName(NameGenerator::GENDER_FEMALE);
$name = $generator->lastName(NameGenerator::GENDER_MALE);

```

## Planned languages

* English
* German
* Polish
* Slovak


