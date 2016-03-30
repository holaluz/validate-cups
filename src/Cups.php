<?php

namespace CupsValidate;

/**
 * Class Cups
 *
 * El CUPS (Código Unificado del Punto de Suministro), en España, es un código 
 * único e identificador de un punto de suministro de energía, ya sea de electricidad
 * o gas canalizado.
 *
 * @link https://es.wikipedia.org/wiki/C%C3%B3digo_Unificado_de_Punto_de_Suministro
 */
class Cups
{
    /**
     * CUPS validation.
     *
     * @param string $cups The CUPS
     *
     * @return bool
     */
    public static function validate($cups = true)
    {
        return $cups;
    }
}
