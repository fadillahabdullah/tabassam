<div class="page-header">
	<h1 class="page-title">Input Kandang Breeding Farm Per Periode</h1>
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
							<th>Kandang</th>
							<th>Tanggal</th>
							<th>Umur</th>
							<th>Strain</th>
							<th>Jantan</th>
							<th>Betina</th>
							<th>Periode</th>
							<th>Keterangan</th>
							<th>Status</th>
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
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtid" placeholder="Masukkan Kode Kandang Breeding" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Kandang</label>
						<select class="form-control select2" id="cbkandang">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtkandang)){
									if(count($dtkandang)>0){
										foreach($dtkandang as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tanggal*</label>
						<input type="date" class="form-control jedaobyek" id="txtdate" placeholder="Masukkan strain Pakan" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur*</label>
						<input type="text" class="form-control jedaobyek" id="txtumur" placeholder="Masukkan Umur Ayam" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Strain*</label>
						<input type="text" class="form-control jedaobyek" id="txtstrain" placeholder="Masukkan strain Pakan" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Ayam Jantan*</label>
						<input type="text" class="form-control jedaobyek" id="txtjantan" placeholder="Masukkan Jumlah Ayam Jantan" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Ayam Betina*</label>
						<input type="text" class="form-control jedaobyek" id="txtbetina" placeholder="Masukkan Jumlah Ayam Betina" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Periode</label>
						<select class="form-control" id="cbperiode">
							<option value="G">Growing</option>
							<option value="L">Laying</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Keterangan*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtket" placeholder="keterangan" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Status</label>
						<select class="form-control" id="cbstatus">
							<option value="Y">Aktif</option>
							<option value="T">Tidak Aktif</option>
						</select>
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
        $("#cbkandang").val("");
        $("#txtdate").val("");
        $("#txtumur").val("");
        $("#txtstrain").val("");
        $("#txtjantan").val("");
        $("#txtbetina").val("");
        $("#cbperiode").val("G");
        $("#txtket").val("");
        $("#cbstatus").val("Y");
        
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var kandang = $("#cbkandang").val();
        var tgl = $("#txtdate").val();
        var umur = $("#txtumur").val();
        var strain = $("#txtstrain").val();
        var jantan = $("#txtjantan").val();
        var betina = $("#txtbetina").val();
        var periode = $("#cbperiode").val();
        var keterangan = $("#txtket").val();
        var status = $("#cbstatus").val();

    
        if(id == "" || kandang == "" || tgl == "" || umur == "" || strain == "" || jantan == "" || betina == "" || periode == "" || keterangan == "" || status == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, kandang: kandang, tgl: tgl, umur: umur, strain: strain, jantan: jantan, betina: betina, periode: periode,  keterangan: keterangan, status:status},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Kandang Breeding Berhasil di Tambahkan',
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
        var kandang = $("#cbkandang").val();
        var tgl = $("#txtdate").val();
        var umur = $("#txtumur").val();
        var strain = $("#txtstrain").val();
        var jantan = $("#txtjantan").val();
        var betina = $("#txtbetina").val();
        var periode = $("#cbperiode").val();
        var keterangan = $("#txtket").val();
        var status = $("#cbstatus").val();
    
        if(id == "" || kandang == "" || tgl == "" || umur == "" || strain == "" || jantan == "" || betina == "" || periode == "" || keterangan == "" || status == ""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, kandang: kandang, tgl: tgl, umur: umur, strain: strain, jantan: jantan, betina: betina, periode: periode,  keterangan: keterangan, status:status},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Kandang Breeding Berhasil di Update',
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
            swal({title: 'Hapus Gagal', text: 'ID Pakan Kosong !', icon: 'error'});
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
								text: 'Data Kandang Breeding Berhasil di Hapus',
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
									swal({title: 'Hapus Gagal', text: 'Data Kandang Breeding Ini Masih digunakan dalam Data Form Pakan, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
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
					$("#cbkandang").val(xx[2]);
					$("#txtdate").val(xx[3]);
					$("#txtumur").val(xx[4]);
					$("#txtstrain").val(xx[5]);
					$("#txtjantan").val(xx[6]);
					$("#txtbetina").val(xx[7]);
					$("#cbperiode").val(xx[8]);
					$("#txtket").val(xx[9]);
					$("#cbstatus").val(xx[10]);

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
			