@if(count($posts_today) > 0)
<header class="video-home-page-display-set__header">
  <h3 class="video-home-page-display-set__title">Today</h3>
    <a class="video-home-page-display-set__link btn btn--hollow" href="/search/sets/gc7j5vVE8kKFbgt23TuAyg#license">
  </a>
</header>

<div class="parent" id="posts">
  @foreach ($posts_today as $post)
    @include('partials.post', ['post' => $post])
  @endforeach
</div>
@endif

<header class="video-home-page-display-set__header">
  <h3 class="video-home-page-display-set__title">Other news</h3>
</header>

<div class="parent" id="posts">
  @foreach ($posts_other as $post)
  @include('partials.post', ['post' => $post])

    @endforeach
</div>