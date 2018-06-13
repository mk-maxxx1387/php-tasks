<?php
include('libs/HtmlHelper.php');
$tHead = array('First name', 'Last name');
$tContent = array(
    array('Bob', 'Test'),
    array('Jack', 'Black'),
    array('Nick', 'Sick'),
);
$table = HtmlHelper::getTable($tHead, $tContent);
echo $table;

$rbArr = array('White', 'Green', 'Yellow');
$rb = HtmlHelper::getRadioGroup($rbArr, 'Select color', 'colors-rb', 1);
print($rb);

$chBox = HtmlHelper::getCheckboxes('Select colors', 'colors-chb', $rbArr,array(1,3));
print($chBox);

$selMulti = HtmlHelper::getSelectMulti('colors-sel', $rbArr);
print($selMulti);

$ulOl = [
    'Germany' => 
        ['VW', 'BMW', 'Opel', 'Mercedes'],
    'Japan' =>
        ['Nissan', 'Toyota', 'Honda'],
    'USA' =>
        ['Chevrolet', 'Dodge', 'Ford', 'Pontiac'],
];
$ulOl = HtmlHelper::getUlOl($ulOl);
print($ulOl);

$dtDd = [
    'in_array' => 'The in_array() function searches an array for a specific value.',
    'html_errors' => 'Turns off HTML tags in error messages.',
    'checkdate' => 'The checkdate() function is used to validate a Gregorian date.',
];
$dtDd = HtmlHelper::getDlDtDd($dtDd);
print($dtDd);
