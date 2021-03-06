<header class="banner">
  <div class="container">
    <a class="brand" href="{{ home_url('/') }}"></a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
    <nav class="nav-lang">
      @if (has_nav_menu('language_switcher'))
        {!! wp_nav_menu(['theme_location' => 'language_switcher', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
