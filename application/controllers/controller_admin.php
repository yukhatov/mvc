<?php
include "application/models/model_feedback.php";

/**
 * Class Controller_Admin
 */
class Controller_Admin extends Controller
{
    /**
     * Controller_Admin constructor.
     */
    function __construct()
	{
		$this->feedback = new Model_Feedback();
		$this->view = new View();
	}

    /**
     *index action
     */
    function action_index()
	{
		session_start();
		
		if(!$_SESSION['admin']){
			header("Location: index.php?route=login/index");
			exit;
		}

		$params = ['order' => '-date', 'is_admin' => true];
		$data = $this->feedback->get_data($params);
		$this->view->generate('admin_view.php', 'template_view.php', $data);
	}

    /**
     *update status action
     */
    function action_status()
	{
		if(isset($_GET['id']) and isset($_GET['status']))
		{
			$feedback = new Model_Feedback();
			$feedback->update_status($_GET['id'], $_GET['status']);
		}

		header("Location: index.php?route=admin/index");
	}

    /**
     * edit action
     * @return int
     */
    function action_edit()
    {
        if(isset($_GET['id'])){
            $feedbackModel = new Model_Feedback();
            $data = $feedbackModel->find_item_by_id($_GET['id']);

            $this->view->generate('edit_view.php', 'template_view.php', $data);
        }else{
            return 0;
        }
    }

    /**
     * update message action
     * @return int
     */
    function action_update_message()
    {
        if(isset($_POST['message']) and isset($_POST['id']))
        {
            $this->feedback->update_message($_POST['id'], $_POST['message']);
        }else{
            return 0;
        }
    }
}
