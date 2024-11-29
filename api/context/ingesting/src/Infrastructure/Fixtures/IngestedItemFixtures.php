<?php declare(strict_types=1);

namespace Ingesting\Infrastructure\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ingesting\Core\Model\IngestedItem;

class IngestedItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 40; $i++) {
            $item = new IngestedItem();
            $item->setDependantFrom('symfony/framework-bundle');
            $item->setRepository('foo-' . $i . '/bar-' . $i);
            $item->setStarredScore($i);
            $item->setForkScore($i);
            $item->setRegistrationDate(new \DateTimeImmutable('now'));
            $manager->persist($item);
        }

        $manager->flush();
    }
}
