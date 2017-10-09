<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 09.10.2017
 * Time: 11:20
 */

namespace AppBundle\Entity\Interfaces;

/**
 * TimestampableInterface
 */
interface TimestampableInterface
{
    /**
     * Returns createdAt value.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Returns updatedAt value.
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime;

    /**
     * @param \DateTime $createdAt
     * @return TimestampableInterface
     */
    public function setCreatedAt(\DateTime $createdAt): TimestampableInterface;

    /**
     * @param \DateTime $updatedAt
     * @return TimestampableInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt): TimestampableInterface;

    /**
     * Updates createdAt and updatedAt timestamps.
     * @return void
     */
    public function updateTimestamps();
}