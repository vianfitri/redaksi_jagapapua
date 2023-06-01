<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <div id="overlay_custom" style=" position: absolute; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.28); z-index: 99; display: none "><center><span style=" font-weight: bold; color: white; ">Loading....</span></center></div>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo __('Headline'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo __('Web Tools'); ?></li>
			<li class="active"><a href="/headline"><?php echo __('Headline'); ?></a></li>
		</ol>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
                                <div class="box box-primary">
					<div class="box-body">
						<a href="javascript:PopupCenter('/choice/popup', 'google', '640', '480');"><button type="button" style="width:150px" class="btn btn-success btn-sm"><?php echo __('Add New Headline'); ?></button></a>
					</div>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo  __('List Headline'); ?></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<!-- List isi artikel -->
							<tr>
								<th style="width:30%"><?php echo __('Image'); ?></th>
								<th><?php echo __('Detail'); ?></th>
								<th style="width:10%" style="width:20%"><?php echo __('Actions'); ?></th>
							</tr>
							<?php
                                                        if(!empty($data['list'])) {
                                                            $c_bg_list = 1;
                                                            foreach($data['list'] as $v_list) {
                                                                // Background color
                                                                if($c_bg_list % 2 == 0) {
                                                                    $bg_list = '';
                                                                } else {
                                                                    $bg_list = 'style="background-color: #ECF0F5;"';
                                                                }
                                                                $arr_detail = array();
                                                                $type = '';
                                                                if(!empty($v_list['headNewsId'])) {
                                                                    $arr_detail = News::detail($v_list['headNewsId']);
                                                                    $type = 'Article';
                                                                }
                                                                $img = '';
                                                                if(!empty($arr_detail['images'][0]['image_id'])) {
                                                                    $path = implode('/', str_split($arr_detail['images'][0]['image_id']));
                                                                    $img = '/uploads/library/' . $path . '/' . $arr_detail['images'][0]['image_id'] . '.' . $arr_detail['images'][0]['image_type'] . '';
                                                                } else if(!empty($arr_detail['images_gif'][0]['image_id'])) {
                                                                    $path = implode('/', str_split($arr_detail['images_gif'][0]['image_id']));
                                                                    $img = '/uploads/library/' . $path . '/' . $arr_detail['images_gif'][0]['image_id'] . '.' . $arr_detail['images_gif'][0]['image_type'] . '';
                                                                }
                                                                $img_pic = '';
                                                                if(!empty($img)) {
                                                                    $img_pic = '<img src="' . $img .'" width="200px" />';
                                                                }
                                                                ?>
                                                                <tr <?php echo $bg_list; ?>>
                                                                    <td><?php echo $img_pic; ?></td>
                                                                    <td>
                                                                        <b><i>Type : <?php echo $type; ?></i></b><br/><br/>
																		<b><?php echo $arr_detail['title']; ?></b></br>
                                                                        <i><?php echo $arr_detail['description']; ?></i>
                                                                    </td>
                                                                    <td><a href="javascript:del_confirm(<?php echo $v_list['headId'] ?>)"><button class="btn btn-block btn-danger btn-xs"><?php echo __('Delete'); ?> </button></a> </br></br></td>
                                                                </tr>
                                                                <?php
                                                                $c_bg_list++;
                                                            }
                                                        }
                                                        ?>
						</table>
					</div>
					<!-- /.box-body -->
					<?php echo !empty($data['pagination']) ? $data['pagination'] : ''; ?>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->