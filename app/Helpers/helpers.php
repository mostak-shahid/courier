<?php
if (!function_exists('get_option')) {
    function get_option($dataSource, $option){
        if (@$dataSource){
            foreach($dataSource as $data) :
                if($data['key'] == $option) :
                    if (is_serialized($data['value']))
                        return unserialize($data['value']);
                    return $data['value'];
                endif;
            endforeach;
        }
        return false;
    }
}
if (!function_exists('is_serialized')) {
    function is_serialized( $data, $strict = true ) {
        // If it isn't a string, it isn't serialized.
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' == $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false === $semicolon && false === $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== substr( $data, -2, 1 ) ) {
                        return false;
                    }
                } elseif ( false === strpos( $data, '"' ) ) {
                    return false;
                }
            // Or else fall through.
            case 'a':
            case 'O':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
        }
        return false;
    }
}
if (!function_exists('is_url')) {
    function is_url($data){
        if(filter_var($data, FILTER_VALIDATE_URL) === TRUE)
        {
            return true;
        }
        return false;
    }
}
if (!function_exists('maybe_serialize')) {
    function maybe_serialize($data)
    {
        if (is_array($data) || is_object($data)) {
            return serialize($data);
        }
        if (is_serialized($data, false)) {
            return serialize($data);
        }
        return $data;
    }
}
if (!function_exists('maybe_unserialize')) {
    function maybe_unserialize( $data ) {
        if ( is_serialized( $data ) ) {
            return @unserialize( trim( $data ) );
        }
        return $data;
    }
}
if (!function_exists('mos_trim_words')) {
    function mos_trim_words($text, $num_words = 55, $more = null)
    {
        if (null === $more) {
            $more = __('&hellip;');
        }

        $original_text = $text;
        $text = mos_strip_all_tags($text);
        $num_words = (int)$num_words;

        /*
         * translators: If your word count is based on single characters (e.g. East Asian characters),
         * enter 'characters_excluding_spaces' or 'characters_including_spaces'. Otherwise, enter 'words'.
         * Do not translate into your own language.
         */

        $words_array = preg_split("/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY);
        $sep = ' ';


        if (count($words_array) > $num_words) {
            array_pop($words_array);
            $text = implode($sep, $words_array);
            $text = $text . $more;
        } else {
            $text = implode($sep, $words_array);
        }
        return $text;
    }
}
if (!function_exists('mos_strip_all_tags')) {
    function mos_strip_all_tags($string, $remove_breaks = false)
    {
        $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
        $string = strip_tags($string);

        if ($remove_breaks) {
            $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
        }

        return trim($string);
    }
}
function mos_date_difference($future_date = NULL, $past_date, $format='full')
{
    if (!$future_date) $future_date= date("Y-m-d H:i:s");
    $theDiff="";
    //echo $future_date;//2014-06-06 21:35:55
    $datetime1 = date_create($past_date);
    $datetime2 = date_create($future_date);
    $interval = date_diff($datetime1, $datetime2);
    //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
    $min=$interval->format('%i');
    $sec=$interval->format('%s');
    $hour=$interval->format('%h');
    $mon=$interval->format('%m');
    $day=$interval->format('%d');
    $year=$interval->format('%y');
    if ($format=='full') {
        if ($interval->format('%i%h%d%m%y') == "00000") {
            //echo $interval->format('%i%h%d%m%y')."<br>";
            return $sec . " Seconds";
        } else if ($interval->format('%h%d%m%y') == "0000") {
            return $min . " Minutes";
        } else if ($interval->format('%d%m%y') == "000") {
            return $hour . " Hours";
        } else if ($interval->format('%m%y') == "00") {
            return $day . " Days";
        } else if ($interval->format('%y') == "0") {
            return $mon . " Months";
        } else {
            return $year . " Years";
        }
    } else {
        if ($interval->format('%i%h%d%m%y') == "00000") {
            //echo $interval->format('%i%h%d%m%y')."<br>";
            return "Seconds";
        } else if ($interval->format('%h%d%m%y') == "0000") {
            return "Minutes";
        } else if ($interval->format('%d%m%y') == "000") {
            return "Hours";
        } else if ($interval->format('%m%y') == "00") {
            return "Days";
        } else if ($interval->format('%y') == "0") {
            return "Months";
        } else {
            return "Years";
        }

    }
}