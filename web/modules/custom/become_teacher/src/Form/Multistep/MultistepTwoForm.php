<?php
/**
 * @file
 * Contains \Drupal\become_teacher\Form\Multistep\MultistepTwoForm.
 */

namespace Drupal\become_teacher\Form\Multistep;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MultistepTwoForm extends MultistepFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'multistep_form_two';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['teached_before'] = array(
      '#type' => 'radios',
      '#title' => t('do you have teaching experiance?'),
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
    //   '#url' => Url::fromRoute('become_teacher.multistep_one'),
    // );
    $form['actions']['submit']['#value'] = $this->t('Next');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $teached_before = $form_state->getValue('teached_before');
    $user_id = \Drupal::currentUser()->id();
    \Drupal::database()->update('become_teacher')
        ->condition('user_uid' , $user_id)
        ->fields([
          'field_do_you_have_teaching_exper' => $teached_before,
        ])
        ->execute();
    $form_state->setRedirect('become_teacher.multistep_three');
  }
}