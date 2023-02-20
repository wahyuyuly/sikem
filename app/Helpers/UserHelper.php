<?php
    /**
     * Date formatter
     */
    if(!function_exists('dateFormat'))
    {
        function dateFormat($date)
        {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        }
    }

    /**
     * IDR currency format
     */
    if(!function_exists('idrFormat'))
    {
        function idrFormat($value)
        {
            $result = '-';
            if(!empty($value)) {
                $result = "Rp " . number_format($value, 0, ',', '.');
            }
	        return $result;
        }
    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $size
     * @param  integer $precision
     * @return integer
     */
    if(!function_exists('sizeHuman'))
    {
        function sizeHuman($size, $precision = 2)
        {
            if ($size > 0) {
                $size = (int) $size;
                $base = log($size) / log(1024);
                $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

                return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
            } else {
                return $size;
            }
        }
    }

    /**
     * Limit string by word
     *
     * @param  string $text
     * @param  integer $limit
     * @return string
     */
    if(!function_exists('limitText'))
    {
        function limitText($text, $limit)
        {
            if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos = array_keys($words);
                $text = substr($text, 0, $pos[$limit]);
            }
            return $text;
        }
    }

    /**
     * Convert number to roman
     */
    if(!function_exists('romawi'))
    {
        function romawi($num)
        {
            // Be sure to convert the given parameter into an integer
            $n = intval($num);
            $result = ''; 
        
            // Declare a lookup array that we will use to traverse the number: 
            $lookup = array(
                'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
                'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
                'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
            ); 
        
            foreach ($lookup as $roman => $value)  
            {
                // Look for number of matches
                $matches = intval($n / $value); 
        
                // Concatenate characters
                $result .= str_repeat($roman, $matches); 
        
                // Substract that from the number 
                $n = $n % $value; 
            } 

            return $result;
        }

        /**
         * Convert nomor to text
         */
        if(!function_exists('terbilang'))
        {
            function terbilang($bilangan) {

                $angka = array('0','0','0','0','0','0','0','0','0','0',
                               '0','0','0','0','0','0');
                $kata = array('','satu','dua','tiga','empat','lima',
                              'enam','tujuh','delapan','sembilan');
                $tingkat = array('','ribu','juta','milyar','triliun');
              
                $panjang_bilangan = strlen($bilangan);
              
                /* pengujian panjang bilangan */
                if ($panjang_bilangan > 15) {
                    $kalimat = "Diluar Batas";
                    return $kalimat;
                }
              
                /* mengambil angka-angka yang ada dalam bilangan,
                   dimasukkan ke dalam array */
                for ($i = 1; $i <= $panjang_bilangan; $i++) {
                    $angka[$i] = substr($bilangan,-($i),1);
                }
              
                $i = 1;
                $j = 0;
                $kalimat = "";
              
              
                /* mulai proses iterasi terhadap array angka */
                while ($i <= $panjang_bilangan) {
              
                    $subkalimat = "";
                    $kata1 = "";
                    $kata2 = "";
                    $kata3 = "";
              
                    /* untuk ratusan */
                    if ($angka[$i+2] != "0") {
                        if ($angka[$i+2] == "1") {
                            $kata1 = "seratus";
                        } else {
                            $kata1 = $kata[$angka[$i+2]] . " ratus";
                        }
                    }
              
                    /* untuk puluhan atau belasan */
                    if ($angka[$i+1] != "0") {
                        if ($angka[$i+1] == "1") {
                            if ($angka[$i] == "0") {
                                $kata2 = "sepuluh";
                            } elseif ($angka[$i] == "1") {
                                $kata2 = "sebelas";
                            } else {
                                $kata2 = $kata[$angka[$i]] . " belas";
                            }
                        } else {
                            $kata2 = $kata[$angka[$i+1]] . " puluh";
                        }
                    }
              
                    /* untuk satuan */
                    if ($angka[$i] != "0") {
                        if ($angka[$i+1] != "1") {
                            $kata3 = $kata[$angka[$i]];
                        }
                    }
              
                    /* pengujian angka apakah tidak nol semua,
                        lalu ditambahkan tingkat */
                    if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
                        ($angka[$i+2] != "0")) {
                        $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
                    }
              
                    /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
                     ke variabel kalimat */
                    $kalimat = $subkalimat . $kalimat;
                    $i = $i + 3;
                    $j = $j + 1;
              
                }
              
                /* mengganti satu ribu jadi seribu jika diperlukan */
                if (($angka[5] == "0") AND ($angka[6] == "0")) {
                    $kalimat = str_replace("satu ribu","seribu",$kalimat);
                }
              
                return trim($kalimat);              
            } 
        }
    }