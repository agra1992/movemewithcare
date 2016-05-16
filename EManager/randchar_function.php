<?php 

/** 
* @(#)randchar.function.php, v 1.1 2004/08/18 
* 
* Copyright (C) 2003,2004  Erich Spencer <ewspencer@industrex.com> 
* 
* Generate arbitrary length strings of random characters and 
* also random color or grayscale values using decimal (r,g,b) 
* or hexadecimal (rrggbb) notation. Punctuation characters 
* are not included in this version. 
* 
* ---------------------------------------------------------------- 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version. 
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt) 
* for more details. 
* ---------------------------------------------------------------- 
* 
* Description: 
* 
*   mixed randchar( [int length, String range, String case] ) 
* 
*   randchar() returns a string or number with $length number of 
*   characters or digits, from a $range set of possible character 
*   values, in $case character case. 
* 
*   If arguments are invalid or missing, $length defaults to 8, 
*   $range defaults to alphanumeric, and $case defaults to mixed. 
* 
* Random Color Values 
* 
*   Four special instances of $range are provided to produce color 
*   or grayscale values in decimal (r,g,b) or hexadecimal (rrggbb) 
*   notation for $length bit color depth. Currently, randchar() 
*   supports 24 bit color depth maximum, so $length defaults to 8 
*   if greater than 24. 
* 
*   Possible values for $range are 
* 
*      abc|alpha|alphabetic   = alphabetic 
*      anc|alnum|alphanumeric = alphanumeric 
*      hxd|hex|hexadecimal    = hexadecimal 
*      nmc|num|numeric        = numeric 
* 
*      dmc|color    = color: decimal 
*      dmg|gray     = gray : decimal 
*      hxc|hexcolor = color: hexadecimal 
*      hxg|hexgray  = gray : hexadecimal 
* 
*   Possible values for $case are 
* 
*        l|lower = lower 
*        u|upper = upper 
*        m|mixed = mixed 
* 
* Usage 
* 
*   To use randchar(), simply copy this file to your global 
*   "includes" subdirectory (or preferred subdirectory) and 
*   "require" the file whenever you need to generate random 
*   character strings or color values. A limited assortment 
*   of example arguments and returned results are listed below. 
* 
* Examples: 
* 
*   function(arguments)                 returned value 
*  ---------------------------------------------------------------- 
*   randchar()                          4cp425Ki 
*   randchar(16)                        7e4w872SgBvqqV7K 
*   randchar(32)                        u787mSvM434GLMm8EUQBm0Sp004GPnO6 
*   randchar(12,"abc","u")              YEVTVUZDZDVP 
*   randchar(32,"alpha")                DXAxCxKuoWQaHooiBsWmpBiFqJRHZJRL 
*   randchar(32,"alpha","upper")        IWCLMOQADFBYBOEYAKRUTLIFZLWYNDBU 
*   randchar(21,"alphabetic","lower")   bhqmjrjtfaajibhampzoj 
*   randchar(9,"alnum")                 iJM496Tv5 
*   randchar(64,"anc")                  962GR07IPzuilGC0X64h7856u6dBSuB12Z962b6436wEJ6JPAt8m06Eohd9qk9bk 
*   randchar(52,"alnum","mixed")        rEn73064KO0Q5Jl9peOG2vE1ga0o35w14B4P04o7AJ8J151dC828 
*   randchar(10,"alnum","upper")        181Q25BBPX 
*   randchar(32,"anc","u")              44UP15QIW1WX3Y20I65PP1NF808QY236 
*   randchar(50,"alphanumeric","l")     5hsz4ct433es987o122t6kj0c0813vo8d619ec30gbz912tom3 
*   randchar(16,"numeric")              4411738442293524 
*   randchar(24,"nmc")                  034641722770203905145204 
*   randchar(16,"hex","upper")          8BA98DCB73391BAF 
*   randchar(3,"gray")                  128,128,128 
*   randchar(8,"color")                 255,64,192 
*   randchar(8,"hexcolor")              40c0ff 
*   randchar(8,"hexgray", "upper")      C0C0C0 
* 
* ---------------------------------------------------------------- 
* @document   $Id: randchar.function.php, v 1.1 2004/08/18 9:11 AM ews Exp $ 
* @author     Erich Spencer <ewspencer@industrex.com> 
* @version    v 1.1 2004/08/18 
*/ 

