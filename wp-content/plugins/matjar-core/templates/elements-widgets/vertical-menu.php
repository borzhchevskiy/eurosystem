<?php 
/**
 * Categories Menu
 **/
?>
<div class="<?php echo esc_attr($class);?>">
	<div class="categories-menu-wrapper">
		<div class="categories-menu-title">
			<?php 
			if($menu_icon && $icon_alignment == 'left'){
				echo $icon_html;
			}
			?>
			<span class="title"><?php echo $title;?></span>
			<?php 
			if($menu_icon && $icon_alignment == 'right'){
				echo $icon_html;
			}
			?>
		</div>
		<?php if ( has_nav_menu( 'categories-menu' ) ) {
			wp_nav_menu( 
				array( 
					'theme_location' 	=> 'categories-menu',
					'container_class'   => 'categories-menu matjar-navigation',
					'walker' 			=> new Matjar_Mega_Menu_Walker()
				)
			); 
		}?>
	</div>
</div>