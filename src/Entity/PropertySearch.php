<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch {
    /**
     * @var int|null
     */
    private $minPrice;


    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minSurface;
    /**
     * @var int|null
     */
    private $maxSurface;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
         $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    /**
     * @param int|null $minPrice
     * @return PropertySearch
     */
    public function setMinPrice(?int $minPrice): PropertySearch
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxSurface(): ?int
    {
        return $this->maxSurface;
    }

    /**
     * @param int|null $maxSurface
     * @return PropertySearch
     */
    public function setMaxSurface(?int $maxSurface): PropertySearch
    {
        $this->maxSurface = $maxSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     * @return PropertySearch
     */
    public function setOptions(ArrayCollection $options): PropertySearch
    {
        $this->options = $options;
        return $this;
    }



}
