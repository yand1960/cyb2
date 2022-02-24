<?php

$data = [1,2,3,44,55,66];
echo($data[1]."<br />");
$data[] = 77;

echo($data[6]."<br />");

for($i=0; $i < 7; $i++) {
    echo($data[$i]."<br />");
}

// $people = [
//     ["Yuri", "Andrienko", 123456],
//     ["Vasya", "Pupkin", 777777],
//     ["Masha", "Maskina", 66666],
// ];

// for($i = 0; $i < count($people); $i++) {
//     echo($people[$i][0]." - ".$people[$i][2]."<br />");
// }

$people = [
    array("FirstName"=>"Yuri", "LastName"=>"Andrienko", "salary"=>123456),
    array("FirstName"=>"Vasya", "LastName"=>"Pupkin", "salary"=>77777),
    array("FirstName"=>"Masha", "LastName"=>"Mashkina", "salary"=>66666)
];

for($i = 0; $i < count($people); $i++) {
        echo($people[$i]["FirstName"]." - ".$people[$i]["salary"]."<br />");
}
    
