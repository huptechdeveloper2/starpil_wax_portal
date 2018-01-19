<?php

namespace Drupal\become_teacher\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BecomeTeacherResult' Block.
 *
 * @Block(
 *   id = "become_teacher",
 *   admin_label = @Translation("Become Teacher Result"),
 *   category = @Translation("UBecome Teacher Result"),
 * )
 */
class BecomeTeacherResult extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {

    $uid = \Drupal::currentUser()->id();
    $result_query = db_query("SELECT `user_uid`, `field_do_you_have_students_`, `field_do_you_have_teaching_exper`, `field_have_you_created_video_bef` FROM `become_teacher` WHERE `user_uid` = $uid")->fetchAll();
    foreach ($result_query as $k => $v) {
      $have_student_res = $v->field_do_you_have_students_;
      $teach_before_res = $v->field_do_you_have_teaching_exper;
      $cr_video_before_res = $v->field_have_you_created_video_bef;
    }
    // Check for the data value of have student;;
    if ($have_student_res == '0') {
      $have_student_value_res = 'Yes';
    } else {
      $have_student_value_res = 'No';
    }
    // Check the data for tching experiance;;
    if ($teach_before_res == '0') {
      $teach_before_value_res = 'Yes';
    } else {
      $teach_before_value_res = 'No';
    }
    // Check the data for upload any video before;;
    if ($cr_video_before_res == '0') {
      $cr_video_before_value_res = 'No';
    } elseif ($cr_video_before_res == '1') {
      $cr_video_before_value_res = 'A little';
    }else {
      $cr_video_before_value_res = 'Often';
    }

    return array(
      '#theme' => 'becometeacherresult',
            '#title' => 'Results',
            '#student' => $have_student_value_res,
            '#video' => $cr_video_before_value_res,
            '#teaching' => $teach_before_value_res
    );
  }

}