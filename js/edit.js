/**
 * Created by artur on 06.10.16.
 */
$("#form-edit-feedback").on('submit', function(e) {
    var $this = $(this),
        $formData = $this.serialize();

    $.ajax({
        'type': 'post',
        'url': $this.attr('action'),
        'dataType': 'json',
        'data': $formData
    }).success(function(json) {
        console.log('success');
    });

    e.preventDefault();
    window.location.href = "index.php?route=admin/index";
});
