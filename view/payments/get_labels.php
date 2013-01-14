<?php

foreach($labels as $label){
	echo '<option value="'.$label->code.'">'.$label->libelle.'</option>';
}
