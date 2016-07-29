<div id="alerts">
	<?php
		if (isset($_REQUEST['msg-info']))
			echo('<div class="alert alert-info" role="alert">'.$_REQUEST['msg-info'].'</div>');
		if (isset($_REQUEST['msg-ok']))
			echo('<div class="alert alert-success" role="alert">'.$_REQUEST['msg-ok'].'</div>');
		if (isset($_REQUEST['msg-warn']))
			echo('<div class="alert alert-danger" role="alert">'.$_REQUEST['msg-warn'].'</div>');
		if (isset($_REQUEST['msg-error']))
			echo('<div class="alert alert-danger" role="alert">'.$_REQUEST['msg-error'].'</div>');
	?>
</div>