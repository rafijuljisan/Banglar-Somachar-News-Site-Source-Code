{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($subcategories as $category)
    <url>
        {{-- Check if parent exists to avoid errors --}}
        @if($category->parent)
            <loc>{{ route('frontend.postBySubcategory', [$category->parent->slug, $category->slug]) }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        @endif
    </url>
    @endforeach
</urlset>