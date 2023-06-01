<div class="box-footer clearfix">
	<ul class="pagination pagination-sm no-margin pull-right">
		
		<?php if ($first_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($first_page)) ?>"><?php echo __('First') ?></a></li>
		<?php endif ?>
		
		<?php if ($previous_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($previous_page)) ?>"><?php echo __('Previous') ?></a></li>
		<?php endif ?>
		
                <?php
                    $li_page = '';
                    
                    $last_i = 0;
                    // Page Kebelakang dari current page
                    for($i = $current_page; $i >= ($current_page - 5); $i--) {
                        if($i > 0) {
                            if($i == $current_page) {
                                $li_page = '<li><a href="javascrip:void();"><u>' . $i . '</u></a></li>' . $li_page;
                            } else {
                                $li_page = '<li><a href="' . HTML::chars($page->url($i)) . '">' . $i . '</a></li>' . $li_page;
                            }
                        }
                        $last_i = $i;
                    }
                    if($last_i > 1) {
                        $li_page = '<li><a href="javascrip:void();">....</a></li>' . $li_page;
                    }
                    
                    // Page kedepan dari current page
                    $last_i = 0;
                    for($i = $current_page; $i <= ($current_page + 5); $i ++) {
                        if($i != $current_page AND $i <= $last_page) {
                            $li_page .= '<li><a href="' . HTML::chars($page->url($i)) . '">' . $i . '</a></li>';
                        }
                        $last_i = $i;
                    }
                    if($last_i < $last_page) {
                        $li_page .= '<li><a href="javascrip:void();">....</a></li>';
                    }
                    
                    echo $li_page;
                    
                ?>
		
		<?php if ($next_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($next_page)) ?>"><?php echo __('Next') ?></a></li>
		<?php endif ?>

		<?php if ($last_page !== FALSE): ?>
			<li><a href="<?php echo HTML::chars($page->url($last_page)) ?>"><?php echo __('Last') ?></a></li>
		<?php endif ?>
		
	</ul>
</div>