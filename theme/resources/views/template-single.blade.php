{{--
  Template Name: Single Section Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="content-wrap">
    @include('partials.content-page')
    </div>
  @endwhile
@endsection

@section('mainclass', 'grid bg-' . get_theme_mod('primary_color', 'red'))
