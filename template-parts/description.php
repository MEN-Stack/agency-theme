<?php 
    $args = array("post_type" => "page", "s" => 'Our Company');
    $query = get_posts( $args );
    $content = $query[0]->post_content;
    $title = $query[0]->post_title;
    // print_r($query);
    // echo get_post_field('post_content', $id );
 ?>

<!-- template -->
<section class="our-company-section">
  <div class="container">
    <h3><a name="our-company" class="our-company" href="#"><?php echo($title); ?></a></h3>
    <p><?php echo($content); ?></p>
  </div>
</section>

