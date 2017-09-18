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
     * @var NestedSetTrait
     */
    private $root;

    /**
     * @var NestedSetTrait
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
     * @return NestedSetTrait
     */
    public function setLft(int $lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer|null
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
     * @return NestedSetTrait
     */
    public function setLvl(int $lvl)
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
     * @return NestedSetTrait
     */
    public function setRgt(int $rgt)
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
     * @param NestedSetTrait|null $root
     *
     * @return NestedSetTrait
     */
    public function setRoot($root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return NestedSetTrait
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param NestedSetTrait $parent
     *
     * @return NestedSetTrait
     */
    public function setParent($parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return NestedSetTrait
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param NestedSetTrait $child
     *
     * @return NestedSetTrait
     */
    public function addChild($child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param NestedSetTrait $child
     * @return bool
     */
    public function removeChild($child): bool
    {
        return $this->children->removeElement($child);
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
     * @param integer|null $parentId
     *
     * @return NestedSetTrait
     */
    public function setParentId(?int $parentId)
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

    /**
     * @param int|null $treeRoot
     *
     * @return NestedSetTrait
     */
    public function setTreeRoot(?int $treeRoot)
    {
        $this->treeRoot = $treeRoot;

        return $this;
    }
}