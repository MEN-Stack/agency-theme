<section class="services">
  <div class="container">
    <h3><a name="services">Services</a></h3>
      <!-- list of services -->
      <ul class="service-list">

    <?php 
    
    $args = array(
        'name' => 'services'
    );
    $parent= get_categories($args);
    $parentID = $parent[0]->term_id;
    $children = get_term_children($parentID, 'category');
    foreach($children as $child){
    ?><li><?php
        //get child posts of services
        $posts = get_posts(array(
            'category' => $child
        ));
        //find featured post
        $featuredPost;
        foreach($posts as $post){
            if($post->post_excerpt !== ''){
                $featuredPost = $post->post_title;
                $excerpt = $post->post_excerpt;
            }   
        } ?>
        <div class="column description"> 
        <h2> <?php echo($featuredPost); ?> </h2>
        <p> <?php echo($excerpt); ?></p>
        <a class="desktop" href="">Learn More</a>
        </div>
        <div class="column links">
            <!-- Service Links -->
          <ul class="service-links">
            <?php
            foreach($posts as $post){
            $featuredTitle = $featuredPost;
            if($post->post_title !== $featuredTitle){
                echo("<li><a>".$post->post_title."</a></li>");
            }
            }
            ?>
          </ul>    
        </div>
        </li>
    <?php } ?>
</section>  
    
  