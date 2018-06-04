<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */

global $user;

$pool_id = NULL;

if ($node = menu_get_object()) {
  // Get the nid
  $pool_id = $node->nid;
}

$redirect_url = drupal_get_path_alias(current_path());
$is_member = og_is_member('node', $pool_id);

$is_new_pick = grunfes_is_new_pick($user->uid, $pool_id);

?>
<div class="<?php print $classes; ?>">
<?php print render($title_prefix); ?>
<?php if ($title): ?>
  <?php print $title; ?>
<?php endif; ?>
<?php print render($title_suffix); ?>
<?php if ($header): ?>
  <div class="view-header">
    <?php print $header; ?>
  </div>
<?php endif; ?>

<?php if ($exposed): ?>
  <div class="view-filters">
    <?php print $exposed; ?>
  </div>
<?php endif; ?>

<?php if ($attachment_before): ?>
  <div class="attachment attachment-before">
    <?php print $attachment_before; ?>
  </div>
<?php endif; ?>

<?php if ($rows): ?>
  <div class="view-content">
    <form action="<?php echo "/my_picks/{$pool_id}"; ?>" method="POST">
      <?php print $rows; ?>

      <input type="hidden" name="redirectUrl"
             value="<?php echo $redirect_url; ?>"/>

      <?php if ($is_member): ?>
        <input type="submit" value="<?php echo t('Save Picks'); ?>"/>
      <?php endif; ?>
    </form>

    <?php if (is_user_administrator() && !$is_new_pick): ?>
      <form action="<?php echo "/publish_picks/{$pool_id}"; ?>" method="POST">
        <input type="hidden" name="redirectUrl"
               value="<?php echo $redirect_url; ?>"/>
        <input type="submit" value="<?php echo t('Publish Picks'); ?>"/>
      </form>
    <?php endif; ?>
  </div>
<?php elseif ($empty): ?>
  <div class="view-empty">
    <?php print $empty; ?>
  </div>
<?php endif; ?>

<?php if ($pager): ?>
  <?php print $pager; ?>
<?php endif; ?>

<?php if ($attachment_after): ?>
  <div class="attachment attachment-after">
    <?php print $attachment_after; ?>
  </div>
<?php endif; ?>

<?php if ($more): ?>
  <?php print $more; ?>
<?php endif; ?>

<?php if ($footer): ?>
  <div class="view-footer">
    <?php print $footer; ?>
  </div>
<?php endif; ?>

<?php if ($feed_icon): ?>
  <div class="feed-icon">
    <?php print $feed_icon; ?>
  </div>
<?php endif; ?>

  </div><?php /* class view */ ?>