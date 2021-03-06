<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:47
 */

namespace App\AppBundle\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * NestedSetInterface
 */
interface NestedSetInterface
{
    /**
     * Set lft
     *
     * @param integer $lft
     *
     * @return NestedSetInterface
     */
    public function setLft(int $lft): NestedSetInterface;

    /**
     * Get lft
     *
     * @return integer|null
     */
    public function getLft(): ?int;

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return NestedSetInterface
     */
    public function setLvl(int $lvl): NestedSetInterface;

    /**
     * Get lvl
     *
     * @return integer|null
     */
    public function getLvl(): ?int;

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return NestedSetInterface
     */
    public function setRgt(int $rgt): NestedSetInterface;

    /**
     * Get rgt
     *
     * @return integer|null
     */
    public function getRgt(): ?int;

    /**
     * Set root
     *
     * @param NestedSetInterface|null $root
     *
     * @return NestedSetInterface
     */
    public function setRoot(?NestedSetInterface $root = null): NestedSetInterface;

    /**
     * Get root
     *
     * @return NestedSetInterface
     */
    public function getRoot(): NestedSetInterface;

    /**
     * Set parent
     *
     * @param NestedSetInterface|null $parent
     *
     * @return NestedSetInterface
     */
    public function setParent(?NestedSetInterface $parent = null): NestedSetInterface;

    /**
     * Get parent
     *
     * @return NestedSetInterface|null
     */
    public function getParent(): ?NestedSetInterface;

    /**
     * Add child
     *
     * @param NestedSetInterface $child
     *
     * @return NestedSetInterface
     */
    public function addChild(NestedSetInterface $child): NestedSetInterface;


    /**
     * Remove child
     *
     * @param NestedSetInterface $child
     * @return bool
     */
    public function removeChild(NestedSetInterface $child): bool;

    /**
     * Get children
     *
     * @return Collection
     */
    public function getChildren(): Collection;

    /**
     * Set parentId
     *
     * @param integer|null $parentId
     *
     * @return NestedSetInterface
     */
    public function setParentId(?int $parentId): NestedSetInterface;

    /**
     * Get parentId
     *
     * @return integer|null
     */
    public function getParentId(): ?int;

    /**
     * Get $treeRoot
     *
     * @return integer|null
     */
    public function getTreeRoot(): ?int;

    /**
     * @param int|null $treeRoot
     *
     * @return NestedSetInterface
     */
    public function setTreeRoot(?int $treeRoot): NestedSetInterface;
}