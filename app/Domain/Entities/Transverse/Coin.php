<?php

namespace App\Domain\Entities\Transverse;


class Coin
{
    public int $id;
    public string $name;
    public string $symbol;
    public string $category;
    public string $description;
    public string $slug;
    public string $logo;
    public string $subreddit;
    public string $notice;
    public array $tags;
    public array $tagNames;
    public array $tagGroups;
    public array $urlsWebsite;
    public array $urlsTwitter;
    public array $urlsMessageBoard;
    public array $urlsChat;
    public array $urlsExplorer;
    public array $urlsReddit;
    public array $urlsTechnicalDoc;
    public array $urlsSourceCode;
    public array $urlsAnnouncement;
    public ?string $platform;
    public string $dateAdded;
    public string $twitterUsername;
    public bool $isHidden;

    /**
     * Coin constructor.
     * @param int $id
     * @param string $name
     * @param string $symbol
     * @param string $category
     * @param string $description
     * @param string $slug
     * @param string $logo
     * @param string $subreddit
     * @param string $notice
     * @param array $tags
     * @param array $tagNames
     * @param array $tagGroups
     * @param array $urlsWebsite
     * @param array $urlsTwitter
     * @param array $urlsMessageBoard
     * @param array $urlsChat
     * @param array $urlsExplorer
     * @param array $urlsReddit
     * @param array $urlsTechnicalDoc
     * @param array $urlsSourceCode
     * @param array $urlsAnnouncement
     * @param string|null $platform
     * @param string $dateAdded
     * @param string $twitterUsername
     * @param bool $isHidden
     */
    public function __construct(
        int $id,
        string $name,
        string $symbol,
        string $category,
        string $description,
        string $slug,
        string $logo,
        string $subreddit,
        string $notice,
        array $tags,
        array $tagNames,
        array $tagGroups,
        array $urlsWebsite,
        array $urlsTwitter,
        array $urlsMessageBoard,
        array $urlsChat,
        array $urlsExplorer,
        array $urlsReddit,
        array $urlsTechnicalDoc,
        array $urlsSourceCode,
        array $urlsAnnouncement,
        ?string $platform,
        string $dateAdded,
        string $twitterUsername,
        bool $isHidden
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->category = $category;
        $this->description = $description;
        $this->slug = $slug;
        $this->logo = $logo;
        $this->subreddit = $subreddit;
        $this->notice = $notice;
        $this->tags = $tags;
        $this->tagNames = $tagNames;
        $this->tagGroups = $tagGroups;
        $this->urlsWebsite = $urlsWebsite;
        $this->urlsTwitter = $urlsTwitter;
        $this->urlsMessageBoard = $urlsMessageBoard;
        $this->urlsChat = $urlsChat;
        $this->urlsExplorer = $urlsExplorer;
        $this->urlsReddit = $urlsReddit;
        $this->urlsTechnicalDoc = $urlsTechnicalDoc;
        $this->urlsSourceCode = $urlsSourceCode;
        $this->urlsAnnouncement = $urlsAnnouncement;
        $this->platform = $platform;
        $this->dateAdded = $dateAdded;
        $this->twitterUsername = $twitterUsername;
        $this->isHidden = $isHidden;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getSubreddit(): string
    {
        return $this->subreddit;
    }

    /**
     * @return string
     */
    public function getNotice(): string
    {
        return $this->notice;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getTagNames(): array
    {
        return $this->tagNames;
    }

    /**
     * @return array
     */
    public function getTagGroups(): array
    {
        return $this->tagGroups;
    }

    /**
     * @return array
     */
    public function getUrlsWebsite(): array
    {
        return $this->urlsWebsite;
    }

    /**
     * @return array
     */
    public function getUrlsTwitter(): array
    {
        return $this->urlsTwitter;
    }

    /**
     * @return array
     */
    public function getUrlsMessageBoard(): array
    {
        return $this->urlsMessageBoard;
    }

    /**
     * @return array
     */
    public function getUrlsChat(): array
    {
        return $this->urlsChat;
    }

    /**
     * @return array
     */
    public function getUrlsExplorer(): array
    {
        return $this->urlsExplorer;
    }

    /**
     * @return array
     */
    public function getUrlsReddit(): array
    {
        return $this->urlsReddit;
    }

    /**
     * @return array
     */
    public function getUrlsTechnicalDoc(): array
    {
        return $this->urlsTechnicalDoc;
    }

    /**
     * @return array
     */
    public function getUrlsSourceCode(): array
    {
        return $this->urlsSourceCode;
    }

    /**
     * @return array
     */
    public function getUrlsAnnouncement(): array
    {
        return $this->urlsAnnouncement;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @return string
     */
    public function getDateAdded(): string
    {
        return $this->dateAdded;
    }

    /**
     * @return string
     */
    public function getTwitterUsername(): string
    {
        return $this->twitterUsername;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->isHidden;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'category' => $this->category,
            'description' => $this->description,
            'slug' => $this->slug,
            'logo' => $this->logo,
            'subreddit' => $this->subreddit,
            'notice' => $this->notice,
            'tags' => json_encode($this->tags),
            'tag_names' => json_encode($this->tagNames),
            'tag_groups' => json_encode($this->tagGroups),
            'urls_website' => json_encode($this->urlsWebsite),
            'urls_twitter' => json_encode($this->urlsTwitter),
            'urls_message_board' => json_encode($this->urlsMessageBoard),
            'urls_chat' => json_encode($this->urlsChat),
            'urls_explorer' => json_encode($this->urlsExplorer),
            'urls_reddit' => json_encode($this->urlsReddit),
            'urls_technical_doc' => json_encode($this->urlsTechnicalDoc),
            'urls_source_code' => json_encode($this->urlsSourceCode),
            'urls_announcement' => json_encode($this->urlsAnnouncement),
            'platform' => $this->platform,
            'dateAdded' => $this->dateAdded,
            'twitterUsername' => $this->twitterUsername,
            'isHidden' => $this->isHidden
        ];
    }
}
