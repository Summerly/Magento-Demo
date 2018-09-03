<?php

namespace Vendor\Module\Plugin;

use Magento\Customer\Model\Session;
use Magento\Store\Api\StoreCookieManagerInterface;
use Magento\Store\Api\StoreRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class SetDefaultLanguage
{
    protected $storeManager;
    protected $customerSession;
    protected $storeRepository;
    protected $cookieManager;
    protected $logger;

    public function __construct(StoreManagerInterface $storeManager, Session $customerSession, StoreRepositoryInterface $storeRepository,
                                StoreCookieManagerInterface $cookieManager, LoggerInterface $logger)
    {
        $this->storeManager = $storeManager;
        $this->customerSession = $customerSession;
        $this->storeRepository = $storeRepository;
        $this->cookieManager = $cookieManager;
        $this->logger = $logger;
    }

    public function afterLoadCustomerQuote(\Magento\Checkout\Model\Session $session, $result)
    {
        $storeCode = $this->storeManager->getStore()->getCode();
        $country = null;

        $customer = $this->customerSession->getCustomer();
        if ($customer) {
            $billAddress = $customer->getDefaultBillingAddress();
            if ($billAddress) {
                $country = $billAddress->getCountry();
            }
        }

        $this->logger->debug("StoreCode: $storeCode");
        $this->logger->debug("Country: $country");

        if ($storeCode != $country) {
            $defaultDisplayLanguage = in_array($country, ['US', 'JP', 'CN']) ? $country : 'US';
            $store = $this->storeRepository->getActiveStoreByCode($defaultDisplayLanguage);
            $this->cookieManager->setStoreCookie($store);
        }
    }
}