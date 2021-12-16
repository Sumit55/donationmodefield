<?php

namespace Drupal\donation_mode\Plugin\Field\FieldType;

use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;

/**
 * Field type "donation_mode".
 *
 * @FieldType(
 *   id = "donation_mode",
 *   label = @Translation("Donation Mode"),
 *   description = @Translation("Custom donation mode field."),
 *   category = @Translation("Donation Mode"),
 *   default_widget = "donation_default",
 *   default_formatter = "donation_default",
 * )
 */
class DonationItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    return [
      'columns' => [
        'modes' => [
          'type' => 'varchar',
          'description' => t('Donation Mode'),
          'not null' => FALSE,
          'length' => 10,
        ],
        'offline_mode' => [
          'type' => 'varchar',
          'description' => t('Offline Mode'),
          'length' => 10,
        ],
      ],
      'indexes' => [
        'value' => ['modes'],
      ],
    ];

  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('modes')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['modes'] = DataDefinition::create('string')
      ->setLabel(t('Donation Mode'));

    $properties['offline_mode'] = DataDefinition::create('string')
      ->setLabel(t('Offline Modes'));

    return $properties;
  }

}
