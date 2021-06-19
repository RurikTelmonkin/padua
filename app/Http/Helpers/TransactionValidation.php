<?php

namespace App\Http\Helpers;

use DateTime;

class TransactionValidation
{
    public array $validChars = [
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'J',
        'K',
        'L',
        'M',
        'N',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z'
    ];

    public function verifyKey(string $key): bool
    {
        if (strlen($key) != 10) {
            return false;
        }
        $checkDigit = $this->generateCheckCharacter(substr(strtoupper($key), 0, 10));
        return $key[9] == $checkDigit;
    }

    public function generateCheckCharacter(string $input): string
    {
        $factor = 2;
        $sum = 0;
        $validCharacterCount = count($this->validChars);
        $inputArray = str_split($input);
        for ($i = count($inputArray) - 1; $i >= 0; $i--) {
            $codePoint = (int)array_search($inputArray[$i], $this->validChars);
            $addEnd = (int)($factor * $codePoint);
            $factor = ($factor == 2) ? 1 : 2;
            $addEnd = (int)($addEnd / $validCharacterCount) + (int)($addEnd % $validCharacterCount);
            $sum += $addEnd;
        }
        $remainder = ($sum % $validCharacterCount);
        $checkCodePoint = (($validCharacterCount - $remainder) % $validCharacterCount);
        return $this->validChars[$checkCodePoint];
    }

    public function validateCsvRecord($csv)
    {
        if (!isset($csv[0])) {
            return false;
        }
        $d = DateTime::createFromFormat('Y-m-d h:iA', $csv[0]);
        if (!$d || $d->format('Y-m-d h:iA') != $csv[0]) {
            return false;
        }
        if (!isset($csv[1]) || strlen($csv[1]) != 10) {
            return false;
        }
        if (!isset($csv[2])) {
            return false;
        }
        $customerNumber = intval($csv[2]);
        if ($customerNumber != $csv[2]) {
            return false;
        }
        if (!isset($csv[3])) {
            return false;
        }
        if (!isset($csv[4]) || !is_numeric($csv[4])) {
            return false;
        }
        return true;
    }
}
