<?php
session_start();
ini_set('display_errors', 1);

Class Action {
    private $db;

    public function __construct() {
        ob_start();
        include 'db_connect.php';
        $this->db = $conn;
    }

    function __destruct() {
        $this->db->close();
        ob_end_flush();
    }

    function login() {
        extract($_POST);
        $qry = $this->db->query("SELECT *, concat(firstname, ' ', lastname) as name FROM users WHERE email = '$email' AND password = '" . md5($password) . "'");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && !is_numeric($key)) {
                    $_SESSION['login_' . $key] = $value;
                }
            }
            return 1;
        } else {
            return 2;
        }
    }

    function logout() {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }

    function login2() {
        extract($_POST);
        $qry = $this->db->query("SELECT *, concat(lastname, ', ', firstname, ' ', middlename) as name FROM students WHERE student_code = '$student_code'");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && !is_numeric($key)) {
                    $_SESSION['rs_' . $key] = $value;
                }
            }
            return 1;
        } else {
            return 3;
        }
    }

    function save_user() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        if (!empty($password)) {
            $data .= ", password=md5('$password') ";
        }
        $check = $this->db->query("SELECT * FROM users WHERE email ='$email' " . (!empty($id) ? " AND id != {$id} " : ''))->num_rows;
        if ($check > 0) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users SET $data");
        } else {
            $save = $this->db->query("UPDATE users SET $data WHERE id = $id");
        }
        if ($save) {
            return 1;
        }
    }


    function delete_user() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM users WHERE id = $id");
        if ($delete) {
            return 1;
        }
    }


	function get_user_details($id) {
        $qry = $this->db->query("SELECT * FROM users WHERE id = $id");
        if ($qry->num_rows > 0) {
            return $qry->fetch_assoc();
        }
        return null;
    }

    function save_branch() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        if (empty($id)) {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $i = 0;
            while ($i == 0) {
                $bcode = substr(str_shuffle($chars), 0, 15);
                $chk = $this->db->query("SELECT * FROM branches WHERE branch_code = '$bcode'")->num_rows;
                if ($chk <= 0) {
                    $i = 1;
                }
            }
            $data .= ", branch_code='$bcode' ";
            $save = $this->db->query("INSERT INTO branches SET $data");
        } else {
            $save = $this->db->query("UPDATE branches SET $data WHERE id = $id");
        }
        if ($save) {
            return 1;
        }
    }

    function delete_branch() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM branches WHERE id = $id");
        if ($delete) {
            return 1;
        }
    }

    function delete_staff() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM users WHERE id = $id");
        if ($delete) {
            return 1;
        }
    }

    function save_parcel() {
        extract($_POST);
        foreach ($price as $k => $v) {
            $data = "";
            foreach ($_POST as $key => $val) {
				if (!in_array($key, array('id', 'weight', 'height', 'width', 'length', 'price')) && !is_numeric($key)) {
                    if (empty($data)) {
                        $data .= " $key='$val' ";
                    } else {
                        $data .= ", $key='$val' ";
                    }
                }
            }
            if (!isset($type)) {
                $data .= ", type='2' ";
            }
            $data .= ", height='{$height[$k]}' ";
            $data .= ", width='{$width[$k]}' ";
            $data .= ", length='{$length[$k]}' ";
            $data .= ", weight='{$weight[$k]}' ";
            $price[$k] = str_replace(',', '', $price[$k]);
            $data .= ", price='{$price[$k]}' ";
            if (empty($id)) {
                $i = 0;
                while ($i == 0) {
                    $ref = sprintf("%'012d", mt_rand(0, 999999999999));
                    $chk = $this->db->query("SELECT * FROM parcels WHERE reference_number = '$ref'")->num_rows;
                    if ($chk <= 0) {
                        $i = 1;
                    }
                }
                $data .= ", reference_number='$ref' ";
                if ($save[] = $this->db->query("INSERT INTO parcels SET $data")) {
                    $ids[] = $this->db->insert_id;
                }
            } else {
                if ($save[] = $this->db->query("UPDATE parcels SET $data WHERE id = $id")) {
                    $ids[] = $id;
                }
            }
        }
        if (isset($save) && isset($ids)) {
            // return json_encode(array('ids'=>$ids,'status'=>1));
            return 1;
        }
    }

    function delete_parcel() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM parcels WHERE id = $id");
        if ($delete) {
            return 1;
        }
    }

    function update_parcel(){
		extract($_POST);
	
		error_log("Debug: Status = " . print_r($status, true));
		error_log("Debug: ID = " . print_r($id, true));
	
		if (!isset($status) || !isset($id)) {
			echo "Error: Status or ID is not set.";
			return 0;
		}
	
		$status = intval($status);
		$id = intval($id);
	
		error_log("Debug: Sanitized Status = " . $status);
		error_log("Debug: Sanitized ID = " . $id);
	
		if ($status <= 0 || $id <= 0) {
			echo "Error: Invalid status or ID value.";
			return 0;
		}
	
		$update = $this->db->query("UPDATE parcels SET status = $status WHERE id = $id");
		$save = $this->db->query("INSERT INTO parcel_tracks (status, parcel_id) VALUES ($status, $id)");
	
		if ($update && $save) {
			return 1;
		} else {
			error_log("Error: " . $this->db->error);
			echo "Error: " . $this->db->error;
			return 0;
		}
	}
	

    public function get_parcel_history() {
        $ref_no = $_POST['ref_no'];
        
        $qry = $this->db->query("SELECT * FROM parcels WHERE reference_number = '$ref_no'");

        if ($qry && $qry->num_rows > 0) {
            $data = [];
            while ($row = $qry->fetch_assoc()) {
                $data[] = $row;
            }
            return json_encode($data);
        } else {
            return json_encode([]);
        }
    }

}
?>
