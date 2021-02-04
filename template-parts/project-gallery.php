
<?php
//Display featured projects:
// Name xx
// Project Type xx 
// Description  xx
// Services  xx
// - Featured image xx
// -img  xx
// -img  xx
// -img  xx

//get Featured Projects
$args = array(
  'posts_per_page' => 3,
  'post_type' => 'project',
  'orderby' => 'date',
  'order' => 'DESC',
  'category_name' => 'featured'
);
$loop = new WP_Query( $args );

// the loop

while ( $loop->have_posts() ) : $loop->the_post(); ?>

<!-- START LAYOUT: -->
<ul>
  <!-- NAME: the-title -->
  <li><h3><?php 
    the_title(); 
  ?></h3></li>
  <li><?php

//PROJECT TYPE: taxonomy-custom(Project_Type)
    $taxonomy = 'Project_Type';
    $terms = get_object_term_cache( $post->ID, $taxonomy );
    echo('Project Type: '.$terms[0]->name);
  ?></li>

<!-- DESCRIPTION: the-content -->
  <li>Description:</li><li><?php the_content(); ?></li>
  
<!-- SERVICES: taxonomy-tags -->
  <li>Services: <?php
    $posttags = get_the_tags();
    if ($posttags) {
      foreach($posttags as $tag) {
        echo $tag->name . ' '; 
      }
    }
  ?></li>

<!-- FEATURED IMAGE -->
<img src="<?php echo(get_the_post_thumbnail_url());?>" alt="featured"> 

<!-- GALLERY -->
<?php 
  $left = get_field('left_image'); 
  $middle = get_field('middle_image'); 
  $right = get_field('right_image'); 
?>
<img src="<?php echo($left['url']); ?>" alt="left">
<img src="<?php echo($middle['url']); ?>" alt="middle">
<img src="<?php echo($right['url']); ?>" alt="right">

<?php endwhile; ?>