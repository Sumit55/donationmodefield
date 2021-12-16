<?php

namespace Drupal\donation_mode\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Field formatter "donation_default".
 *
 * @FieldFormatter(
 *   id = "donation_default",
 *   label = @Translation("Donation default"),
 *   field_types = {
 *     "donation_mode",
 *   }
 * )
 */
class DonationDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $output = [];

    foreach ($items as $delta => $item) {

      $build = [];

      $build['modes'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['donation__options'],
        ],
        'label' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__label'],
          ],
          '#markup' => t('Donation Mode'),
        ],
        'value' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['field__item'],
          ],
          // We use #plain_text instead of #markup to prevent XSS.
          // plain_text will clean up the donation mode and render an
          // HTML entity encoded string to prevent bad-guys from
          // injecting JavaScript.
          '#plain_text' => $item->modes,
        ],
      ];

      if (!empty($item->offline_mode) && ($item->modes !== 'online')) {
        $build['offline'] = [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['donation__options'],
          ],
          'label' => [
            '#type' => 'container',
            '#attributes' => [
              'class' => ['field__label'],
            ],
            '#markup' => t('Offline Mode'),
          ],
          'value' => [
            '#type' => 'container',
            '#attributes' => [
              'class' => ['field__item'],
            ],
            // We use #plain_text instead of #markup to prevent XSS.
            // plain_text will clean up offline mode and render an
            // HTML entity encoded string to prevent bad-guys from
            // injecting JavaScript.
            '#plain_text' => $item->offline_mode,
          ],
        ];
      }
      $output[$delta] = $build;
    }
    return $output;
  }

}
