<?php

if (!function_exists('cod')) {

    /** Retorna o codigo de uma string */
    function cod($string)
    {
        return \elegance\Cod::_def_()->on($string);
    }

}

if (!function_exists('cod_on')) {

    /** Retorna o codigo de uma string */
    function cod_on($string)
    {
        return \elegance\Cod::_def_()->on($string);
    }

}

if (!function_exists('cod_off')) {

    /** Retonra o MD5 usado para gerar uma string codificada */
    function cod_off($string)
    {
        return \elegance\Cod::_def_()->off($string);
    }

}

if (!function_exists('cod_check')) {

    /** Verifica se uma string é uma string codificada */
    function cod_check($string)
    {
        return \elegance\Cod::_def_()->check($string);
    }

}

if (!function_exists('cod_compare')) {

    /** Verifica se duas strings tem a mesma string codificada */
    function cod_compare($string, $compare)
    {
        return \elegance\Cod::_def_()->compare($string, $compare);
    }

}

if (!function_exists('is_cod')) {

    /** Verifica se uma string é uma string codificada */
    function is_cod($string)
    {
        return \elegance\Cod::_def_()->check($string);
    }

}
