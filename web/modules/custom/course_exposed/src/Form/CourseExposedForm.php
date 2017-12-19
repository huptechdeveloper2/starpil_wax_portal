<?php
/**
 * @file
 * Contains \Drupal\course_exposed\Form\ContributeForm.
 */

namespace Drupal\course_exposed\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Contribute form.
 */
class CourseExposedForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'course_exposed_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $categories = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('category');
    foreach ($categories as $key => $value) {
      $categoryOption[$value->tid] = $value->name;
    }
    $all_cate_default = array('All'=>'All categories');
    $cateOption = $all_cate_default + $categoryOption;
    $tags = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('tags_courses');
    foreach ($tags as $k => $v) {
      $tagOption[$v->tid] = $v->name;
    }
    $all_tag_default = array('All'=>'Beginner level');
    $tagallOption = $all_tag_default + $tagOption;
    

    $form['course_body'] = array(
      '#type' => 'textfield',
      '#prefix' => '<div class="course-keyword">',
      '#suffix' => '</div>',
    );
    $form['course_body']['#attributes']['placeholder'] = t('Course keyword');

    $form['course_category'] = array (
      '#type' => 'select',
      '#options' => $cateOption,
      '#attributes' => array('class' => array('select')),
      '#prefix' => '<div class="mc-select-wrap"><div class="mc-select">',
      '#suffix' => '</div></div>',
    );
    $form['course_tag'] = array (
      '#type' => 'select',
      '#options' => $tagallOption,
      '#attributes' => array('class' => array('select')),
      '#prefix' => '<div class="mc-select-wrap"><div class="mc-select">',
      '#suffix' => '</div></div></div>',
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('FindCourse'),
      '#button_type' => 'primary',
      '#attributes' => array('class' => array('mc-btn btn-style-1')),
      '#prefix' => '<div class="tb-cell text-right"><div class="form-actions">',
      '#suffix' => '</div></div>',
    );

     $form['#prefix'] = '<section id="after-slider" class="after-slider section"><div class="awe-color bg-color-1"></div><div class="after-slider-bg-2"></div><div class="container"><div class="after-slider-content tb"><div class="inner tb-cell"><h4>Find your course</h4>';
     $form['#suffix'] = '</div></div></section>';

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      if ($key == 'course_category') {
        $category_target_id = $value;
      }
      if ($key == 'course_tag') {
        $tag_target_id = $value;
      }
      if ($key == 'course_body') {
        $title = $value;
      }
    }
    global $base_url;
    // $url = $base_url.'/courses?field_course_category_target_id='.$category_target_id;
    $url = $base_url.'/courses?title='.$title.'&field_course_tag_target_id='.$category_target_id.'&field_course_category_target_id='.$tag_target_id;
    $response = new RedirectResponse($url);
    $response->send(); // don't send the response yourself inside controller and form.
    return;
  }
}
?>