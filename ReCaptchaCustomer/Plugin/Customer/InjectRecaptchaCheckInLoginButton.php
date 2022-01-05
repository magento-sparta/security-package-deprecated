<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\ReCaptchaCustomer\Plugin\Customer;

use Magento\Framework\Exception\InputException;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface;
use Magento\ReCaptchaUi\Model\UiConfigResolverInterface;
use Magento\Customer\ViewModel\LoginButton;

/**
 * Custom login button check plugin
 */
class InjectRecaptchaCheckInLoginButton
{

    /**
     * @var UiConfigResolverInterface
     */
    private $captchaUiConfigResolver;

    /**
     * @var IsCaptchaEnabledInterface
     */
    private $isCaptchaEnabled;

    /**
     * @param UiConfigResolverInterface $captchaUiConfigResolver
     * @param IsCaptchaEnabledInterface $isCaptchaEnabled
     */
    public function __construct(
        UiConfigResolverInterface $captchaUiConfigResolver,
        IsCaptchaEnabledInterface $isCaptchaEnabled
    ) {
        $this->captchaUiConfigResolver = $captchaUiConfigResolver;
        $this->isCaptchaEnabled = $isCaptchaEnabled;
    }

    /**
     * Include isCaptchaEnable check for login button in customer
     *
     * @param LoginButton $subject
     * @return bool
     * @throws InputException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterEnabled(LoginButton $subject): bool
    {
        $key = 'customer_login';
        return $this->isCaptchaEnabled->isCaptchaEnabledFor($key);
    }
}
