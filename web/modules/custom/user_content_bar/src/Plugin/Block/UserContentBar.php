<?php

namespace Drupal\user_content_bar\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UserContentBar' Block.
 *
 * @Block(
 *   id = "user_content_bar_block",
 *   admin_label = @Translation("User Content Bar Block"),
 *   category = @Translation("User Content Bar Block"),
 * )
 */
class UserContentBar extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {

  	// $host = \Drupal::request()->getSchemeAndHttpHost();
  	 $host  = \Drupal::request()->getRequestUri();
  	$uid = \Drupal::currentUser()->id();

    return array(
      '#theme' => 'usercontentbar',
            '#title' => 'User Content Bar',
            '#u_id' => $uid
    );
  }

}