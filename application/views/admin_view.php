<h1>Admin panel</h1>
<br>
<div class="panel panel-default">
	<div class="panel-heading"><label>All feedbacks:</label></div>
	<div class="panel-body">
		<?php
		foreach($data['models'] as $row)
		{
			echo '<div class="panel panel-default">';
				echo '<div class="panel-heading">' . $row['date'] . ' by: <label>' . $row['name'] . '</label>  ' . $row['email'] .' </div>';
				echo '<div class="panel-body">';

					if(!empty($row['image']))
					{
						echo '<img src=images/' . $row['image'] . '>';
					}

					echo '<div class="caption">';
					echo '<br><p>' . $row['message'] . '</p>';
					echo '</div>';
				echo '</div>';
				echo '<div class="panel-footer">';

					if($row['is_accepted'])
					{
						echo '<a href="index.php?route=admin/status&status=0&id=' . $row['id'] . '"><button class="btn btn-danger" type="button" align="center">Reject</button></a>';
					}else{
						echo '<a href="index.php?route=admin/status&status=1&id=' . $row['id'] . '"><button class="btn btn-success" type="button" align="center">Accept</button></a>';
					}

					echo ' <a ><button class="btn btn-primary" type="button" align="center" onclick="edit('. $row['id'] .');">Edit</button></a>';
				echo '</div>';
			echo '</div>';
		}
		?>
	</div>
</div>

<script src="js/admin.js"></script>
