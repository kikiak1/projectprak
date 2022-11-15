<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th width="120px">tanggal upload</th>
                <th width="30px">:</th>
                <td><?= $arsip['tgl_upload'] ?></td>
                <th width="100px">No arsip</th>
                <th width="30px">:</th>
                <td><?= $arsip['no_arsip'] ?></td>
            </tr>
            <tr>
                <th>Nama arsip</th>
                <th>:</th>
                <td><?= $arsip['nama_arsip'] ?>
                <th>tanggal update</th>
                <th>:</th>
                <td><?= $arsip['tgl_update'] ?></td>
                </td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <th>:</th>
                <td><?= $arsip['nama_arsip'] ?></td>
                <th>Ukuran File</th>
                <th>:</th>
                <td><?= $arsip['ukuran_file'] ?> Byte</td>
            </tr>
            <tr>
                <th>Departement</th>
                <th>:</th>
                <td><?= $dep['nama_dep'] ?></td>
                <th>User</th>
                <th>:</th>
                <td><?= $user['nama_user'] ?></td>
            </tr>
        </table>
    </div>

    <div class="col-sm-12">
        <iframe src="<?= base_url('file_arsip/' . $arsip['file_arsip']) ?>" style="border:2px solid blue;" height="1000px" width="100%"></iframe>
    </div>

</div>