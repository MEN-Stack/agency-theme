<!-- GET DATA -->

<?php
//get MAIN footer id
$args = array("post_type" => "footer", "s" => "Main Footer");
$query = get_posts( $args );
$id = $query[0]->ID;

//get fields from main
$description = get_field('description', $id);
$quoteBtn = get_field('quote_button_text', $id);
$questionnaireBtn = get_field('questionnaire_button_text', $id);
?>

<!-- LAYOUT -->
<br>
<!-- descripton and buttons -->
<section class="contact">
      <h3><a name="contact"></a></h3>
      <div class="container">
        <div class="column">
            <h4><?php echo($description);?></h4>
        </div>
        <div class="column">
            <!-- contact form -->
            <?php echo do_shortcode( '[contact-form-7 id="51" title="contact"]' ); ?>
        </div>
      </div>
</section>
<!-- <button><?php echo($quoteBtn);?></button>
<button><?php echo($questionnaireBtn);?></button> -->

<!-- contact form -->
<!-- <br><span>Contact:</span>
<?php echo do_shortcode( '[contact-form-7 id="51" title="contact"]' ); ?> -->

<!-- quote form  -->
<!-- <br><span>Quote:</span>
<?php echo do_shortcode( '[cf7form cf7key="quote"]' ); ?> -->

<!-- questionnaire form -->
<!-- <br>
<?php echo do_shortcode( '[cf7form cf7key="questionaire"]' ); ?> -->

<!-- DO NOT DELETE  -->
<?php wp_footer(); ?>
</body>
</html>