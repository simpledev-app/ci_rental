<div class="col-md-9">
    <!-- Website Overview -->
    <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Edit Page</h3>
        </div>
        <div class="panel-body">
        <?= form_open_multipart(base_url().'game/create',['id' => 'gameform']) ?>
            <div class="form-group">
            <label>Judu Game</label>
            <input type="text" class="form-control" placeholder="Judul Game" name="judul">
            </div>

            <div class="form-group">
            <label>Genre</label>
            <input type="text" class="form-control" placeholder="Genre" name="genre">
            </div>

            <div class="form-group">
            <label>Harga Sewa</label>
            <input type="number" class="form-control" name='harga'>
            </div>

            <div class="form-group">
            <label>Stock</label>
            <input type="number" class="form-control" name="jumlah">
            </div>

            <div class="form-group">
            <label>Cover</label>
            <input type="file" class="form-control"  name="gambar">
            </div>

            <div class="form-group">
            <label>Diskripsi</label>
            <textarea name="diskripsi" name="diskripsi" class="form-control" placeholder="Diskripsi Game">
            </textarea>
            </div>

            <div class="form-group">
            <label>Kode</label>
            <input type="text" class="form-control"  name="kode">
            </div>

            <input type="submit" class="btn btn-default" value="Submit">
        </form>
        </div>
        </div>

</div>

<script>

$(document).ready(function () {
    $('#gameform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url : '<?= base_url() ?>game/create',
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                console.log(data)
            }
        })
    })
})

</script>