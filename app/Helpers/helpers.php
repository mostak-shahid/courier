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