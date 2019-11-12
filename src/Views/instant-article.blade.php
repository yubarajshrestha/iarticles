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
        @foreach($items as $item)
            <item>
                <title>{{ $item->title }}</title>
                <link>{{ $item->link }}</link>
                <guid>{{ $item->link }}</guid>
                <pubDate>{{ $item->published->toRfc822String() }}</pubDate>
                <author>{{ $item->author }}</author>
                <description>{{ strip_tags($item->summary) }}</description>
                <content:encoded>
                    <![CDATA[
                        <!doctype html>
                        <html lang="ne" prefix="op: http://media.facebook.com/op#">
                            <head>
                                <meta charset="utf-8">
                                <link rel="canonical" href="{{ $item->link }}">
                                <meta property="op:markup_version" content="v1.0">
                            </head>
                        <body>
                            <article>
                                <header>
                                    <h1>{{ $item->title }}</h1>
                                    @if(isset($item->subtitle))
                                    <h2>{{ $item->subtitle }}</h2>
                                    @endif
                                    <time class="op-published" datetime="{{ $item->published->toRfc822String() }}">{{ \Carbon\Carbon::parse($item->published)->format('F jS, h:i A') }}</time>
                                    <time class="op-modified" dateTime="{{ $item->updated->toRfc822String() }}">{{ \Carbon\Carbon::parse($item->updated)->format('F jS, h:i A') }}</time>
                                    <address>{{ $item->author }}</address>
                                    @if(isset($item->cover))
                                    <figure>
                                        <img src="{{ $item->cover }}" />
                                        <figcaption>{{ $item->title }}</figcaption>
                                    </figure>
                                    @endif
                                    @if(isset($item->kicker))
                                    <h3 class="op-kicker">{{ $item->kicker }}</h3>
                                    @endif
                                </header>
                                {{ $item->description }}
                                <footer><aside>{{ $meta['brand'] }}</aside><small>© Copyright {{ Date('Y') }}</small></footer>
                            </article>
                        </body>
                        </html>
                    ]]>
                </content:encoded>
            </item>
        @endforeach
    </channel>
</rss>
