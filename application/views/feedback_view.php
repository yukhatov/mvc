<h1>Feedbacks</h1>
<p>
<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort By:
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <?php
            foreach($data['columns'] as $columnName)
            {
                echo '<li><a href="index.php?route=feedback/index&order=' . $columnName . '">' . $columnName . '</a></li>';
            }
        ?>
    </ul>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading" ><label>All feedbacks:</label></div>
    <div class="panel-body"  id="main-js">
        <?php
            foreach($data['models'] as $row)
            {
                echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading"> ' . $row['date'] . ' by: <label>' . $row['name'] . '</label>  ' . $row['email'];

                        if($row['is_edited'])
                        {
                            echo ' <span class="glyphicon glyphicon-pencil"> Edited';
                        }

                    echo '</div>';
                    echo '<div class="panel-body">';

                            if(!empty($row['image']))
                            {
                                echo '<img src=images/' . $row['image'] . '>';
                            }

                            echo '<div class="caption">';
                                echo '<br><p>' . $row['message'] . '</p>';
                            echo '</div>';

                    echo '</div>';
                echo '</div>';
            }

            echo '<div id="fine-uploader-files"></div>';
        ?>
    </div>
    <div class="panel-footer">
        <div class="tab-feed">
            <form action="index.php?route=feedback/create" method="post" id="form-add-feedback" enctype="multipart/form-data" >
                <br>
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="Name" id="name-js" name="name">
                <br>
                <label>Email:</label>
                <input type="text" class="form-control" placeholder="Email" id="email-js" name="email">
                <br>
                <label>File:</label>
                <input type="file" id="file-js" name="file">
                <br>
                <label>Message:</label>
                <textarea class="form-control" rows="5" id="message-js" name="message"></textarea>
                <br>
                <input type="submit" class="btn btn-default" name="change_submit" value="Send">
                <input type="submit" class="btn btn-primary" id="preview-button-js" name="preview_submit" value="Preview">
                <!--<a><button class="btn btn-primary" type="button" id="preview-button-js" align="center">Preview</button></a>-->
                <input type="hidden" id="preview-js" name="preview" value=0>
            </form>
        </div>
    </div>
</div>

<script src="js/feedback.js"></script>
