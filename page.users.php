<?php /* $Id$ */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
?>
<div class="fpbx-container container-fluid">
	<div class="row">
		<div class="col-sm-9">
			<?php
			// If this is a popOver, we need to set it so the selection of user type does not result
			// in the popover closing because config.php thinks it was the process function. Maybe
			// the better way to do this would be to log an error or put some proper mechanism in place
			// since this is a bit of a kludge
			//
			if (!empty($_REQUEST['fw_popover'])) {
			?>
				<script>
					$(document).ready(function(){
						$('[name="fw_popover_process"]').val('');
						$('<input>').attr({type: 'hidden', name: 'fw_popover'}).val('1').appendTo('.popover-form');
					});
				</script>
			<?php
			}

			$display = isset($_REQUEST['display'])?$_REQUEST['display']:null;
			$action = isset($_REQUEST['action'])?$_REQUEST['action']:null;
			$extdisplay = isset($_REQUEST['extdisplay'])?$_REQUEST['extdisplay']:null;
			$view = isset($_REQUEST['view'])?$_REQUEST['view']:null;

			global $currentcomponent;
			$page = $currentcomponent->generateconfigpage(__DIR__."/views/users.php");
			if($view == "add" || (!is_null($extdisplay) && trim($extdisplay) != '')) {
				echo $page;
			} else { ?>
				<div class="display no-border">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" data-name="alldids" class="active">
							<a href="#alldids" aria-controls="alldids" role="tab" data-toggle="tab">
								<?php echo _("All Users")?>
							</a>
						</li>
					</ul>
					<div class="tab-content display">
						<div role="tabpanel" id="alldids" class="tab-pane active">
							<div id="toolbar-users">
								<button id="remove-user" class="btn btn-danger btn-remove" data-type="users" disabled>
									<i class="glyphicon glyphicon-remove"></i> <span><?php echo _('Delete')?></span>
								</button>
							</div>
							<table data-url="ajax.php?module=core&amp;command=getUserGrid&amp;type=all" data-cache="false" data-show-refresh="true" data-toolbar="#toolbar-users" data-maintain-selected="true" data-show-columns="true" data-show-toggle="true" data-toggle="table" data-pagination="true" data-search="true" class="table table-striped ext-list" id="table-users">
								<thead>
									<tr>
										<th data-checkbox="true"></th>
										<th data-sortable="true" data-field="extension"><?php echo _('User')?></th>
										<th data-sortable="true" data-field="name"><?php echo _('Name')?></th>
										<th data-field="actions"><?php echo _('Actions')?></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="bootnav">
			<div class="col-sm-3 hidden-xs">
				<div class="list-group">
					<a href="?display=users" class="list-group-item"><i class="fa fa-list"></i> <?php echo _("List Users")?></a>
					<a href="?display=users&amp;view=add" class="list-group-item"><?php echo _("Add User")?></a>
				</div>
			</div>
		</div>
	</div>
</div>
