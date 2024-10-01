<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {

    public function findUserById($id) {
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $user = $this->select($sql);

        return $user;
    }

    public function findUser($keyword) {
        $sql = 'SELECT * FROM users WHERE user_name LIKE %'.$keyword.'%'. ' OR user_email LIKE %'.$keyword.'%';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password) {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "'.$md5Password.'"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id) {
        $sql = 'DELETE FROM users WHERE id = '.$id;
        return $this->delete($sql);

    }

  /**
 * Cập nhật người dùng
 * @param array $input
 * @return mixed
 * @throws Exception
 */
public function updateUser($input) {
    // Kiểm tra dữ liệu đầu vào
    if (empty($input['name']) || !preg_match('/^[A-Za-z0-9]{5,15}$/', $input['name'])) {
        throw new Exception("Tên không hợp lệ. Nó phải từ 5 đến 15 ký tự và chỉ chứa chữ cái A-Z, a-z, và số 0-9.");
    }  
    if (empty($input['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!@#$%^&*()]).{5,10}$/', $input['password'])) {
        throw new Exception("Mật khẩu không hợp lệ. Nó phải từ 5 đến 10 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt.");
    }

    // Sử dụng prepared statements
    $name = mysqli_real_escape_string(self::$_connection, $input['name']);
    $password = password_hash($input['password'], PASSWORD_DEFAULT); // Băm mật khẩu
    $id = intval($input['id']);
    
    $sql = 'UPDATE users SET 
             name = ?, 
             password = ? 
            WHERE id = ?';

    // Chuẩn bị câu lệnh
    $stmt = self::$_connection->prepare($sql);
    $stmt->bind_param('ssi', $name, $password, $id);
    $stmt->execute();
   

    return $stmt->affected_rows; // Trả về số dòng bị ảnh hưởng
}

/**
 * Thêm người dùng
 * @param array $input
 * @return mixed
 * @throws Exception
 */
public function insertUser($input) {
    if (empty($input['name']) || !preg_match('/^[A-Za-z0-9]{5,15}$/', $input['name'])) {
        throw new Exception("Tên không hợp lệ. Nó phải từ 5 đến 15 ký tự và chỉ chứa chữ cái A-Z, a-z, và số 0-9.");
    }
    if (empty($input['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!@#$%^&*()]).{5,10}$/', $input['password'])) {
        throw new Exception("Mật khẩu không hợp lệ. Nó phải từ 5 đến 10 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt.");
    }
    $name = mysqli_real_escape_string(self::$_connection, $input['name']);
    $password = password_hash($input['password'], PASSWORD_DEFAULT); // Băm mật khẩu

    $sql = "INSERT INTO `app_web1`.`users` (`name`, `password`) VALUES (?, ?)";
    $stmt = self::$_connection->prepare($sql);
    $stmt->bind_param('ss', $name, $password);
    $stmt->execute();
    

    return $stmt->insert_id;
}



    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getUsers($params = []) {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] .'%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            $users = self::$_connection->multi_query($sql);

            //Get data
            $users = $this->query($sql);
        } else {
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

        return $users;
    }
}