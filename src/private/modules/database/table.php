<?php

class Table {
    private mysqli $connection;
    private string $table;

    // Utils
    private function get_type(mixed $v): string {
        if (is_int($v)) return 'i';
        if (is_float($v)) return 'd';
        return 's';
    }

    // Constructor
    public function __construct(mysqli $connection, string $table) {
        $this -> connection = $connection;
        $this -> table = $table;
    }

    // CRUD
    
    /**
     * Insert a row into the table.
     * 
     * @param array $insert The values, formatted as ['COLUMN' => VALUE], to be inserted.
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return array|bool Returns an array, containing the inserted array (including the ID), or FALSE if the insert fails.
     */
    public function create(array $insert): array | bool {
        $columns = implode(", ", array_keys($insert));
        $placeholders = implode(", ", array_fill(0, count($insert), "?"));;

        $types = "";
        $values = [];

        foreach ($insert as $value) {
            $types .= $this -> get_type($value);
            $values[] = $value;
        }

        $query = "INSERT INTO {$this -> table} ($columns) VALUES ({$placeholders})";

        $statement = $this -> connection -> prepare($query);
        $statement -> bind_param($types, ...$values);

        $result = $statement -> execute();

        if (!$result) {
            return false;
        } else {
            $id = $this -> connection -> insert_id;
            return $this -> read($id);
        }
    }

    /**
     * Read a row from the table
     * 
     * @param string $column The column to query from
     * @param mixed $value The value to search for
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return array|bool Returns an array, containing the result, or FALSE if none found.
     */
    public function read_where(string $column, mixed $value): array | bool {
        $query = "SELECT * FROM {$this -> table} WHERE {$column} = ?";
        $statement = $this -> connection -> prepare($query);

        $type = $this -> get_type($value);
        $statement -> bind_param($type, $value);
        $statement -> execute();
        $result = $statement -> get_result();

        if ($result && $result -> num_rows > 0) {
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }

    /**
     * Wrapper for `read_where`. Find a row from its ID.
     * 
     * @param int $id The id to query
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return array|bool Returns an array, containing the result, or FALSE if none found.
     */
    public function read(int $id) {
        return $this -> read_where("id", $id);
    }

    /**
     * Read all rows in a table
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return array|bool Returns an array, containing the result, or FALSE if none found.
     */
    public function read_all(): array | bool {
        $query = "SELECT * FROM {$this -> table}";
        $statement = $this -> connection -> prepare($query);

        $statement -> execute();
        $result = $statement -> get_result();
        
        if ($result && $result -> num_rows > 0) {
            $rows = [];

            while ($row = $result -> fetch_assoc()) {
                $row[] = $row;
            }

            return $rows;
        } else {
            return false;
        }
    }

    /**
     * Update a row in a table
     * 
     * @param string $column The column to select which row to update
     * @param mixed $matches The row to search for
     * @param array $update The values to update, in the format ['COLUMN' => NEW_VALUE]
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return bool Returns the result of the query
     */

    public function update_where(string $column, mixed $matches, array $update): bool {
        $columns = [];
        $types = "";
        $values = [];

        foreach ($values as $column => $value) {
            $columns[] = "$column = ?";
            $types .= $this -> get_type($value);
            $values[] = $value;
        }
    
        $set = implode(", ", $columns);
        $query = "UPDATE {$this -> table} SET {$set} WHERE $column = ?";
        $statement = $this -> connection -> prepare($query);
        
        $types .= $this -> get_type($matches);
        $values[] = $matches;
        $statement -> bind_param($types, $values);

        return $statement -> execute() ?? false;
    }

    /**
     * Wrapper for `update_where`. Update a row from its ID.
     * 
     * @param int $id The id to query
     * @param array $update The values to update. See the `update_where` function for more information
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return bool Returns the result of the query
     */
    public function update(int $id, array $update): bool {
        return $this -> update_where('id', $id, $update);
    }

    /**
     * Wrapper for `update_where`. Update a row from its ID.
     * 
     * @param int $id The id to query
     * @param array $update The values to update. See the `update_where` function for more information
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return bool Returns the result of the query
     */
    public function delete_where(string $column, mixed $matches) {
        $query = "DELETE FROM {$this -> table} WHERE {$column} = ?";
        $statement = $this -> connection -> prepare($query);

        $statement -> bind_param($this -> get_type($matches), $matches);
        return $statement -> execute();
    }

    /**
     * Wrapper for `delete_where`. Delete a row from its ID.
     * 
     * @param int $id The id to delete
     * 
     * @throws mysqli_sql_exception Thrown when preparing the statement fails
     * @return bool Returns the result of the query
     */
    public function delete(int $id): bool {
        return $this -> delete_where('id', $id);
    }
}