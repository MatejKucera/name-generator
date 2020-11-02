<?php

$femaleNames = [];
$maleNames = [];
$femaleCounter = 0;
$maleCounter = 0;

foreach(file('parsers/cs/lastnames') as $line) {
    $exploded = explode("	", trim($line));
    $name = ucfirst(strtolower($exploded[0]));
    $gender = mb_substr($name, -1) == "á" ? 'female' : 'male';
    $frequency = (int) round($exploded[1] / 2);
    
    $listName = $gender."Names";
    $counterName = $gender."Counter";

    $from = ${$counterName};
    $to = ${$counterName} + $frequency - 1;
    if(alreadyListed($name, ${$listName})) {
        continue;
    }
    ${$counterName} += $frequency;
        
    ${$listName}[] = [
        'name' => $name,
        'frequency' => $frequency,
        'from' => $from,
        'to' => $to,
    ];
    
    echo $name . " | " . $gender . " | " . $frequency . " | " . $from . " - " . $to . "\n";
}

$femaleData = [
    'data' => $femaleNames,
    'total' => count($femaleNames),
];

$maleData =  [
    'data' => $maleNames,
    'total' => count($maleNames),
];


file_put_contents('data/cs/lastname_female.json', json_encode($femaleData));
file_put_contents('data/cs/lastname_male.json', json_encode($maleData));

echo "Listed ".(count($femaleNames)+count($maleNames)). " first names (female ".count($femaleNames).", male ".count($maleNames).").\n";

function alreadyListed($name, $names) {
    foreach($names as $alreadyName) {
        if($alreadyName['name'] == $name) {
            echo "----- already listed: ".$name."\n";
            return true;
        }
    }
    return false;
}