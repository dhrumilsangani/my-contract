<?php


$constants = [
    'LIST_PER_PAGE' => 10,
    /* Sales agent lead detail fields */
    'uploadPath' => '/uploads/document/',
    'categorieImagePath' => '/uploads/categorie/image/',
    'contractImagePath' => '/uploads/contract/image/',
    'testimonialPath' => '/uploads/testimonial/',
    'teamPath' => '/uploads/team/',
    'templatePath' => '/uploads/template/',

    'fromEmail' => env('MAIL_FROM_ADDRESS'),
    'emailUsername' => env('MAIL_USERNAME'),
    'emailPassword' => env('MAIL_PASSWORD'),
    'emailEncryption' => env('MAIL_ENCRYPTION'),
    'emailHost' => env('MAIL_HOST'),
    

    
    
    'FormFields' => array(
        'Program',
        'Account Number',
        'Authorized First name',
        'Authorized Middle initial',
        'Authorized Last name',
        'rate',
        'etf',
        // 'Program Code',
        'msf',
        'term',
        'Account Number Length',
        'Account Number Type',
        'accountnumbertypename',
        'GasServiceZip',
        'GasServiceCity',
        'ServiceState',
        'GasServiceAddress',
        'GasServiceAddress2',
        'Gas Billing first name',
        'Gas Billing middle name',
        'Gas Billing last name',
        'GasBillingAddress',
        'GasBillingAddress2',
        'GasBillingZip',
        'GasBillingCity',
        'GasBillingState',
        'gasutility',
        'gas_rate',
        'gas_term',
        'gas_msf',
        'gasutility',
        'GasProgram',
        'Gas Account Number',
        'ServiceZip',
        'ServiceCity',
        'ServiceAddress',
        'ServiceAddress2',
        'Electric Billing first name',
        'Electric Billing middle name',
        'Electric Billing last name',
        'ElectricBillingAddress',
        'ElectricBillingAddress2',
        'ElectricBillingZip',
        'ElectricBillingCity',
        'ElectricBillingState',
        'electricutility',
        'ElectricProgram',
        'electric_rate',
        'electric_term',
        'electric_msf',
        'electric_etf',
        'Electric Account Number',
        'Agent Name Key',
        'Service Reference Id',
        'Gas Agent Name Key',
        'Gas Service Reference Id',
        'Electric Agent Name Key',
        'Electric Service Reference Id'

    ),
    "Common_fields_for_script" => array(
        "[Tpvagent]",
        "[Client]",
        "[ClientPhone]",
        "[Client ID Verification Box]",
        "[Agent ID Verification Box]",
        "[Telesale ID Verification Box]",
        "[Lead Verification ID]",
        "[Date]",
        "[Time]"
    ),
  

    'newFormFields' => array(
      'address' => 'Address',
      'checkbox' => 'Checkbox',
      'email' => 'Email',
      'full_name' => 'Full Name',
      'heading' => 'Heading',
      'label' => 'Label',
      'phone_number' => 'Phone Number',
      'radio' => 'Radio',
      'selectbox' => 'Selectbox',
      'separator' => 'Separator',
      'service_and_billing_address' => 'Service and billing address',
      'textarea' => 'Text area',
      'textbox' => 'Text box'
    ),
  


    'GENERAL_TAGS' => [
        'DATE','TIME','TPVAGENT','VERIFICATION CODE' ,'LEAD ID', 'CHANNEL'
    ],

    'Tags_Category_Names' => [
        1 => 'General Info',
        2 => 'Addresses',
        3 => 'Program Info',
        4 => 'Enrollment Detail'
    ],
];

return $constants;