function randchar($length = 8, $range = "anc", $case = 'm') 
{ 
    $str = null; 
    if (gettype($length) != "integer") 
            $length = 8; 

    // determine character range 
    switch (TRUE) { 
    case ("abc" == $range || "alpha" == $range || "alphabetic" == $range):   // alphabetic 
        $minval = 2; $maxval = 3; 
        break; 
    case ("dmc" == $range || "color" == $range):    // color: decimal 
    case ("hxc" == $range || "hexcolor" == $range): // color: hexadecimal 
        $minval = 5; $maxval = 5; 
        if ($length > 24) $length = 24; 
        $depth  = $length; 
        $length = 6; 
        break; 
    case ("dmg" == $range || "gray" == $range):     // gray: decimal 
    case ("hxg" == $range || "hexgray" == $range):  // gray: hexadecimal 
        $minval = 5; $maxval = 5; 
        if ($length > 24) $length = 24; 
        $depth  = $length; 
        $length = 2; 
        break; 
    case ("hxd" == $range || "hex" == $range || "hexadecimal" == $range):    // hexadecimal 
        $minval = 5; $maxval = 5; 
        break; 
    case ("nmc" == $range || "num" == $range || "numeric" == $range):        // numeric 
        $minval = 1; $maxval = 1; 
        break; 
    case ("anc" == $range || "alnum" == $range || "alphanumeric" == $range): // alphanumeric 
    default :   // alphanumeric 
        $minval = 1; $maxval = 4; 
        break; 
    } 

    // build string 
    for ($i = 0;$i < $length;$i++) { 
        switch (@rand($minval, $maxval)) { 
        case 1: $str .= chr(rand(48, 57));  // 0-9 
            break; 
        case 2: $str .= chr(rand(97, 122)); // a-z 
            break; 
        case 3: $str .= chr(rand(65, 90));  // A-Z 
            break; 
        case 4: $str .= chr(rand(48, 57));  // 0-9 
            break; 
        case 5: $str .= dechex(rand(0,15)); // 0-15 
                break; 
        } 
    } 

    // procedure for color values 
    switch (TRUE) { 
    case ("dmc" == $range || "color" == $range): 
    case ("dmg" == $range || "gray" == $range): 
    case ("hxc" == $range || "hexcolor" == $range): 
    case ("hxg" == $range || "hexgray" == $range): 
        $clrs  = chunk_split($str,2,' ');      // space delimit color value pairs 
        $clrs  = explode(' ',trim($clrs));     // load color value pairs into array 
        $bpclr = floor($depth/3);              // set number of bits per color value 
        $step  = (256/pow(2,$bpclr));          // calculate step value for quantizing 
        foreach ($clrs as $key => $clr) { 
            $clrs[$key] = hexdec($clr);        // convert to decimal for manipulation 
            $clr = round($clrs[$key] / $step); // calculate quantizing (Q) factor 
            $clr = $clr * $step;               // multiply color value by Q factor 
            $clr = $clr - floor($clr/256);     // adjust to maintain bounds 0-256 
            $clrs[$key] = $clr;                // replace original color value pair 
        } 

        // triple gray value 
        switch (TRUE) { 
        case ("dmg" == $range || "gray" == $range): 
        case ("hxg" == $range || "hexgray" == $range): 
            $clrs = array_pad($clrs,3,$clrs[0]); 
            break; 
        } 

        // comma delimit decimal color values 
        switch (TRUE) { 
        case ("dmc" == $range || "color" == $range): // r,g,b 
        case ("dmg" == $range || "gray" == $range):  // r,g,b 
            $str = implode(",", $clrs); 
            break; 
        case ("hxc" == $range || "hexcolor" == $range):  // rrggbb 
        case ("hxg" == $range || "hexgray" == $range):   // rrggbb 
            $str =  ( 
                 sprintf("%02x",$clrs[0]) 
                .sprintf("%02x",$clrs[1]) 
                .sprintf("%02x",$clrs[2]) 
                ); 
            break; 
        } 
    break; 
    } 

    // set character case 
    switch (TRUE) { 
    case ('l' == $case || "lower" == $case): // lower case 
        $str = strtolower($str); 
        break; 
    case ('u' == $case || "upper" == $case): // upper case 
        $str = strtoupper($str); 
        break; 
    } 
    return $str; 
} 

?> 