<?php

namespace App\Infrastructure\Repositories\Transverse;

use App\Domain\Collections\Transverse\CoinCollection;
use App\Domain\Entities\Transverse\Coin;
use App\Domain\Repositories\Transverse\CoinRepository as CoinRepositoryInterface;
use App\Infrastructure\Hydrator\Transverse\CoinHydrator;
use App\Infrastructure\Model\Transverse\CoinModel;

class CoinRepository implements CoinRepositoryInterface
{
    protected CoinModel $model;
    protected CoinHydrator $hydrator;

    public function __construct(CoinModel $model, CoinHydrator $hydrator)
    {
        $this->model = $model;
        $this->hydrator = $hydrator;
    }

    public function findAll(): ?CoinCollection
    {
        $coinCollection = new CoinCollection();
        $collection = $this->model::orderBy('name')->get();

        if ($collection->isEmpty()) {
            return null;
        }

        foreach ($collection as $item) {
            $coinCollection->add($this->hydrator->hydrate($item));
        }
        return $coinCollection;
    }

    public function findAllSymbol(): array
    {
        $result = [];
        $collection = $this->model::select('symbol')->get();
        foreach ($collection as $item) {
            $result[] = $item->symbol;
        }
        return $result;
    }

    public function save(Coin $coin): void
    {
        $this->model->id = $coin->getId();
        $this->model->name = $coin->getName();
        $this->model->symbol = $coin->getSymbol();
        $this->model->category = $coin->getCategory();
        $this->model->description = $coin->getDescription();
        $this->model->slug = $coin->getSlug();
        $this->model->logo = $coin->getLogo();
        $this->model->subreddit = $coin->getSubreddit();
        $this->model->notice = $coin->getNotice();
        $this->model->tags = json_encode($coin->getTags() ?? []);
        $this->model->tag_names = json_encode($coin->getTags());
        $this->model->tag_groups = json_encode($coin->getTagGroups());
        $this->model->urls_website = json_encode($coin->getUrlsWebsite());
        $this->model->urls_twitter = json_encode($coin->getUrlsTwitter());
        $this->model->urls_message_board = json_encode($coin->getUrlsMessageBoard());
        $this->model->urls_chat = json_encode($coin->getUrlsChat());
        $this->model->urls_explorer = json_encode($coin->getUrlsExplorer());
        $this->model->urls_reddit = json_encode($coin->getUrlsReddit());
        $this->model->urls_technical_doc = json_encode($coin->getUrlsTechnicalDoc());
        $this->model->urls_source_code = json_encode($coin->getUrlsSourceCode());
        $this->model->urls_announcement = json_encode($coin->getUrlsAnnouncement());
        $this->model->platform = $coin->getPlatform();
        $this->model->date_added = $coin->getDateAdded();
        $this->model->twitter_username = $coin->getTwitterUsername();
        $this->model->is_hidden = $coin->isHidden();

        $this->model->save();
    }

    public function findOneById(int $id): Coin
    {
        $collection = $this->model::where('id', $id)->get();
        return $this->hydrator->hydrate($collection->first());
    }

    public function findOneBySymbol(string $symbol): Coin
    {
        $collection = $this->model::where('symbol', $symbol)->get();
        return $this->hydrator->hydrate($collection->first());
    }
}
