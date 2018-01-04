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
    $user = db_query("SELECT COUNT(`uid`) as users FROM `users`")->fetchAll();
    $teacher = db_query("SELECT COUNT(`uid`) as teacher FROM `node_field_data` WHERE `type` ='course'")->fetchAll();
    foreach ($course as $key => $value) {
      $courses = $value->courses;
    }
    foreach ($user as $k => $v) {
      $users = $v->users;
    }
    foreach ($teacher as $te_key => $te_value) {
      $teachers = $te_value->teacher;
    }
    
    return array(
      '#theme' => 'faq_block',
            '#title' => 'Become A Section',
            '#courses' => $courses,
            '#students' => $users,
            '#teachers' => $teachers,
    );
  }

}