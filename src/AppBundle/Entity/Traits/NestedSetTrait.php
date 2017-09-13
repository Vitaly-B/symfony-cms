<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 1:18
 */

namespace AppBundle\Entity\Traits;

use AppBundle\Entity\Interfaces\NestedSetInterface;
use Doctrine\Common\Collections\Collection;

/**
 * NestedSetTrait
 */
trait NestedSetTrait
{
    /**
     * @var integer
     */
    private $lft;

    /**
     * @var integer
     */
    private $lvl;

    /**
     * @var integer
     */
    private $rgt;

    /**
     * @var NestedSetInterface
     */
    private $root;

    /**
     * @var NestedSetInterface
     */
    private $parent;

    /**
     * @var int
     */
    private $parentId;

    /**
     * @var int
     */
    private $treeRoot;

    /**
     * @var Collection
     */
    private $children;

    /**
     * Set lft
     *
     * @param integer $lft
     *
     * @return NestedSetInterface
     */
    public function setLft(int $lft): NestedSetInterface
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft(): ?int
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return NestedSetInterface
     */
    public function setLvl(int $lvl): NestedSetInterface
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer|null
     */
    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return NestedSetInterface
     */
    public function setRgt(int $rgt): NestedSetInterface
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer|null
     */
    public function getRgt(): ?int
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param NestedSetInterface $root
     *
     * @return NestedSetInterface
     */
    public function setRoot(NestedSetInterface $root = null): NestedSetInterface
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return NestedSetInterface
     */
    public function getRoot(): ?NestedSetInterface
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param NestedSetInterface $parent
     *
     * @return NestedSetInterface
     */
    public function setParent(NestedSetInterface $parent = null): NestedSetInterface
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return NestedSetInterface
     */
    public function getParent(): ?NestedSetInterface
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param NestedSetInterface $child
     *
     * @return NestedSetInterface
     */
    public function addChild(NestedSetInterface $child): NestedSetInterface
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param NestedSetInterface $child
     */
    public function removeChild(NestedSetInterface $child): void
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return NestedSetInterface
     */
    public function setParentId(?int $parentId): NestedSetInterface
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * Get $treeRoot
     *
     * @return integer|null
     */
    public function getTreeRoot(): ?int
    {
       return $this->treeRoot;
    }

    public function setTreeRoot(?int $treeRoot): NestedSetInterface
    {
        $this->treeRoot = $treeRoot;

        return $this;
    }
}