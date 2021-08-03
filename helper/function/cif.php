<?php

if (!function_exists('cif')) {

    /**
     * Retorna a cifra de uma string
     * (não cifra strings iniciadas ou terminadas em "-")
     * @param string $string Texto que deve ser cifrado
     * @param string $char Caracter que deve ser utilizado na cifra (a~a ou A~Z ou 0~9)
     * @return string Texto cifrado
     */
    function cif($string, $char = null)
    {
        return \elegance\Cif::_def_()->on($string, $char);
    }

}

if (!function_exists('cif_on')) {

    /**
     * Retorna a cifra de uma string
     * (não cifra strings iniciadas ou terminadas em "-")
     * @param string $string Texto que deve ser cifrado
     * @param string $char Caracter que deve ser utilizado na cifra (a~a ou A~Z ou 0~9)
     * @return string Texto cifrado
     */
    function cif_on($string, $char = null)
    {
        return \elegance\Cif::_def_()->on($string, $char);
    }

}

if (!function_exists('cif_off')) {

    /**
     * Retorna a string de uma cifra
     * (apenas remove cifra de strings iniciadas e terminadas em
     * @param string $string Texto que deve ter a cifra removida
     * @return string Texto decifrado
     */
    function cif_off($string)
    {
        return \elegance\Cif::_def_()->off($string);
    }

}

if (!function_exists('cif_check')) {

    /** Verifica se uma string atende os requisitos para ser uma cifra */
    function cif_check($string)
    {
        return \elegance\Cif::_def_()->check($string);
    }

}

if (!function_exists('cif_compare')) {

    /** Verifica se duas strings decifradas são iguais */
    function cif_compare($string, $compare)
    {
        return \elegance\Cif::_def_()->compare($string, $compare);
    }

}

if (!function_exists('is_cif')) {

    /** Verifica se uma string atende os requisitos para ser uma cifra */
    function is_cif($string)
    {
        return \elegance\Cif::_def_()->check($string);
    }

}
