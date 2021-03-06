<?php
/**
 * Represents a boat agent.
 *
 * This class provides utility functions related to a boat agent.
 *
 *
 * @since      1.0.0
 * @package    Easy_Boats
 * @subpackage Easy_Boats/includes
 * @author     InspiryThemes <info@inspirythemes.com>
 */

class Easy_Boats_Agent {

    private $agent_id;

    /**
     * @var array agent meta keys
     */
    private $meta_keys = array(
        'job_title'     => 'EASYBOATS_job_title',
        'mobile'        => 'EASYBOATS_mobile_number',
        'office'        => 'EASYBOATS_office_number',
        'fax'           => 'EASYBOATS_fax_number',
        'email'         => 'EASYBOATS_agent_email',
        'office_address'=> 'EASYBOATS_office_address',
        'facebook'      => 'EASYBOATS_facebook_url',
        'twitter'       => 'EASYBOATS_twitter_url',
        'google'        => 'EASYBOATS_google_plus_url',
        'youtube'       => 'EASYBOATS_youtube_url',
        'linkedin'      => 'EASYBOATS_linked_in_url',
        'pinterest'     => 'EASYBOATS_pinterest_url',
        'instagram'     => 'EASYBOATS_instagram_url',
    );

    /**
     * @var array   $meta_data  contains custom fields data related to a agent
     */
    private $meta_data;

    /**
     * @param int $agent_id
     */
    public function __construct( $agent_id = null ) {

        if ( !$agent_id ) {
            $agent_id = get_the_ID();
        } else {
            $agent_id = intval( $agent_id );
        }

        if ( $agent_id > 0 ) {
            $this->agent_id = $agent_id;
            $this->meta_data = get_post_custom( $agent_id );
        }
    }

    /**
     * Return agent meta
     *
     * @param $meta_key
     * @return mixed|bool
     */
    public function get_boat_meta( $meta_key ) {
        if ( isset( $this->meta_data[ $meta_key ] ) ) {
            return $this->meta_data[ $meta_key ][0];
        } else {
            return false;
        }
    }

    /**
     * Return agent post id
     * @return bool|mixed
     */
    public function get_post_ID(){
        return $this->agent_id;
    }

    /**
     * Return mobile number
     * @return bool|mixed
     */
    public function get_mobile(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['mobile'] );
    }

    /**
     * Return office phone number
     * @return bool|mixed
     */
    public function get_office_phone(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['office'] );
    }

    /**
     * Return fax number
     * @return bool|mixed
     */
    public function get_fax(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['fax'] );
    }

    /**
     * Return email address
     * @return bool|mixed
     */
    public function get_email(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return is_email( $this->get_boat_meta( $this->meta_keys['email'] ) );
    }

    /**
     * Return twitter URL
     * @return bool|mixed
     */
    public function get_twitter(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['twitter'] );
    }

    /**
     * Return facebook URL
     * @return bool|mixed
     */
    public function get_facebook(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['facebook'] );
    }

    /**
     * Return google URL
     * @return bool|mixed
     */
    public function get_google(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['google'] );
    }

    /**
     * Return youtube URL
     * @return bool|mixed
     */
    public function get_youtube(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['youtube'] );
    }

    /**
     * Return instagram URL
     * @return bool|mixed
     */
    public function get_instagram(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['instagram'] );
    }

    /**
     * Return linkedin URL
     * @return bool|mixed
     */
    public function get_linkedin(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['linkedin'] );
    }

    /**
     * Return pinterest URL
     * @return bool|mixed
     */
    public function get_pinterest(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['pinterest'] );
    }

    /**
     * Return job title
     * @return bool|mixed
     */
    public function get_job_title(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['job_title'] );
    }

    /**
     * Return office address
     * @return bool|mixed
     */
    public function get_office_address(){
        if ( ! $this->agent_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['office_address'] );
    }

}