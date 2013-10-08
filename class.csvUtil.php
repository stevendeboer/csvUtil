<?php
// ##################################################################################
// Title                     : Class csvUtil
// Version                   : 1.0
// Author                    : Steven de Boer
// Last modification date    : 04-06-2003
// Description               : Print and search contents of CSV files.
// ##################################################################################
// History:
// 06-13-2002                : First version of this class.
// ##################################################################################

class csvUtil {
        ###############
        # Constructor #
        ###############
        function csvUtil($file, $separator) {
                $this->file = $file;
                $this->separator = $separator;
                $this->readArray();
        }

        ########################################################
        # readArray(): reads $this->file with $this->separator #
        #            and stores its content in an array        #
        ########################################################
        function readArray() {
                $handle = fopen ($this->file, "r");
                $i = 0;
                do {
                        $this->buffer[$i] = fgets($handle);
                        $this->buffer[$i] = explode($this->separator, $this->buffer[$i]);
                        $i++;
                } while (!feof ($handle));
                fclose ($handle);
        }

        ####################################################################
        # getField($row, $col): find and return content of a give position #
        ####################################################################
        function getField($row, $col) {
                $retval = $this->buffer[$row][$col];
                return $retval;
        }

        #################################################################
        # search($col, $expression): search for a value in given column #
        #                            returns an array with found rows   #
        #################################################################
        function search($col, $expression) {
                $i = 0;
                $j = 0;
                do {
                        if (@eregi($expression,$this->buffer[$i][$col])) {
                                $retval[$j] = $i;
                                $j++;
                        }
                        $i++;
                } while ($this->buffer[$i][0]);

                return $retval;
        }

        #####################################
        # numRows(): returns number of rows #
        #####################################
        function numRows() {
                $retval = count($this->buffer);
                return $retval;
        }

        #####################################
        # numCols(): returns number of cols #
        #####################################
        function numCols() {
                $retval = count($this->buffer[0]);
                return $retval;
        }
}

?>