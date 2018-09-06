<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductImageStorage;

use Generated\Shared\Transfer\ProductAbstractImageStorageTransfer;
use Generated\Shared\Transfer\ProductConcreteImageStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\ProductImageStorage\ProductImageStorageFactory getFactory()
 */
class ProductImageStorageClient extends AbstractClient implements ProductImageStorageClientInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idProductAbstract
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\ProductAbstractImageStorageTransfer|null
     */
    public function findProductImageAbstractStorageTransfer($idProductAbstract, $locale): ?ProductAbstractImageStorageTransfer
    {
        return $this->getFactory()
            ->createProductAbstractImageStorageReader()
            ->findProductImageAbstractStorageTransfer($idProductAbstract, $locale);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idProductConcrete
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\ProductConcreteImageStorageTransfer|null
     */
    public function findProductImageConcreteStorageTransfer($idProductConcrete, $locale): ?ProductConcreteImageStorageTransfer
    {
        return $this->getFactory()
            ->createProductConcreteImageStorageReader()
            ->findProductImageConcreteStorageTransfer($idProductConcrete, $locale);
    }
}
