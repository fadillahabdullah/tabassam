<div class="page-header">
	<h1 class="page-title">Input Setter Dailty Check</h1>
	<div class="page-header-actions">
		<div class="btn-group btn-group-sm" id="withBtnGroup" aria-label="Page Header Actions" role="group">
			<button type="button" class="btn btn-primary">
				<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
				<span class="hidden-sm-down">Kode Form: <?= $idf; ?></span>
			</button>
			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="refreshdata()">
				<i class="icon wb-loop" aria-hidden="true"></i>
			</button>
			
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xxl-9 col-lg-9 col-md-9">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title">Data</h3></div>
			<div class="panel-body">
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%;">Aksi</th>
							<th style="width: 10%;">ID</th>
							<th>Tanggal</th>
							<th>Jam</th>
							<th>Temperature S POINT</th>
							<th>Temperature Actual</th>
							<th>RH S POINT</th>
							<th>RH Actual</th>
							<th>Damper</th>
							<th>Turning</th>
							<th>Spray</th>
							<th>Temperature Night</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xxl-3 col-lg-3 col-md-3">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form</h3></div>
			<div class="panel-body">
				<div class="form-row">
                    <div class="form-group col-md-12">
						<label class="form-control-label">ID*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtid" placeholder="Masukkan Kode Setter" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tanggal*</label>
						<input type="date" class="form-control jedaobyek" id="txtdate" placeholder="Masukkan tgl Pakan" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jam*</label>
						<input type="time" class="form-control khusus_abjad jedaobyek" id="txtjam" placeholder="ket" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Temperature S POINT*</label>
						<input type="text" class="form-control jedaobyek" id="txtspoint" placeholder="Kiriman ke 1" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Temperature Actual*</label>
						<input type="text" class="form-control  jedaobyek" id="txtactual" placeholder="4C" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">RH S POINT*</label>
						<input type="text" class="form-control  jedaobyek" id="txtrhpoint" placeholder="1200" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">RH Actual*</label>
						<input type="text" class="form-control  jedaobyek" id="txtrhactual" placeholder="1200" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Damper*</label>
						<input type="text" class="form-control  jedaobyek" id="txtdamper" placeholder="1200" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Turning*</label>
						<input type="text" class="form-control  jedaobyek" id="txtturning" placeholder="1200" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Spray*</label>
						<input type="text" class="form-control  jedaobyek" id="txtspray" placeholder="1200" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Temperature Night*</label>
						<input type="text" class="form-control  jedaobyek" id="txttnight" placeholder="1200" autocomplete="off">
					</div>

					<div class="form-group col-md-12" id="bloktombol"></div>
                </div>
			</div>
		</div>
	</div>
</div>



