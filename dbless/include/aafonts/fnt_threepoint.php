<?php
/*
  ~|~|_  _ _  _   |~) _ . _ _|_
   | | || (/_(/_  |~ (_)|| | |

  Caracteres permitidos:
  A-Z a-z 0-9 . , " ' ( ) [ ] { } @ # $ % ^ _ - + * = / < > \ ; : ? ! | <Space>

  Los caracteres no reconocidos no seran representados (se omiten)

  URI: http://patorjk.com/software/taag/
  Fuente: Three Point

  Modificaciones con respecto las originales:
    * Ninguna
*/


$font_array = array ("max_height" => 3,

                     "Space" => array (
                                       "0" => "    ",
                                       "1" => "    ",
                                       "2" => "    "
                                       ),

                     "ParenthesisOpen" => array (
                                                 "0" => " /",
                                                 "1" => "| ",
                                                 "2" => " \\"
                                                 ),

                     "ParenthesisClose" => array (
                                                  "0" => "\\ ",
                                                  "1" => " |",
                                                  "2" => "/ "
                                                  ),

                     "CurlyBracketsOpen" => array (
                                                   "0" => " |~",
                                                   "1" => "<  ",
                                                   "2" => " |_"
                                                   ),

                     "CurlyBracketsClose" => array (
                                                    "0" => "~|",
                                                    "1" => " >",
                                                    "2" => "_|"
                                                    ),

                     "SquareBracketsOpen" => array (

                                                    "0" => "|~",
                                                    "1" => "| ",
                                                    "2" => "|_"
                                                    ),

                     "SquareBracketsClose" => array (
                                                     "0" => "~|",
                                                     "1" => " |",
                                                     "2" => "_|"
                                                     ),

                     "Pipe" => array (
                                      "0" => "|",
                                      "1" => "|",
                                      "2" => "|"
                                      ),

                     "Ampersand" => array (
                                           "0" => "()  ",
                                           "1" => "(_X ",
                                           "2" => "    "
                                           ),

                     "AngleBracketsOpen" => array (
                                                   "0" => " /",
                                                   "1" => "( ",
                                                   "2" => " \\"
                                                   ),

                     "AngleBracketsClose" => array (
                                                    "0" => "\\ ",
                                                    "1" => " )",
                                                    "2" => "/ "
                                                    ),

                     "Exclamation" => array (
                                             "0" => "|",
                                             "1" => ".",
                                             "2" => " "
                                             ),

                     "Interrogation" => array (
                                               "0" => "'~)",
                                               "1" => " ! ",
                                               "2" => "  "
                                               ),

                     "At" => array (
                                    "0" => " /~~\\",
                                    "1" => "|(|/",
                                    "2" => " \\__ "
                                    ),

                     "Pad" => array (
                                     "0" => "++",
                                     "1" => "++",
                                     "2" => "  "
                                     ),

                     "Understrike" => array (
                                             "0" => "  ",
                                             "1" => "__",
                                             "2" => "  "
                                             ),

                     "Asterisk" => array (
                                          "0" => ". ,",
                                          "1" => "-X-",
                                          "2" => "' `"
                                          ),

                     "Dollar" => array (
                                        "0" => " (|~",
                                        "1" => "_|)",
                                        "2" => "   "
                                        ),

                     "Caret" => array (
                                       "0" => "'`",
                                       "1" => "  ",
                                       "2" => "  "
                                       ),

                     "Quotes" => array (
                                        "0" => "''",
                                        "1" => "  ",
                                        "2" => "  "
                                        ),

                     "Apostrophe" => array (
                                            "0" => "'",
                                            "1" => " ",
                                            "2" => " "
                                            ),

                     "Dot" => array (
                                     "0" => " ",
                                     "1" => ".",
                                     "2" => " "
                                     ),

                     "Comma" => array (
                                       "0" => " ",
                                       "1" => ",",
                                       "2" => " "
                                       ),

                     "Colon" => array (
                                       "0" => ".",
                                       "1" => ".",
                                       "2" => " "
                                       ),

                     "Semicolon" => array (
                                           "0" => ".",
                                           "1" => ",",
                                           "2" => " "
                                           ),

                     "Percent" => array (
                                         "0" => "'/",
                                         "1" => "/,",
                                         "2" => "  "
                                         ),

                     "Plus" => array (
                                      "0" => "_|_",
                                      "1" => " ! ",
                                      "2" => "   "
                                      ),

                     "Minus" => array (
                                       "0" => "__",
                                       "1" => "  ",
                                       "2" => "  "
                                       ),

                     "Equal" => array (
                                       "0" => "--",
                                       "1" => "--",
                                       "2" => "  "
                                       ),

                     "Slash" => array (
                                       "0" => " /",
                                       "1" => "/ ",
                                       "2" => "  "
                                       ),

                     "BackSlash" => array (
                                           "0" => "\\ ",
                                           "1" => " \\",
                                           "2" => "  "
                                           ),

                     "One" => array (
                                     "0" => "'| ",
                                     "1" => ".|.",
                                     "2" => "   "
                                     ),

                     "Two" => array (
                                     "0" => "'~)",
                                     "1" => " /_",
                                     "2" => "   "
                                     ),

                     "Three" => array (
                                       "0" => "'~)",
                                       "1" => "._)",
                                       "2" => "   "
                                       ),

                     "Four" => array (
                                      "0" => "|_|",
                                      "1" => "  |",
                                      "2" => "   "
                                      ),

                     "Five" => array (
                                      "0" => "L~",
                                      "1" => "_)",
                                      "2" => "  "
                                      ),

                     "Six" => array (
                                     "0" => " / ",
                                     "1" => "(_)",
                                     "2" => "   "
                                     ),

                     "Seven" => array (
                                       "0" => "~/",
                                       "1" => "/ ",
                                       "2" => "  "
                                       ),

                     "Eight" => array (
                                       "0" => "(~)",
                                       "1" => "(_)",
                                       "2" => "   "
                                       ),

                     "Nine" => array (
                                      "0" => "(~)",
                                      "1" => " / ",
                                      "2" => "   "
                                      ),

                     "Zero" => array (
                                      "0" => "/X",
                                      "1" => "X/",
                                      "2" => "  "
                                      ),

                     "A" => array (
                                   "0" => " /\\ ",
                                   "1" => "/~~\\",
                                   "2" => "    "
                                   ),

                     "B" => array (
                                   "0" => "|~)",
                                   "1" => "|_)",
                                   "2" => "   "
                                   ),

                     "C" => array (
                                   "0" => "/~`",
                                   "1" => "\\_,",
                                   "2" => "   "
                                   ),

                     "D" => array (
                                   "0" => "|~\\",
                                   "1" => "|_/",
                                   "2" => "   "
                                   ),

                     "E" => array (
                                   "0" => "(~",
                                   "1" => "(_",
                                   "2" => "  "
                                   ),

                     "F" => array (
                                   "0" => "|~",
                                   "1" => "|~",
                                   "2" => "  "
                                   ),

                     "G" => array (
                                   "0" => "/~_",
                                   "1" => "\\_/",
                                   "2" => "   "
                                   ),

                     "H" => array (
                                   "0" => "|_|",
                                   "1" => "| |",
                                   "2" => "   "
                                   ),

                     "I" => array (
                                   "0" => "~|~",
                                   "1" => "_|_",
                                   "2" => "   "
                                   ),

                     "J" => array (
                                   "0" => "~|~",
                                   "1" => "L| ",
                                   "2" => "   "
                                   ),

                     "K" => array (
                                   "0" => "|/",
                                   "1" => "|\\",
                                   "2" => "  "
                                   ),

                     "L" => array (
                                   "0" => "| ",
                                   "1" => "|_",
                                   "2" => "  "
                                   ),

                     "M" => array (
                                   "0" => "|\\/|",
                                   "1" => "|  |",
                                   "2" => "    "
                                   ),

                     "N" => array (
                                   "0" => "|\\ |",
                                   "1" => "| \\|",
                                   "2" => "    "
                                   ),

                     "O" => array (
                                   "0" => "/~\\",
                                   "1" => "\\_/",
                                   "2" => "   "
                                   ),

                     "P" => array (
                                   "0" => "|~)",
                                   "1" => "|~ ",
                                   "2" => "   "
                                   ),

                     "Q" => array (
                                   "0" => "/~\\",
                                   "1" => "\\_X",
                                   "2" => "   "
                                   ),

                     "R" => array (
                                   "0" => "|~)",
                                   "1" => "|~\\",
                                   "2" => "   "
                                   ),

                     "S" => array (
                                   "0" => "(~",
                                   "1" => "_)",
                                   "2" => "  "
                                   ),

                     "T" => array (
                                   "0" => "~|~",
                                   "1" => " | ",
                                   "2" => "   "
                                   ),

                     "U" => array (
                                   "0" => "| |",
                                   "1" => "|_|",
                                   "2" => "   "
                                   ),

                     "V" => array (
                                   "0" => "\\  /",
                                   "1" => " \\/ ",
                                   "2" => "    "
                                   ),

                     "W" => array (
                                   "0" => "\\    /",
                                   "1" => " \\/\\/ ",
                                   "2" => "      "
                                   ),

                     "X" => array (
                                   "0" => "\\/",
                                   "1" => "/\\",
                                   "2" => "  "
                                   ),

                     "Y" => array (
                                   "0" => "\\ /",
                                   "1" => " | ",
                                   "2" => "   "
                                   ),

                     "Z" => array (
                                   "0" => "~/ ",
                                   "1" => "/_ ",
                                   "2" => "   "
                                   ),

                     "a" => array (
                                   "0" => " _ ",
                                   "1" => "(_|",
                                   "2" => "   "
                                   ),

                     "b" => array (
                                   "0" => "|_ ",
                                   "1" => "|_)",
                                   "2" => "   "
                                   ),

                     "c" => array (
                                   "0" => " _",
                                   "1" => "(_",
                                   "2" => "  "
                                   ),

                     "d" => array (
                                   "0" => " _|",
                                   "1" => "(_|",
                                   "2" => "   "
                                   ),

                     "e" => array (
                                   "0" => " _ ",
                                   "1" => "(/_",
                                   "2" => "   "
                                   ),

                     "f" => array (
                                   "0" => " |`",
                                   "1" => "~|~",
                                   "2" => "   "
                                   ),

                     "g" => array (
                                   "0" => " _ ",
                                   "1" => "(_|",
                                   "2" => " _|"
                                   ),

                     "h" => array (
                                   "0" => "|_ ",
                                   "1" => "| |",
                                   "2" => "   "
                                   ),

                     "i" => array (
                                   "0" => ".",
                                   "1" => "|",
                                   "2" => " "
                                   ),

                     "j" => array (
                                   "0" => " .",
                                   "1" => " |",
                                   "2" => "L|"

                                   ),

                     "k" => array (
                                   "0" => "| ",
                                   "1" => "|<",
                                   "2" => "  "
                                   ),

                     "l" => array (
                                   "0" => "|",
                                   "1" => "|",
                                   "2" => " "
                                   ),

                     "m" => array (
                                   "0" => " _ _ ",
                                   "1" => "| | |",
                                   "2" => "     "
                                   ),

                     "n" => array (
                                   "0" => " _ ",
                                   "1" => "| |",
                                   "2" => "   "
                                   ),

                     "o" => array (
                                   "0" => " _ ",
                                   "1" => "(_)",
                                   "2" => "   "
                                   ),

                     "p" => array (
                                   "0" => " _ ",
                                   "1" => "|_)",
                                   "2" => "|  ",
                                   ),

                     "q" => array (
                                   "0" => " _  ",
                                   "1" => "(_| ",
                                   "2" => "  |/"
                                   ),

                     "r" => array (
                                   "0" => " _",
                                   "1" => "| ",
                                   "2" => "  "
                                   ),

                     "s" => array (
                                   "0" => " _",
                                   "1" => "_\\",
                                   "2" => "  "
                                   ),

                     "t" => array (
                                   "0" => "_|_",
                                   "1" => " | ",
                                   "2" => "   "
                                   ),

                     "u" => array (
                                   "0" => "   ",
                                   "1" => "|_|",
                                   "2" => "   "
                                   ),

                     "v" => array (
                                   "0" => "  ",
                                   "1" => "\\/",
                                   "2" => "  "
                                   ),

                     "w" => array (
                                   "0" => "  ",
                                   "1" => "VV",
                                   "2" => "  "
                                   ),

                     "x" => array (
                                   "0" => "  ",
                                   "1" => "><",
                                   "2" => "  "
                                   ),

                     "y" => array (
                                   "0" => "  ",
                                   "1" => "\\/",
                                   "2" => "/ "
                                   ),

                     "z" => array (
                                   "0" => "_ ",
                                   "1" => "/_",
                                   "2" => "  "
                                   )
                     );

?>
