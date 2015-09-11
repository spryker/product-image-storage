<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\Payolution\Business;

use SprykerEngine\Zed\Kernel\Business\AbstractBusinessDependencyContainer;
use Generated\Zed\Ide\FactoryAutoCompletion\PayolutionBusiness;
use SprykerFeature\Zed\Payolution\Business\Api\Adapter\AdapterInterface;
use SprykerFeature\Zed\Payolution\Business\Api\Request\ConverterInterface as RequestConverterInterface;
use SprykerFeature\Zed\Payolution\Business\Api\Response\ConverterInterface as ResponseConverterInterface;
use SprykerFeature\Zed\Payolution\Business\Order\OrderManagerInterface;
use SprykerFeature\Zed\Payolution\Business\Payment\PaymentManagerInterface;
use SprykerFeature\Zed\Payolution\PayolutionConfig;
use SprykerFeature\Zed\Payolution\Persistence\PayolutionQueryContainerInterface;

/**
 * @method PayolutionBusiness getFactory()
 * @method PayolutionQueryContainerInterface getQueryContainer()
 * @method PayolutionConfig getConfig()
 */
class PayolutionDependencyContainer extends AbstractBusinessDependencyContainer
{

    /**
     * @return PaymentManagerInterface
     */
    public function createPaymentManager()
    {
        $paymentManager = $this
            ->getFactory()
            ->createPaymentPaymentManager(
                $this->createExecutionAdapter(),
                $this->getQueryContainer(),
                $this->createRequestConverter(),
                $this->createResponseConverter()
            );

        $paymentManager->registerMethodMapper(
            $this->getFactory()->createPaymentMethodMapperInvoice($this->getConfig())
        );

        return $paymentManager;
    }

    /**
     * @return AdapterInterface
     */
    protected function createExecutionAdapter()
    {
        $gatewayUrl = $this->getConfig()->getGatewayUrl();

        return $this
            ->getFactory()
            ->createApiAdapterHttpGuzzle($gatewayUrl);
    }

    /**
     * @return OrderManagerInterface
     */
    public function createOrderManager()
    {
        return $this->getFactory()->createOrderOrderManager();
    }

    /**
     * @return RequestConverterInterface
     */
    public function createRequestConverter()
    {
        return $this->getFactory()->createApiRequestConverter();
    }

    /**
     * @return ResponseConverterInterface
     */
    public function createResponseConverter()
    {
        return $this->getFactory()->createApiResponseConverter();
    }

}
