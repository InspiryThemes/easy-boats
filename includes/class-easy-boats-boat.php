<?php
/**
 * Represents a boat.
 *
 * This class provides utility functions related to a boat.
 *
 *
 * @since      1.0.0
 * @package    Easy_Boats
 * @subpackage Easy_Boats/includes
 * @author     InspiryThemes <info@inspirythemes.com>
 */

class Easy_Boats_Boat {

    /**
     * @var int $boat_id contains boat post id.
     */
    private $boat_id;

    /**
     * @var array boat meta keys
     */
    private $meta_keys = array(
        'custom_id'             => 'EASYBOATS_boat_id',
        'price'                 => 'EASYBOATS_boat_price',
        'boat_featured'         => 'EASYBOATS_featured',
        'boat_built_year'       => 'EASYBOATS_boat_built_year',
        'length'                => 'EASYBOATS_boat_length',
        'length_postfix'        => 'EASYBOATS_boat_length_postfix',
        'video_url'             => 'EASYBOATS_tour_video_url',
        'agent_display_option'  => 'EASYBOATS_agent_display_option',
        'agent_id'              => 'EASYBOATS_agents',
        'slider_image'          => 'EASYBOATS_slider_image',
        'specifications'        => 'EASYBOATS_specifications',
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
     * Return boat built year
     * @return bool|mixed
     */
    public function get_featured_tag(){
        if ( ! $this->boat_id ) {
            return false;
        }
        return $this->get_boat_meta( $this->meta_keys['boat_featured'] );
    }

    /**
     * Get gallery number of images
     * @return bool|int
     */
	public function get_images_count() {
		if ( ! $this->boat_id ) {
			return false;
		}

		if ( isset( $this->meta_data['EASYBOATS_boat_images'] ) ) {
			return count( $this->meta_data['EASYBOATS_boat_images'] );
		}

		return false;
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
        return $this->format_price( $price_amount );
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
        $easy_boats = Easy_Boats::get_instance();

        if( $price_amount ) {

            $currency_sign      = $easy_boats->get_currency_sign();
            $number_of_decimals = $easy_boats->get_number_of_decimals();
            $decimal_separator  = $easy_boats->get_decimal_separator();
            $thousand_separator = $easy_boats->get_thousand_separator();
            $currency_position  = $easy_boats->get_currency_position();

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

            return $easy_boats->get_empty_price_text();

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
     * Return boat specifications
     * @return bool|mixed
     */
    public function get_specifications() {
        if ( ! $this->boat_id ) {
            return false;
        }
        return maybe_unserialize ( $this->get_boat_meta( $this->meta_keys['specifications'] ) );
    }

    /**
     * Return boat types
     * @return bool|null|string
     */
    public function get_types() {
        return $this->get_taxonomy_terms( 'boat-type' );
    }

    /**
     * Return boat hull types
     * @return bool|null|string
     */
    public function get_hull_types() {
        return $this->get_taxonomy_terms( 'boat-hull-type' );
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