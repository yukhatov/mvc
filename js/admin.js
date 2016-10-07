/**
 * Created by artur on 06.10.16.
 */
function edit($id)
{
    var $this = $(this);

    window.location.href = "index.php?route=admin/edit&id=" + $id;
}