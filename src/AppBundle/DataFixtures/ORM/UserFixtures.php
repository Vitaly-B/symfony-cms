<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 08.10.2017
 * Time: 14:10
 */

namespace App\AppBundle\DataFixtures\ORM;

use App\AppBundle\Entity\User;
use App\AppBundle\Managers\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * UserFixtures
 */
class UserFixtures extends Fixture
{
    use Traits\ConfigTrait;

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        /* @var UserManager $userManager */
        $userManager = $this->container->get('fos_user.user_manager');

        /* @var UserPasswordEncoderInterface $passwordEncoder */
        $passwordEncoder = $this->container->get('security.password_encoder');

        /* @var ValidatorInterface $validator*/
        $validator = $this->container->get('validator');

        /* @var array $fixtures */
        $fixtures = json_decode(file_get_contents($this->getFixturesPath() . '/users.json'), true);

        /* @var PropertyAccessor $propertyAccessor */
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        foreach ($fixtures as $fixture) {

            /* @var User $user */
            $user = $userManager->createUser();

            $user->setUsername($propertyAccessor->getValue($fixture, '[username]'));
            $user->setEmail($propertyAccessor->getValue($fixture, '[email]'));
            $user->setRoles($propertyAccessor->getValue($fixture, '[roles]'));
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $propertyAccessor->getValue($fixture, '[password]')
                )
            );
            $user->setEnabled(true);

            $errors = $validator->validate($user);

            if ($errors->count() == 0) {
                $userManager->updateUser($user);
            } else {
                throw new \Exception((string)$errors);
            }
        }

    }
}