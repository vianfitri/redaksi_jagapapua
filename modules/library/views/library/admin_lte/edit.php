<link rel="stylesheet" href="http://baca.bismillah.web.id/assets/editor/build/darkroom.css">

<!-- Content Wrapper. Contains page content -->
<?php if(empty($data['dom'])): ?>
	<div class="content-wrapper">
<?php else: ?>
	<div class="content-wrapper" style="margin-left: 0;">
<?php endif; ?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Library'); ?>
		</h1>
		<?php if(!empty($data['dom'])): ?>
			<ol class="breadcrumb">
				<li><?php echo __('Media'); ?></li>
				<li class="active"><a href="/library"><?php echo __('Library'); ?></a></li>
			</ol>
		<?php endif; ?>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<?php if(empty($data['id'])): ?>
							<h3 class="box-title"><?php echo __('Insert Data'); ?></h3>
						<?php else: ?>
							<h3 class="box-title"><?php echo __('Edit Data'); ?></h3>
						<?php endif; ?>
					</div>
					<form role="form" method="post" action="" enctype="multipart/form-data">
						<div class="box-body">
							<?php
							if(!empty($data['errors'])) {
								?>
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> <?php echo __('Alert!'); ?></h4>
									<?php
									foreach($data['errors'] as $v_errors) {
										echo ucfirst($v_errors) . '</br>';
									}
									?>
								</div>
								<?php
							}
							?>
							<div class="form-group">
								<label for="arimTitle"><?php echo __('Title') ?></label>
								<input minlength=10 maxlength="65" id="arimTitle" type="text" name="title" class="form-control" value="<?php echo !empty($data['library']['title']) ? $data['library']['title'] : ''; ?>" required autofocus>

								<input type="hidden" name="id" value="<?php echo !empty($data['library']['id']) ? $data['library']['id'] : ''; ?>">
								<?php
								if(!empty($data['library']['id'])) {
									?>
									<input type="hidden" name="is_edit" value="1" />
									<?php
								}
								?>
							</div>
							<div class="form-group">
							  <label for="arimCaption"><?php echo __('Caption') ?></label>
								<textarea minlength=20 maxlength="500" id="arimCaption" rows="5" name="caption" class="form-control" required><?php echo !empty($data['library']['caption']) ? $data['library']['caption'] : ''; ?></textarea>
							</div>
							<div class="form-group">
							  <label for="arimFileName"><?php echo __('Image input') ?></label>
							  <input type="file" id="arimFileName" name="fileName" accept=".gif, .jpg, .png, .jpeg" onchange="loadFile(event)">
							  <p class="help-block">Size 840x576</p>
							  <?php
								if(!empty($data['library']['fileType'])){
									$split_id = str_split($data['library']['id']);
									echo "<br/><img style='width:200px;height:auto;' src='".URL::Base()."uploads/library/".implode('/', $split_id)."/{$data['library']['id']}_224x153.{$data['library']['fileType']}'>";
								}
							  ?>
							</div>
							<img alt="" id="target" style="max-width:100%"><BR><BR>
							<button disabled id="editor" onclick="editorx()">Editor</button>
							<input type="hidden" id="image_editor" name="image_editor">
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<?php if(empty($data['id'])): ?>
								<button type="submit" class="btn btn-primary"><?php echo __('Save Data'); ?></button>
							<?php else: ?>
								<button type="submit" class="btn btn-primary"><?php echo __('Update Data'); ?></button>
							<?php endif; ?>

							<a href="javascript:history.go(-1);"><button type="button" class="btn btn-danger"><?php echo __('Cancel'); ?></button></a>
						</div>
					</form>
					<!-- /.box-header -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->




<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('target');
      output.src = reader.result;

	  $("#editor").removeAttr("disabled");
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>



  <script src="http://baca.bismillah.web.id/assets/editor/vendor/fabric.js"></script>
  <script src="http://baca.bismillah.web.id/assets/editor/build/darkroom.js"></script>

  <script>
    function editorx(){
    var dkrm = new Darkroom('#target', {
      // Size options
      backgroundColor: '#000',

      // Plugins options
      plugins: {
        save: {
            callback: function() {
                this.darkroom.selfDestroy(); // Cleanup
                var newImage = dkrm.canvas.toDataURL();
				$("#image_editor").val(newImage);
            }
        },
        crop: {
          quickCropKey: 67, //key "c"
          //minHeight: 50,
          //minWidth: 50,
          //ratio: 4/3
        }
      },

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
        cropPlugin.selectZone(0, 0, 840, 576);
        //cropPlugin.requireFocus();
      }
    });

	return FALSE;
  }
  </script>
