<footer class="content-info grid bg-@php echo get_theme_mod('footer_color', 'black'); @endphp">
  <div class="container content-wrap">
    @php

$bottom_page_query = new WP_Query('pagename=' . get_theme_mod('footer_slug', '_footer'));
while ($bottom_page_query->have_posts()) : $bottom_page_query->the_post();
  the_content();
endwhile;
wp_reset_postdata();

    @endphp
    @php dynamic_sidebar('sidebar-footer') @endphp
    <div id="footer">@php echo get_theme_mod('footer_text'); @endphp</div>
  </div>
</footer>
