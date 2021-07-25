<?php
if (session_status() == PHP_SESSION_NONE)
	session_start();
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sushi');

	function Sql_Connect()
	{
		$dbc = new mysqli(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME) or die("cant connect to the database");
		return $dbc;
	}

	function UserExists($email)
	{
		$sql = Sql_connect();
		$ret = false;
		$sql->real_escape_string(trim($email));

        // Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->connect_error) 
		{
			trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
			return $ret;
        }

		// Prepare and bind parameter.
		$Email = null;
        $stmt = $sql->prepare('SELECT * from users WHERE email=?');
        $stmt->bind_param("s", $Email);
        
        $Email = $email;

        // Execute statement.
        $stmt->execute();

        $result = $stmt->get_result(); // Het the result from the executed statement.
        while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
        {
            if($row['email'] == $email) // If username matches, set $ret to true.
                $ret = true;
        }

        // Cleanup
        $stmt->close();
        $sql->close();

        // Return result.
        return $ret;
    }


	function AddUser($name, $email, $password, $usertype)
	{
		$sql = Sql_connect();
		$ret = false;
		$sql->real_escape_string(trim($email));

        // Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->connect_error) 
		{
			trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
			return $ret;
        }

		// Prepare and bind parameter.
		//$Email = null;
		$stmt = $sql->prepare('INSERT INTO users (name, email, passwordhash, cart, orders, usertype) VALUES (?, ?, ?, ?, ?, ?);');
		// Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->error) 
		{
			trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
			return $ret;
        }
        $stmt->bind_param("sssssi", $Name, $Email, $PasswordHash, $cart, $orders, $Usertype);
		
		$Name = $name;
		$Email = $email;
		$PasswordHash = password_hash($password, PASSWORD_ARGON2I);
		$cart = "[]";
		$orders = "[]";
		$Usertype = $usertype;

        // Execute statement.
		if($stmt->execute())
		{
			$ret = true;
		}

        // Cleanup
        $stmt->close();
        $sql->close();

        // Return result.
        return $ret;
	}

	function SaveUser($id, $name, $email, $passwordhash, $cart, $orders, $usertype)
	{
		$sql = Sql_connect();
		$ret = false;
		$sql->real_escape_string(trim($email));

        // Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->connect_error) 
		{
			trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
			return $ret;
        }

		// Prepare and bind parameter.
		//$Email = null;
		$stmt = $sql->prepare('UPDATE users set name=?, email=?, passwordhash=?, cart=?, orders=?, usertype=? WHERE id=?;');
		// Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->error) 
		{
			trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
			return $ret;
        }
        $stmt->bind_param("sssssii", $Name, $Email, $PasswordHash, $cart, $orders, $Usertype, $Uid);
		
		$Name = $name;
		$Email = $email;
		$PasswordHash = $passwordhash;
		$cart = $cart;
		$orders = $orders;
		$Usertype = $usertype;
		$Uid = $id;

        // Execute statement.
		if($stmt->execute())
		{
			$ret = true;
		}

        // Cleanup
        $stmt->close();
        $sql->close();

        // Return result.
        return $ret;
	}
	
	function Login($email, $password)
	{
		$sql = Sql_connect();
		$ret = false;
		$sql->real_escape_string(trim($email));

        // Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->connect_error) 
		{
			trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
			return $ret;
        }

		// Prepare and bind parameter.
		//$Email = null;
		$stmt = $sql->prepare('SELECT * FROM users WHERE email=?');
		// Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->error) 
		{
			trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
			return $ret;
        }
        $stmt->bind_param("s", $Email);
		
		$Email = $email;
        // Execute statement.
		if($stmt->execute())
		{
			$result = $stmt->get_result(); // Het the result from the executed statement.
        	while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
        	{
				if(password_verify($password, $row["passwordhash"]))
				{
					$ret = true;
					$_SESSION['userID'] = $row["id"];
					$_SESSION['email'] = $row["email"];
				}
            	
        	}
		}

        // Cleanup
        $stmt->close();
        $sql->close();

        // Return result.
        return $ret;
	}
	
	function GetUser($id)
	{
		$sql = Sql_connect();
		$ret = false;

        // Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->connect_error) 
		{
			trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
			return $ret;
        }

		// Prepare and bind parameter.
		//$Email = null;
		$stmt = $sql->prepare('SELECT * FROM users WHERE id=?');
		// Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->error) 
		{
			trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
			return $ret;
        }
        $stmt->bind_param("i", $Id);
		
		$Id = $id;
        // Execute statement.
		if($stmt->execute())
		{
			$result = $stmt->get_result(); // Het the result from the executed statement.
        	while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
        	{
				$ret = $row;
        	}
		}

        // Cleanup
        $stmt->close();
        $sql->close();

        // Return result.
        return $ret;
	}

	function GetProduct($id)
	{
		$sql = Sql_connect();
		$ret = false;

        // Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->connect_error) 
		{
			trigger_error('Database connection failed: '  . $sql->connect_error, E_USER_ERROR);
			return $ret;
        }

		// Prepare and bind parameter.
		//$Email = null;
		$stmt = $sql->prepare('SELECT * FROM products WHERE id=?');
		// Check if the database connected successfully. If not, return throw error and return false.
        if ($sql->error) 
		{
			trigger_error('Database connection failed: '  . $sql->error, E_USER_ERROR);
			return $ret;
        }
        $stmt->bind_param("i", $Id);
		
		$Id = $id;
        // Execute statement.
		if($stmt->execute())
		{
			$result = $stmt->get_result(); // Het the result from the executed statement.
        	while ($row = $result->fetch_assoc()) // Iterate throught all the fetched rows. Note this should only have 1 row returned.
        	{
				$ret = $row;
        	}
		}

        // Cleanup
        $stmt->close();
        $sql->close();

        // Return result.
        return $ret;
	}

?>