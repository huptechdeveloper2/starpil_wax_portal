<?php

namespace Drupal\faq_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Faqblock' Block.
 *
 * @Block(
 *   id = "faq_block",
 *   admin_label = @Translation("Faq Page"),
 *   category = @Translation("Faq Page"),
 * )
 */
class Faqblock extends BlockBase {

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
    
    return array(
      '#theme' => 'faq_block',
            '#title' => 'Become A Section',
            '#courses' => $courses,
            '#students' => $users,
            '#teachers' => $teachers,
            '#total_price' => $total_price
    );
  }

}