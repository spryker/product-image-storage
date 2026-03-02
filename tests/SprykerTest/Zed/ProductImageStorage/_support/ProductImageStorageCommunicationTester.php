<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductImageStorage;

use Codeception\Actor;
use Generated\Shared\DataBuilder\ProductImageBuilder;
use Generated\Shared\Transfer\ProductAbstractImageStorageTransfer;
use Generated\Shared\Transfer\ProductImageTransfer;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery;
use Orm\Zed\ProductImageStorage\Persistence\Base\SpyProductAbstractImageStorage;
use Orm\Zed\ProductImageStorage\Persistence\SpyProductAbstractImageStorageQuery;
use Orm\Zed\ProductImageStorage\Persistence\SpyProductConcreteImageStorage;

/**
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(\SprykerTest\Zed\ProductImageStorage\PHPMD)
 */
class ProductImageStorageCommunicationTester extends Actor
{
    use _generated\ProductImageStorageCommunicationTesterActions;

    /**
     * @var string
     */
    public const PARAM_PROJECT = 'PROJECT';

    /**
     * @var string
     */
    public const PROJECT_SUITE = 'suite';

    public function isSuiteProject(): bool
    {
        if (getenv(static::PARAM_PROJECT) === static::PROJECT_SUITE) {
            return true;
        }

        return false;
    }

    public function createProductImageTransferWithSortOrder(int $sortOrder): ProductImageTransfer
    {
        /** @var \Generated\Shared\Transfer\ProductImageTransfer $productImageTransfer */
        $productImageTransfer = (new ProductImageBuilder())
            ->seed([ProductImageTransfer::SORT_ORDER => $sortOrder])
            ->build();

        return $productImageTransfer;
    }

    public function findProductImageSetToProductImage(int $idProductImageSet): ?SpyProductImageSetToProductImage
    {
        return SpyProductImageSetToProductImageQuery::create()
            ->findOneByFkProductImageSet($idProductImageSet);
    }

    public function deleteProductImageSetToProductImage(int $idProductImageSet): void
    {
        $productImageSetToProductImageEntity = $this->findProductImageSetToProductImage($idProductImageSet);
        if ($productImageSetToProductImageEntity === null) {
            return;
        }

        $productImageSetToProductImageEntity->delete();
    }

    public function createProductConcreteImageStorage(int $idProductConcrete, string $locale): SpyProductConcreteImageStorage
    {
        $productConcreteImageStorageEntity = (new SpyProductConcreteImageStorage())
            ->setFkProduct($idProductConcrete)
            ->setKey(uniqid())
            ->setData([])
            ->setLocale($locale);

        $productConcreteImageStorageEntity->save();

        return $productConcreteImageStorageEntity;
    }

    public function findProductAbstractImageStorageTransfer(int $idProductAbstract): ?ProductAbstractImageStorageTransfer
    {
        $productAbstractImageStorageEntity = $this->findProductAbstractImageStorage($idProductAbstract);

        if (!$productAbstractImageStorageEntity) {
            return null;
        }

        return (new ProductAbstractImageStorageTransfer())->fromArray($productAbstractImageStorageEntity->getData());
    }

    protected function findProductAbstractImageStorage(int $idProductAbstract): ?SpyProductAbstractImageStorage
    {
        return $this->getProductAbstractImageStorageQuery()
            ->findOneByFkProductAbstract($idProductAbstract);
    }

    protected function getProductAbstractImageStorageQuery(): SpyProductAbstractImageStorageQuery
    {
        return SpyProductAbstractImageStorageQuery::create();
    }
}
