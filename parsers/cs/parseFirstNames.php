<?php

$femaleNames = parseFile('parsers/cs/birthnames_female');
$maleNames = parseFile('parsers/cs/birthnames_male');

$femaleData = [
    'data' => $femaleNames,
    'total' => count($femaleNames),
];

$maleData =  [
    'data' => $maleNames,
    'total' => count($maleNames),
];

file_put_contents('data/cs/firstname_female.json', json_encode($femaleData));
file_put_contents('data/cs/firstname_male.json', json_encode($maleData));

echo "Listed ".(count($femaleNames)+count($maleNames)). " first names (female ".count($femaleNames).", male ".count($maleNames).").\n";

function parseFile($file) {
    $names = [];
    $frequency = 100;
    $counter = 1;

    foreach(file($file) as $line) {
        $exploded = explode("	", trim($line));
        $name = ucfirst(strtolower(explode(" ", $exploded[1])[0]));
            
        $from = $counter;
        $to = $counter + $frequency - 1;
        if(alreadyListed($name, $names)) {
            continue;
        }
            
        $names[] = [
            'name' => $name,
            'frequency' => $frequency,
            'from' => $from,
            'to' => $to,
        ];

        $counter += $frequency;
        $frequency = floor($frequency * 0.99);
        if($frequency < 1) {
            $frequency = 1;
        }
        
        echo $name . " | " . $frequency . " | " . $from . " - " . $to . "\n";
    }
    
    return $names;
    
}


function alreadyListed($name, $names) {
    foreach($names as $alreadyName) {
        if($alreadyName['name'] == $name) {
            //echo "----- already listed: ".$name."\n";
            return true;
        }
    }
    return false;
}