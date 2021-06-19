<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TransactionValidation;
use App\Models\Transaction;
use DateTime;

class CsvController
{
    public function index()
    {
        $results = [];
        return view('welcome', [
            'results' => $results,
        ]);
    }

    public function uploadFile()
    {
        $results = [];
        $data = [];
        if (request()->file('csv')) {
            $file = request()->file('csv');
            $handler = fopen($file->getPathname(), 'r');
            while ($csv = fgetcsv($handler)) {
                $data[] = $csv;
            }
            fclose($handler);
            array_shift($data);

            $transactionValidationHelper = new TransactionValidation();
            foreach ($data as $datum) {
                $csvValid = $transactionValidationHelper->validateCsvRecord($datum);
                $transaction = new Transaction();
                $transaction->setDate($datum[0])
                    ->setTransactionCode($datum[1])
                    ->setCustomerNumber($datum[2])
                    ->setReference($datum[3])
                    ->setAmount($datum[4] / 100)
                    ->setValid(($transactionValidationHelper->verifyKey($datum[1]) && $csvValid) ? 'Yes' : 'No');
                $results[] = $transaction;
            }
            usort($results, function ($a, $b) {
                /* @var $a Transaction */
                /* @var $b Transaction */
                $aDate = DateTime::createFromFormat('Y-m-d h:iA', $a->getDate());
                $bDate = DateTime::createFromFormat('Y-m-d h:iA', $b->getDate());
                return $aDate > $bDate;
            });
        }

        return view('welcome', [
            'results' => $results,
        ]);
    }
}
