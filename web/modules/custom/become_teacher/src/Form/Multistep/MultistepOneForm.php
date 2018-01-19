<?php
/**
 * @file
 * Contains \Drupal\become_teacher\Form\Multistep\MultistepOneForm.
 */

namespace Drupal\become_teacher\Form\Multistep;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Drupal\profile\Entity\ProfileInterface;
use Drupal\profile\Entity\ProfileTypeInterface;
use Drupal\profile\Entity\Profile;

class MultistepOneForm extends MultistepFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'multistep_form_one';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['created_before'] = array(
      '#type' => 'radios',
      '#title' => t('Have you created video before?'),
      '#description' => t('Specify ur site.'),
      '#required' => TRUE,
      '#options' => array(
                    t('No'),
                    t('A little'),
                    t('Often'),
                    )
      );

    $form['actions']['submit']['#value'] = $this->t('Next');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $created_before = $form_state->getValue('created_before');
    // Load the current user.
    $user_id = \Drupal::currentUser()->id();
    $check_user_data = db_query("SELECT `user_uid` FROM `become_teacher` WHERE `user_uid` = $user_id")->fetchAll();
    if (isset($check_user_data) && !empty($check_user_data)) {
      $data_update = db_query("UPDATE `become_teacher` SET `field_have_you_created_video_bef`= $created_before WHERE `user_uid` = $user_id");
    } else {
      \Drupal::database()->insert('become_teacher')
         ->fields([
           'user_uid',  
           'field_do_you_have_students_',  
           'field_do_you_have_teaching_exper',  
           'field_have_you_created_video_bef', 
         ])
         ->values(array(
           $user_id,  
           '0', 
           '0',  
           $created_before  
         ))
         ->execute();
    }
     $form_state->setRedirect('become_teacher.multistep_two');
  }
}