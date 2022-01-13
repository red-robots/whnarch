<?php
$taxonomy = 'project-categories';
$terms = get_terms( $taxonomy, array( 'hide_empty' => true, 'parent' => 0 ) );
if($terms) { ?>
  <div class="categories-breadcrumb">
    <a href="<?php echo get_site_url() ?>/projects/" class="all<?php echo (isset($isAll)) ? ' active':'' ?>">All</a>
    <?php foreach ($terms as $term) { 
      $term_id = $term->term_id;
      $term_link = get_term_link($term, $taxonomy);
      $term_name = $term->name;
      $is_active = ( isset($current_term_id) && $current_term_id==$term_id ) ? ' active':'';
      ?>
      <a href="<?php echo $term_link ?>" class="term <?php echo $is_active ?>"><?php echo $term_name ?></a>
    <?php } ?>
  </div>
<?php } ?>