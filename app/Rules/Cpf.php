<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = preg_replace("/\D+/", "", $value); // Limpa máscara ( se houver )

        $digitsPattern = '/\d{11}/'; // Regex Padrão de 11 dígitos numéricos
        $repeatPattern = '/(\d)\1{10}/'; // regex Padrões repetidos: 00000000000 11111111111 etc

        if (!preg_match($digitsPattern, $value) // Padrão diferente de 11 digitos numéricos
            || preg_match($repeatPattern, $value)  // Capturou sequencia
            || strlen($value) > 11) { // mais de 11 digitos
            $fail('O formato do CPF informado não é válido.');
            return;
        }

        $body = substr($value, 0, 9);

        // Dígitos verificadores
        for ($pass = 0; $pass < 2; $pass++) {
            $result = 0;
            for ($i = 0; $i < strlen($body); $i++) {
                $result += $body[$i] * (10 + $pass - $i);
            }
            $rest = $result % 11 ? 11 - ($result % 11) : 0;
            $body .= $rest === 10 ? 0 : $rest;
        }

        if ($body !== $value) {
            $fail('O número do CPF informado não é válido.');
        }
    }
}
