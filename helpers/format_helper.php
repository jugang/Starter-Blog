<?php
/*
 * Format The Date
 */
function formatDate($date){
    //date_default_timezone_set('Europe/Belgrade');
    return date('F j, Y, g:i a', strtotime($date));
}

function shortenText($text, $chars = 450){
    $text = $text." ";                                      // dodajemo razmak na kraju texta
    $text = substr($text, 0, $chars);                  //idemo do 450 karaktera
    $text = substr($text, 0, strrpos($text, ' '));//strrpod(stopira substr)->broji od pozadi(da ne bi slomio rec na pola 450 karaktera) i kad naidje na prvi razmak
    $text = $text."...";                                    //dodajemo na kraju tri tacke
    return $text;
}