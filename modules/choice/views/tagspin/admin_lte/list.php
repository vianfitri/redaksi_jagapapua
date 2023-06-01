<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <div id="overlay_custom" style=" position: absolute; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.28); z-index: 99; display: none "><center><span style=" font-weight: bold; color: white; ">Loading....</span></center></div>
	<!-- Content Header (Page header) -->

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
          <div class="box box-primary">
					<div class="box-body">
						<a href="javascript:PopupCenter('/library/index/1/0/image_popup', 'google', '640', '480');">
              <button type="button" style="width:150px" class="btn btn-success btn-sm"><?php echo __('Add New '); ?></button>
            </a>
            <a href="/tagspin/sync/<?php echo $data['cat']; ?>"><button type="button" style="width:150px" class="btn btn-info btn-sm"><?php echo __('Sync'); ?></button></a>
					</div>
				</div>
				<div class="box box-primary">
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
                        $bg_list = ($c_bg_list % 2 == 0)?'':'style="background-color: #ECF0F5;"';

                        $img = '';
                        $path = implode('/', str_split($v_list['arimId']));
                        $img = '/uploads/library/' . $path . '/' . $v_list['arimId'] . '.' . $v_list['arimFileType'] . '';

                        $img_pic = '';
                        if(!empty($img)) {
                            $img_pic = '<img src="' . $img .'" width="200px" />';
                        }
                        ?>
                        <tr <?php echo $bg_list; ?>>
                            <td><?php echo $img_pic; ?></td>
                            <td>
                                <b><?php echo $v_list['arimTitle']; ?></b></br>
                                <i><?php echo $v_list['arimCaption']; ?></i></br>
                                <form action="" method='post'>
                                  <input type="text" placeholder="Judul" style="width:100%" value='<?php echo $v_list['tagsTitle']; ?>' name='tagsTitle'>
                                  <input type="text" placeholder="URL" style="width:50%" value='<?php echo $v_list['tagsUrl']; ?>' name='tagsUrl'>
                                  <input type="hidden" value='<?php echo $v_list['tagsId']; ?>' name='tagsId'>
                                  <input type="submit" value="Submit URL" name="submit_tagsUrl">
                                </form>
                            </td>
                            <td><a href="javascript:del_confirm(<?php echo $v_list['tagsId'] ?>)"><button class="btn btn-block btn-danger btn-xs"><?php echo __('Delete'); ?> </button></a> </br></br></td>
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
