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
    $user = db_query("SELECT DISTINCT(`uid`) as users FROM `commerce_order` WHERE `checkout_step` = 'complete'")->fetchAll();
    $teacher = db_query("SELECT COUNT(`entity_id`) as teacher FROM `user__roles` WHERE `roles_target_id` = 'teacher'")->fetchAll();
    $total_price = db_query("SELECT SUM(`total_price__number`) as price FROM `commerce_order` WHERE `checkout_step` = 'complete'")->fetchAll();
    foreach ($course as $key => $value) {
      $courses = $value->courses;
    }
      $users = count($user);
    foreach ($teacher as $te_key => $te_value) {
      $teachers = $te_value->teacher;
    }
    foreach ($total_price as $price_key => $price_value) {
      $total_price = round($price_value->price);
    }

    $user_object = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $roles = $user_object->getRoles();
    if (in_array('teacher', $roles)) {
     $teache_role = '1';
    } else {
     $teache_role = '';
    }
    
    return array(
      '#theme' => 'become_a_section',
            '#title' => 'Become A Section',
            '#courses' => $courses,
            '#students' => $users,
            '#teachers' => $teachers,
            '#teache_role' => $teache_role,
            '#total_price' => $total_price
    );
  }

}