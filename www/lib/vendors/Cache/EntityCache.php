<?php
namespace Cache;
use OCFram\DataCache;
use OCFram\Entity;

/**
 *
 */
class EntityCache extends DataCache
{

    /**
     * @param Entity $data
     *
     * @return static
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return Entity
     */
    public function getData()
    {
        return $this->data;
    }
}
