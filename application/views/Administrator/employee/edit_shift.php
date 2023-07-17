<form class="form-horizontal" action="<?php echo base_url();?>updateShift" method="post">
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Shift Name  </label>
		<label class="col-sm-1 control-label no-padding-right">:</label>
		<div class="col-sm-8">
			<input type="text" id="shift" name="shift" placeholder="Shift Name" value="<?php echo $row->name; ?>" class="col-xs-10 col-sm-4" />
			<input type="hidden" id="shift_id" name="shift_id" value="<?php echo $row->shift_id; ?>" class="col-xs-10 col-sm-4" />
			<span id="msc"></span>
		</div>
	</div>
	 
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
		<label class="col-sm-1 control-label no-padding-right"></label>
		<div class="col-sm-8">
				<button type="submit" class="btn btn-sm btn-info" name="btnSubmit">
					Update
					<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
				</button>
		</div>
	</div>
</form>
