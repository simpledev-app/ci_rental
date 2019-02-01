<div class="col-md-9">
    <!-- Website Overview -->
    <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Edit Page</h3>
        </div>
        <div class="panel-body">
        <?= form_open_multipart(base_url().'karyawan/create',['id' => 'pelangganform']) ?>
            <?php foreach ($inputs as $form) :?>
            <div class="form-group">
            <label><?= $form['name'] ?></label>
            <?= form_input($form); ?>
            </div>
        <?php endforeach ?>

        <div class="form-group" id="date">
            <label>Tanggal Lahir</label>
            <input type="text" class="form-control" name="tgl_lahir">    
        </div>

        <?php foreach ($options as $select) : ?>
        <div class="form-group">
            <label><?= $select['name'] ?></label>
            <?= form_dropdown($select['name'], $select['option'],'unknown', $select['js']) ?> 
        </div>
        <?php endforeach ?>

        <input type="file" name="foto" id="foto">
        <img src="#" alt="" id="gambar">
        <input type="hidden" name="aksi" value="baru">
        <br>
        <input type="submit" class="btn btn-default" value="Submit">
        </form>
        </div>
        </div>
</div>


<script src="<?= base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-datepicker.id.min.js"></script>

<script>
$(document).ready(function () {

    $('#date input').datepicker({
        format: "yyyy-mm-dd",
        startView: 2,
        language: "id",
        autoclose: true
    });

    $('#foto').change(function () {
        console.log(this.files);
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#pelangganform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url : '<?= base_url() ?>karyawan/request',
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success : function (data) {
                console.log(data)
            }
        })
    });
})
</script>