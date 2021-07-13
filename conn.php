<?php
class emailSubs
{
    private $host = "localhost";
    private $db = "assignment";
    private $username = "root";
    private $password = "";
    private $conn;
    function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db);
    }

    function getDomainName($email)
    {
        $domain_name = substr(strrchr($email, "@"), 1);
        $len = strpos($domain_name, ".");
        $perfectName = substr($domain_name, 0, $len);
        return $perfectName;
    }

    function create($email)
    {
        $perfectName = $this->getDomainName($email);
        $sql = "SELECT * FROM domains WHERE name='$perfectName'";
        $results = $this->conn->query($sql);
        if (!$results->num_rows > 0) {
            $sql = "INSERT INTO domains (name) VALUES ('$perfectName') ";
            $this->conn->query($sql);
        }
        $sql = "INSERT INTO users (email) VALUES('$email')";
        return $this->conn->query($sql);
    }
    function getEmails()
    {

        $start = isset($_GET['page']) ? $_GET['page'] : 1;
        $start--;
        $start = $start * 10;
        $sql = "SELECT * FROM users ORDER BY dateOfSubs ASC LIMIT $start,10";
        return $this->conn->query($sql);
    }
    function totalRecords()
    {
        $sql = "SELECT * FROM users";
        $records =  $this->conn->query($sql);
        return $records->num_rows;
    }
    function getDomains()
    {
        $sql = "SELECT * from domains";
        return $this->conn->query($sql);
    }
    function delete($id)
    {
        $sql = "SELECT * FROM users WHERE id= $id";
        $data = $this->conn->query($sql);
        $row = $data->fetch_row();
        $perfectName = $this->getDomainName($row[1]);
        $sql = "DELETE FROM users WHERE id= $id";
        $this->conn->query($sql);
        $match = false;
        $sql = "SELECT * FROM users";
        $data = $this->conn->query($sql);
        while ($row = $data->fetch_assoc()) {
            $domainName = $this->getDomainName($row["email"]);
            $match = $domainName == $perfectName ? true : false;
            if ($match) {
                break;
            }
        }
        if (!$match) {
            $sql = "DELETE FROM domains WHERE name='$perfectName'";
            $this->conn->query($sql);
        }
        return true;
    }
    function __destruct()
    {
        mysqli_close($this->conn);
    }
    function validateData($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $tld = substr(strrchr($email, "."), 1);
            if ($tld === "co") {
                return header("location:index.php?error=We are not accepting subscriptions from Colombia emails");
            } else {
                return true;
            }
        } else {
            return header("location:index.php?error=Please provide a valid e-mail address");
        }
    }
    function exportCsv($ids)
    {
        $filename = "emails.csv";
        $fp = fopen('php://output', 'w');
        $header[0] = "Emails";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);
        $query = "SELECT email FROM users WHERE id IN ($ids)";
        $result = $this->conn->query($query);
        while ($row = $result->fetch_row()) {
            fputcsv($fp, $row);
        }
    }
}

$obj = new emailSubs();
$data = $obj->getEmails();
$domains = $obj->getDomains();
$totalRecords = $obj->totalRecords();
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

if (isset($_POST['submitEmail'])) {
    $email = $_POST['email'];
    if ($email == "") {
        return header("location:index.php?error=Email address is required");
    } else {
        $check = $obj->validateData($email);

        if ($check) {
            $dataAdd =  $obj->create($email);
            if ($dataAdd) {
                return header("location:success.php");
            } else {
                return header("location:index.php");
            }
        }
    }
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $check = $obj->delete($id);
    if ($check) {
        return header("location:show.php");
    }
}

if (isset($_POST['exportCsv'])) {
    if (!isset($_POST['csv'])) {
        header("location:show.php?error=true");
    } else {
        $ids = implode(', ', $_POST['csv']);
        $obj->exportCsv($ids);
    }
}
