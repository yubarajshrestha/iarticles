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
                <pubDate>{{ $item->published->toAtomString() }} </pubDate>
                <author>{{ $item->author }}</author>
                <description>{{ strip_tags($item->summary) }}</description>
                <content:encoded>
                    <![CDATA[
                    <!doctype html>
                    <html lang="en" prefix="op: http://media.facebook.com/op#">
                    <head>
                        <meta charset="utf-8">
                        <link rel="canonical" href="">
                        <meta property="op:markup_version" content="v1.0">
                    </head>
                    <body>
                        <article>
                            <header>
                                {{ $item->title }}
                            </header>
                            {{ $item->description }}
                        </article>
                    </body>
                    </html>
                    ]]>
                </content:encoded>
            </item>
        @endforeach
    </channel>
</rss>