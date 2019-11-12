<?=
    /* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
    '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>{{ $meta['title'] }}</title>
        <link>{{ $meta['link'] }}</link>
        <description>{{ $meta['description'] }}</description>
        <language>{{ $meta['language'] }}</language>
        <lastBuildDate>{{ $meta['updated'] }}</lastBuildDate>
        <generator>
            iArticles https://yubarajshrestha.com.np
        </generator>
        @foreach($items as $item)
            <item>
                <title>{{ $item->title }}</title>
                <description>{{ strip_tags($item->summary) }}</description>
                <link>{{ $item->link }}</link>
                <guid isPermaLink="false">{{ $item->id }}</guid>
                <pubDate>{{ $item->published->toRfc822String() }}</pubDate>
                @if(isset($item->author))<author>{{ $item->author }}</author>@endif
                @if(isset($item->cover))
                <image>
                    <url>{{ $item->cover }}</url>
                    <title>{{ $item->title }}</title>
                    <link>{{ $item->link }}</link>
                </image>
                @endif
            </item>
        @endforeach
    </channel>
</rss>