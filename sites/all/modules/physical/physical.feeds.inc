<?php

/**
 * @file
 * Feeds processor hooks for importing physical fields using the Feeds module.
 */

/**
 * Implements hook_feeds_processor_targets_alter().
 *
 * @param $targets
 *   Array containing the targets to be offered to the user.
 * @param $entity_type
 *   The entity type of the target, for instance a 'node' entity.
 * @param $bundle_name
 *   The bundle name for which to alter targets.
 */
function physical_feeds_processor_targets_alter(&$targets, $entity_type, $bundle_name) {
  foreach (field_info_instances($entity_type, $bundle_name) as $name => $instance) {
    $info = field_info_field($name);
    if ($info['type'] == 'physical_weight' || $info['type'] == 'physical_dimensions') {
      foreach ($info['columns'] as $sub_field => $schema_info) {
        $name_label = $instance['label'] . ': ' . drupal_ucfirst(str_replace('_', ' ', $sub_field));
        $targets[$name . ':' . $sub_field] = array(
          'name' => $name_label,
          'callback' => 'physical_feeds_set_target',
          'real_target' => $info['field_name'],
          'description' => $schema_info['description'],
        );
      }
    }
  }
}

/**
 * Callback for hook_feeds_processor_targets_alter().
 *
 * @param $source
 *   Field mapper source settings.
 * @param $entity
 *   An entity object, for instance a node object.
 * @param $target
 *   A string identifying the target on the node.
 * @param $value
 *   The value to populate the target with.
 */
function physical_feeds_set_target($source, $entity, $target, $value) {
  list($field_name, $sub_field) = explode(':', $target, 2);

  // Handle non-multiple value fields.
  if (!is_array($value)) {
    $value = array($value);
  }
  $info = field_info_field($field_name);
  $field = isset($entity->$field_name) ? $entity->$field_name : array();
  $entity_type = $source->importer->processor->entityType();

  $info_instance = field_info_instance($entity_type, $field_name, $entity->type);
  //Check if default values exist
  if (isset($info_instance['default_value'][0])) {
    $default_values = $info_instance['default_value'][0];
  }
  else {
    $default_values = array(
      'length' => 0,
      'height' => 0,
      'width' => 0,
      'weight' => 0,
      'unit' => $info_instance['widget']['settings']['default_unit'],
    );
  }
  foreach ($value as $i => $v) {
    // Use default values incase they are not defined by mapper
    if (!isset($field[LANGUAGE_NONE][$i])) {
      foreach ($default_values as $default_sub_field => $default_value) {
        $field[LANGUAGE_NONE][$i][$default_sub_field] = $default_value;
      }
    }
    if ($sub_field != 'unit') {
      $field[LANGUAGE_NONE][$i][$sub_field] = (!empty($v) && is_numeric($v)) ? trim($v) : $default_values[$sub_field];
    }
    else {
      $field[LANGUAGE_NONE][$i][$sub_field] = (!empty($v)) ? $v : $default_values[$sub_field];
    }
    if ($info['cardinality'] == 1) {
      break;
    }
  }
  $entity->$field_name = $field;
}