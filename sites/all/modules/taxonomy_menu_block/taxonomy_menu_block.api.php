<?php

/**
 * @file
 * Hooks provided by the Taxonomy Menu Block module.
 */

/**
 * Alter data of the taxonomy tree.
 *
 * Alter data of the taxonomy tree before the tree gets nested and sent to the
 * theme function.
 *
 * @param array $tree
 *   A flat array of taxonomy terms, keyed by their tid. It's very important
 *   the keys of this array never get reset, as they are used for nesting the
 *   tree, later in the Taxonomy Menu Block module.
 *   The order of the terms is still the same as when returned by the
 *   taxonomy_get_tree() function.
 * 
 * @param array $config
 *   An array containing configuration of current block.
 */
function hook_taxonomy_tree_alter(&$tree, &$config) {
  // Add the number of nodes associated with each term.
  foreach ($tree as $tid => $term) {
    $nodes = db_select('taxonomy_index', 'ti')
        ->condition('tid', (int) $tid)
        ->countQuery()
        ->execute()
        ->fetchField();
    $tree[$tid]['name'] = $term['name'] . ' (' . $nodes . ')';
  }
}

/**
 * Alter the active tid.
 *
 * Dynamic trees get built based on this tid: only the subs of this tid will be
 * shown. The active trail is also based on this active tid.
 *
 * Currently only taxonomy (taxonomy/term/%) and node (node/%) pages are
 * supported. On taxonomy pages the active tid is always the tid of the
 * currently viewed term, on node pages the active tid is the value of any term
 * reference field (if any) that refers to the vocabulary we need to display.
 *
 * @param int $tid
 *   The currently active tid.
 * 
 * @param array $config
 *   An array containing configuration of current block.
 */
function hook_active_tid_alter(&$tid, &$config) {
  // Add support for a custom page we have defined in our Drupal setup, for
  // example with Views: www.site.com/custom/page/tid.
  if (arg(0) == 'custom' && arg(1) == 'page') {
    $tid = arg(2);
  }
}
