<?php 

/**
 * Add Buttons
 *
 * @return void
 */
function spurt_add_btns($btns = [], $parent_class = '', $size = '') 
{
	if($parent_class) $parent_class = ' ' . $parent_class;
	if($btns):
		echo '<div class="btns'.$parent_class.'">';
		foreach($btns as $btn):
			if(is_array($btn) && $size):
				$btn['size'] = $btn['size'] ?? $size;
			endif;
			get_template_part( 'template-parts/components/component', 'button', $btn );
		endforeach;
		echo '</div>';
	endif;
}
