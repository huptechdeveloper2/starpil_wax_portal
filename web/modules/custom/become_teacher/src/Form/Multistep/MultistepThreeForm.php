<?php
/**
 * @file
 * Contains \Drupal\become_teacher\Form\Multistep\MultistepThreeForm.
 */

namespace Drupal\become_teacher\Form\Multistep;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Component\Utility\UrlHelper;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MultistepThreeForm extends MultistepFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'multistep_form_three';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['have_students'] = array(
      '#type' => 'radios',
      '#title' => t('Do you have students?'),
      '#description' => t('Waxportal'),
      '#required' => TRUE,
      '#options' => array(
                    t('Yes'),
                    t('No'),
                    )
      );

    // $form['actions']['previous'] = array(
    //   '#type' => 'link',
    //   '#title' => $this->t('Previous'),
    //   '#attributes' => array(
    //     'class' => array('button'),
    //   ),
    //   '#weight' => 0,
    //   '#url' => Url::fromRoute('become_teacher.multistep_two'),
    // );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $have_students = $form_state->getValue('have_students');
    $user_id = \Drupal::currentUser()->id();
    \Drupal::database()->update('become_teacher')
        ->condition('user_uid' , $user_id)
        ->fields([
          'field_do_you_have_students_' => $have_students,
        ])
        ->execute();

    $query = db_query("SELECT `user_uid`, `field_do_you_have_students_`, `field_do_you_have_teaching_exper`, `field_have_you_created_video_bef` FROM `become_teacher` WHERE `user_uid` = $user_id")->fetchAll();
    foreach ($query as $key => $value) {
      $have_student = $value->field_do_you_have_students_;
      $teach_before = $value->field_do_you_have_teaching_exper;
      $cr_video_before = $value->field_have_you_created_video_bef;
    }
    // Check for the data value of have student;;
    if ($have_student == '0') {
      $have_student_value = 'Yes';
    } else {
      $have_student_value = 'No';
    }
    // Check the data for tching experiance;;
    if ($teach_before == '0') {
      $teach_before_value = 'Yes';
    } else {
      $teach_before_value = 'No';
    }
    // Check the data for upload any video before;;
    if ($cr_video_before == '0') {
      $cr_video_before_value = 'No';
    } elseif ($cr_video_before == '1') {
      $cr_video_before_value = 'A little';
    }else {
      $cr_video_before_value = 'Often';
    }
    
    // Create User profile
     $profile = \Drupal\profile\Entity\Profile::create([
          'uid' => $user_id,
          'type' => 'teacher',
          'created' => time(),
          'status' => '1', 
          'field_do_you_have_students_' => $have_student_value,
          'field_do_you_have_teaching_exper' => $teach_before_value, 
          'field_have_you_created_video_bef' => $cr_video_before_value, 
        ]);
      $profile->save();
      
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $user->addRole('teacher');
    $user1 = $user->save();

    //drupal_set_message("Let's create Your Course");
    global $base_url;
    $url = $base_url.'/become-teacher/result';
    $response = new RedirectResponse($url);
    $response->send(); 
  }
}