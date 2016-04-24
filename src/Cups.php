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

        $numbers = substr($cups, 2, 16);

        if(preg_match_all('/^[A-Z]{2}\d{16}[A-Z]{2}(\d[FPCX])?$/', $cups)) {
            $module = ($numbers % 529);
            $check = $module / 23;
            $check2 = $module % 23;
            $checkLetter = Cups::getControlNumbers($check);
            $checkLetter2 = Cups::getControlNumbers($check2);
            $controlLetter1 =  substr($cups, 18, 1);
            $controlLetter2 =  substr($cups, 19, 1);

            if ($checkLetter === $controlLetter1 && $checkLetter2 === $controlLetter2) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retorna array with control
     *
     * @return string
     */
    private static function getControlNumbers($id)
    {
        $controls = array(
            0 => 'T',
            1 => 'R',
            2 => 'W',
            3 => 'A',
            4 => 'G',
            5 => 'M',
            6 => 'Y',
            7 => 'F',
            8 => 'P',
            9 => 'D',
            10 => 'X',
            11 => 'B',
            12 => 'N',
            13 => 'J',
            14 => 'Z',
            15 => 'S',
            16 => 'Q',
            17 => 'V',
            18 => 'H',
            19 => 'L',
            20 => 'C',
            21 => 'K',
            22 => 'E',
        );

        return $controls[(int)$id];
    }
}
