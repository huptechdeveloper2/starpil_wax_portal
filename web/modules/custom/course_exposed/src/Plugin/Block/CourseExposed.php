<?php

namespace Drupal\course_exposed\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CourseExposed' Block.
 *
 * @Block(
 *   id = "course_exposed_block",
 *   admin_label = @Translation("Course Exposed Custom"),
 *   category = @Translation("Course Exposed Custom Block"),
 * )
 */
class CourseExposed extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\course_exposed\Form\CourseExposedForm');
    return $form;
  }

}