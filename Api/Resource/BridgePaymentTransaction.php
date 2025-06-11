<?php

namespace BridgePayment\Api\Resource;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use BridgePayment\Model\Map\BridgePaymentTransactionTableMap;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\Filter\SearchFilter;
use Thelia\Api\Bridge\Propel\State\PropelCollectionProvider;
use Thelia\Api\Resource\PropelResourceInterface;
use Thelia\Api\Resource\PropelResourceTrait;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: 'admin/bridge-payment/transactions',
            paginationEnabled: true,
            provider: PropelCollectionProvider::class,
        ),

    ],
    normalizationContext: ['groups' => [self::GROUP_READ_ADMIN]]
)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: 'front/bridge-payment/transactions',
            paginationEnabled: true,
            provider: PropelCollectionProvider::class,
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_READ_FRONT]]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'orderId' => 'exact',
        'paymentLinkId' => 'exact',
    ]
)]
class BridgePaymentTransaction implements PropelResourceInterface
{
    public const GROUP_READ_ADMIN = 'admin:bridge_payment_transaction:read';
    public const GROUP_READ_FRONT = 'front:bridge_payment_transaction:read';

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $id = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $uuid = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $status = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $orderId = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $statusReason = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?float $amount = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $paymentLinkId = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?string $paymentRequestId = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?\DateTimeInterface $timestamp = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?\DateTimeInterface $createdAt = null;

    #[Groups([self::GROUP_READ_ADMIN])]
    private ?\DateTimeInterface $updatedAt = null;

    use PropelResourceTrait;

    /**
     * @throws PropelException
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return BridgePaymentTransactionTableMap::getTableMap();
    }
}
