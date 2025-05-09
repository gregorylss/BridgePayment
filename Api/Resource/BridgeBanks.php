<?php

namespace BridgePayment\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use BridgePayment\Api\Provider\BridgeProvider;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/banks',
            provider: BridgeProvider::class,
            paginationEnabled: false,
            openapiContext: [
                'parameters' => [
                    [
                        'name' => 'search',
                        'in' => 'query',
                        'required' => false,
                        'schema' => ['type' => 'string'],
                        'description' => 'Filtrer les banques par nom'
                    ],
                ]
            ]
        ),
    ],
    normalizationContext: ['groups' => ['bank:read']]
)]
class BridgeBanks
{
    #[Groups(['bank:read'])]
    private ?string $id = null;

    #[Groups(['bank:read'])]
    private ?string $name = null;

    #[Groups(['bank:read'])]
    private ?string $logoUrl = null;

    #[Groups(['bank:read'])]
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
