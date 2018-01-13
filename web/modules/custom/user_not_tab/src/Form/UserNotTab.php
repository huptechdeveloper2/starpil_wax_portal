<?php

namespace Drupal\user_not_tab\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class NotificationUserSettingsForm.
 *
 * @package Drupal\user_not_tab\Form
 */
class UserNotTab extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_notification_tab';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // CHECK NOTIFICATION STATUS FOR LOGIN USER
    $user_id = \Drupal::currentUser()->id();
    $query = db_query("SELECT `notifyuid`, `get_notify` FROM `user_not_tab` WHERE `notifyuid` = '$user_id'")->fetchAll();
    $user_noti = $query['0']->get_notify;
    if ($user_noti == '1') {
      $default = TRUE;
    } else {
      $default = FALSE;
    }
    
    // BUILD FORM
    $form['get_notification'] = array(
	  '#type' => 'checkbox',
	  '#title' => $this->t('Show me Notifications Related To Courses.'),
    '#default_value' => $default,
	   );

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) { 

    $user_id = \Drupal::currentUser()->id();
    foreach ($form_state->getValues() as $key => $value) {
      if ($key == 'get_notification') {
        $get_notify = $value;
      }
    }
    // Check user has already fill that form or not
    $query = db_query("SELECT `notifyuid` as `uid` FROM `user_not_tab`")->fetchAll();
    foreach ($query as $key => $value) {
      $row[] = $value->uid;
    }
    if (in_array($user_id, $row)) {
      \Drupal::database()->update('user_not_tab')
        ->condition('notifyuid' , $user_id)
        ->fields([
          'get_notify' => $get_notify,
        ])
        ->execute();
    } else {
      \Drupal::database()->insert('user_not_tab')
         ->fields([
           'notifyuid',  
           'get_notify',  
         ])
         ->values(array(
           $user_id,  
           $get_notify  
         ))
         ->execute();
    }
     drupal_set_message('Your Form has been Submitted.');
   }
}
