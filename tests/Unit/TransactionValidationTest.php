<?php

namespace Tests\Unit;

use App\Http\Helpers\TransactionValidation;
use PHPUnit\Framework\TestCase;

class TransactionValidationTest extends TestCase
{
    public TransactionValidation $transactionValidationHelper;

    public function setUp(): void
    {
        $this->transactionValidationHelper = new TransactionValidation();
        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_transaction_is_valid()
    {
        $this->assertTrue($this->transactionValidationHelper->verifyKey('S98EBHDWG3'));
    }

    public function test_transaction_is_invalid()
    {
        $this->assertFalse($this->transactionValidationHelper->verifyKey('NUF5V6PT3U'));
    }

    public function test_generate_character_check_returns_u()
    {
        $this->assertEquals('3', $this->transactionValidationHelper->generateCheckCharacter('S98EBHDWG3'));
    }
}
