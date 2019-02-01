<div class="col-md-9">
    <!-- Website Overview -->
    <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Edit Page</h3>
        </div>
        <div class="panel-body">
        <?= form_open(base_url().'game/create',['id' => 'pelangganform']) ?>
            <?php foreach ($inputs as $form) :?>
            <div class="form-group">
            <label><?= $form['name'] ?></label>
            <?= form_input($form); ?>
            </div>
        <?php endforeach ?>

        <div class="form-group">
        <?= form_dropdown($select['name'], $select['option'],'unknown', $select['js']) ?> 
        </div>

        <input type="hidden" name="aksi" value="baru">
        <input type="submit" class="btn btn-default" value="Submit">
        </form>
        </div>
        </div>
</div>