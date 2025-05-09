<?php

namespace BridgePayment\Api\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use BridgePayment\Service\BankService;
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Model\Customer;

class BridgeProvider implements ProviderInterface
{
    private RequestStack $requestStack;
    private BankService $bankService;

    public function __construct(RequestStack $requestStack, BankService $bankService)
    {
        $this->requestStack = $requestStack;
        $this->bankService = $bankService;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        $search = $context['filters']['search'] ?? null;

        $session = $this->requestStack->getCurrentRequest()->getSession();
        /** @var Customer|null $sessionCustomer */
        $sessionCustomer = $session?->getCustomerUser();

        if (!$sessionCustomer) {
            return [];
        }

        $country = $sessionCustomer->getDefaultAddress()->getCountry();

        try {
            $banks = $this->bankService->getBanks($country->getIsoalpha2());
        } catch (\Exception $ex) {
            return [];
        }

        if ($search) {
            $banks = array_filter($banks, function ($bank) use ($search) {
                return stripos($bank['name'], $search) !== false;
            });
        }

        return array_map(function ($bank) {
            return [
                'id' => $bank['id'],
                'name' => $bank['name'],
                'logo_url' => $bank['logo_url'],
                'parent_name' => $bank['parent_name'] ?? '',
            ];
        }, $banks);
    }
}
