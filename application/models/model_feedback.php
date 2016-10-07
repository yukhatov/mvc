<?php

/**
 * Class Model_Feedback
 */
class Model_Feedback extends Model
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * Model_Feedback constructor.
     */
    function __construct()
	{
		parent::__construct();
	}

    /**
     * @return bool
     */
    public function create()
	{
		$sql = "INSERT INTO feedback (name, email, message, is_edited, is_accepted, `date`, image)
				VALUES ('" . $this->__get('name') . "','" . $this->__get('email') . "','" . $this->__get('message') . "'," . 0 . ", " . 0 . ", " . date("Ymdhis", time()) . ", '" . $this->__get('image') ."')";

		$result = $this->db->query($sql);
		$this->db->close();

        if($result)
        {
            return true;
        }

        return false;
	}

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function get_data($params)
	{	
		$dataProvider = array();
		$dataProvider['order'] = '-date';

		if(isset($params['is_admin']))
		{
			$sql = "SELECT * FROM feedback ORDER BY " . $params['order'];
		}else{
			if(isset($params['order']))
			{
				$sql = "SELECT * FROM feedback WHERE is_accepted = 1 ORDER BY -" . $params['order'];
				$dataProvider['order'] = $params['order'];
			}else{
				$sql = "SELECT * FROM feedback WHERE is_accepted = 1 ORDER BY date DESC";
			}
		}

		$result = $this->db->query($sql);
		$data = array();

		$columns = ['Date', 'Name', 'Email'];

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        $data[] = ['email' => $row["email"],
		        			'id' => $row["id"],
		        			'date' => $row["date"],
		        			'name' => $row["name"],
		        			'is_edited' => $row["is_edited"],
		        			'is_accepted' => $row["is_accepted"],
		        			'message' => $row["message"],
                            'image' => $row["image"]];
		    }
		} else {
		    echo "0 results";
		}

		if(isset($params['is_admin']))
		{
			$columns[] = 'is_accepted';
		}

		$this->db->close();

		$dataProvider['models'] = $data;
		$dataProvider['columns'] = $columns;

		return $dataProvider;
	}

    /**
     * @param $id
     * @return array|null
     */
    public function find_item_by_id($id)
    {
        $dataProvider = array();
        $sql = "SELECT * FROM feedback WHERE id =" . $id;

        $result = $this->db->query($sql);
        $data = $result->fetch_assoc();

        if($data){
            return $data;
        }
        else{
            return null;
        }
    }

    /**
     * @param $id
     * @param $status
     */
    public function update_status($id, $status)
	{
		$sql = "UPDATE feedback SET is_accepted = " . $status . " WHERE id=" . $id;
		$result = $this->db->query($sql);
		$this->db->close();
	}

    /**
     * @param $id
     * @param $message
     */
    public function update_message($id, $message)
    {
        $sql = "UPDATE feedback SET message = '" . $message . "', is_edited = 1 WHERE id=" . $id;
        $result = $this->db->query($sql);
        $this->db->close();
    }
}
