<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 13:55
 */

namespace AppBundle\Entity\Interfaces;


interface CategoryInterface extends NestedSetInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CategoryInterface
     */
    public function setTitle(?string $title): CategoryInterface;

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle(): ?string;

}