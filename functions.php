<?php
# Ignore the line above


#region vCard downloads
#region Example
function edg_vcard_dls_example() {
	$post_id = $_POST[ 'id' ];
	$post = get_post( $post_id );

	if ( ! $post ) return;

	$upload_dir = wp_upload_dir();
	$base_dir = $upload_dir[ 'basedir' ];
	$base_url = $upload_dir[ 'baseurl' ];
	$folder_path = '/vcards/example/';

	$profile_picture = get_the_post_thumbnail_url( $post_id, 'full' );
	$first_name = get_post_meta( $post_id, 'first-name', true );
	$last_name = get_post_meta( $post_id, 'last-name', true );
	$title = get_post_meta( $post_id, 'position', true );
	$company = get_post_meta( $post_id, 'company-name', true );
	$phone = get_post_meta( $post_id, 'business-phone', true );
	$email = get_post_meta( $post_id, 'business-email', true );
	$website = get_post_meta( $post_id, 'website', true );
	$addr_1 = get_post_meta( $post_id, 'street-and-house-number', true );
	$addr_2 = get_post_meta( $post_id, 'zip-code-and-city', true );
	$addr_3 = get_post_meta( $post_id, 'country', true );
	$birthdate = get_post_meta( $post_id, 'birthdate', true );
	$post_url = wp_get_shortlink( $post_id );
	$data_note_post_url = 'Profil-URL: %s';

	$profile_picture_path = get_home_path() . str_replace( home_url(), '', $profile_picture );
	$ext = pathinfo( $profile_picture_path, PATHINFO_EXTENSION );

	# ID 1: Fallback image
	if ( file_exists( $profile_picture_path ) && ! empty( $profile_picture ) ) {
		$profile_picture = base64_encode( file_get_contents( $profile_picture ) );
	} else {
		$profile_picture = base64_encode( file_get_contents( wp_get_attachment_image_url( 1, 'full' ) ) );
	}

	$birthdate_res = false;
	$today = new DateTime();
	$birthdate_date = '';

	if ( is_numeric( $birthdate ) ) {
		$birthdate_date = date_i18n( 'Y-m-d', $birthdate );
		$birthdate_res = date_create( $birthdate_date );
	} else {
		$birthdate_res = date_create( $birthdate );
	}

	if ( ! $birthdate || ! $birthdate_res || ! $birthdate_res->format( 'Y-m-d' ) || $birthdate_res > $today ) {
		$birthdate_res = '';
	} else {
		$birthdate_res = $birthdate_res->format( 'Y-m-d' );
	}

	$filename = $post->post_name . '.vcf';
	$filepath = $base_dir . $folder_path . $filename;
	$file = fopen( $filepath, 'w' );

	header( 'Content-Type: text/x-vcard; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=' . $filename );

	$data = 'BEGIN:VCARD' . "\n";
	$data .= 'VERSION:3.0' . "\n";
	$data .= 'PHOTO;TYPE=' . strtoupper( $ext ) . ';ENCODING=BASE64:' . $profile_picture . "\n";
	$data .= 'N:' . $last_name . ';' . $first_name . "\n";
	$data .= 'FN:' . $first_name . ' ' . $last_name . "\n";
	$data .= 'TITLE:' . $title . "\n";
	$data .= 'ORG:' . $company . "\n";
	$data .= 'TEL:' . $phone . "\n";
	$data .= 'EMAIL:' . $email . "\n";
	$data .= 'URL:' . $website . "\n";
	$data .= 'ADR:' . $addr_1 . ';' . $addr_2 . ';' . $addr_3 . "\n";
	$data .= 'BDAY:' . $birthdate_res . "\n";
	$data .= 'NOTE:' . sprintf( $data_note_post_url, $post_url ) . "\n";
	$data .= 'REV:' . date_i18n( 'd.m.Y (H:i:s)' ) . "\n";
	$data .= 'END:VCARD';

	fwrite( $file, $data );
	fclose( $file );
	$file_url = $base_url . $folder_path . $filename;
	$res = [ 'fileUrl' => $file_url ];

	echo wp_json_encode( $res );
	exit;
}
add_action( 'wp_ajax_edg_vcard_dls_example', 'edg_vcard_dls_example' );
add_action( 'wp_ajax_nopriv_edg_vcard_dls_example', 'edg_vcard_dls_example' );
#endregion Example
#endregion vCard downloads
