<?php

namespace Drupal\donation_mode\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Field widget "donation_default".
 *
 * @FieldWidget(
 *   id = "donation_default",
 *   label = @Translation("Donation default"),
 *   field_types = {
 *     "donation_mode",
 *   }
 * )
 */
class DonationDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $donation_options = [
      'online' => 'Online',
      'offline' => 'Offline',
    ];
    $offline_options = [
      'cash' => 'Cash',
      'cheque' => 'Cheque',
    ];
    $element += [
      '#type' => 'fieldset',
    ];

    // Donation mode.
    $element['modes'] = [
      '#title' => t('Donation Modes'),
      '#type' => 'select',
      '#options' => $donation_options,
      '#attributes' => [
        'data-type' => 'donat',
      ],
      '#empty_value' => '',
      '#default_value' => isset($items[$delta]->modes) ? $items[$delta]->modes : NULL,
      '#description' => t('Select donation mode'),
      '#required' => TRUE,
    ];

    // Offline mode.
    $element['offline_mode'] = [
      '#title' => t('Offline options'),
      '#type' => 'radios',
      '#options' => $offline_options,
      '#default_value' => isset($items[$delta]->offline_mode) ? $items[$delta]->offline_mode : NULL,
    ];
    $element['offline_mode']['#states'] = [
      'visible' => [
        [
          [':input[data-type="donat"]' => ['value' => 'offline']],
        ],
      ],
    ];

    return $element;

  }

}
