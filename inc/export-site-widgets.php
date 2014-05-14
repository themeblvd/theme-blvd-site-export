<?php echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\" ?>\n"; ?>
<settings>
	<setting>
		<id>sidebars_widgets</id>
		<value><?php echo '<![CDATA['.$sidebars.']]>'; ?></value>
	</setting>
	<?php
	$count = 1;
	foreach ( $widgets as $option_id => $widget ) {

		if ( $count > 1 ) {
			echo "\t";
		}

		echo "<setting>\n";
		echo "\t\t<id>$option_id</id>\n";
		echo "\t\t<value><![CDATA[$widget]]></value>\n";
		echo "\t</setting>\n";

		$count++;
	}
	?>
</settings>