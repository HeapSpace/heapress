<footer class="content-info grid bg-@php echo get_theme_mod('footer_color', 'black'); @endphp">
  <div class="container grid-col2">
    @php
// query for the page using either (not both!) one of the two following lines
$bottom_page_query = new WP_Query('pagename=' . get_theme_mod('footer_slug', '_footer'));

// loop through the query (even though it's just one page)
while ($bottom_page_query->have_posts()) : $bottom_page_query->the_post();
  the_content();
endwhile;

// reset post data (important, don't leave out!)
wp_reset_postdata();

    @endphp
    @php dynamic_sidebar('sidebar-footer') @endphp
  </div>
</footer>
