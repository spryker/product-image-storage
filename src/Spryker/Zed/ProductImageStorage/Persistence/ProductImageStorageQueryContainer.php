<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductImageStorage\Persistence;

use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageSetTableMap;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Spryker\Zed\ProductImageStorage\Persistence\ProductImageStoragePersistenceFactory getFactory()
 */
class ProductImageStorageQueryContainer extends AbstractQueryContainer implements ProductImageStorageQueryContainerInterface
{
    /**
     * @var string
     */
    public const FK_PRODUCT_ABSTRACT = 'fkProductAbstract';

    /**
     * @var string
     */
    public const FK_PRODUCT = 'fkProduct';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $productAbstractIds
     *
     * @return \Orm\Zed\ProductImageStorage\Persistence\SpyProductAbstractImageStorageQuery
     */
    public function queryProductAbstractImageStorageByIds(array $productAbstractIds)
    {
        $query = $this
            ->getFactory()
            ->createSpyProductAbstractImageStorageQuery()
            ->filterByFkProductAbstract_In($productAbstractIds);

        return $query;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productIds
     *
     * @return \Orm\Zed\ProductImageStorage\Persistence\SpyProductConcreteImageStorageQuery
     */
    public function queryProductConcreteImageStorageByIds(array $productIds)
    {
        $query = $this
            ->getFactory()
            ->createSpyProductConcreteImageStorageQuery()
            ->filterByFkProduct_In($productIds);

        return $query;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $productAbstractIds
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery
     */
    public function queryProductAbstractLocalizedByIds(array $productAbstractIds)
    {
        return $this->getFactory()->getProductQueryContainer()
            ->queryAllProductAbstractLocalizedAttributes()
            ->joinWithLocale()
            ->filterByFkProductAbstract_In($productAbstractIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productIds
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery
     */
    public function queryProductLocalizedByIds(array $productIds)
    {
        return $this->getFactory()->getProductQueryContainer()
            ->queryAllProductLocalizedAttributes()
            ->joinWithLocale()
            ->filterByFkProduct_In($productIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productImageIds
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery
     */
    public function queryProductAbstractIdsByProductImageIds(array $productImageIds)
    {
        return $this->getFactory()->getProductImageQueryContainer()
            ->queryProductImageSetToProductImage()
            ->filterByFkProductImage_In($productImageIds)
            ->innerJoinSpyProductImageSet()
            ->withColumn('DISTINCT ' . SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT, static::FK_PRODUCT_ABSTRACT)
            ->select([static::FK_PRODUCT_ABSTRACT])
            ->addAnd(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT, null, ModelCriteria::NOT_EQUAL);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productImageIds
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery
     */
    public function queryProductIdsByProductImageIds(array $productImageIds)
    {
        return $this->getFactory()->getProductImageQueryContainer()
            ->queryProductImageSetToProductImage()
            ->filterByFkProductImage_In($productImageIds)
            ->innerJoinSpyProductImageSet()
            ->withColumn('DISTINCT ' . SpyProductImageSetTableMap::COL_FK_PRODUCT, static::FK_PRODUCT)
            ->select([static::FK_PRODUCT])
            ->addAnd(SpyProductImageSetTableMap::COL_FK_PRODUCT, null, ModelCriteria::NOT_EQUAL);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productImageSetToProductImageIds
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery
     */
    public function queryProductAbstractIdsByProductImageSetToProductImageIds(array $productImageSetToProductImageIds)
    {
        $query = $this->getFactory()->getProductImageQueryContainer()
            ->queryProductImageSetToProductImage()
            ->filterByIdProductImageSetToProductImage_In($productImageSetToProductImageIds)
            ->innerJoinSpyProductImageSet()
            ->withColumn('DISTINCT ' . SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT, static::FK_PRODUCT_ABSTRACT)
            ->select([static::FK_PRODUCT_ABSTRACT])
            ->addAnd(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT, null, ModelCriteria::NOT_EQUAL);

        return $query;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed without replacement.
     *
     * @param array<int> $productImageSetToProductImageIds
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery
     */
    public function queryProductImageSetToProductImageByIds(array $productImageSetToProductImageIds): SpyProductImageSetToProductImageQuery
    {
        return $this->getFactory()
            ->getProductImageQueryContainer()
            ->queryProductImageSetToProductImage()
            ->innerJoinSpyProductImageSet()
            ->filterByIdProductImageSetToProductImage_In($productImageSetToProductImageIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $productImageSetToProductImageIds
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery
     */
    public function queryProductIdsByProductImageSetToProductImageIds(array $productImageSetToProductImageIds)
    {
        $query = $this->getFactory()->getProductImageQueryContainer()
            ->queryProductImageSetToProductImage()
            ->filterByIdProductImageSetToProductImage_In($productImageSetToProductImageIds)
            ->innerJoinSpyProductImageSet()
            ->withColumn('DISTINCT ' . SpyProductImageSetTableMap::COL_FK_PRODUCT, static::FK_PRODUCT)
            ->select([static::FK_PRODUCT])
            ->addAnd(SpyProductImageSetTableMap::COL_FK_PRODUCT, null, ModelCriteria::NOT_EQUAL);

        return $query;
    }
}
