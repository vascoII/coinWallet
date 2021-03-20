@extends('../layouts.app')

@section('content')
    <div class="header">
        <h1 class="page-title">Coin</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">Coins</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <table class="table">
                    <tr><th>Name</th><td>{{ $coin->getName() }}</td></tr>
                    <tr><th>Symmbol</th><td>{{ $coin->getSymbol() }}</td></tr>
                    <tr><th>Slug</th><td>{{ $coin->getSlug() }}</td></tr>
                    <tr><th>Category</th><td>{{ $coin->getCategory() }}</td></tr>
                    <tr><th>Description</th><td>{{ $coin->getDescription() }}</td></tr>
                    <tr><th>Logo</th><td>{{ $coin->getLogo() }}</td></tr>
                    <tr><th>Subreddit</th><td>{{ $coin->getSubreddit() }}</td></tr>
                    <tr><th>Notice</th><td>{{ $coin->getNotice() }}</td></tr>
                    <tr><th>Tags</th><td>@foreach($coin->getTags() as $tag) {{ $tag }} <br> @endforeach</td></tr>
                    <tr><th>Tag Names</th><td>@foreach($coin->getTagNames() as $tagName) {{ $tagName }} <br> @endforeach</td></tr>
                    <tr><th>Tag Groups</th><td>@foreach($coin->getTagGroups() as $tagGroup) {{$tagGroup}} <br> @endforeach</td></tr>
                    <tr><th>Urls Websites</th><td>@foreach($coin->getUrlsWebsite() as $urlsWebsite) {{ $urlsWebsite }} <br> @endforeach</td></tr>
                    <tr><th>Urls Twitter</th><td>@foreach($coin->getUrlsTwitter() as $uUrlsTwitter) {{ $uUrlsTwitter }} <br> @endforeach</td></tr>
                    <tr><th>Urls Message Board</th><td>@foreach($coin->getUrlsMessageBoard() as $urlsMessageBoard) {{ $urlsMessageBoard }} <br> @endforeach</td></tr>
                    <tr><th>Urls Chat</th><td>@foreach($coin->getUrlsChat() as $urlsChat) {{ $urlsChat }} <br> @endforeach</td></tr>
                    <tr><th>Urls Explorer</th><td>@foreach($coin->getUrlsExplorer() as $urlsExplorer) {{ $urlsExplorer }} <br> @endforeach</td></tr>
                    <tr><th>Urls Reddit</th><td>@foreach($coin->getUrlsReddit() as $urlsReddit) {{ $urlsReddit }} <br> @endforeach</td></tr>
                    <tr><th>Urls Technical Doc</th><td>@foreach($coin->getUrlsTechnicalDoc() as $urlsTechnicalDoc) {{ $urlsTechnicalDoc }} <br> @endforeach</td></tr>
                    <tr><th>Urls Source Code</th><td>@foreach($coin->getUrlsSourceCode() as $urlsSourceCode) {{ $urlsSourceCode }} <br> @endforeach</td></tr>
                    <tr><th>Urls Annoncement</th><td>@foreach($coin->getUrlsAnnouncement() as $urlsAnnouncement) {{ $urlsAnnouncement }} <br> @endforeach</td></tr>
                    <tr><th>Platform</th><td>{{ $coin->getPlatform() }}</td></tr>
                    <tr><th>Date Added</th><td>{{ $coin->getDateAdded() }}</td></tr>
                    <tr><th>Twitter Username</th><td>{{ $coin->getTwitterUsername() }}</td></tr>
                    <tr><th>is Hidden</th><td>{{ $coin->isHidden() }}</td></tr>
                </table>
            </div>

            <footer>
                <hr />
                <p class="pull-right">Design by <a href="#" target="_blank">Rubus Data</a></p>
                <p>&copy; {{ date('Y') }} <a href="#" target="_blank">Rubus Data</a></p>
            </footer>
        </div>
    </div>
@endsection
