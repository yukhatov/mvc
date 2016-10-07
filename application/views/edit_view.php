
<h1>Edit feedback</h1>

<div class="tab-feed">
    <form action="index.php?route=admin/update_message" id="form-edit-feedback" data-id=<?=$data['id']?>>
        <br>
        <label>Message:</label>
        <textarea class="form-control" rows="5" id="message-js" name="message"><?=$data['message']?></textarea>
        <input type="hidden" id="feedback-id-js" name="id" value=<?=$data['id']?>>
        <br>
        <input type="submit" class="btn btn-default" name="edit_submit" value="Edit">
    </form>
</div>

<script src="js/edit.js"></script>

