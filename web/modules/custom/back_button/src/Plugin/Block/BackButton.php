<?php

namespace Drupal\back_button\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BackButton' Block.
 *
 * @Block(
 *   id = "back_button_block",
 *   admin_label = @Translation("Back Button"),
 *   category = @Translation("Back Button Block"),
 * )
 */
class BackButton extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {

    return array(
      '#theme' => 'backbutton',
            '#title' => 'View Profile ',
    );
  }

}