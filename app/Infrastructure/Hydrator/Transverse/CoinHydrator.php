<?php


namespace App\Infrastructure\Hydrator\Transverse;

use App\Domain\Entities\Transverse\Coin;
use App\Infrastructure\Model\Transverse\CoinModel;

class CoinHydrator
{
    public function hydrate(CoinModel $coinModel): ?Coin
    {
        if (is_null($coinModel)) {
            return null;
        }
        return new Coin(
            $coinModel->id,
            $coinModel->name,
            $coinModel->symbol,
            $coinModel->category,
            $coinModel->description,
            $coinModel->slug,
            $coinModel->logo,
            $coinModel->subreddit,
            $coinModel->notice,
            json_decode($coinModel->tags, true),
            json_decode($coinModel->tag_names, true),
            json_decode($coinModel->tag_groups, true),
            json_decode($coinModel->urls_website, true),
            json_decode($coinModel->urls_twitter, true),
            json_decode($coinModel->urls_message_board, true),
            json_decode($coinModel->urls_chat, true),
            json_decode($coinModel->urls_explorer, true),
            json_decode($coinModel->urls_reddit, true),
            json_decode($coinModel->urls_technical_doc, true),
            json_decode($coinModel->urls_source_code, true),
            json_decode($coinModel->urls_announcement, true),
            $coinModel->platform,
            $coinModel->date_added,
            $coinModel->twitter_username,
            $coinModel->is_hidden
        );
    }

    public function hydrateFromCoinbase(array $data): ?Coin
    {
        return new Coin(
            $data['id'],
            $data['name'],
            $data['symbol'],
            $data['category'],
            $data['description'],
            $data['slug'],
            $data['logo'],
            $data['subreddit'],
            $data['notice'],
            is_null($data['tags']) ? [] : $data['tags'],
            is_null($data['tag-names']) ? [] : $data['tag-names'],
            is_null($data['tag-groups']) ? [] : $data['tag-groups'],
            $data['urls']['website'],
            $data['urls']['twitter'],
            $data['urls']['message_board'],
            $data['urls']['chat'],
            $data['urls']['explorer'],
            $data['urls']['reddit'],
            $data['urls']['technical_doc'],
            $data['urls']['source_code'],
            $data['urls']['announcement'],
            !is_null($data['platform']) ?? null,
            $data['date_added'],
            $data['twitter_username'],
            $data['is_hidden']
        );
    }
}
