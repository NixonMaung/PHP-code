

 <div class="widget">
                <h2>Users</h2>
                <div class="inner">
				<?php
				$user_count = user_count();
				$ad_count =ad_count();
				$suffix = ($user_count!=1)? 's' : '' ;
				?>
                 We currently have <?php echo $user_count." registered user".$suffix." and ".$ad_count." accommodation post".$suffix;?> 
            </div>
