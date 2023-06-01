<script type='text/javascript'>
    function paste(dom_id, id){
		var docref = document.referrer;
		// Perhatikan ini,, ini kondisi referrer karena ada beberapa modul yang membuka popup ini
		if(docref == 'http://myadmin.intisari.my.id/choice' || docref == 'http://myadmin.intisari.my.id/choice/') {
			window.opener.document.getElementById(dom_id).value = id;
			window.opener.push_ajax();
			window.close();
		} else {
			document.getElementById(dom_id).value = id;
			PopupCenter('/choice/schedule', 'scheduler', 500, 400)
		}
    }
	function change(id, id_src){
		var docref = document.referrer;
		window.close();
		PopupCenter('/ajax/choice/change/' + id + '/' + id_src, 'scheduler', 500, 400)
		window.opener.refresh();
    }
	function doPaste() {
		window.opener.document.getElementById('dom_hidden').value = document.getElementById('dom_hidden').value;
		window.opener.push_ajax();
        window.close();
	}
</script>
<script>
	function PopupCenter(url, title, w, h) {
		// Fixes dual-screen position                         Most browsers      Firefox
		var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
		var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

		width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		var left = ((width / 2) - (w / 2)) + dualScreenLeft;
		var top = ((height / 2) - (h / 2)) + dualScreenTop;
		var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

		// Puts focus on the newWindow
		if (window.focus) {
			newWindow.focus();
		}
	}
</script>
<input type="hidden" id="dom_hidden" value="" />
<div class="content-wrapper" style="margin-left: 0;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
                <h1>
                        Approved Data		
                </h1>
                <ol class="breadcrumb">
                        <li>Choice</li>
                        <li class="active"><a href="/choice">Pop Up</a></li>
                </ol>
        </section>
        <section class="content">
                <div class="row">
                        <div class="col-xs-12">
                                <div class="box box-primary">
                                        <div class="box-header with-border">
                                                <h3 class="box-title">List Data</h3>
                                                <div class="box-tools">
                                                        <form method="post" action="/choice/popupchange/search/<?php echo $data['id']; ?>/">
                                                                <div class="input-group" style="width: 150px;">
                                                                    <input type="text" name="search" class="form-control input-sm pull-right" placeholder="Search" value="<?php echo !empty($data['search']) ? $data['search'] : ''; ?>" minlength=3 required>
                                                                        <div class="input-group-btn">
                                                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                                                        </div>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                                <table class="table table-bordered">
                                                        <tr>
                                                                <th>Image</th>
                                                                <th>Detail</th>
                                                                <th>Actions</th>
                                                        </tr>
                                                        <?php
                                                        if(!empty($data['list_approved'])) {
                                                            $i_c = 1;
                                                            foreach($data['list_approved'] as $v_approved) {
                                                                if($i_c %2 == 0) {
                                                                    $bg_color = '';
                                                                } else {
                                                                    $bg_color = 'style="background-color: #ECF0F5;"';
                                                                }
                                                                ?>
                                                                <tr <?php echo $bg_color; ?>>
                                                                        <td width="30%">
                                                                            <center>
                                                                                <?php
                                                                                if($v_approved['type'] == 'article') {
                                                                                    echo '<img src="' . News::get_image($v_approved['id']) . '" width="150px" />';
                                                                                } else if($v_approved['type'] == 'gallery') {
                                                                                    echo '<img src="' . Photo::get_image($v_approved['id']) . '" width="150px" />';
                                                                                } else if($v_approved['type'] == 'video') {
                                                                                    echo '<img src="' . Video::get_image($v_approved['id']) . '" width="150px" />';
                                                                                }
                                                                                ?>
                                                                            </center>
                                                                        </td>
                                                                        <td>
                                                                                <b><i>Type : <u><?php echo $v_approved['type'] ?></u></i></b> <br><br>
                                                                                <b><?php 
                                                                                    if(!empty($data['search'])) {
                                                                                        $ex_search = explode(',', $data['search']);
                                                                                        if(!empty($ex_search)) {
                                                                                            $title = $v_approved['title'];
                                                                                            foreach($ex_search as $v_search) {
                                                                                                $title = str_ireplace(trim($v_search), '<b><i><span style="color:red">' . trim($v_search) .'</span></b></i>', $title);
                                                                                            }
                                                                                        }
                                                                                        echo $title;
                                                                                    } else {
                                                                                        echo $v_approved['title']; 
                                                                                    }
                                                                                ?></b><br>
                                                                                <i><?php
                                                                                        if(!empty($data['search'])) {
                                                                                            $ex_search = explode(',', $data['search']);
                                                                                            if(!empty($ex_search)) {
                                                                                                $desc = $v_approved['description'];
                                                                                                foreach($ex_search as $v_search) {
                                                                                                    $desc = str_ireplace(trim($v_search), '<b><i><span style="color:red">' . trim($v_search) .'</span></b></i>', $desc);
                                                                                                }
                                                                                            }
                                                                                            echo $desc;
                                                                                        } else {
                                                                                            echo $v_approved['description']; 
                                                                                        }
                                                                                    ?></i><br><br>
                                                                                Category : <b><i><?php echo $v_approved['category_name']; ?></i></b>
                                                                        </td>
                                                                        <td  width="10%">
                                                                                <a href="javascript:change('<?php echo $v_approved['id']; ?>', '<?php echo $data['id']; ?>')"><button class="btn btn-block btn-success btn-xs">Select this</button></a><br/>
                                                                        </td>
                                                                </tr>
                                                                <?php
                                                                $i_c++;
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