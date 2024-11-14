<?php declare(strict_types=1);

namespace Ingesting\AdapterForStoringIngestedItem;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ingesting\Core\Model\IngestedItem;
use Ingesting\Core\Port\Driven\ForStoringIngestedItem;

/**
 * @extends ServiceEntityRepository<IngestedItem>
 */
class DoctrineAdapterForStoringIngestedItem extends ServiceEntityRepository implements ForStoringIngestedItem
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngestedItem::class);
    }

    public function save(IngestedItem $item): void
    {

        $this->persist($item, true);
    }

    private function persist(IngestedItem $item, bool $flush = false): void
    {
        $this->getEntityManager()->persist($item);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

    }
}
