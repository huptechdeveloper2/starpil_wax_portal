<?php

namespace Drupal\become_a_section\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Becomeasection' Block.
 *
 * @Block(
 *   id = "become_a_section_block",
 *   admin_label = @Translation("Become A Section"),
 *   category = @Translation("Become A Section Block"),
 * )
 */
class Becomeasection extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {

    // $host = \Drupal::request()->getSchemeAndHttpHost();
    $course = db_query("SELECT count(`nid`) as courses FROM `node` WHERE `type` = 'course'")->fetchAll();
    $user = db_query("SELECT COUNT(`uid`) as users FROM `users`")->fetchAll();
    foreach ($course as $key => $value) {
      $courses = $value->courses;
    }
    foreach ($user as $k => $v) {
      $users = $v->users;
    }
    
    return array(
      '#theme' => 'become_a_section',
            '#title' => 'Become A Section',
            '#courses' => $courses,
            '#students' => $users,
    );
  }

}