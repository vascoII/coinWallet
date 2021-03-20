<?php


namespace App\Infrastructure\Model\Coinbase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinModel extends Model
{
    use SoftDeletes;

    protected $casts = [
        'tags' => 'array',
        'tag_names' => 'array',
        'tag_groups' => 'array',
        'urls_twitter' => 'array',
        'urls_messageBoard' => 'array',
        'urls_chat' => 'array',
        'urls_explorer' => 'array',
        'urls_reddit' => 'array',
        'urls_technical_doc' => 'array',
        'urls_source_code' => 'array',
        'urls_announcement' => 'array'
    ];

    protected $table = 'coins';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'symbol',
        'category',
        'description',
        'slug',
        'logo',
        'subreddit',
        'notice',
        'tags',
        'tagNames',
        'tagGroups',
        'urlsWebsite',
        'urlsTwitter',
        'urlsMessageBoard',
        'urlsChat',
        'urlsExplorer',
        'urlsReddit',
        'urlsTechnicalDoc',
        'urlsSourceCode',
        'urlsAnnouncement',
        'platform',
        'dateAdded',
        'twitterUsername',
        'isHidden'
    ];

}
