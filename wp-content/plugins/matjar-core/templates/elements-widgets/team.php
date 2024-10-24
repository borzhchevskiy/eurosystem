<?php 
/**
 * Team Template
 */
?>

<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class ); ?>">	
	<div class="<?php echo $slider_class;?>" <?php if(!empty( $owl_options ) ){ echo 'data-owl_options="'.esc_attr( $owl_options ).'"';  } ?> >
		<?php 
			foreach( $team_members as $member_data){
				$team_args = $member_data;
				$team_args['id'] 		= matjar_uniqid('matjar-team-member-');
				$team_args['member_class'] 		= $member_class;
				$team_args['style']				= $style;
				$team_args['img_size']			= $img_size;
				$team_args['bg_color']			= $bg_color;
				$team_args['hover_bg_color']	= $hover_bg_color;
				$team_args['image'] 		= '';
				if(!empty($member_data['image']['id'])){
					$image_output 		= wp_get_attachment_image( $member_data['image']['id'],  $img_size, false );
					$team_args['image'] 		= $image_output;
				}elseif( !empty( $member_data['image']['url'] ) ){
					$team_args['image'] 		= '<img src="'.$member_data['image']['url'].'"/>';
				}
				
				$team_args['class']	= 'matjar-team-member'.' '.$member_class;
				$team_social_data = array();
				if( ! empty( $member_data['facebook'] ) ){
					$team_social_data[] = array(
						'class'	=> 'facebook',
						'icon'	=> 'jricon-facebook',
						'link'	=> $member_data['facebook'],
					);
				}
				if( ! empty( $member_data['twitter'] ) ){
					$team_social_data[] = array(
						'class'	=> 'twitter',
						'icon'	=> 'jricon-x-twitter',
						'link'	=> $member_data['twitter'],
					);
				}
				if( ! empty( $member_data['google_plus'] ) ){
					$team_social_data[] = array(
						'class'	=> 'google-plus',
						'icon'	=> 'jricon-google-plus',
						'link'	=> $member_data['google_plus'],
					);
				}
				if( ! empty( $member_data['linkedin'] ) ){
					$team_social_data[] = array(
						'class'	=> 'linkedin',
						'icon'	=> 'jricon-linkedin',
						'link'	=> $member_data['linkedin'],
					);
				}
				if( ! empty( $member_data['skype'] ) ){
					$team_social_data[] = array(
						'class'	=> 'skype',
						'icon'	=> 'jricon-skype',
						'link'	=> $member_data['skype'],
					);
				}
				if( ! empty( $member_data['instagram'] ) ){
					$team_social_data[] = array(
						'class'	=> 'instagram',
						'icon'	=> 'jricon-instagram',
						'link'	=> $member_data['instagram'],
					);
				}
				if( ! empty( $member_data['youtube'] ) ){
					$team_social_data[] = array(
						'class'	=> 'youtube',
						'icon'	=> 'jricon-youtube',
						'link'	=> $member_data['youtube'],
					);
				}
				$team_args['team_social_data'] 	= $team_social_data;
				//var_dump($team_social_data);
				matjar_get_pl_templates('elements-widgets/team/'.$style, $team_args );
			}
		?>
	</div>
</div>