<?php

namespace App\Util;

use Symfony\Component\Form\FormInterface;

class Util
{
    /**
     * @param FormInterface $form
     *
     * @return null|string
     */
    public static function getFirstFormError(FormInterface $form): ?string
    {
        $errors = [];

        foreach ($form->all() as $child) {
            if ($err = $form->getErrors($child)) {
                $errors[] = $err;
                break;
            }
        }

        if (\count($errors)) {
            return $errors[0]->current()->getMessage();
        }

        return null;
    }
}
