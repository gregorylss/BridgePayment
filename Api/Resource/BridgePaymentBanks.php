<?php

namespace BridgePayment\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use BridgePayment\Api\Provider\BridgePaymentBanksProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: 'front/bridge-payment/banks',
            paginationEnabled: true,
            provider: BridgePaymentBanksProvider::class,
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_READ_FRONT]]
)]
class BridgePaymentBanks
{
    public const GROUP_READ_FRONT = 'front:bridge_payment_banks:read';

    #[Groups(self::GROUP_READ_FRONT)]
    private ?string $id = null;

    #[Groups(self::GROUP_READ_FRONT)]
    private ?string $name = null;

    #[Groups(self::GROUP_READ_FRONT)]
    private ?string $logoUrl = null;

    #[Groups(self::GROUP_READ_FRONT)]
    private ?string $parentName = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    public function setParentName(?string $parentName): self
    {
        $this->parentName = $parentName;
        return $this;
    }
}
