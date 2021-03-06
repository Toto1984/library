<?php
/**
 * In this snippet we add a start date field
 * to the campaign form which allows campaign
 * creators to specify when their campaign should
 * begin.
 */
function ed_charitable_add_start_date_field( $fields, $form ) {
    if ( isset( $_POST['post_date'] ) ) {
        $value = $_POST['post_date'];
    } elseif ( $form->get_campaign() ) {
        $value = $form->get_campaign->post_date;
    } else {
        $value = '';
    }

    $fields['post_date'] = array(
        'label'       => 'Start Date',
        'type'        => 'datepicker',
        'priority'    => 8, 
        'required'    => true, 
        'value'       => $value,
        'data_type'   => 'core',
        'editable'    => false,
        'placeholder' => 'Start Date',
    );
    
    return $fields;
}

add_filter( 'charitable_campaign_submission_campaign_fields', 'ed_charitable_add_start_date_field', 10, 2 );

function ed_charitable_sanitize_start_date( $values ) {
    $values['post_date'] = date( 'Y-m-d 00:00:00', strtotime( $values['post_date'] ) );
    return $values;
}

add_filter( 'charitable_campaign_submission_core_data', 'ed_charitable_sanitize_start_date' );