<?php
/**
 * @file aart.php
 *
 * @brief ASCII art funcionts
 *
 * @author  Pferor <pferor@gmail.com>
 * @version 1.0 (2010-09-12)
 *
 * @ingroup Functions
 *
 * @section license_sec License
 *  This program is free software: you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program. If not, see
 *  <a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>.
 */


/**
 * @brief Displays a string with Aart font
 *
 * @param string    String to display
 * @param font_file Font to use
 * @param class     CSS class to display this preformatted text
 *
 * @return HTML code with the strin $string in ASCII art
 */
function aart($string,
              $font_file = 'aafonts/fnt_standard.php',
              $class     = 'captcha')
{
  $html       = '';
  $font_array = array();

  if (is_file($font_file)) {
    include($font_file);
  } else {
    include('aafonts/fnt_standard.php');
  }

  $max_height = $font_array['max_height'];
  $html .= "\n" . '<pre class="' . $class . '">' . "\n";
  for ($line = 0; $line < $max_height; $line++) {
    if ($line != 0) {
      $html .= "\n";
    }

    for ($counter = 0; $counter < strlen($string); $counter++) {
      switch ($string[$counter]) {
      case ' ':
        $html .= $font_array["Space"][$line];
        break;

      case '|':
        $html .= $font_array['Pipe'][$line];
        break;

      case '(':
        $html .= $font_array['ParenthesisOpen'][$line];
        break;

      case ')':
        $html .= $font_array['ParenthesisClose'][$line];
        break;

      case '<':
        $html .= $font_array['AngleBracketsOpen'][$line];
        break;

      case '>':
        $html .= $font_array['AngleBracketsClose'][$line];
        break;

      case '{':
        $html .= $font_array['CurlyBracketsOpen'][$line];
        break;

      case '}':
        $html .= $font_array['CurlyBracketsClose'][$line];
        break;

      case '[':
        $html .= $font_array['SquareBracketsOpen'][$line];
        break;

      case ']':
        $html .= $font_array['SquareBracketsClose'][$line];
        break;

      case '!':
        $html .= $font_array['Exclamation'][$line];
        break;

      case '?':
        $html .= $font_array['Interrogation'][$line];
        break;

      case '$':
        $html .= $font_array['Dollar'][$line];
        break;

      case '@':
        $html .= $font_array['At'][$line];
        break;

      case '#':
        $html .= $font_array['Pad'][$line];
        break;

      case '_':
        $html .= $font_array['Understrike'][$line];
        break;

      case '.':
        $html .= $font_array['Dot'][$line];
        break;

      case ',':
        $html .= $font_array['Comma'][$line];
        break;

      case ':':
        $html .= $font_array['Colon'][$line];
        break;

      case ';':
        $html .= $font_array['Semicolon'][$line];
        break;

      case '"':
        $html .= $font_array['Quotes'][$line];
        break;

      case '\'':
        $html .= $font_array['Apostrophe'][$line];
        break;

      case '&':
        $html .= $font_array['Ampersand'][$line];
        break;

      case '^':
        $html .= $font_array['Caret'][$line];
        break;

      case '%':
        $html .= $font_array['Percent'][$line];
        break;

      case '+':
        $html .= $font_array['Plus'][$line];
        break;

      case '*':
        $html .= $font_array['Asterisk'][$line];
        break;

      case '-':
        $html .= $font_array['Minus'][$line];
        break;

      case '=':
        $html .= $font_array['Equal'][$line];
        break;

      case '/':
        $html .= $font_array['Slash'][$line];
        break;

      case '\\':
        $html .= $font_array['BackSlash'][$line];
        break;

      case '0':
        $html .= $font_array['Zero'][$line];
        break;

      case '1':
        $html .= $font_array['One'][$line];
        break;

      case '2':
        $html .= $font_array['Two'][$line];
        break;

      case '3':
        $html .= $font_array['Three'][$line];
        break;

      case '4':
        $html .= $font_array['Four'][$line];
        break;

      case '5':
        $html .= $font_array['Five'][$line];
        break;

      case '6':
        $html .= $font_array['Six'][$line];
        break;

      case '7':
        $html .= $font_array['Seven'][$line];
        break;

      case '8':
        $html .= $font_array['Eight'][$line];
        break;

      case '9':
        $html .= $font_array['Nine'][$line];
        break;

      case 'A':
        $html .= $font_array['A'][$line];
        break;

      case 'B':
        $html .= $font_array['B'][$line];
        break;

      case 'C':
        $html .= $font_array['C'][$line];
        break;

      case 'D':
        $html .= $font_array['D'][$line];
        break;

      case 'E':
        $html .= $font_array['E'][$line];
        break;

      case 'F':
        $html .= $font_array['F'][$line];
        break;

      case 'G':
        $html .= $font_array['G'][$line];
        break;

      case 'H':
        $html .= $font_array['H'][$line];
        break;

      case 'I':
        $html .= $font_array['I'][$line];
        break;

      case 'J':
        $html .= $font_array['J'][$line];
        break;

      case 'K':
        $html .= $font_array['K'][$line];
        break;

      case 'L':
        $html .= $font_array['L'][$line];
        break;

      case 'M':
        $html .= $font_array['M'][$line];
        break;

      case 'N':
        $html .= $font_array['N'][$line];
        break;

      case 'O':
        $html .= $font_array['O'][$line];
        break;

      case 'P':
        $html .= $font_array['P'][$line];
        break;

      case 'Q':
        $html .= $font_array['Q'][$line];
        break;

      case 'R':
        $html .= $font_array['R'][$line];
        break;

      case 'S':
        $html .= $font_array['S'][$line];
        break;

      case 'T':
        $html .= $font_array['T'][$line];
        break;

      case 'U':
        $html .= $font_array['U'][$line];
        break;

      case 'V':
        $html .= $font_array['V'][$line];
        break;

      case 'W':
        $html .= $font_array['W'][$line];
        break;

      case 'X':
        $html .= $font_array['X'][$line];
        break;

      case 'Y':
        $html .= $font_array['Y'][$line];
        break;

      case 'Z':
        $html .= $font_array['Z'][$line];
        break;

      case 'a':
        $html .= $font_array['a'][$line];
        break;

      case 'b':
        $html .= $font_array['b'][$line];
        break;

      case 'c':
        $html .= $font_array['c'][$line];
        break;

      case 'd':
        $html .= $font_array['d'][$line];
        break;

      case 'e':
        $html .= $font_array['e'][$line];
        break;

      case 'f':
        $html .= $font_array['f'][$line];
        break;

      case 'g':
        $html .= $font_array['g'][$line];
        break;

      case 'h':
        $html .= $font_array['h'][$line];
        break;

      case 'i':
        $html .= $font_array['i'][$line];
        break;

      case 'j':
        $html .= $font_array['j'][$line];
        break;

      case 'k':
        $html .= $font_array['k'][$line];
        break;

      case 'l':
        $html .= $font_array['l'][$line];
        break;

      case 'm':
        $html .= $font_array['m'][$line];
        break;

      case 'n':
        $html .= $font_array['n'][$line];
        break;

      case 'o':
        $html .= $font_array['o'][$line];
        break;

      case 'p':
        $html .= $font_array['p'][$line];
        break;

      case 'q':
        $html .= $font_array['q'][$line];
        break;

      case 'r':
        $html .= $font_array['r'][$line];
        break;

      case 's':
        $html .= $font_array['s'][$line];
        break;

      case 't':
        $html .= $font_array['t'][$line];
        break;

      case 'u':
        $html .= $font_array['u'][$line];
        break;

      case 'v':
        $html .= $font_array['v'][$line];
        break;

      case 'w':
        $html .= $font_array['w'][$line];
        break;

      case 'x':
        $html .= $font_array['x'][$line];
        break;

      case 'y':
        $html .= $font_array['y'][$line];
        break;

      case 'z':
        $html .= $font_array['z'][$line];
        break;
      } /* switch */
    } /* for ($counter) */
  } /* for ($line) */

  $html .= '</pre>' . "\n";

  return $html;
}

