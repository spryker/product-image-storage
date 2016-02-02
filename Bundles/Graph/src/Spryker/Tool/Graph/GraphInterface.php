<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Tool\Graph;

interface GraphInterface
{

    const DEFAULT_GROUP = 'default';

    /**
     * @param string $name
     * @param array $attributes
     * @param string $group
     *
     * @return self
     */
    public function addNode($name, $attributes = [], $group = self::DEFAULT_GROUP);

    /**
     * @param string $fromNode
     * @param string $toNode
     * @param array $attributes
     *
     * @return self
     */
    public function addEdge($fromNode, $toNode, $attributes = []);

    /**
     * @param string $name
     * @param array $attributes
     *
     * @return self
     */
    public function addCluster($name, $attributes = []);

    /**
     * @param string $type
     * @param string $fileName
     *
     * @return string
     */
    public function render($type, $fileName = null);

}
