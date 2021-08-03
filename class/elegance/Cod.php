<?php

namespace elegance;

class Cod
{
    protected $preKey;
    protected $posKey;
    protected $key;

    public function __construct($stringKey = null)
    {
        $baseChar  = 'MXSIQJNGPLVOUYTWRH';
        $stringKey = $stringKey ?? '';
        $stringKey = toCase_upper($stringKey);
        $stringKey = char_only($stringKey, $baseChar);
        $stringKey = str_split($stringKey);
        $key       = '';
        while (strlen($key) < 18 && count($stringKey)) {
            $char = array_shift($stringKey);
            if ($key == '' || !substr_count($key, $char)) {
                $key .= $char;
                $baseChar = str_replace($char, '', $baseChar);
            }
        }
        $key          = substr("$key$baseChar", 0, 18);
        $this->preKey = substr($key, 0, 1);
        $this->posKey = substr($key, 1, 1);
        $this->key    = str_split(substr($key, 2));
    }

    /** Retorna o codigo de uma string */
    public function on($string)
    {
        if (!$this->check($string)) {
            $string = is_md5($string) ? $string : md5($string);
            $in     = str_split('1234567890abcdef');
            $out    = $this->key;
            $string = str_replace($in, $out, $string);
            $string = $this->preKey . $string . $this->posKey;
        }
        return $string;
    }

    /** Retonra o MD5 usado para gerar uma string codificada */
    public function off($string)
    {
        if ($this->check($string)) {
            $in     = str_split('1234567890abcdef');
            $out    = $this->key;
            $string = str_replace($out, $in, substr($string, 1, -1));
        } else if (!is_md5($string)) {
            $string = md5($string);
        }
        return $string;
    }

    /** Verifica se uma string é uma string codificada */
    public function check($string)
    {
        return boolval(
            is_string($string) &&
            strlen($string) == 34 &&
            substr($string, 0, 1) == $this->preKey &&
            substr($string, -1) == $this->posKey &&
            empty(str_replace($this->key, '', substr($string, 1, -1)))
        );
    }

    /** Verifica se duas strings tem a mesma string codificada */
    public function compare($string, $compare)
    {
        return boolval($this->off($string) == $this->off($compare));
    }

    #==| Objeto padrão |==#

    protected static $_def_;

    /**
     * Retorna o objeto padrão de codificação
     * @return Cod
     */
    public static function _def_()
    {
        if (func_num_args()) {
            $cif = func_get_arg(0);
            if (is_object($cif)) {
                static::$_def_ = $cif;
            } else {
                static::$_def_ = new Cod($cif);
            }
        }
        static::$_def_ = static::$_def_ ?? new Cod();
        return static::$_def_;
    }
}
