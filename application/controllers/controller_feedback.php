<?php

require_once(__DIR__ . '/../../vendor/class.upload.php');

/**
 * Class Controller_Feedback
 */
class Controller_Feedback extends Controller
{

    /**
     * Controller_Feedback constructor.
     */
    function __construct()
	{
		$this->model = new Model_Feedback();
		$this->view = new View();
	}

    /**
     *
     */
    function action_index()
	{
		$params = null;

		if(isset($_GET['order']))
		{
			$params['order'] = $_GET['order'];
		}

		$data = $this->model->get_data($params);		
		$this->view->generate('feedback_view.php', 'template_view.php', $data);
	}

    /**
     *action upload
     */

	function action_upload()
    {
        header('Content-type: application/json');
        $uploaddir = 'images/temp/';

        //remove tmp files
        $files = glob($uploaddir . '*');
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }

        if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

        if(isset($_FILES[0]))
        {
            $upload_manager = new Upload($_FILES[0]);

            if ($upload_manager->uploaded) {
                if($upload_manager->image_dst_x > 320 or $upload_manager->image_dst_y > 240) // resize
                {
                    $upload_manager->image_resize = true;
                    $upload_manager->image_x = 320;
                    $upload_manager->image_y = 240;
                }

                $upload_manager->Process($uploaddir);

                if ($upload_manager->processed) {
                    echo json_encode( ['name' => $upload_manager->file_dst_name_body . '.' . $upload_manager->file_dst_name_ext] );
                    $upload_manager->Clean();
                }
            }
        }
    }

    /**
     *action create feedback
     */
    function action_create()
	{
        header('Content-type: application/json');

        $uploaddir = 'images/';

        if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

		if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['message']))
		{
            if(!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['message']))
            {
                $feedback = new Model_Feedback();
                $feedback->__set('message', $_POST['message']);
                $feedback->__set('name', $_POST['name']);
                $feedback->__set('email', $_POST['email']);
                $feedback->__set('image', null);

                if(isset($_FILES["file"]))
                {
                    $upload_manager = new Upload($_FILES['file']);

                    if ($upload_manager->uploaded) {
                        if($upload_manager->image_dst_x > 320 or $upload_manager->image_dst_y > 240) // resize
                        {
                            $upload_manager->image_resize = true;
                            $upload_manager->image_x = 320;
                            $upload_manager->image_y = 240;
                        }

                        $upload_manager->Process($uploaddir);

                        if ($upload_manager->processed) {
                            $feedback->__set('image', $upload_manager->file_dst_name_body . '.' . $upload_manager->file_dst_name_ext);
                            $upload_manager->Clean();
                        }
                    }
                }

                $feedback->create();
            }
		}

        header("Location: index.php?route=feedback/index");
	}
}
