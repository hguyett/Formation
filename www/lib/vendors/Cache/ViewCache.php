<?php
namespace Cache;
use OCFram\DataCache;

class ViewCache extends DataCache
{

    /**
     * @param string $data
     *
     * @return static
     */
    public function setData(string $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}
