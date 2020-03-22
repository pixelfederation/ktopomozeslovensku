<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account\Serializer;

use App\Service\Account\Model\Transaction;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;

/**
 *
 */
final class TransactionType implements SubscribingHandlerInterface
{
    /** @var array  */
    private const COLUMN_MAPPING = [
        'column0' => 'date',
        'column2' => 'offsetAccountNumber',
        'column10' => 'offsetAccountName',
        'column12' => 'bankName',
        'column7' => 'userIdentification',
        'column16' => 'message',
        'column1' => 'amount',
        'column17' => 'executionId',
        'column22' => 'transactionId'
    ];

    /**
     * @return array|void
     */
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'Transaction',
                'method' => 'deserialize',
            ],
        ];
    }

    /**
     * @param JsonDeserializationVisitor $visitor
     * @param array$data
     * @param array $type
     * @param Context $context
     *
     * @return Transaction
     */
    public function deserialize(JsonDeserializationVisitor $visitor, array $data, array $type, Context $context): Transaction
    {
        $filteredItems = array_filter($data, static function (string $key) {
            return isset(self::COLUMN_MAPPING[$key]);
        }, ARRAY_FILTER_USE_KEY);

        $normalizedItems = [];
        foreach ($filteredItems ?: [] as $key => $item) {
            $fieldName = self::COLUMN_MAPPING[$key];
            $normalizedItems[$fieldName] = $item['value'];
        }

        /** @var Transaction $result */
        $result = $context->getNavigator()->accept($normalizedItems, ['name' => Transaction::class]);

        return $result;
    }
}
