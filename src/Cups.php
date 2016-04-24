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
    public static function validate($cups)
    {
        if (empty($cups)) {
            return false;
        }

        if (strlen($cups) === 22 || strlen($cups) === 20 ) {
            $countryISO = substr($cups, 0, 2);

            if (ctype_upper($countryISO)) {
                $numbers = substr($cups, 2, 14);

                if (is_numeric($numbers)) {
                    $control = substr($cups, 18, 2);

                    if (ctype_upper($control)) {
                        if (strlen($cups) === 22 ) {
                            $idFrontera =  substr($cups, 20, 1);

                            if (is_numeric($idFrontera)) {
                                $specialType = substr($cups, 20, 2);

                                if (preg_match('/[FPCX]/', $specialType)) {
                                    return true;
                                }
                            }
                        } else {
                            return true;
                        }
                    }
                }
            }

        }

        return false;
    }
}
