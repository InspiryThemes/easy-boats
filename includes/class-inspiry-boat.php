<?php
/**
 * Represents a real estate boat.
 *
 * This class provides utility functions related to a real estate boat.
 *
 *
 * @since      1.0.0
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/includes
 * @author     InspiryThemes <info@inspirythemes.com>
 */

class Inspiry_Boat {

    /**
     * @var int $boat_id contains boat post id.
     */
    private $boat_id;

    /**
     * @var array boat meta keys
     */
    private $meta_keys = array(
        'custom_id'             => 'YACHTPRESS_boat_id',
        'price'                 => 'YACHTPRESS_boat_price',
        'length'                => 'YACHTPRESS_boat_length',
        'length_postfix'        => 'YACHTPRESS_boat_length_postfix',
        'built_year'            => 'YACHTPRESS_boat_built_year',
        'video_url'             => 'YACHTPRESS_tour_video_url',
        'video_image'           => 'YACHTPRESS_tour_video_image',
        'agent_display_option'  => 'YACHTPRESS_agent_display_option',
        'agent_id'              => 'YACHTPRESS_agents',
        'slider_image'          => 'YACHTPRESS_slider_image',
    );

    /**
     * @var array   $meta_data  contains custom fields data related to a boat
     */
    private $meta_data;


    /**
     * @param int $boat_id
     */
    public function __construct( $boat_id = null ) {

        if ( !$boat_id ) {
            $boat_id = get_the_ID();
        } else {
            $boat_id = intval( $boat_id );
        }

        if ( $boat_id > 0 ) {
            $this->boat_id = $boat_id;
            $this->meta_data = get_post_custom( $boat_id );
        }

    }

    /**
     * Return boat meta
     *
     * @param $meta_key
     * @return mixed
     */
    public function get_boat_meta( $meta_key ) {
        if ( isset( $this->meta_data[ $meta_key ] ) ) {
            return $this->meta_data[ $meta_key ][0];
        } else {
            return false;
        }
    }

    /**
     * Return boat post id
     * @return bool|mixed
     */
    public function get_post_ID(){
        return $this->boat_id;
    }

