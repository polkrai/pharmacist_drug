<?php
header("Content-type:application/xml; charset=UTF-8"); 

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

echo '<menu>
		<item id="pro_file" text="Name">
			<item id="new" text="New" img="new.gif" imgdis="new_dis.gif"/>
		</item>
	</menu>';