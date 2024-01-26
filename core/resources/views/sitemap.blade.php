<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages --}}
    <url>
        <loc>{{ url('/') }}/</loc>
        <lastmod>{!! now()->tz('UTC')->toAtomString() !!}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}/</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/about') }}/</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/career') }}/</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/become-partner') }}/</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>


    
    <!-- Rest of your static URLs -->
    {{-- Services Category --}}
    @foreach ($pages as $page)
        <url>
            <loc>{{  route('page.slug',$page->slug) }}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($blogs as $blog)
        <url>
            <loc>{{  route('article.show',$blog->slug) }}</loc>
            <lastmod>{{ $blog->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($services as $service)
        <url>
            <loc>{{  route('search.index',['category_id' => $service->id]) }}</loc>
            <lastmod>{{ $service->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    @foreach ($serviceCategories as $category)
        <url>
            <loc>{{  route('search.index',['category_id' => $category->id]) }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>