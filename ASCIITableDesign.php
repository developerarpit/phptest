<?php
/**
 *
 *Script to Print an associative array as an ASCII table with column of different color.
 *
 */

const Xspace = 1;
const Yspace = 0;
const PLUS = '+';
const Xaxis = '-';
const Yaxis = '|';
 

$table = array(
array(
'Name' => 'Trixie',
'Color' => 'Green',
'Element' => 'Earth',
'Likes' => 'Flowers'
),
array(
'Name' => 'Tinkerbell',
'Element' => 'Air',
'Likes' => 'Singing',
'Color' => 'Blue'
),
array(
'Element' => 'Water',
'Likes' => 'Dancing',
'Name' => 'Blum',
'Color' => 'Pink'
),
);


/**
 * function to draw table
 */ 
function display_table($table){
 
$nl = "\n";
$col_headers = cols_headers($table);
$col_length = cols_length($table, $col_headers);
$row_sep = row_seperator($col_length);
$row_header = row_header($col_headers, $col_length);
 
echo '<pre>';
 
echo $row_sep . $nl;
echo $row_header . $nl;
echo $row_sep . $nl;
foreach($table as $row_cells)
{
$row_cells = row_cells($row_cells, $col_headers, $col_length);
echo $row_cells . $nl;
}
echo $row_sep . $nl;
 
echo '</pre>';
 
}
 

/**
 * function to return columns header
 */
function cols_headers($table){
return array_keys(reset($table));
}
 
function cols_length($table, $col_headers){
$lengths = [];
foreach($col_headers as $header)
{
$header_length = strlen($header);
$max = $header_length;
foreach($table as $row)
{
$length = strlen($row[$header]);
if($length > $max)
$max = $length;
}
 
if(($max % 2) != ($header_length % 2))
$max += 1;
 
$lengths[$header] = $max;
}
 
return $lengths;
}
 
/**
 * function to create table row seperator (+------------+-------+---------+---------+)
 */
function row_seperator($col_length){
$row = '';
foreach($col_length as $column_length)
{
$row .= PLUS . str_repeat(Xaxis, (Xspace * 2) + $column_length);
}
$row .= PLUS;
 
return $row;
}
 
/**
 * function to return table row header
 */
function row_header($col_headers, $col_length){
$row = '';
$i=1;
foreach($col_headers as $header)
{
if($i==1)
$bgcolor='red';
elseif($i==2)
$bgcolor='green';
elseif($i==3)
$bgcolor='blue';
elseif($i==4)
$bgcolor='orange';
$row .= Yaxis ."<span style='background-color:".$bgcolor."'>". str_pad($header, (Xspace * 2) + $col_length[$header], ' ', STR_PAD_BOTH)."</span>";
$i++;
}
$row .= Yaxis;
 
return $row;
}

/**
 * function to return table row cell
 */
function row_cells($row_cells, $col_headers, $col_length){
$row = '';
$i=1;
foreach($col_headers as $header)
{
if($i==1)
$bgcolor='red';
elseif($i==2)
$bgcolor='green';
elseif($i==3)
$bgcolor='blue';
elseif($i==4)
$bgcolor='orange';
$row .= Yaxis ."<span style='background-color:".$bgcolor."'>". str_repeat(' ', Xspace) . str_pad($row_cells[$header], Xspace + $col_length[$header], ' ', STR_PAD_RIGHT)."</span>";
$i++;
}
$row .= Yaxis;
 
return $row;
}
 
display_table($table); // call to function
