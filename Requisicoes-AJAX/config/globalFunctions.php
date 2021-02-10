<?php

if (! function_exists('url')) {
    function url(string $uri = null): string
    {
        if ($uri) {
            return URL_BASE . "/{$uri}";
        }
        return URL_BASE;
    }
}

if (! function_exists('message')) {
    function message(string $message, string $type): string
    {
        return "<div class='message {$type}'>{$message}</div>";
    }
}

if (! function_exists('mascara')) {
    function mascara($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
}

if (! function_exists('data_br_para_iso')) {
    function data_br_para_iso($data)
    {
        return \DateTime::createFromFormat('d/m/Y', $data)
            ->format('Y-m-d');
    }
}

if (! function_exists('data_iso_para_br')) {
    function data_iso_para_br($data)
    {
        return (new DateTime($data))->format('d/m/Y');
    }
}

if (! function_exists('numero_iso_para_br')) {
    function numero_iso_para_br($valor)
    {
        return number_format($valor, '2', ',', '.');
    }
}

if (! function_exists('numero_br_para_iso')) {
    function numero_br_para_iso($valor)
    {
        return \str_replace(['.', ','], ['', '.'], $valor);
    }
}