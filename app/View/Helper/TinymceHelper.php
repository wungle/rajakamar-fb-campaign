<?php

// View/TinymceHelper.php
App::uses('AppHelper', 'View/Helper');
/**
* TinymceHelper
*/
class TinymceHelper extends AppHelper
{
   // load another helper
   public $helpers      = array('Form', 'Html', 'Js');
 
   // check if tiny_mce.js is loaded
   public $_script      = false;
 
   // set plugins for tiny mce
   public $plugins      = array('plugins' => array(
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste'
   ));
   /**
    * load tiny_mce.js and construct the options
    * 
    * @param String $fieldName ==> Name of field, like this 'Model.fieldName'
    * @param array $tinymceOptions ==> attributes for tiny mce
    * @return String Javascript code to iniliaze the tinyMCE
    * */
   function _build($fieldName, $tinymceOptions = array())
   {
      if($this->_script){
         $this->_script       = true;
         $this->Html->script('tinymce/tinymce.min', array('inline' => false));
      }
 
      // Ties option to the field
      $value_arr        = array();
      $replace_keys     = array();
      foreach ($tinymceOptions as $key => $value) {
         // Check if the value_arr start with function(
         if(strpos($value, 'function(') === 0){
            $value_arr[]      = $value;
            $value            = '%'.$key.'%';
            $replace_keys[]   = '"'.$value.'"';
         }
      }
 
      // replce the function 
      $json          = str_replace($replace_keys, $value_arr, $tinymceOptions);
      
      // merge with plugins
      $json          = array_merge($json, $this->plugins);
      return $this->Html->scriptBlock('tinymce.init('.$this->Js->object($json).');', array('inline' => false));
   }
 
   /**
    * @param String @fieldName, name of field, like this 'Model.fieldName'
    * @param Array $options, Option for form helper, HTML attributes
    * @param Array $tinyOptions, tiny mce option
    * @param String $prese, preset for tiny mce
    */
   public function textarea($fieldName, $options = array(), $tinyOptions = array(), $preset = null){
      $presetOptions    = $this->preset($preset);
      
      if(is_array($tinyOptions)){
         $tinyOptions   = array_merge($presetOptions, $tinyOptions);
      }
      return $this->Form->textarea($fieldName, (array)$options). $this->_build($fieldName, (array)$tinyOptions);
   }
 
   public function input($fieldName, $options = array(), $tinyOptions = array(), $preset = null){
      $presetOptions    = $this->preset($preset);
      
      if(is_array($tinyOptions)){
         $tinyOptions   = array_merge($presetOptions, $tinyOptions);
      }
 
      $options['type']  = 'textarea';
      return $this->Form->input($fieldName, (array)$options). $this->_build($fieldName, (array)$tinyOptions);
   }
 
   public function preset($name = null){
      $preset     = empty($name) ? 'simple' : $name;
 
      switch ($name) {
         case 'simple':
            $optionPresets    = array(
               'selector' => 'textarea',
               'menubar' => 'false', 
               'theme' => 'modern', 
               'toolbar1' => 'bold italic | alignleft aligncenter alignright alignjustify | link | emoticons'
            );
            break;
         case 'basic':
            $optionPresets    = array(
               'selector' => 'textarea', 
               'theme' => 'modern', 
               'toolbar1' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code'
            );
            break;
         case 'full':
            $optionPresets    = array(
               'selector' => 'textarea', 
               'theme' => 'modern', 
               'toolbar1' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code fullscreen preview media', 
               'toolbar2' => 'visualchars forecolor backcolor emoticons'
            );
         break;
         default:
             $optionPresets    = array(
               'selector' => 'textarea', 
               'theme' => 'modern', 
               'toolbar1' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code'
            );
            break;
      }
      return $optionPresets;
   }
}