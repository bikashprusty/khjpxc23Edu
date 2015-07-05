<?php
require_once("process/authenticationMgt.php");
$auth=new authenticationProcessor();

?>
<h2>Your Dash Board</h2>
<iframe name="submitForm" id="submitForm"></iframe>
<div class="message"></div>
<div class="leftBlock">
	<div class="searchBox">
		<div class="searchCriterias">
			
		</div>
		<div class="searchList">
		
		</div>
	</div>
	<div class="searchResult"></div>
</div>
<div class="leftBlock">
	<div class="dashBlocks hiredServices">
		<h3>Recent Events</h3>	
	</div>
	<div class="dashBlocks serviceFeedback">
		<h3>Enquiries</h3>		
	</div>
	<div class="dashBlocks requestPendings">
		<h3>Copy Image URL</h3>
	</div>

</div>
<div class="hidden">
<?php
require_once("bridges/services/func_getAllServiceStausList.php");
?>
</div>