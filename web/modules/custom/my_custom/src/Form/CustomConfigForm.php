<?php
namespace Drupal\my_custom\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
* Class CustomConfigForm.
*/
class CustomConfigForm extends ConfigFormBase {
 /**
  * {@inheritdoc}
  */
protected function getEditableConfigNames() { return [
     'my_custom.customconfig',
   ];
}
 /**
  * {@inheritdoc}
  */
public function getFormId() { return 'custom_config_form';
}
 /**
  * {@inheritdoc}
  */
public function buildForm(array $form, FormStateInterface $form_state) {
   $config = $this->config('my_custom.customconfig');
   $form['my_custom'] = array(
     '#type' => 'details',
     '#title' => $this->t('Add Custom Assets'),
     '#open' => TRUE,
   );
   $form['my_custom']['type'] = [
    '#type' => 'select',
    '#title' => $this->t('Assets Type'),
    '#default_value' => $config->get('type'),
    '#options' => [
      '1' => $this
        ->t('Default'),
      '2' => $this
          ->t('Custom'),
    ],
    '#maxlength' => NULL,
];
   $form['my_custom']['paths'] = [
     '#type' => 'textarea',
     '#title' => $this->t('Assets Paths'),
     '#default_value' => $config->get('paths'),
     '#maxlength' => NULL,
];
  $form['my_custom']['paths']['#states'] = [
  'invisible' => [
    ['select[name="type"]' => ['value' => '1']],
  ],

  ];
   return parent::buildForm($form, $form_state);
 }
 /**
  * {@inheritdoc}
  */
public function submitForm(array &$form, FormStateInterface $form_state) {
   parent::submitForm($form, $form_state);
   $this->config('my_custom.customconfig')
   ->set('type', $form_state->getValue('type'))
   ->save();
   $this->config('my_custom.customconfig')
     ->set('paths', $form_state->getValue('paths'))
     ->save();
} }