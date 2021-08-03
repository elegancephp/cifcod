<?php

namespace elegance;

class Cif
{

    const BASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    protected $cif;
    protected $ensure;
    protected $currentKey = null;

    public function __construct($crt = null)
    {
        $crt = $crt ?? '';
        File::ensure_extension($crt, 'crt');
        $crt = path($crt);
        if (!File::check($crt)) {
            $crt = dirname(__DIR__, 2) . '/library/certificate/base.crt';
        }
        $crt          = path($crt);
        $content      = Import::content($crt);
        $this->cif    = explode("\n", $content);
        $this->ensure = str_split(array_pop($this->cif));
    }

    /**
     * Retorna a cifra de uma string
     * (não cifra strings iniciadas ou terminadas em "-")
     * @param string $string Texto que deve ser cifrado
     * @param string $char Caracter que deve ser utilizado na cifra (a~a ou A~Z ou 0~9)
     * @return string Texto cifrado
     */
    public function on($string, $key = null)
    {
        if (is_null($string) || $this->check($string)) {
            return $string;
        }

        $key = $key ?? env('cifKey', null);
        $key = ($key !== null) ? $this->get_key_char(substr("$key", 0, 1)) : $this->get_key();

        $string = strrev(str_replace('=', '', base64_encode($string)));

        $string = $this->replace($string, self::BASE, $this->cif[$key]);

        return '-' . $this->get_char_key($key) . $string . $this->get_char_key($key, true) . '-';
    }

    /**
     * Retorna a string de uma cifra
     * (apenas remove cifra de strings iniciadas e terminadas em
     * @param string $string Texto que deve ter a cifra removida
     * @return string Texto decifrado
     */
    public function off($string)
    {
        if (is_null($string) || !$this->check($string)) {
            return $string;
        }

        $key    = $this->get_key_char(substr($string, 1, 1));
        $string = substr($string, 2, -2);

        $string = $this->replace($string, $this->cif[$key], self::BASE);
        $string = base64_decode(strrev($string));
        return $string;
    }

    /** Verifica se uma string atende os requisitos para ser uma cifra */
    public function check($string)
    {
        if (substr($string, 0, 1) == '-') {
            if (substr($string, -1) == '-') {
                $key = $this->get_key_char(substr($string, 1, 1));
                return substr($string, -2, 1) == $this->get_char_key($key, true);
            }
        }
        return false;
    }

    /** Verifica se duas strings decifradas são iguais */
    public function compare($string, $compare)
    {
        return boolval($this->off($string) == $this->off($compare));
    }

    #==| Funcionamento |==#

    /** Realiza o replace interno de uma string */
    protected function replace($string, $in, $out)
    {
        for ($i = 0; $i < strlen($string); $i++) {
            if (strpos($in, $string[$i]) !== false) {
                $string[$i] = $out[strpos($in, $string[$i])];
            }
        }

        return $string;
    }

    /** Retorna uma chave */
    protected function get_key($random = true)
    {
        if ($random) {
            return random_int(0, 61);
        } else {
            $this->currentKey = $this->currentKey ?? random_int(0, 61);
            return $this->currentKey;
        }
    }

    /** Retorna a chave de um caracter */
    protected function get_key_char($char)
    {
        return array_flip($this->ensure)[$char] ?? 0;
    }

    /** Retorna o caracter de uma chave */
    protected function get_char_key($key, $inverse = false)
    {
        $key = $inverse ? 61 - $key : $key;
        $key = $this->ensure[$key] ?? 0;
        return $key;
    }

    #==| Objeto padrão |==#

    protected static $_def_;

    /**
     * Retorna o objeto padrão de cifra
     * @return Cif
     */
    public static function _def_()
    {
        if (func_num_args()) {
            $cif = func_get_arg(0);
            if (is_object($cif)) {
                static::$_def_ = $cif;
            } else {
                static::$_def_ = new Cif($cif);
            }
        }
        static::$_def_ = static::$_def_ ?? new Cif();
        return static::$_def_;
    }
}
