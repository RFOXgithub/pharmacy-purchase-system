function searchAsset() {
    $('#asset-list').html('');
    $.ajax({
        url: 'http://localhost/arka-rest-server/api/asset',
        type: 'get',
        datatype: 'json',
        data: {
            'arka-key': 'arka123',
            'no_inv': $('#no-inv').val(),
            'nama_aset': $('#nama-aset').val(),
            'merk': $('#merk').val(),
            'model': $('#model').val(),
            'sn': $('#sn').val(),
            'nama': $('#nama').val(),
            'kode_project': $('#kode-project').val()
        },
        success: function(result) {
            if (result.status == true) {
                let movies = result.data;
                var trHTML = '';
                trHTML += 
                `<table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>No</th>
                        <th>Asset</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>S/N</th>
                        <th>PIC</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>`
                $.each(movies, function(i, data) {
                    trHTML += 
                    `<tr>
                        <td>` + data.no_inv + `</td>
                        <td>` + data.nama_aset + `</td>
                        <td>` + data.merk + `</td>
                        <td>` + data.model + `</td>
                        <td class="string-title">` + data.sn + `</td>
                        <td>` + data.nama + `</td>
                        <td>` + data.kode_project + `</td>
                        <td>` + data.status + `</td>
                        <td>
                            <button id="pick-asset" value="`+data.id_perbekalan+`" type="button" 
                            class="btn btn-primary" data-dismiss="modal" data-toggle="tooltip" data-placement="left" title="Select this asset!" onclick="change(`+data.id_perbekalan+`)"><i class="fa fa-check-square-o"></i></button>
                        </td>
                    </tr>`;
                });
                trHTML += '</table>';
                $('#asset-list').append(trHTML);
            } else {
                $('#asset-list').html(`
                <div class="form-group alert alert-danger">
                    <h4 class="text-center">` + result.message + `</h4>
                </div>`);
            }
        }
    });
}

function change(x){
    $('#getAsset').html('');
    $.ajax({
        url: 'http://localhost/arka-rest-server/api/asset',
        type: 'get',
        datatype: 'json',
        data: {
            'arka-key': 'arka123',
            'id_perbekalan': x
        },
        success: function(result) {
            if (result.status == true) {
                let asset = result.data;
                var trHTML = '';
                trHTML += 
                `<table class="table" style="border:0">
                    <tr>
                        <td>Asset</td>
                        <td>:</td>
                        <td><b>`+asset[0].nama_aset+`</b></td>
                    </tr>
                    <tr>
                        <td>Merk</td>
                        <td>:</td>
                        <td><b>`+asset[0].merk+`</b></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>:</td>
                        <td><b>`+asset[0].model+`</b></td>
                    </tr>
                    <tr>
                        <td>S/N</td>
                        <td>:</td>
                        <td><b>`+asset[0].sn+`</b></td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td>:</td>
                        <td><b>`+asset[0].nama+`</b></td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td><b>`+asset[0].kode_project+`</b></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><b>`+asset[0].status+`</b></td>
                    </tr>`
                '</table>';
                $('#getAsset').append(trHTML);
                $('#asset_id').val(x);
            } else {
                $('#getAsset').html(`
                <div class="form-group alert alert-danger">
                    <h4 class="text-center">` + result.message + `</h4>
                </div>`);
            }
        }
    });
}

$('#search-button').on('click', function() {
    searchAsset();
});

$('#reset-button').on('click', function() {
    $('#no-inv').val('');
    $('#nama-aset').val('');
    $('#merk').val('');
    $('#model').val('');
    $('#sn').val('');
    $('#nama').val('');
    $('#kode-project').val('');
});

$('#no-inv, #nama-aset, #merk, #model, #sn, #nama, #kode-project').on('keyup', function(e) {
    if (e.keyCode === 13) {
        searchAsset();
    }
});

function getRepairByID(id) {
    $('#repair-history').html('');
    $.ajax({
        url: 'http://localhost/arka-rest-server/api/repair',
        type: 'get',
        datatype: 'json',
        data: {
            'arka-key': 'arka123',
            'id_perbekalan': id
        },
        success: function(result) {
            if (result.status == true) {
                let repair = result.data;
                console.log(repair);
                var trHTML = '';
                trHTML += 
                `<table class="table" style="border:0">
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td>`+repair[0].no_inv+`</td>
                    </tr>
                    <tr>
                        <td>repair</td>
                        <td>:</td>
                        <td>`+repair[0].nama_aset+`</td>
                    </tr>
                    <tr>
                        <td>Merk</td>
                        <td>:</td>
                        <td>`+repair[0].merk+`</td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>:</td>
                        <td>`+repair[0].model+`</td>
                    </tr>
                    <tr>
                        <td>S/N</td>
                        <td>:</td>
                        <td>`+repair[0].sn+`</td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td>:</td>
                        <td>`+repair[0].nama+`</td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td>`+repair[0].kode_project+`</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>`+repair[0].status+`</td>
                    </tr>`
                '</table>';
                $('#repair-history').append(trHTML);
            } else {
                $('#repair-history').html(`
                <div class="form-group alert alert-danger">
                    <h4 class="text-center">` + result.message + `</h4>
                </div>`);
            }
        }
    });
}