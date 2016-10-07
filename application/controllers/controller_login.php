<?php

/**
 * Class Controller_Login
 */
class Controller_Login extends Controller
{

    /**
     *
     */
    function action_index()
	{
		$this->view->generate('login_view.php', 'template_view.php');
	}

    /**
     *
     */
    function action_check()
	{
		if($_POST['submit']){
			$user = $this->findUser($_POST['user']);

			if($user)
			{
				if($user['pass'] == md5($_POST['pass']))
				{
					session_start();
					$_SESSION['admin'] = true;
					header("Location: index.php?route=admin/index");

					exit;
				}
				else{
					header("Location: index.php?route=login/index");
				}
			}else{
				header("Location: index.php?route=login/index");
			}
		}
	}

    /**
     * @param $name
     * @return array|null
     */
    private function findUser($name)
	{
		$model = new Model();

		$sql  = "SELECT * FROM user WHERE name = '" . $name . "'";
		$result = $model->db->query($sql);
		$data = array();
		
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data = ['name' => $row["name"],
		        			'pass' => $row["pass"],
		        			'role' => $row["role"]];
		    }

		    return $data;
		}

		return null; 
	}
}
