<?PHP
require '../config/checkAccess.php';
require '../../conf/config.php';
require '../../conf/phpFunction.php';
require '../config/checkPriv.php';
?>


        <div class="panel-hdr">
            <!--
            <h2>
                Example <span class="fw-300"><i>Table</i></span>
            </h2>
            -->
            <h2><?PHP echo str_replace("-"," ",$_REQUEST['title']);?></h2>
            <div class="panel-toolbar">
                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed btnTambah" data-toggle="modal" _title="Tambah Data <?=str_replace("-"," ",$_REQUEST['title'])?>">
                    <span class="fal fa-file-plus mr-1"></span> Tambah
                </button>
                <!--
                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                -->
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <!-- datatable start -->
                <table id="_table" class="table table-bordered table-hover table-striped w-100">
					<thead class="bg-primary-600">
						<tr>
							<th width="20px"></th>
							<th>部门名称</th>
							<th>英文名称</th>
							<th>负责人</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
                <!-- datatable end -->
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="_modalMenu" tabindex="-1" role="dialog" aria-labelledby="_modalMenu" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="_mTitle">Title Modal</h5>
                    </div>

                    <form id="_mForm" enctype="multipart/form-data">
                        <div class="modal-body">
						
							<div class="container">						
								<div class="row form-group">
									<div id="_mAttr">
									</div>
									<div class="col-sm-8">
										<input type="text" class="form-control text-capitalize input-sm" id="mn_txt" name="mn_txt" autocomplete="off" placeholder="Nama Menu">
									</div>
									<div class="col-sm-4">
										<select name="mn_jlink" class="select2 form-control w-100" id="mn_jlink">
											<?=inOpt('ca_id, ca_nm', 'set_category', '_active=1', 'ca_id', '1')?>
											<option style="padding-bottom: 0;" value="000">External Link</option>
										</select>
									</div>
								</div>
								<div class="row" id="ch_cat">
									<div class="col-sm-12">
										<div class="form-group">
											<select name="mn_link" class="select2 form-control w-100" id="mn_link">
											</select>
										</div>
									</div>
								</div>
								<div class="row" id="ch_ext">
									<div class="col-sm-8">
										<div class="form-group">
											<input type="text" class="form-control" id="mn_ext" name="mn_ext" autocomplete="off" placeholder="Link URL (http/https)">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<select name="mn_tar" class="select2 form-control w-100" id="mn_tar">
												<option style="padding-bottom: 0;" value="_blank">_blank</option>
												<option style="padding-bottom: 0;" value="_parent">_parent</option>
												<option style="padding-bottom: 0;" value="_self">_self</option>
												<option style="padding-bottom: 0;" value="_top">_top</option>
												<option style="padding-bottom: 0;" value="new">new</option>
											</select>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-themed" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-info btn-sm waves-effect waves-themed" id="btnSimpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Alert --->
        <div class="modal modal-alert fade" id="_modalConfirm" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Modal text description...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm waves-effect waves-themed" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-themed" id="_mBtnConfirm">Hapus Data</button>
                    </div>
                </div>
            </div>
        </div>                


        <script>
            $(document).ready(function(){
                // initiate plugin ====================================================================================
				/*------------start ------------*/
				// initialize hide show form
				$("#ch_cat").hide(); // show kategori
				$("#ch_ext").hide(); // hide external link
				
				
				
                // ----------------------------------------------------------------------------------------------------
                // initialize datatable
				$('#_table').DataTable({
					processing: true,
					'columns': [{
									title: '',
									target: 0,
									className: 'treegrid-control',
									data: function (item) {
										if (item.children) {
											return '<span><i class="fal fa-angle-right"></i></span>';
										}
										return '';
									}
								},
								{
									title: 'Text Menu',
									target: 1,
									data: function (item) {
										return item.mn_txt;
									}
								},
								{
									title: 'Link',
									target: 2,
									data: function (item) {
										return item.mn_url;
									}
								},
								{
									title: '<i class="fal fa-cogs"></i>',
									target: 3,
									data: function (item) {
										if(item._active!=0){
											var btnHead ='<div class="dropdown <?=$_upde_class?>">'+
															'<a href="ui_dropdowns.html#" class="btn btn-outline-primary btn-sm rounded-circle btn-icon waves-effect waves-themed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
																'<i class="fal fa-ellipsis-v-alt"></i>'+
															'</a>'+
															'<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 36px; left: 0px;">';
											
												var btn1 = '<a class="dropdown-item btnTambahChild <?=$_up_class?>" href="javascript:void(0)" id="'+item.mn_id+'" _title="Ubah Password" chg="2"><i class="fal fa-key"></i> Tambah Sub Menu</a>';
												var btn2 = '<a class="dropdown-item getUbah <?=$_up_class?>" href="javascript:void(0)" id="'+item.mn_id+'" _title="Ubah Data" chg="1"><i class="fal fa-pen-square"></i> Ubah Data</a>';
												var btn3 = '<a class="dropdown-item getHapus <?=$_de_class?>" href="javascript:void(0)" id="'+item.mn_id+'" _title="Hapus Data" chg="0"><i class="fal fa-trash-alt"></i> Hapus</a>';
											
											var btnFoot = '</div>'+
														'</div>';

											var btn = btnHead+btn1+btn2+btn3+btnFoot;
										}else{

											var btn='<a class="btn btn-outline-primary btn-sm rounded-circle btn-icon waves-effect waves-themed getHapus" href="javascript:void(0)"  id="'+item.mn_id+'" _title="Aktifkan Data" chg="1"><i class="fal fa-ban"></i></a>';
										}
										return btn;
									}
								}],
					'ajax': 'controllers/_pset-menu.php?_act=5',
					'treeGrid': {
						'left': 15,
						'expandIcon': '<span><i class="fal fa-angle-right"></i></span>',
						'collapseIcon': '<span><i class="fal fa-angle-down"></i></span>'
					}
				});
				
      
                // Simpan Data ========================================================================================
                // ----------------------------------------------------------------------------------------------------
                // Tampikan Form Tambah Data
                $('.btnTambah').click(function(reload){
                    var mTitle = $(this).attr('_title');

                    $('#_modalMenu').modal('show');  
                    // reset form
                    $('#_modalMenu #_mForm')[0].reset();
                    $('#_modalMenu #_mTitle').html(mTitle);
                    $("#_modalMenu #_mForm").attr("_act","1");
                    $('#_modalMenu #_mAttr').html('<input type="hidden" class="form-control" id="parent" name="parent" value="0" autocomplete="off">');
                    
					// initialize hide show form
                    // initialize select2
                    $('#mn_jlink').select2({
                        dropdownParent: $('#_modalMenu'),
                        placeholder: "Pilih Jenis Link",
                        allowClear: true,
                    });
                    $('#mn_jlink').val('').trigger('change');
					
					$("#mn_jlink").change(function(){ // Ketika user mengganti atau memilih data provinsi
						if($('#mn_jlink').val()==='000'){
							$("#ch_cat").hide(); // show kategori
							$("#ch_ext").show(); // hide external link
							
							$('#mn_tar').select2({
								dropdownParent: $('#_modalMenu'),
								placeholder: "Pilihan Target",
								allowClear: true,
								minimumResultsForSearch: Infinity
							});
							$('#mn_tar').val('').trigger('change');
						} else {
							$("#ch_cat").show(); // show kategori
							$("#ch_ext").hide(); // hide external link
							
							$('#mn_link').select2({
								ajax: {
									url: "components/_optCa.php?mn_jlink="+$('#mn_jlink').val(),
									dataType: 'json',
									data: function (params) {
										var query = {
											search: params.term
										}

										// Query parameters will be ?search=[term]&type=user_search
										return query;
									},
									processResults: function (data) {
										return {
											results: data
										};
									}
								},
								cache: true,
								dropdownParent: $('#_modalMenu'),
								placeholder: "Pilih Jenis Link",
								allowClear: true,
							});
							$('#mn_link').val('').trigger('change');
							
						}
					});
					

                });

                // Proses Simpan Data
                $('#btnSimpan').click(function(){
                    // Validasi form input
                    if ($('#mn_txt').val()==''){
                        // focus ke input tanggal
                        $("#mn_txt").focus();
                        // tampilkan peringatan data tidak boleh kosong
                        toastr['warning']('Menu Text tidak boleh kosong');
                    }
					//check Parent OR Not
					else if($('#swParent').prop('checked')==false) {
						if($('input:radio[name=mn_target]:checked').val()==null){
							// tampilkan peringatan data tidak boleh kosong
							toastr['warning']('Pilih Link Intern atau Extern');
						} else {
							if($('input:radio[name=mn_target]:checked').val()=='1'){
								if ($('#mn_jlink').val()==null){
									// focus ke input tanggal
									$("#mn_jlink").focus();
									// tampilkan peringatan data tidak boleh kosong
									toastr['warning']('Pilih Link tujuan');
								} else {
									saveParent('#_mForm','#_modalMenu');
								}
							} else {
								if ($('#mn_link2').val()==''){
									// focus ke input tanggal
									$("#mn_link2").focus();
									// tampilkan peringatan data tidak boleh kosong
									toastr['warning']('URL tidak boleh kosong');
								} else {
									saveParent('#_mForm','#_modalMenu');
								}
							}
						}
					} else {
                        saveParent('#_mForm','#_modalMenu');
					}
					
					function saveParent(idForm, idModal){
                        $('#btnSimpan').loadButton('on', {
                            loadingText: 'Simpan Data...',
                        });
						
                        var data = new FormData($(idForm)[0]);
                        data.append('_act', $(idForm).attr('_act'));

                        $.ajax({
                            type : "POST",
                            url  : "controllers/_pset-menu.php",
                            data : data,
                            contentType: false,
                            processData: false,
                            success: function(result){
                                // ketika sukses menyimpan data

								setTimeout(function(){
									
                                    //button Loading close
                                    $('#btnSimpan').loadButton('off');
                                    
                                    //result
                                    if (result==="sukses") {
                                        // tutup modal tambah data transaksi
                                        $(idModal).modal('hide');
                                        // tampilkan pesan sukses simpan data
                                        toastr['success']('Data berhasil disimpan');
										
                                        // tampilkan data transaksi
                                        var table = $('#_table').DataTable(); 
                                        table.ajax.reload( null, false );
                                    } else {
                                        // tampilkan pesan gagal simpan data
                                        //toastr["error"]('Data tidak berhasil disimpan');
                                        toastr["error"](result);
                                    }
                                }, 1000);
                            }
                        });
                        return false;		
					}					
                });
                // ====================================================================================================
                
                
                // Tambah Data Sub Menu ==========================================================================================
                // ----------------------------------------------------------------------------------------------------
                // Tampilkan Form Tambah Sub
                $('#_table tbody').on( 'click', '.btnTambahChild', function (){
                    var mTitle = 'Tambah Data Sub Menu';
					var mn_id = $(this).attr('id');

                    $('#_modalMenu').modal('show');                    
                    // reset form
                    $('#_modalMenu #_mForm')[0].reset();
                    $('#_modalMenu #_mTitle').html(mTitle);
                    $("#_modalMenu #_mForm").attr("_act","1");
                    $('#_modalMenu #_mAttr').html('<input type="hidden" class="form-control" id="parent" name="parent" value="'+mn_id+'" autocomplete="off">');
                    
					// initialize hide show form
					
                    // initialize select2
                    $('#mn_jlink').select2({
                        dropdownParent: $('#_modalMenu'),
                        placeholder: "Pilihan Record",
                        allowClear: true,
                    });
                    $('#mn_jlink').val('').trigger('change');

                    $('#mn_ltarget').select2({
                        dropdownParent: $('#_modalMenu'),
                        placeholder: "Pilihan Link Target",
                        allowClear: true,
						minimumResultsForSearch: Infinity
                    });
                    $('#mn_ltarget').val('').trigger('change');
					
				})
				
				
                // Ubah Data ==========================================================================================
                // ----------------------------------------------------------------------------------------------------
                // Tampilkan Form Ubah Data
                $('#_table tbody').on( 'click', '.getUbah', function (){
					var mn_id = $(this).attr('id');

					$('#_mTitle').html('Ubah Data Menu');
					$("#_mForm").attr("_act","2");
					

					
					
					//SELECT mn_id, parent, mn_txt, mn_link, mn_target, _active, _cre, _cre_date, _chg, _chg_date FROM set_menu
					$.ajax({
						type : "GET",
						url  : "controllers/_pset-menu.php?_act=4",
						data : {mn_id:mn_id},
						dataType : "JSON",
						success: function(result){
							$('#_modalMenu form')[0].reset();
							
							// tampilkan modal ubah data transaksi
							$('#_modalMenu').modal('show');
							
							// initialize select2
							$('#mn_jlink').select2({
								dropdownParent: $('#_modalMenu'),
								placeholder: "Pilih Sub Kategori",
								allowClear: true,
							});
							$('#mn_jlink').val('').trigger('change');

							$('#mn_ltarget').select2({
								dropdownParent: $('#_modalMenu'),
								placeholder: "Pilihan Link Target",
								allowClear: true,
								minimumResultsForSearch: Infinity
							});
							$('#mn_ltarget').val('').trigger('change');
					
							
							// tampilkan data transaksi
							$('#_mAttr').html('<input type="hidden" class="form-control" id="mn_id" name="mn_id" autocomplete="off" value="'+mn_id+'">'+
											  '<input type="hidden" class="form-control" id="parent" name="parent" autocomplete="off" value="'+result.parent+'">');
							$('#mn_txt').val(result.mn_txt);
							
							if(result.parent!=0){
								$('#swParent').prop('checked', false);
								$('#mn_target').val(result.mn_target);
								
								switch (result.mn_target) {
									case '1':
										$('._choiLink').show();
										$("#text").prop("checked", true);
										
										$('._choiIntern').show();
										$('._choiExtern').hide();
										
										$('#mn_jlink').val(result.mn_link).trigger('change');
										break;
									case '2':
										$('._choiLink').show();
										$("#link").prop("checked", true);
										
										$('._choiIntern').hide();
										$('._choiExtern').show();
										
										$('#mn_link2').val(result.mn_link);
										$('#mn_ltarget').val(result.mn_ltarget).trigger('change');
										break;
								}
							
								
							} else {
								$('#swParent').prop('checked', true);
								$('._choiLink').hide();
							}
						}
					});
                });			

                
                // Hapus Data ==========================================================================================
                // ----------------------------------------------------------------------------------------------------
				$('#_table tbody').on( 'click', '.getHapus', function (){
					var varIDGet = $(this).attr('id');
					var varDATAGet = $(this).attr('chg');

					var vConfirm = '<form id="_mForm" enctype="multipart/form-data">'+
										'<input type="hidden" id="mn_id" name="mn_id" value="'+varIDGet+'">'+
										'<input type="hidden" id="_active" name="_active" value="'+varDATAGet+'">'+
										'<input type="hidden" id="_act" name="_act" value="3">'+
									'<form>';

					$('#_modalConfirm').modal('show');
					if(varDATAGet==='0'){
						$('#_modalConfirm .modal-body').html('Data ini akan dihapus?'+vConfirm);
						$('#_mBtnConfirm').html('Hapus');
					} else {
						$('#_modalConfirm .modal-body').html('Data ini akan diaktifkan?'+vConfirm);
						$('#_mBtnConfirm').html('Aktifkan');
					}
				});

				$('#_mBtnConfirm').click(function(){
					//button Loading open
					$(this).loadButton('on', {
						loadingText: 'Processing Data...',
					});

					var data = new FormData($('#_modalConfirm #_mForm')[0]);

					$.ajax({
						type : "POST",
						url  : "controllers/_pset-menu.php",
						data : data,
						contentType: false,
						processData: false,
						success: function(result){  
							// ketika sukses menyimpan data
							setTimeout(function(){
								//button Loading close
								$('#_mBtnConfirm').loadButton('off');

								//result
								if (result==="sukses") {
									// tutup modal tambah data transaksi
									$('#_modalConfirm').modal('hide');
									// tampilkan pesan sukses simpan data
									toastr["success"]('Proses Data berhasil');

									// tampilkan data transaksi
									var table = $('#_table').DataTable(); 
									table.ajax.reload( null, false );
								} else {
									// tutup modal tambah data transaksi
									$('#_modalConfirm').modal('hide');

									// tampilkan pesan gagal simpan data
									toastr["error"]('Proses Data tidak berhasil');
								}
							}, 1000);
						}
					});
					return false;
				});
                // ====================================================================================================
                
            });
            
        </script>

