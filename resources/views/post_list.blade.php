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
{{-- <div class="parent" id="postsx">
<div class="FeedItem_item story_with_image_featured">
  <div class="FeedItem_cf">
    <div class="FeedItem_content-container">
      <div class="FeedItem_right-wrap">
        <div class="ImageStoryTemplate_image-story-container">
          <p class="FeedItemMeta_meta-container has-feature-decor FeedItemMeta_density-full">
            <a class="FeedItemMeta_channel" href="https://www.reuters.com/news/archive/worldNews">World News</a>
            <span class="FeedItemMeta_date-updated">3 hours ago</span>
            <span class="FeedItemMeta_feature-decor" title="Top Headline" style="color: rgb(243, 112, 33);">
              <svg height="15px" width="10px" version="1.1" viewBox="0 0 10 15"><defs></defs><g id="Channel-Pages----Mobile" fill="none" stroke="none" stroke-width="1"><g id="Technology-Channel" transform="translate(-1034.000000, -941.000000)"><g id="article-01-copy" transform="translate(275.000000, 905.000000)"><g id="Featuired-flag" transform="translate(759.000000, 36.000000)"><polygon id="Rectangle-2" fill="#F36F21" points="0 2 10 2 7.33333333 5.63125 10 9 0 9"></polygon><rect height="14" id="Rectangle-12" width="1" rx="0.5" stroke="#F36F21" x="0.5" y="0.5"></rect></g></g></g></g></svg></span></p><div><h2 class="FeedItemHeadline_headline FeedItemHeadline_full"><a href="https://www.reuters.com/article/us-health-coronavirus-france-doctor/french-doctor-98-keeps-working-through-coronavirus-crisis-idUSKCN21X1XW">French doctor, 98, keeps working through coronavirus&nbsp;crisis</a></h2></div><span><a href="https://www.reuters.com/article/us-health-coronavirus-france-doctor/french-doctor-98-keeps-working-through-coronavirus-crisis-idUSKCN21X1XW"><img src="https://static.reuters.com/resources/r/?m=02&amp;d=20200415&amp;t=2&amp;i=1515172663&amp;r=LYNXNPEG3E19U&amp;w=640" alt="French doctor Christian Chenay, 98 year-old, wearing a protective face mask, sits in his consulting room at the doctor's office in Chevilly-Larue near Paris as the spread of the coronavirus disease (COVID-19) continues in France April 14, 2020. REUTERS/Gonzalo Fuentes"></a></span><div><p class="FeedItemLede_lede">Doctor Christian Chenay is almost old enough to remember the 1918 Spanish flu and treated typhus sufferers during World War Two. Now, as he nears his 99th birthday, he is still caring for patients through the coronavirus&nbsp;epidemic.</p></div></div><div class="FeedItem_icons"><ul class="SocialTool_container"><li><a href="https://www.twitter.com/share?url=https%3A%2F%2Freut.rs%2F34F8d3F&amp;text=French%20doctor%2C%2098%2C%20keeps%20working%20through%20coronavirus%20crisis" target="" class="SocialTool_social-button SocialTool_twitter"><svg height="512.002px" id="Capa_1" style="enable-background:new 0 0 512.002 512.002" width="512.002px" version="1.1" viewBox="0 0 512.002 512.002" x="0px" y="0px" xml:space="preserve"><g><path d="M512.002,97.211c-18.84,8.354-39.082,14.001-60.33,16.54c21.686-13,38.342-33.585,46.186-58.115
 c-20.299,12.039-42.777,20.78-66.705,25.49c-19.16-20.415-46.461-33.17-76.674-33.17c-58.011,0-105.042,47.029-105.042,105.039
 c0,8.233,0.929,16.25,2.72,23.939c-87.3-4.382-164.701-46.2-216.509-109.753c-9.042,15.514-14.223,33.558-14.223,52.809
 c0,36.444,18.544,68.596,46.73,87.433c-17.219-0.546-33.416-5.271-47.577-13.139c-0.01,0.438-0.01,0.878-0.01,1.321
 c0,50.894,36.209,93.348,84.261,103c-8.813,2.399-18.094,3.687-27.674,3.687c-6.769,0-13.349-0.66-19.764-1.888
 c13.368,41.73,52.16,72.104,98.126,72.949c-35.95,28.176-81.243,44.967-130.458,44.967c-8.479,0-16.84-0.496-25.058-1.471
 c46.486,29.807,101.701,47.197,161.021,47.197c193.211,0,298.868-160.062,298.868-298.872c0-4.554-0.104-9.084-0.305-13.59
 C480.111,136.775,497.92,118.275,512.002,97.211z"></path></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
</a></li><li>
  <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Freut.rs%2F34F8d3F&amp;t=French%20doctor%2C%2098%2C%20keeps%20working%20through%20coronavirus%20crisis" target="" class="SocialTool_social-button SocialTool_facebook"><svg id="Layer_1" style="enable-background:new 0 0 9 16" version="1.1" viewBox="0 0 9 16" x="0px" y="0px" xml:space="preserve"><path id="logo_facebook" d="M5.8,16V8.7h2.7l0.4-2.8H5.8V4c0-0.8,0.2-1.4,1.5-1.4H9V0.1C8.7,0.1,7.8,0,6.6,0c-2.3,0-4,1.3-4,3.8v2.1 H0v2.8h2.7V16H5.8L5.8,16z"></path></svg></a></li><li><button class="SocialTool_button_more"><svg height="7" width="11"><path d="M1 1.493l4.454 3.905 4.546-4" fill="none" stroke="#86888B" stroke-width="1.5"></path></svg></button></li></ul></div></div></div></div></div>
</div> --}}