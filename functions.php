<?php

// the strtolower version to support most amount of languages including russian, french and so on: 
// (thanks to leha_grobov on php.net)
function strtolower_utf8($string){
  $convert_to = array(
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
    "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
    "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
    "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
    "ь", "э", "ю", "я"
  );
  $convert_from = array(
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
    "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
    "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
    "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
    "Ь", "Э", "Ю", "Я"
  );
  return str_replace($convert_from, $convert_to, $string);
}

/**
 * Returns a string with all spaces converted to underscores (by default), accented
 * characters converted to non-accented characters, and non word characters removed.
 *
 * @param string $string
 * @param string $replacement
 * @return string
 * @access public
 * @static
 * @link http://book.cakephp.org/view/572/Class-methods
 */
function sluggize($string, $replacement = '_') {
  $map = array(
    '/à|á|å|â/' => 'a',
    '/è|é|ê|ẽ|ë/' => 'e',
    '/ì|í|î/' => 'i',
    '/ò|ó|ô|ø/' => 'o',
    '/ù|ú|ů|û/' => 'u',
    '/ç/' => 'c',
    '/ñ/' => 'n',
    '/ä|æ/' => 'ae',
    '/ö/' => 'oe',
    '/ü/' => 'ue',
    '/Ä/' => 'Ae',
    '/Ü/' => 'Ue',
    '/Ö/' => 'Oe',
    '/ß/' => 'ss',
    '/[^\w\s]/' => ' ',
    '/\\s+/' => $replacement,
  );
  
  return preg_replace(array_keys($map), array_values($map), strtolower_utf8($string));
}


function glob_templates($mask)
{
  $file_names = array();
  foreach(glob($mask) as $file)
  {
    $content = file_get_contents($file);
    // get the template's name
    preg_match('/<?'.'php\s*\/\/\s*Template\s*:\s*([^\n]+)/', $content, $match);
    if (!empty($match[1]))
    {
      $file_names[basename($file)] = $match[1]; // add it to the file_names
    }
  }
  return $file_names;
}
