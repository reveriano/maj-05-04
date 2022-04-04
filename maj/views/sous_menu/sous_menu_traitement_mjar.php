<!-- <div class="row full graph_head"> -->


	<div class="dropdown col-md-3">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
		<?=lang('choose_action')?>
		</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<?php 


			foreach ($actions as $key) {

				echo "<a class='dropdown-item' href='".base_url('index.php/maj/Mise_a_jmrdp/do_action/'.$info['MAJ_ID'].'/'.$key['ACTION_ID'].'/'.$key['STAGE_ID'].'/'.$key['NEXT_STAGE'])."'>".$key['DESCRIPTION_ACTION']."</a>";
			}
			

			?> 
		</div>
	</div>






	<div class="dropdown col-md-3">
		<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
			<?=lang('deplace')?>
		</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<?php  
			
			foreach ($stages as $st) {
				echo '<a class="dropdown-item" href="'.base_url('index.php/maj/Mise_a_jmrdp/view/'.$info['MAJ_ID'].'/'.$info['PROCESS_ID'].'/'.$st['STAGE_ID']).'">'.$st['DESCRIPTION_STAGE'].'</a>';

				
			}

			
			?>

		</div>
	</div>

	



	<div class="col-md-6">
		

			<?php

			if ($tache['TACHE']==1) {?>

				<button style="float:right;" class="btn btn-primary"  type="button">
					<a href="<?=base_url('index.php/maj/Mise_a_jmrdp/faire_tache/'.$MAJ_ID.'/'.$tache['STAGE_ID'].'/'.$tache['ACTION_ID'])?>" style="color: white;text-decoration: none;"><?=$tache['DESCRIPTION_ACTION'] ?></a>
				</button>
				
			<?php 
			}

			?>

		

			
			

	</div>


	<!-- <input type="hidden" readonly size="5" name="ACTION_VERIFY" id="ACTION_VERIFY" value="<?=$deplace['ACTION_ID']?>">
	<input type="hidden"  value="<?=$niveau['STATUT_ID']?>"> -->


<!-- </div> -->