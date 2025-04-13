<?php

namespace App\Enum\Payment;

enum PaymentMethodEnum: string
{
    case CASH = 'cash';
    case CREDIT_CARD = 'credit_card';
    case DEBIT_CARD = 'debit_card';
    case BANK_TRANSFER = 'bank_transfer';
    case PAYPAL= 'paypal';


    /**
     * Return the name of the Enum.
     */
    public function name(): string
    {
        return match ($this) {
            self::CASH => 'Efectivo',
            self::CREDIT_CARD => 'Tarjeta de crédito',
            self::DEBIT_CARD => 'Tarjeta de débito',
            self::BANK_TRANSFER => 'Transferencia bancaria',
            self::PAYPAL => 'PayPal',
        };
    }

     /**
     * Returns an array of all possible values of this Enum (name-value).
     */
    public static function list(): array
    {
        $enumValuesArray = array_map(
            fn ($enumValue) => (object) ['name' => $enumValue->name(), 'value' => $enumValue->value],
            self::cases()
        );

        return $enumValuesArray;
    }

    /**
     * Returns an array of values of this Enum (value).
     */
    public static function values(): array
    {
        $enumValuesArray = array_map(
            fn ($enumValue) => $enumValue->value,
            self::cases()
        );

        return $enumValuesArray;
    }
}