<script>
	var idmenu = "<?= $idm; ?>";
	var idform = "<?= ucfirst($idf); ?>";
	$("#tpm" + idmenu).addClass("active");
	$("#stpm" + idform).addClass("active");

	swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
	var tabel = $('#tbl-xdt').DataTable({
		"ajax": "<?= base_url(ucfirst($idf).'/json'); ?>",
		"fnDrawCallback": function(oSettings){swal.close();}
	});

	refresh();

	function refreshdata(){
		swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}
	
	function refresh(){
        $("#txtid").val("");
        $("#txtdate").val("");
        $("#txtjam").val("");
        $("#txtspoint").val("");
        $("#txtactual").val("");
        $("#txtrhpoint").val("");
        $("#txtrhactual").val("");
        $("#txtdamper").val("");
        $("#txtturning").val("");
        $("#txtspray").val("");
        $("#txttnight").val("");

        
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var tgl = $("#txtdate").val();
        var jam = $("#txtjam").val();
        var tpoin = $("#txtspoint").val();
        var tactual = $("#txtactual").val();
        var hpoin = $("#txtrhpoint").val();
        var hactual = $("#txtrhactual").val();
        var damper = $("#txtdamper").val();
        var turning = $("#txtturning").val();
        var spray = $("#txtspray").val();
        var tnight = $("#txttnight").val();
    
        if(id == "" || tgl == "" || jam == "" || tpoin == "" || tactual == "" || hpoin == "" || hactual == "" || damper == "" || turning == "" || spray == "" || tnight == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, tgl: tgl, jam: jam, tpoin: tpoin, tactual: tactual, hpoin: hpoin, hactual: hactual, damper: damper, turning: turning, spray: spray, tnight: tnight},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Setter Berhasil di Tambahkan',
						icon: 'success'
					}).then((Refreshh)=>{
						refresh();
						tabel.ajax.reload(null, false);
					});
                }else{
					if(y == 99){
						swal({title: 'Tambah Gagal', text: 'Anda Tidak Memiliki Akses Menambah Data Pada Menu Ini', icon: 'error'});
						refresh();
					}else{
						swal({title: 'Tambah Gagal', text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !', icon: 'error'});
					}
                }
            },
			error: function(){
				swal.close();
				swal({title: 'Tambah Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
		$("#btntambah").attr("disabled", false);
	}

	function update(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

        var id = $("#txtid").val();
        var tgl = $("#txtdate").val();
        var jam = $("#txtjam").val();
        var tpoin = $("#txtspoint").val();
        var tactual = $("#txtactual").val();
        var hpoin = $("#txtrhpoint").val();
        var hactual = $("#txtrhactual").val();
        var damper = $("#txtdamper").val();
        var turning = $("#txtturning").val();
        var spray = $("#txtspray").val();
        var tnight = $("#txttnight").val();
    
        if(id == "" || tgl == ""|| jam == "" || tpoin == "" || tactual == "" || hpoin == "" || hactual == "" || damper == "" || turning == "" || spray == "" || tnight == ""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, tgl: tgl, jam: jam, tpoin: tpoin, tactual: tactual, hpoin: hpoin, hactual: hactual, damper: damper, turning: turning, spray: spray, tnight: tnight},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Setter Berhasil di Update',
						icon: 'success'
					}).then((Refreshh)=>{
						refresh();
						tabel.ajax.reload(null, false);
					});
                }else{
					if(y == 99){
						swal({title: 'Update Gagal', text: 'Anda Tidak Memiliki Akses Update Data Pada Menu Ini', icon: 'error'});
						refresh();
					}else{
						swal({title: 'Update Gagal', text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !', icon: 'error'});
					}
                }
            },
			error: function(){
				swal.close();
				swal({title: 'Update Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}

	function hapus(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

        var id = $("#txtid").val();
    
        if(id == ""){
            swal({title: 'Hapus Gagal', text: 'ID Setter Kosong !', icon: 'error'});
            return;
		}
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		swal({
			title: 'Hapus Data',
			text: "Anda Yakin Ingin Menghapus Data Ini ?",
			icon: 'warning',
			buttons:{
				confirm: {text : 'Yakin', className : 'btn btn-success'},
				cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
			}
		}).then((Hapuss)=>{
			if(Hapuss){
				$.ajax({
					url: "<?= base_url(ucfirst($idf).'/hapus'); ?>",
					method: "POST",
					data: {id: id},
					cache: "false",
					success: function(x){
						swal.close();
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Data Setter Berhasil di Hapus',
								icon: 'success'
							}).then((Refreshh)=>{
								refresh();
								tabel.ajax.reload(null, false);
							});
						}else{
							if(y == 99){
								swal({title: 'Hapus Gagal', text: 'Anda Tidak Memiliki Akses Menghapus Data Pada Menu Ini', icon: 'error'});
								refresh();
							}else{
								if(y == 90){
									swal({title: 'Hapus Gagal', text: 'Data Pakan Ini Masih digunakan dalam Data Form Pakan, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
									refresh();
								}else{
									swal({title: 'Hapus Gagal', text: 'Periksa Kembali Data Yang Anda Pilih !', icon: 'error'});
								}
							}
						}
					},
					error: function(){
						swal.close();
						swal({title: 'Hapus Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
					}
				})
			}else{swal.close();}
		});

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}
	
	function filter(el){
		var id = $(el).data("id");
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		$.ajax({
            url: "<?= base_url($idf.'/filter'); ?>",
            method: "POST",
            data: {id: id},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
				var xx = y.split("|");
				if(xx[0] == 1){
					$("#txtid").val(xx[1]);
					$("#txtdate").val(xx[2]);
					$("#txtjam").val(xx[3]);
					$("#txtspoint").val(xx[4]);
					$("#txtactual").val(xx[5]);
					$("#txtrhpoint").val(xx[6]);
					$("#txtrhactual").val(xx[7]);
					$("#txtdamper").val(xx[8]);
					$("#txtturning").val(xx[9]);
					$("#txtspray").val(xx[10]);
					$("#txttnight").val(xx[11]);

					$("#lbljudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombol").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
						<button type="button" class="btn btn-danger" id="btnhapus" onclick="hapus()">Hapus</button>\
						<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>\
					');
				}else{
					swal({title: 'Update Gagal', text: 'Data Tidak di Temukan', icon: 'error'});
					refresh();
				}
            },
			error: function(){
				swal.close();
				swal({title: 'Filter Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
    }
</script>
			