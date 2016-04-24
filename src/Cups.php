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
                $numbers = substr($cups, 2, 16);

                if (is_numeric($numbers)) {
                    $control = substr($cups, 18, 2);

                    if (ctype_upper($control)) {
                        if (strlen($cups) === 22 ) {
                            $idFrontera =  substr($cups, 20, 1);

                            if (is_numeric($idFrontera)) {
                                $specialType = substr($cups, 20, 2);

                                if (preg_match('/[FPCX]/', $specialType)) {
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