    /**
     * Return boat custom id
     * @return bool|mixed
     */
    public function get_custom_ID(){
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['custom_id'] );
    }

    /**
     * Return boat length
     * @return bool|mixed
     */
    public function get_length(){
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['length'] );
    }

    /**
     * Return boat length postfix
     * @return bool|mixed
     */
    public function get_length_postfix(){
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['length_postfix'] );
    }

    /**
     * Return boat built year
     * @return bool|mixed
     */
    public function get_year(){
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['boat_built_year'] );
    }

    /**
     * Get agent display option
     * @return bool|mixed
     */
    public function get_agent_display_option() {
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['agent_display_option'] );
    }

    /**
     * Get agent id
     * @return bool|mixed
     */
    public function get_agent_id() {
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['agent_id'] );
    }

    /**
     * Get multiple agents ids
     * @return bool|mixed
     */
    public function get_agents_ids() {

        if ( ! $this->boat_id ) {
            return false;
        }

	    if ( isset( $this->meta_data[ $this->meta_keys['agent_id'] ] ) ) {
		    return $this->meta_data[ $this->meta_keys['agent_id'] ];
	    }

	    return false;
    }

    /**
     * Get slider image URL
     * @return bool|string
     */
    public function get_slider_image() {
        if ( ! $this->boat_id ) {
            return false;
        }

        $slider_image_id = $this->get_boat_meta( $this->meta_keys['slider_image'] );
        if ( $slider_image_id ) {
            return wp_get_attachment_url( $slider_image_id );
        }

        return false;
    }

    /**
     * Display boat price
     */
    public function price() {
        if ( ! $this->boat_id ) {
            return false;
        }
        echo $this->get_price();
    }

    /**
     * Returns boat price
     * @return string price
     */
    public function get_price() {
        if ( ! $this->boat_id ) {
            return null;
        }
        $price_amount = doubleval( $this->get_boat_meta( $this->meta_keys[ 'price' ] ) );
        $price_postfix = $this->get_boat_meta( $this->meta_keys[ 'price_postfix' ] );
        return $this->format_price( $price_amount, $price_postfix );
    }

    /**
     * Provide formatted price
     *
     * @param int|double|float $price_amount    price amount
     * @param string $price_postfix    price post fix
     * @return null|string  formatted price
     */
    public static function format_price ( $price_amount, $price_postfix = '' ) {

        // get related plugin options
        $inspiry_yachtpress = Inspiry_Yachtpress::get_instance();

        if( $price_amount ) {

            $currency_sign      = $inspiry_yachtpress->get_currency_sign();
            $number_of_decimals = $inspiry_yachtpress->get_number_of_decimals();
            $decimal_separator  = $inspiry_yachtpress->get_decimal_separator();
            $thousand_separator = $inspiry_yachtpress->get_thousand_separator();
            $currency_position  = $inspiry_yachtpress->get_currency_position();

            // format price
            $formatted_price = number_format( $price_amount, $number_of_decimals, $decimal_separator, $thousand_separator );

            // add currency and post fix
            if( $currency_position == 'after' ) {
                $formatted_price = $formatted_price . $currency_sign;
            } else {
                $formatted_price = $currency_sign . $formatted_price;
            }

            if ( !empty( $price_postfix ) ) {
                $formatted_price = $formatted_price . ' ' . $price_postfix;
            }

            return $formatted_price;

        } else {

            return $inspiry_yachtpress->get_empty_price_text();

        }

    }

    /**
     * Returns boat price without postfix
     * @return string price
     */
    public function get_price_without_postfix() {
        if ( ! $this->boat_id ) {
            return null;
        }
        $price_amount = doubleval( $this->get_boat_meta( $this->meta_keys[ 'price' ] ) );
        return $this->format_price( $price_amount );
    }

    /**
     * Returns boat price postfix
     * @return string price postfix
     */
    public function get_price_postfix() {
        if ( ! $this->boat_id ) {
            return null;
        }
        $price_postfix = $this->get_boat_meta( $this->meta_keys[ 'price_postfix' ] );
        return $price_postfix;
    }

    /**
     * Returns url of video if exists
     * @return mixed|null
     */
    public function get_video_url() {
        if ( !$this->boat_id ) {
            return null;
        }
        $video_url = $this->get_boat_meta( $this->meta_keys[ 'video_url' ] );
        return $video_url;
    }

    /**
     * Return video image id if exists
     * @return mixed|null
     */
    public function get_video_image() {
        if ( !$this->boat_id ) {
            return null;
        }
        $video_url = $this->get_boat_meta( $this->meta_keys[ 'video_image' ] );
        return $video_url;
    }

    /**
     * Return boat types
     * @return bool|null|string
     */
    public function get_types() {
        return $this->get_taxonomy_terms( 'boat-type' );
    }

    /**
     * Return boat status
     * @return bool|null|string
     */
    public function get_status() {
        return $this->get_taxonomy_terms( 'boat-status' );
    }

    /**
     * Return boat location
     * @return bool|null|string
     */
    public function get_location() {
        return $this->get_taxonomy_terms( 'boat-location' );
    }

    /**
     * Return taxonomy terms
     * @param $taxonomy
     * @return bool|null|string
     */
    public function get_taxonomy_terms( $taxonomy ) {
        if ( !$this->boat_id || !$taxonomy || !taxonomy_exists( $taxonomy ) ) {
            return false;
        }
        $taxonomy_terms = get_the_terms( $this->boat_id, $taxonomy );
        if ( !empty( $taxonomy_terms ) && !is_wp_error( $taxonomy_terms ) ) {
            $terms_count = count( $taxonomy_terms );
            $taxonomy_terms_str = '';
            $loop_count = 1;
            foreach ( $taxonomy_terms as $single_term ) {
                $taxonomy_terms_str .= $single_term->name;
                if ( $loop_count < $terms_count ) {
                    $taxonomy_terms_str .= ', ';
                }
                $loop_count++;
            }
            return $taxonomy_terms_str;
        }
        return null;
    }

    /**
     * Return slug or name of first term of given taxonomy
     * @param $taxonomy
     * @param string $field
     * @return null|string|mixed
     */
    public function get_taxonomy_first_term( $taxonomy, $field = 'slug' ) {
        if ( !$this->boat_id || !$taxonomy || !taxonomy_exists( $taxonomy ) ) {
            return null;
        }
        $taxonomy_terms = get_the_terms( $this->boat_id, $taxonomy );
        if ( !empty( $taxonomy_terms ) && !is_wp_error( $taxonomy_terms ) ) {
            foreach ( $taxonomy_terms as $single_term ) {
                if ( $field == 'name' ){
                    return $single_term->name;
                } elseif ( $field == 'slug' ){
                    return $single_term->slug;
                } else {
                    return $single_term;
                }
            }
        }
        return null;
    }

}