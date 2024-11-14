<?php declare(strict_types=1);

namespace Ingesting\Core\UseCase;

use Ingesting\Core\Model\IngestedItem;
use Ingesting\Core\Port\Driven\ForStoringIngestedItem;
use Ingesting\Core\Port\Driving\ForRegisteringIngestedItem;

class Register implements ForRegisteringIngestedItem
{
    //TODO add clock interface to construct

    public function __construct(
        private readonly ForStoringIngestedItem $itemRepository
    ) {
    }

    public function registerIngestedItem(string $dependantFrom, string $repository, int $starred, int $fork): void
    {
        //TODO apply validation

        $item = new IngestedItem();
        $item->setDependantFrom($dependantFrom);
        $item->setRepository($repository);
        $item->setStarredScore($starred);
        $item->setForkScore($fork);
        $item->setRegistrationDate(new \DateTimeImmutable('now'));

        // TODO: check unique id
        // TODO: check unique composite keys ($dependantFrom,$repository)

        //dd($item);

        $this->itemRepository->save($item);

    }
}
