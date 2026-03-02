<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductImageStorage\Expander;

use Generated\Shared\Transfer\ProductAbstractImageStorageTransfer;
use Generated\Shared\Transfer\ProductConcreteImageStorageTransfer;

interface ProductImageStorageExpanderInterface
{
    public function expandProductAbstractImageStorageTransferWithProductImageAlternativeTexts(
        ProductAbstractImageStorageTransfer $productAbstractImageStorageTransfer,
        string $localeName
    ): ProductAbstractImageStorageTransfer;

    public function expandProductConcreteImageStorageTransferWithProductImageAlternativeTexts(
        ProductConcreteImageStorageTransfer $productConcreteImageStorageTransfer,
        string $localeName
    ): ProductConcreteImageStorageTransfer;
}
