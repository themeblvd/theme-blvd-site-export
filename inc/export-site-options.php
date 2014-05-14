<?php echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\" ?>\n"; ?>
<site>
	<settings>
		<?php
		$count = 1;
		foreach ( $settings as $option_id => $setting ) {

			if ( $count > 1 ) {
				echo "\t\t";
			}

			echo "<setting>\n";
			echo "\t\t\t<id>$option_id</id>\n";
			echo "\t\t\t<value><![CDATA[$setting]]></value>\n";
			echo "\t\t</setting>\n";

			$count++;
		}
		?>
	</settings>
	<menus>
		<?php
		$count = 1;
		foreach ( $menu_locations as $location => $menu_id ) {

			$menu_slug = '';

			if ( $menu_id ) {

				$menu = get_term_by( 'id', $menu_id, 'nav_menu' );

				if ( $menu ) {
					$menu_slug = $menu->slug;
				}
			}

			if ( $count > 1 ) {
				echo "\t\t";
			}

			echo "<menu>\n";
			echo "\t\t\t<location>$location</location>\n";
			echo "\t\t\t<assignment><![CDATA[$menu_slug]]></assignment>\n";
			echo "\t\t</menu>\n";

			$count++;
		}
		?>
	</menus>
</site>