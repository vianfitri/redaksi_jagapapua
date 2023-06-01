<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo __('Newsroom Approve News'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Newsroom'); ?></li>
			<li class="active"><a href="/news"><?php echo __('Approve News'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo __('Approve News'); ?></h3>
					</div>
					<form role="form" method="post" action="<?php echo URL::Base(); ?>news/approve/submit">
						<div class="box-body">
							<input type="hidden" name="id" value="<?php echo !empty($data['detail']['id']) ? $data['detail']['id'] : ''; ?>" />
							<div class="form-group">
								<label><?php echo __('Title') ?></label>
								<input type="text" name="title" value="<?php echo !empty($data['detail']['title']) ? $data['detail']['title'] : ''; ?>" maxlength="65" placeholder="<?php echo __('Only 65 Characters'); ?>" class="form-control" minlength="3" required>
							</div>
							<div class="form-group">
								<label><?php echo __('Image') ?></label></br>
								<image src="<?= $data['detail']['image']; ?>" height="300px">
								<input name="image" type="hidden" value="<?= $data['detail']['image']; ?>">
							</div>
							<div class="form-group">
								<label><?php echo __('Description') ?></label>
								<textarea class="form-control" rows="3" name="description" maxlength="165" placeholder="<?php echo __('Only 165 Characters'); ?>" minlength="3" required><?php echo !empty($data['detail']['description']) ? $data['detail']['description'] : ''; ?></textarea>
							</div>
							<div class="form-group">
								<label><?php echo __('Detail') ?></label>
								<textarea class="form-control f_tinymce" rows="15" name="detail" minlength="3" required><?php echo !empty($data['detail']['detail']) ? $data['detail']['detail'] : ''; ?></textarea>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo __('Submit'); ?></button>
							<a href="javascript:history.go(-1);"><button type="button" class="btn btn-danger"><?php echo __('Cancel'); ?></button></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>