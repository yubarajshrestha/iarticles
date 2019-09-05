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
                <link>{{ url($item->link) }}</link>
                <guid>{{ url($item->link) }}</guid>
                <pubDate>{{ $item->published->toAtomString() }}</pubDate>
                <author>{{ $item->author }}</author>
                <description>{{ strip_tags($item->summary) }}</description>
                <content:encoded>
                    <![CDATA[
                        <!doctype html>
                        <html lang="ne" prefix="op: http://media.facebook.com/op#">
                            <head>
                                <meta charset="utf-8">
                                <link rel="canonical" href="{{ url($item->link) }}">
                                <meta property="op:markup_version" content="v1.0">
                            </head>
                        <body>
                            <article>
                                <header>
                                    <h1>{{ $item->title }}</h1>
                                    @if(isset($item->subtitle))
                                    <h2>Article Subtitle</h2>
                                    @endif
                                    <time class="op-published" datetime="{{ $item->published->toAtomString() }}">{{ \Carbon\Carbon::parse($item->published)->format('F jS, h:i A') }}</time>
                                    <time class="op-modified" dateTime="{{ $item->updated->toAtomString() }}">{{ \Carbon\Carbon::parse($item->updated)->format('F jS, h:i A') }}</time>
                                    <address>{{ $item->author }}</address>
                                    <figure>
                                        <img src="{{ $item->cover }}" />
                                        <figcaption>{{ $item->title }}</figcaption>
                                    </figure>
                                    @if(isset($item->kicker))
                                    <h3 class="op-kicker">{{ $item->kicker }}</h3>
                                    @endif
                                </header>
                                {{ $item->description }}
                                <footer><aside>Dekha Padhi</aside><small>© Copyright {{ Date('Y') }}</small></footer>
                            </article>
                        </body>
                        </html>
                    ]]>
                </content:encoded>
            </item>
        @endforeach
    </channel>
</rss>