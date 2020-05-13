<div class="comment-form">
  <?php add_details();  ?>
  <form  method="POST">
    <div class="col-sm-12">
      <textarea name="details" rows="2" class="text-area-messge form-control" placeholder="Aprašymas" aria-required="true"
        aria-invalid="false"><?php echo $desc; ?></textarea>
    </div><!-- col-sm-12 -->
    <div class="col-sm-12">
      <button class="submit-btn" name="add-details" type="submit" id="form-submit"><b>Išsaugoti</b></button>
    </div><!-- col-sm-12 -->
  </form>
</div>
